<div class="login_prompt">
	<form method="POST" action="<?php echo $this->url?>">
	<h1>Sign in to your account</h1>
	<div class="login_field">
	<div class="login_field_label">
<?php
	if ($loginSettings['usernames']) {
		echo("Username or Email:");
	} else {
		echo("Email:");
	}
?>
	</div>
	<input type="text" name="user" size="40" class="login_field_value"/>
	</div>
	<div class="login_field">
	<div class="login_field_label">
	Password:
	</div>
	<div class="login_field_value">
	<input type="password" name="password" size="16"/>
	</div>
	<div class="login_rememberme_checkbox">
	<input type="checkbox" name="rememberme"/>
	Remember me on this computer
	</div>
	</div>
	<div class="login_button">
	<input type="submit" name="login" value="Log In" size="16"/>
	</div>
	<div class="login_forgot_link">
	<a href="<?php echo $this->url?>?loginforgot=1">Forgot my password</a>
	</div>
<?php
	if ($loginSettings['invitationOnly']) {
?>
	<div class="login_invitation_only">
		<i>By Invitation Only</i>
	</div>
<?php
	} else {
?>
	<div class="login_create_link">
	<a href="<?php echo $this->url?>?logincreate=1">Create an account</a>
	</div>
	
<?php
	}
?>
	
	</form>
</div>
