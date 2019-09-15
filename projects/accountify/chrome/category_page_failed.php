<p>
<?php echo $message?>
</p>
<p>
<b>The operation failed.</b> Try again later.
</p>
</div>
</div>
</form>
<form method="POST" action="<?php echo $this->url?>">
<div class="login_continue">
<input type="submit" name="login_continue" value="Continue"/>
</div>
</form>
<?php 
	require 'page_tail.php';
	exit(0);
?>
