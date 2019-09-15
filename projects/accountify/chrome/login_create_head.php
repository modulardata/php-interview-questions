<?php
	$title = 'Create Account';
	require 'page_head.php';
?>
<form method="POST" action="<?php echo $this->url?>">
<input type="hidden" name="login_category" value="<?php echo $category?>"/>
<div class="login_category_form_outer">
<div class="login_category_form_inner">
<?php
	echo("<h1>Create An Account</h1>\n");
        if (strlen($error)) {
                echo("<h2 class=\"login_error\">$error</h2>\n");
        }
?>
<!-- The category page body gets inserted here -->
