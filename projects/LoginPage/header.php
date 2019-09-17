<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6 ie" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7 ie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php if(!$pageTitle == ''){
		echo $pageTitle;
	} else{
		echo $contentTitle.' - Demo';
	} ?> - CSS-Plus</title>
<?php if($modernizr == true){ ?>
	<script src="../../../js/libs/modernizr-2.0.6-min.js"></script>
<?php }; ?>
<link rel="icon" type="image/gif" href="/wp-content/themes/css-plus-v2/img/favicon.png" />
<link rel="stylesheet" type="text/css" href="/examples/css/defaults.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div id="header">
	<a id="logo" href="http://css-plus.com/">CSS<span>Plus</span></a><span>Sandbox</span>
	<ul id="social">
		<li class="twitter"><a href="http://twitter.com/jamygolden/">Twitter</a></li>
		<li class="rss"><a href="http://feeds.feedburner.com/css-plus/">RSS</a></li>
	</ul><?php /* /#social */ ?>
	<a href="<?php echo 'http://css-plus.com/'.$year.'/'.$month.'/'.$permalink.'/'; ?>" id="return">Return to Article</a>
</div><?php /* /#header */ ?>
<h1><?php echo $contentTitle; ?></h1>
<div id="content">