<div class="login_close_account">
<h1>Close Account</h1>
<?php
if ($message) {
?>
<h2>
<?php echo $message?>
</h2>
<?php
}
?>
<form method="POST" action="<?php echo $this->url?>">
<input type="hidden" name="closeaccountguid" value="<?php echo $closeAccountGuid?>"/>
"Close My Account" to confirm that you wish to close your account.
We're sorry to see you go!
<p>
If you wish to keep your account, just click "Cancel" instead.
<p>
Please note: to prevent abuse of our system, the same email address or 
username may <i>not</i> be used with a new account for at least six months.
Thank you for your understanding.
<p>
<div class="closebuttons">
<input type="submit" name="loginclosesubmit" value="Close My Account" class="login_close_confirm_button"/>
<input type="submit" name="loginclosecancel" value="Cancel" class="login_close_cancelled_button"/>
</form>
</div>
</div>

