
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
						<div class="box-head">
							<h3> Reset Sub Admin Password</h3>
						</div>
						<div class="box-content">
                    <?php if(!empty($admin_info)) {?>
						<form class="form-horizontal" action="<?php echo site_url();?>/role/change_admin_password/<?php echo $admin_id; ?>" method="post">
							<fieldset>
                            <?php
							  	if($status == '1')
								{
								?>
								<div class="alert alert-success">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Success!</strong>
									 Sub Admin Password Successfully Reseted.
								</div>
								<?php 
								}
								if(!empty($errors))
								{
								?>
                                <div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									<?php echo $errors;?>
								</div>
								 <?php
								}?>
																
                            
                             <?php if(validation_errors() != '') {?> 
                              <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">×</button>
                                <?php echo validation_errors(); ?>                               
                              </div>
                          <?php } ?> 
                                                         
                              <div class="control-group warning">
								<label class="control-label" for="disabledInput">Email-Id</label>
								<div class="controls">
                                 <div class="input-append">
								  <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $admin_info->login_email;?>" disabled="">
                                 
								</div>
                                </div>
							  </div>
                               
                               <div class="control-group">
								<label class="control-label" for="focusedInput">New Password</label>

								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="password" name="password"  autocomplete="off" required />                                   
								</div>
							  </div>
                              
                             <div class="control-group warning">
								<label class="control-label" for="focusedInput">Confirm Password</label>

								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="password" name="passconf"  autocomplete="off" required />              
                                  <span class="help-inline">(Must be same with New Password)</span>                     
								</div>
							  </div>
                              
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Reset Password</button>
								<a href="<?php echo site_url();?>/role/view_admin_info/<?php echo $admin_id; ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
                     
                     <?php }else{ ?>
                     <div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">×</button>
                                <strong>Error!</strong>
                                No Data Found. Please try after some time...
						</div>
                     <?php } ?>
					
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