<?php
//echo '<pre>';print_r($hotel_details); exit;//echo '<pre>';print_r($hot_det); exit;
//echo '<pre>';
//print_r($passenger_details);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Ticket</title>
        <style type="text/css">
            body{
                width: 100%;
                font-family: Verdana, Geneva, sans-serif;
                font-size: 12pt;

            }
            .ticket_container
            {
                width: 1000px;
                /*box-shadow: 0 0 10px #9ecaed;*/
                border: 1px solid #CCC;
                margin: auto;
                padding: 10px;
            }
            .ticket_header
            {
                width: 990px;
                height: 25px;
                background-color: deepskyblue;
                padding: 5px;
                border-radius: 5px 5px 0px 0px;
                margin-top: 5px;

            }
            .ticket_details
            {
                width: 990px;
                height: 50px;

                padding: 5px;
            }
            .traveler_details
            {
                width: 990px;
                padding: 5px;
                height: auto;
            }
            .hotel_details
            {
                width: 988px;
                padding: 5px;
                height: auto;
                min-height: 30px;
                border: 1px solid #9ecaed ;
                border-radius: 0px 0px 5px 5px;
            }
            .ticket_title
            {
                width: 988px;
                padding: 5px;
                height: auto;
                min-height: 60px;


            }
            .ticket_logo
            {
                float: left;
                width: 494px;

            }
            .support{
                float: left;
                width: 494px;
            }
        </style>
    </head>
    <body>
        <div class="ticket_container">
            <div class="ticket_title">
                <div class="ticket_logo" align="left">
                    <img width="252" height="55" src="<?php echo WEB_DIR ?>public/img/logo.png"></img>
                </div>
                <div class="support" align="right">
                    support@travelpd.com<br/>
                    123456789
                </div>

            </div>
            <div style="border:1px solid #CCC">
                <div class="ticket_details">
                    <p>
                        <strong>Dear <?php echo $passenger_details[0]->title ?>. <?php echo $passenger_details[0]->firstname ?></strong><br>
                        Thank you for booking your hotel with TICKETMANGO. We are pleased to confirm your booking details as below:</p>
                </div>

                <div class="traveler_details">
                    <table width="100%" align="center">
                        <tr>

                            <th colspan="2">Traveler Details</th>
                            <th colspan="2"> Your Reservations</th>

                        </tr>
                        <tr>
                            <td><strong>Guest Name</strong></td>
                            <td><?php echo $passenger_details[0]->title ?>. <?php echo $passenger_details[0]->firstname ?></td>
                            <td><strong>Hotel Booking Number</strong></td>
                            <td><?php echo $hotel_details->Booking_reference_ID ?></td>
                        </tr>
                        <tr>
                            <td><strong>No. of Adults</strong></td>
                            <td><?php echo $hotel_details->noofadult; ?></td>
                            <td><strong>Check - in</strong></td>
                            <td><?php echo $hotel_details->checkin; ?></td>
                        </tr>
                        <tr>
                            <td><strong>No. of Children</strong></td>
                            <td><?php echo $hotel_details->noofchild; ?></td>
                            <td><strong>Check - out</strong></td>
                            <td><?php echo $hotel_details->checkout; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Voucher Date</strong></td>
                            <td><?php echo $hotel_details->booking_date; ?></td>
                            <td><strong>Rooms</strong></td>
                            <td><?php echo $hotel_details->noofrooms; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>

                            <td><strong>Nights</strong></td>
                            <td><?php echo $hotel_details->noofnights; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="ticket_header"><strong>Hotel Details</strong></div>
            <div class="hotel_details">
                <div>
                    <table cellpadding="5" cellspacing="5">
                        <tr>
                            <td><img src="<?php echo $hot_det->image; ?>" width="100px" height="100px"></img></td>
                            <td>
                                <table>
                                    <tr><td><strong>Hotel Name</strong></td><td><?php echo $hotel_details->hotel_name; ?></td></tr>
                                    <tr><td><strong>Description</strong></td><td align="justify"><?php echo $hotel_details->hotel_discription; ?></td></tr>

                                </table>
                            </td>
                        </tr>
                    </table>

                </div>
                <div>
                    <table width="100%" cellspacing="5" cellpadding="5">
                        <tr>
                            <td><strong>Address :</strong></td>
                            <td><?php echo $hotel_details->hotel_address; ?></td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td><?php echo $hotel_details->hotel_city; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Phone</strong></td>
                            <td><?php echo $hotel_details->contact_number; ?></td>
                        </tr>


                    </table>
                </div>

            </div>


            <div class="ticket_header"><strong>Room Details</strong></div>
            <div class="hotel_details">
                Room Type: <?php echo $hotel_details->roomtypename; ?>

            </div>
            <div class="ticket_header"><strong>Fare Summary</strong></div>
            <div class="hotel_details">
                <table width="70%" cellspacing="5" cellpadding="5" align="justify">
                    <tr>
                        <th>Price</th>
                        <td> <?php echo $hotel_details->currency . ' ' . $hotel_details->netrate; ?></td>
                    </tr>
                </table> 

            </div>
            <?php if ($hotel_details->cancel_poly_nonrefund) { ?>
                <div class="ticket_header"><strong>Cancellation Policy</strong></div>
                <div class="hotel_details">
                    <table width="100%">
                        <tr><td width="30%"><strong>Non Refundable: </strong></td><td width="70%"><?php if ($hotel_details->cancel_poly_nonrefund) echo $hotel_details->cancel_poly_nonrefund; ?></td></tr>
                        <tr><td width="30%"><strong>Description: </strong></td><td width="70%"><?php if ($hotel_details->cancellation_disc) echo $hotel_details->cancellation_disc ; ?></td></tr>

                    </table>
                </div>
            <?php } ?>
            <!--            <div class="ticket_header">commenttypey</div>
                        <div class="hotel_details">
                            vdfvkdfgvdf
                            dfjdf
            
                        </div>-->

            <!--            <div class="ticket_header">Supplier Detail</div>
                        <div class="hotel_details">
                            vdfvkdfgvdf
                            dfjdf
            
                        </div>-->

            <!--            <div class="ticket_header">Special Remarks</div>
                        <div class="hotel_details">
                            vdfvkdfgvdf
                            dfjdf
            
                        </div>-->

            <div class="ticket_header"><strong>Passenger Details</strong></div>
            <div class="hotel_details">
                <table width="60%" cellspacing="5" cellpadding="5">
<!--                    <tr><th>Title</th><th>First Name</th><th>Last Name</th></tr>-->
                    <?php
                    foreach ($passenger_details as $val5) {
                        $catageory = $val5->pass_type;
                        if ($catageory == "ADT") {
                            
                            ?>

                            <tr>
                                <td><?php echo $val5->title; ?></td>
                                <td><?php echo $val5->firstname; ?></td>
                                <td><?php echo $val5->middle_name; ?></td>
                                <td><?php echo $val5->last_name; ?></td>
                            </tr>

                        <?php } else {
                            ?>
                            <tr>
                                <td><?php echo $val5->title; ?></td>
                                <td><?php echo $val5->firstname; ?></td>
                                <td><?php echo $val5->middle_name; ?></td>
                                <td><?php echo $val5->last_name; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>


                </table>
            </div>
            <div class="ticket_header"><strong>Instructions</strong></div>
            <div class="hotel_details">
                <ul>
                    <li>Guest must be over 18 years of age to check-in to this hotel.</li>
                    <li>As per Government regulations, it is mandatory for all guests above 18 years of age to carry a valid photo identity card & address proof at the time of check-in. Please note that failure to abide by this can result with the hotel denying a check-in. Hotels normally do not provide any refund for such cancellations.</li>
                    <li>The standard check-in and check-out times are 12 noon. Early check-in or late check-out is subject to hotel availability and may also be chargeable by the hotel. Any early check-in or late check-out request must be directed to and reconfirmed with the hotel directly. </li>
                    <li>Failure to check-in to the hotel, will attract the full cost of stay or penalty as per the hotel cancellation policy.</li>
                    <li>Hotels charge a compulsory Gala Dinner Supplement during Christmas, New Year's eve or other special events and festivals like Diwali or Dusshera. These additional  charge are not included in the booking amount and will be collected directly at the hotel. </li>
                    <li>There might be seasonal variation in hotel tariff rates during Peak days, for example URS period in Ajmer or Lord Jagannath Rath Yatra in Puri, the room tariff differences if any will have to be borne and paid by the customer directly at the hotel, if the booking stay period falls during such dates.</li>
                    <li>All additional charges other than the room charges and inclusions as mentioned in the booking voucher are to be borne and paid separately during check-out. Please make sure that you are aware of all such charges that may comes as extras. Some of them can be WiFi costs, Mini Bar, Laundry Expenses, Telephone calls, Room Service, Snacks etc. </li>
                    <li>Some hotels may have policies that do not allow unmarried / unrelated couples or certain foreign nationalities to check-in without the correct documentation. No refund will be applicable in case the hotel denies check-in under such circumstances. If you have any doubts on this, do call us for any assistance</li>
                    <li>Any changes or booking modifications are subject to availability and charges may apply as per the hotel policies.</li>
           
                </ul>
               

                
                
            </div>
            <div class="hotel_details" align="center">
                <a href="<?php echo WEB_URL; ?>">Home</a> <a href="#" onclick="myFunction()">Print</a>
            </div>


        </div>
        <script>
            function myFunction()
            {
                window.print();
            }
        </script>
    </body>
</html>
