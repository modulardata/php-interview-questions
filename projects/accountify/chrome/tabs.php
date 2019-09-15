<div class="login_category_tabs">
<?php
foreach ($tabs as $t) {
	$class = 'login_category_tab';	
	if ((isset($loginCurrentTab) && ($loginCurrentTab === $t['name'])) ||
		(isset($t['current']) && ($t['current'])))
	{
		$class = 'login_category_current_tab';
	}
	?>
<input type="submit" name="login_category_<?php echo $t['name']?>"
	value="<?php echo $t['label']?>" class="<?php echo $class?>"/> 
	<?php
}
?>
</div>
