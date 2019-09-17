<!DOCTYPE html>
<html>

<head>
	<meta charset='UTF-8'>
	<title>Slideup Boxes</title>
	<link rel='stylesheet' href='css/style.css'>
	
	<style>
		.slide-up-boxes a { 
			display: block; 
			height: 130px; 
			margin: 0 0 20px 0; 
			background: rgba(215, 215, 215, 0.5); 
			border: 1px solid #ccc; 
			height: 65px; 
			overflow: hidden; 
		}
		
		.slide-up-boxes h5 { 
			color: #333; 
			text-align: center;
			height: 65px; 
			font: italic 18px/65px Georgia, Serif;    /* Vertically center text by making line height equal to height */
			 opacity: 1;
			 -webkit-transition: all 0.2s linear; 
			 -moz-transition: all 0.2s linear; 
			 -o-transition: all 0.2s linear;
		}
		
		.slide-up-boxes a:hover h5 { 
			margin-top: -65px; 
			opacity: 0; 
		}
		
		.slide-up-boxes div { 
			position: relative; 
			color: white; 
			font: 12px/15px Georgia, Serif;
			height: 45px; 
			padding: 10px; 
			opacity: 0; 
			-webkit-transform: rotate(6deg); 
			-webkit-transition: all 0.4s linear; 
			-moz-transform: rotate(6deg); 
			-moz-transition: all 0.4s linear; 
			-o-transform: rotate(6deg); 
			-o-transition: all 0.4s linear; 
		}
		.slide-up-boxes a:hover div { 
			opacity: 1; 
			-webkit-transform: rotate(0); 
			-moz-transform: rotate(0); 
			-o-transform: rotate(0); 
		}
		.slide-up-boxes a:nth-child(1) div { background: #c73b1b url(images/wufoo.png) 17px 17px no-repeat; padding-left: 120px; }
		.slide-up-boxes a:nth-child(2) div { background: #367db2 url(images/diw.png) 21px 10px no-repeat; padding-left: 90px; }
		.slide-up-boxes a:nth-child(3) div { background: #393838 url(images/qod.png) 14px 16px no-repeat; padding-left: 133px; }
	</style>
</head>

<body>

	<div id="page-wrap">
	
		<h1>Slideup Boxes</h1>
		
		<p>This is using CSS3 transitions and transforms, so browser compatibility should be something like: Safari 3+, Firefox 4+, Opera 10+, Chrome Whatever+</p>

		<section class="slide-up-boxes">

			<a href="http://wufoo.com">
				<h5>Where I work...</h5>
				<div>Wufoo is an online form builder that makes building even the most complex forms so easy, it's fun!</div>				
			</a>
				
			<a href="http://digwp.com">
				<h5>Book I co-authored...</h5>
				<div>Digging Into WordPress is a book and blog I co-author with Jeff Starr about the world's #1 publishing platform.</div>				
			</a>
			
			<a href="http://quotesondesign.com">
				<h5>Words I collect...</h5>
				<div>Quotes on Design is a collection of design related quotes. With an API for your integration ideas!</div>				
			</a>

		</section>
			
	</div>
	
</body>

</html>