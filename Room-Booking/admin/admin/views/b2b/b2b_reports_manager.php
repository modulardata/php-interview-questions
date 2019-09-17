
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
                        <a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/home">
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
                                    <h3>B2B Booking Reports Manager</h3>

                                    <ul class="nav  nav-pills">                           
                                        <li class="active">
                                            <a data-toggle="tab" href="#hotel-reports">Domestic Hotel Reports</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#int_hotel-reports">International Hotel Reports</a>
                                        </li>
                                        <!--								<li class="">
                                                                                                                <a data-toggle="tab" href="#flight-reports">Flight Reports</a>
                                                                                                        </li>
                                                                        <li class="">
                                                                                                                <a data-toggle="tab" href="#car-reports">Car Reports</a>
                                                                                                        </li>-->
                                    </ul>							
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="hotel-reports" style="overflow:auto;">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th> 
                                                        <th>Agent Id </td>
                                                        <th>Booking Ref Id</th>
                                                        <th>Status</th>  
                                                        <th>API</th>
                                                        <th>Hotel Name</th>                                                    
                                                        <th>Hotel City</th>
                                                        <th>Booking Date</th>
                                                        <th>Check-In</th>
                                                        <th>Check-Out</th>
                                                        <th>Rooms</th>
                                                        <th>Adults</th>
                                                        <th>Childs</th>
                                                        <th>Nights</th>                                                   
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Mobile No</th>
                                                        <th>Email</th>
                                                        <th>Actual Price</th>
                                                        <th>Admin Markup</th>
                                                        <th>Agent Markup</th>
                                                        <th>Total Price</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($hotel_booking_summary)) { ?>
                                                        <?php for ($i = 0; $i < count($hotel_booking_summary); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->agent_id; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->Booking_reference_ID; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->status; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->api; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->hotel_name; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->city; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->booking_date; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->checkin; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->checkout; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->noofrooms; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->noofadult; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->noofchild; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->noofnights; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->lead_title . '. ' . $hotel_booking_summary[$i]->lead_firstname; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->lead_lname; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->lead_mobile; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->lead_email; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->netrate; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->admin_markup; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->agent_markup; ?></td>
                                                                <td><?php echo $hotel_booking_summary[$i]->total_price; ?></td>
                                                                <td>
                                                                    <a href="<?php echo site_url(); ?>b2b/hotel_voucher/<?php echo $hotel_booking_summary[$i]->Booking_reference_ID; ?>">Voucher</a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
                                                    </div>                               

                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="int_hotel-reports" style="overflow:auto;">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>
                                                        <th>Agent ID</th>
                                                        <th>Roombooking RefNo</th>
                                                        <th>Hotel RefNo</th>
                                                        <th>Supplier RefNo</th>
                                                        <th>Booking Date</th>
                                                        <th>Status</th>                                                   
                                                        <th>Hotel Name</th>                                                    
                                                        <th>Hotel City</th>
                                                        <th>Check-In</th>
                                                        <th>Check-Out</th>
                                                        <th>Rooms</th>
                                                        <th>Adults</th>
                                                        <th>Childs</th>
                                                        <th>Nights</th>                                                   
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Mobile No</th>
                                                        <th>Email</th>
                                                        <th>XML Currency</th>
                                                        <th>Actual Price</th>
                                                        <th>Admin Markup</th>                                                    
                                                        <th>Payment Charge</th>
                                                        <th>Total Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($int_hotel_booking_summary)) { ?>
                                                        <?php for ($i = 0; $i < count($int_hotel_booking_summary); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->agent_id; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->RefNo; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->Hotel_RefNo; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->Booking_reference_ID; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->booking_date; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->status; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->hotel_name; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->city; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->check_in; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->check_out; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->room_count; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->adult; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->child; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->nights; ?></td>

                                                                <td><?php echo $int_hotel_booking_summary[$i]->title . '. ' . $int_hotel_booking_summary[$i]->first_name; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->last_name; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->mobile; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->email; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->currency; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->netrate; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->admin_markup; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->payment_charge; ?></td>
                                                                <td><?php echo $int_hotel_booking_summary[$i]->total_price; ?></td>
                                                                <td>
                                                                    <a href="<?php echo site_url(); ?>b2b/voucher_print/<?php echo $int_hotel_booking_summary[$i]->RefNo; ?>/<?php echo $int_hotel_booking_summary[$i]->Booking_reference_ID; ?>">E-Ticket</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
                                                    </div>

                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="car-reports" style="overflow:auto;">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>
                                                        <th>Agent No</th>
                                                        <th>Airliners RefNo</th>
                                                        <th>PNR #</th>
                                                        <th>Ticket Number</th>
                                                        <th>Status</th>
                                                        <th>Booking Date</th>
                                                        <th>Pickup Location</th>
                                                        <th>Dropoff Location</th> 
                                                        <th>Pickup DateTime</th>
                                                        <th>Dropoff DateTime</th> 
                                                        <th>Vendor Name</th>
                                                        <th>Vehicle Type</th>  
                                                        <th>Currency</th>                                                   
                                                        <th>TotalFare</th>
                                                        <th>ActualFare</th>
                                                        <th>Admin Profit</th> 
                                                        <th>Agent Profit</th> 
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($car_booking_summary)) { ?>
                                                        <?php for ($i = 0; $i < count($car_booking_summary); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->agent_no; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->AirlinersRefNo; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->BookingRefId; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->Ticket_Number; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->BookingStatus; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->Booking_Date; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->PickUp_LocationName; ?></td>
                                                                <td><?php if ($car_booking_summary[$i]->DropOff_LocationName) echo $car_booking_summary[$i]->DropOff_LocationName; else 'Same Location'; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->PickUpDateTime; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->ReturnDateTime; ?></td> 	
                                                                <td><?php echo $car_booking_summary[$i]->Vendor_Name; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->VehType; ?></td>
                                                                <td><?php echo $car_booking_summary[$i]->CurrencyCode; ?></td>
                                                                <td>
                                                                    <?php
                                                                    echo $car_booking_summary[$i]->Total_Amount + $car_booking_summary[$i]->Admin_Markup + $car_booking_summary[$i]->Agent_Markup;
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    echo $car_booking_summary[$i]->Total_Amount;
                                                                    ?>
                                                                </td>
                                                                <td><?php
                                                            echo $car_booking_summary[$i]->Admin_Markup;
                                                                    ?>
                                                                </td> 
                                                                <td><?php
                                                            echo $car_booking_summary[$i]->Agent_Markup;
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?php echo site_url(); ?>/b2b/car_eticket/<?php echo $car_booking_summary[$i]->AirlinersRefNo; ?>/<?php echo $car_booking_summary[$i]->BookingRefId; ?>">E-ticket</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
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