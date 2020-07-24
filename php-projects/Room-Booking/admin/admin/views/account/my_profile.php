
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: Admin Console ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.jgrowl.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>

<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="dashboard.html"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="dashboard.html">
					Dashboard
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>My Profile</h3>
							<ul class="nav nav-tabs">
								<li class='active'>
									<a href="#basic" data-toggle='tab'>Basic information</a>
								</li>
								
							</ul>
						</div>
                        
						<div class="box-content">
                        <?php 
						if($status == '0')
						{
							?>
                        <div class="alert alert-block alert-success">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Success!</h4>
							  Your Details Successfully Updated.
							</div>
                            <?php 
						}
						elseif($status == '1')
						{
							?><div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Failure!</h4>
							   Your Profile Not Updated. Please provide correct information
							</div>
                         <?php
						}
						?>
							<form action="<?php echo site_url();?>/home/update_profile" method="post" class="form-horizontal">
							<div class="tab-content">
								<div class="tab-pane active" id="basic">
										<div class="control-group">
											<label for="username" class="control-label">Email-Id</label>
											<div class="controls">												
                                                <div class="input-append">
													<span class="input-medium uneditable-input"><?php echo $admin_info->login_email; ?></span><span class="add-on">
                                                    <i class="icon-envelope"></i>
                                                    </span>
                                                    <input type="hidden" value="<?php echo $admin_info->login_email;?>" name="login_email" readonly class="uneditable-input" />
												</div>
                                                <p class="help-block">Login Email-Id / UserName</p>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Password</label>
											<div class="controls">
												<div class="input-append">
													<span class="input-medium uneditable-input">******</span><span class="add-on"><i class="icon-lock"></i></span>
												</div>
												<a href="<?php echo site_url();?>/home/change_password" class="btn-danger btn">New password</a>
												<p class="help-block">The password is hidden for security!</p>
											</div>
										</div>
										<div class="control-group">
											<label for="email" class="control-label">Title</label>											
                                            <div class="controls">
											<select id="select" name="title">
												<option value="Mr" <?php if($admin_info->title =='Mr') echo 'selected';?>>Mr.</option>
                                                <option value="Mrs" <?php if($admin_info->title =='Mrs') echo 'selected';?>>Mrs.</option>
                                                <option value="Dr" <?php if($admin_info->title =='Dr') echo 'selected';?>>Dr.</option>
											</select>
										</div>
										</div>
										<div class="control-group">
											<label for="date" class="control-label">First Name</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" id="first_name" value="<?php echo $admin_info->first_name;?>" name="first_name" required /><span class="add-on"><i class="icon-user"></i></span>
												</div>
											</div>
										</div>
                                        <div class="control-group">
											<label for="date" class="control-label">Middle Name</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" id="middle_name" value="<?php echo $admin_info->middle_name;?>" name="middle_name" /><span class="add-on"><i class="icon-user"></i></span>                                                    
												</div>
                                                 <p class="help-block">(Middle Name Optional)</p>
											</div>                                           
										</div>
                                        <div class="control-group">
											<label for="date" class="control-label">Last Name</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" id="last_name" value="<?php echo $admin_info->last_name;?>" name="last_name" required /><span class="add-on"><i class="icon-user"></i></span>
												</div>
											</div>
										</div>
                                        <div class="control-group">
											<label for="date" class="control-label">Mobile No</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="mobile_no" id="mobile_no" value="<?php echo $admin_info->mobile_no; ?>" required /><span class="add-on"><i class="icon-home"></i></span>
												</div>
											</div>
										</div>
                                        
                                        <div class="control-group">
											<label for="date" class="control-label">Address</label>
											<div class="controls">
												<div class="input-append">													
                                                    <textarea rows="2" cols="45" class="span9 input-square" id="address" name="address" required><?php echo $admin_info->address; ?></textarea>                                                   
												</div>
											</div>
										</div>
                                        
                                        <div class="control-group">
											<label for="date" class="control-label">Postal Code</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="pin_code" id="pin_code" value="<?php echo $admin_info->pin_code; ?>" required />
												</div>
											</div>
										</div>
                                        <div class="control-group">
											<label for="date" class="control-label">City</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="city" id="city" value="<?php echo $admin_info->city; ?>" required />
												</div>
											</div>
										</div>
                                         <div class="control-group">
											<label for="date" class="control-label">State</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="state" id="state" value="<?php echo $admin_info->state; ?>" required />
												</div>
											</div>
										</div>
										
								</div>
								
							</div>
								<div class="form-actions">
									<input type="submit" class='btn btn-primary' value="Update">
									<input type="reset" class='btn btn-danger' value="Reset">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	
<script src="<?php echo base_url();?>public/js/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/less.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.peity.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url();?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url();?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.color.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.resize.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo base_url();?>public/js/custom.js"></script>
</body>
</html>