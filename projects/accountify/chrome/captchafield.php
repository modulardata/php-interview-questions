<?php
if (loginParameter('captcha') && (!isset($inviteCode))) {
	$imgUrl = captchaImgUrl();
	$wavUrl = captchaWavUrl();
?>
<div class="<?php echo $classPrefix?>_captcha">
<div class="<?php echo $classPrefix?>_visual_captcha">
<img src="<?php echo $imgUrl?>"/> 
</div>
<div class="<?php echo $classPrefix?>_audio_captcha">
<a href="<?php echo $wavUrl?>">Listen To This</a>
</div>
<p>
To prevent abuse of the system, please enter the code shown in the picture above.
</p>
<div class="<?php echo $classPrefix?>_field">
<div class="<?php echo $classPrefix?>_field_label">Enter Code</div>
<input type="text" name="captcha" 
	value=""
	size="16" maxlength="16" 
	class="<?php echo $classPrefix?>_field_value"/> 
</div>
</div>
<?php
}
?>
