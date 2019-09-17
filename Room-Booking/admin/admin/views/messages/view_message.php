
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
				<a href="<?php echo site_url();?>/messages/view_message/<?php echo $message_info->id;?>">
					View & Reply Message
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
            <?php if (!empty($message_info)) { ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Subject: <?php echo $message_info->subject; ?></h3>
						</div>
						<div class="box-content">
							<ul class="messages"> 
								<li class="user<?php if($message_info->admin_id!=0){echo 2;}else{echo 1;}?>">
									<a href="#"><img src="<?php echo base_url();?>public/img/sample/40.gif" alt=""></a>
									<div class="info">
										<span class="arrow"></span>
										<div class="detail">
											<span class="sender">
												<strong><?php echo $message_info->from_name;?></strong> says:
											</span>
											<span class="time"><?php echo $message_info->sent_datetime;?></span>
										</div>
										<div class="message">
											<p><?php echo $message_info->message;?></p>
										</div>
									</div>
								</li>                      
							 <?php if (!empty($reply_message_info)) { ?>
                             	<?php for($k=0;$k<count($reply_message_info);$k++) {?>
                                	<li class="user<?php if($reply_message_info[$k]->admin_id!=0){echo 2;}else{echo 1;}?>">
									<a href="#"><img src="<?php echo base_url();?>public/img/sample/40.gif" alt=""></a>
									<div class="info">
										<span class="arrow"></span>
										<div class="detail">
											<span class="sender">
												<strong><?php echo $reply_message_info[$k]->from_name;?></strong> says:
											</span>
											<span class="time"><?php echo $reply_message_info[$k]->sent_datetime;?></span>
										</div>
										<div class="message">
											<p><?php echo $reply_message_info[$k]->message;?></p>
										</div>
									</div>
								</li> 
                                <?php } ?>
                             <?php  } ?>	
                         <?php if (!empty($message_info) && $message_info->message_status != 'T') { ?>
                             	<li class="user2">
									<a href="#"><img src="<?php echo base_url();?>public/img/sample/40.gif" alt=""></a>
									<div class="info">
										<span class="arrow"></span>
										<div class="detail">
											<span class="sender">
												<strong>Admin</strong> says:
											</span>
											
										</div>
										<div class="message">
                                        <?php $count = count($reply_message_info);?>
                    				<form enctype="multipart/form-data" method="post" action="<?php echo site_url();?>/messages/reply_message">
							<input type="hidden" value="<?php echo $message_info->subject; ?>" name="subject">  
                            <input type="hidden" value="<?php echo $message_info->id; ?>" name="msg_id">                  
                      		<input type="hidden" value="<?php echo $message_info->agent_id; ?>" name="agent_id">                          
							<textarea rows="6" data-max="1500" class="input-square span9 counter" id="textcounter" name="message" required></textarea><div class="charleft originalTextareaInfo" style="width: 491.4px;"></div>
                                                	
                                    <input type="submit" class="btn btn-primary" value="Reply">
                                    </form>
										</div>
									</div>
								</li>
                        <?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>         
            <?php }else{ ?> 
                <li>
                    <div class="message">
                        <p>No Message found...</p>
                    </div>	
                </li>
           <?php } ?>  
			
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