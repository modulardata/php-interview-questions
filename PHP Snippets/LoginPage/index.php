<?php
	$pageTitle;
	$year = '2011'; $month = '09';
	$permalink = 'login';
	$pageTitle = 'Input placeholder text improvement';
	$contentTitle = 'CSS<span>-PLUS</span>';
	$analytics = false;
	$jquery = true;
	$modernizr = true;
	
	include('../../../includes/header.php'); ?>
	
	<h2>Example login form demonstrating ways to improve placeholder text</h2>

	<form id="login">
		<ul>
			<li>
				<input id="email" name="email" placeholder="Your Email" title="Your Email" type="email" value="" required />
				<label for="email">Your Email</label>
			</li>
			<li>
				<input id="password" name="password" placeholder="Your Password" title="Your Password" type="password" value="" required />
				<label for="password">Your Password</label>
			</li>
			<li>
				<input id="submit" name="submit" type="submit" value="Login">
			</li>
		</ul>
	</form>
<?php include_once('../../../includes/footer.php'); ?>
<script>
$(document).ready(function(){
	/* Demo page styling */
	var marginTop = ($(window).height() / 2 ) - 300;
	if(marginTop > 0){
		$('h1').css('marginTop', marginTop);
	}

	$(window).resize(function(){
		var marginTop = ($(window).height() / 2 ) - 300;
		if(marginTop > 0){
			$('h1').css('marginTop', marginTop);
		}
	});
	/* End demo page styling */

    if(!Modernizr.input.placeholder) {
        $("input[placeholder]").each(function() {
            var placeholder = $(this).attr("placeholder");

            $(this).val(placeholder).focus(function() {
                if($(this).val() == placeholder) {
                    $(this).val("")
                }
            }).blur(function() {
                if($(this).val() == "") {
                    $(this).val(placeholder)
                }
            });
        });
    } // Modernizr placeholder
});
</script>
</body>
</html>