<?php

# You MUST adjust these settings first

$loginSettings = array (
	// 1. Settings you WILL change

	// These are YOUR database settings. You get them from
	// YOUR web host. dbtype is USUALLY mysql but not always
	'dbtype' => 'mysql',
	'user' => 'CHANGEME',
	'password' => 'CHANGEME',
	// Your DATABASE'S name, not YOUR name
	'name' => 'CHANGEME',
	// Many users don't have to change this setting, but
	// do so if your web host tells you to
	'host' => 'localhost',

	// True if you want a CAPTCHA ("type in the characters in
	// the picture...") test before users can create accounts
	// (as non-invitees) or issue invitations to other users
	// (in both cases, only if your site allows these things
	// in the first place - see below). If your hosting provider
	// doesn't provide GD in PHP, you can't use this and
	// must change it to false.

	// My advice: set it to true and use a competent company
	// for PHP hosting! You're paying for it.
	
	// Note to solo-sysadmin types: try 'up2date php-gd' or similar.

	'captcha' => true,

	// This must be YOUR email address. When you log in with
	// THIS EMAIL ADDRESS, you get admin features
	'adminemail' => 'CHANGEME@CHANGEME.COM',

	// This is the admin password when you first set up your
	// site. YOU MUST change this. For security reasons you can 
	// NOT log in with this default password!

	// NOTE: after you run setup.php you can log in as admin and change
	// your password at any time without changing this file again.
	'adminpassword' => 'CHANGEME',

	// This is the admin username. If you have usernames turned off
	// then you don't need to change this. If you like admin just fine
	// as a username, then that's all right too. If you do change this,
	// make sure you add admin to the forbiddenusers list below.
	'adminusername' => 'admin',

	// Forbidden usernames. If you actually want to use one of these
	// usernames, remove it from this list and immediately create
	// the account so that no one else can. The point is to
	// prevent malicious people from impersonating staff members.
	'forbiddenusers' => array(
		'staff',
		'root',
		'boss',
		'support'
	),

	// 2. Settings you will PROBABLY change: deciding
	// what kind of site you want

	// usernames are short, unique, filename-safe nicknames
	// that users choose for themselves. Users can log in with their
	// username OR their outside email address. Usernames are
	// a good choice to display to other users, as in comments
	// made by the user for instance. But some sites have no 
	// need for them. If 'usernames' is set to 'false' users are 
	// never prompted to choose a username and they always log in
	// with their email address. If 'usernames' is set to 'true' users 
	// are required to select a username  when they create their account. 
	// If you change it from 'false' to 'true' later, users will be 
	// required to choose a username the next time they log in.

	// One very good reason to permit usernames: they uniquely
	// identify users even if you permit users to change their	
	// email addresses (see below).

	// (Coders can always uniquely identify users by their id. But
	// ids are ugly and shouldn't be displayed to other users.)
	'usernames' => true,

	// 1.2: If you want to manually approve each and every account,
	// turn this on. You will get an email notice when the account
	// is otherwise ready to go. The user can't log on until their
	// account is approved. You'll find the approval system on the
	// admin page. NOTE: if you switch to account approval later, 
	// pre-existing users will NOT have to be approved.

	// Account approval is a pain. Consider an invitation-only
	// site instead (added in version 2.0).
	'accountApproval' => false,

	// 2.0: Do you want to block people from creating accounts
	// unless they are specifically invited? Set invitationOnly 
	// to true.
	//
	// "How do people join an invitation-only system?" The admin can
	// always use the "invite more people" button. Other users can use
	// that button only if the admin gives out invitations via the
	// admin page. This is one way to limit how fast your site grows.
	'invitationOnly' => false,

	// The number of invitations a newly approved user initially
	// has available to hand out to others
	'initialInvitations' => 0,

	// Can users change their email addresses? 
	//
	// It's usually a bad idea to allow this if the site
	// doesn't have usernames turned on. That's because there
	// is no non-changeable identifier appropriate for display
	// to other users. But it's your call. The user's id
	// string never changes so it's not... completely crazy to
	// enable this without usernames.
	//
	// With usernames turned on, it usually IS a good idea
	// to allow this.

	// If you change usernames to false, you should probably
	// change this to false too
	'changeEmail' => true,

	// 3. Settings you MIGHT change: database table names, URLs,
	// email subject lines and email message texts

	// You don't have to change this, but you can if you wish -
	// perhaps you already have a table called loginusers and
	// would prefer another name for this
	'table' => 'loginusers',

	// You don't have to change this, but you can if you wish -
	// perhaps you already have a table called loginblock and
	// would prefer another name for this
	'blockTable' => 'loginblock',

	// You don't have to change this, but you can if you wish -
	// perhaps you already have a table called loginblock and
	// would prefer another name for this
	'inviteTable' => 'logininvites',

	// Sent in account invitation emails. 
	// Alternative, more attractive setting:
	//
	// 'siteName' = 'XYZ Widgets Inc.',

	'siteName' => $_SERVER['SERVER_NAME'],

	// Base site URL. This should be the base URL of the
	// ENTIRE site, even if you use Accountify only in a
	// subfolder somewhere. The provided value is correct for 
	// many sites but if your server doesn't have SCRIPT_URI and/or
	// REQUEST_URI or doesn't include a correct hostname in it, then 
	// you'll need to set it explicitly yourself.
	//
	// Example:
	//
	// 'siteBase' => 'http://www.boutell.com',
	//
	// Note that there is NO / at the end. 

	'siteBase' => preg_replace('/^(\w+\:\/\/.*?)\/.*$/',
		"$1",
		isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] :
			die("Can't find SCRIPT_URI, set siteBase manually\n")),

	// Where to find Accountify's login.css file. All standalone
	// Accountify-generated pages (create account, etc.) need this.
	// If you have installed Accountify in an accountify folder inside 
	// your web site's document root and login.css is still in a
	// subfolder of that called chrome, then this default will work. 
	// Otherwise, you need to edit this setting.

	'cssUrl' => '/accountify/chrome/login.css',

	// Where newly invited users are sent. If you don't want them
	// sent to the root home page of the site, change this to something 
	// else. This should be a page where users can log in and do normal
	// things (i.e. the home page of your site at least in the
	// functional sense). If you want to display a special message
	// to newly invited potential users, look for
	// $_GET['logininvite'] in your own PHP code (see test.php
	// for an example).

	// This page must be written in PHP and must contain an Accountify 
	// login prompt call ( $login->prompt() ). 

	'inviteLanding' => 'SITE_BASE',

	// Subject line of verification email - no newlines here!
	'verificationSubject' => "Please verify your SITE_NAME account",

	// Subject line of password reset email - no newlines here!
	'resetSubject' => "Password reset instructions for SITE_NAME",

	// Subject line of account closure email - no newlines here!
	'closeSubject' => "SITE_NAME account closing instructions",

	// Body of verification email. The verification URL will
	// be substituted wherever you type VERIFICATION_URL. 
	// Don't change the EOM; line at the end or this will NOT work.
	// You do want to edit this, otherwise the message is awfully
	// generic and the user might not recognize what site
	// it is about.
	'verificationBody' => <<<EOM
Thanks for signing up for an account with SITE_NAME!

To prevent abuse, your account must be verified. Please
click on the following link to verify your account:

VERIFICATION_URL

Thanks again!
EOM
,

	// Body of email address reset email. The verification URL will
	// be substituted wherever you type RESET_URL. 
	// Don't change the EOM; line at the end or this will NOT work.
	// You do want to edit this, otherwise the message is awfully
	// generic and the user might not recognize what site
	// it is about.
	'resetBody' => <<<EOM
You have requested to change your password on SITE_NAME.
This email has been sent for verification purposes. If you
wish to change your password, follow the link below. 
If you do NOT wish to change your password, just delete
this email.

Click on the link that follows to change your password:

RESET_URL

Thanks for using our web site!
EOM
,
	# $_SESSION fields that should NOT be deleted
	# when the user logs out. Normally there are none,
	# but your application might be different.
	'guestFields' => array (
	),

	# For the "remember me on this computer" checkbox.
	# Duration: by default, same as gmail
	'rememberTime' => '2 weeks',
	# Path: by default, applies to entire site. 
	'rememberCookiePath' => '/',

	# Domain: by default, refers to THIS web site only,
	# not other sites in the domain. To make it apply to
	# an entire domain, use a setting like:
	# 'rememberCookieDomain => '.boutell.com',
	# NOTE: the . in front is required!
	# 
	# If $_SERVER['SERVER_NAME'] lies on your particular
	# PHP server, set this to your real web site name
	# (or an entire domain as explained above).

	'rememberCookieDomain' => $_SERVER['SERVER_NAME'], 

	# Subject line of email sent to YOU (the admin) when someone
	# applies for an account. Only used when accountApproval is true. 
	'approvalSubject' =>
		'Account Application Requiring Review',

	# Body of email sent to YOU (the admin) when someone
	# applies for an account. Only used when accountApproval is true. 
	'approvalBody' =>
		"One or more account applications are pending\n" .
		"on SITE_NAME.\n\n" .
		"Accounts on that site must be approved by the\n" .
		"administrator. And that's you. So log in to your\n" .
		"administrative account to approve or reject\n" .
		"the request(s).\n\n" .
		"Thank you!\n",

	# Sent to users when their application for an account is denied
	'deniedSubject' =>
		'Account Application Denied',
	'deniedBody' =>
		"Your application for an account on: SITE_NAME\n" .
		"has been denied. The system is private and the\n" .
		"administrator did not recognize your name or email\n " .
		"address. If you believe an error has been made,\n " .
		"contact the administrator.\n\n" .
		"Sorry for the inconvenience!\n",

	# Sent to users when their application for an account is approved
	'approvedSubject' =>
		'Account Application Approved',
	'approvedBody' =>
		"Your application for an account on: SITE_NAME\n" .
		"has been approved by the administrator. You may now\n" .
		"log in to the site. Welcome aboard!\n",

	# Sent to users who have been invited to join the site.
	# REAL_NAME and USER_NAME_IN_PARENS refer to the user inviting them.
	#
	# USER_NAME_IN_PARENS is the username in parentheses followed by
	# a space, or nothing at all if usernames are not in use on the
	# site. 
	'inviteSubject' =>
		'REAL_NAME has invited you to join SITE_NAME',
	'inviteBody' =>
		"REAL_NAME USER_NAME_IN_PARENShas invited you to join SITE_NAME!\n\n" .
		"To take advantage of this invitation, visit:\n\n" .
		"INVITE_URL\n\n" .
		"Thanks for checking out SITE_NAME.\n",

	# Beginning in Accountify 2.0, Accountify provides a built-in 
	# implementation of sessions so that session_start() is not
	# needed. This way, the security issues of PHP's default session 
	# handler go away. This is good. However, you can turn this off 
	# by setting builtInSessions to false. If you do turn it off, 
	# you must do one of the following instead:
	# 
	# A. Turn on session.auto-start in php.ini 
	# B. Call session_start yourself
	# C. Build your own sessions with session_set_save_handler
	#
	# The only people who are likely to turn this off are:
	# people who prefer memcached or another hardcore session handler.
	'builtInSessions' => true,

	# A session that hasn't been used for this many minutes
	# can be discarded (if the user was logged in, they will
	# have to log in again). Should be short enough for security
	# but not so short that users go crazy trying to get anything done
	'sessionTimeout' => 24,
	# By default, Accountify deletes stale sessions at every
	# hundredth opportunity (checking more often is very inefficient)
	'sessionGcInterval' => 100,
	# Name of the MySQL table used for session data
	'sessionsTable' => 'loginsessions',

	# CUSTOM EXTENSIONS. The samples are commented out, you can
	# uncomment them if you want to try out mycode.php.

#	'extraCategoryOrder' => array(
#		'birthdate', 'toc'
#	),  

#	'extraCategories' => array(
#		'birthdate' => array(
#			'label' => 'Birthdate',
#			'html' => 'myBirthdateHtml',
#			'validator' => 'myBirthdateValidator',
#			'writer' => 'myBirthdateWriter',
#			'eraser' => 'myBirthdateEraser',
#			'php' => 'mycode.php'
#			),
#		'toc' => array(
#			'label' => 'Terms and Conditions',
#			'html' => 'myTocHtml',
#			'validator' => 'myTocValidator',
#			'php' => 'mycode.php',
#			'setup' => true,
#			'editable' => false
#			)
#	),
#	'eraserCallbacks' => array(
#		array(
#			'php' => 'mycode.php',
#			'function' => 'myEraserCallback'
#		)
#	)

	# 'FROM' ADDRESS FOR VERIFICATION EMAILS, ETC. Without this, 
	# they appear to come from whatever /etc/php.ini specifies,
	# or the web server account of your server, depending on your
	# server type and how it is set up. That will work but might
	# be confusing for users. You can specify a different 
	# From: address here.

#	'fromAddress' => "Our Staff <staff@example.com>"
);
?>
