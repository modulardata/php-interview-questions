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
                color: #1EBBE4;

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
                width: 987px;
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
                min-height: 90px;


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
            strong, th
            {
                color: #59282C;
            }
            @media print {
                #price { display: none }
            }

        </style>
    </head>
    <body>
        <div class="ticket_container">
            <div class="ticket_title">
                <div class="ticket_logo" align="left">
                    <img width="240" height="75" src="<?php echo WEB_DIR  ?>public/img/logo.png"></img>
                </div>
                <div class="support" align="right">
                    support@travelpd.com<br/>
                    123456789
                </div>

            </div>
            <div style="border:1px solid #CCC">
                <div class="ticket_details">
                    <p>
                        <strong>Dear <?php echo $contact_info->title ?> . <?php echo $contact_info->first_name . ' ' ?> <?php echo $contact_info->last_name ?></strong><br>
                        Thank you for booking your hotel with Tickmango. We are pleased to confirm your booking details as below:</p>
                </div>

                <div class="traveler_details" >
                    <table width="99%" align="center" cellpadding="5" cellspacing="5">
                        <tr>

                            <th colspan="2">Traveler Details</th>
                            <th colspan="2"> Your Reservations</th>

                        </tr>
                        <tr>
                            <td><strong>Guest Name</strong></td>
                            <td><?php echo $contact_info->title ?>. <?php echo $contact_info->first_name . ' ' ?> <?php echo $contact_info->last_name ?></td>
                            <td><strong>Hotel Booking Number</strong></td>
                            <td><?php echo $trans->booking_number; ?></td>
                        </tr>
                        <tr>
                            <td><strong>No. of adults</strong></td>
                            <td><?php echo $result_view->adult; ?></td>
                            <td><strong>Check - in</strong></td>
                            <td><?php
$cinval = explode("-", $result_view->check_in);
echo $cin = $cinval[2] . '-' . $cinval[1] . '-' . $cinval[0]; // echo $cin; exit;
?></td>
                        </tr>
                        <tr>
                            <td><strong>No. of childs</strong></td>
                            <td><?php echo $result_view->child; ?></td>
                            <td><strong>Check - out</strong></td>
                            <td><?php
                                $coutval = explode("-", $result_view->check_out);
                                echo $cout = $coutval[2] . '-' . $coutval[1] . '-' . $coutval[0];
?></td>
                        </tr>
                        <tr>
                            <td><strong>Voucher Date</strong></td>
                            <td><?php
                                $voucherval = explode("-", $result_view->voucher_date);
                                echo $voucherval = $voucherval[2] . '-' . $voucherval[1] . '-' . $voucherval[0];
?></td>
                            <td><strong>Rooms</strong></td>
                            <td><?php echo $result_view->no_of_room; ?></td>
                        </tr>
                        <tr>


                            <td><strong>Nights</strong></td>
                            <td><?php echo $result_view->nights; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="ticket_header"><strong>Emergency Contact Number </strong></div>
            <div class="hotel_details">
                PLEASE call our EMERGENCY LINE for assistance at check in time :
                001-212-401-4540

            </div>

            <div class="ticket_header"><strong>Hotel Details</strong></div>
            <div class="hotel_details">
                <div>
                    <table cellpadding="5" cellspacing="5">
                        <tr>
                            <td><img src="<?php echo $hotel_image->image ?>" width="100px" height="100px"></img></td>
                            <td>
                                <table cellpadding="15" cellspacing="15" width="auto">
                                    <tr><td><strong>Hotel Name</strong></td><td><?php echo $result_view->hotel_name; ?></td></tr>
                                    <tr><td><strong>Description</strong></td><td align="justify"><?php echo substr($result_view->description, 0, 250) . '...'; ?></td></tr>

                                </table>
                            </td>
                        </tr>
                    </table>

                </div>
                <div>
                    <table width="100%" cellspacing="5" cellpadding="5">
                        <tr>
                            <td><strong>Address :</strong></td>
                            <td><?php echo $result_view->address; ?></td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td><?php echo $result_view->city; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Phone</strong></td>
                            <td><?php echo $result_view->phone; ?></td>
                        </tr>


                    </table>
                </div>

            </div>


            <div class="ticket_header"><strong>Room Details</strong></div>
            <div class="hotel_details">
                <table width="99%"  cellpadding="5" cellspacing="5"><tr><th>Room Type:</th><td><?php echo $result_view->room_type ?></td></tr></table>


            </div>
            <div id="price">
                <div class="ticket_header"><strong>Fare Summary</strong></div>
                <div class="hotel_details">
                    <table width="99%" cellspacing="5" cellpadding="5" align="justify">
                        <tr>
                            <th>Price</th>
                            <td><?php echo $trans->total_amount ?><?php echo ' ' . $trans->xml_currency ?> </td>
                        </tr>
                    </table> 

                </div>

            </div>

            <div class="ticket_header"><strong>Cancellation Policy</strong></div>
            <div class="hotel_details">
                <table width="99%"  cellpadding="5" cellspacing="5">
                    <tr><td alilgn="justify"><?php echo $result_view->cancel_policy ?></td></tr>
                </table>


            </div>


            <div class="ticket_header"><strong>Passenger Details</strong></div>
            <div class="hotel_details">
                <table width="50%" cellspacing="5" cellpadding="5">
                    <tr><th>Title</th><th>First Name</th><th>Last Name</th></tr>
                    <?php
                    foreach ($pass_info as $val5) {
                        $group = $val5->group;
                        if ($group == 1) {
                            ?>

                            <tr>
                                <td width="20%"><?php echo $val5->title; ?></td>
                                <td width="40"><?php echo $val5->first_name; ?></td>

                                <td width="40%"><?php echo $val5->last_name; ?></td>
                            </tr>

                        <?php } else {
                            ?>
                            <tr>
                                <td><?php echo $val5->title; ?></td>

                                <td><?php echo $val5->firstname; ?></td>

                                <td><?php echo $val5->last_name; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>


                </table>
            </div>
            <div class="hotel_details" align="center" style="margin-top: 10px;">
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
