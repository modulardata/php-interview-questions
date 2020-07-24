<div class="col-md-12">
    <div class="search-criteria"><strong>Location:</strong> 
        <?php
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $room_datasess = $this->session->userdata('room_data');
        echo $hotel_search_data['city'];
        ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Check In: <?php echo $hotel_search_data['checkin']; ?> - Check Out: <?php echo $hotel_search_data['checkout']; ?>
                     <!--<span class="flt-criteria"> ( Fri, 27 Dec | <span id="flt-adult">1 adult</span> | <span id="flt-children">1 Children</span> )</span>--> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span> <span class="result-date-range pull-right"> <!--<span>DATES: </span> <a href="#" class="date">JAN 29</a> <a href="#" class="date">JAN 30</a> <a href="#" class="date active">JAN 31</a> <a href="#" class="date">FEB 1</a> <a href="#" class="date">FEB 2</a> </span> --></div>
    <div class="modify-search"> <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
        <div class="row">
            <div class="col-md-7">
                <form role="form">
                    <!--Search critiria for Hotels-->
                    <div class="searchpanel">
                        <div class="padder">
                            <div id="flight-search">
                                <h3>Modify your Search</h3>

                                <div id="O-R-Trip">
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <label for="inputCity">Location</label>
                                            <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcity" type="text" class="form-control" required />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputCity">Check in</label>
                                            <input placeholder="CHECK IN" class="datePickerIcon form-control" id="datepicker"  name="checkin" readonly required />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputCity">Check out</label>
                                            <input placeholder="CHECK OUT" class="datePickerIcon form-control" id="datepicker1"  name="checkout" readonly required />
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="searchBtncntr marginTop5">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">SEARCH HOTELS <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

