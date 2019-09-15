<div class="login_continue">
<form method="POST" action="<?php echo $this->url?>">
<input type="submit" name="login_continue" value="Continue"/>
</form>
</div>
<?php 
	# The continue button is on a standalone page, otherwise
	# we wouldn't need one
	require 'page_tail.php';
	exit(0);
?>
