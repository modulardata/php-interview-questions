<?php //echo '<pre>';print_r($hotel_detail);print_r($details);exit;     ?>
<?php echo $this->load->view('home/header'); ?>
<?php
$hotel_name = $details->hotel_name;
$city = $details->city;
$image = 'http://www.roomsxml.com' . $details->image;
$description = $details->description;
$amenities = $details->room_facilities;
$star = $details->star;


$hotel_search_data = $this->session->userdata('hotel_search_data');

$checkin = $hotel_search_data['checkin'];
$checkout = $hotel_search_data['checkout'];
$rooms = $hotel_search_data['room_count'];
$noofnights = $hotel_search_data['noofnights'];
$adults = $hotel_search_data['adultvalue'];
$child = $hotel_search_data['childvalue'];

$pass_info = $this->session->userdata('passenger_info');
?>
<!-----  Top destination content ----->
<div class="flightsContainer">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 bookedDetails">
                            <h2>Please Verify all the information</h2>

                            <!-- itinerary details -->
                            <section  id="itineraryDetails" class="verySoftShadow">
                                <div class="bdOpen" id="itineraryOpen">
                                    <div class="bdTitle">
                                        <h3><span>1</span>Itinerary</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4><strong><?php echo $hotel_name . ', ' . $city; ?></strong></h4>
                                            <div class="selected-flight-dtls">
                                                <div class="row detailed-row">
                                                    <div class="col-md-2 hotel-vendor">                          	
                                                        <img src="<?php echo $image; ?>" width="100%" alt="hotel">
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <h4 class="marginTop5 borderDashedBtm"><strong><?php echo $rooms; ?> rooms for <?php echo $noofnights; ?> nights</strong></h4>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="font12">Check-in</span>
                                                                <h4 class="rdtheme"><strong><?php echo $checkin; ?></strong></h4>
<!--                                                                <span class="font12">Thu, 3 pm</span>-->
                                                            </div>	
                                                            <div class="col-md-2 text-center">
                                                                <h4 class=""><i class="fa fa-clock-o"></i></h4>
                                                                <?php echo $noofnights; ?> nights
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="font12">Check-out</span>
                                                                <h4 class="rdtheme"><strong><?php echo $checkout; ?></strong></h4>
<!--                                                                <span class="font12">Thu, 3 pm</span>-->
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php for ($r = 0; $r < $rooms; $r++) { ?>
                                                                    <div class="row padding10 <?php if ($r != ($rooms - 1)) { ?>borderDashedBtm <?php } ?>"">
                                                                         <div class="col-md-4">Room <?php echo $r + 1; ?></div>
                                                                         <div class="col-md-8"><?php echo $adults[$r]; ?> Adults and <?php echo $child[$r]; ?> Child <!-- <span class="font11">(4years)</span>--></div>
                                                                    </div>
                                                                <?php } ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
                                                            <?php echo $hotel_detail->room_type; ?>, <?php echo $hotel_detail->inclusion; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-2"> </div>
                                                <div class="col-md-4">
                                                    <div><h3 class="marginTop5 rdtheme"><strong><!-- <i class="fa fa-rupee"></i>--><?php echo $hotel_detail->xml_currency; ?> <?php echo round($hotel_detail->total_cost,0); ?></strong><span class="font11">(Total fare)</span></h3>
                                                        <span class="font11"><?php echo $rooms; ?> rooms for <?php echo $noofnights; ?> nights</span>
                                                    </div>

                                                </div>

                                            </div>
                                            <!--                                            <div class="row">
                                                                                            <div class="col-md-2"> </div>
                                                                                            <div class="col-md-4">
                                                                                                <button class="btn btn-primary marginTop15">CONTINUE BOOKING</button>
                                                                                            </div>
                                            
                                                                                        </div>-->

                                        </div>
                                    </div>

                                </div>
                                <div class="bdDone" id="itineraryDone">
                                    <div class="row detailed-row">
                                        <div class="col-md-1">
                                            <img src="<?php echo $image; ?>" width="100%" alt="hotel">
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo $hotel_name; ?><br>
                                            <span class="font11"><?php echo $city; ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo $checkin; ?> — <?php echo $checkout; ?><br>
                                            <span class="font11"><?php echo $rooms; ?> rooms for <?php echo $noofnights; ?> nights</span>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo $hotel_detail->xml_currency; ?>. <?php echo round($hotel_detail->total_cost,0); ?><br>
<!--                                            <span class="font11">3 adults, 2 children</span>-->
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <form name="booking" method="POST" action="<?php echo WEB_URL; ?>hotel/payment_process">
                                <!-- login details -->
                                <input type="hidden" name="api" value="<?php echo $hotel_detail->api; ?>" />
                                <input type="hidden" name="booking_id" value="<?php echo $hotel_detail->quote_id; ?>" />
                                <input type="hidden" name="net_amnt" value="<?php echo $hotel_detail->net_cost; ?>" />
                                <input type="hidden" name="admin_markup" value="<?php echo $hotel_detail->admin_markup; ?>" /> 
                                <input type="hidden" name="payment_charge" value="<?php echo $hotel_detail->payment_charge; ?>" /> 
                                <input type="hidden" name="total_price" value="<?php echo round($hotel_detail->total_cost,0); ?>" />
                                <input type="hidden" name="hotel_name" value="<?php echo $hotel_name; ?>"/>
                                <input type="hidden" name="city" value="<?php echo $city; ?>"/>



                                <section  id="emailDetails" class="verySoftShadow">
                                    <div class="bdOpen" id="loginOpen">
                                        <div class="bdTitle">
                                            <h3><span>2</span>Cancellation Policy: </h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">Cancellation Policy</div>
                                            <div class="col-md-8">
                                                <p><?php echo $cancelpolicy; ?></p>                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bdDone" id="loginDone"></div>
                                </section>


                                <section  id="emailDetails" class="verySoftShadow">
                                    <div class="bdOpen" id="loginOpen">
                                        <div class="bdTitle">
                                            <h3><span>3</span>Email address</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">Your email address</div>
                                            <div class="col-md-4">
                                                <input type="text" name="user_email" class="form-control" readonly value="<?php echo $pass_info['user_email']; ?>"/>
                                                <!--                                                <div>
                                                                                                    <label>
                                                                                                        <input type="checkbox">
                                                                                                        I have a iwanthotels password</label>
                                                                                                </div>-->
                                                <!--                                                <div>
                                                                                                    <label>
                                                                                                        <input type="checkbox">
                                                                                                        Send me travel offers, deals and news by email</label>
                                                                                                </div>-->
                                                <!--                                            <div>
                                                                                                <button type="button" class="btn btn-primary">CONTINUE</button>
                                                                                            </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bdDone" id="loginDone"></div>
                                </section>


                                <!-- traveller details -->
                                <section  id="travellerDetails" class="verySoftShadow">
                                    <div class="bdOpen" id="travellersOpen">
                                        <div class="bdTitle">
                                            <h3><span>4</span>Travellers</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="dtlsOffer padding10">Make sure the names you enter match the way they appear on your passport.</div>
                                            </div>
                                        </div>
                                        <div class="BkdtrvlrDtls">

                                            <?php for ($r = 0; $r < $rooms; $r++) { ?>
                                                <div class="row">
                                                    <h4><strong>Room <?php echo ($r + 1); ?></strong></h4>
                                                    <?php
                                                    for ($a = 0; $a < $adults[$r]; $a++) {
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-md-2 txtRight">Name of guest</div>
                                                            <div class="col-md-1 form-group">                                                             
                                                                <input type="text" name="adults_title[]" class="form-control" value="<?php echo $pass_info['adults_title'][$a]; ?>" readonly/>
                                                            </div>
                                                            <div class="col-md-3 form-group">
                                                                <input type="text" name="adults_fname[]" class="form-control" value="<?php echo $pass_info['adults_fname'][$a]; ?>" readonly/>
                                                            </div>
                                                            <div class="col-md-3 form-group">
                                                                <input type="text"  name="adults_lname[]" class="form-control" value="<?php echo $pass_info['adults_lname'][$a]; ?>" readonly/>
                                                            </div>
                                                        </div>
                                                    <?php } ?>


                                                    <?php
                                                    if (array_key_exists($r, $child) && $child[$r] != '') {
                                                        ?>
                                                        <?php
                                                        for ($c = 0; $c < $child[$r]; $c++) {
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-2 txtRight">Child <?php echo ($c + 1); ?></div>
                                                                <div class="col-md-1 form-group">
                                                                    <input type="text" name="childs_title[]" class="form-control" value="<?php echo $pass_info['childs_title'][$c]; ?>" readonly />
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" name="childs_fname[]" class="form-control" value="<?php echo $pass_info['childs_fname'][$c]; ?>" readonly />
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" name="childs_lname[]" class="form-control" value="<?php echo $pass_info['childs_lname'][$c]; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </div>

                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-2 txtRight">Mobile no.</div>
                                                <div class="col-md-7 form-group">
                                                    <input type="text" name="user_mobile" class="form-control" value="<?php echo $pass_info['user_mobile']; ?>" readonly/>
                                                    <span class="font11">Please provide the country code as applicable</span>
                                                </div>
                                            </div>
                                            <!--                                        <div class="row">
                                                                                        <div class="col-md-2 txtRight">Special requests</div>
                                                                                        <div class="col-md-7">
                                                                                            <textarea class="form-control" placeholder="Please enter any special requests that you may have (e.g. late check-in, twin beds, etc.)"></textarea>
                                                                                            <span class="font11">We will pass your special requests along to your hotel but please note that we cannot guarantee these requests, and they may incur additional charges.</span>
                                                                                        </div>
                                                                                    </div>-->
                                        </div>
                                       
                                    </div>
                                    <div class="bdDone" id="travellersDone"></div>
                                </section>

                                <!-- traveller details -->
                                <section  id="travellerDetails" class="verySoftShadow">
                                    <div class="bdOpen" id="travellersOpen">
                                        <div class="bdTitle">
                                            <h3><span>5</span>Payment Process</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2"> <input type="radio" name="payment_type" value="hdfc" checked="checked">HDFC Payments</input></div>
                                            <div class="col-md-2"><input type="radio" name="payment_type" value="payu">Pay U Payments</input></div>

                                            <div class="col-md-5"><button type="submit" class="btn btn-primary marginTop15">CONFIRM</button></div>
                                        </div>
                                    </div>
                                    <div class="bdDone" id="travellersDone"></div>
                                </section>
                            </form>
                            <!-- payment details -->
                         <!--    <section  id="paymentDetails" class="verySoftShadow">
                                <div class="bdOpen" id="paymentOpen">
                                    <div class="bdTitle">
                                        <h3><span>4</span>Payment</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"> 
                                             Nav tabs 
                                            <ul class="nav nav-tabs">
                                                <li><a href="#netbanking" data-toggle="tab">Net Banking</a></li>
                                                <li><a href="#creditcard" data-toggle="tab">Credit Card</a></li>
                                                <li><a href="#debitcard" data-toggle="tab">Debit Card</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="dtlsOffer padding10">A processing fee of Rs. 300 per passenger is applicable on this booking.</div>
                                             Tab panes 
                                            <div class="tab-content"> 
                                                 net banking 
                                                <div class="tab-pane active" id="netbanking">
                                                    <div id="paybyNB" class="padCover">
                                                        <input type="hidden" name="payment_mode" value="NB">
                                                        <h4>Popular banks</h4>
                                                        <nav class="clearFix" id="popularBanks">
                                                            <ul class="gridView row">
                                                                <li class="col four ">
                                                                    <label for="axis_bank" class="">
                                                                        <input type="radio" id="axis_bank" bankid="9" name="nbbank">
                                                                        <span class="bnkLogo axis_bank ir">Axis Bank</span></label>
                                                                </li>
                                                                <li class="col four ">
                                                                    <label for="citibank" class="">
                                                                        <input type="radio" id="citibank" bankid="3" name="nbbank">
                                                                        <span class="bnkLogo citibank ir">Citibank</span></label>
                                                                </li>
                                                                <li class="col four ">
                                                                    <label for="hdfc_bank" class="">
                                                                        <input type="radio" id="hdfc_bank" bankid="2" name="nbbank">
                                                                        <span class="bnkLogo hdfc_bank ir">HDFC Bank</span></label>
                                                                </li>
                                                                <li class="col four firstNewRow">
                                                                    <label for="icici_bank" class="active">
                                                                        <input type="radio" id="icici_bank" bankid="1" name="nbbank">
                                                                        <span class="bnkLogo icici_bank ir">ICICI Bank</span></label>
                                                                </li>
                                                                <li class="col four ">
                                                                    <label for="kotak_bank" class="">
                                                                        <input type="radio" id="kotak_bank" bankid="18" name="nbbank">
                                                                        <span class="bnkLogo kotak_bank ir">Kotak Bank</span></label>
                                                                </li>
                                                                <li class="col four ">
                                                                    <label for="state_bank_of_india" class="">
                                                                        <input type="radio" id="state_bank_of_india" bankid="21" name="nbbank">
                                                                        <span class="bnkLogo state_bank_of_india ir">State Bank of India</span></label>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                        <h4>All other banks</h4>
                                                        <p>
                                                            <select id="transferBank" validate="true" etitle="Transfer bank" class="span ten">
                                                                <option value="0">Pick a bank</option>
                                                                <option value="22">Allahabad Bank</option>
                                                                <option value="44">Andhra Bank</option>
                                                                <option value="9">Axis Bank</option>
                                                                <option value="25">Bank Of Maharashtra</option>
                                                                <option value="24">Bank of Bahrain and Kuwait</option>
                                                                <option value="12">Bank of Baroda - Corporate</option>
                                                                <option value="17">Bank of Baroda - Retail</option>
                                                                <option value="4">Bank of India</option>
                                                                <option value="49">Canara Bank</option>
                                                                <option value="50">Catholic Syrian Bank</option>
                                                                <option value="26">Central Bank of India</option>
                                                                <option value="3">Citibank</option>
                                                                <option value="27">City Union Bank</option>
                                                                <option value="28">Corporation Bank</option>
                                                                <option value="19">Deutsche Bank</option>
                                                                <option value="41">Development Credit Bank</option>
                                                                <option value="42">Dhanlaxmi Bank</option>
                                                                <option value="29">Federal Bank</option>
                                                                <option value="2">HDFC Bank</option>
                                                                <option value="1">ICICI Bank</option>
                                                                <option value="16">IDBI Bank</option>
                                                                <option value="45">ING Vysya Bank</option>
                                                                <option value="30">Indian Bank</option>
                                                                <option value="6">Indian Overseas Bank</option>
                                                                <option value="5">IndusInd Bank</option>
                                                                <option value="46">Jammu and Kashmir Bank</option>
                                                                <option value="7">Karnataka Bank</option>
                                                                <option value="20">Karur Vyasa Bank</option>
                                                                <option value="18">Kotak Bank</option>
                                                                <option value="31">Lakshmi Vilas Bank</option>
                                                                <option value="13">Oriental Bank of Commerce</option>
                                                                <option value="14">Punjab National Bank - Corporate</option>
                                                                <option value="15">Punjab National Bank - Retail</option>
                                                                <option value="47">Royal Bank of Scotland</option>
                                                                <option value="39">SBI ATM-cum-DEBIT Card</option>
                                                                <option value="11">South Indian Bank</option>
                                                                <option value="48">Standard Chartered Bank</option>
                                                                <option value="32">State Bank of Bikaner and Jaipur</option>
                                                                <option value="33">State Bank of Hyderabad</option>
                                                                <option value="21">State Bank of India</option>
                                                                <option value="34">State Bank of Indore</option>
                                                                <option value="35">State Bank of Mysore</option>
                                                                <option value="51">State Bank of Patiala</option>
                                                                <option value="36">State Bank of Travancore</option>
                                                                <option value="40">Syndicate Bank</option>
                                                                <option value="37">Tamilnad Mercantile Bank</option>
                                                                <option value="8">Union Bank of India</option>
                                                                <option value="43">United Bank of India</option>
                                                                <option value="38">Vijaya Bank</option>
                                                                <option value="10">Yes Bank</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div> -->

                            <!-- credit card 
                            <div class="tab-pane" id="creditcard">
                                <div id="CCTab" class="padCover">
                                    <h4 id="ccTitle">Enter your credit card details</h4>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            Credit card no.
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input class="form-control" type="text"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            Expiry date
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <select name="card_expiration_month" validate="true" id="CcExpirationMonth" etitle="Credit card expiration month " class="span form-control">
                                                <option value="">Month</option>


                                                <option value="01"> 01 </option>


                                                <option value="02"> 02 </option>


                                                <option value="03"> 03 </option>


                                                <option value="04"> 04 </option>


                                                <option value="05"> 05 </option>


                                                <option value="06"> 06 </option>


                                                <option value="07"> 07 </option>


                                                <option value="08"> 08 </option>


                                                <option value="09"> 09 </option>


                                                <option value="10"> 10 </option>


                                                <option value="11"> 11 </option>


                                                <option value="12"> 12 </option>


                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="card_expiration_year" validate="true" id="CcExpirationYear" class="span form-control" etitle="Credit card expiration year">
                                                <option value="">Year</option>


                                                <option value="2014">2014</option>


                                                <option value="2015">2015</option>


                                                <option value="2016">2016</option>


                                                <option value="2017">2017</option>


                                                <option value="2018">2018</option>


                                                <option value="2019">2019</option>


                                                <option value="2020">2020</option>


                                                <option value="2021">2021</option>


                                                <option value="2022">2022</option>


                                                <option value="2023">2023</option>


                                                <option value="2024">2024</option>


                                                <option value="2025">2025</option>


                                                <option value="2026">2026</option>


                                                <option value="2027">2027</option>


                                                <option value="2028">2028</option>


                                                <option value="2029">2029</option>


                                                <option value="2030">2030</option>


                                                <option value="2031">2031</option>


                                                <option value="2032">2032</option>


                                                <option value="2033">2033</option>


                                                <option value="2034">2034</option>


                                                <option value="2035">2035</option>


                                                <option value="2036">2036</option>


                                                <option value="2037">2037</option>


                                                <option value="2038">2038</option>


                                                <option value="2039">2039</option>


                                                <option value="2040">2040</option>


                                                <option value="2041">2041</option>


                                                <option value="2042">2042</option>


                                                <option value="2043">2043</option>


                                                <option value="2044">2044</option>


                                                <option value="2045">2045</option>


                                                <option value="2046">2046</option>


                                                <option value="2047">2047</option>


                                                <option value="2048">2048</option>


                                                <option value="2049">2049</option>


                                                <option value="2050">2050</option>


                                                <option value="2051">2051</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            Card holder
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input class="form-control" type="text" placeholder="Name as on card"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            CVV
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input class="form-control" type="text"/>
                                        </div>
                                        <div class="col-md-3 font11">
                                            The 3 digit number printed on the back of the card
                                        </div>
                                    </div>
                                </div>
                            </div>

                             debit card 
                            <div class="tab-pane" id="debitcard">
                                <div id="DCTab" class="padCover">
                                    <h4 id="dcTitle">Enter your Debit card details</h4>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            Debit card no.
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input class="form-control" type="text"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            Expiry date
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <select name="card_expiration_month" validate="true" id="CcExpirationMonth" etitle="Credit card expiration month " class="span form-control">
                                                <option value="">Month</option>


                                                <option value="01"> 01 </option>


                                                <option value="02"> 02 </option>


                                                <option value="03"> 03 </option>


                                                <option value="04"> 04 </option>


                                                <option value="05"> 05 </option>


                                                <option value="06"> 06 </option>


                                                <option value="07"> 07 </option>


                                                <option value="08"> 08 </option>


                                                <option value="09"> 09 </option>


                                                <option value="10"> 10 </option>


                                                <option value="11"> 11 </option>


                                                <option value="12"> 12 </option>


                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="card_expiration_year" validate="true" id="CcExpirationYear" class="span form-control" etitle="Credit card expiration year">
                                                <option value="">Year</option>


                                                <option value="2014">2014</option>


                                                <option value="2015">2015</option>


                                                <option value="2016">2016</option>


                                                <option value="2017">2017</option>


                                                <option value="2018">2018</option>


                                                <option value="2019">2019</option>


                                                <option value="2020">2020</option>


                                                <option value="2021">2021</option>


                                                <option value="2022">2022</option>


                                                <option value="2023">2023</option>


                                                <option value="2024">2024</option>


                                                <option value="2025">2025</option>


                                                <option value="2026">2026</option>


                                                <option value="2027">2027</option>


                                                <option value="2028">2028</option>


                                                <option value="2029">2029</option>


                                                <option value="2030">2030</option>


                                                <option value="2031">2031</option>


                                                <option value="2032">2032</option>


                                                <option value="2033">2033</option>


                                                <option value="2034">2034</option>


                                                <option value="2035">2035</option>


                                                <option value="2036">2036</option>


                                                <option value="2037">2037</option>


                                                <option value="2038">2038</option>


                                                <option value="2039">2039</option>


                                                <option value="2040">2040</option>


                                                <option value="2041">2041</option>


                                                <option value="2042">2042</option>


                                                <option value="2043">2043</option>


                                                <option value="2044">2044</option>


                                                <option value="2045">2045</option>


                                                <option value="2046">2046</option>


                                                <option value="2047">2047</option>


                                                <option value="2048">2048</option>


                                                <option value="2049">2049</option>


                                                <option value="2050">2050</option>


                                                <option value="2051">2051</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            Card holder
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input class="form-control" type="text" placeholder="Name as on card"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 txtRight">
                                            CVV
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input class="form-control" type="text"/>
                                        </div>
                                        <div class="col-md-3 font11">
                                            The 3 digit number printed on the back of the card
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label>
                                    <input type="checkbox" class="marginRight5"/>
                                    I understand and agree to the rules and restrictions of this fare, the Booking Policy and the Terms & Conditions of Cleartrip</label>
                            </div>
                            <div>
                                <h3 class="rdtheme"><strong><i class="fa fa-rupee"></i> 34,481</strong> <span class="font11">(Total inclusive all taxes)</span></h3>
                            </div>
                            <div>
                                <button class="btn btn-primary">MAKE PAYMENT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bdDone" id="paymentDone"></div>
            </section>  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- baggage rules -->
<!--<div class="modal fade" id="modalBaggageAllowance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Baggage allowance</h3>
            </div>
            <div class="modal-body">
                <table class="baggageAllowance">
                    <tr>
                        <th><i class="fa fa-plane"></i></th>
                        <th>Bangalore → Singapore</th>
                    </tr>
                    <tr>
                        <td width="100px">Adult:</td>
                        <td>40 KG check-in baggage<br>
                            7 KG cabin baggage </td>
                    </tr>
                </table>
                <table class="baggageAllowance">
                    <tr>
                        <th><i class="fa fa-plane"></i></th>
                        <th>Bangalore → Singapore</th>
                    </tr>
                    <tr>
                        <td width="100px">Adult:</td>
                        <td>40 KG check-in baggage<br>
                            7 KG cabin baggage </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>-->
<?php echo $this->load->view('home/footer'); ?>