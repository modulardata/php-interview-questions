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
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.jgrowl.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
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
                                    <h3>Approve Deposited Amount</h3>
                                </div>                        
                                <div class="box-content">
                                    <form action="<?php echo site_url(); ?>/b2b/approve_amount" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
                                        <input class="input-xlarge focused" id="" type="hidden" name="agent_no" value="<?php echo $agentno ?>" required desabled>                                                              
                                        <input class="input-xlarge focused" id="" type="hidden" name="depositno" value="<?php echo $depositno ?>" required desabled>                                                              

                                        <?php if (validation_errors() != '') { ?>                              
                                            <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                <?php echo validation_errors(); ?>  
                                            </div>
                                        <?php } ?>




                                        <?php
                                        if (!empty($errors)) {
                                            ?>								
                                            <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">X</a>
                                                <h4 class="alert-heading">Error!</h4>
                                                <?php echo $errors; ?>
                                            </div>
                                            <?php
                                        }
                                        ?>                         

                                        <legend>Account Summary</legend>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Available Balance</label>								
                                            <div class="controls">
                                                
                                                <input class="input-xlarge focused" id="" type="text" name="available_balance" value="<?php echo $available_balance ?>" required readonly>                                                              
                                              
                                                
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="pw3" class="control-label">Deposited Amount</label>
                                            <div class="controls">
                                                <input class="input-xlarge focused" id="" type="text" name="dep_amt" value="<?php echo $deposit ?>" required readonly>                                                              
                                            </div>
                                        </div>
  
                                        
                                        <legend>Transaction Information</legend>

                                        <div class="control-group">
                                            <label for="agentnumber" class="control-label">Transaction Id</label>
                                            <div class="controls">                              
                                                
                                                <?php echo $transact_id ?>
                                                
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="company" class="control-label">Bank</label>
                                            <div class="controls">
                                                 <?php echo $bank ?>
                                            </div>
                                        </div>
                                
                                        

                                        <div class="control-group">
                                            <label class="control-label" for="Currency">Branch</label>
                                            <div class="controls">
                                           
                                                 <?php echo $branch ?>
                                            </div>
                                        </div>

                         

                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">City</label>
                                            <div class="controls">
                                                 <?php echo $city ?>
                                            </div>
                                        </div>

                            
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Approve Amount">
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
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.jgrowl_minimized.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bbq.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.wizard-min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
    </body>
</html>