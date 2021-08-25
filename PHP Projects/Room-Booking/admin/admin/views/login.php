
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: Admin Login Page ::</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
</head>
<body class='login_body'>
	<div class="wrap" style="height: 390px;">
		<h2>Roombooking</h2>
		<h4>Welcome to Admin login page</h4>
		<form action="<?php echo site_url(); ?>login/admin_login"  autocomplete="off" method="post">
		<div class="login">
        	<?php if(validation_errors() != '' || !empty($status)) {?>                   
                  <div class="alert alert-block alert-danger">
					 <a href="#" data-dismiss="alert" class="close">×</a>                     
                       <?php echo validation_errors(); ?>
                    	<?php if(!empty($status)) echo $status;?>
                  </div>
              <?php } ?> 
			<div class="email">
				<label for="user">Email</label><div class="email-input"><div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span><input type="email" id="loginEmailId"  name="loginEmailId" required></div></div>
			</div>
			<div class="pw">
				<label for="pw">Password</label><div class="pw-input"><div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input type="password" id="loginPassword" name="loginPassword" required></div></div>
			</div>
			<div class="remember">
				<label class="checkbox">
					<input type="checkbox"  value="1" name="remember"> Remember me on this computer
				</label>
			</div>           
		</div>
		<div class="submit">		
			<button class="btn btn-red5">Login</button>
		</div>
		</form>
	</div>
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

</body>
</html>