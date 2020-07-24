<?php echo $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">
<!-----  Top destination content ----->
 
<style>
    .form-control{margine:5px;}
</style>
<!-----  Top destination content ----->
<div class="bookingContainer">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 bookedDetails">
                            <h2>3 simple steps to book</h2>

                            <!-- itinerary details -->
                            <section  id="itineraryDetails" class="verySoftShadow">
                                <div class="bdOpen" id="itineraryOpen">
                                    <div class="bdTitle">
                                        <h3>Itinerary</h3>
                                    </div>
                                    <div class="row itineraryOpen">
                                        <div class="col-md-10">
                                            <h4><strong>Hotel Pennsylvania Midtown West, New York</strong></h4>
                                            <div class="selected-flight-dtls">
                                                <div class="row detailed-row">
                                                    <div class="col-md-2 hotel-vendor">                          	
                                                        <img src="img/hotels/hotel-ambassador.jpg" width="100%" alt="hotel">
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <h4 class="marginTop5 borderDashedBtm"><strong>2 rooms for 2 nights</strong></h4>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="font12">Check-in</span>
                                                                <h4 class="rdtheme"><strong>JAN 23</strong></h4>
                                                                <span class="font12">Thu, 3 pm</span>
                                                            </div>	
                                                            <div class="col-md-2 text-center">
                                                                <h4 class=""><i class="fa fa-clock-o"></i></h4>
                                                                2 nights
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="font12">Check-out</span>
                                                                <h4 class="rdtheme"><strong>JAN 25</strong></h4>
                                                                <span class="font12">Thu, 3 pm</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row padding10 borderDashedBtm">
                                                                    <div class="col-md-4">Room 1</div>
                                                                    <div class="col-md-8">2 Adults and 1 Child <span class="font11">(4years)</span></div>
                                                                </div>

                                                                <div class="row padding10">
                                                                    <div class="col-md-4">Room 1</div>
                                                                    <div class="col-md-8">2 Adults and 1 Child <span class="font11">(4years)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
                                                            Superior Double Room, 2 Double Beds
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-2"> </div>
                                                <div class="col-md-4">
                                                    <div><h3 class="marginTop5 rdtheme"><strong><i class="fa fa-rupee"></i> 34,481</strong><span class="font11">(Total fare)</span></h3>
                                                        <span class="font11">2 rooms for 2 nights (rate details)</span>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="row detailed-row">
                                                <div class="col-md-2"> </div>
                                                <div class="col-md-4">

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="bdDone" id="itineraryDone">
                                    <div class="row detailed-row">
                                        <div class="col-md-1">
                                            <img src="img/hotels/hotel-ambassador.jpg" width="100%" alt="hotel">
                                        </div>
                                        <div class="col-md-3">
                                            Hotel Pennsylvania<br>
                                            <span class="font11">New York</span>
                                        </div>
                                        <div class="col-md-3">
                                            23 Jan, 2014 — 25 Jan, 2014<br>
                                            <span class="font11">2 rooms for 2 nights</span>
                                        </div>
                                        <div class="col-md-3">
                                            Rs. 34,481<br>
                                            <span class="font11">3 adults, 2 children</span>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                            $hotel_detail_resp = $this->session->userdata('hotel_detail_resp');
                            $hotel_search_data = $this->session->userdata('hotel_search_data');
                            //echo '<pre>'; print_r($this->session->all_userdata()); exit;
                            $dom2 = new DOMDocument();
                            $dom2->loadXML($hotel_detail_resp);
                            $roomstay = $dom2->getElementsByTagName("RoomStay");
                            foreach ($roomstay as $val) {
                                $BasicPropertyInfo = $val->getElementsByTagName("BasicPropertyInfo");
                                $HotelName = $BasicPropertyInfo->item(0)->getAttribute('HotelName');

                                $Address = $val->getElementsByTagName("Address");
                                foreach ($Address as $add) {
                                    $AddressLine = $add->getElementsByTagName("AddressLine");
                                    $AddressLineval = $AddressLine->item(0)->nodeValue;

                                    $StateProv = $add->getElementsByTagName("StateProv");
                                    $StateProvval = $StateProv->item(0)->nodeValue;
                                }

                                $HotelBasicInformation = $val->getElementsByTagName("HotelBasicInformation");
                                foreach ($HotelBasicInformation as $info) {
                                    //$HotelBasicInformation = $info->getElementsByTagName("HotelBasicInformation");
                                    $Multimedia = $info->getElementsByTagName('Multimedia');
                                    $ImageUrl = $Multimedia->item(0)->getAttribute('ImageUrl');
                                    //$ImageUrl = $Multimedia->getAttribute('ImageUrl');
                                }
                            }
                            $user_id = $this->session->userdata('user_id');
                            $title = $this->session->userdata('title');
                            $user_first_name = $this->session->userdata('user_first_name');

                            //$country = $this->session->userdata('country');
                            $city = $hotel_search_data['city'];
                            $checkin = $hotel_search_data['checkin'];
                            $checkout = $hotel_search_data['checkout'];
                            //$pin_code = $this->session->userdata('pin_code');
                            ?>
                            <form action="<?php echo WEB_URL; ?>hoteld/provisional_booking" method="post">
                                <!-- login details -->
                                <section  id="emailDetails" class="verySoftShadow">
                                    <div class="bdOpen " id="loginOpen">
                                        <div class="bdTitle">
                                            <h3>Email address</h3>
                                        </div>


                                        <div class="row">


                                            <div class="col-md-2">Your email address</div>
                                            <div class="col-md-4">
                                                <input type="text"  class="form-control" tabindex="143" maxlength="75" placeholder="Your booking details will be sent here" title="Enter your email id" id="userEmailId" name="userEmailId"  onblur="return email_validate(this.id);"/> 

                                            </div>
                                            <div class="col-md-2">Mobile No</div>
                                            <div class="col-md-4">
                                                <input type="text"  class="form-control" tabindex="143" maxlength="10" placeholder="Enter Mobile Number" title="Enter Mobile Number" id="userMobilNo" name="userMobilNo"  onblur="return mobile_validate(this.id);"/> 

                                            </div>
                                            <div class="col-md-2">Country</div>
                                            <div class="col-md-4" >
                                                <select name="country" class="form-control" >

                                                    <?php
                                                    foreach ($country as $val) {
                                                        ?>
                                                        <option value="<?php echo $val->name; ?>" ><?php echo $val->name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col-md-2">City</div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="CITY" name="city" required /> 

                                            </div>
                                            <div class="col-md-2">Postal Code</div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="POSTAL CODE" name="p_code" required /> 

                                            </div>

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


                                                <?php $session_dat = $this->session->userdata('hotel_search_data'); //echo '<pre>';print_r($session_dat);   ?>
                                                <?php for ($j = 0; $j < $session_dat['room_count']; $j++) { ?>
                                                    <?php for ($k = 0; $k < $session_dat['adultvalue'][$j]; $k++) { ?>
                                                        <div class="row">
                                                            <div class="col-md-2 txtRight">&nbsp;Adult - <?php echo $k + 1; ?> </div>
                                                            <div class="col-md-1 form-group">
                                                                <select name="atitle[]" class="form-control">
                                                                    <option>Title</option>
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="MS">Ms</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 form-group">
                                                                <input type="text" name="afname[]" class="form-control" placeholder="First Name"/>
                                                            </div>
                                                            <div class="col-md-3 form-group">
                                                                <input type="text" name="amname[]" class="form-control" placeholder="Middle Name"/>
                                                            </div>
                                                            <div class="col-md-3 form-group">
                                                                <input type="text" name="alname[]" class="form-control" placeholder="Last Name"/>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                    ?>

                                                    <?php if ($session_dat['childvalue'][$j] != 0) { ?>
                                                        <?php for ($k = 0; $k < $session_dat['childvalue'][$j]; $k++) { ?>
                                                            <div class="row">
                                                                <div class="col-md-2 txtRight">&nbsp;Child - <?php echo $k + 1; ?> </div>
                                                                <div class="col-md-1 form-group">
                                                                    <select name="ctitle[]" class="form-control">
                                                                        <option>Title</option>
                                                                        <option value="Mr">Mr</option>
                                                                        <option value="MS">Ms</option>
                                                                        <option value="Mrs">Mrs</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" name="cfname[]" class="form-control" placeholder="First Name"/>
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" name="cmname[]" class="form-control" placeholder="Middle Name"/>
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" name="clname[]" class="form-control" placeholder="Last Name"/>
                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                    <?php } ?> 
                                                <?php } ?>







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
                            <!-- payment details -->
                            <section  id="paymentDetails" class="verySoftShadow">
                                <div class="bdOpen disabled" id="paymentOpen">
                                    <div class="bdTitle">
                                        <h3>Payment</h3>
                                    </div>
                                    <div class="row paymentOpen">
                                        <div class="col-md-2"> 
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs">
                                                <li><a href="#netbanking" data-toggle="tab">Net Banking</a></li>
                                                <li><a href="#creditcard" data-toggle="tab">Credit Card</a></li>
                                                <li><a href="#debitcard" data-toggle="tab">Debit Card</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="dtlsOffer padding10">A processing fee of Rs. 300 per passenger is applicable on this booking.</div>
                                            <!-- Tab panes -->
                                            <div class="tab-content"> 
                                                <!-- net banking -->
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
                                                            <select id="transferBank" validate="true" style="width:300px;" etitle="Transfer bank" class="form-control">
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
                                                </div>

                                                <!-- credit card -->
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

                                                <!-- debit card -->
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
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- baggage rules -->
<div class="modal fade" id="modalBaggageAllowance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div>

<!-- FOOTER -->
<?php echo $this->load->view('home/footer'); ?>

   