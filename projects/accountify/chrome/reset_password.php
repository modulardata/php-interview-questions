<div class="login_reset_password">
<h1>Change Password</h1>
<?php
if ($message) {
?>
<h2>
<?php echo $message?>
</h2>
<?php
}
?>
<form method="POST" action="<?php echo $this->url?>">
<div class="login_field">
<div class="login_field_label">New Password</div>
<input type="password" name="password1" 
	value=""
	size="8" maxlength="<?php echo $this->maxPassword?>" class="login_field_value"/> 
</div>
<div class="login_field">
<div class="login_field_label">Confirm Password</div>
<input type="password" name="password2" 
	value=""
	size="8" maxlength="<?php echo $this->maxPassword?>" class="login_field_value"/> 
</div>
<input 
	type="hidden" 
	name="resetpasswordguid" 
	value="<?php echo $resetPasswordGuid?>"
/>
<div class="resetbuttons">
<input type="submit" name="loginresetsubmit" value="Set New Password" class="login_reset_confirmed_button"/>
<input type="submit" name="loginresetcancel" value="Cancel" class="login_reset_cancelled_button"/>
</form>
</div>
</div>

