<?php echo $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">
<?php
$session_data = $this->session->userdata('flight_search_data');
$sess_tripType = $session_data['tripType'];
$originCity = explode(',', $session_data['originCity']);
$destinationCity = explode(',', $session_data['destinationCity']);

$sess_departDate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!', "$3-$2-$1", $session_data['departDate']);

$sess_tripType = $session_data['tripType'];
?>
<!-----  Top destination content ----->
<div class="selectBusCntr">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-criteria">
                                <span class="triptype">Oneway Trip: </span>Bangalore → Sydney <span class="flt-criteria"> ( Fri, 27 Dec | <span id="flt-adult">1 adult</span> | <span id="flt-children">1 Children</span> )</span> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span>
                            </div>
                            <div class="search-criteria modify-search">
                                <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                <div class="row">
                                    <div class="col-md-7">
                                        <form role="form">
                                            <!--Search critiria for flights-->
                                            <div class="searchpanel">
                                                <div class="padder">
                                                    <div id="flight-search">
                                                        <h3>Modify your Search</h3>
                                                        <div class="row">
                                                            <div class="col-md-10 duration" style="padding:10px 15px;">
                                                                <label><input type="radio" value="oneway" name="flights" checked>One way</label>
                                                                <label><input type="radio" value="roundtrip" name="flights">Round Trip</label>
                                                            </div>
                                                        </div>
                                                        <div id="O-R-Trip">
                                                            <div class="row form-group">
                                                                <div class="col-md-6">
                                                                    <label for="inputCity">From City</label>
                                                                    <input type="text" class="form-control" id="inputToCity" placeholder="Enter from city">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="inputCity">To City</label>
                                                                    <input type="text" class="form-control" id="inputFromCity" placeholder="Enter to city">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                                    <label for="fromDate">Date of Journey</label>
                                                                    <input type="text" class="form-control" placeholder="DD/MM/YYYY" id="dpf1" autocomplete= "off">
                                                                </div>
                                                                <div class="col-md-6 form-group" id="dpf2Cntr">
                                                                    <label for="toDate">Date of Return (Optional)</label>
                                                                    <input type="text" class="form-control" placeholder="DD/MM/YYYY" value id="dpf2" autocomplete= "off">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-2 " >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 ">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 ">
                                                                    <label>Infants(0-2)</label>
                                                                    <select class="form-control">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Class of Travel</label>
                                                                    <select class="form-control">
                                                                        <option value="economy" selected>Economy</option>
                                                                        <option value="2">Business</option>
                                                                        <option value="3">First</option>
                                                                        <option value="3">Premium Economy</option>
                                                                    </select>
                                                                </div>
                                                            </div>  
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="searchBtncntr">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">SEARCH FLIGHTS <i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

<div class="flightCntr">
    <div class="container">

        <!--flight search section-->
        <div class="row">
            <div class="col-md-3">
                <div class="flightSearchFilter">
                    <div class="searchHdr">Filter Flight Results:</div>
                    <div><span>104 of 104 flights</span></div>
                    <ul class="flight-search">
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Price</h4>
                            <div class="flight-search-cntr">
                                <span id="priceSliderOutput" style="font-weight: normal;color:red;"></span>
                                <div id="priceSlider"  class="slider-range"></div>
                                <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                                <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
<!--                                <input type="text" class="range-value" id="price-start">
                                <input type="text" class="range-value range-value-end" id="price-end">                           
                                <div id="price-range" class="slider-range"></div>-->
                                <!--                                <label>
                                                                    <input type="checkbox">
                                                                    <span class="airlines-name">Show only refundable fares</span>
                                                                </label>-->
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Stops</h4>
                            <div class="flight-search-cntr stops">
                                <label>
                                    <input type="checkbox" class="Stop" checked value="0" id="AirLine_space"> Non Stop
                                </label>
                                <label>
                                    <input type="checkbox" class="Stop" checked value="1" id="AirLine_space"> 1
                                </label>
                                <label>
                                    <input type="checkbox" class="Stop" checked value="2" id="AirLine_space"> 1+
                                </label>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Airlines</h4>
                            <div class="flight-search-cntr AirLines">
                                <!-- AIRLINS DISPLAY  -->                               
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Departure time</h4>
                            <div class="flight-search-cntr">
                                <span id="timeSliderOutput" style="font-weight: normal;color:red;"></span>
                                <div id="timeSlider" class="slider-range"></div>
                                <input type="hidden" name="minTime" id="minTime" class="autoSubmit"  />
                                <input type="hidden" name="maxTime" id="maxTime" class="autoSubmit"  />
<!--                                <input type="text" class="range-value" id="time-start">
                                <input type="text" class="range-value range-value-end" id="time-end">                           
                                <div id="time-range" class="slider-range"></div>-->
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Fare Types</h4>
                            <div class="flight-search-cntr stops">
                                <label>
                                    <input type="checkbox" class="FareRule" checked value="Refundable"id="AirLine_space"> Refundable
                                </label>
                                <label>
                                    <input type="checkbox" class="FareRule" checked value="Non-Refundable" id="AirLine_space"> Non Refundable
                                </label>

                            </div>
                        </li>
                        <!--                        <li>
                                                    <h4><i class="fa fa-caret-down"></i> Trip duration</h4>
                                                    <div class="flight-search-cntr">
                                                        <input type="text" class="range-value " id="dur-start">
                                                        <input type="text" class="range-value range-value-end" id="dur-end">                           
                                                        <div id="dur-range" class="slider-range"></div>
                                                    </div>
                                                </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="flightResultsCntr">
                    <!-- this row will repeat based on hotels availability -->
                    <div class="dtlsOffer"><i class="fa fa-tags"></i> FLIGHTS FLASH SALE ! Use HOT DEAL and Get Flat 25% Off on this flight booking. <a href="#" class="knwmoreoffrBtn">Know More</a></div>
                    <div class="fligh-results-row">
                        <div class="resultTripType">
                            <span class="result-date-range pull-right">
                                <a href="#" class="date">Previous day</a>
                                <a href="#" class="date">Next day</a>
                            </span>
                        </div>
                        <div class="row header">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3"><a href="javascript:void(0)" title="Sort By Airline" rel="data-airlinename" data-order="asc" class="FlightSorting" id="sortByAirlinef" >Airline</a>&nbsp;<span id="sortByAirline" style="display: inline;" value="0" class="shortbyarrowU">&nbsp;</span></div>
                                    <div class="col-md-3"><a href="javascript:void(0)" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSorting" id="sortByDeparturef">Departure</a>&nbsp;<span value="0" id="sortByDeparture" style="display: inline;">&nbsp;</span></div>
                                    <div class="col-md-3"><a href="javascript:void(0)" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSorting" id="sortByArrivalf" >Arrival</a>&nbsp;<span value="0" id="sortByArrival" style="display: inline;">&nbsp;</span></div>
                                    <div class="col-md-3"><a href="javascript:void(0)" title="Sort By Duration" rel="data-duration" data-order="asc" class="FlightSorting" id="sortByDurationf">Duration</a>&nbsp;<span id="sortByDuration" style="display: inline;" value="0">&nbsp;</span></div>

                                </div>
                            </div>
                            <div class="col-md-2"><a href="javascript:void(0)" title="Sort By Total Fare" rel="data-price" data-order="asc" class="FlightSorting" id="sortByPricef">Adult Fare</a>&nbsp;<span id="sortByPrice" style="display: inline;" class="" value="0">&nbsp;</span></div>
                        </div>


                        <!-- flight result row -->

                        <?php if (!empty($result)) {
                            ?>
                            <?php
                            for ($i = 0; $i < count($result); $i++) {
                                $DepartureCode = explode(',', $result[$i]->Departure_LocationCode);
                                $MarketingAirline_Code = explode(',', $result[$i]->MarketingAirline_Code);
                                $MarketingAirline_Name = explode(',', $result[$i]->MarketingAirline_Name);
                                $FlightNumber = explode(',', $result[$i]->FlightNumber);

                                $DepartureDateTime = explode(',', $result[$i]->DepartureDateTime);
                                $ArrivalDateTime = explode(',', $result[$i]->ArrivalDateTime);
                                $Duration = explode(',', $result[$i]->Duration);

                                $ArrivalCode = explode(',', $result[$i]->Arrival_LocationCode);
                                $Departure_CityName = explode(',', $result[$i]->Departure_CityName);
                                $Arrival_CityName = explode(',', $result[$i]->Arrival_CityName);

                                $Departure_AirPortName = explode(',', $result[$i]->Departure_AirPortName);
                                $Arrival_AirPortName = explode(',', $result[$i]->Arrival_AirPortName);

                                $Total_Duration = $result[$i]->Total_Duration;
                                $FareType = $result[$i]->FareType;

                                $Destination = $result[$i]->Destination;

                                $totalJourneyDuration = $this->Flight_Model->DurationTimeInMin($Total_Duration);

                                $DepartureTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(current(array_values($DepartureDateTime)), 'mins');
                                $ArrivalTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime)), 'mins');

                                $Stops = $result[$i]->Stops;
                                if ($Stops == 0)
                                    $Stops = 0;
                                else
                                    $Stops = $Stops - 1;

                                $totalPrice = $result[$i]->TotalFare + $result[$i]->Admin_Markup + $result[$i]->Payment_Charge;
                                $totalPriceAry[] = $totalPrice;
                                ?>
                                <div class="results-row searchflight_box">
                                    <div class="row onway FlightInfoBox" data-price="<?php echo $totalPrice; ?>" data-airlinename="<?php echo $MarketingAirline_Name[0]; ?>"  data-airline="<?php echo $MarketingAirline_Code[0]; ?>" data-duration="<?php echo $totalJourneyDuration; ?>" data-fare="<?php echo $FareType; ?>" data-departure="<?php echo $DepartureTimeInMin; ?>" data-arrival="<?php echo $ArrivalTimeInMin; ?>" data-stop="<?php echo $Stops; ?>">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-3 air-logo">
                                                    <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[0]; ?>.png" alt="<?php echo $MarketingAirline_Name[0]; ?>">
                                                    <span class="font12"><?php echo $MarketingAirline_Name[0]; ?></span>
                                                </div>
                                                <div class="col-md-3 air-dep-time">
                                                    <?php echo $Departure_CityName[0]; ?>
                                                    <span class="font12"><?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[0], 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[0], 'time'); ?></span>
                                                </div>

                                                <div class="col-md-3 air-arv-time">
                                                    <?php echo end(array_values($Arrival_CityName)); ?>
                                                    <span class="result-arrival-date"><?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime)), 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime)), 'time'); ?></span>

                                                </div>
                                                <div class="col-md-3 air-dur">
                                                    <i class="fa fa-clock-o"></i> <?php echo $this->Flight_Model->GetHoursAndMinutes($Duration[0]); ?>
        <!--                                                    <span class="font12 flightStops"> DOH → MXP →</span>-->
                                                    <span class="font12">  <?php
                                            if ($result[0]->Stops == 0)
                                                echo "Non Stop";
                                            else
                                                echo ($result[0]->Stops - 1) . " Stop";
                                                    ?></span>
                                                </div>
                                            </div>
                                            <?php
                                            if ($sess_tripType == 'R') {

                                                $OriginDestinationRPH = $result[$i]->OriginDestinationRPH;
                                                $result_return = $this->Flight_Model->get_return_flight_result($OriginDestinationRPH);

                                                $DepartureCode_r = explode(',', $result_return->Departure_LocationCode);
                                                $MarketingAirline_Code_r = explode(',', $result_return->MarketingAirline_Code);
                                                $MarketingAirline_Name_r = explode(',', $result_return->MarketingAirline_Name);
                                                $FlightNumber_r = explode(',', $result_return->FlightNumber);

                                                $DepartureDateTime_r = explode(',', $result_return->DepartureDateTime);
                                                $ArrivalDateTime_r = explode(',', $result_return->ArrivalDateTime);
                                                $Duration_r = explode(',', $result_return->Duration);

                                                $ArrivalCode_r = explode(',', $result_return->Arrival_LocationCode);
                                                $Departure_CityName_r = explode(',', $result_return->Departure_CityName);
                                                $Arrival_CityName_r = explode(',', $result_return->Arrival_CityName);

                                                $Total_Duration_r = $result_return->Total_Duration;
                                                $FareType_r = $result_return->FareType;

                                                $Destination_r = $result_return->Destination;
                                                $Origin_r = $result_return->Origin;

                                                $totalJourneyDuration_r = $this->Flight_Model->DurationTimeInMin($Total_Duration_r);

                                                $DepartureTimeInMin_r = $this->Flight_Model->getDate_TimeFromDateTime(current(array_values($DepartureDateTime_r)), 'mins');
                                                $ArrivalTimeInMin_r = $this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime_r)), 'mins');

                                                $Stops_r = $result_return->Stops;
                                                if ($Stops_r == 0)
                                                    $Stops_r = 0;
                                                else
                                                    $Stops_r = $Stops_r - 1;
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-3 air-logo">
                                                        <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code_r[0]; ?>.png" alt="<?php echo $MarketingAirline_Name[0]; ?>">
                                                        <span class="font12"><?php echo $MarketingAirline_Name_r[0]; ?></span>
                                                    </div>
                                                    <div class="col-md-3 air-dep-time">
                                                        <?php echo $Departure_CityName_r[0]; ?>
                                                        <span class="font12"><?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime_r[0], 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime_r[0], 'time'); ?></span>
                                                    </div>

                                                    <div class="col-md-3 air-arv-time">
                                                        <?php echo end(array_values($Arrival_CityName_r)); ?>
                                                        <span class="result-arrival-date"><?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime_r)), 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime_r)), 'time'); ?></span>

                                                    </div>
                                                    <div class="col-md-3 air-dur">
                                                        <i class="fa fa-clock-o"></i> <?php echo $this->Flight_Model->GetHoursAndMinutes($Duration_r[0]); ?>
            <!--                                                    <span class="font12 flightStops"> DOH → MXP →</span>-->
                                                        <span class="font12">    <?php
                                            if ($result_return->Stops == 0)
                                                echo "Non Stop";
                                            else
                                                echo ($result_return->Stops - 1) . " Stop";
                                                        ?></span>
                                                    </div>
                                                </div>


                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2 air-price">
                                            <i class="fa fa-rupee"></i> <?php echo $totalPrice; ?>
                                            <form action="<?php echo WEB_URL; ?>flight/flight_int_details" method="post"  name="flight_details" >                                     
                                                <input type="hidden" name="onwardFlightId" value="<?php echo $result[$i]->flight_t_id; ?>" />
                                                <input type="hidden" name="onwardIdVal" value="<?php echo $result[$i]->id_val; ?>" />
                                                <button class="btn btn-success">BOOK <i class="fa fa-angle-double-right"></i></button>
                                            </form>
                                            <span class="open-flight-details"><i class="fa fa-arrow-down"></i> DETAILS </span>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="flight-details-Cntr verySoftShadow">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php echo $Departure_CityName[0]; ?> to <?php echo end(array_values($Arrival_CityName)); ?><span class="flt-criteria"> ( Mon Dec 30 2013  )</span>
                                                    <span class="fareCntr">
<!--                                                        <a href="#" data-toggle="dropdown"> <i class="fa fa-money"></i> Fare breakup</a> | 
                                                        <a href="#" data-toggle="modal" data-target="#modalCheckRules"><i class="fa fa-list-alt"></i> Fare rules</a>-->
                                                        <!--                                                        <div class="toolTip dropdown-menu fare-breakup" role="menu" aria-labelledby="dLabel">
                                                                                                                    <h4>Fare breakup</h4>
                                                                                                                    <table>
                                                                                                                        <tr>
                                                                                                                            <td>Base fare</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Fuel surchare</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Taxes & fees</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Passenger service fee</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr class="bold">
                                                                                                                            <td>Total</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </div>-->
                                                    </span>
                                                    <div class="selected-flight-dtls">
                                                        <?php for ($j = 0; $j < count($DepartureCode); $j++) { ?>    
                                                            <div class="row detailed-row">
                                                                <div class="col-md-3">
                                                                    <div class="airlinelogo pull-left">
                                                                        <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j]; ?>.png" alt="<?php echo $MarketingAirline_Name[$j]; ?>">
                                                                        <span><?php echo $MarketingAirline_Name[$j]; ?></span>
                                                                        <span> <?php echo $MarketingAirline_Code[$j]; ?> - <?php echo $FlightNumber[$j]; ?> </span>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="start-time"><?php echo $Departure_CityName[$j]; ?> (<?php echo $DepartureCode[$j]; ?>)</span>
                                                                    <span class="start-date"><?php echo $Departure_AirPortName[$j]; ?>,</span>
                                                                    <span class="start-loc"><?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[$j], 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[$j], 'time'); ?></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="end-time"><?php echo $Arrival_CityName[$j]; ?> (<?php echo $ArrivalCode[$j]; ?>)</span>
                                                                    <span class="end-date"><?php echo $Arrival_AirPortName[$j]; ?>,</span>
                                                                    <span class="end-loc"><?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime[$j], 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime[$j], 'time'); ?></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="dur-clock"><i class="fa fa-clock-o"></i></span>
                                                                    <span class="flight-dur"><?php echo $this->Flight_Model->GetHoursAndMinutes($Duration[$j]); ?></span>
                                                                    <span class="font12"> <?php
                                                if ($result[$i]->Stops == 0)
                                                    echo "Non Stop";
                                                else
                                                    echo ($result[$i]->Stops - 1) . " Stop";
                                                            ?> </span>
                                                                    <span><?php echo $result[$i]->FareType; ?></span>
                                                                </div>

                                                            </div>
                                                            <?php
                                                            if ($ArrivalCode[$j] != $Destination) {

                                                                $ArrDateTime = preg_replace("/[T]/", " ", $ArrivalDateTime[$j]);
                                                                $DepDateTime = preg_replace("/[T]/", " ", $DepartureDateTime[$j + 1]);
                                                                ?>
                                                                <div class="layover "><span>Layover:<span class="layover-dur">Change planes at <?php echo $Arrival_CityName[$j]; ?>. Time between flights:<strong> <?php echo $this->Flight_Model->journeyDuration($ArrDateTime, $DepDateTime); ?></strong></span></span></div>
                                                            <?php } ?>     
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--   THE BELOW FOR THE ROUND TRIP -->
                                              <?php if ($sess_tripType == 'R') { ?> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php echo $Departure_CityName_r[0]; ?> to <?php echo end(array_values($Arrival_CityName_r)); ?><span class="flt-criteria"></span>
                                                    <span class="fareCntr">
<!--                                                        <a href="#" data-toggle="dropdown"> <i class="fa fa-money"></i> Fare breakup</a> | 
                                                        <a href="#" data-toggle="modal" data-target="#modalCheckRules"><i class="fa fa-list-alt"></i> Fare rules</a>
                                                                                                                <div class="toolTip dropdown-menu fare-breakup" role="menu" aria-labelledby="dLabel">
                                                                                                                    <h4>Fare breakup</h4>
                                                                                                                    <table>
                                                                                                                        <tr>
                                                                                                                            <td>Base fare</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Fuel surchare</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Taxes & fees</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Passenger service fee</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                        <tr class="bold">
                                                                                                                            <td>Total</td>
                                                                                                                            <td><i class="fa fa-rupee"></i> 21.453</td>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </div>-->
                                                    </span>
                                                    <div class="selected-flight-dtls">
                                                       <?php for ($j = 0; $j < count($DepartureCode_r); $j++) { ?>     
                                                            <div class="row detailed-row">
                                                                <div class="col-md-3">
                                                                    <div class="airlinelogo pull-left">
                                                                        <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code_r[$j]; ?>.png" alt="<?php echo $MarketingAirline_Name_r[$j]; ?>">
                                                                        <span><?php echo $MarketingAirline_Name_r[$j]; ?></span>
                                                                        <span><?php echo $MarketingAirline_Code_r[$j]; ?> - <?php echo $FlightNumber_r[$j]; ?></span>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="start-time"><?php echo $Departure_CityName_r[$j]; ?> (<?php echo $DepartureCode_r[$j]; ?>)</span>
                                                                    <span class="start-date"><?php echo $Departure_AirPortName_r[$j]; ?>, </span>
                                                                    <span class="start-loc"> <?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime_r[$j], 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime_r[$j], 'time'); ?></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="end-time"><?php echo $Arrival_CityName_r[$j]; ?> (<?php echo $ArrivalCode_r[$j]; ?>)</span>
                                                                    <span class="end-date"><?php echo $Arrival_AirPortName_r[$j]; ?>, </span>
                                                                    <span class="end-loc"><?php echo date('D, jS M', strtotime($this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime_r[$j], 'date'))); ?>,<?php echo $this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime_r[$j], 'time'); ?></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="dur-clock"><i class="fa fa-clock-o"></i></span>
                                                                    <span class="flight-dur"><?php echo $this->Flight_Model->GetHoursAndMinutes($Duration_r[$j]); ?></span>
                                                                    <span class="font12">     <?php
                if ($result_return->Stops == 0)
                    echo "Non Stop";
                else
                    echo ($result_return->Stops - 1) . " Stop";
                ?> 
                                                                    </span>
                                                                    <span><?php echo $result_return->FareType; ?></span>
                                                                </div>

                                                            </div>
                                                          <?php
                if ($ArrivalCode_r[$j] != $Origin_r) {

                    $ArrDateTime_r = preg_replace("/[T]/", " ", $ArrivalDateTime_r[$j]);
                    $DepDateTime_r = preg_replace("/[T]/", " ", $DepartureDateTime_r[$j + 1]);
                    ?>
                                                                <div class="layover "><span>Layover:<span class="layover-dur">Change planes at <?php echo $Arrival_CityName_r[$j]; ?>. Time between flights:<strong> <?php echo $this->Flight_Model->journeyDuration($ArrDateTime_r, $DepDateTime_r); ?></strong></span></span></div>
                                                            <?php } ?>     
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php } ?> 
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>   


                        <?php } else { ?>
                            <div id="row" class="font10">
                                <div align="center">No matching flights found... Please try again...</div>
                            </div>
                        <?php } ?> 
                    </div>
                </div>
            </div>
        </div>        

    </div>
</div>
</div>

<input type="hidden" id="setMinPrice" value="<?php if (!empty($totalPriceAry)) echo min($totalPriceAry); else echo 0; ?>" />                               
<input type="hidden" id="setMaxPrice" value="<?php if (!empty($totalPriceAry)) echo max($totalPriceAry); else echo 0; ?>" />                         
<input type="hidden" id="setCurrency" value="Rs." /> 
<input type="hidden" id="setMinTime" value="0" />                               
<input type="hidden" id="setMaxTime" value="1440" /> 
<!-- Modal -->
<!--<div class="modal fade" id="modalCheckRules" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Fare Rule Information</h3>
            </div>
            <div class="modal-body">
                <table class="checkRulesCnt">
                    <tr>
                        <td>Rescheduling/Change Penalty*</td>
                        <td width="15px">:</td>
                        <td>Rs. 1500 per person per sector</td>
                    </tr>
                    <tr>
                        <td>Cancellation Penalty*</td>
                        <td>:</td>
                        <td>Rs. 1500 per person per sector</td>
                    </tr>
                    <tr>
                        <td>Tickmango Service Fee**</td>
                        <td>:</td>
                        <td>Rs. 200 or Rs. 250</td>
                    </tr>
                </table>

                <div>
                    <ul>
                        <li>*The penalty is subject to 4 hrs before departure. No Changes are allowed after that.</li>
                        <li>*The charges are per passenger per sector.</li>
                        <li>*Rescheduling Charges = Rescheduling/Change Penalty + Fare Difference (if applicable)</li>
                        <li>*Partial cancellation is not allowed on tickets booked under special discounted fares.</li>
                        <li>*In case of no-show or ticket not cancelled within the stipulated time, only statutory taxes are refundable subject to Goibibo Service Fee.</li>
                        <li>*No Baggage Allowance for Infants</li>
                        <li>**Goibibo Service fee will be Rs. 200 in case of online cancellation and Rs. 250 in case of customer-care assisted cancellation</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>-->

<?php echo $this->load->view('home/footer'); ?>

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/flight/int_filter.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/flight/int_sorting.js"></script>

<script type="text/javascript">

    $(document).on("click", '.AirLine', function ($e) {
  			
        filter();
    } );
	
    $(document).on("click", '.clickme', function ($e) {
  			
        $(this).parents('.searchflight_box').find('.outer').slideToggle();
    } );
	
    $(document).ready(function() 
    { //alert('asd');
        $(".Stop").click(function()
        {
            filter();
        });
		
        $(".FareRule").click(function()
        {
            filter();
        });		
		
        //==================Callbacks===============================	
        setPriceSlider();			
        setTimeSlider();
		
        // Airline Code and Airline Name
		
        var data_airline=new Array;
        var data_airlineNames=new Array;
					
        var flightCount=0;						
        $(".FlightInfoBox").each(function()
        {
            flightCount++;
            data_airline.push($(this).attr("data-airline"));
            data_airlineNames.push($(this).attr("data-airlinename"));
			
        });	
		
        $("#flightCount").text(flightCount);
        $("#flightCount1").text(flightCount);	
				
        data_airline = $.grep(data_airline, function(v, k)
        {			   
            return $.inArray(v ,data_airline) === k;
        });
			
        data_airlineNames = $.grep(data_airlineNames, function(v, k)
        {
            return $.inArray(v ,data_airlineNames) === k;
        });
		
        var AirlineString="";
        for(var ai=0;ai<data_airline.length;ai++)		
        {
            var airlineCode=data_airline[ai];
            var airlineName=data_airlineNames[ai];
            if(typeof airlineCode=="undefined" || airlineCode=="") {}
            else
            {
                AirlineString+='<div class="leftLabels"><label><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked"> <span class="airlines-name">'+airlineName+'</span></label></div>';
                //AirlineString+='<div class="leftLabels"><span><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked"> </span><label>'+airlineName+'</label></div>';
            }				
        }

        $(".AirLines").html(AirlineString);
		
        //show matrix
        //matrix('onwardMatrix');
		
        <!--==  Hide show  ==---->
        $('.nav-toggle').click(function(){
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');					
					
            //make the collapse content to be shown or hide
            var toggle_switch = $(this);
            $(collapse_content_selector).slideToggle(function(){
                if($(this).css('display')=='none'){
                    toggle_switch.html('Show Matrix');//change the button label to be 'Show'
                }else{
                    toggle_switch.html('Hide Matrix');//change the button label to be 'Hide'
                }
            });
        });
				
				
        $(".labelsFilter").click(function(){
            $(this).next(".leftDetailsContainer").slideToggle('slow'); 
            var plusmin;
            plusmin = $(this).children(".plusminus").text();
		
            if( plusmin == '+')
                $(this).children(".plusminus").text('-');
            else
                $(this).children(".plusminus").text('+');
        });
	
        <!--=====  Scrolling   =====--->
        $(window).scroll(function(e) {
            var scroller_anchor = $(".scroller_anchor").offset().top;
            if ($(this).scrollTop() >= scroller_anchor && $('.resultHeader, .m-s-search').css('position') != 'fixed') 
            {    
                $('.resultHeader, .m-s-search').css({
                    //'background': '#CCC',
                    'position': 'fixed',
                    'top': '0px'
                });
                //$('.scroller_anchor').css('height', '50px');
            } 
            else if ($(this).scrollTop() < scroller_anchor && $('.resultHeader, .m-s-search').css('position') != 'relative') 
            {    
                //$('.scroller_anchor').css('height', '0px');
                $('.resultHeader, .m-s-search').css({
                    'position': 'relative'
                });
            }
        });
			
		
    });
            

    // Filter Matrix

    function matrix(selector)
    {		
        $.ajax
        ({
            url:'<?php echo WEB_URL; ?>flight/int_rateMatrix',
            data: '',
            dataType: "json",		
            success: function(data)
            {
                alert(data.matrix);
                $("."+selector).html(data.matrix);
            }
        });
    }
	
</script>


<script type="text/javascript">
  
    $(document).ready(function() {
        $('#carousel_ul1 li:first').before($('#carousel_ul1 li:last')); 
        $('#right_scroll1 img').click(function(){
            var item_width = $('#carousel_ul1 li').outerWidth() + 10;
            var left_indent = parseInt($('#carousel_ul1').css('left')) - item_width;
            $('#carousel_ul1:not(:animated)').animate({'left' : left_indent},500,function(){    
                $('#carousel_ul1 li:last').after($('#carousel_ul1 li:first')); 
                $('#carousel_ul1').css({'left' : '-228px'});
            }); 
        });
        
        //when user clicks the image for sliding left
        $('#left_scroll1 img').click(function(){
            var item_width = $('#carousel_ul1 li').outerWidth() + 10;
            var left_indent = parseInt($('#carousel_ul1').css('left')) + item_width;
            $('#carousel_ul1:not(:animated)').animate({'left' : left_indent},500,function(){             
                $('#carousel_ul1 li:first').before($('#carousel_ul1 li:last')); 
                $('#carousel_ul1').css({'left' : '-228px'});
            });
        });	
		
        <!---==  Navigation  ==---->
        $('.tabs-nav a').on('click', function (event) {
            event.preventDefault();
            $('.tabs-nav li').removeClass('tab-active');
            $(this).parent().addClass('tab-active');
            $('.tabs-stage div').show();
            $($(this).attr('href')).hide();
        });

        $('.tabs-nav a:first').trigger('click');

		
		
    });
  
    $(document).ready(function () 
    {		
        $val=$("#tripType:checked").val();		
        if($val=='S')
        {	   		
            $('#return').hide();
        }
        else
        {		
            $('#return').show();
        }
		
        $valInt=$("#tripTypeInt:checked").val();		
        if($valInt=='S')
        {	   		
            $('#returnInt').hide();
        }
        else
        {		
            $('#returnInt').show();
        }
	
		
    });
 	
    $("input:radio[name=tripType]").live('click',(function() 
    {		
        var values = $(this).val();
        if(values == 'R')
        {
            $('#return').show();
        }
        else
        {
            $('#return').hide();
        }
		
    }));
	
    $("input:radio[name=tripTypeInt]").live('click',(function() 
    {		
        var valuesInt = $(this).val();
        if(valuesInt == 'R')
        {
            $('#returnInt').show();
        }
        else
        {
            $('#returnInt').hide();
        }
		
    }));
	
</script>

