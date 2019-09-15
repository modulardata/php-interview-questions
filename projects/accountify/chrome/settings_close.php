<div class="login_confirm_close">
<p>
Closing your account will permanently delete your information from 
our system. This cannot be undone. Are you sure this is what you want?
</p>
<input type="checkbox"
	name="close_confirm"
<?php
	if (isset($_POST['close_confirm']) && 
		($_POST['close_confirm'] === '1')) {
		echo(' checked="1" ');
	}
?>
	value="1"
/> Yes, please close my account
</div>
