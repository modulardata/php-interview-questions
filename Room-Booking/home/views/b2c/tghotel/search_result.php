<?php echo $this->load->view('home/header'); ?>
<!-----  Top destination content ----->
<div class="flightsContainer">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">            
                    <!-- modify search goes here  -->
                    <?php echo $this->load->view('b2c/tghotel/modify_search'); ?>
                    <!-- modify search goes here  -->                       
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="hotelCntr">
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
                      
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="hotelResultsCntr"> 
                    <!-- this row will repeat based on hotels availability -->
                    <?php
                    if (!empty($result)) {
                        $cou = count($result);
                        ?>
                        <?php
                        for ($k = 0; $k < count($result); $k++) {

                            $totalPriceAry[] = $result[$k]->total_amount;
                            ?>
                            <div class="htlResultRow searchhotel_box">
                                <div class="row HotelInfoBox"  data-price="<?php echo $result[$k]->total_amount; ?>" data-star="<?php if ($result[$k]->star != 'G') echo $result[$k]->star; else echo 0; ?>" data-hotel-name="<?php echo $result[$k]->hotel_name; ?>">
                                    <div class="col-md-12">
                                        <div class="dtlsOffer"><i class="fa fa-tags"></i> 
                                            <?php echo $result[$k]->rate_plan_description; ?>
                                            <!--                                                <a href="#" class="knwmoreoffrBtn">Know More</a>-->
                                        </div>
                                    </div>
                                    <div class="col-md-2 htlimgCntr">

                                        <?php if ($result[$k]->image == '' || $result[$k]->image == '--None--') { ?>
                                            <img src="<?php echo WEB_DIR; ?>public/images/default-htl-img.jpg" alt="image" width="135" height="120" alt="hotel-image"/>
                                        <?php } else { ?>
                                            
                                            <img src="<?php echo $result[$k]->image ?>" width="135" height="120" alt="hotel-image"/> 
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="col-md-10 htlRightSection">
                                        <div class="row">
                                            <div class="col-md-6 htlDetailsCntr">
                                                <div class="htlname">
                                                    <?php echo $result[$k]->hotel_name; ?></div>
                                                <?php if ($result[$k]->star == '0' || $result[$k]->star == '') { ?>
                                                    <span class="star star marginTop5"></span>
                                                <?php } elseif ($result[$k]->star == '1') { ?>
                                                    <span class="star star1 marginTop5"></span>
                                                <?php } elseif ($result[$k]->star == '2') { ?>
                                                    <span class="star star2 marginTop5"></span>
                                                <?php } elseif ($result[$k]->star == '3') { ?>
                                                    <span class="star star3 marginTop5"></span>
                                                <?php } elseif ($result[$k]->star == '4') { ?>
                                                    <span class="star star4 marginTop5"></span>
                                                <?php } elseif ($result[$k]->star == '5') { ?>
                                                    <span class="star star5 marginTop5"></span>
                                                <?php } ?>
                                                <div class="htllocation marginTop5"> <i class="fa fa-map-marker"></i> Area: <?php echo $result[$k]->address; ?>, <?php echo $result[$k]->city; ?> </div>
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
                                                    <small>
                                                        <div>
                                                            <p align="center" >
                                                                <?php $hotel_review_avg = $this->Dhotel_Model->get_hotel_review_avg($result[$k]->hotel_code); ?>
                                                                <?php
                                                                echo 'Guest Reviews:<br/>' . round($hotel_review_avg->avg_rate, 2) . ' / 5'
                                                                ?>
                                                            </p>
                                                            <p align="center" >
                                                                <?php
                                                                $average = $hotel_review_avg->avg_rate;
                                                                if (($average > 4) && ($average <= 5)) {
                                                                    echo 'Rating: Superb';
                                                                } else if (($average > 3) && ($average <= 4)) {
                                                                    echo 'Rating: Excelleant';
                                                                } else if (($average > 2) && ($average <= 3)) {
                                                                    echo 'Rating: Good';
                                                                } else if (($average > 1) && ($average <= 2)) {
                                                                    echo 'Rating: Average';
                                                                } else {
                                                                    echo 'Rating: Poor';
                                                                }
                                                                ?>
                                                            </p>  
                                                        </div>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="htlprice"> <?php echo 'INR. ' . round($result[$k]->total_amount, 0); ?> </div>
                                                <div > (Including all Tax) </div>
                                                <div>
                                                    <a href="<?php echo WEB_URL; ?>dhotel/hotel_detail/<?php echo $result[$k]->hotel_search_result_info_id; ?>"> <button class="btn btn-primary"> SELECT HOTEL <i class="fa fa-angle-double-right"></i></button></a>
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
                    <input type="hidden" id="setCurrency" value="INR." />
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
<!--<script src="<?php echo WEB_DIR; ?>public/js/customize.js"></script>-->
<!-- Airport AutoComplete List-->
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR ?>public/css/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript">
    $(function() {	
        $("#hotelcityd").autocomplete({
            source: "<?php echo WEB_URL; ?>home/dhotel_autolist",
            minLength: 2,
            autoFocus: true
        });
    });

</script>

<?php echo $this->load->view('b2c/hotel/filter'); ?>