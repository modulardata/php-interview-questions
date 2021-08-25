<?php echo $this->load->view('home/header'); ?>  
<?php //echo '<pre>';print_r($this->session->all_userdata());exit;               ?>
<?php
$selectbus = $this->session->userdata('selectbus1');
$selectbus2 = $this->session->userdata('selectbus2');
$pass_info = $this->session->userdata('pass_info');
$seat = $selectbus['seatname'];
$seat2 = $selectbus2['seatname'];
$pass = explode(',', $seat);
$bus_search_data = $this->session->userdata('bus_search_data');
$triptype = $bus_search_data['bustrip'];
$fromcity = $bus_search_data['sourcename'];
$tocity = $bus_search_data['destiname'];
$frmdate = $bus_search_data['from_date'];
$todate = $bus_search_data['to_date'];
$travels = $selectbus['travels'];
$bus_type = $selectbus['bus_type'];
$board = $selectbus['location'];
$boardtime = $selectbus['time'];
$sprice = $selectbus['sprice'];
$travels2 = $selectbus2['travels'];
$bus_type2 = $selectbus2['bus_type'];
$board2 = $selectbus2['location'];
$boardtime2 = $selectbus2['time'];
$sprice2 = $selectbus2['sprice'];
$tot_amnt = $sprice + $sprice2;
?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">
<div class="hotelCntr">
    <div class="container"> 

        <!-- flight trip details section-->
        <div class="row">
            <div class="col-md-9">
                <div class="hotelResultsCntr"> 
                    <form action="<?php echo WEB_URL; ?>bus/iternary_confirm" method="post">
<!--                    <form action="" method="post">-->
                        <!-- traveller details -->
                        <div class="white-container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="searchHdr">Traveller details</div>
                                    <div class="selectedBus-travellerDtls">
                                        <div class="row header">
                                            <div class="col-md-1"><strong>No</strong></div>
                                            <div class="col-md-1"><strong>Title</strong></div>
                                            <div class="col-md-4"><strong>Name</strong></div>
                                            <div class="col-md-3"><span class="marginLeft15"><strong>Gender</strong></span></div>
                                            <div class="col-md-1"><strong>Age</strong></div>
                                        </div>
                                        <div class="results-row font12">
                                            <?php for ($i = 0; $i < count($pass_info['fname']); $i++) { ?>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <?php echo $i + 1; ?>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="text" class="form-control"  value="<?php echo $pass_info['Title'][$i]; ?>" readonly/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control"  value="<?php echo $pass_info['fname'][$i]; ?>"  readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control"  value="<?php echo $pass_info['sex'][$i]; ?>" readonly/>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="text" class="form-control"  value="<?php echo $pass_info['age'][$i]; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row"><div class="col-md-1"><span>&nbsp;</span></div></div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="selectedBus-travellerDtls">
                                        <div class="searchHdr">Contact details</div>
                                        <div class="results-row font12">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Mobile</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo $pass_info['mobile']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-md-1"><span>&nbsp;</span></div></div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo $pass_info['email_id']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-md-1"><span>&nbsp;</span></div></div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <textarea class="form-control" readonly><?php echo $pass_info['address']; ?></textarea>
<!--                                                    <input type="text" class="form-control" name="address" id="email" placeholder="Enter your Address">-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="results-row font12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label><input type="checkbox" checked id="terms-conditions">
                                                        I agree to all the <a href="#">Terms and Conditions</a>
                                                    </label>
                                                </div>
                                                <div class="col-md-12">
                                                                                                        <button class="btn btn-success make-payment">CONFIRM</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="white-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">Your Booking Details</div>
                            <h4>Onward Journey</h4>
                            <ul class="bookedBusDtls font12">
                                <li><i class="fa fa-map-marker"></i> <span><?php echo $fromcity; ?> to <?php echo $tocity; ?></span></li>
                                <li><i class="fa fa-calendar-o"></i> <span><?php echo $frmdate; ?></span></li>
                                <li><i class="fa fa-bookmark"></i> <span><?php echo $travels; ?></span></li>
                                <li><i class="fa fa-truck"></i> <span><?php echo $bus_type; ?></span></li>
                                <li><i class="fa fa-folder"></i> <span>Seat no(s) : <?php echo $seat; ?></span></li>
                                <li><i class="fa fa-map-marker"></i> <span><?php echo $board; ?> - <?php echo $this->Bus_Model->getTime($boardtime); ?></span></li>
                                <li><i class="fa fa-map-marker"></i> <span>Price: <?php echo $sprice; ?></span></li>
                            </ul>
                            <?php if ($triptype == 'roundtrip') { ?>
                                <h4>Return Journey</h4>
                                <ul class="bookedBusDtls font12">
                                    <li><i class="fa fa-map-marker"></i> <span><?php echo $tocity; ?> to <?php echo $fromcity; ?></span></li>
                                    <li><i class="fa fa-calendar-o"></i> <span><?php echo $todate; ?></span></li>
                                    <li><i class="fa fa-bookmark"></i> <span><?php echo $travels2; ?></span></li>
                                    <li><i class="fa fa-truck"></i> <span><?php echo $bus_type2; ?></span></li>
                                    <li><i class="fa fa-folder"></i> <span>Seat no(s) : <?php echo $seat2; ?></span></li>
                                    <li><i class="fa fa-map-marker"></i> <span><?php echo $board2; ?> - <?php echo $this->Bus_Model->getTime($boardtime2); ?></span></li>
                                    <li><i class="fa fa-map-marker"></i> <span>Price: <?php echo $sprice2; ?></span></li>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="hotelResultsCntr"> 

                    <!-- traveller details -->
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-12">
                                <label><input type="checkbox" name="offer_code"> I have an offer code (optional)</label>
                            </div>
                        </div>
                        <div class="row offer_input" style="display:none;">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Offer code"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="button">
                                            Apply <i class="fa fa-hand-o-right"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 font12"><p>
                                    Promo codes have a limited validity period and should be added as displayed in the communication( i.e RB1234)
                                </p>
                            </div>
                        </div>
                        <div class="row marginTop15">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#credit_card" data-toggle="tab">Credit Card</a></li>
                                    <li><a href="#net_banking" data-toggle="tab">Net Banking</a></li>
                                    <li><a href="#debit_card" data-toggle="tab">Debit Card</a></li>
                                    <li><a href="#cash_card" data-toggle="tab">Cash Cards/Wallet</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="credit_card">
                                        <div class="searchHdr">
                                            <div class="row">
                                                <div class="col-xs-3">Amount payable :</div>
                                                <div class="col-xs-4" style="font-size:24px; font-weight:bold;"><?php echo $tot_amnt; ?></div>
                                                <div class="col-xs-5 text-right">Fare details here <i class="fa fa-hand-o-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="row marginTop15">
                                            <div class="col-md-3 text-right">Select card type:</div>
                                            <div class="col-md-4 form-group">
                                                <label class="visa_master_card" title="VISA / Master Card"><input type="radio" id="visa_master_card" name="credit_card_type"></label>
                                                <label class="american_express" title="American Express"><input type="radio" id="american_express" name="credit_card_type"></label>
                                            </div>
                                        </div>
                                        <div class="payment_form_visa">
                                            <div class="row">
                                                <div class="col-md-3 text-right"><label>Card no<span>*</span></label></div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Card Number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 text-right">Name on the card<span>*</span></div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Card Number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 text-right">Expiry date<span>*</span></div>
                                                <div class="col-md-2 form-group">
                                                    <select name="EXPMONTH" id="EXPMONTH" class="form-control">
                                                        <option selected="selected" value="">Month</option>
                                                        <option value="01">Jan (01)</option>
                                                        <option value="02">Feb (02)</option>
                                                        <option value="03">Mar (03)</option>
                                                        <option value="04">Apr (04)</option>
                                                        <option value="05">May (05)</option>
                                                        <option value="06">Jun (06)</option>
                                                        <option value="07">Jul (07)</option>
                                                        <option value="08">Aug (08)</option>
                                                        <option value="09">Sep (09)</option>
                                                        <option value="10">Oct (10)</option>
                                                        <option value="11">Nov (11)</option>
                                                        <option value="12">Dec (12)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="EXPYEAR" id="EXPYEAR" class="form-control">
                                                        <option selected="selected" value="">Year</option>                                
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
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 text-right">CVV<span>*</span></div>
                                                <div class="col-md-2 form-group"><input type="text" class="form-control" placeholder="XXX"></div>
                                            </div>
                                        </div>

                                        <div class="payment_form_american_express" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-3 text-right"><label>Country<span>*</span></label></div>
                                                <div class="col-md-4 form-group">
                                                    <select onchange="showAmexCountryMsg(this);" name="amxCountry" id="amxCountry" class="form-control">
                                                        <option selected="selected" id="India">India</option>
                                                        <option id="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-2 form-group">
                                                <button class="btn btn-success">CONTINUE</button>
                                            </div>
                                            <div class="col-md-2 secure-payment visa_verified"></div>
                                            <div class="col-md-2 secure-payment master_card_secure"></div>
                                            <div class="col-md-3 secure-payment verisign_secure"></div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="net_banking">
                                        <div class="searchHdr">
                                            <div class="row">
                                                <div class="col-xs-3">Amount payable :</div>
                                                <div class="col-xs-4" style="font-size:24px; font-weight:bold;"><?php echo $tot_amnt; ?></div>
                                                <div class="col-xs-5 text-right">Fare details here <i class="fa fa-hand-o-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="row marginTop15">
                                            <div class="col-md-3 text-right">Select your bank :</div>
                                            <div class="col-md-4 form-group">
                                                <select name="DDLInetPayment" id="DDLInetPayment" class="form-control"><option selected="selected" value="" style="">---- Select your bank ----</option><optgroup style="font-style:normal" label="Top banks"><option value="UTI_N">Axis Bank</option><option value="CBIBAN_N">Citibank</option><option value="HDEB_N">HDFC Bank</option><option value="ICPRF_N">ICICI Bank</option><option value="SBI_N">State Bank of India (SBI)</option></optgroup><optgroup style="padding-top:15px;font-style:normal;" label="All banks"><option value="ABN_N">ABN AMRO Bank</option><option value="ALB">Allahabad Bank</option><option value="AND_N">Andhra Bank</option><option value="UTI_N">Axis Bank</option><option value="BBK_N">Bank of Bahrain &amp; Kuwait</option><option value="BOBCO_N">Bank of Baroda (Corporate)</option><option value="BOB_N">Bank of Baroda (Retail)</option><option value="BOI_N">Bank of India</option><option value="BOM_N">Bank of Maharashtra</option><option value="BOR_N">Bank of Rajasthan</option><option value="CNB">Canara Bank</option><option value="CSB">Catholic Syrian Bank</option><option value="CBI">Central Bank of India</option><option value="CBIBAN_N">Citibank</option><option value="CITIUB_N">City Union Bank</option><option value="COP_N">Corporation Bank</option><option value="DEN">Dena Bank</option><option value="DEUNB_N">Deutsche Bank</option><option value="DCB">Development Credit Bank</option><option value="DLB">Dhanlakshmi Bank</option><option value="FDEB_N">Federal Bank</option><option value="HDEB_N">HDFC Bank</option><option value="ICPRF_N">ICICI Bank</option><option value="IDBI_N">IDBI Bank</option><option value="INB">Indian Bank</option><option value="IOB_N">Indian Overseas Bank</option><option value="NIIB_N">IndusInd Bank</option><option value="ING_N">ING Vysya Bank</option><option value="JKB_N">Jammu &amp; Kashmir Bank</option><option value="KTKB_N">Karnataka Bank</option><option value="KVB_N">Karur Vysya Net Bank</option><option value="NKMB_N">Kotak Mahindra Bank</option><option value="LVB_N">Lakshmi Vilas Bank</option><option value="LVC">Laxmi Vilas Bank (Corporate)</option><option value="OBPRF_N">Oriental Bank of Commerce</option><option value="PNBCO_N">PNB (Corporate)</option><option value="PSB">Punjab &amp; Sind Bank</option><option value="NPNB_N">Punjab National Bank</option><option value="RTN">Ratnakar Bank</option><option value="SWB">Saraswat Bank</option><option value="SVC">Shamrao Vitthal Co-operative Bank</option><option value="SIB_N">South Indian Bank</option><option value="SCB_N">Standard Chartered Bank</option><option value="SBJ">State Bank of Bikaner and Jaipur</option><option value="SBH_N">State Bank of Hyderabad</option><option value="SBI_N">State Bank of India (SBI)</option><option value="SBI_BK">State Bank of Indore</option><option value="SBM_N">State Bank of Mysore</option><option value="SBP">State Bank of Patiala</option><option value="SBT_N">State Bank of Travancore</option><option value="SYNBK_N">Syndicate Bank</option><option value="TNC">Tamil Nadu State Co-operative Bank</option><option value="TNMB_N">Tamilnad Mercantile Bank</option><option value="RBS">The Royal Bank of Scotland</option><option value="UNI_N">Union Bank of India</option><option value="UNI">United Bank of India</option><option value="VJYA_N">Vijaya Bank</option><option value="YES_N">YES Bank</option></optgroup></select>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-2 form-group">
                                                <button class="btn btn-success">CONTINUE</button>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3 secure-payment verisign_secure"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="debit_card">
                                        <div class="searchHdr">
                                            <div class="row">
                                                <div class="col-xs-3">Amount payable :</div>
                                                <div class="col-xs-4" style="font-size:24px; font-weight:bold;"><?php echo $tot_amnt; ?></div>
                                                <div class="col-xs-5 text-right">Fare details here <i class="fa fa-hand-o-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="row marginTop15">
                                            <div class="col-md-3 text-right">Select card type:</div>
                                            <div class="col-md-4 form-group">
                                                <label class="visa_master_card_debit secure-payment" title="VISA / Master Card / MAESTRO"><input type="radio" id="visa_master_maestro_card" name="debit_card_type"></label>
                                                <label class="sbi_maestro secure-payment" title="SBI Maestro"><input type="radio" id="sbi_maestro" name="debit_card_type"></label>
                                            </div>
                                        </div>
                                        <div class="payment_form_visa_maestro text-right">
                                            <div class="row">
                                                <div class="col-md-3"><label>Card no<span>*</span></label></div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Card Number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 text-right">Name on the card<span>*</span></div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Card Number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 text-right">Expiry date<span>*</span></div>
                                                <div class="col-md-2 form-group">
                                                    <select name="EXPMONTH" id="EXPMONTH" class="form-control">
                                                        <option selected="selected" value="">Month</option>
                                                        <option value="01">Jan (01)</option>
                                                        <option value="02">Feb (02)</option>
                                                        <option value="03">Mar (03)</option>
                                                        <option value="04">Apr (04)</option>
                                                        <option value="05">May (05)</option>
                                                        <option value="06">Jun (06)</option>
                                                        <option value="07">Jul (07)</option>
                                                        <option value="08">Aug (08)</option>
                                                        <option value="09">Sep (09)</option>
                                                        <option value="10">Oct (10)</option>
                                                        <option value="11">Nov (11)</option>
                                                        <option value="12">Dec (12)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="EXPYEAR" id="EXPYEAR" class="form-control">
                                                        <option selected="selected" value="">Year</option>                                
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
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 text-right">CVV<span>*</span></div>
                                                <div class="col-md-2 form-group"><input type="text" class="form-control" placeholder="XXX"></div>
                                            </div>
                                        </div>

                                        <div class="payment_form_sbi_maestro" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-3 text-right"><label>Card no<span>*</span></label></div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Card Number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 text-right">Name on the card<span>*</span></div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Card Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-2 form-group">
                                                <button class="btn btn-success">CONTINUE</button>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3 secure-payment verisign_secure"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="cash_card">
                                        <div class="searchHdr">
                                            <div class="row">
                                                <div class="col-xs-3">Amount payable :</div>
                                                <div class="col-xs-4" style="font-size:24px; font-weight:bold;"><?php echo $tot_amnt; ?></div>
                                                <div class="col-xs-5 text-right">Fare details here <i class="fa fa-hand-o-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="row marginTop15">
                                            <div class="col-md-3 text-right">Cash cards :</div>
                                            <div class="col-md-4 form-group">
                                                <select id="CASHCARDTYPE"  name="CASHCARDTYPE" class="form-control">
                                                    <option selected="selected" value="">-- Select --</option>
                                                    <option value="AMON">Airtel Money</option>
                                                    <option value="ItzCh">Itz Cash</option>
                                                    <option value="OxiCash">Oxigen Wallet</option>
                                                    <option value="Payuw">PayU Money</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-2 form-group">
                                                <button class="btn btn-success">CONTINUE</button>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3 secure-payment verisign_secure"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="white-container payment_details">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">Payment details</div>              
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">Onward Fare</div>
                        <div class="col-xs-4 text-right">Rs. <?php echo $sprice; ?></div>
                    </div>
                    <?php if ($triptype == 'roundtrip') { ?>
                        <div class="row font12">
                            <div class="col-xs-8">Return Fare</div>
                            <div class="col-xs-4 text-right">+ Rs.<?php echo $sprice2; ?></div>
                        </div>
                    <?php } ?>
                    <div class="row total_payment">
                        <div class="col-xs-8">Total</div>
                        <div class="col-xs-4 text-right">Rs. <?php echo $tot_amnt; ?></div>
                    </div>
                </div>
                <div class="white-container">
<!--                    <p class="font12">Transactions on this site are safe and secure as indicated by the secure lock / green colour in your browser address bar. Over 1 crore seats have been sold on redBus till date.</p>-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>