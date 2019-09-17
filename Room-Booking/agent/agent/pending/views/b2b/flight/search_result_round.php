
<?php echo $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">
<!-----  Top destination content ----->
<div class="selectBusCntr">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-criteria">
                                     <?php
                                $session_data = $this->session->userdata('flight_search_data');
                                $sess_tripType = $session_data['tripType'];
                                $originCity = explode(',', $session_data['originCity']);
                                $destinationCity = explode(',', $session_data['destinationCity']);

                                $sess_departDate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!', "$3-$2-$1", $session_data['departDate']);
                                ?>
                                <span class="triptype">Round-trip: </span><?php echo $originCity[1]; ?> → <?php echo $destinationCity[1]; ?><span class="flt-criteria"> ( <?php echo date('D, jS M, Y', strtotime($sess_departDate)); ?><!-- <span id="flt-adult">1 adult</span> | <span id="flt-children">1 Children</span> -->)</span> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span> </div>
                            <div class="search-criteria modify-search"> <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
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
                                                                <label>
                                                                    <input type="radio" value="oneway" name="flights" checked>
                                                                    One way</label>
                                                                <label>
                                                                    <input type="radio" value="roundtrip" name="flights">
                                                                    Round Trip</label>
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
                    <div><span>Showing <label id="flightCount"></label> of <label id="flightCount1"></label> flights</span></div>
                    <ul class="flight-search">
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Price</h4>
                            <div class="flight-search-cntr">
                                <h5>Onward trip</h5>
                                <span id="priceSliderOutput" style="font-weight: normal;color: red;"></span>
                                <div id="priceSlider" class="slider-range marginBottom20" style="z-index:0;"></div>
                                <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                                <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
<!--                                <input type="text" class="range-value" id="price-start">
                            <input type="text" class="range-value range-value-end" id="price-end">-->
                                <!--                                <div id="price-range" class="slider-range marginBottom20"></div>-->
                                <!--                                <h5 class="marginTop10">Return trip</h5>
                                                                <input type="text" class="range-value" id="return-price-start">
                                                                <input type="text" class="range-value range-value-end" id="return-price-end">
                                                                <div id="return-price-range" class="slider-range"></div>
                                                                <label>
                                                                    <input type="checkbox">
                                                                    <span class="airlines-name">Show only refundable fares</span> </label>-->
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Stops</h4>
                            <div class="flight-search-cntr stops">
                                <label>
                                    <input class="Stop" type="checkbox" checked value="0" id="AirLine_space">
                                    Non Stop </label>
                                <label>
                                    <input class="Stop" type="checkbox" checked value="1" id="AirLine_space">
                                    1 </label>
                                <label>
                                    <input class="Stop" type="checkbox" checked value="2" id="AirLine_space">
                                    1+ </label>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Airlines</h4>
                            <div class="flight-search-cntr airlines">
                                <div class="leftDetailsContainer AirLines">
                                    <!-- Airlines Display -->
                                </div>
                                <!--                                <label>
                                                                    <input type="checkbox">
                                                                    <span class="airlines-name">Air France</span>
                                                                </label>-->

                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Departure time</h4>
                            <div class="flight-search-cntr">
                                <h5>Onward trip</h5>
                                <span id="timeSliderOutput" style="font-weight: normal;color:red"></span>
                                <div id="timeSlider" class="slider-range marginBottom20" style="z-index:0;"></div>
                                <input type="hidden" name="minTime" id="minTime" class="autoSubmit"  />
                                <input type="hidden" name="maxTime" id="maxTime" class="autoSubmit"  />
<!--                                <input type="text" class="range-value" id="time-start">
                            <input type="text" class="range-value range-value-end" id="time-end">
                            <div id="time-range" class="slider-range marginBottom20"></div>-->
                                <!--                                <h5>Return trip</h5>
                                                                <input type="text" class="range-value" id="return-time-start">
                                                                <input type="text" class="range-value range-value-end" id="return-time-end">
                                                                <div id="return-time-range" class="slider-range"></div>-->
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Fare Type</h4>
                            <div class="flight-search-cntr airlines">                              
                                <label>
                                    <input class="FareRule" type="checkbox" checked="checked" value="Refundable"  id="AirLine_space"/>
                                    <span class="airlines-name">Refundable</span>
                                </label>
                                <label>
                                    <input class="FareRule" type="checkbox" checked="checked" value="Non-Refundable"  id="AirLine_space"/>
                                    <span class="airlines-name">Non Refundable</span>
                                </label>

                            </div>
                        </li>
                        <!--                        <li>
                                                    <h4><i class="fa fa-caret-down"></i> Trip duration</h4>
                                                    <div class="flight-search-cntr">
                                                        <h5>Onward trip</h5>
                                                        <input type="text" class="range-value " id="dur-start">
                                                        <input type="text" class="range-value range-value-end" id="dur-end">
                                                        <div id="dur-range" class="slider-range marginBottom20"></div>
                                                        <h5>Return trip</h5>
                                                        <input type="text" class="range-value " id="return-dur-start">
                                                        <input type="text" class="range-value range-value-end" id="return-dur-end">
                                                        <div id="return-dur-range" class="slider-range"></div>
                                                    </div>
                                                </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="flightResultsCntr" id="round-trip"> 
                    <!-- this row will repeat based on hotels availability -->
                    <div class="dtlsOffer"><i class="fa fa-tags"></i> FLIGHTS FLASH SALE ! Use HOT DEAL and Get Flat 25% Off on this flight booking. <a href="#" class="knwmoreoffrBtn">Know More</a></div>

                    <!--selected results -->
                    <div class="selectedRoundFlights verySoftShadow row">
                        <form action="<?php echo WEB_URL; ?>flight/flight_details" method="post"  name="flight_details" >
                            <div class="selectedOnwayFlight col-md-5">
                                <div class="results-row">
                                    <div class="row priceInfoOnward">
                                        <!--  selected onward flights goes here  -->
                                    </div>

                                </div>
                            </div>
                            <div class="seletedReturnFlight col-md-5">
                                <div class="results-row">
                                    <div class="row priceInfoReturn">
                                        <!--  SELECTED RETURN FLIGHTS GOES HERE  -->
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2 priceInfoTotal">
                                <span class="totalDisplay">
                                    <i class="fa fa-rupee"></i> <span class="totalAmount"></span> 
                                </span>
                                <button class="btn btn-success">BOOK <i class="fa fa-angle-double-right"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- onward trip-->
                    <div class="fligh-results-row" id="onward-trip">
                        <div class="resultTripType"> Onward Trip <span class="result-date-range pull-right"> <a href="#" class="date">Previous day</a> <a href="#" class="date">Next day</a> </span> </div>
                        <div class="row header">
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Airline" rel="data-airlinename" data-order="asc" class="FlightSorting" style="text-decoration: underline">Airline</a> </div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSorting" style="text-decoration: underline">Depart</a> </div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSorting" style="text-decoration: underline">Arrive</a></div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Fare Type" rel="data-fare" data-order="asc" class="FlightSorting" style="text-decoration: underline">Fare Type</a></div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Total Fare" rel="data-price" data-order="asc" class="FlightSorting" style="text-decoration: underline">Price</a></div>
                        </div>
                        <!-- result row -->
                        <!--  flight oneway integration flight starts  -->
                        <?php if (!empty($result)) { ?>
                            <?php
                            for ($i = 0; $i < count($result); $i++) {
                                $DepartureCode = explode(',', $result[$i]->Departure_LocationCode);
                                $MarketingAirline_Code = explode(',', $result[$i]->MarketingAirline_Code);
                                $MarketingAirline_Name = explode(',', $result[$i]->MarketingAirline_Name);
                                $FlightNumber = explode(',', $result[$i]->FlightNumber);

                                $DepartureDateTime = explode(',', $result[$i]->DepartureDateTime);
                                $ArrivalDateTime = explode(',', $result[$i]->ArrivalDateTime);

                                $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[0]);
                                list($DDate, $DTime) = explode(" ", $Ddatetime);

                                $Duration = explode(',', $result[$i]->Duration);

                                $ArrivalCode = explode(',', $result[$i]->Arrival_LocationCode);
                                $Departure_CityName = explode(',', $result[$i]->Departure_CityName);
                                $Arrival_CityName = explode(',', $result[$i]->Arrival_CityName);

                                $Total_Duration = $result[$i]->Total_Duration;
                                $FareType = $result[$i]->FareType;

                                $Origin = $result[$i]->Origin;
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
                                <div class="searchflight_box">
                                    <div class="results-row br1 searchflightallsearch FlightInfoBox" data-price="<?php echo $totalPrice; ?>" data-airlinename="<?php echo $MarketingAirline_Name[0]; ?>"  data-airline="<?php echo $MarketingAirline_Code[0]; ?>" data-duration="<?php echo $totalJourneyDuration; ?>" data-fare="<?php echo $FareType; ?>" data-departure="<?php echo $DepartureTimeInMin; ?>" data-arrival="<?php echo $ArrivalTimeInMin; ?>" data-stop="<?php echo $Stops; ?>" data-flightno="<?php echo $FlightNumber[0]; ?>" data-origin="<?php echo $Origin; ?>" data-destination="<?php echo $Destination; ?>" data-departdate="<?php echo date('D, j M', strtotime($DDate)); ?>" data-flightid="<?php echo $result[$i]->flight_t_id; ?>" data-idval="<?php echo $result[$i]->id_val; ?>">
                                        <?php for ($j = 0; $j < count($DepartureCode); $j++) { ?>
                                            <div class="row onway">
                                                <div class="col-md-2 air-logo">
                                                    <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j]; ?>.png" alt="<?php echo $MarketingAirline_Name[$j]; ?>">
                                                    <span class="font12"><?php echo $MarketingAirline_Code[$j]; ?>-<?php echo $FlightNumber[$j]; ?></span>
                                                </div>
                                                <div class="col-md-2 air-dep-time">

                                                    <span class="font12"><?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[$j], 'time'); ?></span>
                                                </div>
                                                <div class="col-md-2 air-arv-time">

                                                    <span class="font12"><?php echo $this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime[$j], 'time'); ?></span>
                                                </div>
                                                <div class="col-md-2 air-dur">                                            
                                                    <span class="font12"><?php echo $result[$i]->FareType; ?></span>
                                                    <span class="font12">Paid meal</span>
                                                </div>
                                                <?php if ($j == 0) { ?>
                                                    <div class="col-md-2 air-price"><span style="float:right;"><i class="fa fa-rupee"></i><?php echo $totalPrice; ?></span>
                                                        <label><input type="radio" class="onwardRadio" name="onwardRadio">SELECT</label><!--<button class="btn btn-success"></button>-->
                <!--                                                        <span class="open-flight-details"><i class="fa fa-arrow-down"></i> DETAILS </span> -->
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-2 air-price">

                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php if ($ArrivalCode[$j] != $Destination) { ?> 
                                                <div class="row onway">
                                                    <div class="col-md-6"> 
                                                        <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j]; ?>.png" alt="<?php echo $MarketingAirline_Name[$j]; ?>">
                                                        <?php
                                                        $ArrDateTime = preg_replace("/[T]/", " ", $ArrivalDateTime[$j]);
                                                        //list($ArrDate, $ArrTime) = explode(" ", $ArrDateTime);
                                                        $DepDateTime = preg_replace("/[T]/", " ", $DepartureDateTime[$j + 1]);
                                                        //list($DepDate, $DepTime) = explode(" ", $DepDateTime);					
                                                        //$Diff = strtotime($DepTime) - strtotime($ArrTime);
                                                        //$DiffTime = date('H:i:s', $Diff);
                                                        ?>
                                                        <span class="font12">Change flight at <?php echo $Arrival_CityName[$j]; ?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime, $DepDateTime); ?></span>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>   


                        <?php } else { ?>
                            <div id="row" class="font10">
                                <div align="center">No matching flights found... Please try again...</div>
                            </div>
                        <?php } ?>    


                    </div>
                    <!-- Left grid ends  -->
                    <!--  right grid starting  -->
                    <!-- return trip-->
                    <div class="fligh-results-row" id="return-trip">
                        <div class="resultTripType"> Return Trip <span class="result-date-range pull-right"> <a href="#" class="date">Previous day</a> <a href="#" class="date">Next day</a> </span> </div>
                        <div class="row header">
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Airline" rel="data-airlinename" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Airline</a> </div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Depart</a></div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Arrive</a> </div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Fare Type" rel="data-fare" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Fare Type</a></div>
                            <div class="col-md-2"><a href="javascript:void(0);" title="Sort By Total Fare" rel="data-price" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Price</a></div>
                        </div>

                        <?php if (!empty($result1)) { ?>
                            <?php
                            for ($i = 0; $i < count($result1); $i++) {
                                $DepartureCode = explode(',', $result1[$i]->Departure_LocationCode);
                                $MarketingAirline_Code = explode(',', $result1[$i]->MarketingAirline_Code);
                                $MarketingAirline_Name = explode(',', $result1[$i]->MarketingAirline_Name);
                                $FlightNumber = explode(',', $result1[$i]->FlightNumber);

                                $DepartureDateTime = explode(',', $result1[$i]->DepartureDateTime);
                                $ArrivalDateTime = explode(',', $result1[$i]->ArrivalDateTime);

                                $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[0]);
                                list($DDate, $DTime) = explode(" ", $Ddatetime);

                                $Duration = explode(',', $result1[$i]->Duration);

                                $ArrivalCode = explode(',', $result1[$i]->Arrival_LocationCode);
                                $Departure_CityName = explode(',', $result1[$i]->Departure_CityName);
                                $Arrival_CityName = explode(',', $result1[$i]->Arrival_CityName);

                                $Total_Duration = $result1[$i]->Total_Duration;
                                $FareType = $result1[$i]->FareType;

                                $Origin = $result1[$i]->Origin;
                                $Destination = $result1[$i]->Destination;

                                $totalJourneyDuration = $this->Flight_Model->DurationTimeInMin($Total_Duration);

                                $DepartureTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(current(array_values($DepartureDateTime)), 'mins');
                                $ArrivalTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime)), 'mins');

                                $Stops = $result1[$i]->Stops;
                                if ($Stops == 0)
                                    $Stops = 0;
                                else
                                    $Stops = $Stops - 1;

                                $totalPrice1 = $result1[$i]->TotalFare + $result1[$i]->Admin_Markup + $result1[$i]->Payment_Charge;
                                $totalPriceAry[] = $totalPrice1;
                                ?>
                                <!-- return result row -->
                                <div class="searchflight_box">
                                    <div class="results-row br1 searchflightallsearch FlightInfoBox" data-price="<?php echo $totalPrice1; ?>" data-airlinename="<?php echo $MarketingAirline_Name[0]; ?>"  data-airline="<?php echo $MarketingAirline_Code[0]; ?>" data-duration="<?php echo $totalJourneyDuration; ?>" data-fare="<?php echo $FareType; ?>" data-departure="<?php echo $DepartureTimeInMin; ?>" data-arrival="<?php echo $ArrivalTimeInMin; ?>" data-stop="<?php echo $Stops; ?>" data-flightno="<?php echo $FlightNumber[0]; ?>" data-origin="<?php echo $Origin; ?>" data-destination="<?php echo $Destination; ?>" data-departdate="<?php echo date('D, j M', strtotime($DDate)); ?>" data-flightid="<?php echo $result1[$i]->flight_t_id; ?>" data-idval="<?php echo $result1[$i]->id_val; ?>">
                                        <?php for ($j = 0; $j < count($DepartureCode); $j++) { ?>
                                            <div class="row onway">
                                                <div class="col-md-2 air-logo">
                                                    <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j]; ?>.png" alt="<?php echo $MarketingAirline_Name[$j]; ?>">
                                                    <span class="font12"><?php echo $MarketingAirline_Code[$j]; ?>-<?php echo $FlightNumber[$j]; ?></span>
                                                </div>
                                                <div class="col-md-2 air-dep-time">

                                                    <span class="font12"><?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[$j], 'time'); ?>→</span>
                                                </div>
                                                <div class="col-md-2 air-arv-time">

                                                    <span class="font12"><?php echo $this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime[$j], 'time'); ?></span>
                                                </div>
                                                <div class="col-md-2 air-dur">

                                                    <span class="font12"><?php echo $result1[$i]->FareType; ?></span>
                                                    <span class="font12">Paid meal</span>
                                                </div>
                                                <?php if ($j == 0) { ?>
                                                    <div class="col-md-2 air-price"><span style="float:right;"><i class="fa fa-rupee"></i><?php echo $totalPrice1; ?></span>
                                                       <label><input type="radio" name="returnRadio" class="returnRadio">SELECT</label><!-- <button class="btn btn-success"></button>-->
                <!--                                                        <span class="open-flight-details"><i class="fa fa-arrow-down"></i> DETAILS </span> -->
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-2 air-price">

                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php if ($ArrivalCode[$j] != $Origin) { ?>
                                                <div class="row onway">
                                                    <div class="col-md-6 air-logo">
                                                        <?php
                                                        $ArrDateTime = preg_replace("/[T]/", " ", $ArrivalDateTime[$j]);

                                                        $DepDateTime = preg_replace("/[T]/", " ", $DepartureDateTime[$j + 1]);
                                                        ?>
                                                        <img src="<?php echo WEB_DIR ?>public/images/planeStop.png" alt="<?php echo $MarketingAirline_Name[$j]; ?>">
                                                        <span class="font12">Change flight at <?php echo $Arrival_CityName[$j]; ?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime, $DepDateTime); ?></span>
                                                    </div>

                                                </div>
                                            <?php } ?>
                                        <?php } ?>  
                                    </div>

                                </div>   <?php } ?>   


                        <?php } else { ?>
                            <div id="row" class="font10">
                                <div align="center">No matching flights found... Please try again...</div>
                            </div>
                        <?php } ?> 
                    </div>
                    <!--  right grid ends -->
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
<div class="modal fade" id="modalCheckRules" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <li>*Partial cancellation is not allowed on tickets SELECTed under special discounted fares.</li>
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
</div>


<?php echo $this->load->view('home/footer'); ?>

<!-- filtering and sorting -->

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/flight/filter.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/flight/sorting.js"></script>

<script type="text/javascript">

    $(document).on("click", '.AirLine', function ($e) {
  			
        filter();
    } );
	
    $(document).on("click", '.onwardRadio', function ($e) {
  			
        $this=$(this);
			
        $airline=$this.parents('.FlightInfoBox').attr('data-airline');
        $airlinename=$this.parents('.FlightInfoBox').attr('data-airlinename');
        $price=$this.parents('.FlightInfoBox').attr('data-price');	
        $departure=$this.parents('.FlightInfoBox').attr('data-departure');	
        $arrival=$this.parents('.FlightInfoBox').attr('data-arrival');	
        $flightno=$this.parents('.FlightInfoBox').attr('data-flightno');
			
        $origin=$this.parents('.FlightInfoBox').attr('data-origin');
        $destination=$this.parents('.FlightInfoBox').attr('data-destination');
        $departdate=$this.parents('.FlightInfoBox').attr('data-departdate');
			
        $flightId=$this.parents('.FlightInfoBox').attr('data-flightid');
        $idval=$this.parents('.FlightInfoBox').attr('data-idval');
			
        $dtime = formatMinutes($departure);
        $atime = formatMinutes($arrival);
			
        //priceInfoOnward ='<span class="timing-logo-holder"><span style="float:left;"><img width="32" height="25" alt="'+$airlinename+'" src="http://www.cleartrip.com/images/logos/air-logos/'+$airline+'.png" /></span><span class="bottom-naming">'+$airline+'-'+$flightno+'</span></span>\n\<span class="spanOne"><span class="labelOne">'+$origin+'-'+$destination+' | '+$departdate+'</span><span class="timingSelection">'+$dtime+' - '+$atime+'</span><input type="hidden" name="onwardFlightId" value="'+$flightId+'" /><input type="hidden" name="onwardIdVal" value="'+$idval+'" /></span>';

        priceInfoOnward='<div class="col-md-3 air-logo"><img src="http://www.cleartrip.com/images/logos/air-logos/'+$airline+'.png" alt="'+$airlinename+'"><span class="font12">'+$airline+'-'+$flightno+'</span></div><div class="col-md-5 air-dep-time"><span class="font12">'+$origin+'-'+$destination+' | '+$departdate+'</span><span class="font12">'+$dtime+' - '+$atime+'<input type="hidden" name="onwardFlightId" value="'+$flightId+'" /><input type="hidden" name="onwardIdVal" value="'+$idval+'" /></span></div>';		   
        $(".priceInfoOnward").html(priceInfoOnward);
        $(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
    } );
	
    $(document).on("click", '.returnRadio', function ($e) {
  			
        $this=$(this);
		    			
        $airline=$this.parents('.FlightInfoBox').attr('data-airline');
        $airlinename=$this.parents('.FlightInfoBox').attr('data-airlinename');
        $price=$this.parents('.FlightInfoBox').attr('data-price');	
        $departure=$this.parents('.FlightInfoBox').attr('data-departure');	
        $arrival=$this.parents('.FlightInfoBox').attr('data-arrival');	
        $flightno=$this.parents('.FlightInfoBox').attr('data-flightno');
			
        $origin=$this.parents('.FlightInfoBox').attr('data-origin');
        $destination=$this.parents('.FlightInfoBox').attr('data-destination');
        $departdate=$this.parents('.FlightInfoBox').attr('data-departdate');
			
        $flightId=$this.parents('.FlightInfoBox').attr('data-flightid');
        $idval=$this.parents('.FlightInfoBox').attr('data-idval');
			
        $dtime = formatMinutes($departure);
        $atime = formatMinutes($arrival);
			
        //priceInfoReturn ='<span class="timing-logo-holder"><span style="float:left;"><img width="32" height="25" alt="'+$airlinename+'" src="http://www.cleartrip.com/images/logos/air-logos/'+$airline+'.png" /></span><span class="bottom-naming">'+$airline+'-'+$flightno+'</span></span><span class="spanOne"><span class="labelOne">'+$destination+'-'+$origin+' | '+$departdate+'</span><span class="timingSelection">'+$dtime+' - '+$atime+'</span><input type="hidden" name="returnFlightId" value="'+$flightId+'" /><input type="hidden" name="returnIdVal" value="'+$idval+'" /></span>';
        priceInfoReturn='<div class="col-md-3 air-logo"><img src="http://www.cleartrip.com/images/logos/air-logos/'+$airline+'.png" alt="'+$airlinename+'"><span class="font12">'+$airline+'-'+$flightno+'</span></div><div class="col-md-5 air-dep-time"><span class="font12">'+$destination+'-'+$origin+' | '+$departdate+'</span><span class="font12">'+$dtime+' - '+$atime+'<input type="hidden" name="returnFlightId" value="'+$flightId+'" /><input type="hidden" name="returnIdVal" value="'+$idval+'" /></span></div>';							    
        $(".priceInfoReturn").html(priceInfoReturn);
        $(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
			
			
    } );
	
	
    $(document).ready(function() 
    {
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
            }				
        }
       
        $(".AirLines").html(AirlineString);
		
        //show matrix
        matrix('onwardMatrix',1);
		
        matrix('returnMatrix',2);
				
        filterMatrix();
        showAllMatrix();
		
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
            if ($(this).scrollTop() >= scroller_anchor && $('.timingAmountResult, .m-s-search').css('position') != 'fixed') 
            {    
                $('.timingAmountResult, .m-s-search').css({
                    //'background': '#CCC',
                    'position': 'fixed',
                    'top': '0px'
                });
                //$('.scroller_anchor').css('height', '50px');
            } 
            else if ($(this).scrollTop() < scroller_anchor && $('.timingAmountResult, .m-s-search').css('position') != 'relative') 
            {    
                //$('.scroller_anchor').css('height', '0px');
                $('.timingAmountResult, .m-s-search').css({
                    'position': 'relative'
                });
            }
        });


        // Pricing Info Onward and Return
        $(".onwardRadio:first:visible").trigger("click");
        $(".returnRadio:first:visible").trigger("click");
        $(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
			
		
    });
	 
    function doTotal()
    {
        var TotalPriceOnSelection=0;
        TotalPriceOnSelection+=parseFloat($(".onwardRadio:checked").parents('.FlightInfoBox').attr('data-price'));
        TotalPriceOnSelection+=parseFloat($(".returnRadio:checked").parents('.FlightInfoBox').attr('data-price'));
        return TotalPriceOnSelection;
    }
	 
    function formatMinutes(minutes) 
    {
        function pad(n) 
        {
            return n > 9
                ? n
            : ("0" + n);
        }
		
        var hours = Math.floor(minutes / 60),
        mins = minutes % 60;
        return pad(hours) + ":" + pad(mins);
		
    }	
	
	
    // Filter Matrix

    function matrix(selector,way)
    {		
        $.ajax
        ({
            url:'<?php echo WEB_URL; ?>flight/rateMatrix/'+way,
            data: '',
            dataType: "json",		
            success: function(data)
            {	
                $("."+selector).html(data.matrix);
            }
        });
    }
  
    function filterMatrix()
    {
        $(document).on("click", '.showThisMatrixInfo', function ()
        {
            $data_price = parseFloat($(this).attr('data-price'));
            $data_time = parseInt($(this).attr('data-time'));		   
		    
            var flightCount=0;
            $(".FlightInfoBox").each(function()
            {
                $self = $(this);
                $dataprice = parseFloat($self.attr('data-price'));
                $datadeparture = parseInt($self.attr('data-departure'));
				
                if($data_price == $dataprice && $data_time == $datadeparture)
                {
                    flightCount++;					
                    $self.parents(".searchflight_box").show();
                }
                else
                {
                    $self.parents(".searchflight_box").hide();
                }
            });
			
            $("#flightCount").text(flightCount);
			
        });
    }
	    
    function showAllMatrix()
    {
        $(document).on("click", '.ShowAllMatrix', function ()	
        {
            var flightCount=0;
            $(".FlightInfoBox").each(function()
            {
                flightCount++;		
            });
            $("#flightCount").text(flightCount);
            $(".searchflight_box").show();
            $(".AirLine").attr("checked","checked");
			
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


