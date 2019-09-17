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
                                <input type="text" class="range-value" id="price-start">
                                <input type="text" class="range-value range-value-end" id="price-end">                           
                                <div id="price-range" class="slider-range"></div>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">Show only refundable fares</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Stops</h4>
                            <div class="flight-search-cntr stops">
                                <label>
                                    <input type="checkbox" checked value="1"> 1
                                </label>
                                <label>
                                    <input type="checkbox" checked value="2"> 2
                                </label>
                                <label>
                                    <input type="checkbox" checked value="3"> 3
                                </label>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Airlines</h4>
                            <div class="flight-search-cntr airlines">
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">Air France</span>
                                </label>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">Air India</span>
                                </label>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">British Airways</span>
                                </label>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">Emirates</span>
                                </label>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">Go Air</span>
                                </label>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">IndiGo</span>
                                </label>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">Jet Airways</span>
                                </label>
                                <label>
                                    <input type="checkbox">
                                    <span class="airlines-name">Malaysia Airlines</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Departure time</h4>
                            <div class="flight-search-cntr">
                                <input type="text" class="range-value" id="time-start">
                                <input type="text" class="range-value range-value-end" id="time-end">                           
                                <div id="time-range" class="slider-range"></div>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Trip duration</h4>
                            <div class="flight-search-cntr">
                                <input type="text" class="range-value " id="dur-start">
                                <input type="text" class="range-value range-value-end" id="dur-end">                           
                                <div id="dur-range" class="slider-range"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="flightResultsCntr">
                    <!-- this row will repeat based on hotels availability -->
                    <div class="dtlsOffer"><i class="fa fa-tags"></i> FLIGHTS FLASH SALE ! Use HOT DEAL and Get Flat 25% Off on this flight booking. <a href="#" class="knwmoreoffrBtn">Know More</a></div>
                    <div class="fligh-results-row" id="international-roundtrip">
                        <div class="resultTripType">
                            <span class="result-date-range pull-right">
                                <a href="#" class="date">Previous day</a>
                                <a href="#" class="date">Next day</a>
                            </span>
                        </div>
                        <div class="row header">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3">Airlines <i class="fa fa-arrow-down"></i></div>
                                    <div class="col-md-3">Depart <i class="fa fa-arrow-down"></i></div>
                                    <div class="col-md-3">Duration <i class="fa fa-arrow-down"></i></div>
                                    <div class="col-md-3">Arrive <i class="fa fa-arrow-down"></i></div>
                                </div>
                            </div>
                            <div class="col-md-2">Price <i class="fa fa-arrow-down"></i></div>
                        </div>

                        <!-- flight result row -->

                        <?php if (!empty($result)) { ?>
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

                                $totalPriceAry[] = $result[$i]->TotalFare;
                                ?>

                                <div class="results-row">
                                    <div class="row onway">
                                        <div class="col-md-10">
                                            <div class="row" id="oneway-trip">
                                                <div class="col-md-3 air-logo">
                                                    <img src="img/flights/flight-logo.png" alt="flight logo">
                                                    <span class="font12">Air India</span>
                                                </div>
                                                <div class="col-md-3 air-dep-time">
                                                    06:15 →
                                                    <span class="font12">Bangalore</span>
                                                </div>
                                                <div class="col-md-3 air-dur">
                                                    <i class="fa fa-clock-o"></i> 21h 45m
                                                    <span class="font12 flightStops"> DOH → MXP →</span>
                                                    <span class="font12">2 stops</span>
                                                </div>
                                                <div class="col-md-3 air-arv-time">
                                                    09:30<span class="result-arrival-date">(28 Dec)</span>
                                                    <span class="font12">Delhi</span>
                                                </div>
                                            </div>
                                            <div class="row" id="return-trip">
                                                <div class="col-md-3 air-logo">
                                                    <img src="img/flights/flight-logo.png" alt="flight logo">
                                                    <span class="font12">Air India</span>
                                                </div>
                                                <div class="col-md-3 air-dep-time">
                                                    06:15 →
                                                    <span class="font12">Bangalore</span>
                                                </div>
                                                <div class="col-md-3 air-dur">
                                                    <i class="fa fa-clock-o"></i> 21h 45m
                                                    <span class="font12 flightStops"> DOH → MXP →</span>
                                                    <span class="font12">2 stops</span>
                                                </div>
                                                <div class="col-md-3 air-arv-time">
                                                    09:30<span class="result-arrival-date">(28 Dec)</span>
                                                    <span class="font12">Delhi</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 air-price">
                                            <i class="fa fa-rupee"></i> 41,324
                                            <button class="btn btn-success">BOOK <i class="fa fa-angle-double-right"></i></button>
                                            <span class="open-flight-details"><i class="fa fa-arrow-down"></i> DETAILS </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="flight-details-Cntr verySoftShadow">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Bangalore to Kolkata - 5h 15m <span class="flt-criteria"> ( Mon Dec 30 2013  )</span>
                                                    <span class="fareCntr">
                                                        <a href="#" data-toggle="dropdown"> <i class="fa fa-money"></i> Fare breakup</a> | 
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
                                                        </div>
                                                    </span>
                                                    <div class="selected-flight-dtls" id="dtls-onward">
                                                        <h4>Onward trip</h4>
                                                        <div class="row detailed-row">
                                                            <div class="col-md-12 flight-vendor">
                                                                <div class="airlinelogo pull-left">
                                                                    <img src="img/flights/flight-logo.png" alt="flight logo">
                                                                    <span>JetKonnect | 9W-K-2366 | Economy</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 start-airport">
                                                                <span class="start-time"><span>Bangalore</span> 21:30</span>
                                                                <span class="start-date">27 Dec 13</span>
                                                                <span class="start-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                            <div class="col-md-2 flt-dur-cntr">
                                                                <span class="dur-clock"><i class="fa fa-clock-o"></i></span>
                                                                <span class="flight-dur">1h 45m <span class="font12">Economy - Non-refundable</span></span>
                                                            </div>
                                                            <div class="col-md-5 end-airport">
                                                                <span class="end-time"><span>Chennai</span> 21:30</span>
                                                                <span class="end-date">27 Dec 13</span>
                                                                <span class="end-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                        </div>
                                                        <div class="layover "><span>Layover:<span class="layover-dur">1h 45m</span></span></div>
                                                        <div class="row detailed-row">
                                                            <div class="col-md-12 flight-vendor">
                                                                <div class="airlinelogo pull-left">
                                                                    <img src="img/flights/flight-logo.png" alt="flight logo">
                                                                    <span>JetKonnect | 9W-K-2366 | Economy</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 start-airport">
                                                                <span class="start-time"><span>Chennai</span> 21:30</span>
                                                                <span class="start-date">27 Dec 13</span>
                                                                <span class="start-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                            <div class="col-md-2 flt-dur-cntr">
                                                                <span class="dur-clock"><i class="fa fa-clock-o"></i></span>
                                                                <span class="flight-dur">1h 45m <span class="font12">Economy - Non-refundable</span></span>
                                                            </div>
                                                            <div class="col-md-5 end-airport">
                                                                <span class="end-time"><span>Kolkatta</span> 21:30</span>
                                                                <span class="end-date">27 Dec 13</span>
                                                                <span class="end-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                        </div>                                            
                                                    </div>
                                                    <div class="selected-flight-dtls" id="dtls-return">
                                                        <h4>Return trip</h4>
                                                        <div class="row detailed-row">
                                                            <div class="col-md-12 flight-vendor">
                                                                <div class="airlinelogo pull-left">
                                                                    <img src="img/flights/flight-logo.png" alt="flight logo">
                                                                    <span>JetKonnect | 9W-K-2366 | Economy</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 start-airport">
                                                                <span class="start-time"><span>Bangalore</span> 21:30</span>
                                                                <span class="start-date">27 Dec 13</span>
                                                                <span class="start-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                            <div class="col-md-2 flt-dur-cntr">
                                                                <span class="dur-clock"><i class="fa fa-clock-o"></i></span>
                                                                <span class="flight-dur">1h 45m</span>
                                                            </div>
                                                            <div class="col-md-5 end-airport">
                                                                <span class="end-time"><span>Chennai</span> 21:30</span>
                                                                <span class="end-date">27 Dec 13</span>
                                                                <span class="end-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                        </div>
                                                        <div class="layover "><span>Layover:<span class="layover-dur">1h 45m</span></span></div>
                                                        <div class="row detailed-row">
                                                            <div class="col-md-12 flight-vendor">
                                                                <div class="airlinelogo pull-left">
                                                                    <img src="img/flights/flight-logo.png" alt="flight logo">
                                                                    <span>JetKonnect | 9W-K-2366 | Economy</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 start-airport">
                                                                <span class="start-time"><span>Chennai</span> 21:30</span>
                                                                <span class="start-date">27 Dec 13</span>
                                                                <span class="start-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                            <div class="col-md-2 flt-dur-cntr">
                                                                <span class="dur-clock"><i class="fa fa-clock-o"></i></span>
                                                                <span class="flight-dur">1h 45m <span class="font12">Economy - Non-refundable</span></span>
                                                            </div>
                                                            <div class="col-md-5 end-airport">
                                                                <span class="end-time"><span>Kolkatta</span> 21:30</span>
                                                                <span class="end-date">27 Dec 13</span>
                                                                <span class="end-loc">Bengaluru International Airport, Bangalore</span>
                                                            </div>
                                                        </div>                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

    <?php } ?>   


<?php }else { ?>
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
</div>


<?php echo $this->load->view('home/footer'); ?>

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/filter.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/sorting.js"></script>

<script type="text/javascript">

    $(document).on("click", '.AirLine', function ($e) {
  			
        filter();
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
                AirlineString+='<div class="leftLabels"><span><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked"> </span><label>'+airlineName+'</label></div>';
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