<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">

<!-----  Top destination content ----->

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





                <form action="<?php echo WEB_URL; ?>hoteld/provisional_booking" method="post">
                    <!-- Cancellation details -->
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Hotel Search Details</h3>
                            </div>
                            <div class="row ">

                                <div>

                                    <?php $hotel_search_data = $this->session->userdata('hotel_search_data'); ?>

                                    <div class="row padd">
                                        <div class="col-md-3"> 
                                            Hotel Name:
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php echo $hotel_booking_details->hotel_name; ?>
                                            <input type="hidden" name="hotel_name" value="<?php echo $hotel_booking_details->hotel_name; ?>"/>
                                        </div>
                                    </div>
                                    <div class="row padd">
                                        <div class="col-md-3"> 
                                            Hotel Address:
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php echo $hotel_booking_details->address; ?>
                                            <input type="hidden" name="address" value="<?php echo $hotel_booking_details->address; ?>"/>
                                        </div>
                                    </div>
                                    <div class="row padd">
                                        <div class="col-md-3"> 
                                            Room Type:
                                        </div>
                                        <div class="col-md-3"> 
                                            <strong><?php echo $hotel_booking_details->room_type_name ?></strong>
                                        </div>
                                    </div>
                                    <?php if ($hotel_booking_details->rate_plan_inclusion) {
                                        ?>

                                        <div class="row padd">
                                            <div class="col-md-3"> 
                                                Inclusion:
                                            </div>
                                            <div class="col-md-3"> 
                                                <strong><?php echo $hotel_booking_details->rate_plan_inclusion ?></strong>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                    <div class="row padd">
                                        <div class="col-md-3"> 
                                            Location: 
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php echo $hotel_search_data['city']; ?>
                                        </div>

                                    </div>
                                    <div class="row padd">
                                        <div class="col-md-3"> 
                                            Check In: 
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php echo $hotel_search_data['checkin']; ?>
                                        </div>
                                    </div>
                                    <div class="row padd">
                                        <div class="col-md-3"> 
                                            Check Out:
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php echo $hotel_search_data['checkout']; ?>
                                        </div>

                                    </div>
                                    <div class="row padd">
                                        <?php
                                        $adultvalue = $hotel_search_data['adultvalue'];
                                        $childvalue = $hotel_search_data['childvalue'];
                                        $room_count = $hotel_search_data['room_count'];

                                        for ($j = 0; $j < $room_count; $j++) {

                                            $acount = +$adultvalue[$j];
                                            $ccount = +$childvalue[$j];

                                            $adult_count = $adult_count + $acount;
                                            $child_count = $child_count + $ccount;
                                        }
                                        ?>
                                        <div class="col-md-3"> 
                                            Adults: 
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php echo $adult_count; ?>
                                        </div>
                                    </div>
                                    <div class="row padd">
                                        <div class="col-md-3"> 
                                            Child:
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php echo $child_count; ?>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bdDone" id="travellersDone"></div>
                    </section>

                    <!-- login details -->
                    <section  id="emailDetails" class="verySoftShadow">
                        <div class="bdOpen " id="loginOpen">
                            <div class="bdTitle">
                                <h3>Email address</h3>
                            </div>


                            <div class="row">

                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Your email address</div>
                                        <div class="col-md-4">
                                            <input type="text"  class="form-control" tabindex="143" maxlength="75" placeholder="Your booking details will be sent here" title="Enter your email id" id="userEmailId" name="userEmailId"  onblur="return email_validate(this.id);"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Mobile No</div>
                                        <div class="col-md-4">
                                            <input type="text"  class="form-control" tabindex="143" maxlength="10" placeholder="Enter Mobile Number" title="Enter Mobile Number" id="userMobilNo" name="userMobilNo"  onblur="return mobile_validate(this.id);"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Country</div>
                                        <div class="col-md-4" >
                                            <select name="country" class="form-control" >

                                                <?php
                                                foreach ($country as $val) {
                                                    if ($val->name == 'India') {
                                                        ?>
                                                        <option value="<?php echo $val->name; ?>" selected ><?php echo $val->name; ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $val->name; ?>"  ><?php echo $val->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">City</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="CITY" name="city" required /> 

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Postal Code</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="POSTAL CODE" name="p_code" required /> 

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

                    <!-- traveller details -->
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Travellers</h3>
                            </div>
                            <div class="row ">
                                <input type="hidden" name="email_id" id="travMail" />
                                <input type="hidden" name="mobile_no" id="travMobile" />

                                <div class="BkdtrvlrDtls">


                                    <?php $session_dat = $this->session->userdata('hotel_search_data'); //echo '<pre>';print_r($session_dat);    ?>

                                    <div class="row">
                                        <div class="col-md-2 txtRight">&nbsp;Adult</div>
                                        <div class="col-md-1 form-group">
                                            <select name="atitle" class="form-control">
                                                <option>Title</option>
                                                <option value="Mr">Mr</option>
                                                <option value="MS">Ms</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="afname" class="form-control" placeholder="First Name"/>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="amname" class="form-control" placeholder="Middle Name"/>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="alname" class="form-control" placeholder="Last Name"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="bdDone" id="travellersDone"></div>
                    </section>

                            <!-- Cancellation details -->
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Cancellation Policy</h3>
                            </div>
                            <div class="row ">

                                <div class="col-md-12">


                                    <p>
                                        <?php echo substr($hotel_booking_details->calcellation_policy, 0, -1) ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="bdDone" id="travellersDone"></div>
                    </section>
                    <!-- Refunds details -->
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Refunds</h3>
                            </div>
                            <div class="row ">

                                <div class="col-md-12">

                                    <table width="100%" border="0" cellpadding="3" cellspacing="5" class="payment-text">
                                        <tbody>
                                            <tr>
                                                <td width="2%" class="payment-text">1</td>
                                                <td width="98%">We assure that your refund will be processed within 5 working days for Credit Card payments.</td>
                                            </tr>
                                            <tr>
                                                <td class="payment-text">2</td>
                                                <td>In case you had paid by Cash or Cheque your refund will be made within 10 working days by cheque payment.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="bdDone" id="travellersDone"></div>
                    </section>

                    <!-- Refunds details -->
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Terms and conditions</h3>
                            </div>
                            <div class="row ">

                                <div class="col-md-12">

                                    <table width="100%" border="0" cellpadding="3" cellspacing="5" >
                                        <tbody><tr>
                                                <td width="2%" class="payment-text">1</td>
                                                <td width="98%"> The primary guest must be at least 18 years of age to check into this hotel.</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="payment-text">2</td>
                                                <td>As per Government regulations, It is mandatory for all guests above 18 years of age to carry a valid photo identity card &amp; address proof at the time of check-in. In case, check-in is denied by the hotel due to lack of required documents, you cannot claim for the refund &amp; the booking will be considered as NO SHOW.</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="payment-text">3</td>
                                                <td>Unless mentioned, the tariff does not include charges for optional room services (such as telephone calls, room service, mini bar, snacks, laundry etc). In case, such additional charges are levied by the hotel, we shall not be held responsible for it.</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="payment-text">4</td>
                                                <td>All hotels charge a compulsory Gala Dinner Supplement on Christmas and New Year's eve. Other special supplements may also be applicable during festival periods such as Dusshera, Diwali etc. Any such charge would have to be cleared directly at the hotel.</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="payment-text">5</td>
                                                <td>In case of an increase in the hotel tariff (for example, URS period in Ajmer or Lord Jagannath Rath Yatra in Puri) the customer is liable to pay the difference if the stay period falls during these dates</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="payment-text">6</td>
                                                <td>Roombooking will not be responsible for any service issues at the hotel</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <div class="bdDone" id="travellersDone"></div>
                    </section>

                    <!-- Payment details -->
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Payment Process</h3>
                            </div>
                            <div class="row ">

                                   <div class="row">
                                    <div class="col-md-12"> 
                                    <p><input type="checkbox" name="agree" required checked="checked">I have read the Roombooking Terms and conditions </input></p>
                                    </div>
                                </div>
                                <div class="BkdtrvlrDtls">
                                    <div class="col-md-2"> <input type="radio" name="payment_type" value="deposite" checked="checked">Deposit Payments</input></div>
                                    <div class="col-md-2"> <input type="radio" name="payment_type" value="hdfc" desabled>HDFC Payments</input></div>
                                    <div class="col-md-2"><input type="radio" name="payment_type" value="payu">Pay U Payments</input></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="bdDone" id="travellersDone"></div>
                    </section>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>