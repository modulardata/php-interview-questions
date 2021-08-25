<?php echo $this->load->view('home/header'); ?>
<!-----  Top destination content ----->
<div class="flightsContainer">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">            
                    <!-- modify search goes here  -->
                    <?php echo $this->load->view('b2c/hotel/modify_search'); ?>
                    <!-- modify search goes here  -->                       
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
                    <div class="searchHdr">Refine your search</div>
                    <div>Showing <span class="total_hotels" id="hotelCount"></span> Of <span class="total_hotels" id="hotelCount1"></span> hotels </div>
                    <ul class="flight-search">
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Price</h4>
                            <div class="hotel-search-cntr slider">
<!--                                <input type="text" class="range-value" id="price-start">
                                <input type="text" class="range-value range-value-end" id="price-end">-->
                                <span id="priceSliderOutput" style="font-weight: normal;"></span>
                                <input type="hidden" name="minPrice" id="minPrice" class="range-value"  />
                                <input type="hidden" name="maxPrice" id="maxPrice" class="range-value range-value-end"  />
                                <div id="priceSlider"  style="z-index:0;" class="slider-range"></div>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Hotel Star rating</h4>
                            <div class="hotel-search-cntr stars">
                                <div><label><input type="checkbox" name="star" class="StarRating" value="1" checked="checked"> 1</label>&nbsp;&nbsp;&nbsp;<i class="fa star star1"></i></div>
                                <div><label><input type="checkbox" name="star" class="StarRating" value="2" checked="checked"> 2</label>&nbsp;&nbsp;&nbsp;<i class="fa star star2"></i></div>
                                <div><label><input type="checkbox" name="star" class="StarRating" value="3" checked="checked"> 3</label>&nbsp;&nbsp;&nbsp;<i class="fa star star3"></i></div>
                                <div><label><input type="checkbox" name="star" class="StarRating" value="4" checked="checked"> 4</label>&nbsp;&nbsp;&nbsp;<i class="fa star star4"></i></div>
                                <div><label><input type="checkbox" name="star" class="StarRating" value="5" checked="checked"> 5</label>&nbsp;&nbsp;&nbsp;<i class="fa star star5"></i></div>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fa fa-caret-down"></i> Hotel Name</h4>
                            <div class="input-group">
                                <input type="text" class="form-control" id="hotelName" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </li>
                        <!--                        <li>
                                                    <h4><i class="fa fa-caret-down"></i> Locations</h4>
                                                    <div class="hotel-search-cntr">
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Birla Mandir<span class="hotel_counts">324</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Gurgaon Golf Course Road<span class="hotel_counts">12</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Gurgaon NH 8<span class="hotel_counts">56</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            New Delhi Railway Station<span class="hotel_counts">65</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Sacred Heart Cathedral<span class="hotel_counts">37</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Sector 29 Gurgaon<span class="hotel_counts">86</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Travel Assistance<span class="hotel_counts">112</span></label>
                                                        </label>
                                                        <span class="btn btn-primary marginTop5">Show all 112 locations</span> 
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4><i class="fa fa-caret-down"></i> Property types</h4>
                                                    <div class="hotel-search-cntr amenities" style="display:none;">
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Bed and Breakfast<span class="hotel_counts">324</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Boutique hotel<span class="hotel_counts">12</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Extended stay<span class="hotel_counts">56</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Guest house<span class="hotel_counts">65</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Heritage hotel<span class="hotel_counts">37</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Home stay<span class="hotel_counts">86</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            HOtels<span class="hotel_counts">112</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Resort<span class="hotel_counts">37</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Serviced Apartment<span class="hotel_counts">86</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Spa<span class="hotel_counts">112</span></label>
                                                        </label>
                                                    </div>
                                                </li>-->
<!--                        <li>
                            <h4><i class="fa fa-caret-down" ></i> Amenities</h4>
                            <div class="hotel-search-cntr amenities" style="display:block;">
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Air conditioning<span class="hotel_counts">324</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Bar<span class="hotel_counts">12</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Business centre<span class="hotel_counts">56</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Coffee shop<span class="hotel_counts">65</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Gym<span class="hotel_counts">37</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Internet Access<span class="hotel_counts">86</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Pool<span class="hotel_counts">112</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Restaurant<span class="hotel_counts">37</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    Room service<span class="hotel_counts">86</span></label>
                                </label>
                                <label>
                                    <input type="checkbox" name="star" checked="checked">
                                    WiFi Access<span class="hotel_counts">112</span></label>
                                </label>
                            </div>
                        </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="hotelResultsCntr"> 
                    <!-- this row will repeat based on hotels availability -->
                    <?php
                    if ($result != '') {
                        foreach ($result as $res) {
                            if ($res->total_cost != '0.00') {
                                $totalPriceAry[] = $res->total_cost;

                                if ($res->api == 'roomsxml') {
                                    if ($res->image != '') {
                                        $image = "http://www.roomsxml.com" . $res->image;
                                    } else {
                                        $image = WEB_DIR . 'public/img/hotels/default-htl-img.jpg';
                                    }
                                } elseif ($res->api == 'acerooms') {
                                    $imag = $this->Acerooms_Model->getimage($res->hotel_code);
                                    if ($imag != '') {
                                        $image = $imag;
                                    } else {
                                        $image = WEB_DIR . 'public/img/hotels/default-htl-img.jpg';
                                    }
                                }
                                elseif ($res->api == 'jac') {
                                    if ($res->image != '') {
                                        $image = $res->image;
                                    } else {
                                        $image = WEB_DIR . 'public/img/hotels/default-htl-img.jpg';
                                    }
                                }
                                ?>
                                <div class="htlResultRow searchhotel_box">
                                    <div class="row HotelInfoBox"  data-price="<?php echo $res->total_cost; ?>" data-star="<?php echo $res->star; ?>" data-hotel-name="<?php echo $res->hotel_name; ?>">
                                        <div class="col-md-12">
                                            <div class="dtlsOffer"><i class="fa fa-tags"></i> <?php echo $res->location; ?> </div>
                                        </div>
                                        <div class="col-md-2 htlimgCntr">

                                            <img src="<?php echo $image; ?>" width="135" height="120" alt="hotel-image"> 

                                        </div>
                                        <div class="col-md-10 htlRightSection">
                                            <div class="row">
                                                <div class="col-md-6 htlDetailsCntr">
                                                    <div class="htlname"><?php echo $res->hotel_name; ?></div>
                                                    <?php if ($res->star == '0' || $res->star == '') { ?>
                                                        <span class="star star marginTop5"></span>
                                                    <?php } elseif ($res->star == '1') { ?>
                                                        <span class="star star1 marginTop5"></span>
                                                    <?php } elseif ($res->star == '2') { ?>
                                                        <span class="star star2 marginTop5"></span>
                                                    <?php } elseif ($res->star == '3') { ?>
                                                        <span class="star star3 marginTop5"></span>
                                                    <?php } elseif ($res->star == '4') { ?>
                                                        <span class="star star4 marginTop5"></span>
                                                    <?php } elseif ($res->star == '5') { ?>
                                                        <span class="star star5 marginTop5"></span>
                                                    <?php } ?>
                                                    <div class="htllocation marginTop5"> <i class="fa fa-map-marker"></i> Area: <?php echo $res->address; ?>, <?php echo $res->city; ?> </div>
                                                    <div class="htl-facilities">
<!--                                                        <ul id="amenitiesLabel" class="htamIcons">
                                                            <li><span title="Wifi" class="htamWIFI active"></span></li>
                                                            <li><span title="Bar" class="htamBar"></span></li>
                                                            <li><span title="Air Conditioner" class="htamAC active"></span></li>
                                                            <li><span title="Restaurant" rel="tTooltip" class="htamRestaurant active"></span></li>
                                                            <li><span title="Cafe" class="htamCafe active"></span></li>
                                                            <li><span title="Room service" class="htamRoomService active" ></span></li>
                                                            <li><span title="Business Center" class="htamBusinessCenter "></span></li>
                                                            <li><span title="Pool" class="htamPool active"></span></li>
                                                            <li><span title="Gym" class="htamGym active " ></span></li>
                                                        </ul>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="review marginTop5">
                                                        <span class="taLogo"></span>
                                                        <span title="4/5" class="rating t4"></span><br>
            <!--                                                    <small><a class="hotelDetails" data-hash="#taReviews" href="javascript:void(0);">282 reviews</a></small>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-3 ">
                                                    <div class="htlprice"> <?php echo $res->xml_currency; ?> <?php echo round($res->total_cost,0); ?> </div>
                                                    <div>
                                                        <a href="<?php echo WEB_URL; ?>hotel/hotel_detail/<?php echo $res->api_temp_hotel_id; ?>"> <button class="btn btn-primary"> SELECT HOTEL <i class="fa fa-angle-double-right"></i></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        ?>
                        <div class="htlResultRow">
                            <div class="row">
                                <div class="col-md-12">
                                    No Results Found for your search
                                </div>
                            </div>
                        </div>
                    <?php } ?> 
                    <input type="hidden" id="setMinPrice" value="<?php if (!empty($totalPriceAry)) echo min($totalPriceAry); else echo '0'; ?>" />                             
                    <input type="hidden" id="setMaxPrice" value="<?php if (!empty($totalPriceAry)) echo max($totalPriceAry); else echo '0'; ?>" />                         
                    <input type="hidden" id="setCurrency" value="<?php echo $res->xml_currency; ?>." /> 
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- baggage rules -->

<?php echo $this->load->view('home/footer'); ?>
<!-- Datepicket Script-->
<script src="<?php echo WEB_DIR ?>public/js/datepickerScript.js"></script>

<!-- Airport AutoComplete List-->
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-1.9.1.min.js"></script>
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

<?php echo $this->load->view('b2c/hotel/filter'); ?>