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
<!--                        <li><a href="<?php //echo WEB_URL;  ?>home/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
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

                            <h2 class="agentHdng">My Booking</h2>
                            <div class="white-container padding20">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#htl_bkngs" data-toggle="tab">DOMESTIC HOTEL BOOKINGS</a></li>
                                    <li><a href="#int_htl_bkngs" data-toggle="tab">INTERNATIONAL HOTEL BOOKINGS</a></li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div class="tab-pane active" id="htl_bkngs" style="overflow: auto">
                                        <BR/>
                                        <BR/>

                                        <table class='table table-striped dataTable table-bordered'>
                                            <thead>
                                                <tr>
                                                    <th>SI.No</th>

                                                    <th>Booking Reference Id</th>
                                                    <th>Hotel Name</th>
                                                    <th>Address</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Country</th>
                                                    <th>Name</th>
                                                    <th>Middle Name</th>
                                                    <th>Last Name</th>
                                                    <th>Mobile</th>
                                                    <th>Passenger City</th>
                                                    <th>Country</th>
                                                    <th>Email</th>
                                                    <th>Booking Date</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
                                                    <th>No of rooms</th>
                                                    <th>No of Nights</th>
                                                    <th>Total Price</th>
                                                    <th>E-Ticket</th>
                                                    <th>Cancel</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($hotel_booking_summary)) { ?>
                                                    <?php for ($i = 0; $i < count($hotel_booking_summary); $i++) { ?>
                                                        <tr>
                                                            <td><?php echo $i + 1; ?></td>

                                                            <td><?php echo $hotel_booking_summary[$i]->Booking_reference_ID; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->hotel_name; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->hotel_address; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->hotel_city; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->hotel_state; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->hotel_country; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->lead_title . ' ' . $hotel_booking_summary[$i]->lead_firstname; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->lead_mname; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->lead_lname; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->lead_mobile; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->lead_city; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->lead_country; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->lead_email; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->booking_date; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->checkin; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->checkout; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->noofrooms; ?></td>
                                                            <td><?php echo $hotel_booking_summary[$i]->noofnights; ?></td>

                                                            <td><?php echo $hotel_booking_summary[$i]->total_price; ?></td>
                                                            <td>
                                                                <a href="<?php echo WEB_URL; ?>dhotel/hotel_tickeet/<?php echo $hotel_booking_summary[$i]->Booking_reference_ID; ?>">E-Ticket</a>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($hotel_booking_summary[$i]->status == 'Cancelled') {
                                                                    echo 'Hotel Cancelled';
                                                                } else {
                                                                    ?>
                                                                    <a href="<?php echo WEB_URL; ?>dhotel/hotel_cancel/<?php echo $hotel_booking_summary[$i]->Booking_reference_ID; ?>/<?php echo $hotel_booking_summary[$i]->lead_lname; ?>/<?php echo $hotel_booking_summary[$i]->lead_email; ?>/Initiate">Cancel</a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } else { ?>

                                                <div align="center">
                                                    No Booking Summary Found...
                                                </div>

                                            <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane" id="int_htl_bkngs"style="overflow: auto">
                                        <BR/>
                                        <BR/>
                                        <table class='table table-striped dataTable table-bordered'>
                                            <thead>
                                                <tr>
                                                    <th>SI.No</th>
                                                    <th>Hotel Booking ID</th>
                                                    <th>Booking Reference Id</th>
                                                    <th>Hotel Name</th>
                                                    <th>Address</th>
                                                    <th>City</th>
<!--                                                    <th>State</th>
                                                    <th>Country</th>-->
                                                    <th>Contact No</th>
                                                    <th>Passenger Id</th>
                                                    <th>Name</th>
                                                    <th>Middle Name</th>
                                                    <th>Last Name</th>
                                                    <th>Passenger type</th>
<!--                                                    <th>Passenger Address</th>
                                                    <th>Passenger City</th>

                                                    <th>Country</th>-->
                                                    <th>Email</th>
                                                    <th>Ph No</th>

                                                    <th>Booking Date</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
                                                    <th>No of rooms</th>
                                                    <th>No of Nights</th>
                                                    <th>Total Price</th>
                                                    <th>E-Ticket</th>
                                                    <th>Cancel</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($hotel_booking_summary_int)) { ?>
                                                    <?php for ($i = 0; $i < count($hotel_booking_summary_int); $i++) { ?>
                                                        <tr>
                                                            <td><?php echo $i + 1; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->hotel_booking_id; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->RefNo; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->hotel_name; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->address; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->city; ?></td>
        <!--                                                            <td><?php echo $hotel_booking_summary_int[$i]->state; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->country; ?></td>-->
                                                            <td><?php echo $hotel_booking_summary_int[$i]->phone; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->pass_id; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->title . ' ' . $hotel_booking_summary_int[$i]->first_name; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->middle_name; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->last_name; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->passenger_type; ?></td>
        <!--                                                            <td><?php echo $hotel_booking_summary_int[$i]->address; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->pass_city; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->pass_country; ?></td>-->
                                                            <td><?php echo $hotel_booking_summary_int[$i]->email; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->mobile; ?></td>

                                                            <td><?php echo $hotel_booking_summary_int[$i]->booking_date; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->check_in; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->check_out; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->room_count; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->nights; ?></td>
                                                            <td><?php echo $hotel_booking_summary_int[$i]->total_price; ?></td>
                                                            <td>

                                                                <a href="<?php echo WEB_URL; ?>hotel/voucher_print/<?php echo $hotel_booking_summary_int[$i]->RefNo; ?>/<?php echo $hotel_booking_summary_int[$i]->Booking_reference_ID; ?>">E-Ticket</a>
                                                            </td>
                                                            <td>
                                                                 <?php
                                                                if ($hotel_booking_summary_int[$i]->status == 'Cancelled') {
                                                                    echo 'Hotel Cancelled';
                                                                } else {
                                                                    ?>
                                                                    <a href="<?php echo WEB_URL; ?>hotel/cancel_voucher/<?php echo $hotel_booking_summary_int[$i]->RefNo; ?>/<?php echo $hotel_booking_summary_int[$i]->Booking_reference_ID; ?>">Cancel</a>
                                                                <?php } ?>
                                                                
                                                               
                                                                
                                                                
                                                            </td>

                                                        </tr>
                                                    <?php } ?>
                                                <?php } else { ?>

                                                <div align="center">
                                                    No Booking Summary Found...
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
</div>
</div>

<!-- FOOTER -->
<?php echo $this->load->view('home/footer'); ?>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>