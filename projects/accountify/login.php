<?php
// There had better be NO BLANK LINES OR ANYTHING ELSE
// before the preceding line!

// Accountify 2.03, Copyright 2007, Boutell.Com, Inc.
// Accountify is NOT public domain. Accountify is made available under a 
// DUAL LICENSE. You may use Accountify EITHER under the terms of:

// 1. The GNU General Public License, version 3.0 (see gpl-3.0.txt) OR
// 2. The Accountify Nonexclusive Commercial License (see LICENSE.txt).

// Accountify 2.03: support for user accounts in PHP-based web sites.
// (Formerly "Accountable")

// NO CHANGES REQUIRED HERE

// All settings are in login_config.php, so that you can
// install an upgraded version of login.php without losing them.
// You may also wish to edit the CSS, text, and PHP files found
// in the chrome folder.

// SEE CHANGELOG.txt FOR A HISTORY OF CHANGES.

# Bring in standard PHP session support only if we are
# not using our built-in session support. Note that our
# built-in support relies on the fact that $_SESSION
# is a superglobal whether session_start gets called
# (or compiled!) or not. This is true in PHP4, PHP5, 
# and PHP6. It might go away in PHP7. I'm not holding my breath.

require_once 'DB.php';
require_once 'login_defaults.php';
require_once 'login_config.php';


# DEBUG: remove after testing

set_error_handler('loginErrorHandler');

function loginErrorHandler($errno, $errstr, $errfile, $errline)
{
	# Get some useful reporting going!
	# 2.03: isManip is another source of bogus warnings from DB.php 
	# under PHP5 (sigh)
	if (($errno == 2048) && (preg_match("/(DB\\.php|PEAR\\.php|mysql.php)/", $errfile) || preg_match("/isError|isManip|DB::connect/", $errstr))) {
		# Pear::DB spews warnings in PHP5. Yes, we should
		# move to MDB2, but apparently that spews warnings too.
		# PEAR itself spews some too.
		return;
	} 
	print "<pre>\n";
	print "$errno: $errstr in $errfile at $errline\n";	
	$trace = debug_backtrace();
	foreach ($trace as $frame) {
		print "line: " . $frame['line'] . " function: " . $frame['function'] . " file: " . $frame['file'] . "\n";
	} 
	print "</pre>\n";
}

class Login {
	var $loginFailed = NULL;
	var $loggedIn = NULL;
	var $url = false;
	var $validEmail = false;
	var $validDomain = false;
	var $validRealName = false;
	var $validUser = false;
	var $validPassword = false;
	var $validGuid = false;
	var $alreadyRegistered = false;

	var $maxEmail = 80;
	var $maxUser = 40;
	var $maxRealName = 80;
	var $maxPassword = 40;
	var $minPassword = 6;

	var $confirmAttempt = false;
	var $confirmed = false;
	var $oldData = false;
	var $guestFields = false;
	var $approvalNeeded = false;
	var $unverified = false;

	var $baseCategories;
	var $baseCategoryOrder = array(
		'general',
		'password',
		'close'
	);
	var $categories = false;
	var $noPrompt = false;
	function Login() {
		global $loginSettings;
		global $login;
		$this->baseCategories = array(
			'general' => array(
				'label' => 'General',
				'html' => array(&$this, 'generalHtml'),
				'validator' => array(&$this, 'generalValidator'),
				'writer' => array(&$this, 'generalWriter'),
				'eraser' => array(&$this, 'generalEraser'),
				'setup' => true,
				'editable' => true
			),
			'password' => array(
				'label' => 'Password',
				'html' => array(&$this, 'passwordHtml'),
				'validator' => array(&$this, 'passwordValidator'),
				'writer' => array(&$this, 'passwordWriter'),
				'setup' => false,
				'editable' => true
			),
			'close' => array(
				'label' => 'Close Account',
				'html' => array(&$this, 'closeHtml'),
				'validator' => array(&$this, 'closeValidator'),
				'writer' => array(&$this, 'closeWriter'),
				'editable' => true,
				'setup' => false,
				'editable' => true
			)
		);
		$this->validEmail = "/^[\w\%\-\.\+]+\@[\w\%\-\.\+]+\.[\w]+$/";
		$this->validDomain = "/^[\w\%\-\.\+]+\.[\w]+$/";
		$this->validRealName = "/^[\w\.\-]+\s+[\w\.\ \-]+$/";
		$this->validUser = "/^[\w\.\-]+$/";
		$this->validPassword = "/^[\w\%\-\.\+\ ]+/";
		$this->validGuid = "/^[0-9a-fA-F]+$/";
		if (isset($_SERVER['SCRIPT_URL'])) {
			$this->url = $_SERVER['SCRIPT_URL'];
		} elseif (isset($_SERVER['SCRIPT_URI'])) {
			$this->url = $_SERVER['SCRIPT_URI'];
		} elseif (isset($_SERVER['REQUEST_URI'])) {
			$this->url = $_SERVER['REQUEST_URI'];
		} else {
			die("login.php: SCRIPT_URL, SCRIPT_URI and REQUEST_URI are unavailable, I can't find myself");
		}
		$this->url = preg_replace('/\?.*$/', '', $this->url);
		$this->guestFields = array();
		if (isset($loginSettings['extraCategories'])) {
			$this->categories = 
				$this->baseCategories + 
				$loginSettings['extraCategories'];
		} else {
			$this->categories = $this->baseCategories;
		}
		if (isset($loginSettings['extraCategoryOrder'])) {
			$this->categoryOrder = 
				array_merge($this->baseCategoryOrder,
				$loginSettings['extraCategoryOrder']);
		} else {
			$this->categoryOrder = $this->baseCategoryOrder;
		}

		foreach ($loginSettings['guestFields'] as $gf) {
			$this->guestFields[$gf] = 1;
		}

		if (loginParameter('builtInSessions')) {
			# I tried using globals for this in PHP4 but it
			# was even uglier than this reference-y OOP stuff 	
			$result = session_set_save_handler(
				array(&$this, 'sessionOpen'),
                                array(&$this, 'sessionClose'),
                                array(&$this, 'sessionRead'),
                                array(&$this, 'sessionWrite'),
                                array(&$this, 'sessionDestroy'),
                                array(&$this, 'sessionGC')
			);
			if (!$result) {
				$this->send('no_sessions');
				exit(0);
			}
			# Necessary in PHP5+ to make sure we are called
			# before all objects, including $login and Pear::DB,
			# are destroyed (sigh)
			register_shutdown_function('session_write_close');
		}
		# We need a session manager in any case
		session_start();

		# Captcha is always last, and only present when there
		# is no invite code. Note that we needed the session to be
		# loaded first before doing this
		if (loginParameter('captcha') && (!isset($_SESSION['inviteCode']))) {
			$this->categories['captcha'] = array(
				'label' => 'Are You A Real Person?',
				'html' => array(&$this, 'captchaHtml'),
				'validator' => array(&$this, 'captchaValidator'),
				'editable' => true,
				'setup' => true,
				'editable' => false 
			);
			$this->categoryOrder[] = 'captcha';
		}

	}
	function check()
	{
		if (isset($_POST['logout'])) {
			# 1.02 2007-06-22: never delete the cookie,
			# just clear the session file so we can do
			# normal guest cookie stuff
			$this->logout(false);
		}
		# 1.03: do new account confirmation at the beginning
		# so that user code can see $_SESSION['id'] even before
		# calling $login->prompt()
		if (isset($_GET['loginconfirm'])) {
			$this->logout(false);
			$this->confirmed = false;
			$data = $this->confirm($_GET, 'loginconfirm', false);
			if ($data) {
				$data['verified'] = true;
			  $this->confirmed = true;
				$this->mergeIfApproved($data);
			} 
			$this->confirmAttempt = true;
		}
		# 1.1: persistent cookie option
		if (!isset($_SESSION['id'])) {
			if (isset($_COOKIE['accountify_rememberme'])) {
				$c = $_COOKIE['accountify_rememberme'];
				$userData = $this->loadUserDataBody(
					false, false, false, false, $c, false);
				# 1.2: don't leave out important checks
				# such as account closure, account
				# approval, etc. 
				
				$this->mergeIfApproved($userData);
	
				# 2.0: a stale rememberme cookie doesn't mean
				# we should complain to the user. Clean things
				# up in case they are also doing a normal
				# login.
				if ($this->loginFailed) {
					$this->logout();
					$this->loginFailed = false;
				}
			}	
		}
		if (isset($_POST['login'])) {
			# 1.1: we'll check for success later
			# when we emit the prompt, but for now
			# get the validation done so that we can
			# set rememberme cookies while that is possible
			$this->go();
		}
		# 2.0: we check the id, not the email address.
		# Email addresses are mutable now, at least sometimes
		if (isset($_SESSION['id'])) {
			// Already logged in.
			$userData = $this->loadUserDataBody(
				false, false, false, $_SESSION['id'], false, false);
			$this->mergeUserData($userData);
		}
		if (isset($_POST['loginpickusernamesubmit'])) {
			$this->pickUsernameSubmit();
		}
		if (loginParameter('usernames') &&
			isset($_SESSION['user']) && 
				(preg_match('/^XGUIDX/', $_SESSION['user'])))
		{
			$this->pickUsername();
		}
		if (isset($_GET['logininvite'])) {
			$this->logout(false);
			$this->acceptInvite();
			exit(0);
		}
		if (loginGetOrPost('loginexitadminpage')) {
			unset($_POST['login_category']);
			unset($_POST['loginadminpage']);
		}
		if (loginGetOrPost('loginadminpage') &&
			(!loginGetOrPost('loginexitadminpage'))) 
		{
			# Generates independent page, never returns
			$this->adminPage();
		}
		if (loginGetOrPost('logininviteuserspage') &&
			(!loginGetOrPost('loginexitinviteuserspage'))) 
		{
			# Generates independent page, never returns
			$this->inviteUsersPage();
		}
		# These generate an independent page in most cases
		# (but on fatal errors or final success, they do not)
		if (loginGetOrPost('logincreate')) {
			$this->categoryCleanup();
			$this->categoryPage();
		} elseif (loginGetOrPost('loginsettings')) {
			$this->categoryCleanup();
			$this->categoryPage();
			continue;
		} elseif (isset($_POST['login_category'])) {
			$this->categoryPage();
		} 
	}
	function acceptInvite()
	{
		global $loginSettings;
		$inviteCode = $_GET['logininvite'];
		$query = 'SELECT realname, email FROM ' .
			$loginSettings['inviteTable'] . ' WHERE code = ?';
		$result = $this->dbQuery($query, array($inviteCode));
		if ($this->dbIsError($result)) {
			$this->send('database_busy');
			return;
		}
		if (!count($result)) {
			$this->send('invite_code_invalid.php');
			return;
		}
		$email = $result[0]['email'];
		$realname = $result[0]['realname'];
		$query = "UPDATE " . $loginSettings['inviteTable'] . 
			" SET accepted = 'Y' WHERE code = ?"; 
		$result = $this->dbQuery($query, array($inviteCode));
		$_SESSION['inviteCode'] = $inviteCode;
		$_SESSION['inviteEmail'] = $email;
		$this->categoryPage();
	}
	function isDone($c)
	{
		if (isset($_SESSION['login_categories']) &&
			isset($_SESSION['login_categories'][$c]) &&
			isset($_SESSION['login_categories'][$c]['done'])) 
		{
			return true;
		}
		return false;
	}
	function isTopical($c)
	{
		if ($this->loggedIn) {
			return $this->isEditable($c);
		} else {
			return $this->isSetup($c);
		}
	}
	function isSetup($c)
	{
		# By default, a category page is wanted at setup time
		return ((!isset($this->categories[$c]['setup'])) ||
			($this->categories[$c]['setup']));
	}
	function isEditable($c)
	{
		# By default, a category page is wanted at editing time
		return ((!isset($this->categories[$c]['editable'])) ||
			($this->categories[$c]['editable']));
	}
	# call_user_func_array can call methods of objects as well
	# as ordinary functions, so it's a winner for this job
	function categoryCallback($category, 
		$cb,
		$args)
	{
		array_unshift($args, $category);
		return call_user_func_array(
			$this->categories[$category][$cb],
			$args);	
	}	
	function hasWriter($category)
	{
		if (isset($this->categories[$category]['writer'])) {
			return true;
		} else {
			return false;
		}
	}
	function hasEraser($category)
	{
		if (isset($this->categories[$category]['eraser'])) {
			return true;
		} else {
			return false;
		}
	}	
	function categoryCleanup()
	{
		# Unset anything that might be left over
		# from a previous attempt to create an account
		# or edit preferences
		if (isset($_SESSION['login_categories'])) {
			unset($_SESSION['login_categories']);
		}
		if (isset($_SESSION['login_proto'])) {
			unset($_SESSION['login_proto']);
		}
	}	
	function categoryPage()
	{
		global $loginSettings;
		$editing = false;
		$id = false;
		if ($this->loggedIn) {
			$editing = true;
			$id = $_SESSION['id'];
		}
		$cc = false;
		if (isset($_POST['login_category'])) {
			$cc = $_POST['login_category'];
		}
		if (strlen($cc) && (!in_array($cc, $this->categoryOrder))) {	
			# Probably a hack, cancel
			# TODO: nice error message to help
			# confused authors of custom callbacks
			return;	
		}
		$action = false;
		$actions = array(
			'ok', 'previous', 'next', 'cancel', 'password_ok'
		);	
		if ($editing) {
			foreach ($this->categoryOrder as $c) {
				$actions[] = "category_$c";
			}
		}
		foreach ($actions as $a) {
			if (array_key_exists("login_$a", $_POST)) {
				$action = $a;
				break;
			}
		}
		if (strlen($cc) && (!strlen($action))) {
			# Enter key with one text field in IE
			$action = 'ok';
		}	
		if ($action === 'cancel') {
			return;
		}
		if ($action !== 'password_ok') {
			if (strlen($cc)) {
				$_SESSION['login_categories'][$cc]['POST'] = $this->copyPost();
			}
		}
		if ($action === 'previous') {
			if ($editing) {
				return;
			}
			if (!strlen($cc)) {
				return;
			}
			foreach ($this->categoryOrder as $c) {
				if ($c === $cc) { 
					break;
				}
				if ($this->isDone($c)) {
					continue;
				}
				if ($this->isTopical($c)) {		
					$pc = $c;
				}
			}	
			if (!strlen($pc)) {
				return;
			}
			$this->restorePost($pc);
			$this->categoryPageGenerator($pc, false);
		}
		if (strlen($action)) {
			# All actions (except cancel, previous and password_ok) must 
			# validate the current category first. At this point,
			# the absence of a current category is suspicious.
			if (!strlen($cc)) {
				return;
			}
			if ($action !== 'password_ok') {
				$r = $this->categoryCallback($cc, 
					'validator', 
					array($id));
				$valid = ($r[0] === 'loginDataValid');
				$validDone = ($r[0] === 'loginDataValidDone');
				$validWithPassword = ($r[0] === 'loginDataValidWithPassword');
				if ($valid || $validWithPassword || $validDone)
				{
					$_SESSION['login_categories'][$cc]['validated'] = $r[1];
					if ($validWithPassword) {
						$_SESSION['login_categories'][$cc]['password'] = true;
					}
					if ($validDone) {
						$_SESSION['login_categories'][$cc]['done'] = true;
					}
				} elseif ($r[0] === 'loginDataInvalid') {
					if (count($r) == 3) {
						$hints = $r[2];
					} else {
						$hints = array();
					}
					$this->categoryPageGenerator($cc, $r[1], $hints);
				} elseif ($r[0] === 'loginDataCancel') {
					$error = $r[1];
					if ($this->loggedIn) {
						require 'chrome/account_editing_failed.php';
					} else {
						require 'chrome/account_creation_failed.php';
					}
					return;
				} else {
					die("Unrecognized validator response: " . $r[0]);
				}
				# Next button: go to the next page if we can. If we can't,
				# treat this as an OK (finish) button. TODO:
				# 'finishable' option? 
				if ((!$editing) && ($action === 'next')) {
					$i = array_search($cc, $this->categoryOrder);
					$i++;
					while ($i < count($this->categoryOrder)) {
						$c = $this->categoryOrder[$i];
						if (($this->isTopical($c)) && (!$this->isDone($c))) {
							$nc = $c;
							$this->restorePost($nc);
							$this->categoryPageGenerator($nc, false);
						}
						$i++;
					}
					$action = 'ok';
				}
			}
			if (($action === 'ok') || ($action === 'password_ok')) 
			{
				# Our long national nightmare is over...
				# well, maybe. First there's the password
				# requirement. And then there's the
				# writer requirement. And cleanup if
				# that fails. Etc etc etc.
				
				$sofar = array();

				foreach ($this->categoryOrder as $c) {
					if (!($this->isTopical($c) &&
							isset($_SESSION['login_categories'][$c]))) 
					{
						continue;
					}
					if (isset($_SESSION['login_categories'][$c]['password'])) {
						# Password is needed if we're editing existing settings
						if ($this->loggedIn) {
							if (isset($_POST['login_password'])) {
								$p = $_POST['login_password'];
								$qresult = $this->dbQuery("SELECT id FROM " . 
									$loginSettings['table'] . " WHERE " .
									"password = ? AND id = ?", 
									array($p, $id));	
								if ($this->dbIsError($qresult)) {
									$this->send('database_busy');
									return;
								}
								if (count($qresult) == 0) {
									$error = $this->text('incorrect_password');	
									$category = $cc;
									require 'chrome/settings_reenter_password.php';
									exit(0);
								}	
								# Password is good
							} else {
								$category = $cc;
								require 'chrome/settings_reenter_password.php';
								exit(0);
							}
						}
					}
				}
				foreach ($this->categoryOrder as $c) {
					if (!$this->isTopical($c)) {
						continue;
					}
					if (!isset($_SESSION['login_categories'][$c])) 
					{
						if (!$editing) {
							# Attempts to create a new account without all
							# completing all categories are probably hacks
							return;
						} else {
							continue;
						}
					}
					if ($this->hasWriter($c)) {
						$r = $this->categoryCallback($c,
							'writer',
							array($id, $_SESSION['login_categories'][$c]['validated']));
						# Allow the account closure tab to work
						if (strlen($id) && $this->getSession('closed')) {
							$this->callErasers($id, false);
							$this->logout(false);
							require 'chrome/closed_account.php';
							exit(0);
						}
						if (($r[0] === 'loginDataInvalid') ||
							($r[0] === 'loginDataCancel')) {
							# Oh, brother. We must delete this almost-account
							# (in the loginDataInvalid case we'll just
							# create it again when the user tries again)
							if (!$editing) {
								$sofar = array_reverse($sofar);
								foreach ($sofar as $ec) {
									if ($this->hasEraser($ec)) {
										$this->categoryCallback($ec,
											'eraser',
											array($id, true));
									}		
								}
							}
							if ($r[0] === 'loginDataInvalid') {
								$this->restorePost($c);
								$this->categoryPageGenerator($c, $r[1]);
								return;
							} else {
								$error = $r[1];
								if ($editing) {
										require 'chrome/account_editing_failed.php';
								} else {
										require 'chrome/account_creation_failed.php';
								}
								return;
							}
						} elseif ($r[0] === 'loginDataValid') {
							# generalWriter establishes this
							if (isset($_SESSION['login_proto']['id'])) {
								$id = $_SESSION['login_proto']['id'];	
							}	
							#  Happy happy joy joy
						} else {
								die("Internal error in Login::categoryPage: unknown result from writer callback $c");
						}
					} else {
						# No writer, use cheap storage for this category
						foreach ($_SESSION['login_categories'][$c]['validated'] 
							as $key=>$val) 
						{
							$_SESSION[$key] = $val;
						}
					}	
					$sofar[] = $c;
				}
				if (!$editing) {
						# The account is a keeper
						$this->commitProtoAccount();
				}
				# Successful, stop showing category pages
				return;
			}
			if (preg_match('/^category_(\w+)$/', $action, $results)) {
				# Tab-switch action
				if (!$editing) {
					# Can't skip around freely at create time,
					# must use previous and next
					return;
				}
				$sc = $results[1];
				if (!in_array($cc, $this->categoryOrder)) {
					# Hack attempt, ignore
					return;
				}
				$this->restorePost($sc);	
				$this->categoryPageGenerator($sc, false);
			}	
		}
		if (!strlen($cc)) {
			foreach ($this->categoryOrder as $c) {
				if ($this->isSetup($c)) {
					$cc = $c;
					break;
				}
			}
		}
		if (!strlen($cc)) {
			# No appropriate category pages were found
			return;
		}	
		$this->categoryPageGenerator($cc, false);
	}
	function copyPost()
	{
		# Leave potentially confusing action verbs out of
		# copies of the $_POST array used to restore
		# "work in progress" on tabs when re-calling
		# html callbacks on a tab switch
		$copy = array();
		foreach ($_POST as $key=>$val) {
			if (!preg_match('/^login_/', $key)) {
				$copy[$key] = $val;
			}
		}		
		return $copy;
	}
	# Restore POST environment on tab switch, without tripping a warning
	function restorePost($nc)
	{
		if (!isset($_SESSION['login_categories'])) {
			$_POST = array();
			return;
		}
		if (!isset($_SESSION['login_categories'][$nc])) {
			$_POST = array();
			return;
		}
		if (!isset($_SESSION['login_categories'][$nc]['POST'])) {
			$_POST = array();
			return;
		}
		$_POST = $_SESSION['login_categories'][$nc]['POST'];
	}
	# Get a session variable if it is set, without tripping a warning
	function getSession($var)
	{
		if (isset($_SESSION[$var])) {
			return $_SESSION[$var];
		} else {
			return false;
		}	
	}
	function categoryPageGenerator($category, 
		$error = false, 
		$hints = array())
	{
		global $loginSettings;
		if ($this->loggedIn) {
			foreach ($this->categoryOrder as $c) {
				if ($this->isEditable($c)) {
					$tabs[] = array(
						'current' => 
							($category === $c),
						'label' =>
							$this->categories[$c]['label'],
						'name' => $c
					);
				}
			}
			require 'chrome/login_settings_head.php';
		} else {
			$found = false;
			foreach ($this->categoryOrder as $c) {
				if (!$this->isSetup($c)) {
					continue;
				}
				if ($this->isDone($c)) {
					continue;
				}
				if ($found && (!isset($next))) {
					$next = $c;
				}
				if ($c === $category) {
					$found = true;	
					if (isset($lastc)) {
						$previous = $lastc;
					}
				}
				$lastc = $c;
			}
			require 'chrome/login_create_head.php';
		}
		$result = $this->categoryCallback($category, 'html', 
			array(
				isset($_SESSION['id']) ? 
					$_SESSION['id'] : false,
				$hints));
		if (is_array($result) && ($result[0] === 'loginDataCancel')) {
			$message = $result[1];
			require 'chrome/category_page_failed.php';
		} elseif (is_array($result) && ($result[0] === 'loginDataValid')) {
			# All is well
		} else {
			$message = "Unknown return code from html callback for category $category";
			require 'chrome/category_page_failed.php';
		}
		if ($this->loggedIn) {
			require 'chrome/login_settings_tail.php';
		} else {
			require 'chrome/login_create_tail.php';
		}	
		# Independent page, that's enough
		exit(0);
	}

	function commitProtoAccount()
	{	
		global $loginSettings;
		$sessionData = loginSerializeSession();
		$qresult = $this->dbQuery("UPDATE " . $loginSettings['table'] .
			" SET data = ? WHERE id = ?", 
			array($sessionData, $_SESSION['login_proto']['id']));
		if ($this->dbIsError($qresult)) {
			# TODO: flunk creation of entire account in this 
			# situation (which is unlikely unless the database
			# has become unresponsive)
		}	
		if ($_SESSION['login_proto']['invited']) {
			# Invited users are preverified,
			# but might still need approval
			$query = "UPDATE " . $loginSettings['inviteTable'] .
				" SET iaccepted = 'Y' WHERE email = ?";
			$qresult = $this->dbQuery($query, 
				array($_SESSION['login_proto']['email']));
			if ($loginSettings['accountApproval']) {
				$this->approvalNeededNotice(true);
			} else {
				$this->inviteComplete($_SESSION['login_proto']['id'], 
					$_SESSION['login_proto']['email']);
				# Log the user in
				$userData = $this->loadUserDataBody(
					false, false, false, $_SESSION['login_proto']['id'], false, false);
				$this->mergeIfApproved($userData);
				$this->send('invite_completed');
			}
			require 'chrome/account_creation_succeeded.php';
		} else {
			$verificationUrl = 
				$loginSettings['siteBase'] . $this->url . 
				"?loginconfirm=" . $_SESSION['login_proto']['verify'];
			$body = loginMacros($loginSettings['verificationBody']);
			$body = preg_replace(
				'/VERIFICATION_URL/', 
				$verificationUrl, $body);
			$realname = $_SESSION['login_proto']['realname'];
			$email = $_SESSION['login_proto']['email'];
			loginMail(
				"$realname <$email>", 
				loginMacros($loginSettings['verificationSubject']),
				$body);
			require 'chrome/login_confirm_required.php';
		}
		return;
	}

	function blockedAddress($address)
	{
		global $loginSettings;
		# Blocked domain
		$matches = array();
		if (preg_match('/\@(.*?)$/', $address, $matches)) {
			$domain = $matches[1];
			if ($this->dbContains(
				$loginSettings['blockTable'],
				'block',
				$domain)) 
			{
				return true;
			}
		} 
		# Blocked address
		if ($this->dbContains(
			$loginSettings['blockTable'],
			'block',
			$address)) 
		{
			return true;
		}
		return false;
	}
	function validateNewPasswords($errors)
	{
		$password1 = $_POST['password1'];
		# 2.0: don't potentially display the same message twice
		# for bad passwords
		if (!preg_match($this->validPassword, $password1)) {
			$errors[] = $this->text('invalid_password');
		} elseif (strlen($password1) < $this->minPassword) {
			$errors[] = $this->text('invalid_password');
		} elseif (strlen($password1) > $this->maxPassword) {
			$errors[] = $this->text('invalid_password');
		}	
		$password2 = $_POST['password2'];
		if ($password1 != $password2) {
			$errors[] = $this->text('passwords_do_not_match');
		}	
		return $errors;
	}
	function forgot($message)
	{
		global $loginSettings;
		require 'chrome/reset_password_request.php';
		return;
	}		

	function resetRequest()
	{
		global $loginSettings;
		$email = $_POST['email'];
		if (!preg_match($this->validEmail, $email)) {
			$this->forgot($this->text('invalid_email'));
			return;
		}
		$guid = $this->setVerify($email);
		if (!$guid) {
			$this->forgot($this->text('incorrect_email'));
			return;
		}
		$resetUrl = 
			$loginSettings['siteBase'] . $this->url . 
			"?loginresetconfirm=$guid";
		$body = loginMacros($loginSettings['resetBody']);
		$body = preg_replace(
			'/RESET_URL/', 
			$resetUrl, $body);
		$data = $this->loadUserDataBody($email, false, false, false, false, false);
		$realname = $data['realname'];
		loginMail(
			"$realname <$email>", 
			loginMacros($loginSettings['resetSubject']),
			$body);
		require 'chrome/reset_password_sent.php';
		return;
	}		
	function setVerify($email)
	{
		global $loginSettings;
		$guid = $this->createGuid();
		$query = "UPDATE " . $loginSettings['table'] . 
			" SET verify = ? WHERE email = ?";
		$result = $this->dbQuery($query, array($guid, $email));
		if (($this->dbIsError($result)) || ($this->dbAffectedRows() == 0)) {
			return false;
		}
		return $guid;
	}
	function reset($message)
	{
		if (!$this->confirm($_GET, 'loginresetconfirm', true)) {
			$this->send('bad_confirm');
			return;
		}
		# confirm validated this, it's safe as a form field now
		$resetPasswordGuid = $_GET['loginresetconfirm'];
		
		require 'chrome/reset_password.php';
		return;
	}

	function resetSubmit()
	{
		global $loginSettings;
		# Borrow the password validator callback again
		$presult = $this->passwordValidator('password', false);
		$errors = array();
		if ($presult[0] !== 'loginDataValid') {
			$errors = $presult[1];
		}
		if (count($errors)) {
			# Display the form again
			$message = implode("<p>\n", $errors);
			$resetPasswordGuid = $_POST['resetpasswordguid'];
			# Watch out for attempted exploits before we
			# stuff this back into a hidden form field
			if (!preg_match($this->validGuid, 
				$resetPasswordGuid)) 
			{
				require 'chrome/bad_confirm.php';
			} else {
				$this->noPrompt = true;
				require 'chrome/reset_password.php';
			}
			return;
		}
		$data = $this->confirm($_POST, 'resetpasswordguid', false);
		if (!$data) {
			$this->send('bad_confirm');
			return;
		}
		$id = $data['id'];
		$password = $_POST['password1'];
		$query = "UPDATE " . $loginSettings['table'] . 
			" SET password = ? WHERE id = ?";
		$result = $this->dbQuery($query, array($password, $id));
		if ($this->dbIsError($result)) {
			$this->send('bad_confirm');
			return;
		}
		# Don't worry about dbAffectedRows, 0 is a normal
		# response if the user "resets" their password to
		# the same password.
		$this->send('password_reset_success');
	}

	function closeWriter($category, $id, $data)
	{
		global $loginSettings;
		if (!(isset($data['close']) && ($data['close'] == 1))) {
			return array('loginDataValid');
		}
		if ($_SESSION['admin']) {
			return array('loginDataCancel', 
				$this->text('do_not_close_admin_account'));
		}
		$query = "UPDATE " . $loginSettings['table'] . 
			" SET closed = 'Y' WHERE id = ?";
		$result = $this->dbQuery($query, array($id));
		if ($this->dbIsError($result)) {
			return array('loginDataCancel', $this->text('database_busy'));
		}
		$_SESSION['closed'] = true;
		return array('loginDataValid');
	}

	function confirm($array, $field, $keepGuid)
	{
		global $loginSettings;
		$code = $array[$field];
		# 2.0: share loadUserData implementation
		$userData = $this->loadUserDataBody(
			false, false, false, false, false, $code);
		# Don't let them use the same verification GUID for
		# two operations
		if (!$userData) {
			return false;
		}
		if (!$keepGuid) {
			$email = $userData['email'];
			$query = "UPDATE " . $loginSettings['table'] . 
				" SET verified = TRUE, verify = \"\" WHERE email = ?";
			$result = $this->dbQuery($query, array($email));
			if ($this->dbIsError($result)) {
				return false;
			}
		}
		return $userData;
	}	

	function suggestUser($name)
	{
		global $loginSettings;
		# Efficiently search for an unclaimed username without
		# making a potentially large number of queries. This
		# algorithm is overkill for most sites, but isn't it
		# nice to know you can handle millions of Jennifers
		# in an efficient manner?
		$base = 1;
		for ($places = 0; ($places < 9); $places++) {
			$num = rand(0, ($base * 10) - 1);
			$idea = "$name$num";
			if (!$this->dbContains($loginSettings['table'], 'user', $idea)) {
				return $idea;
			}	
			$base *= 10;	
		}
		# If your choice of name is so common that following
		# it with a random number between 0 and 999,999,999
		# STILL doesn't give you a unique result, we can't 
		# help you. This will never happen - but let's be thorough.
		return "TRY ANOTHER NAME";
	}

	function idValid()
	{
		return (isset($_SESSION['id']) &&
			(strlen($_SESSION['id'])));
	}
	function go()
	{
		global $loginSettings;
		# Usernames and outside email addresses
		# are both acceptable logons
		# Start out assuming a username
		$user = $_POST['user'];
		$email = false;
		if (preg_match($this->validEmail, $user)) {
			# Email address
			$email = $user;	
			$user = false;
		} elseif (($loginSettings['usernames']) && 
			(preg_match($this->validUser, $user))) {
			# Not an email address, but a valid username
		} else {
			# Neither
			$this->loginFailed = true;
			return;
		}
		$password = $_POST['password'];
		if (!preg_match($this->validPassword, $password)) {
			$this->loginFailed = true;
			return;
		}
		$userData = $this->loadUserDataBody($email, $user, $password, false, false, false);
		$this->mergeIfApproved($userData);	
		if ($this->idValid()) {
			if (isset($_POST['rememberme'])) {
				$cookie = $this->createGuid();
				$query = 'UPDATE ' . $loginSettings['table'] . 
					' SET rememberme = ? WHERE id = ?';
				$result = $this->dbQuery($query, 
					array($cookie, $_SESSION['id']));	
				# Follow Google's policy by default
				$rememberTime = loginParameter('rememberTime');
				setcookie('accountify_rememberme', 
					$cookie,	
					strtotime("+$rememberTime"),
					$this->getRememberPath(),
					$this->getRememberDomain());
			} else {
				# 2.0: explicitly unset it if the user
				# DOESN'T check the box.
				$this->unsetRememberMe();
			}
		}
	}
	function unsetRememberMe()
	{
		# 2.0: missing global statement broke this, grr
		global $loginSettings;
		setcookie('accountify_rememberme', 
			'',
			time() - 42000,
			$this->getRememberPath(),
			$this->getRememberDomain());
		unset($_COOKIE['accountify_rememberme']);
		# Don't let the stale cookie hang around in the
		# database either. Just in case the cookie delete
		# doesn't work on the client.
		$query = 'UPDATE ' . $loginSettings['table'] . 
			' SET rememberme = NULL WHERE id = ?';
		$result = $this->dbQuery($query, 
			array($_SESSION['id']));	
	}
	# 1.2: one function shared by all login mechanisms
	function mergeIfApproved($userData)
	{
		global $loginSettings;
		if ($userData === NULL) {
			$this->loginFailed = true;
			return false;
		}
		if (!$userData['user']) {
			$this->loginFailed = true;
			return false;
		}
		if (!$userData['verified']) {
			$this->loginFailed = true;
			$this->unverified = true;
			return false;
		}	
		if ($this->blockedAddress($userData['email'])) {
			$this->loginFailed = true;
			return false;
		}
		if (isset($userData['closed']) && ($userData['closed'])) {
			$this->loginFailed = true;
			return false;
		}
		# 1.2: provision for manual account approval
		if ($loginSettings['accountApproval'] && 
			(!$userData['approved']) &&
			($userData['email'] !== $loginSettings['adminemail']))
			
		{
			$this->loginFailed = true;
			$this->approvalNeeded = true;
			return false;
		}
		$this->mergeUserData($userData);
		# Counting login sessions might be useful for other
		# purposes, but we do it mainly to ensure that
		# a new logon triggers loginSaveUserData at least once,
		# guaranteeing that the user is not purged as an idle user

		# 1.01: 2007-06-21: SESSIONS was a typo
		if (!isset($_SESSION['sessions'])) {
			$_SESSION['sessions'] = 1;
		} else {
			$_SESSION['sessions']++;
		}
		return true;
	}
	function logout($killCookie) 
	{
		global $loginSettings;
		# We have to kill the session array, unset the cookie,
		# and delete the session file (which session_destroy does
		# for us). If $killCookie is not set do a soft kill -
		# empty the session, but don't trash the cookie. We might
		# log the user in later in this same access (example:
		# login confirmation code entry). Or we might want to
		# use the session in other guest-user-oriented ways
		# during the same access.

		# 1.1: always kill the persistent "remember me on this 
		# computer" cookie on an explicit logout
		if (isset($_COOKIE['accountify_rememberme'])) {
			$this->unsetRememberMe();
		}
		if ($killCookie) {
			# Go hardcore. We don't use this in 1.02,
			# but keep it around in case a legitimate need
			# is discovered
			$_SESSION = array();
			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time()-42000, '/');
			}
			session_destroy();
		} else {
			# Remove all non-guest fields from the session
			# on logout
			$keys = array();
			foreach ($_SESSION as $key=>$val) {
				if (!isset($this->guestFields[$key])) {
					$keys[] = $key;
				}
			}	
			foreach ($keys as $key) {
				unset($_SESSION[$key]);	
			}
		}
		$this->loggedIn = false;
		return;
	}

	function createGuid()
	{
		$guid = "";
		for ($i = 0; ($i < 8); $i++) {
			$guid .= sprintf("%02x", mt_rand(0, 255));
		}
		return $guid;
	}

	function mergeUserData($userData)
	{
		global $loginSettings;
		# Now pull everything in $userData 
		# into $_SESSION
		if ((!$userData) || ($userData['closed'] === 'Y')) {
			# 2.01: make sure $_SESSION['id'] gets unset
			# if it belongs to a deleted user or closed
			# account. This immediately invalidates any
			# lingering sessions belonging to deleted users.
			$this->logout(false);
			return;
		}
		foreach ($userData as $key=>$val) {
			$_SESSION[$key] = $val;
		}	
		$this->loggedIn = true;
		# 1.2: make it easy to detect that the user is the admin
		$_SESSION['admin'] = false;
		if ($_SESSION['email'] === $loginSettings['adminemail']) {
			$_SESSION['admin'] = true;
		}
		if (!$this->alreadyRegistered) {
			register_shutdown_function('loginSaveUserData');
			$this->alreadyRegistered = true;
		}
	}

	function loadUserData($id)
	{
		# 1.04: left out $this->
		return $this->loadUserDataBody(false, false, false, $id, false, false);
	}

	function loadUserDataBody($email, $user, $password, $id, $rememberme, $verify)
	{
		global $loginSettings;
		$params = array();
		$query = "SELECT user, email, data, id, closed, approved, " .
				"realname, invitations, usedinvitations, " .
				"invitedby, verified FROM " 
				. $loginSettings['table'] . " ";
		if ($user) {
			$query .= "WHERE user = ?";
			$params[] = $user;
		} elseif ($email) {
			$query .= " WHERE email = ?";
			$params[] = $email;
		} elseif ($id) { 
			$query .= " WHERE id = ?";
			$params[] = $id;
		} elseif ($rememberme) { 
			$query .= " WHERE rememberme = ?";
			$params[] = $rememberme;
		} elseif ($verify) {
			$query .= " WHERE verify = ?";
			$params[] = $verify;
		} else {
			# 2.0: don't return the first user in the db
			# for a blank query. Fortunately there were no 
			# exploits available
			return NULL;
		}
		# If there is a password present, we're verifying a login.
		# Note that we already rejected the password by regexp
		# if it was empty, so this is safe

		# 1.01: 2007-06-21: check 'closed' in PHP rather than SQL,
		# the SQL string inequality operator wasn't cooperating
		if ($password) {
			$query .= " AND password = ?";
			$params[] = $password;
		}
		$result = $this->dbQuery($query, $params);
		$userData = NULL;
		if ($this->dbIsError($result)) {
			# 2.0: catch the case where setup.php has
			# not been run
			if ($result->getMessage() === 
				'DB Error: no such table') 
			{
				$this->send('visit_setup_first');
				exit(0);
			} else {
				return $userData;
			}
		}
		if (!count($result)) {
			return $userData;
		}
		$user = $result[0]['user'];
		$email = $result[0]['email'];
		$id = $result[0]['id'];
		$verified = false;
		if ($result[0]['verified']) {
			$verified = true;
		}
		$approved = $result[0]['approved'];
		$userDataString = $result[0]['data'];
		$closed = $result[0]['closed'];
		$invitations = $result[0]['invitations'];
		$usedinvitations = $result[0]['usedinvitations'];
		$invitedby = $result[0]['invitedby'];
		$userData = unserialize($userDataString);
		$this->oldData = $userDataString;
		# 1.2: pull real name from db now, but if it's
		# not there check the old serialized data - then 
		# push it to the database so it doesn't get lost forever
		$realname = $result[0]['realname'];
		if ($realname === '') {
			$realname = $userData['realname'];
			if ($realname !== '') {
				$this->dbQuery("UPDATE " . $loginSettings['table'] .
					" SET realname = ? WHERE id = ?",
					array($realname, $id)); 
			}	
		}
		$userData['user'] = $user;
		$userData['email'] = $email;
		$userData['id'] = $id;
		$userData['verified'] = $verified;
		$userData['realname'] = $realname;
		$userData['login_invitations'] = 
			$invitations - $usedinvitations;
		$userData['login_invitedby'] = $invitedby;
		if ($closed === 'Y') {
			$userData['closed'] = true;
		} else {
			# 2.0: pass the isset test
			$userData['closed'] = false;
		}
		if ($approved === 'Y') {
			$userData['approved'] = true;
		} else {
			$userData['approved'] = false;
		}
		return $userData;
	}

	function text($name)
	{
		# 1.01: 2007-06-21: we need to find this relative to 
		# login.php, not relative to the page. However,
		# the user may have set it up relative to the
		# page, so try that if the first method
		# fails.
	
		$path = __FILE__; 
		$path = preg_replace("/\/[\w\.\-\+]+$/", '', $path);
		$path .= "/chrome/$name.txt";
		# DEBUG remove for production use
		if ($name === 'database_busy') {
			return $this->dbLastError;
		}
		if (is_file($path)) {
			return file_get_contents($path);
		} else {
			return file_get_contents("chrome/$name.txt");
		}
	}

	function send($required_file_name)
	{
		global $loginSettings;
		# DEBUG remove for production use
		if ($required_file_name === 'database_busy') {
			echo("<pre>" . $this->dbLastError . "</pre>\n");
		}
		require "chrome/$required_file_name.php";
	}

	function prompt()
	{
		global $loginSettings;
		echo("<div class=\"login\">\n");
		$message = '';
		do {
			if (isset($_POST['logout'])) {
				$this->send('logged_out');
				continue;
			}
			if (isset($_POST['login'])) {
				if ($this->loginFailed) {
					if ($this->approvalNeeded) {
						$this->send('not_approved_yet');
						continue;
					} elseif ($this->unverified) {
						$this->send('not_verified_yet');
						continue;
					} else {
						$this->send('incorrect_login');
						continue;
					}
				}
			}
			if ($this->confirmAttempt) {
				if ($this->confirmed) {
					if ($this->approvalNeeded) {
						$this->approvalNeededNotice(false);
					} else {
						$this->send('confirmed');
					}
				} else {
					$this->send('bad_confirm');
				}
				continue;
			}
			if (isset($_GET['loginforgot'])) {
				$this->forgot(false);
				$this->noPrompt = true;
				continue;
			}
			if (isset($_POST['loginresetrequest'])) {
				$this->resetRequest();
				# 2.0: keep the prompt, they might remember
				# $this->noPrompt = true;
				continue;
			}
			if (isset($_POST['loginresetsubmit'])) {
				$this->resetSubmit();
				continue;
			}
			if (isset($_GET['loginresetconfirm'])) {
				$this->reset(false);
				continue;
			}
		} while (false);
		if ($this->noPrompt) {
			echo("</div>\n");
			return;
		}
		if (!$this->loggedIn) {
			$this->send('login_prompt');
			echo("</div>\n");
			return;
		} else {
			$this->send('already_logged_in');
			echo("</div>\n");
			return;
		}	
	}
	function approvalNeededNotice($page)
	{
		global $loginSettings;
		$name = loginParameter('adminname');

		$email = loginParameter('adminemail');

		$body = loginMacros(
				loginParameter('approvalBody'));
		loginMail("$name <$email>",
			loginMacros(
				loginParameter('approvalSubject')),
			$body);
		if ($page) {
			$this->send('approval_required_full_page');		
		} else {
			$this->send('approval_required');
		}
	}
	function pickUsername()
	{
		global $loginSettings;
		$user = '';
		require 'chrome/pick_username.php';
		exit(0);
	}

	function validateNewUsername($errors)
	{
		global $loginSettings;
		if (isset($_SESSION['id']) && (!preg_match('/^XGUIDX/', $_SESSION['user']))) {
			$errors[] = $this->text('username_already_set');
			return $errors;
		}
		if (!$loginSettings['usernames']) {
			$errors[] = $this->text('usernames_not_used_here');
			return $errors;
		}
		$user = $_POST['user'];
		if (!preg_match($this->validUser, $user)) {
			$errors[] = $this->text('invalid_user_name_regexp');
		} 
		if (strlen($user) > $this->maxUser) {
			$errors[] = $this->text('invalid_user_name_length');
		}	
		return $errors;
	}

	function pickUsernameSubmit()
	{
		global $loginSettings;
		if (isset($_SESSION['id']) && (!preg_match('/^XGUIDX/', $_SESSION['user']))) {
			# Ignore attempt to change already-set username
			return;
		}
		if (!loginParameter('usernames')) {
			# Ignore attempt to set username when
			# usernames are not in use
			return;
		}
		$errors = array();
		$errors = $this->validateNewUsername($errors);
		if (count($errors)) {
			# Display the form again
			$user = $this->post('user');
			$message = implode("<p>\n", $errors);
			require 'chrome/pick_username.php';
			exit(0);
		}
		$user = $this->post('user');
		$query = "UPDATE " . $loginSettings['table'] . 
			" SET user = ?, verify = \"\" WHERE id = ?";
		$result = $this->dbQuery($query, array($user, $_SESSION['id']));
		if ($this->dbIsError($result)) {
			// Is it a duplicate key error?
			if ($result->getMessage() == 'DB Error: already exists') {
				// Duplicate username, suggest another
				$user = $this->suggestUser($user);	
				$text = $this->text('name_already_in_use');
				$text = preg_replace('/SUGGESTED_NAME/', $user, $text);
				$message = $text;
				require 'chrome/pick_username.php';
				exit(0);
			} else {
				# Don't let the user sneak in until they set their username
				$this->logout(false);
				$this->send('database_busy');
				return;
			}
		}
		$_SESSION['user'] = $user;
		# Triumph
		require 'chrome/username_set.php';
	}

	function settings($message)
	{
		global $loginSettings;
		if (!strlen($_SESSION['id'])) {
			$this->send('must_be_logged_in');
			return;
		}
		$category = 'general';
		$ncategory = loginGetOrPost('category');
		if (strlen($ncategory)) {
			$category = $ncategory;
		}
		$email = $_SESSION['email'];
		$realname = $_SESSION['realname'];
		require 'chrome/settings.php';
		return;
	}		

	function fromNewestSource($id, $hints, $key)
	{
		$result = false;
		if (strlen($id) && isset($_SESSION[$key])) {
			$result = $_SESSION[$key];
		}	
		if (isset($_POST[$key])) {
			$result = $_POST[$key];
		}	
		if (isset($hints[$key])) {
			$result = $hints[$key];
		}
		return htmlspecialchars($result);
	}

	function captchaHtml($category, $id, $hints)
	{
		require 'chrome/create_captcha.php';
		return array('loginDataValid');
	}

	function captchaValidator($category, $id)
	{
		$errors = array();
		$code = 'loginDataValidDone';
		if ($this->post('captcha') !== 
			$_SESSION['captchacode']) 
		{
			$errors[] = $this->text('bad_captcha');
		} else {
			captchaDone();
		}
		return $this->errorsOrResult($errors, array(), $code);
	}
	
	function generalHtml($category, $id, $hints)
	{
		global $loginSettings;	
		$user = $this->fromNewestSource($id, $hints, 'user');
		$email = $this->fromNewestSource($id, $hints, 'email');
		$realname = $this->fromNewestSource($id, $hints, 'realname');
		if (strlen($id)) {
			require 'chrome/settings_general.php';
		} else {
			$password1 = htmlspecialchars(
				$this->post('password1'));
			$password2 = htmlspecialchars(
				$this->post('password2'));
			if (isset($_SESSION['inviteCode'])) {
				$inviteCode = $_SESSION['inviteCode'];
			}
			if (isset($_SESSION['inviteEmail'])) {
				$inviteEmail = $_SESSION['inviteEmail'];
			}
			require 'chrome/create_general.php';
		}
		return array('loginDataValid');
	}

	function passwordHtml($category, $id, $hints)
	{
		# We prep password1 and password2 to be sent out as defaults.
		# chrome/settings_password.php is smart enough not to 
		# actually do that, because we don't want an unattended
		# terminal to be a password equivalent (they need your
		# email account too to effectively steal your Accountify
		# account). However it's fine to redisplay in
		# chrome/create_password.php.

		$password1 = $this->fromNewestSource($id, $hints, 'password');
		$password2 = $password1;
		if (strlen($this->post('password1'))) {
			$password1 = $this->post('password1');
		}
		if (strlen($this->post('password2'))) {
			$password2 = $this->post('password2');
		}
		require 'chrome/settings_password.php';
		return array('loginDataValid');
	}

	function closeHtml($category, $id, $hints)
	{
		# Nothing there but a checkbox
		require 'chrome/settings_close.php';
		return array('loginDataValid');
	}

	function generalValidator($category, $id)
	{
		global $loginSettings;
		$hints = array();
		$result = array();
		$code = 'loginDataValid';
		$errors = array();
		$realname = $this->post('realname');
		$data = array();
		if (!preg_match($this->validRealName, $realname)) {
			$errors[] = $this->text('invalid_real_name_regexp');
		} 
		if (strlen($realname) > $this->maxRealName) {
			$errors[] = $this->text('invalid_real_name_length');
		}
		$result['realname'] = $realname;
		$email = false;
		if ($loginSettings['changeEmail'] || (!strlen($id))) {
			$email = false;
			if ((!strlen($id) && isset($_SESSION['inviteEmail']))) {
				$email = $_SESSION['inviteEmail'];
			} else {
				if (isset($_POST['email'])) {
					$email = $_POST['email'];
				}
				if (!preg_match($this->validEmail, $email)) {
					$errors[] = $this->text('invalid_email');
				} 
				if (strlen($email) > $this->maxEmail) {
					$errors[] = $this->text('invalid_email');
				}
			}
			# You need a password to change your existing
			# email address.
			if (strlen($id) && ($_SESSION['email'] !== $email)) {
				$code = 'loginDataValidWithPassword';
			}
			if ($this->blockedAddress($email)) {
				$errors[] = $this->text('address_blocked');
			}	
			$result['email'] = $email;
		}
		$user = false;
		if ((!strlen($id)) && $loginSettings['usernames']) {
			$user = $this->post('user');
			if (!preg_match($this->validUser, $user)) {
				$errors[] = $this->text('invalid_user_name_regexp');
			} 
			if (strlen($user) > $this->maxUser) {
				$errors[] = $this->text('invalid_user_name_length');
			}	
			if (in_array($user, 
				$loginSettings['forbiddenusers']))
			{
				$errors[] = $this->text('reserved_user_name');
			}
			
		} else {
			// If we don't have user-selected usernames,
			// then generate a unique one anyway, for
			// ease of coding. 
			//
			// Give it a prefix to make it easier to
			// recognize a randomly generated username 
			// later if the admin decides user-selected 
			// usernames are needed after all.
			if (!strlen($id)) {
				$user = "XGUIDX" . $this->createGuid();
			}
		}
		if ((!strlen($id)) || (($email !== $_SESSION['email']) &&
			(strlen($email)))) {
			if ($this->dbContains(
				$loginSettings['table'],
				'email',
				$email))
			{
				$errors[] = $this->text('email_already_in_use');
			}
		}
		if (!strlen($id)) {
			if ($this->dbContains(
				$loginSettings['table'],
				'user',
				$user))
			{
				$text = $this->text('name_already_in_use');
				$user = $this->suggestUser($user);	
				$text = preg_replace('/SUGGESTED_NAME/', $user, $text);
				$errors[] = $text;
				$hints['user'] = $user;
			}
		}
		# We handle passwords here only in the create case
		if (!strlen($id)) {
			$presult = $this->passwordValidator($category, false);
			# array_merge doesn't work the way I think it does,
			# so let's not use it.
			if ($presult[0] === 'loginDataInvalid') {
				foreach ($presult[1] as $e) {
					$errors[] = $e;
				}
			} else {
				foreach ($presult[1] as $key=>$val) {
					$result[$key] = $val;
				}
			}
		}
		if (strlen($user)) {
			$result['user'] = $user;
		}
		return $this->errorsOrResult($errors, $result, $code, $hints);
	}
	# Get a POST key if it is present, without tripping a warning
	# when it isn't
	function post($key)
	{
		if (isset($_POST[$key])) {
			return $_POST[$key];
		}
		return false;
	}
	function passwordValidator($category, $id)
	{
		$result = array();
		$code = 'loginDataValid';
		$errors = array();
		$password1 = $this->post('password1');
		if (strlen($password1)) {
			$password2 = $this->post('password2');
			if ($password1 !== $password2) {
				$errors[] = $this->text('passwords_do_not_match');
			} else {
				if (!preg_match($this->validPassword, $password1)) {
					$errors[] = $this->text('invalid_password');
				} 
				if (strlen($password1) < $this->minPassword) {
					$errors[] = $this->text('invalid_password');
				}
				if (strlen($password1) > $this->maxPassword) {
					$errors[] = $this->text('invalid_password');
				}
			} 
			$result['password'] = $password1;
			$code = 'loginDataValidWithPassword';
		}
		if (!strlen($id)) {
			# We're being called from generalValidator,
			# which handles passwords only on 
			# initial account creation. Require a password,
			# and return a little bit differently.	

			# Must supply a password for a new account.
			# For an existing account it's fine to leave the
			# field blank and make no changes.
			if (!isset($result['password'])) {
				$errors[] = $this->text('invalid_password');
			}
			if (count($errors)) {
				return array('loginDataInvalid', $errors);
			} else {
				return array('loginDataValid', $result);
			}
		}
		$result = $this->errorsOrResult($errors, $result, $code);
		return $result;
	}
	function errorsOrResult($errors, $result, $code, $hints = array())
	{
		if (is_array($errors) && count($errors)) {
			$error = implode("\n<p>\n", $errors);
			return array('loginDataInvalid', $error, $hints);
		} else {
			return array($code, $result);
		}

	}

	function closeValidator($category, $id)
	{
		if (isset($_POST['close_confirm']) &&
			($_POST['close_confirm'] == 1)) {
			return array('loginDataValidWithPassword', 
				array('close' => 1));
		} else {
			return array('loginDataValid',
				array());
		}
	}

	function generalWriter($category, $id, $data)
	{
		if (strlen($id)) {
			return $this->generalSettingsWriter($id, $data);
		} else {
			return $this->generalCreateWriter($data);
		}
	}

	function generalEraser($category, $id, $deleting)
	{
		global $loginSettings;
		if (!$deleting) {
			return;
		}	
		$query = 'DELETE FROM ' . $loginSettings['table'] .
			' WHERE id = ?';
		$this->dbQuery($query, array($id));
	}

	function generalSettingsWriter($id, $data)
	{
		global $loginSettings;		
		$query = "UPDATE " . $loginSettings['table'] . " SET ";
		$params = array();
		$clauses = array();
		if (isset($data['realname']))
		{
			$clauses[] = 'realname = ?';
			$params[] = $data['realname'];
		}
		if (isset($data['email'])) 
		{
			$clauses[] = 'email = ?';
			$params[] = $data['email'];
		}
		$query .= implode(', ', $clauses);
		if (count($params)) {
			$params[] = $id;
			$qresult = $this->dbQuery($query . " WHERE id = ?",
				$params);
			if ($this->dbIsError($qresult)) 
			{
				$message = $this->text('database_busy');
				if ($qresult->getMessage() == 
					'DB Error: already exists') 
				{
					$message = $this->text('email_already_in_use');
					return array(
						'loginDataInvalid',
						$message);	
				} else {
					$message = $this->text('database_busy');
					return array(
						'loginDataCancel',
						$message);
				}
			} 
			if (isset($data['realname'])) {
				$_SESSION['realname'] = $data['realname'];
			}
			if (isset($data['email'])) {
				$_SESSION['email'] = $data['email'];
			}
		}
		return array('loginDataValid');
	}

	function generalCreateWriter($data)
	{
		global $loginSettings;
		$errors = array();
		if (isset($_SESSION['inviteCode'])) {
			$inviteCode = $_SESSION['inviteCode'];
		} else {
			$inviteCode = false;
		}
		$invited = false;
		$invitedBy = false;
		if (strlen($inviteCode)) {
			$query = 'SELECT iby FROM ' . 
				$loginSettings['inviteTable'] .
				' WHERE code = ? AND email = ?';
			$result = $this->dbQuery($query, 
				array($inviteCode, $_SESSION['inviteEmail']));
			if ($this->dbIsError($result)) {
				$errors[] = $this->text('database_busy');
			} else {
				if (count($result)) {
					$invitedBy = $result[0]['iby'];
					$invited = true;
				}
			}
		} 
		# DON'T let people sneak in by forging a
		# new account form submission. 
		# DO let people accept invitations.
		if (($loginSettings['invitationOnly']) && (!$invited)) 
		{
			return array(
				'loginDataCancel',
				$this->text('by_invitation_only'));	
		} 
		if (!count($errors)) {
			// Generate a random string. The user has to come
			// back with this string in their verification URL. This
			// imposes the delay of waiting for the email and slows down 
			// automated spammers... a little bit. It also at least
			// temporarily gives us a way to get back in touch with the
			// user, but take care not to abuse that privilege or
			// you'll offend your customers.
			$verificationCode = false;
			$verified = false;
			if ($invited) {
				$verified = true;
			} else {
				$verificationCode = $this->createGuid();
			}
			$approved = 'Y';
			$password = $data['password'];
			$email = $data['email'];
			$user = $data['user'];
			$realname = $data['realname'];
			if ($loginSettings['accountApproval']) {
				$approved = 'N';
			} 	
			$id = $this->createGuid();
			$sdata = $_SESSION;
			$result = $this->dbQuery(
				"INSERT INTO " . $loginSettings['table'] .
				"  (id,\n" .
				"    user,\n" .
				"    password,\n" .
				"    email,\n" .
				"    realname,\n" .
				"    verify,\n" .
				"    verified,\n" .
				"    approved,\n" .
				"    invitations,\n" .
				"    created,\n" .
				"    lastused,\n" .
				"    data)\n" .
				"  VALUES(\n" .
				"    ?, ?, ?, ?, ?, ?,\n" .
				"    ?, ?, ?, NOW(), NOW(), ?)",
				array($id,
					$user, $password, 
					$email, $realname,
					$verificationCode, 
					$verified,
					$approved,
					loginParameter('initialInvitations'),
					serialize($sdata))
				);
			if ($this->dbIsError($result)) {
				// Is it a duplicate key error?
				if ($result->getMessage() == 'DB Error: already exists') {
					// Is it complaining about an email address, or a
					// username? Unfortunately, we can't tell with 
					// Pear::DB. So do a test query to figure it out.
					$result = $this->dbContains(
						$loginSettings['table'],
						'email',
						$email);
					if ($result)
					{		
						// Offer to email them their login info
						$errors[] = $this->text('email_already_in_use');
					} else {
						// No, the login name is the duplicate.
						// So, suggest another one.
						$user = $this->suggestUser($user);	
						$text = $this->text('name_already_in_use');
						$text = preg_replace('/SUGGESTED_NAME/', $user, $text);
						$errors[] = $text;
					}
				} else {
					return array('loginDataCancel',
						$this->text('database_busy'));
				}
			}
		}
		if (count($errors)) {
			return array('loginDataInvalid', implode("<p>\n", $errors));
		}
		# Helpers for commitProtoAccount and generalEraser,
		# which must do the final details after we know the outcome
		# of other writers
		$_SESSION['login_proto']['verify'] = $verificationCode;
		$_SESSION['login_proto']['id'] = $id;
		$_SESSION['login_proto']['email'] = $email;
		$_SESSION['login_proto']['realname'] = $realname;
		$_SESSION['login_proto']['invited'] = $invited;
		return array('loginDataValid');
	}

	function passwordWriter($category, $id, $data)
	{
		global $loginSettings;
		$query = "UPDATE " . $loginSettings['table'] . " SET";
		$params = array();
		if (isset($data['password'])) 
		{
			$query .= ' password = ?';
			$params[] = $data['password'];
		}
		if (count($params)) {
			$params[] = $id;
			$qresult = $this->dbQuery($query . " WHERE id = ?",
				$params);
			if ($this->dbIsError($qresult)) 
			{
				return array('loginDataInvalid',
					$this->text('database_busy'));
			}
		}
		return array('loginDataValid');
	}

	function adminPage()
	{
		global $loginSettings;
		if (!$this->isAdmin()) {
			require 'chrome/admin_not.php';
			return;
		}
		$category = 'general';
		$ncategory = loginGetOrPost('login_category');
		if (strlen($ncategory)) {
			$category = $ncategory;
		}
		$categories = 
			array('general', 'invitations', 'blocks', 'close');
		foreach ($categories as $c) {
			if ($this->post("login_category_$c")) {
				$category = $c;
			}
		}		
		require 'chrome/admin_head.php';
		if ($this->post('logincount')) {
			$this->count();
		}
		if ($this->post('loginpurgeidle')) {
			$this->purgeIdle();
		}
		if ($this->post('loginpurgeunverified')) {
			$this->purgeUnverified();
		}
		if ($this->post('loginpurgestaleinvites')) {
			$this->purgeInvites(false);
		}
		if ($this->post('loginpurgeallinvites')) {
			$this->purgeInvites(true);
		}
		if ($this->post('loginaddblocks')) {
			$this->addBlocks();
		}
		if ($this->post('loginunblockdomains')) {
			$this->unblockDomains();
		}
		if ($this->post('loginremoveblocks')) {
			$this->removeBlocks();
		}
		if ($this->post('loginapprove')) {
			$this->approveAccounts();
		}
		if ($this->post('logininvitegrantall')) {
			$this->adminGrantInvitationsToAll();
		}
		if ($this->post('loginrevokeinvitations')) {
			$this->adminRevokeAllInvitations();
		}
		if ($this->post('logininvitegrant')) {
			$this->adminGrantInvitationsTo();
		}
		if ($this->post('logincloseaccounts')) {
			$this->adminCloseAccounts();
		}
		if ($this->post('loginreopenaccounts')) {
			$this->adminReopenAccounts();
		}
		require 'chrome/admin_tools.php';
		require 'chrome/admin_tail.php';
		# 2.0: the admin page is generated purely
		# by Accountify
		exit(0);
	}
	function updateInvitations()
	{
		global $loginSettings;
		$query = "SELECT invitations, usedinvitations FROM " . 
			$loginSettings['table'] . 
			" WHERE id = ?";
		$qresult = $this->dbQuery($query, array($_SESSION['id']));	
		if ($this->dbIsError($qresult)) {
			return false;
		}
		$invitations = $qresult[0]['invitations'];
		$usedinvitations = $qresult[0]['usedinvitations'];
		$avail = $invitations - $usedinvitations;
		$_SESSION['login_invitations'] = $avail;
		return true;
	}
	function purgeInvites($all)
	{
		global $loginSettings;
		$query = "DELETE FROM " . $loginSettings['inviteTable'];
		if (!$all) {
			$query .= " WHERE iwhen < " .
				"DATE_SUB(NOW(), INTERVAL 90 DAY)";
		}
		$qresult = $this->dbQuery($query);
		if ($this->dbIsError($qresult)) {
			$this->send('database_busy');
		} else {
			$purged = $this->dbAffectedRows();
			if ($all) {
				require 'chrome/purge_all_invites_complete.php';
			} else {
				require 'chrome/purge_stale_invites_complete.php';
			}
		}	
		return true;
	}
	function grantInvitations($number)
	{
		global $loginSettings;
		$query = "UPDATE " . $loginSettings['table'] . 
			" SET invitations = invitations + ? WHERE id = ?";
		$qresult = $this->dbQuery($query, 
			array($number, $_SESSION['id']));
		if ($this->dbIsError($qresult)) {
			return false;
		}
		$this->updateInvitations();
		return true;
	}
	function useInvitation()
	{
		global $loginSettings;
		if ($this->isAdmin()) {
			return true;
		}
		# The problem: users may try to invite zillions of people
		# by firing up multiple invite windows (or worse, specialized
		# browsers...) and hitting 'send' at the same time in all
		# of them. This leads to a race condition where invitations
		# can be issued two or more times before they are
		# subtracted. We combat this by decrementing the count of
		# available invitations in the same SQL query that
		# determines whether any are available.
		
		# This doesn't absolutely guarantee no race conditions can
		# occur, but in the real world it's pretty darn close and
		# makes the attack impractical.

		$query = "UPDATE " . $loginSettings['table'] . 
				" SET usedinvitations = usedinvitations + 1 " .
				"WHERE (id = ?) AND (usedinvitations < invitations)";
		$qresult = $this->dbQuery($query, array($_SESSION['id']));	
		if ($this->dbIsError($qresult)) {
			return false;
		}
		if ($this->dbAffectedRows() == 0) {
			return false;
		}
		return true;
	}
	function inviteUsersPage()
	{
		if (!$_SESSION['id']) {
			$this->send('must_be_logged_in');
			return;
		}
		global $loginSettings;
		$raw = $this->post('invitees');	
		$invitees = preg_split('/[\n\r]+/', $raw);
		if (!$this->post('login_invite_others')) {
			$invitees = array();
		}
		$nonBlank = 0;
		foreach ($invitees as $i) {
			if (strlen($i) > 0) {
				$nonBlank++;
			}
		}
		$messages = array();
		if (loginParameter('captcha') && (!$_SESSION['admin']) &&
			($nonBlank > 0))
		{
			if ((!isset($_SESSION['captchacode'])) ||
				($this->post('captcha') !== 
					$_SESSION['captchacode']))
			{
				$messages[] = $this->text('bad_captcha');
			} else {
				captchaDone();
			}
		}
		if (!count($messages)) {
			foreach ($invitees as $invitee) {
				$email = false;
				$name = false;
				if (preg_match('/^\s*(\S+)(\s+(.*))?\s*$/', $invitee,
					$matches)) 
				{
					if (count($matches) == 4) {
						list($dummy, $email, $dummy, $name) = $matches;
					} elseif (count($matches) == 2) {
						list($dummy, $email) = $matches;
					} else {		 
						# Blank line	
					}
						
				}
				if (!strlen($email)) {
					# Ignore blank lines
					continue;
				}
				if (!preg_match($this->validEmail, $email)) {
					$messages[] =
						str_replace('EMAIL', $email, 
							$this->text('bad_invite_email'));
					continue;
				}
				if (strlen($name) && 
					(!preg_match($this->validRealName, $name))) 
				{
					$messages[] =
						str_replace('REALNAME', $email, 
							$this->text('bad_invite_name'));
					continue;
				}
				$code = $this->createGuid();
				$body = loginMacros(
						loginParameter('inviteBody'));
				$address = "$name <$email>";
				if ($name !== '') {
					$address = "$email";
				}
				$query = "SELECT id FROM " .
					$loginSettings['table'] .
					" WHERE email = ?";
				$result = $this->dbQuery($query, array($email));
				if ($this->dbIsError($result)) {
					$messages[] = $this->text('database_busy');
					break;
				}
				if (count($result)) {
					$messages[] = str_replace(
						array('REALNAME', 'EMAIL'),
						array($name, $email),
						$this->text('invited_user_already_here'));
					continue;
				} 
				$query = "INSERT INTO " .
					$loginSettings['inviteTable'] .
					" (email, realname, code, iwhen, iby) VALUES (?, ?, ?, NOW(), ?)";
				$result = $this->dbQuery($query, array($email, $name, $code, $_SESSION['id']));
				if ($this->dbIsError($result)) {
					if ($result->getMessage() ===  
						'DB Error: already exists') 
					{
						if ($this->isAdmin()) {
							# The admin can re-invite people, in which case
							# we just send them their existing code
							$query = "SELECT code FROM " .
								$loginSettings['inviteTable'] .
								" WHERE email = ?";
							$result = $this->dbQuery($query, array($email));
							if ($this->dbIsError($result)) {
								$messages[] = $this->text('database_busy');
								break;
							}
							$code = $result[0]['code'];
						} else {
							# Non-admins can't invite people already invited
							$messages[] = str_replace(
								array('REALNAME', 'EMAIL'),
								array($name, $email),
								$this->text('already_invited'));
							continue;
						}
					} else { 	
						$messages[] = $this->text('database_busy');
						break;
					}
				} 
				# Careful: if we did this any earlier we'd miss the
				# change in $code when resending an existing invite as admin
				$inviteUrl = 
					loginMacros(
						loginParameter('inviteLanding')) .
					"?logininvite=$code";
				$body = preg_replace('/INVITE_URL/', 
					$inviteUrl, $body);
				if (!$this->useInvitation()) {
					# Not enough invitations available.
					# Can happen at the last minute, especially
					# if a user tries to run around us by
					# issuing invitations in multiple windows.
					$query = "DELETE FROM " .
						$loginSettings['inviteTable'] .
						" WHERE code = ?";
					$result = $this->dbQuery($query, array($code));
					$messages[] = $this->text('no_more_invitations');
					break;
				}	
				loginMail($email,
					loginMacros(
						loginParameter('inviteSubject')),
					$body);	
				$messages[] = str_replace(
					array('REALNAME', 'EMAIL'),
					array($name, $email),
					$this->text('invited'));

			}
		}
		# Resync $_SESSION['login_invitations'] with reality
		if (count($invitees)) {
			$this->updateInvitations();
		}
		require 'chrome/invite_users.php';
		exit(0);
	}
	function isAdmin() {
		global $loginSettings;
		return ($_SESSION['email'] === $loginSettings['adminemail']);
	}
	function approveAccounts()
	{
		global $loginSettings;
		if (!$this->isAdmin()) {
			require 'chrome/admin_not.php';
			return;
		}
		$approvals = $this->getIdButtons('approval');
		$dquery = "DELETE FROM " . $loginSettings['table'] . 
			" WHERE id = ?";
		$aquery = "UPDATE " . $loginSettings['table'] . 
			" SET approved = 'Y' WHERE id = ?";
		foreach ($approvals as $key=>$val) {
			if ($val === 'defer') {
				continue;
			}
			$qresult = $this->dbQuery('SELECT email, realname FROM ' .
				$loginSettings['table'] . ' WHERE id = ?',
				array($key));
			if ($this->dbIsError($qresult)) {
				$this->send('database_busy');
				break;
			}
			if (!count($qresult)) {
				# Request already deleted
				# (possibly two admin logins) 
				continue;
			}
			$email = $qresult[0]['email'];
			$realname = $qresult[0]['realname'];
			if ($val === 'deny') {
				$qresult = $this->dbQuery($dquery, array($key));
				if ($this->dbIsError($qresult)) {
					$this->send('database_busy');
					break;
				}
 			  $this->callErasers($key, true);
				$body = loginMacros(loginParameter('deniedBody'));
				loginMail("$realname <$email>", 
					loginMacros(loginParameter('deniedSubject')),
					$body);	
			} elseif ($val === 'approve') {
				$qresult = $this->dbQuery($aquery, array($key));
				if ($this->dbIsError($qresult)) {
					$this->send('database_busy');
					break;
				}
				$body = loginMacros(
						loginParameter('approvedBody'));
				loginMail("$realname <$email>", 
					loginParameter('approvedSubject'),
					$body);	
				$this->inviteComplete($key, $email);
			} else {
				# Defer, do nothing now
			}
		}
	}
	function inviteComplete($id, $email)
	{
		# Notify the application when an invitation is
		# completely and successfully accepted by a new user
		global $loginSettings;
		$query = "SELECT iby FROM " . $loginSettings['inviteTable'] .
			" WHERE email = ? AND iaccepted = 'Y'";
		$result = $this->dbQuery($query, array($email));
		if ($this->dbIsError($result)) 
		{
			$this->send('database_busy');
			return;
		}
		if (count($result)) 
		{
			$query = "UPDATE " . $loginSettings['table'] .
				" SET invitedby = ? WHERE id = ?";
			$qresult = $this->dbQuery($query, array(
				$result[0]['iby'], $id));
		}
		# The account is live, so we don't need the invite anymore
		$query = "DELETE FROM  " . $loginSettings['inviteTable'] .
			" WHERE email = ?";
		$result = $this->dbQuery($query, array($email));
	}
	function getIdButtons($prefix)
	{
		$result = array();
		foreach ($_POST as $key=>$val) {
			if (preg_match("/^$prefix(\w+)$/", $key, $results)) {
				$id = $results[1];
				$result[$id] = $val;
			}	
		}
		return $result;
	}
	function tableCreate()
	{
		global $loginSettings;
		// Possibly the table doesn't yet exist.
		// Try to create it. Has no effect if it
		// already exists, so this is harmless

		# 2.0: default to a high-capacity BLOB type in MySQL
		$blobType = 'BLOB';
		if ($loginSettings['dbtype'] === 'mysql') {
			$blobType = 'MEDIUMBLOB';
		}

		$query = "CREATE TABLE IF NOT EXISTS " .
			$loginSettings['table'] . " (\n" .
			"id CHAR(16),\n" .
			"user VARCHAR($this->maxUser),\n" .
			"realname VARCHAR($this->maxRealName),\n" .
			"password VARCHAR($this->maxPassword),\n" .
			"email VARCHAR($this->maxEmail),\n" .
			"verify VARCHAR(16),\n" .
			"verified BOOL,\n" .
			"created DATETIME,\n" .
			"lastused DATETIME,\n" .
			"data $blobType,\n" .
			"closed CHAR(1),\n" .
			"rememberme VARCHAR(16),\n" .
			"approved CHAR(1),\n" .
			"invitations INTEGER DEFAULT 0,\n" .
			"usedinvitations INTEGER DEFAULT 0,\n" .
			"invitedby VARCHAR(16),\n" .
			"PRIMARY KEY(id),\n" .
			"UNIQUE KEY(email),\n" .
			"UNIQUE KEY(user),\n" .
			"KEY(rememberme),\n" .
			"KEY(approved),\n" .
			"KEY(verified),\n" .
			"KEY(verify))";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			require 'chrome/no_credentials.php';
			return false;
		}

		$query = "CREATE TABLE IF NOT EXISTS " .
			$loginSettings['blockTable'] . " (\n" .
			"  block VARCHAR($this->maxEmail),\n" .
			"  PRIMARY KEY(block))";
			")";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			require 'chrome/no_credentials.php';
			return false;
		}

		$query = "CREATE TABLE IF NOT EXISTS " .
			loginParameter('inviteTable') . 
			" (\n" .
			"  email VARCHAR($this->maxEmail),\n" .
			"  code CHAR(16),\n" .
			"  realname VARCHAR($this->maxRealName),\n" .
			"  iwhen DATETIME,\n" .
			"  iaccepted CHAR(1),\n" .
			"  iby CHAR(16),\n" .
			"  PRIMARY KEY(email),\n" .
			"  UNIQUE KEY(code)\n" .
			")";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			require 'chrome/no_credentials.php';
			return false;
		}

		# Errors in these ALTER statements are to be expected
		# (and ignored), because sites starting out with 1.2 or 
		# later will already have these fields and indexes.
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD rememberme VARCHAR(16)";
		$result = $this->dbQuery($query, false);
		# For those upgrading to 1.2
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD approved CHAR(1)";
		$result = $this->dbQuery($query, false);
		# For those upgrading to 1.2
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD realname VARCHAR(80)";
		$result = $this->dbQuery($query, false);
		# For those upgrading to 1.2
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD KEY (approved)";
		$result = $this->dbQuery($query, false);
		# For those upgrading to 2.0
		if ($loginSettings['dbtype'] === 'mysql') {
			$query = "ALTER TABLE " . $loginSettings['table'] .
				" MODIFY data $blobType";
			$result = $this->dbQuery($query, false);
		}
		# For those upgrading to 2.0
		# PHP uses monster 32-character session IDs
		$query = "CREATE TABLE IF NOT EXISTS " .
			$loginSettings['sessionsTable'] . " (\n" .
			"sid CHAR(32),\n" .
			"lastused DATETIME,\n" .
			"data $blobType,\n" .
			"PRIMARY KEY(sid),\n" .
			"KEY(lastused))\n";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			require 'chrome/no_credentials.php';
			return false;
		}
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD invitations INTEGER DEFAULT 0";
		$result = $this->dbQuery($query, false);
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD usedinvitations INTEGER DEFAULT 0";
		$result = $this->dbQuery($query, false);
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD invitedby VARCHAR(16)";
		$result = $this->dbQuery($query, false);
		$query = "ALTER TABLE " . $loginSettings['table'] . 
			" ADD INDEX(verified)";
		$result = $this->dbQuery($query, false);
		# 2.0: we autocreate the admin account if there
		# isn't one already
		$userData = $this->loadUserDataBody(
			$loginSettings['adminemail'],
			false,
			false,
			false,
			false,
			false);		
		if (!$userData) {
			$id = $this->createGuid();
			if (loginParameter('adminpassword') ===
				'CHANGEME') 
			{
				require 'chrome/must_change_admin_password.php';
				return false;
			}	
			$result = $this->dbQuery(
				"INSERT INTO " . $loginSettings['table'] .
				"  (id,\n" .
				"    user,\n" .
				"    password,\n" .
				"    email,\n" .
				"    realname,\n" .
				"    verify,\n" .
				"    verified,\n" .
				"    approved,\n" .
				"    created,\n" .
				"    lastused,\n" .
				"    data)\n" .
				"  VALUES(\n" .
				"    ?, ?, ?, ?, ?, ?,\n" .
				"    ?, ?, NOW(), NOW(), ?)",
				array($id,
					loginParameter('adminusername'),
					loginParameter('adminpassword'),
					loginParameter('adminemail'),
					'Site Administrator',
					NULL,
					true,
					'Y',
					serialize(array()))
				);
			if ($this->dbIsError($result)) {
				require 'chrome/no_credentials.php';
				return false;
			}
		}	
		return true;
	}
	function count()
	{
		global $loginSettings;
		$verified = 0;
		$query = "SELECT COUNT(email) FROM " . 
			$loginSettings['table'] . " WHERE verified = true";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			require 'chrome/database_busy.php';
			return;
		} else {
			$verified = $result[0][0];
		}
		$closed = 0;
		# 2.0: = 'Y' not = true
		$query = "SELECT COUNT(email) FROM " . 
			$loginSettings['table'] . " WHERE closed = 'Y'";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			require 'chrome/database_busy.php';
			return;
		} else {
			$closed = $result[0][0];
		}
		$query = "SELECT COUNT(email) FROM " . 
			$loginSettings['table'] . " WHERE verified = false";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			require 'chrome/database_busy.php';
			return;
		} else {
			$unverified = $result[0][0];
		}
		$count = $verified + $unverified;
		$approved = 0;
		$unapproved = 0;
		if ($loginSettings['accountApproval']) {
			$query = "SELECT COUNT(email) FROM " . 
				$loginSettings['table'] . " WHERE verified = true AND approved = 'Y'";
			$result = $this->dbQuery($query, false);
			if ($this->dbIsError($result)) {
				require 'chrome/database_busy.php';
				return;
			} else {
				$approved = $result[0][0];
			}
			$unapproved = $verified - $approved;
		}
		require 'chrome/count.php';
	}
	function purgeIdle()
	{
		global $loginSettings;
		# Now that we have erasers we have to look at each individually
		$query = "SELECT id FROM " . $loginSettings['table'] . 
			" WHERE lastused < DATE_SUB(NOW(), INTERVAL 180 DAY)";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			$message = $result->getMessage();
			require 'chrome/purge_idle_error.php';
		} else {
			$purged = count($result);
			for ($i = 0; ($i < $purged); $i++) {
				$id = $result[$i]['id'];
				$this->callErasers($id, true);	
			}
			require 'chrome/purge_idle_complete.php';
		}	
	}
	function purgeUnverified()
	{
		global $loginSettings;
		$query = "SELECT id FROM " . $loginSettings['table'] . 
			" WHERE verified = FALSE and" .
			" lastused < DATE_SUB(NOW(), INTERVAL 7 DAY)";
		$result = $this->dbQuery($query, false);
		if ($this->dbIsError($result)) {
			$message = $result->getMessage();
			require 'chrome/purge_unverified_error.php';
		} else {
			$purged = count($result);
			for ($i = 0; ($i < $purged); $i++) {
				$id = $result[$i]['id'];
				$this->callErasers($id, true);	
			}
			require 'chrome/purge_unverified_complete.php';
		}	
	}
	function addBlocks()
	{
		global $loginSettings;
		$blocks = $_POST['loginblock'];
		$who = preg_split('/\s+/', $blocks);
		foreach ($who as $block) {
			if ((!(preg_match($this->validEmail, $block))) &&  
				(!(preg_match($this->validDomain, $block))))
			{
				$this->send('block_invalid_syntax');
				continue;
			}
			$values = array($block);
			$query = "INSERT INTO " . $loginSettings['blockTable'] . 
				" (block) VALUES ( ? )";
			$result = $this->dbQuery($query, $values);
			if ($this->dbIsError($result)) 
			{
				if ($result->getMessage() == 'DB Error: already exists') {
					$this->send('block_already_exists');
				} else {
					$this->send('block_db_error');
				}
			} else {
				$this->send('block_added');
			}	
		}
	}
	function removeBlock()
	{
		global $loginSettings;
		$block = $_GET['loginunblock'];
		$query = "DELETE FROM " . $loginSettings['blockTable'] . 
			" WHERE block = ?";
		$values = array($block);
		if ($this->dbIsError($this->dbQuery($query, $values))) {
			$this->send('database_busy');
		} elseif ($this->dbAffectedRows() == 0) {
			$this->send('block_not_found');
		} else {
			$this->send('block_removed');
		}	
	}
	function removeBlocks()
	{
		global $loginSettings;
		$blocks = loginGetOrPost('loginunblock');
		$who = preg_split('/\s+/', $blocks);
		foreach ($who as $block) {
			if (!strlen($block)) {
				continue;
			}
			$query = "DELETE FROM " . $loginSettings['blockTable'] . 
				" WHERE block = ?";
			$values = array($block);
			if ($this->dbIsError($this->dbQuery($query, $values))) {
				$this->send('database_busy');
			} elseif ($this->dbAffectedRows() == 0) {
				$this->send('block_not_found');
			} else {
				$this->send('block_removed');
			}	
		}
	}
	function unblockDomains()
	{
		global $loginSettings;
		for ($i = 0; ($i < $_POST['blockeddomainscount']); $i++) {
			$block = $_POST["domain$i"];
			if (!strlen($block)) {
				continue;
			}
			$query = "DELETE FROM " . $loginSettings['blockTable'] . 
				" WHERE block = ?";
			$values = array($block);
			if ($this->dbIsError($this->dbQuery($query, $values))) {
				$this->send('database_busy');
			} elseif ($this->dbAffectedRows() == 0) {
				$this->send('block_not_found');
			} else {
				$this->send('block_removed');
			}	
		}
	}
	function adminRevokeAllInvitations()
	{
		global $loginSettings;
		$query = "UPDATE " . $loginSettings['table'] . 
			" SET invitations = 0";
		$qresult = $this->dbQuery($query);
		if ($this->dbIsError($qresult)) {
			$this->send('database_busy');
			return;
		}
		$rows = $this->dbAffectedRows();
		require 'chrome/revoke_all_successful.php';
	}

	function adminCloseAccounts()
	{
		if (!$_POST['closeconfirm']) {
			require 'chrome/close_accounts_not_confirmed.php';
			return;
		}
		$this->applyToEach('closedaccounts', 'closing',
			'adminCloseAccount');	
	}
	function adminReopenAccounts()
	{
		$this->applyToEach('reopenaccounts', 'reopening',
			'adminReopenAccount');	
	}
	function adminCloseAccount($where, $w)
	{
		global $loginSettings;
		# Refuse to close the admin account
		if (strpos($w, '@') === false) {
			if ($_SESSION['user'] === $w) {
				require 'chrome/do_not_close_admin.php';
				return false;
			}
		} else {
			if ($_SESSION['email'] === $w) {
				require 'chrome/do_not_close_admin.php';
				return false;
			}
		}
		if ($this->post('closeblock')) {
			# Block the email address while we're here.
			# If we have a username, look up the email address.
			$email = $w;
			if (strpos($w, '@') === false) {
				$query = 'SELECT email FROM ' .
					$loginSettings['table'] . $where;
				$qresult = $this->dbQuery($query, array($w));
				if ($this->dbIsError($qresult)) {
					return $qresult;
				}
				$email = $qresult[0]['email'];
			}
			if (strlen($email)) {
				$query = "INSERT INTO " . 
					$loginSettings['blockTable'] . 
					" (block) VALUES ( ? )";
				$this->dbQuery($query,
					array($email));
			}
		}

		# Eraser callbacks			
		$delete = false;
		if ($this->post('closedelete')) {
			$delete = true;
		}
		$query = 'SELECT id FROM ' . $loginSettings['table'] . $where;
		$qresult = $this->dbQuery($query, array($w));
		if ($this->dbIsError($qresult)) {
			return $qresult;
		}
		if (!count($qresult)) {
			return $qresult;
		}
		$id = $qresult[0]['id'];
		$this->callErasers($id, $delete);

		if (!$delete) {
			$query = 'UPDATE ' . $loginSettings['table'] . 
				" SET closed = 'Y' " . $where;
			return $this->dbQuery($query, array($w));
		}
	}	

	function adminReopenAccount($where, $w)
	{
		global $loginSettings;

		# Unblock the email address while we're here.
		# If we have a username, look up the email address.
		$email = $w;
		if (strpos($w, '@') === false) {
			$query = 'SELECT email FROM ' .
				$loginSettings['table'] . $where;
			$qresult = $this->dbQuery($query, array($w));
			if ($this->dbIsError($qresult)) {
				return $qresult;
			}
			$email = $qresult[0]['email'];
		}
		if (strlen($email)) {
			$query = "DELETE FROM " . 
				$loginSettings['blockTable'] . 
				" WHERE block = ?";
			$this->dbQuery($query,
				array($email));
		}

		$query = 'UPDATE ' . $loginSettings['table'] . 
			" SET closed = NULL " . $where;
		return $this->dbQuery($query, array($w));
	}	
	function invokeCallbacks($type, $args)
	{
		global $loginSettings;
		if (isset($loginSettings[$type])) {
			$cbs = $loginSettings[$type];
			foreach ($cbs as $cb) {
				return call_user_func_array(
					$cb['function'],
					$args);	
			}
		}
	}
	function callErasers($id, $deleting)
	{
		# Non-category-specific eraser callbacks
		$this->invokeCallbacks('eraserCallbacks', 
			array($id, $deleting));
		$creversed = array_reverse($this->categoryOrder);
		foreach ($creversed as $c)
		{
			if ($this->hasEraser($c)) {
				$this->categoryCallback($c, 'eraser', array($id, $deleting));
			}
		}
	}
	function adminGrantInvitationsTo()
	{
		$this->applyToEach('grantinvitesto', 'grant_to',
			'adminGrantInvitationsToOne');	
	}
	function adminGrantInvitationsToOne($where, $w)
	{
		global $loginSettings;
		$query = 'UPDATE ' . $loginSettings['table'] .
			' SET invitations = invitations + ? ';
		$query .= $where;
		$count = ($_POST['invitecount'] + 0);
		return $this->dbQuery($query, array($count, $w)); 
	}
	function applyToEach($listName, $chromePrefix, $function)
	{
		global $loginSettings;
		$who = $this->post($listName);
		$who = preg_split('/\s+/', $who);
		foreach ($who as $w) {
			$user = false;	
			$bad = true;
			if (strpos($w, '@') === false) {
				if (preg_match($this->validUser, $w)) {
					$bad = false;
					$user = true;
				}		
			} elseif (preg_match($this->validEmail, $w)) {
				$bad = false;
			}	
			if ($bad) {
				require "chrome/$chromePrefix" . 
					"_bad_address.php";
				continue;
			}
			$where = " WHERE ";
			if ($user) {
				$where .= 'user = ?';
			} else {	
				$where .= 'email = ?';
			}
			$qresult = $this->$function($where, $w);
			if ($this->dbIsError($qresult)) { 
				$this->send('database_busy');
				break;
			}
			if ((count($qresult) > 0) || 
				($this->dbAffectedRows() > 0)) 
			{	
				require "chrome/$chromePrefix" . 
					"_successful.php";
			} else {		
				require "chrome/$chromePrefix" .
					"_nonexistent_user.php";
			}
		}
	}
	function adminGrantInvitationsToAll()
	{
		global $loginSettings;
		$query = "UPDATE " . $loginSettings['table'] . 
			" SET invitations = invitations + ?";
		$number = $_POST['invitecountall'];
		$qresult = $this->dbQuery($query, 
			array($number));
		if ($this->dbIsError($qresult)) {
			$this->send('database_busy');
			return;
		}
		$rows = $this->dbAffectedRows();
		require 'chrome/grant_to_all_successful.php';
	}

	function dbConnect()
	{
		global $login;
		global $loginSettings;
		if (isset($this->connected)) {
			return true;
		}
		$this->db = DB::connect(
			$loginSettings['dbtype'] . "://" .
			$loginSettings['user'] . ":" .
			$loginSettings['password'] . "@" .
			$loginSettings['host'] . "/" .
			$loginSettings['name'], false);
		if (PEAR::isError($this->db)) {
			$message = $this->db->getMessage();
			require 'chrome/no_database.php';
			return false;
		}
		$this->db->setFetchMode(DB_FETCHMODE_ASSOC);
		$this->connected = true;
		return true;
	}

	function dbContains($table, $field, $value)
	{
		$result = $this->dbQuery(
			"SELECT $field FROM $table WHERE $field = ?", 
			array($value));
		if (PEAR::isError($result)) {
			require 'chrome/database_busy.php';
			return false;
		}			
		return count($result);
	}

	function dbQuery($query, $params = array())
	{
		$this->dbConnect();
		$qresult = $this->db->getAll($query, 
			$params);
		if ($this->dbIsError($qresult)) {
			$this->dbLastError = "QUERY: $query\nMESSAGE: " .
				$qresult->getMessage();
		}
		return $qresult;
	}

	function dbNumRows()
	{
		$numRows = $this->db->numRows();
		return $numRows;
	}

	function dbAffectedRows()
	{
		return $this->db->affectedRows();
	}

	function dbClose()
	{
		$this->db->disconnect();
	}

	function dbIsError($result)
	{
		return PEAR::isError($result);
	}

	function dbEscape($val)
	{
		# Can't work until you connect to a database
		$this->dbConnect();
		return $this->db->escapeSimple($val);
	}

	function getRememberPath()
	{
		return loginParameter('rememberCookiePath');
	}

	function getRememberDomain()
	{
		return loginParameter('rememberCookieDomain');
	}

	function sessionOpen($savePath, $sid)
	{
		return true;
	}

	function sessionClose()
	{
		return true;
	}

	function sessionRead($sid)
	{
		global $loginNoSessionsYet;
		global $loginSettings;
		# In setup.php we don't want to fail for lack of tables
		if ($loginNoSessionsYet) 
		{
			return;
		}
		$transaction = false;
		if (strlen($sid)) {
			# We will lock the session for the duration. To
			# accomplish that, we have to use a transaction, and
			# we have to use SELECT FOR UPDATE.
			$qresult = $this->dbQuery(
				'START TRANSACTION', array());
			# Don't generate a bad page without the benefit
			# of session data - better to encourage the user
			# to try the operation again
			if ($this->dbIsError($qresult)) {
				$this->send('database_busy_page');
				exit(0);
			}
			$transaction = true;
			$query = 'SELECT data FROM ' . loginParameter('sessionsTable') .
				' WHERE sid = ? FOR UPDATE';
			$qresult = $this->dbQuery($query, array($sid));
			if ($this->dbIsError($qresult)) {
				return false;
			}
			if (count($qresult)) {
				$data = $qresult[0]['data'];	
				# Must be a STRING
				$data .= '';
				return $data;
			}
		} 
		if (!$transaction) {
			$qresult = $this->dbQuery(
				'START TRANSACTION', array());
			if ($this->dbIsError($qresult)) {
				return false;
			}
		}
		$qresult = $this->dbQuery(
			'INSERT INTO ' . loginParameter('sessionsTable') .
			' (sid, data, lastused) VALUES (?, ?, NOW())', 
			array($sid, ''));	
		if ($this->dbIsError($qresult)) {
			if ($qresult->getMessage() ===
				'DB Error: no such table')
			{
				$this->send('visit_setup_first');
				return false;
			}
			return false;
		}
		# Lock the brand new session for the duration
		# (yes, an inline image or frame could
		# come knocking before we exit)
		$query = 'SELECT data FROM ' . loginParameter('sessionsTable') .
			' WHERE sid = ? FOR UPDATE';
		$qresult = $this->dbQuery(
			$query, array($sid));	
		if ($this->dbIsError($qresult)) {
			return false;
		}
		return '';
	}

	function sessionWrite($sid, $data)
	{
		global $loginSettings;
		$qresult = $this->dbQuery(
			'UPDATE ' . loginParameter('sessionsTable') .
			' SET data = ?, lastused = NOW()' .
			' WHERE sid = ?', 
			array($data, $sid));	
		if ($this->dbIsError($qresult)) {
			return false;
		}	
		$qresult = $this->dbQuery('COMMIT', array());
		if ($this->dbIsError($qresult)) {
			return false;
		}	
		return true;
	}

	function sessionDestroy($sid) 
	{
		global $loginSettings;
		$qresult = $this->dbQuery(
			'DELETE FROM ' . loginParameter('sessionsTable') .
			' WHERE sid = ?', 
			array($sid));	
		if ($this->dbIsError($qresult)) {
			return false;
		}	
		$qresult = $this->dbQuery('COMMIT', array());
		if ($this->dbIsError($qresult)) {
			return false;
		}	
		return true;
	}

	function sessionGC($maxLifetime)
	{
		global $loginSettings;
		$qresult = $this->dbQuery(
			'DELETE FROM ' . loginParameter('sessionsTable') .
				' WHERE lastused <' .
				' DATE_SUB(NOW(), INTERVAL ? SEC)',
			array($maxLifetime));
	}
}

// Where config.php can use it
function loginGetBase($url)
{
	if (preg_match("/^\w+\:\/\/[\w\-\+]+(\:\d+)?/", $url, $matches)) {
		return $matches[0];
	}	
	return null;
}

// Where register_shutdown_function can see them

function loginParameter($name)
{
	global $loginSettings;
	global $loginDefaults;
	if (isset($loginSettings[$name])) {
		return $loginSettings[$name];
	} else {
		return $loginDefaults[$name];
	}
}

function loginSetCookie($a, $b, $c, $d, $e)
{
	setcookie($a, $b, $c, $d, $e);
}

function loginMacroParameter($default, $name)
{
	return loginMacros(loginParameter($name));
}

function loginMacros($body)
{
	global $loginSettings;
	$body = preg_replace('/SITE_NAME/', 
		$loginSettings['siteName'], $body);
	$body = preg_replace('/SITE_BASE/', 
		$loginSettings['siteBase'], $body);
	if (isset($_SESSION['realname'])) {
		$body = preg_replace('/REAL_NAME/', 
			$_SESSION['realname'], $body);
	}	
	if (isset($_SESSION['user'])) {
		$replacement = $_SESSION['user'];
		if (preg_match('/^XGUIDX/', $replacement)) {
			$replacement = '';
		} else {
			$replacement = "($replacement) ";
		}
		$body = preg_replace('/USER_NAME_IN_PARENS/', 
			$replacement, $body);
	}
	return $body;
}

function loginGetOrPost($id)
{
	if (isset($_POST[$id])) {
		return $_POST[$id];
	} elseif (isset($_GET[$id])) {
		return $_GET[$id];
	} else {
		return false;
	}	
}

function loginSerializeSession()
{
	# 1.2: don't waste space serializing things we store in
	# fields of their own or do not wish to store for more than
	# the lifetime of the session. 2.0: added admin to this 
	# list as well as new fields
	$dbFields = array(
		'id' => 1,
		'email' => 1,
		'user' => 1,
		'realname' => 1,
		'approved' => 1,
		'admin' => 1
	);
	$keepers = array();
	foreach ($_SESSION as $key=>$value) {
		if (isset($keepers[$key])) {
			continue;
		}
		if (substr($key, 0, 4) === 'tmp_') {
			continue;
		}
		if (substr($key, 0, 6) === 'login_') {
			continue;
		}
		$keepers[$key] = $value;
	}
	return serialize($keepers);
}

function loginMail($name, $subject, $body, $extra = '')
{
	if (loginParameter('fromAddress')) {
		$extra = "From: " . loginParameter('fromAddress') . "\r\n" .
			$extra;
	}
	mail($name, $subject, $body, $extra);
}

function loginSaveUserData()
{
	global $login;
	global $loginSettings;
	if (!isset($_SESSION['id'])) {
		return;
	}
	$login->dbConnect();

	$userDataString = loginSerializeSession();

	# Avoid writing to the database on every single page hit,
	# write only if user data changes in some way

	# Important: use the === operator to avoid conversion to integer.
	# "0" is not equal to "" for our purposes!
	if ($userDataString === $login->oldData) 
	{
		return;
	}
	$query = "UPDATE " . $loginSettings['table'] . 
		" SET data = ?, lastused = NOW() WHERE id = ?";
	$result = $login->dbQuery($query, 
		array($userDataString, 
			$_SESSION['id']));
	if (($login->dbIsError($result)) || 
		($login->dbAffectedRows() == 0)) 
	{
		$login->send('database_busy');
		return;
	}
}

# Bring in callback function definitions at global level

# Don't let misguided attempts to output things at load time
# from a file that should only contain callback functions
# succeed in wrecking the page

ob_start();

if (isset($loginSettings['extraCategories'])) {
	foreach ($loginSettings['extraCategories'] as $loginKey => $loginVal) {
		require_once $loginVal['php'];
	}	
}

# Expand this list with any new global callback types
$callbackTypes = array('eraserCallbacks');

foreach ($callbackTypes as $cbt) {
	if (isset($loginSettings[$cbt])) {
		foreach ($loginSettings[$cbt] as $cb) {
			require_once $cb['php'];	
		}
	}
}

ob_end_clean();

$login = new Login();
# Must do this AFTER login object is created so that
# it is possible to set session variables... but
# BEFORE check() is called so that freestanding pages
# generated by Accountify can use the captcha
require 'captcha.php';
$login->check();

?>

