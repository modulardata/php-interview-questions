<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<!-----  Top destination content ----->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<style>
    .padd{
        padding:10px;  
    }
</style>
<div class="hotelCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-12 bookedDetails">  
                <!-- this row will repeat based on hotels availability -->


                <div class="row">

                    <section  id="emailDetails" class="verySoftShadow">
                        <div class="bdOpen " id="loginOpen">
                            <div class="bdTitle">
                                <h3><?php echo $service->hotel_name; ?></h3>
                            </div>


                            <div class="row">

                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Location</div>
                                        <div class="col-md-4">
                                            <?php echo $service->address; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">City</div>
                                        <div class="col-md-4">
                                            <?php echo $service->city; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Check-in</div>
                                        <div class="col-md-4">
                                            <?php echo $search_details['checkin']; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Check-out</div>
                                        <div class="col-md-4">
                                            <?php echo $search_details['checkout']; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Room Type</div>
                                        <div class="col-md-4">
                                            <?php
                                            $a = explode("-", $result_id);
                                            $sec_res = $service->session_id;
                                            $room_type = '';
                                            for ($k = 0; $k < count($a); $k++) {
                                                $b = $this->Hotelspro_Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res, $a[$k]);
                                                $room_type .= $b->room_type . "-" . $b->inclusion . "<br>";
                                            }

                                            echo $room_type;
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2"><?php echo $session_data['days']; ?> night, <?php echo $service->room_count; ?> rooms, max. <?php echo $service->adult; ?> people.</div>
                                        <div class="col-md-4">

                                           <?php echo $service->xml_currency; ?>  <?php echo $service->total_amount; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>

                        </div>
                        <div class="bdDone" id="loginDone"></div>
                    </section>



                </div>






                <div class="row">

                    <section  id="emailDetails" class="verySoftShadow">

                        <div class="bdOpen " id="loginOpen">
                            <div class="bdTitle">
                                <h3><?php echo 'Other Available Options'; ?></h3>
                            </div>

                            <form name="book" action="<?php print WEB_URL . 'hoteli/pre_booking/' . $result_id; ?>" method="post" onsubmit="javascript:return book_vali()"/>
                            <table width="95%" border="0" style="margin: 1em; border-collapse: collapse;" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding: .3em; border: 1px #ccc solid;" ></td>
                                    <td style="padding: .3em; border: 1px #ccc solid;font-weight: bold;" >Room Type</td>
                                    <td style="padding: .3em; border: 1px #ccc solid;font-weight: bold;" >Inclusion</td>
                                    <td style="padding: .3em; border: 1px #ccc solid;font-weight: bold;" >Night</td>
                                    <td style="padding: .3em; border: 1px #ccc solid;font-weight: bold;" >Cost</td>
                                    <td style="padding: .3em; border: 1px #ccc solid;font-weight: bold;" >Status</td>
                                </tr>
                                <?php
                                for ($u = 0; $u < count($room_cat_details); $u++) {
                                    ?>

                                 
                                 <tr>
                                    <?php if ($room_cat_details[$u]['process_id'] == $service->room_code) { ?>
                                        <td style="padding: .3em; border: 1px #ccc solid;" ><input checked="checked" type="radio" name="process_id_fin" value="<?php print $room_cat_details[$u]['process_id'] . "|||" . $room_cat_details[$u]['admin_markup'] . "|||" . $room_cat_details[$u]['room'] . "|||" . $room_cat_details[$u]['agent_markup'] . "|||" . $room_cat_details[$u]['boardType'] . "|||" . $room_cat_details[$u]['total_amount'] . "|||" . $room_cat_details[$u]['currencyv1'] . "|||" . $room_cat_details[$u]['c_val'] . "|||" . $room_cat_details[$u]['totalRoomRate']; ?>" /></td>
                                    <?php } else { ?>
                                        <td style="padding: .3em; border: 1px #ccc solid;" ><input type="radio" name="process_id_fin" value="<?php print $room_cat_details[$u]['process_id'] . "|||" . $room_cat_details[$u]['admin_markup'] . "|||" . $room_cat_details[$u]['room'] . "|||" . $room_cat_details[$u]['agent_markup'] . "|||" . $room_cat_details[$u]['boardType'] . "|||" . $room_cat_details[$u]['total_amount'] . "|||" . $room_cat_details[$u]['currencyv1'] . "|||" . $room_cat_details[$u]['c_val'] . "|||" . $room_cat_details[$u]['totalRoomRate']; ?>" /></td>

                                    <?php } ?>
                                    <td style="padding: .3em; border: 1px #ccc solid;" ><?php print $room_cat_details[$u]['room']; ?>

                                    </td>
                                    <td style="padding: .3em; border: 1px #ccc solid;"><?php print $room_cat_details[$u]['boardType']; ?></td>
                                    <td style="padding: .3em; border: 1px #ccc solid;"><?php echo $session_data['days']; ?></td>

                                    <td style="padding: .3em; border: 1px #ccc solid;">
                                        <?php
                                        echo $room_cat_details[$u]['total_amount'] . '  ' . $service->xml_currency;
                                        //$curr_cost = $total_fin.''.$curtype;
                                        //echo $total_fin.''.$curtype;
                                        ?></td>
                                    <td style="padding: .3em; border: 1px #ccc solid;"><?php
                                    if ($room_cat_details[$u]['status'] == 'InstantConfirmation') {
                                        echo 'Available';
                                    } else {
                                        echo 'Pending';
                                    }
                                        ?>
                                    </td>

                                </tr>


                                    <?php
                                }
                                ?>
                                <tr>
                                    <td align="right" colspan="6">

                                        <input value="Continue" type="submit" width="100" height="35" class="btn btn-success" /></td></tr>
                            </table>
                            </form>
                        </div>




                    </section>

                </div>

            </div>      

        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>