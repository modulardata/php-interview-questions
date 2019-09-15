</div>
<div class="login_create_buttons">
<?php
	# Must output 'next' first so that Firefox doesn't
	# do the wrong thing when the 'enter' key is pressed.
	# We'll fix it visually with CSS.
if (isset($next)) {
	?>
<div class="login_create_next_button">
<input type="submit" name="login_next" value="Next &gt;"/>
</div>
	<?php
} else {
	?>
<div class="login_create_finished_button">
<input type="submit" name="login_ok" value="Finished"/>
</div>
	<?php
}
if (isset($previous)) {
	?>
<div class="login_create_previous_button">
<input type="submit" name="login_previous" value="&lt; Previous"/>
</div>
	<?php
}
	?>
<div class="login_create_cancel_button">
<input type="submit" name="login_cancel" value="Cancel"/>
</div>
</div>
</div>
</form>
<?php
	require 'page_tail.php';
?>
