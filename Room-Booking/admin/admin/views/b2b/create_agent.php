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
				<a href="<?php echo site_url(); ?>/b2b/create_agent">
					Create B2B User
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
							<h3>Create New Agent</h3>
						</div>                        
						<div class="box-content">
							<form action="<?php echo site_url(); ?>/b2b/create_agent" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
                          <?php if(validation_errors() != '') {?>                              
                              <div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Errors!</h4>
							  <?php echo validation_errors(); ?>  
							</div>
                          <?php } ?>
                          
                          <?php
							  	if($status == '1')
								{
								?>
								<div class="alert alert-block alert-success">
								 <a href="#" data-dismiss="alert" class="close">×</a>									
                                    <h4 class="alert-heading">Success!</h4>
									Agent Created Successfully.
								</div>
								<?php 
								}
								else if($status == '2')
								{
								?>                            
                                 <div class="alert alert-block alert-danger">
                                      <a href="#" data-dismiss="alert" class="close">×</a>
                                      <h4 class="alert-heading">Error!</h4>
                                      Agent Registration Not Done. Please try after some time...
								  </div>
								 <?php
								}
								?>
                               
                                <?php
							  	if(!empty($errors))
								{
								?>								
                                 <div class="alert alert-block alert-danger">
                                      <a href="#" data-dismiss="alert" class="close">×</a>
                                      <h4 class="alert-heading">Error!</h4>
                                       <?php echo $errors;?>
								  </div>
								<?php 
								}
								?>                         
                          
                            	<legend>Login Information</legend>
								<div class="control-group">
									<label for="req" class="control-label">Email-Id</label>								
                                    <div class="controls">
								  <input class='required' id="agent_email" type="email" name="agent_email" value="<?php if( isset($agent_email)) echo $agent_email; ?>" required>                                   
                                  <p class="help-block">Login Email-Id / UserName</p>
								</div>
								</div>
                                <div class="control-group">
									<label for="pw3" class="control-label">New Password</label>
									<div class="controls">
										<input type="password" name="agent_password" id="agent_password" class='required'/>
									</div>
								</div>
								<div class="control-group">
									<label for="pw4" class="control-label">Confirm password</label>
									<div class="controls">
										<input type="password" name="passconf" id="passconf" class='required' equalTo="#agent_password" />
										<p class="help-block">Must match 'New Password'</p>
									</div>
								</div>
                               
                               <legend>Agency Information</legend>
                                
                                  <div class="control-group">
									<label for="agentnumber" class="control-label">Agent Number</label>
								<div class="controls">                              
								  <input class="uneditable-input" type="text" placeholder="ALAXXXX format" disabled="" />								                                  
                                <p class="help-block">(Automatically Agent No will be generated, Ex:- ALA1234)</p>
                                </div>
							  </div>
                                <div class="control-group">
									<label for="company" class="control-label">Agency/Company Name</label>
									<div class="controls">
										<input type="text" id="agency_name" class="required" name="agency_name" value="<?php if( isset($agency_name)) echo $agency_name; ?>" required />
									</div>
								</div>
								<div class="control-group">
                                    <label class="control-label" for="file2">Agency Logo</label>
                                    <div class="controls">
                                        <div class="uploader" id="uniform-file2">
                                            <input type="file" class="uniform" id="file2" name="agency_logo" size="19" style="opacity: 0;" required />
                                            <span class="filename" style="-moz-user-select: none;">No file selected</span>
                                            <span class="action" style="-moz-user-select: none;">Choose File</span>
                                        </div>
                                    </div>
                            	</div>
                                
								<div class="control-group">
								<label class="control-label" for="Currency">Currency</label>
								<div class="controls">
									<select name="currency_type" class="required" required>
										<option value="">Select Currency</option>
										<optgroup label="Currency List">                                       
                                        <?php
											for($i=0;$i<count($currency_list);$i++) {?>
											<option value="<?php echo $currency_list[$i]->currency_code; ?>"><?php echo $currency_list[$i]->currency_code; ?>&nbsp;-&nbsp;<?php echo $currency_list[$i]->currency_name; ?></option>
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div>
                              
                              <legend>Personal Information</legend>
                                
								 <div class="control-group">
								<label class="control-label" for="selectError3">Title</label>
								<div class="controls">
								  <select class="required" name="title" required>
									<option value="Mr">Mr.</option>
									<option value="Mrs">Mrs.</option>
									<option value="Dr">Dr.</option>
								 </select>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">First Name</label>

								<div class="controls">
								  <input class="input-xlarge focused" id="first_name" type="text" name="first_name" value="<?php if( isset($first_name)) echo $first_name; ?>" required />                                   
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Middle Name</label>
								<div class="controls">
								  <input id="middle_name" type="text" name="middle_name" value="<?php if( isset($middle_name)) echo $middle_name; ?>" />
                                   <p class="help-block">(Middle Name Optional)</p>
								</div>
                                
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <input class="required" id="last_name" type="text" name="last_name" value="<?php if( isset($last_name)) echo $last_name; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Mobile Number</label>
								<div class="controls">
								  <input class="required" id="mobile_no" type="number" name="mobile_no" value="<?php if( isset($mobile_no)) echo $mobile_no; ?>" required>                                   
								</div>
							  </div>
                              
                               <div class="control-group">
								<label class="control-label" for="focusedInput">Office Number</label>
								<div class="controls">
								  <input class="required" id="office_phone_no" type="number" name="office_phone_no" value="<?php if( isset($office_phone_no)) echo $office_phone_no; ?>" required>                                   
								</div>
							  </div>
                              
                            <div class="control-group">
                                    <label for="pw5" class="control-label">Address</label>
                                    <div class="controls">                                      
                                         <textarea rows="2" cols="45" class="required" id="address" name="address" required><?php if( isset($address)) echo $address; ?></textarea> 
                                    </div>
                             </div>                           
                          <div class="control-group">
								<label class="control-label" for="focusedInput">Pin Code</label>
								<div class="controls">
								  <input class="required" id="pin_code" type="text" name="pin_code" value="<?php if( isset($pin_code)) echo $pin_code; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">City</label>
								<div class="controls">
								  <input class="required" id="city" type="text" name="city" value="<?php if( isset($city)) echo $city; ?>" required>                                   
								</div>
							  </div>
                              
                               <div class="control-group">
								<label class="control-label" for="focusedInput">State</label>
								<div class="controls">
								  <input class="required" id="state" type="text" name="state"  value="<?php if( isset($state)) echo $state; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="selectError2">Country</label>
								<div class="controls">
									<select class="required" id="country" name="country" required>
										<option value="">Select Your Country</option>
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
									<input type="submit" class="btn btn-primary" value="Create Agent">
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