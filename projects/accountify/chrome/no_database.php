<div class="login_no_database">
<h1>Can't Connect to Database</h1>
<h2><?php 
	if (isset($message)) { 
		echo $message;
	} 
?></h2>
Check your database settings at the top of login_config.php.
</div>
