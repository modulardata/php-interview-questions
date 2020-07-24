
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
							<h3> Edit Promotion</h3>
						</div>
						<div class="box-content">
                    <?php if(!empty($promotion_list)) {?>
						                 
                          <form class="form-horizontal" action="<?php echo site_url();?>/home/edit_promotion/<?php echo $promo_id; ?>" method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != '') {?> 
                              <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">×</button>
                                <?php echo validation_errors(); ?>                               
                              </div>
                          <?php } ?> 
                          
						   <?php if(!empty($errors))
                            {
                            ?>
                            <div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">×</button>
                                <strong>Error!</strong>
                                 <?php echo $errors; ?>
                            </div>
                             <?php } ?>
                                                           
                               <div class="control-group">
								<label class="control-label" for="service_type">Service Type</label>
								<div class="controls">
									<select id="service_type" name="service_type" required>
									<option value=""></option>
 									<optgroup label="Service Types">                                   				                                        <option value="1" <?php if($promotion_list->service_type == 1) echo 'selected'?>>Hotel</option>
                                        <option value="2" <?php if($promotion_list->service_type == 2) echo 'selected'?>>Flight</option>
                                        <option value="3" <?php if($promotion_list->service_type == 3) echo 'selected'?>>Car</option>
                                    </optgroup>										
								  </select>
								</div>
							  </div>  
                              
                              <div class="control-group">
								<label class="control-label" for="disabledInput">Promotion Name </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="promo_name" value="<?php echo $promotion_list->promo_name; ?>" required>              
                                                      
								</div>
							  </div> 
                              
                              <div class="control-group">
								<label class="control-label" for="disabledInput">Promotion Code </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="promo_code" value="<?php echo $promotion_list->promo_code; ?>" required> (Ex:- ALPROMO400)             
                                                      
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="disabledInput">Discount </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="discount" value="<?php echo $promotion_list->discount; ?>" required> (% Only)            
                                                      
								</div>
							  </div>  
                              
                               <div class="control-group">
								<label class="control-label" for="disabledInput">Valid Upto</label>
								<div class="controls">
								  <input id="date01" class="input-xlarge datepicker" type="text" value="<?php echo date('m/d/Y',strtotime($promotion_list->promo_expire)); ?>" name="promo_expire" required>             
                                                      
								</div>
							  </div>                                 
                                                             
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Edit Promotion</button>
								<a href="<?php echo site_url();?>/home/promotion_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
                          
               <?php } else { ?>
               		<div class="alert alert-error">
                        <button class="close" data-dismiss="alert" type="button">×</button>
                            <strong>Error!</strong>
                             No Data Found. Please try after some time....
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