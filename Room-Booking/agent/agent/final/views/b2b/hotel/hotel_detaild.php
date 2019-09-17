<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<?php echo $map['js']; ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">

<!-----  Top destination content ----->
<div class="selectBusCntr">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-criteria"> Home → India<span class="font12">(10651)</span> → Chennai → Red Sun Serviced Apartments  </div>
<!--                            <div class="search-criteria-counts"> <span class="htl-critrerias-counts"><i class="fa fa-home"></i> <span>2</span>Rooms</span> <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>2</span>Adults</span> <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>3</span>Children</span> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span> </div>
                            <div class="search-criteria modify-search"> <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                <div class="row">
                                    <div class="col-md-7">
                                        <form role="form">
                                            Search critiria for hotel
                                            <div class="searchpanel">
                                                <div class="padder">
                                                    <div class="form-group">
                                                        <h3>Book Hotel Online</h3>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="inputCity">From City</label>
                                                                <input type="text" class="form-control" id="inputTOCity" placeholder="Enter a City">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="inputCity">To City</label>
                                                                <input type="text" class="form-control" id="inputFromCity" placeholder="Enter a City">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                            <label for="fromDate">Date of Journey</label>
                                                            <input type="text" class="form-control" placeholder="From Date" id="dph1" autocomplete= "off">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="toDate">Date of Return (Optional)</label>
                                                            <input type="text" class="form-control" placeholder="To Date" value id="dph2" autocomplete= "off">
                                                        </div>
                                                    </div>
                                                    <div class="row" id="room1">
                                                        <div class="col-md-2 htl-rooms">
                                                            <label>Rooms</label>
                                                            <select class="form-control" id="rooms">
                                                                <option value="1" selected>1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                            </select>
                                                        </div>
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
                                                            <select class="form-control selectchildAge" id="slect-room1ChildAge">
                                                                <option value="0" selected>0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 htl-age htl-childAge1" id="htl-child1Age-room1">
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
                                                        <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room1">
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
                                                        <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room1">
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
                                                    </div>
                                                    <div class="row" id="room2">
                                                        <div class="col-md-2 htl-rooms"><span>Room 2</span></div>
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
                                                            <select class="form-control selectchildAge" id="slect-room2ChildAge">
                                                                <option value="0" selected>0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room2">
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
                                                        <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room2">
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
                                                        <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room2">
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
                                                    </div>
                                                    <div class="row" id="room3">
                                                        <div class="col-md-2 htl-rooms"><span>Room 3</span></div>
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
                                                            <select class="form-control selectchildAge" id="slect-room3ChildAge">
                                                                <option value="0" selected>0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room3">
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
                                                        <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room3">
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
                                                        <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room3">
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
                                                    </div>
                                                    <div class="row" id="room4">
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
                                                    </div>
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
                            </div>-->
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
            <div class="col-md-8">
                <div class="hotelResultsCntr"> 
                    <!-- this row will repeat based on hotels availability -->
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hotel-details"> 
                                    <span class="font20"><?php echo $hotel_detail->hotel_name; ?></span>, <br>
                                    <?php echo $hotel_detail->address; ?> 


                                    <?php if ($hotel_detail->star == '1') { ?>
                                        <span class="star star1"></span>
                                    <?php } elseif ($hotel_detail->star == '2') { ?>
                                        <span class="star star2"></span>
                                    <?php } elseif ($hotel_detail->star == '3') { ?>
                                        <span class="star star3"></span>
                                    <?php } elseif ($hotel_detail->star == '4') { ?>
                                        <span class="star star4"></span>
                                    <?php } elseif ($hotel_detail->star == '5') { ?>
                                        <span class="star star4"></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12 galleryCntr">
                                <?php foreach ($hotel_images as $images) { ?>
                                    <ul id="myGallery">

                                        <li><img src="<?php echo $images->image_url; ?>" alt="Hotel" /></li>

                                    </ul>
                                <?php } ?>

                                <a href="<?php echo WEB_URL ?>hoteld/backtosearch" class="btn btn-primary marginTop10">BACK TO RESULTS</a> 
                            </div>
                        </div>
                        <div class="htl-tabs-cntr"> 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#htl-overview" data-toggle="tab">Hotel Overview</a></li>
                                <li><a href="#htl-am" data-toggle="tab">Hotel Amenities</a></li>
                                <li><a href="#htl-map" data-toggle="tab">Map & Attractions</a></li>
                                <li><a href="#htl-review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="htl-overview">
                                    <h3>Room Details</h3>
                                    <div class="hotel-room-row">
                                        <div class="row htl-rm-header">
                                            <div class="col-md-3">Room Type</div>
                                            <div class="col-md-3">Inclusion</div>
                                            <div class="col-md-3">Max</div>
                                            <div class="col-md-3">Price(Taxes Extra)</div>
                                        </div>


                                        <div class="htl-rm-detail">
                                            <?php
                                            foreach ($hotel_rooms as $rooms) {
                                                ?>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <?php echo $rooms->room_type_name; ?>
                                                    </div>
                                                    <div class="col-md-3"> <a href="#"><?php echo $rooms->rate_plan_inclusion; ?></a> </div>
                                                    <div class="col-md-3"> <a href="#"><?php echo 'Adults: ' . $rooms->adult_max_occ . 'Child: ' . $rooms->child_max_occ; ?></a> </div>
                                                    <div class="col-md-3 htl-rm-price"> <span><i class="fa fa-rupee"></i><?php echo $rooms->total_amount; ?></span> <span class="font12">(all incl. )</span>
                                                        <div>
                                                            <a href="<?php echo WEB_URL; ?>hoteld/pre_booking/<?php echo $rooms->room_type_code; ?>/<?php echo $rooms->rate_plan_code; ?>/<?php echo $rooms->hotel_code; ?>/<?php echo $rooms->hotel_search_result_info_id; ?>/<?php echo $rooms->net_amount; ?>/<?php echo $rooms->total_amount; ?>/<?php echo $rooms->tax; ?>">  <button class="btn btn-success"> BOOK <i class="fa fa-hand-o-right"></i> </button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>


                                        </div>



                                        <!-- hotel details -->
                                        <div class="row htl-desc">
                                            <?php echo $hotel_detail->description; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-am">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="hotel-dtls-amenities">
                                                <h4><?php echo $hotel_detail->hotel_name; ?> - Room - Amenities</h4>
                                                <ul>
                                                    <?php
                                                    if ($hotel_amenities != '') {
                                                        foreach ($hotel_amenities as $val) {
                                                            if ($val->amenity_type == 'room') {
                                                                ?>
                                                                <li>&raquo; <?php echo $val->description; ?></li>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="hotel-dtls-amenities">
                                                <h4><?php echo $hotel_detail->hotel_name; ?> - Hotel - Amenities</h4>
                                                <ul>
                                                    <?php
                                                    if ($hotel_amenities != '') {
                                                        foreach ($hotel_amenities as $val) {
                                                            if ($val->amenity_type == 'property') {
                                                                ?>
                                                                <li>&raquo; <?php echo $val->description; ?></li>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-map">

                                    <?php echo $map['html']; ?>


                                    <div>
                                        <h3>List of Nearest places</h3>
                                        <ul>
                                            <?php foreach ($hotel_inandaround as $val) { ?>
                                                <li>&raquo; <?php echo $val->Name_of_attraction; ?> , <?php echo $val->distance; ?>km</li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="htl-review">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="htd_trrtwrp" id="gi_htl_reviewTA">
                                                <ul class="htd_tradul">
                                                    <li class="htd_tradli">
                                                        <div class="htd_tradrt"><b>TripAdvisor traveller rating:</b> <img src="<?php echo WEB_DIR; ?>public/http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/4.0-15797-1.gif" style="float:right" alt=""> <span>(based on 26 reviews)</span></div>
                                                    </li>
                                                    <li class="htd_tradli">
                                                        <div class="htd_tradrt" style="border-bottom: 1px !important; "><b>Reviews from Tripadvisor:</b></div>
                                                    </li>
                                                    <li>
                                                        <ul class="htd_trpbotul">
                                                            <?php
                                                            if ($hotel_review) {
                                                                foreach ($hotel_review as $val) {
                                                                    ?>
                                                                    <li class="htd_trpbotli">
                                                                        <div class="htd_trp_hdng">"Remarkable servised hotel appartment in deed expressing my self in a short statement"</div>
                                                                        <div class="htd_trpbotcnt">
                                                                            <div class="row">
                                                                                <div class="col-md-9"> <span class="htd_trpbotcont"> <em class="htd_trpbotby db">by <?php echo $val->customer_name; ?> from <?php echo $val->customer_city; ?>, <?php echo $val->customer_country; ?></em></span> </div>
                                                                                <div class="col-md-3"> <span class="htd_trpbotimg"> User Rating : <span class="htliq_htiq_sprite"><?php echo $val->room_quality; ?>/5 <img src="http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/5.0-15797-1.gif"></span> </span> </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="summary_0"> <span class="htd_trpbotcnt_rev" id="summary"><?php echo $val->comments; ?></span></div>
                                                                        <!--                                                                <div class="htd_trpbotcnt_rev" id="review_0" style="display:none">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress and Miss Poornima at the front office desk did extend their services going even beyond their allowed limitations with the intention of assisting and satisfying the customers.The kitchen staff and not forgetting the main man behind the screen the "Chef" served us with excellent authentic Indian food. In one word it was "FANTASTIC" and would suit any pallet with no doubt.The staff too is very friendly and cooperative willing to fulfill the needs of  the customers, understanding their value -categorizing them as 'Customer is the king,We wish them good luck from the bottom of our hearts..</div>-->
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>


                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div style="float:right;font-size:13px;padding-top:5px;"> <a href="http://www.tripadvisor.in/UserReview-g304556-d2097038-m15797-Red_Sun_Serviced_Apartments-Chennai_Madras_Tamil_Nadu.html?partnerReturnTo=[RETURNTO]" target="_blank">Write a Review</a> </div>
                                                        <div style="float:left;font-size:13px;padding-top:5px;"><a href="http://www.tripadvisor.in/ShowUserReviews-g304556-d2097038-r156034572-m15797-Red_Sun_Serviced_Apartments-Chennai_Madras_Tamil_Nadu.html" target="_blank">Read all 26 reviews</a> </div>
                                                    </li>
                                                    <li style="float:left;width:100%;">
                                                        <div style="float:right;font-size:13px;padding-top:5px;"> <span class="hd_vs fr_tripad">&nbsp;</span><span style="padding-top:9px;float:right;font-size:11px;">© 2008 <a target="_blank" href="http://www.tripadvisor.in">TripAdvisor</a> LLC. All rights reserved</span> </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="white-container htl-dtls-amen">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">What happens after I book?</div>
                            <ul>
                                <li>&raquo; Receive confirmation SMS</li>
                                <li>&raquo; Receive voucher on Email</li>
                                <li>&raquo; Print hotel voucher</li>
                                <li>&raquo; Contact customer care in case of issues</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="white-container htl-dtls-amen">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">FAQ</div>
                            <ul>
                                <li>&raquo; <a href="#">How to get the confirmation from hotels?</a></li>
                                <li>&raquo; <a href="#">How to pay the money?</a></li>
                                <li>&raquo; <a href="#">How to contact customer care?</a></li>
                                <li>&raquo; <a href="#">How to cancel the hotel booking?</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="white-container">

                    <?php
                    if ($nearby_hotel !== '') {
                        ?>
                        <div class = "searchHdr">Near By Hotels</div>
                        <div class = "row">
                            <?php
                            foreach ($nearby_hotel as $popular) {
                                ?>


                                <div class="col-md-12 htl-type"> <img src="<?php echo $popular->image ?>" width="100" height="100" alt="hotel-aloft">
                                    <div class="htl-type-dtls">
                                        <div class="row">
                                            <div class="col-md-12 htlDetailsCntr">
                                                <div class="htlname"><?php echo $popular->hotel_name ?></div>
                                                <div class="htlreview"><i class="fa fa-eye"></i> Rratings  
                                                    <?php if ($popular->star == '1') { ?>
                                                        <span class="star star1"></span>
                                                    <?php } elseif ($popular->star == '2') { ?>
                                                        <span class="star star2"></span>
                                                    <?php } elseif ($popular->star == '3') { ?>
                                                        <span class="star star3"></span>
                                                    <?php } elseif ($popular->star == '4') { ?>
                                                        <span class="star star4"></span>
                                                    <?php } elseif ($popular->star == '5') { ?>
                                                        <span class="star star4"></span>
                                                    <?php } ?>
                                                    138 reviews </div>
                                                <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: <?php echo $popular->address ?></div>
                                                <a href="<?php echo WEB_URL; ?>hoteld/hotel_detail/<?php echo $popular->api_temp_hotel_id; ?>"> VIEW DETAILS</a> </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>