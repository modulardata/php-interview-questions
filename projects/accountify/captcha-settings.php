<?php
	// ABSOLUTELY NOTHING may appear above the previous line!

	// YOU MIGHT NOT HAVE TO CHANGE ANYTHING in this file. 
	// However, if you are running on IIS or your server
	// doesn't support .htaccess files, then you might
	// need to specify alternate locations for fonts and
	// sounds so that they can't be fetched with the browser.
	// but the value of doing so is not very great if you are using
	// my standard font and sounds anyway.

	// You need a TrueType font file on your server. By default we
	// use the Bitstream Vera font that was distributed with
	// the captcha software. You may change this to the path
	// of any valid truetype font file on your server, such as:
	//
	// $captchaFont = "/usr/share/fonts/monotype/albw.ttf";
	//
	// Or:
	//
	// $captchaFont = "c:/windows/fonts/arial.ttf";

	// captchaBasePath() gives you the path where captcha.php is.
	// I've helpfully put acceptable fonts and sound samples
	// in subdirectories underneath that path. You can change
	// this to any path you like, in which case you don't need 
	// captchaBasePath().
	
	$captchaFont = captchaBasePath() . "/fonts/Vera.ttf";

	// You don't have to change this if you are using my
	// alphabet audio files, as long as you have kept them
	// where they began - in the sounds subfolder, below
	// the folder where captcha.php lives. That folder is
	// blocked from web visitors by a .htaccess file, just
	// to slow hackers down a little - they can still get my
	// original letter files, so you might want to record
	// your own. If you wish you can specify a path to an
	// alternate location for your alphabet audio files,
	// but this must be a FILE SYSTEM PATH, NOT A URL.

	$captchaSounds = captchaBasePath() . "/sounds";

	// ABSOLUTELY NOTHING may appear below the following line!
?>
