<?php //$this->load->view('home/header');   ?>
<title>Voucher</title>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>public/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo site_url(); ?>public/css/customhome.css"/>
<!--<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">-->
<link rel="stylesheet" href="<?php echo site_url(); ?>public/css/jquery-ui.css"/>

<div class="flightsContainer">
    <div class="container">

        <?php if (!empty($hotel_booking_info)) { ?>	


            <div class="padding_10">

                <div class="booking_page_box1">
                    <div class="hotel_result_right_inner_part7">

                        <div class="hotel_result_left_heading_part4" align="center" style="text-align:center">
                            <div class="padding_10"><span class="font_size15 color_gray1" ><strong><?php if (($hotel_booking_info->status == 'confirmed') || ($hotel_booking_info->status == 'Confirmed')) echo 'Booking Voucher'; ?></strong></span></div>
                        </div>

                        <div class="bgcolor_gray" style="background-color:#f7f7f4;">
                            <div>

                                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr><td>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                <tr><td class="bgcolor_gray1" style="font-size: 26;text-decoration: none;" align="left"><a href="<?php echo site_url(); ?>" style="text-decoration: none;"><img src="<?php echo site_url(); ?>public/img/logo.png" style="height:60px;width:280px"/></a></td><td>Hotel Accommodation Voucher</td><td align="right">Support: 0987654321</td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#e7e7e7">Hotel Booking Reference No:</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f7f7f7">
                                            <div align="justify" class="padding_10 font_size13 color_gray">
                                                <?php echo $hotel_booking_info->Booking_reference_ID; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#e7e7e7">Booking Details</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f7f7f7">


                                            <table width="380" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                                                <tr>
                                                    <td width="117"><strong>Hotel Name:</strong></td>
                                                    <td class="color_blue font_size15"><strong><?php echo $hotel_booking_info->hotel_name; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td width="117"><strong>City Name:</strong></td>
                                                    <td><?php echo $hotel_booking_info->city; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Check-in:</strong></td>
                                                    <td><?php echo $hotel_booking_info->check_in; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Check-out:</strong></td>
                                                    <td><?php echo $hotel_booking_info->check_out; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Duration:</strong></td>
                                                    <td><?php echo $hotel_booking_info->nights; ?> Night(s), <?php echo $hotel_booking_info->room_count; ?> Room(s)</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Guest:</strong></td>
                                                    <td><?php echo $hotel_booking_info->adult; ?> Adult(s), <?php echo $hotel_booking_info->child; ?> Child(s)</td>
                                                </tr>
                                            </table>

                                            <table width="380" border="0" cellspacing="0" cellpadding="5" align="right" class="font_size13 color_gray1">
                                                <tr>
                                                    <td width="117"><strong>Location:</strong></td>
                                                    <td><?php echo $hotel_booking_info->city; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Room Type & Inclusion:</strong></td>
                                                    <td><?php echo $hotel_booking_info->room_type; ?></td>
                                                </tr>  
                                                <tr>
                                                    <td><strong>Booking Status:</strong></td>
                                                    <td><?php
                                            if (($hotel_booking_info->status == 'confirmed') || ($hotel_booking_info->status == 'Confirmed'))
                                                echo '<span style="color:green">CONFIRMED</span>';
                                            else
                                                echo '<span style="color:red">FAILED</span>';
                                                ?></td>
                                                </tr>
    <!--                                                <tr>
                                                    <td><strong><?php if ($hotel_booking_info->status == 'Success' && $hotel_booking_info->Cancellation_Status == '') { ?>Booking Fee:<?php
                                                    } else {
                                                        echo 'Cancellation Fee:';
                                                    }
                                                ?></strong></td>
                                                    <td><?php if ($hotel_booking_info->status == 'Success' && $hotel_booking_info->Cancellation_Status == '') { ?>Free<?php
                                            } else {
                                                echo $hotel_booking_info->Cancellation_Charge;
                                            }
                                                ?></td>
                                                </tr>-->
                                                <tr>
                                                    <td class="color_black font_size15"><strong>Total Price:</strong></td>
                                                    <td class="color_black font_size15">
                                                        <strong>
                                                            <?php echo $hotel_booking_info->currency; ?> 
                                                            <?php  echo round($hotel_booking_info->total_price, 2);     ?>
                                                        </strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#e7e7e7">Rooms</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f7f7f7">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="5">

                                                <tr>
                                                    <td class="border_bottom4">
                                                        <table width="800" border="0" cellspacing="0" cellpadding="5" class="font_size14">
                                                            <tr>
                                                                <td>Rooms : </td>
                                                                <td class="color_black"><?php echo $hotel_booking_info->room_count; ?></td>
                                                                <td>&nbsp;</td>
                                                                <td>Guest name : </td>
                                                                <td class="color_black">
                                                                    <table width="100%">
                                                                        <?php
                                                                        foreach ($passenger_info as $guests) {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name; ?><td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Adult : </td>
                                                                <td class="color_black"><?php echo $hotel_booking_info->adult; ?></td>
                                                                <td>&nbsp;</td>
                                                                <td></td>
                                                                <td class="color_black"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Child : </td>
                                                                <td class="color_black"><?php echo $hotel_booking_info->child; ?></td>
                                                                <td>&nbsp;</td>
                                                                <td></td>
                                                                <td class="color_black"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>


                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#e7e7e7">Hotel Details</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#f7f7f7">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="8" align="center">
                                                <tr>
                                                    <td width="300" class="font_size13 color_gray"><?php echo $hotel_booking_info->address; ?></td>
                                                    <td class="font_size13 color_gray">
                                                        Phone : <?php echo $hotel_booking_info->phone; ?><br />
                                                        Fax : <?php echo $hotel_booking_info->fax; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="font_size13 color_gray">

                                                        <div align="justify">
                                                            <?php echo substr($hotel_booking_info->description, 0, 500); ?>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr> 
                                    <?php if ($hotel_booking_info->cancellation_policy != '') { ?>
                                        <tr>
                                            <td bgcolor="#e7e7e7">Cancellation Policy</td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#f7f7f7">
                                                <div align="justify" class="padding_10 font_size13 color_gray">
                                                    <?php echo $hotel_booking_info->cancellation_policy; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($hotel_booking_info->comment_desc != '') { ?>
                                        <tr>
                                            <td bgcolor="#e7e7e7">Comments</td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#f7f7f7">
                                                <div align="justify" class="padding_10 font_size13 color_gray">
                                                    <?php echo $hotel_booking_info->comment_desc; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="clear"></div>



            <table align="center" width="100%">
                <tr>
                    <td bgcolor="#e7e7e7" align="center">
                        <a href="" onclick="printIframe('loaderFrame');">Print</a>
<!--                        <a href="<?php //echo site_url(); ?>hotels/voucher_email?voucherId=<?php //echo $hotel_booking_info->IW_RefNo; ?>">Mail</a>
                        <a href="<?php //echo site_url(); ?>hotels/voucher_pdf?voucherId=<?php //echo $hotel_booking_info->IW_RefNo; ?>">PDF</a>-->
                    </td>
                </tr>
            </table>

        <?php } else { ?>

            <table align="center" width="100%">
                <tr>
                    <td bgcolor="#e7e7e7" align="center">

                        <h3>Sorry, No Voucher is Availbale.. Please try for another voucher...</h3>

                    </td>
                </tr>
            </table>

        <?php } ?>


    </div>
</div>

<?php //$this->load->view('home/footer');  ?>

</div>

<script>
    function printIframe(id)
    {
        var iframe = document.frames ? document.frames[id] : document.getElementById(id);
        var ifWin = iframe.contentWindow || iframe;
        ifWin.focus();
        ifWin.printMe();
        return false;
    }
</script>
