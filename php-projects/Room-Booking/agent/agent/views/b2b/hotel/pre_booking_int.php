<?php echo $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">
<!-----  Top destination content ----->
<style>
    .padd{
        padding:10px;  
    }
</style>
<div class="hotelCntr">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12 bookedDetails">
                <section  id="travellerDetails" class="verySoftShadow">
                    <div class="bdOpen " id="travellersOpen">
                        <div class="bdTitle">
                            <h3>Search Details</h3>
                        </div>
                        <div class="row ">
                            <div class="BkdtrvlrDtls">

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
                                                <?php echo $sess_hotel_search_data['checkin']; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Check-out</div>
                                            <div class="col-md-4">
                                                <?php echo $sess_hotel_search_data['checkout']; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Room Type</div>
                                            <div class="col-md-4">
                                                <?php
                                                //echo $result_id;
                                                $agent_id = $this->session->userdata('agent_id');
                                                $a = explode("-", $result_id);
                                                $sec_res = $service->session_id;
                                                $room_type = '';
                                                for ($k = 0; $k < count($a); $k++) {
                                                    $b = $this->Hotelspro_Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res, $a[$k]);
                                                    $agent_account_balance = $this->Hotelspro_Hotel_Model->get_agent_account_balance($agent_id);
                                                    $balance_amount = $agent_account_balance->available_balance;
                                                    $room_type .= $b->room_type . "-" . $b->inclusion . "<br>";
                                                }

                                                echo $room_type;
                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2"><?php echo $service->room_count; ?> Rooms</div>
                                            <div class="col-md-4">

                                                <?php echo $service->xml_currency ?>  <?php echo $service->total_amount; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Cancellation Policy</div>
                                            <div class="col-md-4">

                                                <?php
                                                if (isset($cancel_policy)) {
                                                    $can = $cancel_policy;
                                                } else {
                                                    $can = $service->cancel_policy;
                                                }
                                                ?><?php echo "<div>Calcellation policy : " . $can . "</div>"; //$can  ?>

                                                <?php if (!empty($tariffNotes)) { ?>
                                                    Tariff Notes : 
                                                    <?php
                                                    for ($r_i = 0; $r_i < count($tariffNotes); $r_i++) {
                                                        echo $tariffNotes[$r_i] . "<br>";
                                                    }
                                                    ?>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <form name="book" action="<?php echo WEB_URL ?>hoteli/pre_booking/<?php echo $result_id; ?>" method="POST"  > 
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Contact Details</h3>
                            </div>
                            <div class="row ">
                                <div class="BkdtrvlrDtls">
                                    <input type="hidden" name="result_id" value="<?php echo $result_id; ?>"  />

                                    <input type="hidden" name="currency" value="<?php echo $charge_ty; ?>"  />
                                    <input type="hidden" name="xml_currency" value="<?php echo $service->xml_currency; ?>"  />
                                    <input type="hidden" name="room_type" value="<?php echo $room_type; ?>"  />
                                    <input type="hidden" name="agent_markup" value="<?php echo $agent_markup; ?>"  />
                                    <input type="hidden" name="admin_markup" value="<?php echo $admin_markup; ?>"  />
                                    <input type="hidden" name="totalprice" value="<?php echo $totalPrice; ?>"  />
                                    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>"  />
                                    <input type="hidden" name="Cancellation_Policy" value="<?php echo $cancel_policy; ?>"  />
                                    <input type="hidden" name="t_cancel_till_amt" value="<?php echo $new_cancelaion_charge; ?>"  />
                                    <input type="hidden" name="t_cancel_till_date" value="<?php echo $new_cancelaion_till_date; ?>"  />



                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Email Address *</div>
                                            <div class="col-md-4">
                                                <input type="text" name="email" required class="form-control" tabindex="143" maxlength="75" placeholder="Your booking details will be sent here" title="Enter your email id" onblur="return email_validate(this.id);"/> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Conf Email Address *</div>
                                            <div class="col-md-4">
                                                <input type="text" name="cemail" required class="form-control" tabindex="143" maxlength="75" placeholder="Your email should match above" title="Enter your email id" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Address *</div>
                                            <div class="col-md-4">

                                                <textarea name="address" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">City *</div>
                                            <div class="col-md-4">

                                                <input type="text" name="city" required class="form-control" tabindex="143" maxlength="75" placeholder="City" title="City" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">State *</div>
                                            <div class="col-md-4">

                                                <input type="text" name="state" required class="form-control" tabindex="143" maxlength="75" placeholder="STATE" title="State" /> 

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Zip/Post Code *</div>
                                            <div class="col-md-4">

                                                <input type="text" name="pin" required class="form-control" tabindex="143" maxlength="75" placeholder="Pin code" title="Pin" /> 


                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Country *</div>
                                            <div class="col-md-4">

                                                <select name="country" class="form-control" required>
                                                    <?php for ($i = 0; $i < count($country_list); $i++) { ?>

                                                        <option value="<?php echo $country_list[$i]->iso2; ?>"><?php echo $country_list[$i]->name; ?></option>

                                                    <?php } ?>	


                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            <div class="col-md-2">Telephone *</div>
                                            <div class="col-md-4">

                                                <input type="text" name="mobile" required class="form-control" tabindex="143" maxlength="75" placeholder="Mobile" title="Mobile" /> 

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="padd">
                                            &nbsp;
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </section>

                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Passenger Details</h3>
                            </div>
                            <div class="row ">
                                <div class="BkdtrvlrDtls">
                                    <div class="row">
                                        <div class="padd">
                                            Please fill the names of the passengers as they officially appear on identities or passports. 
                                        </div>
                                    </div>

                                    <?php
                                    $sess_hotel_search_data = $this->session->userdata('hotel_search_data');
                                    for ($i = 0; $i < $sess_hotel_search_data['room_count']; $i++) {
                                        ?>
                                        <div class="row">
                                            <div class="padd">
                                                Room <?php echo $i + 1; ?> :
                                            </div>
                                        </div>
                                        <?php
                                        for ($j = 0; $j < $sess_hotel_search_data['adultvalue'][$i]; $j++) {
                                            ?>

                                            <div class="row">
                                                <div class="padd">
                                                    <div class="col-md-2">Adult *</div>
                                                    <div class="col-md-2">

                                                        <select name="sal[]" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <option value="Mr">Mr</option>
                                                            <option value="Mss">Mss</option>
                                                            <option value="Mrs">Mrs</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-md-2">

                                                        <input type="text" name="fname[]" required class="form-control" tabindex="143" maxlength="75" placeholder="First Name" title="Name" /> 

                                                    </div>
                                                    <div class="col-md-2">

                                                        <input type="text" name="lname[]" required class="form-control" tabindex="143" maxlength="75" placeholder="Last Name" title="Last Name" /> 

                                                    </div>
                                                    <div class="col-md-2">

                                                        <select name="gender[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>

                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }

                                        for ($j = 0; $j < $sess_hotel_search_data['childvalue'][$i]; $j++) {
                                            ?>

                                            <div class="row">
                                                <div class="padd">
                                                    <div class="col-md-2">Child *</div>
                                                    <div class="col-md-2">

                                                        <select name="csal[]" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <option value="Mr">Master</option>
                                                            <option value="Mss">Mss</option>

                                                        </select>

                                                    </div>
                                                    <div class="col-md-2">

                                                        <input type="text" name="cname[]" required class="form-control" tabindex="143" maxlength="75" placeholder="First Name" title="Name" /> 

                                                    </div>
                                                    <div class="col-md-2">

                                                        <input type="text" name="cname1[]" required class="form-control" tabindex="143" maxlength="75" placeholder="Last Name" title="Last Name" /> 

                                                    </div>
                                                    <div class="col-md-2">

                                                        <select name="cgender[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div> 

                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="padd">
                                            &nbsp;
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </section>


                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="padd">
                                <div class="row ">
                                    <input type="submit"  onclick="return validatefields();" value="Continue for payment" class="btn btn-primary"/> 

                                </div>
                            </div>
                        </div>
                    </section>









                </form>


            </div>
        </div>
    </div>
</div>
<?php echo $this->load->view('home/footer'); ?>