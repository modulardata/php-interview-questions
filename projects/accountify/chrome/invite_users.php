<?php
	$title = 'Invite Users To Join ' . $loginSettings['siteName'];
	require 'page_head.php';
?>
<div class="login_invite_users">
<form method="POST" action="<?php echo $this->url?>">
<input type="hidden" name="logininviteuserspage" value="1"/>
<?php
$invitesYes = false;
$prologue = '';
if (!$_SESSION['admin']) {
	$invites = $_SESSION['login_invitations'];
	if ($invites <= 0) {
		$messages[] = "Sorry, you have no invitations to give out at this time.";
	} else { 
		$messages[] = "You may give out up to $invites invitations.";
		$invitesYes = true;
	}
} else {
	$invitesYes = true;
}
?>
<h2>Invite Users</h2>
<?php 
foreach ($messages as $m) {
	echo("<p>" . htmlspecialchars($m) . "</p>");
}
if ($invitesYes) {
?>	
You may invite new people to join the site by entering their email addresses
in the following text entry field, <b>one per line</b>, like this:
<p>
<tt>example1@example.com</tt><br>
<tt>example2@example.com</tt>
</p>
<p>
<b>Optional:</b> for better results, follow each email 
address with a real name on the same line, like this:
</p>
<p>
<tt>example1@example.com John Doe</tt><br>
<tt>example2@example.com Jane Smith</tt>
</p>
<p>
This reduces the likelihood that your invitation will get lost in
the invited person's spam folder.
</p>
<textarea name="invitees" rows="8" cols="60">
</textarea>
<?php
	if (!$_SESSION['admin']) {
		$classPrefix = 'login';
		require 'captchafield.php';
	}
} 
?>
<p>
<input type="submit" name="login_invite_others" value="Invite Users"/>
</p>
<p>
<input type="submit" 
	name="loginexitinviteuserspage" 
	value="Exit Invite Users Page"/>
</p>
</form>
</div>
<?php
	require 'page_tail.php';
?>
