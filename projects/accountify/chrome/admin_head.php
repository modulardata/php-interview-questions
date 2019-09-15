<!-- This file opens the body of the admin page -->
<?php 
	$title = 'Admin Tools';
	require 'page_head.php';
?>
<div class="login_admin_tools">
<form method="POST" action="<?php echo $this->url?>">
<input type="hidden" name="loginadminpage" value="1"/>
<input type="hidden" name="login_category" value="<?php echo $category?>"/>
<div class="login_category_form_outer">
<div class="login_category_form_inner">
