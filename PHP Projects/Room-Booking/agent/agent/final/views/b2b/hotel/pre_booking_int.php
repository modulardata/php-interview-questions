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
                                                $cost = 0;
                                                $markup = 0;
                                                $payment_charge = 0;
                                                $org_amt = 0;

                                                $a = explode("-", $result_id);
                                                $sec_res = $service->session_id;
                                                $room_type = '';
                                                for ($k = 0; $k < count($a); $k++) {
                                                    $b = $this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res, $a[$k]);
                                                    $cost = $cost + $b->total_cost;
                                                    //$cost = $cost + $b->total_cost;

                                                    $markup = $markup + $b->markup;
                                                    $payment_charge = $payment_charge + $b->payment_charge;
                                                    $org_amt = $org_amt + $b->org_amt;
                                                    $currency_val = $b->currency_val;
                                                    $xml_currency = $b->xml_currency;



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

                                                <?php echo $service->xml_currency; ?>  <?php echo $cost; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <form name="book" action="<?php echo WEB_URL ?>hotel/pre_booking_int/<?php echo $result_id; ?>" method="POST"  > 
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Contact Details</h3>
                            </div>
                            <div class="row ">
                                <div class="BkdtrvlrDtls">
                                    <input type="hidden" name="result_id" value="<?php echo $result_id; ?>"  />
                                    <input type="hidden" name="amount" value="<?php echo $cost; ?>"  />
                                    <input type="hidden" name="currency" value="USD"  />
                                    <input type="hidden" name="xml_currency" value="<?php echo $xml_currency; ?>"  />
                                    <input type="hidden" name="payment_charge" value="<?php echo $payment_charge; ?>"  />
                                    <input type="hidden" name="org_amt" value="<?php echo $org_amt; ?>"  />
                                    <input type="hidden" name="markup" value="<?php echo $markup; ?>"  />
                                    <input type="hidden" name="currency_val" value="<?php echo $currency_val; ?>"  />
                                    <input type="hidden" name="Cancellation_Policy" value="<?php echo $cancel_policy; ?>"  />
                                    <input type="hidden" name="t_cancel_till_amt" value="<?php echo $new_cancelaion_charge; ?>"  />
                                    <input type="hidden" name="t_cancel_till_date" value="<?php echo $new_cancelaion_till_date; ?>"  />
                                    <input type="hidden" name="room_type" value="<?php echo $room_type; ?>"  />



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

                                                <select name="country" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="US">US</option>
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