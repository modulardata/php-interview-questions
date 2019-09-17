<div class="searchCntr">                
    <!--Search tabs-->
    <div class="searchtabs">
        <ul>
            <li><a class="active" id="hotels">Domestic</a></li>
            <li><a  id="holidays">International</a></li>
        </ul>
    </div>
    <div class="searchContentCntr">
        <div class="tab_content" id="tab_content_hotels">

            <form action="<?php echo WEB_URL; ?>hoteld/hotel_search" method="post"> 

                <div class="searchpanel">
                    <div class="padder">
                        <div class="form-group">
                            <h3>Book Domestic Hotel Online</h3>
                            <div class="row">
                                <div class="col-md-6"><label for="inputCity">City</label></div>

                                <div class="col-md-6"><label for="inputCity">Nationality</label></div>

                                <div class="col-md-6">

                                    <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcityd" type="text" class="form-control" required /></div>

                                <div class="col-md-6">
                                    <select class="form-control" name="nationality" required title="Nationality">
                                        <option value="">Select Nationality</option>
                                        <?php foreach ($nationality as $val) { ?>
                                            <option value="<?php echo $val->code; ?>"><?php echo $val->country; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <span stlye="color:#FF0000;"><?php echo form_error('City'); ?></span>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label for="fromDate">Check in</label></div>
                            <div class="col-md-6"><label for="toDate">Check out</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                <input placeholder="CHECK IN" class="datePickerIcon form-control" id="datepicker"  name="checkin" readonly required />
                                <span stlye="color:#FF0000;"><?php echo form_error('checkin'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <input placeholder="CHECK OUT" class="datePickerIcon form-control" id="datepicker1"  name="checkout" readonly required />
                                <span stlye="color:#FF0000;"><?php echo form_error('checkout'); ?></span>
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
                <div class="searchBtncntr">
                    <div class="padder">
                        <div class="row">
                            <div class="col-md-12">
                                <span>Register for QuickBook &amp; get upto Rs.500 off on hotels !</span>
                                <button type="submit" class="btn btn-primary pull-right">SEARCH HOTELS</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
        <!--Search critiria for holidays-->
        <div class="tab_content" style="display: none" id="tab_content_holidays">
            <form action="<?php echo WEB_URL; ?>hotel/hotel_search" method="post"> 
                <!--Search critiria for hotel-->
                <div class="searchpanel">
                    <div class="padder">
                        <div class="form-group">
                            <h3>Book International Hotel Online</h3>
                            <div class="row">
                                <div class="col-md-6"><label for="inputCity">City</label></div>

                                <div class="col-md-6"><label for="inputCity">Nationality</label></div>

                                <div class="col-md-6"><input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcity" type="text" class="form-control" required /></div>

                                <div class="col-md-6"><select class="form-control" name="nationality" required title="Nationality">
                                        <option value="">Select Nationality</option>
                                        <?php foreach ($nationality as $val) { ?>
                                            <option value="<?php echo $val->code; ?>"><?php echo $val->country; ?></option>
                                        <?php } ?>
                                    </select></div>

                                <span stlye="color:#FF0000;"><?php echo form_error('City'); ?></span>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label for="fromDate">Check in</label></div>
                            <div class="col-md-6"><label for="toDate">Check out</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                <input placeholder="CHECK IN" class="datePickerIcon form-control" id="datepickerhdom"  name="checkin" readonly required />
                                <span stlye="color:#FF0000;"><?php echo form_error('checkin'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <input placeholder="CHECK OUT" class="datePickerIcon form-control" id="datepickerhdom1"  name="checkout" readonly required />
                                <span stlye="color:#FF0000;"><?php echo form_error('checkout'); ?></span>
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
                <div class="searchBtncntr">
                    <div class="padder">
                        <div class="row">
                            <div class="col-md-12">
                                <span>Register for QuickBook &amp; get upto Rs.500 off on hotels !</span>
                                <button type="submit" class="btn btn-primary pull-right">SEARCH HOTELS</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>