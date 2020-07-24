
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
							<h3>API Manager</h3>                          
                           <ul class="nav  nav-pills">                           
								<li class="active">
									<a data-toggle="tab" href="#hotel-api-list">Hotel API's</a>
								</li>
<!--								<li class="">
									<a data-toggle="tab" href="#flight-api-list">Flight API's</a>                                    
								</li>
                                <li class="">
									<a data-toggle="tab" href="#car-api-list">Car API's</a>                                    
								</li>-->
							</ul>							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="hotel-api-list">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>API Name</th>
                                                  <th>Client Id</th>
                                                  <th>User Name</th>
                                                  <th>Password</th>  
                                                  <th>Live URL</th>
                                                  <th>Demo URL</th>
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>
											<tbody>
                                             <?php if(!empty($hotel_api_list)) {?>
										  <?php for($i=0;$i<count($hotel_api_list);$i++) {?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                <td><?php echo $hotel_api_list[$i]->api_name;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->client_id;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->username;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->password;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->live_url;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->demo_url;?></td>             					<td class="center">
                                                <?php if($hotel_api_list[$i]->status == 0) { ?>
                                                    <span class="label">Inactive</span>
                                                 <?php } else if($hotel_api_list[$i]->status == 1) {?>
                                                 <span class="label label-success">Active</span>
                                                 <?php } ?>
                                                </td>
                                                <td class="center">
                                                    
                                                    <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $hotel_api_list[$i]->api_id;?>" data-api-name="<?php echo $hotel_api_list[$i]->api_name;?>">
                                                        <i class="icon-ok"></i>			                                          
                                                    </a>
                                                     <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $hotel_api_list[$i]->api_id;?>" data-api-name="<?php echo $hotel_api_list[$i]->api_name;?>">
                                                        <i class="icon icon-color icon-remove"></i>			                                          
                                                    </a>
                                                    
                                                    <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $hotel_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
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
                                    
                                    <div class="tab-pane" id="flight-api-list">                                    
                                    	
										<table class='table table-striped dataTable table-bordered'>
                                          <thead>
                                              <tr> 
                                                   <th>SI.No</th>                             	
                                                  <th>API Name</th>
                                                  <th>Client Id</th>
                                                  <th>User Name</th>
                                                  <th>Password</th>  
                                                  <th>Live URL</th>
                                                  <th>Demo URL</th>
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>   
                                          <tbody>
								<?php if(!empty($flight_api_list)) {?>
                                  <?php for($i=0;$i<count($flight_api_list);$i++) {?>
                                    <tr>
                                        <td><?php echo $i+1;?></td>
                                        <td><?php echo $flight_api_list[$i]->api_name;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->client_id;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->username;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->password;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->live_url;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->demo_url;?></td>             					<td class="center">
                                        <?php if($flight_api_list[$i]->status == 0) { ?>
                                            <span class="label">Inactive</span>
                                         <?php } else if($flight_api_list[$i]->status == 1) {?>
                                         <span class="label label-success">Active</span>
                                         <?php } ?>
                                        </td>
                                        <td class="center">
                                            
                                            <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $flight_api_list[$i]->api_id;?>" data-api-name="<?php echo $flight_api_list[$i]->api_name;?>">
                                                <i class="icon-ok"></i>			                                          
                                            </a>
                                             <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $flight_api_list[$i]->api_id;?>" data-api-name="<?php echo $flight_api_list[$i]->api_name;?>">
                                                <i class="icon icon-color icon-remove"></i>			                                          
                                            </a>
                                            
                                            <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $flight_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
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
                                    
                                    <div class="tab-pane" id="car-api-list">                                    
                                    	
										<table class='table table-striped dataTable table-bordered'>
                                          <thead>
                                              <tr> 
                                                   <th>SI.No</th>                             	
                                                  <th>API Name</th>
                                                  <th>Client Id</th>
                                                  <th>User Name</th>
                                                  <th>Password</th>  
                                                  <th>Live URL</th>
                                                  <th>Demo URL</th>
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>   
                                          <tbody>
								<?php if(!empty($car_api_list)) {?>
                                  <?php for($i=0;$i<count($car_api_list);$i++) {?>
                                    <tr>
                                        <td><?php echo $i+1;?></td>
                                        <td><?php echo $car_api_list[$i]->api_name;?></td>
                                        <td class="center"><?php echo $car_api_list[$i]->client_id;?></td>
                                        <td class="center"><?php echo $car_api_list[$i]->username;?></td>
                                        <td class="center"><?php echo $car_api_list[$i]->password;?></td>
                                        <td class="center"><?php echo $car_api_list[$i]->live_url;?></td>
                                        <td class="center"><?php echo $car_api_list[$i]->demo_url;?></td>             					<td class="center">
                                        <?php if($car_api_list[$i]->status == 0) { ?>
                                            <span class="label">Inactive</span>
                                         <?php } else if($car_api_list[$i]->status == 1) {?>
                                         <span class="label label-success">Active</span>
                                         <?php } ?>
                                        </td>
                                        <td class="center">
                                            
                                            <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $car_api_list[$i]->api_id;?>" data-api-name="<?php echo $car_api_list[$i]->api_name;?>">
                                                <i class="icon-ok"></i>			                                          
                                            </a>
                                             <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $car_api_list[$i]->api_id;?>" data-api-name="<?php echo $car_api_list[$i]->api_name;?>">
                                                <i class="icon icon-color icon-remove"></i>			                                          
                                            </a>
                                            
                                            <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $car_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
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