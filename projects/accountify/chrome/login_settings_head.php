<?php
	$title = 'Account Settings';
	require 'page_head.php';
?>
<form method="POST" action="<?php echo $this->url?>">
<input type="hidden" name="login_category" value="<?php echo $category?>"/>
<div class="login_category_form_outer">
<div class="login_category_form_inner">
<h1>Edit Account Settings</h1>
<!-- Nested divs to work around "enter key submits form
	as if first submit button were clicked" problem
	in Firefox that triggers the first tab button
	in an unwanted way. There are JS workarounds but
	not everyone enables JS. So use CSS so that tabs can 
	appear first on the screen but last in the HTML. 
	If you have a better fix and you have TESTED IT
	in Firefox/Opera/Safari/IE, please enlighten me. -TBB -->
<?php
	if (strlen($error)) {
		echo("<h2 class=\"login_error\">$error</h2>\n");
	}
?>
<!-- The category page body gets inserted here -->
