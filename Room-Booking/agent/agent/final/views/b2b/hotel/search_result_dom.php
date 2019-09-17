<?php echo $this->load->view('home/header'); ?>

<link href="<?php echo WEB_DIR; ?>public/hotel/css/jquery-ui.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR; ?>public/hotel/css/jquery-ui-overwrite.css">
<!-----  Top destination content ----->
<div class="selectBusCntr">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-criteria">
                                <span class="htl-loc"><?php
$hotel_search_data = $this->session->userdata('hotel_search_data');
$room_datasess = $this->session->userdata('room_data');
echo $hotel_search_data['city'];
?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Check In: <?php echo $hotel_search_data['checkin']; ?> - Check Out: <?php echo $hotel_search_data['checkout']; ?>
                            </div>
                            <div class="search-criteria-counts">
                                <span class="htl-critrerias-counts"><i class="fa fa-home"></i> <span><?php echo $hotel_search_data['room_count'] ?></span>Rooms</span>
                                <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span><?php echo $room_datasess['adult_count']; ?></span>Adults</span>
                                <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span><?php echo $room_datasess['child_count']; ?></span>Children</span>
                                <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span>
                            </div>
                            <div class="search-criteria modify-search">
                                <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="<?php echo WEB_URL; ?>hotel/hotel_search" method="post">
                                            <!--Search critiria for hotel-->
                                            <div class="searchpanel">
                                                <div class="padder">
                                                    <div class="form-group">
                                                        <h3>Book Hotel Online</h3>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="inputCity">Location</label>
                                                                <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcity" type="text" class="form-control" required />
                                                            </div>
                                                            <!--                                                            <div class="col-md-6">
                                                                                                                            <label for="inputCity">To City</label>
                                                                                                                            <input type="text" class="form-control" id="inputFromCity" placeholder="Enter a City">
                                                                                                                        </div>-->
                                                        </div>  
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
                                                                <!--                                                                <option value="4">4</option>-->
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
                                                            <select class="form-control"  name="childage_1_1">

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
                                                        <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room1">
                                                            <label>Child 2 Age</label>
                                                            <select class="form-control" name="childage_1_2">

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
                                                        <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room1">
                                                            <label>Child 3 Age</label>
                                                            <select class="form-control" name="childage_1_3" >

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
                                                                <option value="5">6</option>
                                                                <option value="5">7</option>
                                                                <option value="5">8</option>
                                                                <option value="5">9</option>
                                                                <option value="5">10</option>
                                                                <option value="5">11</option>
                                                                <option value="5">12</option>
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
                                                                <option value="5">6</option>
                                                                <option value="5">7</option>
                                                                <option value="5">8</option>
                                                                <option value="5">9</option>
                                                                <option value="5">10</option>
                                                                <option value="5">11</option>
                                                                <option value="5">12</option>
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
                                                                <option value="5">6</option>
                                                                <option value="5">7</option>
                                                                <option value="5">8</option>
                                                                <option value="5">9</option>
                                                                <option value="5">10</option>
                                                                <option value="5">11</option>
                                                                <option value="5">12</option>
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
                                                                <option value="5">6</option>
                                                                <option value="5">7</option>
                                                                <option value="5">8</option>
                                                                <option value="5">9</option>
                                                                <option value="5">10</option>
                                                                <option value="5">11</option>
                                                                <option value="5">12</option>
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
                                                                <option value="5">6</option>
                                                                <option value="5">7</option>
                                                                <option value="5">8</option>
                                                                <option value="5">9</option>
                                                                <option value="5">10</option>
                                                                <option value="5">11</option>
                                                                <option value="5">12</option>
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
                                                                <option value="5">6</option>
                                                                <option value="5">7</option>
                                                                <option value="5">8</option>
                                                                <option value="5">9</option>
                                                                <option value="5">10</option>
                                                                <option value="5">11</option>
                                                                <option value="5">12</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="row" id="room4">
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
                                                </div>
                                            </div>
                                            <div class="searchBtncntr" style="padding-top:20px;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">SEARCH HOTELS</button>
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

<div class="hotelCntr">
    <div class="container">

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-3">
                <div class="hotelSearchFilter">
                    <div class="searchHdr">Refine your search</div>
                    <div>Showing <span class="total_hotels" id="hotelCount"></span> Of <span class="total_hotels" id="hotelCount1"></span> hotels </div>
                    <div class="htl-filterCntr">
                        <div>Hotel Star rating</div>
                        <label><input type="checkbox" name="star" class="StarRating" value="1" checked="checked"> 1<i class="fa fa-star"></i></label>
                        <label><input type="checkbox" name="star" class="StarRating" value="2" checked="checked"> 2<i class="fa fa-star"></i></label>
                        <label><input type="checkbox" name="star" class="StarRating" value="3" checked="checked"> 3<i class="fa fa-star"></i></label>
                        <label><input type="checkbox" name="star" class="StarRating" value="4" checked="checked"> 4<i class="fa fa-star"></i></label>
                        <label><input type="checkbox" name="star" class="StarRating" value="5" checked="checked"> 5<i class="fa fa-star"></i></label>
                    </div>
<!--
                    <div class="htl-filterCntr">
                        <div>Search by Popularity</div>
                        <select class="form-control">
                            <option value="option" selected>Lowest price</option>
                            <option value="option" >Highest price</option>
                            <option value="option" >Low Star rating</option>
                            <option value="option" >Low High rating</option>
                        </select>
                    </div>-->

                    <div class="htl-filterCntr">
                        <div>Search by Name</div>
                        <div class="input-group acs">
                            <input type="text" class="form-control" id="hotelName" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </div>

                    <div class="htl-filterCntr">
                        <div class="slider">
                            <p>
                                <label for="amount" class="price-range">Price Range:</label>
                                <span id="priceSliderOutput" style="font-weight: normal;"></span>           
                                <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                                <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                            </p>          
                            <div id="priceSlider"  style="z-index:0;"></div>          
                        </div>
                    </div>

                    <div class="htl-filterCntr">
                        <div>Search by Location</div>
                        <select class="form-control">
                            <option value="option">Option</option>
                        </select>
                    </div>

                    <div class="htl-filterCntr htl-amnts">
                        <div>Amenities</div>
                        <label><input type="checkbox" name="star"> Gym/ Spa</label></label>
                        <label><input type="checkbox" name="star"> Internet Access</label></label>
                        <label><input type="checkbox" name="star"> Meeting Facilities</label></label>
                        <label><input type="checkbox" name="star"> Parking Facility</label></label>
                        <label><input type="checkbox" name="star"> Swimming Pool</label></label>
                        <label><input type="checkbox" name="star"> Restaurant/ Coffe Shop</label></label>
                        <label><input type="checkbox" name="star"> Travel Assistance</label></label>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="hotelResultsCntr">
                    <!-- this row will repeat based on hotels availability -->
                    <?php
                    if ($result != '') {
                        foreach ($result as $data) {
                            $totalPriceAry[] = $data->total_cost;
                            ?>
                            <div class="htlResultRow searchhotel_box">
                                <div class="row HotelInfoBox" data-price="<?php echo $data->total_cost; ?>" data-star="<?php echo $data->star; ?>" data-hotel-name="<?php echo $data->hotel_name; ?>">
                                    <div class="col-md-12">
                                        <div class="dtlsOffer"><i class="fa fa-tags"></i> HOTEL FLASH SALE ! Use HOT DEAL and Get Flat 25% Off on this hotel booking. <a href="#" class="knwmoreoffrBtn">Know More</a></div>
                                    </div>
                                    <div class="col-md-2 htlimgCntr">
                                        <?php if ($data->image != '') { ?>
                                            <img src="<?php echo $data->image; ?>" width="100" height="100" alt="hotel-aloft">
                                        <?php } else { ?>
                                            <img src="<?php echo WEB_DIR; ?>public/img/hotels/default-htl-img.jpg" width="100" height="100" alt="hotel-aloft">
                                        <?php } ?>

                                        <?php if ($data->star == '1') { ?>
                                            <span class="star star1"></span>
                                        <?php } elseif ($data->star == '2') { ?>
                                            <span class="star star2"></span>
                                        <?php } elseif ($data->star == '3') { ?>
                                            <span class="star star3"></span>
                                        <?php } elseif ($data->star == '4') { ?>
                                            <span class="star star4"></span>
                                        <?php } elseif ($data->star == '5') { ?>
                                            <span class="star star4"></span>
                                        <?php } ?>

                                    </div>
                                    <div class="col-md-10 htlRightSection">
                                        <div class="row">
                                            <div class="col-md-8 htlDetailsCntr">
                                                <div class="htlname"><?php echo $data->hotel_name; ?></div>
                                                <div ><p><?php echo $data->description; ?></p></div>
                                                <div class="htlprice">
                                                    <!--<i class="fa fa-rupee"></i>--><?php if($data->api=='hotelspro')echo 'USD'; else echo 'INR'; ?>  <?php echo $data->total_cost; ?>
                                                    <span>(all incl. per room per night)</span>
                                                </div>
                                                <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating3"></span> 138 reviews </div>
                                                <div class="htllocation">
                                                    <i class="fa fa-map-marker"></i> Area: <?php echo $data->address; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 hotel-amenities">
                                                <div class="htl-facilities">
                                                    <div class="fcs gym" title="Gym/Spa not Available"></div>
                                                    <div class="fcs swim" title="Swimming Pool not Available"></div>
                                                    <div class="fcs wifi active" title="Internet/Wifi"></div>
                                                    <div class="fcs food active" title="Restaurent/Coffee Shop"></div>
                                                    <div class="fcs mtng-room active" title="Meeting Facilities"></div>
                                                </div>
                                                <!--                                            <div><a href="#">More Information</a></div>-->
                                                <div><label><input type="checkbox" value="1"> Compare</label></div>
                                                <div>
                                                    <button class="btn btn-success pull-right">
                                                        <span class="showseat">BOOK ME </span> <i class="fa fa-hand-o-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div id="row" class="font10">
                            <div align="center">No matching Hotels found... Please try again...</div>
                        </div>
                    <?php } ?>
<?php //echo '<pre>';print_r($totalPriceAry); ?>
                    <input type="hidden" id="setMinPrice" value="<?php if (!empty($totalPriceAry)) echo min($totalPriceAry); else echo '0'; ?>" />                             
                    <input type="hidden" id="setMaxPrice" value="<?php if (!empty($totalPriceAry)) echo max($totalPriceAry); else echo '0'; ?>" />                         
                    <input type="hidden" id="setCurrency" value="<?php echo $data->xml_currency; ?>." /> 
                </div>
            </div>
        </div>        

    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>
<!-- Datepicket Script-->
<script src="<?php echo WEB_DIR ?>public/js/datepickerScript.js"></script>

<!-- Airport AutoComplete List-->
<!--<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR ?>public/css/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript">
    $(function() {	
        $("#hotelcity").autocomplete({
            source: "<?php echo WEB_URL; ?>home/hotel_autolist",
            minLength: 2,
            autoFocus: true
        });
    });

</script>

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/hotel/sorting.js"></script>

<script type="text/javascript">

    $(document).ready(function() 
    {
        $(".StarRating").click(function()
        { //alert('sdsd');
            filter();
        });
		
		
        //==================Callbacks===============================	
        setPriceSlider();	
		
        var hotelCount=0;						
        $(".HotelInfoBox").each(function()
        {
            hotelCount++;			
			
        });	
		
        $("#hotelCount").text(hotelCount);
        $("#hotelCount1").text(hotelCount);
		
		
        $("#hotelName").keyup(function()
        { //alert('as');
            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(), count = 0;
       
            var regex = new RegExp(filter, "i"); // Create a regex variable outside the loop statement

            // Loop through the comment list
            $(".HotelInfoBox").each(function(){			
			
                // If the list item does not contain the text phrase fade it out
                if ($(this).attr("data-hotel-name").search(regex) < 0) { // use the variable here
                    $(this).parents(".searchhotel_box").hide();

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).parents(".searchhotel_box").show();
                    count++;
                }
            });
			
            // Update the count
            $("#hotelCount").text(count);
			
        });	
			
    });

</script>