<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="ico/favicon.ico">
        <title>:: ETICKET ::</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR; ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/custom.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/font-awesome.min.css">

        <!--[if IE 7]>
        <link rel="stylesheet" href="css/font-awesome-ie7.css"/>
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->

    </head>
    <!-- NAVBAR
    ================================================== -->
    <body style="background:#f1f1f1;">
        <?php
        //  echo '<pre>';
        // print_r($booking_details);
        //  print_r($pass_details);exit;
        $triptype = $booking_details['0']->trip_type;
        $sourcename = $booking_details['0']->sourcename;
        $destiname = $booking_details['0']->destiname;
        $departure_date1 = $booking_details['0']->departure_date1;
        $ticketno = $booking_details['0']->tfv_reference_no;
        $pnrno1 = $booking_details['0']->booking_reference_no1;
        $bustype1 = $booking_details['0']->bus_type1;
        $travels1 = $booking_details['0']->travels1;
        $departure_time1 = $booking_details['0']->boardingtime1;
        $seatname1 = $booking_details['0']->seat_name1;
        $boardingpoint1 = $booking_details['0']->boardingpoint1;

        $pnrno2 = $booking_details['0']->booking_reference_no2;
        $departure_date2 = $booking_details['0']->departure_date2;
        $bustype2 = $booking_details['0']->bus_type2;
        $travels2 = $booking_details['0']->travels2;
        $departure_time2 = $booking_details['0']->boardingtime2;
        $seatname2 = $booking_details['0']->seat_name2;
        $boardingpoint2 = $booking_details['0']->boardingpoint2;

        $mobile = $booking_details['0']->mobile;
        $emailid = $booking_details['0']->emailid;
        $total_fare = $booking_details['0']->total_fare;
        ?>

        <div class="container marginTop15 font12">
            <div class="white-container" style="padding:30px;">
                <div class="row TicketHeader">
                    <div class="col-md-4">
                        <img src="<?php echo WEB_DIR; ?>public/img/logo.png" style="max-width:250px;" alt="tickmango online booking system"></div>
                    <div class="col-md-3 text-center">
                        <h2>eTICKET</h2>
                    </div>
                    <div class="col-md-5 text-right">
                        <strong>Need help with your trip?</strong><br>
                        1234567890/ (080) 123123123/ 123123123/ 123123123<br>
                        info@tickmango.com<br>
                    </div>
                </div>

                <div class="borderBlue"></div>

                <div class="row">
                    <div class="col-md-12 marginBottom10">
                        <span class="fontB font20 marginRight15">Onward Trip</span></span>
                    </div>                       
                </div>
                <div class="row">
                    <div class="col-md-8 marginBottom10">
                        <span class="fontB font20 marginRight15"><?php echo $sourcename; ?> <i class="fa fa-arrow-right"></i> <?php echo $destiname; ?></span><br><span class="fon12"><?php echo $departure_date1; ?></span>
                    </div>
                    <div class="col-md-4 text-right">
                        <strong>Ticket no: <?php echo $ticketno; ?></strong><br>
                        PNR no: <?php echo $pnrno1; ?>
                    </div>
                </div>
                <div class="dashedBorder"></div>

                <div class="row bookedBusTcktDtls">
                    <div class="col-md-3 busdtls">
                        <span><?php echo $bustype1; ?></span>
                        <span class="fontB"><?php echo $travels1; ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>Reporting time</span>
                        <span class="fontB">
                            <?php
                            $d = $this->Bus_Model->getTime($departure_time1);
                            $d1 = strtotime($d);
                            echo date("g:i a", strtotime('-15 minutes', $d1));
                            ?>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <span>Departure time</span>
                        <span class="fontB"><?php echo $this->Bus_Model->getTime($departure_time1); ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>Seat numbers</span>
                        <span class="fontB"><?php echo $seatname1; ?></span>
                    </div>
                </div>

                <div class="dashedBorder"></div>

                <div class="row bookedBusTcktDtls">
                    <div class="col-md-3 brddtls">
                        <span class="fontB ">Boarding point details</span>
                    </div>
                    <div class="col-md-3">
                        <span>Location</span>
                        <span class="fontB"><?php echo $boardingpoint1; ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>Landmark</span>
                        <span class="fontB"> - </span>
                    </div>
                    <div class="col-md-3">
                        <span>Address</span>
                        <span class="fontB"> - </span> 
                    </div>
                </div>

                <div class="borderBlue"></div>


                <?php if ($triptype == '2') { ?>
                    <div class="row">
                        <div class="col-md-12 marginBottom10">
                            <span class="fontB font20 marginRight15">Return Trip</span></span>
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="col-md-8 marginBottom10">
                            <span class="fontB font20 marginRight15"><?php echo $destiname; ?> <i class="fa fa-arrow-right"></i> <?php echo $sourcename; ?></span><br><span class="fon12"><?php echo $departure_date; ?></span>
                        </div>
                        <div class="col-md-4 text-right">
                            <strong>Ticket no: <?php echo $ticketno; ?></strong><br>
                            PNR no: <?php echo $pnrno2; ?>
                        </div>
                    </div>
                    <div class="dashedBorder"></div>

                    <div class="row bookedBusTcktDtls">
                        <div class="col-md-3 busdtls">
                            <span><?php echo $bustype2; ?></span>
                            <span class="fontB"><?php echo $travels2; ?></span>
                        </div>
                        <div class="col-md-3">
                            <span>Reporting time</span>
                            <span class="fontB">
                                <?php
                                $d = $this->Bus_Model->getTime($departure_time2);
                                $d1 = strtotime($d);
                                echo date("g:i a", strtotime('-15 minutes', $d1));
                                ?>
                            </span>
                        </div>
                        <div class="col-md-3">
                            <span>Departure time</span>
                            <span class="fontB"><?php echo $this->Bus_Model->getTime($departure_time2); ?></span>
                        </div>
                        <div class="col-md-3">
                            <span>Seat numbers</span>
                            <span class="fontB"><?php echo $seatname2; ?></span>
                        </div>
                    </div>

                    <div class="dashedBorder"></div>
                <?php } ?>

                <div class="row bookedBusTcktDtls">
                    <div class="col-md-3 brddtls">
                        <span class="fontB ">Boarding point details</span>
                    </div>
                    <div class="col-md-3">
                        <span>Location</span>
                        <span class="fontB"><?php echo $boardingpoint2; ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>Landmark</span>
                        <span class="fontB"> - </span>
                    </div>
                    <div class="col-md-3">
                        <span>Address</span>
                        <span class="fontB"> - </span> 
                    </div>
                </div>

                <div class="borderBlue"></div>



                <div class="row bookedBusTcktDtls">
                    <div class="col-md-3">
                        <span class="fontB">Passenger Name</span>                     
                    </div>
                    <div class="col-md-3">
                        <span class="fontB">Gender</span>                     
                    </div>
                    <div class="col-md-2">
                        <span class="fontB">Age</span>                      
                    </div>
                    <div class="col-md-4">
                        <span class="fontB">Contact Details</span>                      
                    </div>
                </div>
                <?php foreach ($pass_details as $val) { ?>
                    <div class="row bookedBusTcktDtls">
                        <div class="col-md-3">                           
                            <?php echo $val->pass_name; ?>
                        </div>
                        <div class="col-md-3">                         
                            <?php echo $val->pass_gender; ?>
                        </div>
                        <div class="col-md-2">                          
                            <?php echo $val->pass_age; ?>
                        </div>
                        <div class="col-md-4">                          
                            <?php echo $mobile . ', ' . $emailid; ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="borderBlue"></div>
                <div class="row">
                    <div class="col-md-12 text-right font20 fontB"><span class="font12">Total Fare :</span> Rs. <?php echo $total_fare; ?></div>
                </div>
                <div class="borderBlue"></div>
                <h4 class="text-center">Terms and Conditions</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul style="list-style:decimal; padding:0; margin:0 0 0 15px;">
                            <li>
                                Passengers are required to furnish the following at the time of boarding
                                the bus:
                                (1) A copy of the ticket (A print out of the ticket or the print out of the ticket
                                e-mail).
                                (2) A valid identity proof
                                Failing to do so, they may not be allowed to board the bus.
                            </li>
                            <li>
                                Change of bus: In case the bus operator changes the type of bus due to
                                some reason, tickmango will refund the differential amount to the customer
                                upon being intimated by the customers in 24 hours of the journey.
                            </li>
                            <li>
                                Amenities for this bus as shown on tickmango have been configured and
                                provided by the bus provider (bus operator). These amenities will be
                                provided unless there are some exceptions on certain days. Please note
                                that tickmango provides this information in good faith to help passengers to
                                make an informed decision. The liability of the amenity not being made
                                available lies with the operator and not with tickmango.
                            </li>
                            <li>
                                In case one needs the refund to be credited back to his/her bank account,
                                please write your cash coupon details to support@tickmango.com * The home
                                delivery charges (if any), will not be refunded in the event of ticket
                                cancellation
                            </li>
                            <li>
                                In case a booking confirmation e-mail and sms gets delayed or fails
                                because of technical reasons or as a result of incorrect e-mail ID / phone
                                number provided by the user etc, a ticket will be considered 'booked' as
                                long as the ticket shows up on the confirmation page of www.tickmango.com
                            </li>
                            <li>
                                Grievances and claims related to the bus journey should be reported to
                                tickmango support team within 10 days of your travel date.
                            </li>
                            <li>
                                Partial Cancellation is allowed for this ticket.

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row marginTop10 marginLeft5">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr class="fontB">
                                <th>Cancellation time</th>
                                <th>Cancellation charges</th>
                            </tr>
                            <tr>
                                <td>After 12:15 PM on 28th Dec</td>
                                <td>Rs. 1100</td>
                            </tr>
                            <tr>
                                <td>Between 08:15 PM on 25th Dec - 08:15 PM
                                    on 27th Dec</td>
                                <td>Rs. 1100</td>
                            </tr>
                            <tr>
                                <td>Till 08:15 PM on 25th Dec</td>
                                <td>Rs. 1100</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="dashedBorder"></div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Whom should i call?</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class="fontB">For boarding point related</span><br>
                        0987654321/ (080) 123123123/ 123123/ 123213123
                    </div>
                    <div class="col-md-4">
                        <span class="fontB">For time related</span><br>
                        0987654321/ (080) 123123123/ 123123/ 123123123
                    </div>
                    <div class="col-md-4">
                        <span class="fontB">For cancellation and refunds</span><br>
                        Call 0987654321 or email us to info@tickmango.com
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
