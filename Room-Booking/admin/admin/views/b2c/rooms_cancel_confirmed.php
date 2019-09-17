
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
                        <a href="<?php echo site_url(); ?>home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>home">
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
                                    <h3>B2C Booking Reports Manager</h3>

                                    <ul class="nav  nav-pills">                           
                                        <li class="active">
                                            <a data-toggle="tab" href="#hotel-reports">Cancel Hotel</a>
                                        </li>
                                        <!--                                        <li class="">
                                                                                    <a data-toggle="tab" href="#int_hotel-reports">International Hotel Reports</a>
                                                                                </li>-->


                                    </ul>							
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="hotel-reports" style="overflow:auto;">


                                            <fieldset>
                                                <input type="hidden" namr="case" value="Cancel"/>
                                                <legend>Cancellation Information</legend>
                                                <?php $cancel_data = $this->session->userdata('cancel_confirm_array'); ?>
                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Booking_reference_ID</label>
                                                    <div class="controls">
                                                        <?php echo $cancel_data['HotelId'] ?>
                                                        <input readonly="readonly" type="hidden" name="HotelId" value="<?php echo $cancel_data['HotelId'] ?>"/>
                                                    </div>
                                                </div>
                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Booking Reference</label>
                                                    <div class="controls">
                                                        <?php echo $cancel_data['Book_reference']; ?>
                                                        <input type="hidden" name="Book_reference" value="<?php echo $cancel_data['Book_reference']; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Created Date</label>
                                                    <div class="controls">
                                                        <?php echo $cancel_data['Book_CreationDate']; ?>
                                                        <input type="hidden" name="Book_CreationDate" value="<?php echo $cancel_data['Book_CreationDate']; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Status</label>
                                                    <div class="controls">
                                                        <?php echo $cancel_data['Status'] . ' '; ?>

                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary"><a href="<?php echo site_url(); ?>home">Home</a></button>
                                                </div>

                                            </fieldset>

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