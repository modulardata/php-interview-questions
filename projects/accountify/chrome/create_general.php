<?php
	# Invite code - good only for a fixed email address
	# (we enforce this elsewhere too)
	if (!isset($inviteCode)) {
?>
<div class="login_field_label">Email Address</div>
<input type="text" name="email" 
	value="<?php echo $email?>" 
	size="40" maxlength="<?php echo $this->maxEmail?>" class="login_field"/> 
<?php
	}
?>
<div class="login_field">
<div class="login_field_label">Real Name</div>
<input type="text" name="realname" 
	value="<?php echo $realname?>" 
	size="40" maxlength="<?php echo $this->maxRealName?>" class="login_field_value"/> 
</div>
<?php
	if ($loginSettings['usernames']) 
	{
?>
<div class="login_field">
<div class="login_field_label">Desired User Name</div>
<input type="text" name="user" 
	value="<?php echo $user?>" 
	size="40" maxlength="<?php echo $this->maxUser?>" class="login_field_value"/> 
</div>
<?php
	}
?>
<div class="login_field">
<div class="login_field_label">Desired Password</div>
<input type="password" name="password1" 
	value="<?php echo $password1?>"
	size="8" maxlength="<?php echo $this->maxPassword?>" class="login_field_value"/> 
</div>
<div class="login_field">
<div class="login_field_label">Confirm Password</div>
<input type="password" name="password2" 
	value="<?php echo $password2?>" 
	size="8" maxlength="<?php echo $this->maxPassword?>" class="login_field_value"/> 
</div>
