<?php 
	$title = "Choose Username";
	require 'page_head.php';
?>
<div class="login_pick_username">
<h1>Please Pick a Username</h1>
<?php
if (isset($message)) {
?>
<h2>
<?php echo $message?>
</h2>
<?php
}
?>
<p>
<b>This site now features usernames.</b> Please choose a username to
identify yourself on the site. In the future you will be able to log on
with either your email address or your username.
</p>
<form method="POST" action="<?php echo $this->url?>">
<div class="login_field">
<div class="login_field_label">Username</div>
<input type="text" name="user" 
	value="<?php echo htmlspecialchars($user)?>"
	size="40" maxlength="<?php echo $this->maxUser?>" class="login_field_value"/> 
</div>
<div class="pickusernamebuttons">
<input type="submit" name="loginpickusernamesubmit" value="Set Username" class="login_pickusername_confirmed_button"/>
<input type="submit" name="loginpickusernamecancel" value="Log Out" class="login_logout"/>
</form>
</div>
</div>
<?php require 'page_tail.php'?>
