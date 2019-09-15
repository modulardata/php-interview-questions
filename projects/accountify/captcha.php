<?php
        // There had better be NO BLANK LINES OR ANYTHING ELSE
        // before the preceding line!

	// Boutell's Simple PHP Captcha.
	
	// Copyright 2007, Thomas Boutell and Boutell.Com, Inc.
	// Permission granted to use and modify this code as you
	// see fit, provided that you do not represent this code
	// as your own work. 

	// Otherwise, feel free to profit from this code 
	// in any way you wish.

	// NO CHANGES REQUIRED HERE

        // All settings are in captcha-settings.php, so that you can 
	// install an upgraded version of captcha.php without losing them.

        require 'captcha-settings.php';
	// 2007-06-21: if Accountable is present, a session is already started.
	// Calling session_start again will cause problems for Accountable
	if (!$login) {
		session_start();
	}
	if (isset($_GET['captchaimg'])) {
		captchaSendImg();
	} elseif (isset($_GET['captchawav'])) {
		captchaSendWav();		
	} else {
		captchaCode();
	}
	function captchaImgUrl()
	{
		global $captchaimg;
		return $captchaimg;
	}
	function captchaWavUrl()
	{
		global $captchawav;
		return $captchawav;
	}
	function captchaCode()
	{
		global $captchaimg, $captchawav;
		// Don't generate the code twice
		if (!isset($_SESSION['captchacode'])) {
			// Skip f, x and s, they are too hard to tell
			// apart when spoken. Skip l, it is confused
			// routinely with 1.
			$chars = "abcdeghijkmnopqrtuvwyz";
			$code = "";
			$length = mt_rand(5, 7);
			for ($i = 0; ($i < $length); $i++) {
				$char = substr($chars, 
					rand(0, strlen($chars) - 1), 1); 
				$code .= $char;
			}
			$_SESSION['captchacode'] = $code;
		}
		$salt = mt_rand(1000000, 2000000);
		if (isset($_SERVER['SCRIPT_URL'])) {
			$scriptUrl = $_SERVER['SCRIPT_URL'];
		} elseif (isset($_SERVER['SCRIPT_URI'])) {
			$scriptUrl = $_SERVER['SCRIPT_URI'];
		} elseif (isset($_SERVER['REQUEST_URI'])) {
			$scriptUrl = $_SERVER['REQUEST_URI'];
		} else {
			die("captcha.php: SCRIPT_URL, SCRIPT_URI and REQUEST_URI are unavailable, I can't find myself");
		}
		$scriptUrl = preg_replace('/\\?.*$/', '', $scriptUrl);
		$captchaimg = $scriptUrl . "?captchaimg=1&captchasalt=$salt";
		$captchawav = $scriptUrl . "?captchawav=1&captchasalt=$salt";
	}
	function captchaDone()
	{
		if ($_SESSION['captchacode']) {
			unset($_SESSION['captchacode']);
		}
		captchaCode();
	}
	function captchaSendImg()
	{
		global $captchaFont;
		# 20071206: If we just called captchaDone, this won't
		# be set up. But there's nothing wrong with wanting
		# a new CAPTCHA in the very same HTTP response.
		if (!isset($_SESSION['captchacode'])) {
			captchaCode();
		}
		$code = $_SESSION['captchacode'];
		$im = imagecreatetruecolor(200, 50);
		imageantialias($im, 1);
		$back = imagecolorallocate($im, 255, 255, 255);
		$fore = imagecolorallocate($im, 0, 0, 0);
		imagefilledrectangle($im, 0, 0, 200, 50, $back);
		$x = mt_rand(10, 20);
		$y = mt_rand(20, 35);
		$length = strlen($code);	
		for ($i = 0; ($i < $length); $i++) {
			$char = substr($code, $i, 1);
			$size = mt_rand(0, 4) + 16.0;
			$angle = mt_rand(0, -45);
			$xoffs = mt_rand(-3, 3);
			$yoffs = mt_rand(-5, 5);
			imagettftext($im, $size, $angle, 
				$x + $xoffs, $y + $yoffs, 
				$fore, $captchaFont, $char);
			$x += 23;
			$code .= $char;
		}
		// Now add lots of noise to 
		// confuse OCR software
		$flakes = (200 * 50) / 16;
		$flakes = mt_rand($flakes * .8, $flakes * 1.2);	
		for ($i = 0; ($i < $flakes); $i++) {
			$x1 = mt_rand(0, 200);
			$y1 = mt_rand(0, 50);
			$x2 = $x1 + mt_rand(-2, 2);
			$y2 = $y1 + mt_rand(-2, 2);
			imageline($im, $x1, $y1, $x2, $y2, $fore);	
		}
		// jpeg is lossy, which is good here, because
		// it makes automated analysis of the captcha
		// a little more difficult.
		header("Content-type: image/jpeg"); 	
		imagejpeg($im);
		exit(0);
	}
	function captchaSendWav()
	{
		global $captchaSounds;
		# 20071206: If we just called captchaDone, this won't
		# be set up. But there's nothing wrong with wanting
		# a new CAPTCHA in the very same HTTP response.
		if (!isset($_SESSION['captchacode'])) {
			captchaCode();
		}
		$wav = "RIFF";
		# Dummy length for now, we'll patch it
		# when we know the final length
		$riffLengthOffset = strlen($wav);
		$wav .= pack("V", 0);
		$wav .= "WAVE";
		# Now the format chunk
		$wav .= "fmt ";
		# Enough room to describe PCM
		$wav .= pack("V", 16);
		# Select PCM
		$wav .= pack("v", 1);	
		# mono
		$wav .= pack("v", 1);
		# samplerate
		$wav .= pack("V", 22050);
		# byterate
		$wav .= pack("V", 22050);
		# block alignment
		$wav .= pack("v", 1);
		# bits per sample
		$wav .= pack("v", 8);
		# Now the data chunk
		$wav .= "data";
		$code = $_SESSION['captchacode'];
		$sound = "";
		$change = mt_rand(7000, 10000);
		$change /= 10000.0;
		for ($i = 0; ($i < strlen($code)); $i++) {
			$char = substr($code, $i, 1);	
			$char = strtolower($char);
			$lsound = file_get_contents("$captchaSounds/$char.ub");
			$llen = strlen($lsound);
			$nsound = "";
			$prev = 0;
			$smoothFrequency = mt_rand(200, 300);
			for ($j = 0; ($j < $llen); $j++) {
				$byte = ord(substr($lsound, $j, 1));
				# Change volume slightly to thwart attempts
				# to just recognize the same series of bytes
				$byte *= $change;
				# Smooth in an occasional extra byte to thwart 
				# attempts to simply calculate letter lengths
				if (mt_rand(0, $smoothFrequency) == 0) {
					$smooth = ($byte + $prev) / 2.0;
					$nsound .= pack("C", $smooth);
				}
				$nsound .= pack("C", $byte);
				$prev = $byte;
			}
			$sound .= $nsound;
		}
		$wav .= pack("V", strlen($sound));
		$wav .= $sound;
		substr_replace($wav, pack("V", strlen($wav) - 8),
			$riffLengthOffset, 4);
		$clength = strlen($wav);
		header("Content-length: $clength");
		header("Content-type: audio/wav"); 	
		echo($wav);
		exit(0);
	}
	function captchaBasePath()
	{
		$src = __FILE__;
		$path = preg_replace('/\/[^\/]+$/', '', $src);
		return $path;
	}
?>
