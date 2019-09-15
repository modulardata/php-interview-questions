<div class="login_logged_in_as">
Logged in as 
<?php 
if ($loginSettings['usernames']) {
	echo $_SESSION['user'];
} else {
	echo $_SESSION['email'];
}
?>
</div>
<div class="login_logout">
<form method="POST" action="<?php echo $this->url?>">
<input type="submit" name="logout" value="Log Out">
<input type="submit" name="loginsettings" value="Change Settings">
<?php
if ($_SESSION['admin']) {
?>
<input type="submit" name="loginadminpage" value="Admin">
<?php
}
?>
<?php
if (($_SESSION['admin']) || ($_SESSION['login_invitations'] > 0)) {
?>
<input type="submit" name="logininviteuserspage" value="Invite!">
<?php
}
?>
</form>
</div>
