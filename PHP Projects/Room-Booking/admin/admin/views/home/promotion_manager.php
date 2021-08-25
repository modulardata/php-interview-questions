
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: Admin Console ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url();?>/home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url();?>/home">
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
			<?php echo $this->load->view('topmenu'); ?>
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Promotion Manager</h3>
                           
                                
                           <ul class="nav nav-pills">                           
								<li class="active">
									<a data-toggle="tab" href="#promotion-list">Promotion Manager</a>
								</li>								
							</ul>							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="promotion-list">
                                    	  <legend>Add New Promotion</legend> 
                        
                        <form class="form-horizontal" action="<?php echo site_url(); ?>/home/add_promotion" method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != ""){ ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>
                                                           
                               <div class="control-group">
								<label class="control-label" for="selectError1">Service Type</label>
								<div class="controls">
									<select id="selectError1" name="service_type" required>
									<option value=""></option>
 									<optgroup label="Service Types">                                   				                                        <option value="1">Hotel</option>
                                        <option value="2">Flight</option>
                                        <option value="3">Car</option>
                                    </optgroup>										
								  </select>
								</div>
							  </div>  
                              
                              <div class="control-group">
								<label class="control-label" for="disabledInput">Promotion Name </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="promo_name" value="<?php if(isset($promo_name))echo $promo_name; ?>" required>              
                                                      
								</div>
							  </div> 
                              
                              <div class="control-group">
								<label class="control-label" for="disabledInput">Promotion Code </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="promo_code" value="<?php if(isset($promo_code))echo $promo_code; ?>" required> (Ex:- ALPROMO400)             
                                                      
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="disabledInput">Discount </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="discount" value="<?php if(isset($discount))echo $discount; ?>" required> (% Only)            
                                                      
								</div>
							  </div>  
                              
                               <div class="control-group">
								<label class="control-label" for="disabledInput">Valid Upto</label>
								<div class="controls">
								  <input id="datepicker" class="datepick" type="text" value="<?php if(isset($promo_expire))echo $promo_expire; ?>" name="promo_expire" required>                                       
                                                      
								</div>
							  </div>                                 
                                                             
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Add Promotion</button>
								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
                       
                
										<table class='table table-striped dataTable table-bordered'>
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>Service Type</th>
                                                  <th>Promo Name</th>
                                                  <th>Promo Code</th>                                 
                                                  <th>Discount (%)</th>                                
                                                  <th>Valid Upto</th>
                                                  <th>Created DateTime</th>
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
											<tbody>
                                             <?php if(!empty($promotion_list)) {?>
                          <?php 
						  for($i=0;$i<count($promotion_list);$i++) {?>                             
							<tr>
                                <td><?php echo $i+1;?></td>
                            	<td>
								<?php
								    if($promotion_list[$i]->service_type == 1) 
										echo 'Hotel';
									else if($promotion_list[$i]->service_type == 2)
										echo 'Flight';
									else if($promotion_list[$i]->service_type == 3)
										echo 'Car';
								?>
                                </td>
								<td class="center"><?php echo $promotion_list[$i]->promo_name;?></td>
								<td class="center"><?php echo $promotion_list[$i]->promo_code;?></td>            
                                <td class="center"><?php echo $promotion_list[$i]->discount;?></td>
                                <td class="center"><?php echo $promotion_list[$i]->promo_expire;?></td>
                                <td class="center"><?php echo $promotion_list[$i]->created_datetime;?></td>
								<td class="center">
                                <?php if($promotion_list[$i]->status == 0) { ?>
									<span class="label">Inactive</span>
                                 <?php } else if($promotion_list[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } else { ?>
                                  <span class="label label-important">Blocked</span>
                                 <?php } ?>
								</td>
								<td class="center">
									
                                    <a class="btn btn-small managePromoStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-promo-id="<?php echo $promotion_list[$i]->promo_id;?>" >
										<i class="icon-ok"></i>			                                          
									</a>
                                     <a class="btn btn-small managePromoStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-promo-id="<?php echo $promotion_list[$i]->promo_id;?>" >
										<i class="icon icon-color icon-remove"></i>			                                          
									</a>
									<a class="btn btn-danger managePromoStatus" href="javascript:void(0);" title="Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-promo-id="<?php echo $promotion_list[$i]->promo_id;?>" >
										<i class="icon-trash icon-white"></i> 
										
									</a>
                                    <a class="btn btn-primary" data-rel="tooltip" href="<?php echo site_url();?>/home/edit_promotion/<?php echo $promotion_list[$i]->promo_id;?>" data-original-title="View / Edit">
										<i class="icon-edit icon-white"></i>
									</a>
								</td>
							</tr>
                          
                         <?php } ?>
                     <?php } else { ?>
                        
                                                 <div class="alert alert-error">
                                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Error!</strong>
                                                        No Data Found. Please try after some time...
                                                </div>
                                              
                                             <?php } ?>
											</tbody>
										</table>
                                        
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

<script src="<?php echo base_url(); ?>public/js/less.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>

<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

</body>
</html>