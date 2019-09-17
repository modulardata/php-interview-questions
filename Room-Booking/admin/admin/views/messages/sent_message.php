
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
				<a href="<?php echo site_url();?>/messages/sent_message">
					Sent Message
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<div class="row-fluid no-margin">
				<div class="span12">
					<ul class="quicktasks">						
						<li>
							<a href="<?php echo site_url();?>/messages/sent_message">
								<img src="<?php echo base_url();?>public/img/icons/essen/32/pen.png" alt="">
								<span>Write message</span>
							</a>
						</li>
						<li>
							<a href="<?php echo site_url();?>/messages/inbox">
								<img src="<?php echo base_url();?>public/img/icons/essen/32/sign-out.png" alt="">
								<span>View messages</span>
							</a>
						</li>
						
					</ul>
				</div>
			</div>
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Compose Message</h3>
						</div>
						<div class="box-content">
							<form class="validate form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url();?>/messages/sent_message" >                                	
                                    <div class="control-group">
										<label class="control-label" for="user">Agent Email (To)</label>
										<div class="controls">
                                        <select name="agent_details" id="agent_details" style="width:350px;" class="uniform valid" required>
                                        <option value="">-- Select --</option>
                                        <?php for($i=0;$i<count($agents_info);$i++) {?>
                                            <option value="<?php echo $agents_info[$i]->agent_id;?>&&<?php echo $agents_info[$i]->agent_email;?>&&<?php echo $agents_info[$i]->agency_name;?>"><?php echo $agents_info[$i]->agency_name;?>(<?php echo $agents_info[$i]->agent_email;?>)</option>
                                            <?php } ?>	
                                        </select>
                                        </div>
									</div>
                                      <div class="control-group">
										<label class="control-label" for="city">Subject</label>
										<div class="controls">
										<input class="required" name="subject" id="subject" type="text" style="width:342px;" required />
										</div>
									</div>
                                      <div class="control-group">
										<label class="control-label" for="country">Message</label>
										<div class="controls">
											<textarea rows="6" data-max="1500" class="input-square span9 counter" name="message" id="textcounter" required></textarea>
                                            <div class="charleft originalTextareaInfo" style="width: 425.4px;"></div>
										</div>
									</div>
                                   
								<div class="form-actions">
									<input type="submit" class="btn btn-primary" value="Send Email">
								</div>
							</form>
									
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