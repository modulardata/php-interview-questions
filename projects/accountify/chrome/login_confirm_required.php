<?php
        $title = 'Email Confirmation Required';
        require 'page_head.php'
?>
<div class="login_confirm_required">
<p>
An email message has been sent to you and it should arrive shortly.
When you receive that email, <b>click on the link in the email message</b>
to verify your new account. This is necessary to prevent abuse of our
server. We apologize for any inconvenience.
</p>
<p>
<b>If you do not see the message, be sure to check your "spam" or "bulk" 
folder.</b> 
<p>
<b>Thanks for creating an account with us!</b>
</p>
</div>
<?php
        require 'continue_prompt.php';
?>
