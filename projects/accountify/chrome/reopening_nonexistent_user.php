<p>
Account <b>not</b> reopened: there is no user in the system with the 
<?php
	if ($loginSettings['usernames']) {
		echo('username or ');
	}
?>
email address <?php echo htmlspecialchars($w)?>.
</p>
