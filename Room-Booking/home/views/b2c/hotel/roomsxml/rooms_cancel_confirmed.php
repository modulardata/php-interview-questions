<?php echo $this->load->view('home/homeheader'); ?>
<!-- Search section
    ================================================== -->
<!-----  Top destination content ----->
<!-- Theme framework -->

<link rel="stylesheet" href="<?php echo WEB_DIR ?>public/css/chosen.css"/>
<link rel="stylesheet" href="<?php echo WEB_DIR ?>public/css/style.css"/>


<script src="<?php echo WEB_DIR ?>public/js/jquery.min.js"></script>


<script src="<?php echo WEB_DIR ?>public/js/jquery.nicescroll.min.js"></script>



<script src="<?php echo WEB_DIR ?>public/js/jquery.dataTables.min.js"></script>


<script src="<?php echo WEB_DIR ?>public/js/dataTables.scroller.min.js"></script>

<script src="<?php echo WEB_DIR ?>public/js/chosen.jquery.min.js"></script>

<script src="<?php echo WEB_DIR ?>public/js/eakroko.min.js"></script>

<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">


            <div class="col-md-3">

                <div class="white-container">
                    <ul class="dashboard-nav">
<!--                        <li><a href="<?php //echo WEB_URL;    ?>home/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
                        <li><a href="<?php echo WEB_URL; ?>user/user_booking" class="active"><i class="fa fa-briefcase"></i> Booking History</a></li>
                        <li><a href="<?php echo WEB_URL; ?>user/view_profile" ><i class="fa fa-user"></i> Profile</a></li>
<!--                            <li><a href="<?php echo WEB_URL; ?>"><i class="fa fa-group"></i> Travellers</a></li>
                        <li><a href="#"><i class="fa fa-road"></i> Expressway</a></li>-->
                        <li><a href="<?php echo WEB_URL; ?>user/change_password"><i class="fa fa-gears"></i> Settings</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-md-9">

                <div class="white-container">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if (validation_errors() != "") { ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button"><img src="<?php echo WEB_DIR; ?>public/img/close.png"/></button>
                                    <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>



                            <?php
                            if (!empty($errors)) {
                                ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button"><img src="<?php echo WEB_DIR; ?>public/img/close.png"/></button>
                                    <strong>Error!</strong>
                                    <?php echo $errors; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">                            

                        <div class="col-md-12">

                            <h2 class="agentHdng">Cancellation Details</h2>
                            <div class="white-container padding20">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#htl_bkngs" data-toggle="tab">DOMESTIC HOTEL cancellation</a></li>


                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div class="tab-pane active" id="htl_bkngs" style="overflow: auto">
                                        <BR/>
                                        <BR/>
                                        <form class="form-horizontal" action="<?php echo WEB_URL; ?>hotel/rooms_hotel_cancel_confirm" enctype="multipart/form-data" method="post">
                                            <fieldset>
                                                <input type="hidden" namr="case" value="Cancel"/>
                                                <legend>Cancellation Information</legend>
                                                <?php $cancel_data = $this->session->userdata('cancel_data'); ?>
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
                                                    <label class="control-label" for="focusedInput">Created date</label>
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
                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Cancellation</label>
                                                    <div class="controls">
                                                        Refund Amount <?php echo $cancel_data['Currency'] . ' '; ?><?php echo $cancel_data['Amount']; ?> before <?php echo $cancel_data['l_date']; ?> 

                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                </div>

                                            </fieldset>
                                        </form>


                                    </div>


                                </div>
                            </div>     

                        </div>





                    </div>



                </div>

            </div>

        </div>


    </div>
</div>
</div>

<!-- FOOTER -->
<?php echo $this->load->view('home/footer'); ?>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>