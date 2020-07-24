
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
							<h3>Currency Manager</h3>                          
                           <ul class="nav  nav-pills">                           
								<li class="active">
									<a data-toggle="tab" href="#currency-list">Currency Converter</a>
								</li>
								<li class="">
									<a data-toggle="tab" class="updateCurrency" href="#update-currency" data-base-url="<?php echo site_url();?>/">Update Currency Values</a>                                    
								</li>
							</ul>							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="currency-list">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>Currency Name</th>
                                                  <th>Currency Code</th>
                                                  <th>Value (1 USD = )</th> 
                                                  <th>Updated DateTime</th>                                
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>
											<tbody>
                                             <?php if(!empty($currency_list)) {?>
                          <?php for($i=0;$i<count($currency_list);$i++) {?>
							<tr>
                                <td><?php echo $i+1;?></td>
                            	<td><?php echo $currency_list[$i]->currency_name;?></td>
								<td class="center"><?php echo $currency_list[$i]->currency_code;?></td>
								<td class="center"><?php echo $currency_list[$i]->value;?></td>             
                                <td class="center"><?php echo $currency_list[$i]->updated_datetime;?></td>
                               <td class="center">
                                <?php if($currency_list[$i]->status == 0) { ?>
									<span class="label">Inactive</span>
                                 <?php } else if($currency_list[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } ?>
								</td>                                
								<td class="center">
									
                                    <a class="btn btn-small manageCurrencyStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-currency-id="<?php echo $currency_list[$i]->currency_id;?>" >
										<i class="icon-ok"></i>			                                          
									</a>
                                     <a class="btn btn-small manageCurrencyStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-currency-id="<?php echo $currency_list[$i]->currency_id;?>" >
										<i class="icon icon-color icon-remove"></i>			                                          
									</a>
                                    
									<!--<a class="btn btn-primary" href="<?php echo site_url();?>/home/edit_currency_value/<?php echo $currency_list[$i]->currency_id;?>" title="Edit Currency" data-rel="tooltip">
										<i class="icon-edit icon-white"></i>			                                          
									</a>-->
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
                                    
                                    <div class="tab-pane" id="update-currency">
                                    
                                    	 <div class="alert alert-info"  id="currencyImg" style="display:none;">
                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Currency Update!</strong>
                                            Please wait currency values are updating automatically. It will take around 2-3 minutes...
                                            <br /><br />                               
                                        <div class="progress progress-striped progress-success active">
                                            <div class="bar" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    
										<table class='table table-striped dataTable table-bordered'>
                                          <thead>
                                              <tr> 
                                                  <th>SI.No</th>                             	
                                                  <th>Currency Name</th>
                                                  <th>Currency Code</th>
                                                  <th>Value (1 USD=)</th> 
                                                  <th>Updated DateTime</th>                                
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>   
                                          <tbody>
                                           <?php if(!empty($currency_list)) {?>
                          <?php for($i=0;$i<count($currency_list);$i++) {?>
							<tr>
                                <td><?php echo $i+1;?></td>
                            	<td><?php echo $currency_list[$i]->currency_name;?></td>
								<td class="center"><?php echo $currency_list[$i]->currency_code;?></td>
								<td class="center"><?php echo $currency_list[$i]->value;?></td>             
                                <td class="center"><?php echo $currency_list[$i]->updated_datetime;?></td>
                               <td class="center">
                                <?php if($currency_list[$i]->status == 0) { ?>
									<span class="label">Inactive</span>
                                 <?php } else if($currency_list[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } ?>
								</td>                                
								<td class="center">
									
                                    <a class="btn btn-small manageCurrencyStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-currency-id="<?php echo $currency_list[$i]->currency_id;?>" >
										<i class="icon-ok"></i>			                                          
									</a>
                                     <a class="btn btn-small manageCurrencyStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-currency-id="<?php echo $currency_list[$i]->currency_id;?>" >
										<i class="icon icon-color icon-remove"></i>			                                          
									</a>
                                    
									<!--<a class="btn btn-primary" href="<?php echo site_url();?>/home/edit_currency_value/<?php echo $currency_list[$i]->currency_id;?>" title="Edit Currency" data-rel="tooltip">
										<i class="icon-edit icon-white"></i>			                                          
									</a>-->
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