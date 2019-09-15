<div class="login_no_credentials">
<h1>Can't Perform Operation on Database</h1>
Are you logging into the database as a user who is not permitted
to create tables?
Check your database settings at the top of config.php.
<?php
	echo("<pre>");
	echo($query);
	echo("\n\n");
	echo(htmlspecialchars($result->getMessage()));
	echo("</pre>");
?>
</div>
