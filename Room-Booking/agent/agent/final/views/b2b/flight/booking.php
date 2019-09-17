
<?php echo $this->load->view('home/header'); ?>
<div class="hotelCntr">
    <div class="container"> 

        <!-- flight trip details section-->
        <div class="row">
           
            <div class="col-md-9">
                <div class="hotelResultsCntr"> 
                     <form action="<?php echo WEB_URL; ?>flight/confirm_booking" name="passengerForm" method="post" onsubmit="return formValidate();">
                    <!-- this row will repeat based on hotels availability -->
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="searchHdr">1 Review your trip details</div>
                                <div class="fligh-results-row bookingFlight" id="bookingFlight">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--                                            <h4>Newark to New Delhi ( 1 Stop)</h4>-->
                                        </div>
                                    </div>
                                    <div class="row header">
                                        <div class="col-md-2">Airlines</div>
                                        <div class="col-md-3">Depart</div>
                                        <div class="col-md-3">Arrive</div>
                                        <div class="col-md-2">Duration</div>
                                        <div class="col-md-2">Others</div>
                                    </div>
                                    <?php
                                    if ($flight_result != '') {

                                        $Departure_Code = explode(',', $flight_result->Departure_LocationCode);
                                        $Arrival_Code = explode(',', $flight_result->Arrival_LocationCode);

                                        $MarketingAirline_Code = explode(',', $flight_result->MarketingAirline_Code);
                                        $MarketingAirline_Name = explode(',', $flight_result->MarketingAirline_Name);
                                        $FlightNumber = explode(',', $flight_result->FlightNumber);

                                        $Departure_CityName = explode(',', $flight_result->Departure_CityName);
                                        $Arrival_CityName = explode(',', $flight_result->Arrival_CityName);

                                        $DepartureDateTime = explode(',', $flight_result->DepartureDateTime);
                                        $ArrivalDateTime = explode(',', $flight_result->ArrivalDateTime);


                                        if ($flight_result->Departure_Terminal != '')
                                            $Departure_Terminal = explode(',', $flight_result->Departure_Terminal);
                                        else
                                            $Departure_Terminal[] = '';

                                        if ($flight_result->Arrival_Terminal != '')
                                            $Arrival_Terminal = explode(',', $flight_result->Arrival_Terminal);
                                        else
                                            $Arrival_Terminal[] = '';

                                        $FareType = explode(',', $flight_result->FareType);

                                        $Origin = $flight_result->Origin;
                                        $Destination = $flight_result->Destination;

                                        $Adults = $flight_result->Adults;
                                        $Childs = $flight_result->Childs;
                                        $Infants = $flight_result->Infants;

                                        for ($i = 0; $i < count($Departure_Code); $i++) {

                                            $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[$i]);
                                            list($DDate, $DTime) = explode(" ", $Ddatetime);

                                            $Adatetime = preg_replace("/[T]/", " ", $ArrivalDateTime[$i]);
                                            list($ADate, $ATime) = explode(" ", $Adatetime);
                                            ?>
                                            <div class="results-row font12">
                                                <div class="row">
                                                    <div class="col-md-2 air-logo"> <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$i]; ?>.png" alt="<?php echo $MarketingAirline_Name[$i]; ?>"> <span class="font12"> <?php echo $MarketingAirline_Name[$i]; ?><br/>
                                                            <?php echo $MarketingAirline_Code[$i]; ?>-<?php echo $FlightNumber[$i]; ?></span> </div>
                                                    <div class="col-md-3 air-dep-time"> 
                                                        <span><?php echo $Departure_CityName[$i]; ?> </span>  
                                                        <span><?php echo date('D, j M', strtotime($DDate)); ?> | <strong><?php echo date('H:i', strtotime($DTime)); ?></strong></span>
                                                        <span><?php echo $Departure_CityName[$i]; ?> &nbsp; <?php if ($Departure_Terminal != '') echo 'T-' . $Departure_Terminal[$i]; ?></span>
                                                    </div>
                                                    <div class="col-md-3 air-arv-time"> 
                                                        <span><?php echo $Arrival_CityName[$i]; ?></span> 
                                                        <span><?php echo date('D, j M', strtotime($ADate)); ?> | <strong><?php echo date('H:i', strtotime($ATime)); ?></strong></span> 
                                                        <span><?php echo $Arrival_CityName[$i]; ?> &nbsp; <?php if ($Arrival_Terminal != '') echo 'T-' . $Arrival_Terminal[$i]; ?></span> 
                                                    </div>
                                                    <div class="col-md-2 air-dur"><?php echo $this->Flight_Model->journeyDuration($Adatetime, $Ddatetime); ?>, Non Stop</div>
                                                    <div class="col-md-2">
                                                        <span> <?php echo $FareType[$i]; ?></span>
                                                        <span>Baggage: 15 kgs per person</span>
                                                    </div>
                                                </div>
                                            </div>
                                     <?php if ($Arrival_Code[$i] != $Destination) { ?> 
                                      <?php
                                            $ArrDateTime = preg_replace("/[T]/", " ", $ArrivalDateTime[$i]);

                                            $DepDateTime = preg_replace("/[T]/", " ", $DepartureDateTime[$i + 1]);
                                            ?>
                                      <div class="layover ">Change flight at <?php echo $Arrival_CityName[$i]; ?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime, $DepDateTime); ?></div>
                                      <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <!--                                    <div class="row slcdFltlayover font12">
                                                                            <div class="col-md-6"> Transit time: 5h 20m </div>
                                                                            <div class="col-md-6"> Note: Your itinerary has a stopover in Amsterdam. 
                                                                                Please check transit visa requirements if any. </div>
                                                                        </div>-->

                                </div>

                                <?php
                                if ($flight_result_return != '') {

                                    $Departure_Code_r = explode(',', $flight_result_return->Departure_LocationCode);
                                    $Arrival_Code_r = explode(',', $flight_result_return->Arrival_LocationCode);

                                    $MarketingAirline_Code_r = explode(',', $flight_result_return->MarketingAirline_Code);
                                    $MarketingAirline_Name_r = explode(',', $flight_result_return->MarketingAirline_Name);
                                    $FlightNumber_r = explode(',', $flight_result_return->FlightNumber);

                                    $Departure_CityName_r = explode(',', $flight_result_return->Departure_CityName);
                                    $Arrival_CityName_r = explode(',', $flight_result_return->Arrival_CityName);

                                    $DepartureDateTime_r = explode(',', $flight_result_return->DepartureDateTime);
                                    $ArrivalDateTime_r = explode(',', $flight_result_return->ArrivalDateTime);


                                    if ($flight_result_return->Departure_Terminal != '')
                                        $Departure_Terminal_r = explode(',', $flight_result_return->Departure_Terminal);
                                    else
                                        $Departure_Terminal_r[] = '';

                                    if ($flight_result->Arrival_Terminal != '')
                                        $Arrival_Terminal_r = explode(',', $flight_result_return->Arrival_Terminal);
                                    else
                                        $Arrival_Terminal_r[] = '';

                                    $FareType_r = explode(',', $flight_result_return->FareType);

                                    $Origin_r = $flight_result_return->Origin;
                                    $Destination_r = $flight_result_return->Destination;

                                    $Adults_r = $flight_result_return->Adults;
                                    $Childs_r = $flight_result_return->Childs;
                                    $Infants_r = $flight_result_return->Infants;

                                    for ($i = 0; $i < count($Departure_Code_r); $i++) {

                                        $Ddatetime_r = preg_replace("/[T]/", " ", $DepartureDateTime_r[$i]);
                                        list($DDate_r, $DTime_r) = explode(" ", $Ddatetime_r);

                                        $Adatetime_r = preg_replace("/[T]/", " ", $ArrivalDateTime_r[$i]);
                                        list($ADate_r, $ATime_r) = explode(" ", $Adatetime_r);
                                        ?>
                                        <div class="fligh-results-row bookingFlight" id="bookingFlight">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!--                                            <h4>Newark to New Delhi ( 1 Stop)</h4>-->
                                                </div>
                                            </div>
                                            <div class="row header">
                                                <div class="col-md-2">Airlines</div>
                                                <div class="col-md-3">Depart</div>
                                                <div class="col-md-3">Arrive</div>
                                                <div class="col-md-2">Duration</div>
                                                <div class="col-md-2">Others</div>
                                            </div>
                                            <div class="results-row font12">
                                                <div class="row">
                                                    <div class="col-md-2 air-logo"> <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code_r[$i]; ?>.png" alt="<?php echo $MarketingAirline_Name_r[$i]; ?>"> <span class="font12"><?php echo $MarketingAirline_Name_r[$i]; ?><br/>
                                                            <?php echo $MarketingAirline_Code_r[$i]; ?>-<?php echo $FlightNumber_r[$i]; ?></span> </div>
                                                    <div class="col-md-3 air-dep-time"> 
                                                        <span><?php echo $Departure_CityName_r[$i]; ?></span> 
                                                        <span><?php echo date('D, j M', strtotime($DDate_r)); ?> | <strong><?php echo date('H:i', strtotime($DTime_r)); ?></span> 
                                                        <span><?php echo $Departure_CityName_r[$i]; ?>&nbsp;<?php if ($Departure_Terminal_r != '') echo 'T-' . $Departure_Terminal_r[$i]; ?></span> </div>
                                                    <div class="col-md-3 air-arv-time"> 
                                                        <span><?php echo $Arrival_CityName_r[$i]; ?></span> 
                                                        <span><?php echo date('D, j M', strtotime($ADate_r)); ?> | <strong><?php echo date('H:i', strtotime($ATime_r)); ?></strong></span> 
                                                        <span><?php if ($Arrival_Terminal_r != '') echo 'T-' . $Arrival_Terminal_r[$i]; ?></span> </div>
                                                    <div class="col-md-2 air-dur"><?php echo $this->Flight_Model->journeyDuration($Adatetime_r, $Ddatetime_r); ?>, Non Stop</div>
                                                    <div class="col-md-2"><span><?php echo $FareType_r[$i]; ?></span><span>Baggage: 15 kgs per person</span></div>
                                                </div>
                                            </div>                                        
                                    </div>
                                  <?php if ($Arrival_Code_r[$i] != $Origin) { ?> 
                                  <div class="layover ">Change flight at <?php echo $Arrival_CityName_r[$i]; ?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime_r, $DepDateTime_r); ?></div>
                                   <?php } ?>
                                
                                <?php } ?>
                                <?php } ?> 
                                <!--                                    <div class="row slcdFltlayover font12">
                                                                        <div class="col-md-6"> Transit time: 5h 20m </div>
                                                                        <div class="col-md-6"> Note: Your itinerary has a stopover in Amsterdam. 
                                                                            Please check transit visa requirements if any. </div>
                                                                    </div>-->


                            </div>
                        </div>
                    </div>

                    <!-- traveller details -->
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="searchHdr">2. Traveller details</div>
                                <div class="step_cont">
<!--                                    <input type="hidden" id="travellerListFull" name="travellerList" value="{}">-->

                                    <input type="hidden" name="onwardFlightId" value="<?php echo $flight_result->flight_t_id; ?>" />
                                    <?php if ($flight_result_return != '') { ?>
                                        <input type="hidden" name="returnFlightId" value="<?php echo $flight_result_return->flight_t_id; ?>" />
                                    <?php } ?>
                                    <input type="hidden" name="email_id" id="travMail" />
                                    <input type="hidden" name="mobile_no" id="travMobile" />

                                    <?php for ($k = 0; $k < $Adults; $k++) { ?>
                                        <div><b>Adult <?php echo $k + 1; ?></b></div>
                                        <div class="bkrow">
                                            <label class="bk_frmeletd">
                                                <select class="bk_select tErr form-control" name="atitle[]" id="atitle" required>
                                                    <option value="">Select</option>
                                                    <option value="Mr">Mr.</option>
                                                    <option value="Mrs">Mrs.</option>
                                                    <option value="Ms">Ms.</option>
                                                </select>
                                            </label>
                                            <label class="bk_frmeletd">
                                                <input type="text" name="afname[]"  title="Enter Passenger First Name" id="afname" placeholder="First Name" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                            </label>
                                            <label class="bk_frmeletd">
                                                <input type="text" name="amname[]" title="Enter Passenger Middle Name" id="amname" placeholder="Middle Name" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                            </label>
                                            <label class="bk_frmeletd">
                                                <input type="text" name="alname[]" placeholder="Last Name" title="Enter Passenger Last Name" id="alname" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                            </label>
                                        </div>

                                    <?php } ?>

                                    <?php if ($Childs != '' && $Childs != 0) { ?>
                                        <?php for ($k = 0; $k < $Childs; $k++) { ?>

                                            <div><b>Child <?php echo $k + 1; ?></b></div>
                                            <div class="bkrow">
                                                <label class="bk_frmeletd">
                                                    <select class="bk_select tErr form-control" name="ctitle[]" id="ctitle"  required>
                                                        <option value="">Select</option>
                                                        <option value="Master">Master</option>
                                                        <option value="Miss">Miss</option>
                                                    </select>
                                                </label>
                                                <label class="bk_frmeletd">
                                                    <input type="text" name="cfname[]"  title="Enter Passenger First Name" id="cfname" placeholder="First Name" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                                </label>
                                                <label class="bk_frmeletd">
                                                    <input type="text" name="cmname[]" title="Enter Passenger Middle Name" id="cmname" placeholder="Middle Name" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                                </label>
                                                <label class="bk_frmeletd">
                                                    <input type="text" name="clname[]" placeholder="Last Name" title="Enter Passenger Last Name" id="clname" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                                </label>
                                                <label class="bk_frmeletd">

                                                    <select name="cdobDate[]" id="cdobDate" class="form-control" required>
                                                        <option value="">Date</option>

                                                        <option value="01">1</option>

                                                        <option value="02">2</option>

                                                        <option value="03">3</option>

                                                        <option value="04">4</option>

                                                        <option value="05">5</option>

                                                        <option value="06">6</option>

                                                        <option value="07">7</option>

                                                        <option value="08">8</option>

                                                        <option value="09">9</option>

                                                        <option value="10">10</option>

                                                        <option value="11">11</option>

                                                        <option value="12">12</option>

                                                        <option value="13">13</option>

                                                        <option value="14">14</option>

                                                        <option value="15">15</option>

                                                        <option value="16">16</option>

                                                        <option value="17">17</option>

                                                        <option value="18">18</option>

                                                        <option value="19">19</option>

                                                        <option value="20">20</option>

                                                        <option value="21">21</option>

                                                        <option value="22">22</option>

                                                        <option value="23">23</option>

                                                        <option value="24">24</option>

                                                        <option value="25">25</option>

                                                        <option value="26">26</option>

                                                        <option value="27">27</option>

                                                        <option value="28">28</option>

                                                        <option value="29">29</option>

                                                        <option value="30">30</option>

                                                        <option value="31">31</option>

                                                    </select>


                                                </label>
                                                <label class="bk_frmeletd">

                                                    <select name="cdobMonth[]" id="cdobMonth" class="form-control" required>
                                                        <option value="">Month</option>

                                                        <option value="01">Jan</option>

                                                        <option value="02">Feb</option>

                                                        <option value="03">Mar</option>

                                                        <option value="04">Apr</option>

                                                        <option value="05">May</option>

                                                        <option value="06">Jun</option>

                                                        <option value="07">Jul</option>

                                                        <option value="08">Aug</option>

                                                        <option value="09">Sep</option>

                                                        <option value="10">Oct</option>

                                                        <option value="11">Nov</option>

                                                        <option value="12">Dec</option>

                                                    </select>

                                                </label>
                                                <label class="bk_frmeletd">
                                                    <?php
                                                    $eyear = date('Y');
                                                    $endyear = $eyear - 2;
                                                    $startyear = $eyear - 12;
                                                    ?>

                                                    <select name="cdobYear[]" id="cdobYear" class="form-control" required>
                                                        <option value="">Year</option>
                                                        <?php for ($a = $startyear; $a <= $endyear; $a++) { ?>
                                                            <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </label>
                                            </div>

                                        <?php } ?>

                                    <?php } ?> 

                                    <?php if ($Infants != '' && $Infants != 0) { ?>
                                        <?php for ($k = 0; $k < $Infants; $k++) { ?>

                                            <div><b>Infants <?php echo $k + 1; ?></b></div>
                                            <div class="bkrow">
                                                <label class="bk_frmeletd">
                                                    <select class="bk_select tErr form-control" name="ititle[]" id="ititle"   required>
                                                        <option value="">Select</option>
                                                        <option value="Master">Master</option>
                                                        <option value="Miss">Miss</option>
                                                    </select>
                                                </label>
                                                <label class="bk_frmeletd">
                                                    <input type="text" name="ifname[]"  title="Enter Passenger First Name" id="ifname" placeholder="First Name" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                                </label>
                                                <label class="bk_frmeletd">
                                                    <input type="text" name="imname[]" title="Enter Passenger Middle Name" id="imname" placeholder="Middle Name" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                                </label>
                                                <label class="bk_frmeletd">
                                                    <input type="text" name="ilname[]" placeholder="Last Name" title="Enter Passenger Last Name" id="ilname" maxlength="30" size="30" class="bookiptd placeholder form-control" required>
                                                </label>
                                                <label class="bk_frmeletd">

                                                    <select name="idobDate[]" id="idobDate" class="paxDate select-box" required>
                                                        <option value="">Date</option>

                                                        <option value="01">1</option>

                                                        <option value="02">2</option>

                                                        <option value="03">3</option>

                                                        <option value="04">4</option>

                                                        <option value="05">5</option>

                                                        <option value="06">6</option>

                                                        <option value="07">7</option>

                                                        <option value="08">8</option>

                                                        <option value="09">9</option>

                                                        <option value="10">10</option>

                                                        <option value="11">11</option>

                                                        <option value="12">12</option>

                                                        <option value="13">13</option>

                                                        <option value="14">14</option>

                                                        <option value="15">15</option>

                                                        <option value="16">16</option>

                                                        <option value="17">17</option>

                                                        <option value="18">18</option>

                                                        <option value="19">19</option>

                                                        <option value="20">20</option>

                                                        <option value="21">21</option>

                                                        <option value="22">22</option>

                                                        <option value="23">23</option>

                                                        <option value="24">24</option>

                                                        <option value="25">25</option>

                                                        <option value="26">26</option>

                                                        <option value="27">27</option>

                                                        <option value="28">28</option>

                                                        <option value="29">29</option>

                                                        <option value="30">30</option>

                                                        <option value="31">31</option>

                                                    </select>


                                                </label>
                                                <label class="bk_frmeletd">

                                                    <select name="idobMonth[]" id="idobMonth" class="paxMonth select-box" required>
                                                        <option value="">Month</option>

                                                        <option value="01">Jan</option>

                                                        <option value="02">Feb</option>

                                                        <option value="03">Mar</option>

                                                        <option value="04">Apr</option>

                                                        <option value="05">May</option>

                                                        <option value="06">Jun</option>

                                                        <option value="07">Jul</option>

                                                        <option value="08">Aug</option>

                                                        <option value="09">Sep</option>

                                                        <option value="10">Oct</option>

                                                        <option value="11">Nov</option>

                                                        <option value="12">Dec</option>

                                                    </select>												

                                                </label>
                                                <label class="bk_frmeletd">
                                                    <?php
                                                    $endyear = date('Y');
                                                    $startyear = $endyear - 2;
                                                    ?>

                                                    <select name="idobYear[]" id="idobYear" class="paxYear select-box" required>
                                                        <option value="">Year</option>
                                                        <?php for ($a = $startyear; $a <= $endyear; $a++) { ?>
                                                            <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </label>
                                            </div>

                                        <?php } ?>

                                    <?php } ?>   



                                    <div class="traDet Note" style="clear:both;"> <b>Please Note :</b> <span style="color:#e24b06">Please make sure that the name entered is exactly as per traveller's passport.</span> </div>
                                    <!--                                    <h4> More Information </h4>
                                                                        <div class="" id="gi_intinfo">
                                                                            <div class="db"><b>Adult 1</b></div>
                                                                            <div class="bkrow row">
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <input type="text" id="adultpassport1" name="adultpassport1" class="form-control bookiptd placeholder" placeholder="Passport No.">
                                                                                </label>
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <select id="adultvisatype1" name="adultvisatype1" class="slecttd form-control">
                                                                                        <option>VISA type</option>
                                                                                        <option value="educational">Educational</option>
                                                                                        <option value="other">Other</option>
                                                                                    </select>
                                                                                </label>
                                                                            </div>
                                                                            <div class="bkrow row">
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <input type="text" name="adultdateofissue1" autocomplete= "off" class="dpo bookiptd placeholder form-control" placeholder="Passport Issue Date">
                                                                                </label>
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <input type="text" name="adultdateofexpiry1" autocomplete= "off" class="dp bookiptd placeholder form-control" placeholder="Passport Expiry Date">
                                                                                </label>
                                                                            </div>
                                                                            <div class="bkrow row">
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <input type="text" id="adultnational1" name="adultnational1" class="bookiptd placeholder form-control" placeholder="Nationality">
                                                                                </label>
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <input type="text" id="adultplaceofissue1" name="adultplaceofissue1" class="bookiptd placeholder form-control" placeholder="Place of Issue">
                                                                                </label>
                                                                            </div>
                                                                            <div class="bkrow row">
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <input type="text" id="adultfrequentno1" name="adultfrequentno1" class="bookiptd placeholder form-control" placeholder="Frequent Flier No">
                                                                                </label>
                                                                                <label class="bk_frmeletd col-md-4">
                                                                                    <select class="slecttd form-control" id="adultfrequentairline1" name="adultfrequentairline1">
                                                                                        <option>Airline</option>
                                                                                        <option value="DL">Delta Air Lines</option>
                                                                                    </select>
                                                                                </label>
                                                                            </div>
                                                                        </div>-->
                                    <!--                                    <div class="bkrow"> 
                                                                            <label class="bkempty">		
                                                                                &nbsp;
                                                                        </label>
                                                                            <div><b>Travel documents</b> : Please make sure that your travel documents like passport, visa etc are in order.</div>
                                                                            <div onmouseover="$(&quot;#importantDetails&quot;).show()"><b>Important !</b> : For passengers travelling to US and US based airlines/ Saudi Arabia  or on one way ticket to any destination.</div>
                                                                            <div class="dn" id="importantDetails" onmouseover="$(&quot;#importantDetails&quot;).show()" onmouseout="$(&quot;#importantDetails&quot;).hide()" style="display: none;">
                                                                                <p class="font12"> As per regulations, passengers travelling to the US or on US-based airlines (American Airlines / Continental Airlines / Delta Airlines / United Airlines or US Airways) will have to provide additional details like passport number, issuing country, expiry date, nationality, date of birth and gender to complete their booking. We need these details on the same day as that of booking, to guarantee the fare and issue your tickets.
                                                                                    In case you are unable to provide these details now, please go ahead with the booking and our customer care representative will call you on the same day of your booking to collect the necessary information. Please keep your passport readily available.
                                                                                    Tickmango shall not be held responsible for dispute pertaining to visa with respect to transiting destinations , baggage , immigration etc </p>
                                                                            </div>
                                                                        </div>-->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row marginTop10">
                                    <div class="col-md-6">
                                        <div class="row form-group marginTop10">
                                            <div class="col-md-12">
                                                <label for="inputCity">Enter your e-mail address:</label>
                                                <input type="text" tabindex="143" maxlength="75" placeholder="Your booking details will be sent here" title="Enter your email id" id="userEmailId" name="userEmailId" class="bookip bk_emailip form-control" onblur="return email_validate(this.id);">

                                                <span class="font12">Your booking details will be mailed to this address</span></div>
                                            <div class="col-md-12">
                                                <label for="inputCity">Phone:</label>
                                                <input type="text" tabindex="143" maxlength="10" placeholder="Enter Mobile Number" title="Enter Mobile Number" id="userMobilNo" name="userMobilNo" class="bookip bk_emailip form-control" onblur="return mobile_validate(this.id);">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 marginTop10 font12">
                                        <input type="checkbox" id="terms-cons" name="terms-cons" value="" class="marginRight10">
                                        Secure your trip with Reliance Travel Insurance 
                                        <p>
                                            I agree to terms and conditions of the insurance company and furthermore highlight that I am not suffering from any pre-existing disease <span class="travelinsureance-terms">( Travel insurance is highly recommended )</span> 
                                            Why?
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button id="make-payment" class="btn btn-success make-payment">MAKE PAYMENT</button>
                                <p class="marginTop10">
                                    By Clicking "Make Payment", I agree to <a href="#">International Booking Terms</a> and the <a href="#">Terms and Conditions</a>	 of Tickmango.
                                    <span class="font12">Note : Partial cancellation is not allowed on discounted return fare tickets.

                                </p>
                            </div>
                        </div>
                    </div>
                      </form>
                </div>
            </div>
      
            <div class="col-md-3">
                <div class="white-container htl-dtls-amen">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">Fare Details</div>
                            <?php
                            $PassengerBaseFare = explode(',', $flight_result->PassengerBaseFare);
                            $PassengerTax_Amount = explode(',', $flight_result->PassengerTax_Amount);
                            $PassengerServiceTax = explode(',', $flight_result->PassengerServiceTax);
                            $Tax_Amount = explode(',', $flight_result->Tax_Amount);

                            if ($flight_result_return != '') {
                                $PassengerBaseFare_r = explode(',', $flight_result_return->PassengerBaseFare);
                                $PassengerTax_Amount_r = explode(',', $flight_result_return->PassengerTax_Amount);
                                $PassengerServiceTax_r = explode(',', $flight_result_return->PassengerServiceTax);
                                $Tax_Amount_r = explode(',', $flight_result_return->Tax_Amount);
                            }
                            ?>
                            <div id="gi_fare_summary" class="font12">
                                <div class="bk_frbrp">
                                    <!--                                    <ul class="fare_row">
                                                                            <li> <strong> DEL </strong> to <strong> EWR </strong> ⇔ <strong> EWR </strong> to <strong> DEL </strong> </li>
                                                                        </ul>-->
                                    <div class="fare_row">
                                        <div class="fare_subhead">Air Fare</div>

                                        <div><b>Fees </b></div>
                                        <dl class="summary">
                                            <dt>Adult x <?php echo $Adults; ?> </dt>
                                            <dd>Rs. <?php
                            if ($flight_result_return != '')
                                echo $PassengerBaseFare[0] * $Adults + $PassengerBaseFare_r[0] * $Adults;
                            else
                                echo $PassengerBaseFare[0] * $Adults;
                            ?></dd>
                                            <?php if ($Childs != '' && $Childs != 0) { ?> 
                                                <dt>Child x <?php echo $Childs; ?></dt>
                                                <dd>Rs. <?php
                                            if ($flight_result_return != '')
                                                echo $PassengerBaseFare[1] * $Childs + $PassengerBaseFare_r[1] * $Childs;
                                            else
                                                echo $PassengerBaseFare[1] * $Childs;
                                                ?></dd>
                                            <?php } ?>
                                            <?php if ($Infants != '' && $Infants != 0) { ?>
                                                <dt>Infant x <?php echo $Infants; ?></dt>
                                                <dd>Rs.  <?php
                                            if ($flight_result_return != '')
                                                echo $PassengerBaseFare[2] * $Infants + $PassengerBaseFare_r[1] * $Infants;
                                            else
                                                echo $PassengerBaseFare[2] * $Infants;
                                                ?> </dd>
                                            <?php } ?>
                                        </dl>
                                    </div>
                                    <div class="fare_row">
                                        <div class="fare_subhead">Discount</div>
                                        <dl class="summary">
                                            <dt>Fee & Surcharges </dt>
                                            <dd> Rs.  <?php
                                            if ($flight_result_return != '')
                                                echo array_sum($Tax_Amount) + $flight_result->Admin_Markup + $flight_result->Payment_Charge + array_sum($Tax_Amount_r) + $flight_result_return->Admin_Markup + $flight_result_return->Payment_Charge;
                                            else
                                                echo array_sum($Tax_Amount) + $flight_result->Admin_Markup + $flight_result->Payment_Charge;
                                            ?></dd>
                                            <dt>Promo Discount</dt>
                                            <dd>Rs. 0</dd>
                                        </dl>
                                    </div>
                                    <div class="fare_row">
                                        <dl class="summary">
                                            <dt class="fare_subhead"><b>You pay</b></dt>
                                            <dd class="fare_toatl"> <b><?php
                                                if ($flight_result_return != '')
                                                    echo $flight_result->TotalFare + $flight_result->Admin_Markup + $flight_result->Payment_Charge + $flight_result_return->TotalFare + $flight_result_return->Admin_Markup + $flight_result_return->Payment_Charge;
                                                else
                                                    echo $flight_result->TotalFare + $flight_result->Admin_Markup + $flight_result->Payment_Charge;
                                            ?></b></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>


<script type="text/javascript">
    $(document).ready(function() {
	
        <!--=====  Scrolling   =====--->
        $(window).scroll(function(e) {
            var scroller_anchor = $(".scroller_anchor").offset().top;
            if ($(this).scrollTop() >= scroller_anchor && $('.scrollFixTop').css('position') != 'fixed') 
            {    
                $('.scrollFixTop').css({
                    //'background': '#CCC',
                    'position': 'fixed',
                    'top': '0px'
                });
                //$('.scroller_anchor').css('height', '50px');
            } 
            else if ($(this).scrollTop() < scroller_anchor && $('.scrollFixTop').css('position') != 'relative') 
            {    
                //$('.scroller_anchor').css('height', '0px');
                $('.scrollFixTop').css({
                    'position': 'relative'
                });
            }
        });

        $(function() {
            $types = $('.syncTypes');
            $contacts = $('#contacts');
            $groups = $('#groups');
            $types.change(function() {
                $this = $(this).val();
                if ($this == "guest") {
                    $groups.slideUp(200);
                    $contacts.delay(200).slideDown(200);
                }
                else if ($this == "member") {
                    $contacts.slideUp(200);
                    $groups.delay(200).slideDown(200);
                }
            });
        });


        //$('.reference').hide();
        $('.plus-minus-accordion').click(function() {
            $(this).next('.booking-details').slideToggle(300);
            return false;
        });
	
	
        <!------	Show Hide----->

        $(".hide-show-button").click(function () {
            var txt = $("#hide-show-changed").html();
            txt == 'Show Details' ? 'Hide Details' : 'Show Details';
            $(".hide-show").slideToggle("1000");
            $("#hide-show-changed").html(txt);
            return false;
        });
        $('.hide-show-button').on('click', function () {
            var method;
            $('span', this).text(function (_, text) {
                method = text.toLowerCase();
                return text === 'Show Details' ? 'Hide Details' : 'Show Details';
            }).parent().next()[method]();
        });
 
    });
</script>

<script type="text/javascript">
	
    var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/; 
	
    function email_validate(id)
    {  						
        var email=document.getElementById(id).value;
        if(email==''){
            $("#"+id).val("");
            $("#"+id).css("border-color", "red");
            document.getElementById(id).focus(); 
            $("#"+id).attr("placeholder", "Mandatory Field ");                         
            return false;
        }
        else if(!pattern.test(email)){
            $("#"+id).val("");
            $("#"+id).css("border-color", "red");
            document.getElementById(id).focus(); 
            $("#"+id).attr("placeholder", "Invalid E-Mail Address");
            return false;
        }
        return true;
    }
	
    function mobile_validate(id)
    {	   
        var mobvalue=document.getElementById(id).value;
        var mobcount=mobvalue.length;
        if(mobvalue=='')
        {						
            $("#"+id).val("");
            $("#"+id).css("border-color", "red");
            $("#"+id).attr("placeholder", "Mandatory field ");
            return false;
        }
        else if(isNaN(mobvalue))
        {
            $("#"+id).val("");
            $("#"+id).css("border-color", "red");
            $("#"+id).attr("placeholder", "10 digits Number  ");
            return false;
        }
        else if(mobcount!=10)
        {	 					   
            $("#"+id).val("");
            $("#"+id).css("border-color", "red");
            $("#"+id).attr("placeholder", "10 digits Number ");
            return false;
        }  
        return true;
		
    }
	
    function user_login()
    {
        var email = document.getElementById("userName").value; 
        var pwd = document.getElementById("password").value;		
		
        $.post('<?php echo WEB_URL; ?>user/user_login_validate',{'userName':email,'password':pwd},function(data){			
			
            var a=data.split(',');
			
            if(a[0]=='success')
            {
                document.getElementById("travMail").value = a[1];
                document.getElementById("travMobile").value = a[5];
            }
            else
            {
                $("#userName").val("");
                $("#userName").css("border-color", "red");
                $("#userName").attr("placeholder", "Invalid Email-ID");
                $("#password").val("");
                $("#password").css("border-color", "red");
                $("#password").attr("placeholder", "Invalid Password");
            }	
			
        });
		
    }
	
    function formValidate()
    {
			
        if (document.getElementById('guest').checked) {
            user_type = document.getElementById('guest').value;
        }
		
        if (document.getElementById('member').checked) {
            user_type = document.getElementById('member').value;
        }
		
        if(user_type == 'guest')
        {			
            var email=document.getElementById('userEmailId').value;
            if(email==''){
                $("#userEmailId").val("");
                $("#userEmailId").css("border-color", "red");
                document.getElementById('userEmailId').focus(); 
                $("#userEmailId").attr("placeholder", "Mandatory Field ");                         
                return false;
            }
            else if(!pattern.test(email)){
                $("#userEmailId").val("");
                $("#userEmailId").css("border-color", "red");
                document.getElementById('userEmailId').focus(); 
                $("#userEmailId").attr("placeholder", "Invalid E-Mail Address");
                return false;
            }			
			
            var mobvalue=document.getElementById('userMobilNo').value;
            var mobcount=mobvalue.length;
            if(mobvalue=='')
            {						
                $("#userMobilNo").val("");
                $("#userMobilNo").css("border-color", "red");
                $("#userMobilNo").attr("placeholder", "Mandatory field ");
                return false;
            }
            else if(isNaN(mobvalue))
            {
                $("#userMobilNo").val("");
                $("#userMobilNo").css("border-color", "red");
                $("#userMobilNo").attr("placeholder", "10 digits Number  ");
                return false;
            }
            else if(mobcount!=10)
            {	 					   
                $("#userMobilNo").val("");
                $("#userMobilNo").css("border-color", "red");
                $("#userMobilNo").attr("placeholder", "10 digits Number ");
                return false;
            }  
			
        }
		
        if(user_type == 'member')
        {			
            var email=document.getElementById('userName').value;
            if(email==''){
                $("#userName").val("");
                $("#userName").css("border-color", "red");
                document.getElementById('userName').focus(); 
                $("#userName").attr("placeholder", "Mandatory Field ");                         
                return false;
            }
            else if(!pattern.test(email)){
                $("#userName").val("");
                $("#userName").css("border-color", "red");
                document.getElementById('userName').focus(); 
                $("#userName").attr("placeholder", "Invalid E-Mail Address");
                return false;
            }			
			
            var password=document.getElementById('password').value;			
            if(password=='')
            {						
                $("#password").val("");
                $("#password").css("border-color", "red");
                $("#password").attr("placeholder", "Mandatory field ");
                return false;
            }			
			
        }
			
    }

</script>
