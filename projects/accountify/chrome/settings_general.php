<!-- Yes, $realname and $email are already escaped for safety -->
<div class="login_field">
<div class="login_field_label">Real Name</div>
<input type="text" name="realname" 
	value="<?php echo $realname?>" 
	size="40" maxlength="<?php echo $this->maxRealName?>" class="login_field_value"/>
</div>
<?php
if ($loginSettings['changeEmail']) {
?>
<div class="login_field">
<div class="login_field_label">Email Address</div>
<input type="text" name="email" 
	value="<?php echo $email?>" 
	size="40" maxlength="<?php echo $this->maxEmail?>" class="login_field_value"/>
</div>
<?php
}
?>

