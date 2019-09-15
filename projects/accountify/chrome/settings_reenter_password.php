<?php require 'page_head.php'?>
<h2>Please Confirm This Action</h2>
<div class="login_settings_reenter_password">
<form method="POST" action="<?php echo $this->url?>">
<input type="hidden" name="login_category" value="<?php echo $category?>"/>
<?php
	if (isset($message) && strlen($message)) {
		echo("<p>$message</p>\n");
	}
?>
<p>
For security reasons, you must reenter your password before
carrying out this action.
</p>
	<div class="login_field">
	<div class="login_field_label">
	Current Password:
	</div>
	<div class="login_field_value">
	<input type="password" name="login_password" size="16"/>
	</div>
	</div>
<div class="login_buttons">
<input class="login_button" type="submit" name="login_password_ok"
        value="OK"/>
<input class="login_cancel_button" type="submit" name="login_cancel"
        value="Cancel"/>
</div>
	</form>
</div>
<?php require 'page_tail.php'?>
