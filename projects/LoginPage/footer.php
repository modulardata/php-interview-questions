</div>
<?php if($jquery == true || $selectivizr == true){ ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='../../js/libs/jquery-1.6.3.min.js'>\x3C/script>")</script>
<?php }; ?>

<?php if($selectivizr == true){ ?>
	<script src="../../../js/libs/selectivizr.js"></script>
<?php }; ?>

<?php if($analytics == true){ ?>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-15234051-1']);
	_gaq.push(['_trackPageview']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script><?php }; ?>