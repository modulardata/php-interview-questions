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
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.jgrowl.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url(); ?>/role/add_admin_user">
					Create Sub-Admin User
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
				<?php echo $this->load->view('topmenu'); ?>
		
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Create Sub-Admin User</h3>
						</div>                        
						<div class="box-content">
						<form class="form-horizontal" action="<?php echo site_url(); ?>/role/add_admin_user" enctype="multipart/form-data" method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != ""){ ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>
                               
                                <?php
							  	if(!empty($errors))
								{
								?>
								<div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									 <?php echo $errors;?>
								</div>
								<?php 
								}
								?>
                                
                                <legend>Login Information</legend>
                                
                              <div class="control-group warning">
								<label class="control-label" for="focusedInput">Email-Id</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="email" name="admin_email" value="<?php if( isset($admin_email)) echo $admin_email; ?>" required>
                                   <span class="help-inline">Login Email-Id / UserName</span>
                                  
								</div>
                                
							  </div>
                           
                              <div class="control-group">
								<label class="control-label" for="disabledInput">Password</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="password" name="admin_password" required>              
                                                      
								</div>
							  </div>                              
                                                          
                             <div class="control-group warning">
								<label class="control-label" for="focusedInput">Confirm Password</label>

								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="password" name="passconf" required>              
                                  <span class="help-inline">(Must be same with 'Password')</span>                     
								</div>
							  </div>
                              
                               <div class="control-group">
								<label class="control-label" for="selectError3">Admin User Level</label>
								<div class="controls">
								  <select id="selectError1" name="role_id" required>
                                  	<option value="">Select User Level </option>
									<option value="2">Sub Admin</option>								
								 </select>
								</div>
							  </div>
                                                         
							<legend>Personal Information</legend>
                            
							  <div class="control-group">
								<label class="control-label" for="selectError3">Title</label>
								<div class="controls">
								  <select id="selectError3" name="title" required>
									<option value="Mr">Mr.</option>
									<option value="Mrs">Mrs.</option>
									<option value="Dr">Dr.</option>
								 </select>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">First Name</label>

								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="first_name" value="<?php if( isset($first_name)) echo $first_name; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="control-group warning">
								<label class="control-label" for="focusedInput">Middle Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="middle_name" value="<?php if( isset($middle_name)) echo $middle_name; ?>" />
                                   <span class="help-inline">(Optional)</span>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="last_name" value="<?php if( isset($last_name)) echo $last_name; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Mobile Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="number" name="mobile_no" value="<?php if( isset($mobile_no)) echo $mobile_no; ?>" required>                                   
								</div>
							  </div>
                              
                               <div class="control-group">
								<label class="control-label" for="focusedInput">Address</label>
								<div class="controls">
								  <textarea class="input-xlarge focused" id="focusedInput" type="text" name="address" required><?php if( isset($address)) echo $address; ?></textarea>                                   
								</div>
							  </div>
                              
                               <div class="control-group">
								<label class="control-label" for="focusedInput">Pin Code</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="pin_code" value="<?php if( isset($pin_code)) echo $pin_code; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">City</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="city" value="<?php if( isset($city)) echo $city; ?>" required>                                   
								</div>
							  </div>
                              
                               <div class="control-group">
								<label class="control-label" for="focusedInput">State</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="state"  value="<?php if( isset($state)) echo $state; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="selectError2">Country</label>
								<div class="controls">
									<select data-placeholder="Select Your Country" id="selectError3" data-rel="chosen" name="country" required>
										<option value=""></option>
										<optgroup label="Country List">                                       
                                        <?php
											for($i=0;$i<count($country_list);$i++) {?>
											<option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div>  
                             
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Add Sub Admin</button>
								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
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
<script src="<?php echo base_url();?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url();?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url();?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>public/js/bbq.js"></script>
<script src="<?php echo base_url();?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.wizard-min.js"></script>
<script src="<?php echo base_url();?>public/js/custom.js"></script>
</body>
</html>