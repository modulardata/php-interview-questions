<div class="login_reset_password_request">
	<form method="POST" action="<?php echo $this->url?>">
	<h1>Reset Your Password</h1>
	<h2><?php echo $message?></h2>
	<input type="hidden" 
		name="email" 
		value="<?php echo $_SESSION['email']?>"/>
	<input type="submit" name="loginresetrequest" value="Reset My Password" class="login_reset_request_button"/>
	<input type="submit" name="loginresetrequestcancel" value="Cancel" class="login_reset_request_button"/>
	</form>
<p>
When you click "Reset My Password," you will be sent an email with
a link that permits you to reset your password. For security reasons,
you must follow the link in that email message to reset your password.
</div>
