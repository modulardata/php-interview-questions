<?php
	# DON'T EVEN THINK ABOUT EDITING THIS FILE!

	# These are DEFAULT values applied if you do not
	# set your own values in login_config.php. 
	# Make your own changes in login_config.php ONLY.
 
$loginDefaults = array(
	'adminusername' => 'admin',
	'approvedBody' => "Your application for an account on: SITE_NAME\n" .
							"has been approved by the administrator. You may now\n" .
							"log in to the site. Welcome aboard!\n",
	'approvalBody' => "One or more account applications are pending\n" .
				"on SITE_NAME.\n\n" .
				"Accounts on that site must be approved by the\n" .
				"administrator. And that's you. So log in to your\n" .
				"administrative account to approve or reject\n" .
				"the request(s).\n\n" .
				"Thank you!\n",
	'deniedBody' => "Your application for an account on: SITE_NAME\n" .
					"has been denied. The system is private and the\n" .
					"administrator did not recognize your name or email\n" .
					"address. If you believe an error has been made\n" .
					"contact the administrator.\n\n" .
					"Sorry for the inconvenience!\n",
	'sessionsTable' => 'sessions',
	'approvedSubject' => "Account Application Approved",
	'rememberCookiePath' => '/',
	'deniedSubject' => "Account Application Denied",
	'adminname' => 'Accountify Administrator',
	'inviteTable' => 'logininvites',
	'inviteSubject' => 'REAL_NAME has invited you to join SITE_NAME',
	'captcha' => true,
	'rememberTime' => '2 weeks',
	'approvalSubject' => 'Account Application Requiring Review',
	'rememberCookieDomain' => $_SERVER['SERVER_NAME'],
	'inviteBody' => "REAL_NAME USER_NAME_IN_PARENShas invited you to join SITE_NAME!\n\n" .
		"To take advantage of this invitation visit:\n\n" .
		"INVITE_URL\n\n" .
		"Thanks for checking out SITE_NAME.\n",
	'adminpassword' => 'CHANGEME',
	'initialInvitations' => 0,
	'inviteLanding' => 'SITE_BASE',
	'builtInSessions' => true,
	'adminemail' => 'CHANGEME@CHANGEME.com',
	'cssUrl' => '/accountify/chrome/login.css',
	'fromAddress' => false
);
?>
