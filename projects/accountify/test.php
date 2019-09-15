<?php
# We must do this BEFORE any other code so it can set cookies
require 'login.php';
?>
<html>
<head>
<link href="chrome/login.css" rel="stylesheet" type="text/css">
<title>PHP Login Demo</title>
</head>
<body>
<?php
	# Display the login-related prompts etc
	$login->prompt();
?>
This is a very simple Accountify-based web site. This site simply
finds out your favorite color and remembers that information. This
allows many of Accountify's account-related features to be tested.
<?php
	# Are you writing a social network? Do you want to 
	# know when an invitation is completely successful
	# so that you can automatically "friend back" the
	# user who invited the new user? No problem. Just
	# look for $_SESSION['login_invitedby']. This contains
	# the id of the user who invited the current user.
	# Now you have enough information to insert a row
	# in your 'friends' database table.

	$invitedBy = false;
	if (isset($_SESSION['login_invitedby'])) {
		$invitedBy = $_SESSION['login_invitedby'];	
	}
	if ($invitedBy && (!isset($_SESSION['friended_back']))) {
		$oldPerson = $login->loadUserData($invitedBy);
		echo("<p>We were invited by " . 
			$oldPerson['email'] . ".</p>\n");
		# Your DB insert goes here
		$_SESSION['friended_back'] = true;
	}
	# Accept new favorite color, if any
	$colors = array("red", "green", "blue");
	if (isset($_POST['setcolor'])) {
		echo("<p>got color setting attempt<p>");
		$color = '';
		if (isset($_POST['color'])) {
			$color = $_POST['color'];
		}
		# Always make sure it's an acceptable choice.
		# Anything else is a hack attempt, ignore it
		if (in_array($color, $colors)) {
			# Store the user's new favorite color in
			# $_SESSION. The login module does the
			# rest, sweeping whatever is stored
			# in $_SESSION into the user database.
			$_SESSION['color'] = $color;
			echo("<p>set color to $color<p>");
		}
	}
?>
<?php
	# 1.3: detect that the user is responding to an invitation,
	# and show them a special welcome instead of the
	# normal page.
	if (isset($_GET['logininvite'])) {
		?>
<h1>Whoa, You're Invited!</h1>
<p>
You must be somebody special!
</p>
<p>
Use the form on the right to create your account.
</body>
</html>
		<?php
		# We're done with the special welcome,
		# so exit the page now
		exit(0);
	}	
?>
<h1>PHP Login Demo</h1>
<?php
	if (isset($_SESSION['color'])) {
		?>
Your favorite color is: <?php echo $_SESSION['color']?>
<?php
	} else {
		?>
We don't know your favorite color yet! Please tell us!
<?php
	}
?>
<p>
<?php
	if ($login->loggedIn) {
		echo("<p>You are logged in.<p>");
	} else {
		echo("<p>You are not logged in.<p>");
	}
?>
<p>
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']?>">
Change your favorite color to:
<select name="color">
<option value="red">Red</option>
<option value="green">Green</option>
<option value="blue">Blue</option>
</select>
<input type="submit" name="setcolor" value="Set Favorite Color"/>
</form>
</body>
</html>
