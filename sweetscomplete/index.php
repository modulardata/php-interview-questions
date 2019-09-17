<?php
// PHP and MySQL Project
// this file is the initial point of entry for the website

// start output buffering and session
ob_start();
session_start();

// check to see if logged in
if (isset($_SESSION['login']) && $_SESSION['login']) {
	$name = $_SESSION['user']['name'];
} else {
	$name = 'Guest';
}

// load init file which defines constants
require './Model/Init.php';

// load View class
require './View/View.php';
$view = new View();

// get page
if (isset($_GET['page'])) {
	// perform validation
	$page = strtolower(strip_tags($_GET['page']));
	$key = array_search($page, $view->menuPages, TRUE);
	if ($key !== FALSE) {
		$page = $view->menuPages[$key];
	} else {
		$page = 'home';
	}
} else {
	$page = 'home';
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $view->companyName; ?> | <?php echo ucfirst($page); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name ="description" content ="Sweets Complete">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/main.css" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico?v=2" type="image/x-icon" />
</head>
<body>
<div id="wrapper">
	<div id="maincontent">
		
	<div id="header">
		<div id="logo" class="left">
			<a href="index.php"><img src="images/logo.png" alt="SweetsComplete.Com"/></a>
		</div>
		<div class="right marT10">
			<b>
			<?php
			// get menus
			$count = 0;
			foreach ($view->menus['top'] as $key => $value) {
				if ($key == $page) {
					$active = 'class="active" ';
				} else {
					$active = '';
				}
				if ($count++ < 2) {
					echo '<a href="?page=' . $key . '" ' . $active . '>' . $value . '</a> |';
				} else {
					echo '<a href="?page=' . $key . '" ' . $active . '>' . $value . '</a>' . PHP_EOL;
				}
			}
			?>
			</b>
			<br />
			Welcome <?php echo $name; ?>
		</div>
		<ul class="topmenu">
		<?php
			foreach ($view->menus[$page] as $key => $value) {
				echo '<li><a href="?page=' . $key . '">' . $value . '</a></li>' . PHP_EOL;
			}
		?>
		</ul>
		<br>
		<div class="banner"><p></p></div>
		<br class="clear"/>
	</div> <!-- header -->
		
	<?php include "./View/$page.php"; ?>
	
	</div><!-- maincontent -->

	<div id="footer">
		<div class="footer">
			Copyright &copy; 2012 sweetscomplete.com. All rights reserved. <br/>
		<?php
			$footerMenu = '';
			foreach ($view->menus[$page] as $key => $value) {
				$footerMenu .= '<a href="?page=' . $key . '">' . $value . '</a> | ';
			}
			echo substr($footerMenu, 0, -2);
		?>
		<br />
			<span class="contact">Tel: +44-1234567890&nbsp;
			Fax: +44-1234567891&nbsp;
			Email:sales@sweetscomplete.com</span>
		</div>
	</div><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>

