<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<!-----  Top destination content ----->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">

            <div class="col-md-4">


                <h2 class="agentHdng">Account information</h2>
                <div class="white-container padding20">
                    <table class="table noBorder">
                        <tr>
                            <td>Available Balance</td>
                            <td width="5">:</td>
                            <td> <?php echo $agent_info->closing_balance ?> </td>
                        </tr>
                        <tr>
                            <td>Total Deposits</td>
                            <td width="5">:</td>
                            <td><?php echo $agent_info->debited_balance ?> </td>
                        </tr>
                        <tr>
                            <td>Total Withdraws</td>
                            <td width="5">:</td>
                            <td><?php echo $agent_info->credited_balance ?> </td>
                        </tr>
                    </table>
                </div>  

                <h2 class="agentHdng">Notice Board</h2>
                <div class="white-container padding20">

                    <h3>Notice</h3>
                </div>       

            </div>

            <div class="col-md-8">        


                <div class="searchCntr agent">                
                    <!--Search tabs-->
                    <div class="searchtabs">
                        <ul>
                            <li><a id="flights">Flights</a></li>
                            <li><a id="hotels">Hotels</a></li>
                            <li><a class="active" id="bus">Bus</a></li>
                            <li><a id="holidays">Holidays</a></li>
                        </ul>
                    </div>
                    <div class="searchContentCntr">
                        <!--Search critiria for Flights-->
                        <div class="tab_content" id="tab_content_flights" style="display:none;">
                            <div class="searchtabs1">
                                <ul>
                                    <li><a class="active" id="domestic">Domestic</a></li>
                                    <li><a id="international">International</a></li>                              
                                </ul>
                            </div>
                            <div class="tab_content1" id="tab_content_domestic">
                                <form id="searchForm_dom" method="POST" action="<?php echo WEB_URL; ?>flight/flight_search" name="searchForm_dom">
                                    <!--Search critiria for flights-->
                                    <div class="searchpanel">
                                        <div class="padder">
                                            <div class="form-group">
                                                <!--                                                <h3>Book Flights Online</h3>-->
                                                <div class="row">
                                                    <div class="col-md-10 duration" style="padding:10px 15px;">
                                                        <label><input type="radio" value="S"  name="tripType" autocomplete="off" checked>One way</label>
                                                        <label><input type="radio" value="R" name="tripType" autocomplete="off">Round Trip</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="inputCity">From City</label>
                                                        <input title="Type City Name or Airport Code" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="Type City Name or Airport Code" name="originCity" id="originCity" type="text" class="form-control" required />
                                                        <input id="originCode" type="hidden" name="orginCode" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputCity">To City</label>
                                                        <input title="Type City Name or Airport Code" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="Type City Name or Airport Code" name="destinationCity" id="destinationCity" type="text" class="form-control" class="ac_input" required />
                                                        <input id="destinationCode" type="hidden" name="destinationCode" />
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                    <label for="fromDate">Date of Journey</label>
                                                    <input placeholder="Departure Date" class="datePickerIcon form-control" id="datepickerfdom"  name="departDate" readonly required />
                                                    <input id="date_depart" type="hidden" value="<?php echo date('d/m/Y'); ?>" />
                                                </div>
                                                <div class="col-md-6 form-group" id="dpf2Cntr">
                                                    <label for="toDate">Date of Return (Optional)</label>
                                                    <input placeholder="Return Date" class="datePickerIcon form-control" id="datepickerfdom1" name="returnDate" readonly required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Adult(12+)</label>
                                                    <select class="form-control"id="adults" name="adults">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Child(2-12)</label>
                                                    <select class="form-control" id="childs" name="childs">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option> 
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Infant(0-2)</label>
                                                    <select class="form-control" id="infants" name="infants">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Rooms</label>
                                                    <select class="form-control" id="cabinClass" name="cabinClass">
                                                        <option value="Economy">Economy</option>
                                                        <option value="Business">Business</option>  
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="searchBtncntr">
                                        <div class="padder">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">SEARCH FLIGHTS</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                            <div class="tab_content1" id="tab_content_international" style="display:none;">
                                <form id="searchForm_int" method="POST" action="<?php echo WEB_URL; ?>flight/flight_int_search" name="searchForm_int">
                                    <!--Search critiria for flights-->
                                    <div class="searchpanel">
                                        <div class="padder">
                                            <div class="form-group">
                                                <!--                                                <h3>Book Flights Online</h3>-->
                                                <div class="row">
                                                    <div class="col-md-10 duration" style="padding:10px 15px;">
                                                        <label><input type="radio" value="S"  name="tripTypeInt" autocomplete="off" checked>One way</label>
                                                        <label><input type="radio" value="R" name="tripTypeInt" autocomplete="off">Round Trip</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="inputCity">From City</label>
                                                        <input title="Type City Name or Airport Code" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="Type City Name or Airport Code" name="originCityInt" id="originCityInt" type="text" class="form-control" required  />
                                                        <input id="originCodeInt" type="hidden" name="originCodeInt" />                                                    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputCity">To City</label>
                                                        <input title="Type City Name or Airport Code" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="Type City Name or Airport Code" name="destinationCityInt" id="destinationCityInt" type="text" class="form-control" required/>
                                                        <input id="destinationCodeInt" type="hidden" name="destinationCodeInt" />

                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                    <label for="fromDate">Date of Journey</label>
                                                    <input placeholder="Departure Date" class="datePickerIcon form-control" id="datepickerfint"  name="departDateInt" readonly required />
                                                    <input id="date_depart_int" type="hidden" value="<?php echo date('d/m/Y'); ?>" />

                                                </div>
                                                <div class="col-md-6 form-group" id="dpf2Cntrint">
                                                    <label for="toDate">Date of Return (Optional)</label>
                                                    <input placeholder="Return Date" class="datePickerIcon form-control" id="datepickerfint1" name="returnDateInt" readonly required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Adult(12+)</label>
                                                    <select class="form-control"id="adultsInt" name="adultsInt">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Child(2-12)</label>
                                                    <select class="form-control" id="childsInt" name="childsInt">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option> 
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Infant(0-2)</label>
                                                    <select class="form-control" id="infantsInt" name="infantsInt">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Rooms</label>
                                                    <select class="form-control" id="cabinClassInt" name="cabinClassInt">
                                                        <option value="Economy">Economy</option>
                                                        <option value="Business">Business</option> 
                                                        <option value="First">First Class</option> 
                                                        <option value="Special">Premium Economy</option> 
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="searchBtncntr">
                                        <div class="padder">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">SEARCH FLIGHTS</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            </div>

                        </div>

                        <!--Search critiria for Hotels-->
                        <div class="tab_content" id="tab_content_hotels" style="display:none;">
                            <div class="searchtabs2">
                                <ul>
                                    <li><a class="active" id="domestic2">Domestic</a></li>
                                    <li><a id="international2">International</a></li>                              
                                </ul>
                            </div>
                            <div class="tab_content2" id="tab_content2_domestic2">
                                <form action="<?php echo WEB_URL; ?>hoteld/hotel_search" method="post">
                                    <!--Search critiria for hotel-->
                                    <div class="searchpanel">
                                        <div class="padder">
                                            <!--                                            <div class="form-group">-->
                                            <!--                                                <h3>Book Hotel Online</h3>-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="inputCity">Location</label>
                                                    <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION IN INDIA" name="City" id="hotelcitydom" type="text" class="form-control" required />
<!--                                                    <input type="text" class="form-control" val="" id="hotelcity" placeholder="Enter a City">-->
                                                </div>
                                                <!--                                                <div class="col-md-6">
                                                                                                    <label for="inputCity">To City</label>
                                                                                                    <input type="text" class="form-control" id="inputFromCity" placeholder="Enter a City">
                                                                                                </div>-->
                                            </div>  
                                            <!--                                            </div>-->
                                            <div class="row">
                                                <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                    <label for="fromDate">Check-in</label>
                                                    <input type="text" class="form-control datePickerIcon" placeholder="From Date" name="checkin" id="datepickerhdom" autocomplete= "off">
                                                    <input id="date_depart" type="hidden" value="<?php echo date('d/m/Y'); ?>" />  
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="toDate">Check-out</label>
                                                    <input type="text" class="form-control datePickerIcon" placeholder="To Date"  name="checkout" id="datepickerhdom1" autocomplete= "off">
                                                </div>
                                            </div>
                                            <div class="row" id="room1">
                                                <div class="col-md-2 htl-rooms">
                                                    <label>Rooms</label>
                                                    <select class="form-control" id="rooms" name="room_count">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <!--                                                    <option value="4">4</option>-->
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-adults" >
                                                    <label>Adults (12+)</label>
                                                    <select class="form-control" name="adult[]">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-selectChild">
                                                    <label>Child(0-12)</label>
                                                    <select class="form-control selectchildAge" id="slect-room1ChildAge" name="child[]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge1" id="htl-child1Age-room1">
                                                    <label>Child 1 Age</label>
                                                    <select class="form-control" name="childage_1_1">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room1">
                                                    <label>Child 2 Age</label>
                                                    <select class="form-control" name="childage_1_2">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room1">
                                                    <label>Child 3 Age</label>
                                                    <select class="form-control" name="childage_1_3">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="room2">
                                                <div class="col-md-2 htl-rooms"><span>Room 2</span></div>
                                                <div class="col-md-2 htl-adults" >
                                                    <label>Adults (12+)</label>
                                                    <select class="form-control" name="adult[]">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-selectChild">
                                                    <label>Child(0-12)</label>
                                                    <select class="form-control selectchildAge" id="slect-room2ChildAge" name="child[]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room2">
                                                    <label>Child 1 Age</label>
                                                    <select class="form-control" name="childage_2_1">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room2">
                                                    <label>Child 2 Age</label>
                                                    <select class="form-control" name="childage_2_2">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room2">
                                                    <label>Child 3 Age</label>
                                                    <select class="form-control" name="childage_2_3">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="room3">
                                                <div class="col-md-2 htl-rooms"><span>Room 3</span></div>
                                                <div class="col-md-2 htl-adults" >
                                                    <label>Adults (12+)</label>
                                                    <select class="form-control" name="adult[]">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-selectChild">
                                                    <label>Child(0-12)</label>
                                                    <select class="form-control selectchildAge" id="slect-room3ChildAge" name="child[]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room3">
                                                    <label>Child 1 Age</label>
                                                    <select class="form-control" name="childage_3_1">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room3">
                                                    <label>Child 2 Age</label>
                                                    <select class="form-control" name="childage_3_2">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room3">
                                                    <label>Child 3 Age</label>
                                                    <select class="form-control" name="childage_3_3">

                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- room 4 not required -->
                                            <!--                                        <div class="row" id="room4">
                                                                                        <div class="col-md-2 htl-rooms"><span>Room 4</span></div>
                                                                                        <div class="col-md-2 htl-adults" >
                                                                                            <label>Adults (12+)</label>
                                                                                            <select class="form-control">
                                                                                                <option value="1" selected>1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>
                                                                                                <option value="4">4</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-selectChild">
                                                                                            <label>Child(0-12)</label>
                                                                                            <select class="form-control selectchildAge" id="slect-room4ChildAge">
                                                                                                <option value="0" selected>0</option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room4">
                                                                                            <label>Child 1 Age</label>
                                                                                            <select class="form-control">
                                                                                                <option value=""></option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>        
                                                                                                <option value="4">4</option>
                                                                                                <option value="5">5</option>
                                                                                                <option value="5">6</option>
                                                                                                <option value="5">7</option>
                                                                                                <option value="5">8</option>
                                                                                                <option value="5">9</option>
                                                                                                <option value="5">10</option>
                                                                                                <option value="5">11</option>
                                                                                                <option value="5">12</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room4">
                                                                                            <label>Child 2 Age</label>
                                                                                            <select class="form-control">
                                                                                                <option value=""></option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>        
                                                                                                <option value="4">4</option>
                                                                                                <option value="5">5</option>
                                                                                                <option value="5">6</option>
                                                                                                <option value="5">7</option>
                                                                                                <option value="5">8</option>
                                                                                                <option value="5">9</option>
                                                                                                <option value="5">10</option>
                                                                                                <option value="5">11</option>
                                                                                                <option value="5">12</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room4">
                                                                                            <label>Child 3 Age</label>
                                                                                            <select class="form-control">
                                                                                                <option value=""></option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>        
                                                                                                <option value="4">4</option>
                                                                                                <option value="5">5</option>
                                                                                                <option value="5">6</option>
                                                                                                <option value="5">7</option>
                                                                                                <option value="5">8</option>
                                                                                                <option value="5">9</option>
                                                                                                <option value="5">10</option>
                                                                                                <option value="5">11</option>
                                                                                                <option value="5">12</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>-->
                                            <!-- room 4 not required -->
                                        </div>
                                    </div>
                                    <div class="searchBtncntr">
                                        <div class="padder">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">SEARCH HOTELS</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab_content2" id="tab_content2_international2" style="display:none;">
                                <form action="<?php echo WEB_URL; ?>hotel/hotel_search" method="post">
                                    <!--Search critiria for hotel-->
                                    <div class="searchpanel">
                                        <div class="padder">


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="inputCity">Location</label>
                                                    <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcity" type="text" class="form-control" required />
<!--                                                    <input type="text" class="form-control" val="" id="hotelcity" placeholder="Enter a City">-->
                                                </div>
                                                <!--                                                <div class="col-md-6">
                                                                                                    <label for="inputCity">To City</label>
                                                                                                    <input type="text" class="form-control" id="inputFromCity" placeholder="Enter a City">
                                                                                                </div>-->
                                            </div>  

                                            <div class="row">
                                                <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                    <label for="fromDate">Check-in</label>
                                                    <input type="text" class="form-control datePickerIcon" placeholder="From Date" name="checkin" id="datepicker" autocomplete= "off">
                                                    <input id="date_depart" type="hidden" value="<?php echo date('d/m/Y'); ?>" />  
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="toDate">Check-out</label>
                                                    <input type="text" class="form-control datePickerIcon" placeholder="To Date"  name="checkout" id="datepicker1" autocomplete= "off">
                                                </div>
                                            </div>
                                            <div class="row" id="room1">
                                                <div class="col-md-2 htl-rooms">
                                                    <label>Rooms</label>
                                                    <select class="form-control" id="rooms" name="room_count">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <!--                                                    <option value="4">4</option>-->
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-adults" >
                                                    <label>Adults (12+)</label>
                                                    <select class="form-control" name="adult[]">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-selectChild">
                                                    <label>Child(0-12)</label>
                                                    <select class="form-control selectchildAge" id="slect-room1ChildAge" name="child[]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge1" id="htl-child1Age-room1">
                                                    <label>Child 1 Age</label>
                                                    <select class="form-control" name="childage_1_1">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room1">
                                                    <label>Child 2 Age</label>
                                                    <select class="form-control" name="childage_1_2">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room1">
                                                    <label>Child 3 Age</label>
                                                    <select class="form-control" name="childage_1_3">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="room2">
                                                <div class="col-md-2 htl-rooms"><span>Room 2</span></div>
                                                <div class="col-md-2 htl-adults" >
                                                    <label>Adults (12+)</label>
                                                    <select class="form-control" name="adult[]">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-selectChild">
                                                    <label>Child(0-12)</label>
                                                    <select class="form-control selectchildAge" id="slect-room2ChildAge" name="child[]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room2">
                                                    <label>Child 1 Age</label>
                                                    <select class="form-control" name="childage_2_1">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room2">
                                                    <label>Child 2 Age</label>
                                                    <select class="form-control" name="childage_2_2">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room2">
                                                    <label>Child 3 Age</label>
                                                    <select class="form-control" name="childage_2_3">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="room3">
                                                <div class="col-md-2 htl-rooms"><span>Room 3</span></div>
                                                <div class="col-md-2 htl-adults" >
                                                    <label>Adults (12+)</label>
                                                    <select class="form-control" name="adult[]">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-selectChild">
                                                    <label>Child(0-12)</label>
                                                    <select class="form-control selectchildAge" id="slect-room3ChildAge" name="child[]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room3">
                                                    <label>Child 1 Age</label>
                                                    <select class="form-control" name="childage_3_1">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room3">
                                                    <label>Child 2 Age</label>
                                                    <select class="form-control" name="childage_3_2">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room3">
                                                    <label>Child 3 Age</label>
                                                    <select class="form-control" name="childage_3_3">

                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>        
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- room 4 not required -->
                                            <!--                                        <div class="row" id="room4">
                                                                                        <div class="col-md-2 htl-rooms"><span>Room 4</span></div>
                                                                                        <div class="col-md-2 htl-adults" >
                                                                                            <label>Adults (12+)</label>
                                                                                            <select class="form-control">
                                                                                                <option value="1" selected>1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>
                                                                                                <option value="4">4</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-selectChild">
                                                                                            <label>Child(0-12)</label>
                                                                                            <select class="form-control selectchildAge" id="slect-room4ChildAge">
                                                                                                <option value="0" selected>0</option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room4">
                                                                                            <label>Child 1 Age</label>
                                                                                            <select class="form-control">
                                                                                                <option value=""></option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>        
                                                                                                <option value="4">4</option>
                                                                                                <option value="5">5</option>
                                                                                                <option value="5">6</option>
                                                                                                <option value="5">7</option>
                                                                                                <option value="5">8</option>
                                                                                                <option value="5">9</option>
                                                                                                <option value="5">10</option>
                                                                                                <option value="5">11</option>
                                                                                                <option value="5">12</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room4">
                                                                                            <label>Child 2 Age</label>
                                                                                            <select class="form-control">
                                                                                                <option value=""></option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>        
                                                                                                <option value="4">4</option>
                                                                                                <option value="5">5</option>
                                                                                                <option value="5">6</option>
                                                                                                <option value="5">7</option>
                                                                                                <option value="5">8</option>
                                                                                                <option value="5">9</option>
                                                                                                <option value="5">10</option>
                                                                                                <option value="5">11</option>
                                                                                                <option value="5">12</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room4">
                                                                                            <label>Child 3 Age</label>
                                                                                            <select class="form-control">
                                                                                                <option value=""></option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>        
                                                                                                <option value="4">4</option>
                                                                                                <option value="5">5</option>
                                                                                                <option value="5">6</option>
                                                                                                <option value="5">7</option>
                                                                                                <option value="5">8</option>
                                                                                                <option value="5">9</option>
                                                                                                <option value="5">10</option>
                                                                                                <option value="5">11</option>
                                                                                                <option value="5">12</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>-->
                                            <!-- room 4 not required -->
                                        </div>
                                    </div>
                                    <div class="searchBtncntr">
                                        <div class="padder">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">SEARCH HOTELS</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--Search critiria for Bus-->
                        <div class="tab_content" id="tab_content_bus">
                            <form action="<?php echo WEB_URL; ?>bus/bus_search" method="post">
                                <!--Search critiria for bus-->
                                <div class="searchpanel">
                                    <div class="padder">
                                        <div class="form-group">
                                            <h3>Online Bus Tickets</h3>
                                            <div class="row">
                                                <div class="col-md-10 duration" style="padding:10px 15px;">
                                                    <label><input type="radio" name="bustrip" value="oneway" checked>One way</label>
                                                    <label><input type="radio" name="bustrip" value="roundtrip">Round Trip</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="inputCity">From City</label>
                                                    <span>
                                                        <input title="Type From City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="Type From City Name" name="bus_source" id="bus_source" type="text" class="form-control" required  />
<!--                                                        <select class="form-control" name="bus_source" id="bus_source">
                                                        <?php //echo $source_list; ?>
                                                        </select>-->
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputCity">To City</label>                                                   
                                                    <input title="Type TO City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="Type To City Name" name="bus_destination" id="bus_destination" type="text" class="form-control" required />
<!--                                                    <span id="bus_destination">
                                                        <select class="form-control" name="bus_destination">
                                                            <option value="0">Please select From City</option>                                                          
                                                        </select>
                                                    </span> -->                                                   
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                <label for="fromDate">Date of Journey</label>
                                                <input type="text" class="form-control" placeholder="From Date"  name="from_date" id="datepickerb" autocomplete= "off" required readonly>
                                            </div>
                                            <div class="col-md-6 form-group" id="dpb2Cntr">
                                                <label for="toDate">Date of Return (Optional)</label>
                                                <input type="text" class="form-control" placeholder="To Date" name="to_date" id="datepickerb1" autocomplete= "off" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBtncntr">
                                    <div class="padder">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary">SEARCH BUSES</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <!--Search critiria for holidays-->
                        <div class="tab_content" style="display:none;" id="tab_content_holidays">
                            <form role="form">
                                <!--Search critiria for hotel-->
                                <div class="searchpanel">
                                    <div class="padder">
                                        <div class="form-group">
                                            <h3>Holiday Packages</h3>
                                            <div class="row" style="margin-top:30px;">
                                                <div class="col-md-2"><label for="inputDuration">Duration : </label></div>
                                                <div class="col-md-10 duration">
                                                    <label><input type="radio" value="any" name="hol_duration" checked>Any</label>
                                                    <label><input type="radio" value="1-3" name="hol_duration">1 - 3 Nights</label>
                                                    <label><input type="radio" value="any" name="hol_duration">4 - 7 Nights</label>
                                                    <label><input type="radio" value="any" name="hol_duration">7+ Nights</label>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-2"><label for="fromDate">When ?</label></div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" placeholder="From Date" id="dphd" autocomplete= "off">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-5">
                                                <div>Search by Themes (optional)</div>
                                                <select class="form-control">
                                                    <option value="All" selected>All</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5" >
                                                <div>Search by Destination (optional)</div>
                                                <select class="form-control">
                                                    <option value="All" selected>All</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBtncntr">
                                    <div class="padder">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">SEARCH HOLIDAY</button>
                                            </div>
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
<?php echo $this->load->view('home/footer'); ?>

<script>
    function mycarousel_initCallback(carousel)
    {
        // Disable autoscrolling if the user clicks the prev or next button.
        carousel.buttonNext.bind('click', function() {
            carousel.startAuto();
        });
	
        carousel.buttonPrev.bind('click', function() {
            carousel.startAuto();
        });
	
        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function() {
            carousel.stopAuto();
        }, function() {
            carousel.startAuto();
        });
    };
    $(function(){
        $('.scrollCntr').niceScroll();
        jQuery('#mycarousel').jcarousel({
            auto: 3,
            wrap: 'last',
            scroll: 1,
            initCallback: mycarousel_initCallback
        });

        jQuery('#mycarousel2').jcarousel({
            auto: 4,
            wrap: 'last',
            scroll: 1,
            initCallback: mycarousel_initCallback
        });
			
        //tabs
        $(".searchtabs > ul > li > a").click(function(e) {
            var activeTab = "#" + e.target.id;
            var activeTabContent = "#tab_content_" + activeTab.substring(1, activeTab.length);
	
            $(".tab_content").css("display", "none");
            $(activeTabContent).css("display", "block");
            $(".searchtabs > ul > li a").removeClass("active");
            $(activeTab).addClass("active");
            return false;
        });
			
        $('.searchBtn, .sbtn').click(function(e){
            $('.top-search-drop').slideToggle('fast');
        });
			
        $('.menuBtn').click(function(e){
            $('.top-menu-drop').slideToggle('fast');
        });
        $('body').click(function(e){
            if(!$(event.target).hasClass('acm'))
                $('.top-menu-drop').slideUp('fast');
        });
        $('body').click(function(e){
            if(!$(event.target).hasClass('acs'))
                $('.top-search-drop').slideUp('fast');
        });
			
        $("input[name='bus']").change(function(){
            $('#dpb2Cntr').slideToggle(0);
        });
        $("input[name='flights']").change(function(){
            $('#dpf2Cntr').slideToggle(0);
        });			
			
		
</script>
<!-- footer  -->
<?php //echo $this->load->view('home/footer'); ?>
<!-- Datepicket Script-->
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/datepickerScript.js"></script>

<!-- Airport AutoComplete List-->
<!--<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR ?>public/css/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript"> 
        $(function() {	
            // hotel city
            $("#hotelcity").autocomplete({
                source: "<?php echo WEB_URL; ?>home/hotel_autolist",
                minLength: 2,
                autoFocus: true
            });
            // hotel city domestic
            $("#hotelcitydom").autocomplete({
                source: "<?php echo WEB_URL; ?>home/hotel_autolist_dom",
                minLength: 2,
                autoFocus: true
            });
        });
    
        //Domestic Airport List 
        $("#originCity,#destinationCity").autocomplete({
            source: "<?php echo WEB_URL; ?>home/domestic_airport_autolist",
            minLength: 2,
            autoFocus: true
        });	
	
        //International Airport List 
        $("#originCityInt,#destinationCityInt").autocomplete({
            source: "<?php echo WEB_URL; ?>home/international_airport_autolist",
            minLength: 2,
            autoFocus: true
        });	

        //    $("#bus_source").change(function(){
        //        $("#bus_destination").html('<br><Blink><font color="red">Please wait</font></Blink>');
        //        var id=$("#bus_source").val();
        //        $.ajax({url:"<?php echo WEB_URL; ?>home/getdestination/"+id+"",
        //            success:function(result){
        //                $("#bus_destination").html(result);
        //            }});
        //    });
    
        //Bus source list 
        $("#bus_source").autocomplete({
            source: "<?php echo WEB_URL; ?>home/bus_source_autolist",
            minLength: 2,
            autoFocus: true
        });	
	
        //Bus destination list
        $("#bus_destination").autocomplete({
            source: "<?php echo base_url(); ?>index.php/home/bus_desti_list",
            minLength: 2,
            autoFocus: true
        });	
</script>

