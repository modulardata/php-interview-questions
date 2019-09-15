	<div class="login_incorrect">
<?php
	if ($loginSettings['usernames']) {
		echo("Incorrect credentials. Be sure you have given the correct username or email address and the correct password.");
	} else {
		echo("Incorrect credentials. Be sure you have given the correct email address and the correct password.");
	}
?>
	</div>
