<!-- This file closes the body of the admin page -->
</div>
<?php
	$tabs = array(
		array('name' => 'general', 'label' => 'General'),
		array('name' => 'invitations', 'label' => 'Invitations'),
		array('name' => 'blocks', 'label' => 'Block Emails'),
		array('name' => 'close', 'label' => 'Close Accounts')
	);
	$loginCurrentTab = $category;
	require 'tabs.php';
?>
</div>
<p>
<input type="submit" name="loginexitadminpage" value="Exit Admin Tools Page"/>
</p>
</form>
</div>
<?php
	require 'page_tail.php';
?>
