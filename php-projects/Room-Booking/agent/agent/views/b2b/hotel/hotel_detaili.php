<?php echo $this->load->view('home/header'); ?>
<?php echo $map['js']; ?>
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
                            <div class="search-criteria-counts"> <span class="htl-critrerias-counts"><i class="fa fa-home"></i> <span>2</span>Rooms</span> <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>2</span>Adults</span> <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>3</span>Children</span>  </div>
                           
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
                                <div class="hotel-details"> <span class="font20"><?php echo $service->hotel_name; ?></span>, <br>
                                    Inner Ring Road , Koyambedu , Chennai | View on Map <span class="star star4"></span></div>
                            </div>
                            <div class="col-md-12 galleryCntr">
                                <ul id="myGallery">
                                    <?php
                                    if ($img_array != '') {
                                        foreach ($img_array as $img) {
                                            foreach ($img as $img1) {
                                                ?>
                                                <li><img src="<?php echo $img1; ?>" alt="Hotel" /></li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                                <a href="<?php echo WEB_URL ?>hoteli/backtosearch" class="btn btn-primary marginTop10">BACK TO RESULTS</a> </div>
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
                                            <div class="col-md-6">Room Type</div>
                                            <div class="col-md-3">Services & Conditions</div>
                                            <div class="col-md-3">Price(Taxes Extra)</div>
                                        </div>


                                        <div class="htl-rm-detail">
                                            <div class="row">
                                                <div class="col-md-6 htl-type"> <img src="<?php echo $service->image; ?>" width="100" height="100" alt="hotel-aloft">
                                                    <div class="htl-type-dtls"> <span><?php echo ''; ?></span>
                                                        <p><strong>Description:</strong><?php echo substr($service->description, 0, 150) . '...'; ?></p>
<!--                                                                <a class="htl-ind-rm-dtls">VIEW DETAILS <i class="fa fa-caret-down"></i></a> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-3"> <a href="#">Cancellation Policy</a> </div>
                                                <div class="col-md-3 htl-rm-price"> <span><i class="fa fa-rupee"></i><?php echo $service->total_amount; ?></span> <span class="font12">(all incl. )</span>
                                                    <div>
                                                       
                                 
                                                            <a href="<?php echo WEB_URL; ?>hoteli/pro_pre_booking/<?php echo $service->api_temp_hotel_id ?>"> <button class="btn btn-success"> BOOK <i class="fa fa-hand-o-right"></i> </button></a>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <!-- hotel details -->
                                        <div class="row htl-desc">
                                            <div class="col-md-8"><?php echo $service->description; ?> </div>
                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-am">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="hotel-dtls-amenities">
                                                <h4><?php echo $service->hotel_name; ?> - Room - Amenities</h4>
                                                <?php
                                                foreach ($room_facility as $room) {
                                                    $str = $room->fac;
                                                    $room_fac = explode(',', $str);
                                                    ?>

                                                    <ul>

                                                        <?php
                                                        foreach ($room_fac as $facility1) {
                                                            ?>

                                                            <li>
                                                                <?php
                                                                echo $facility1;
                                                                ?>
                                                            </li> 

                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>


                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="hotel-dtls-amenities">
                                                <h4><?php echo $service->hotel_name; ?> - Hotel - Amenities</h4>
                                                <?php
                                        foreach ($hotel_facility as $hotel) {
                                            //echo '<pre>';    print_r($room); exit;
                                            //echo $hotel->fac;
                                            $str = $hotel->fac;
                                            $hotel_fac = explode(',', $str);
                                            ?>
                                                <ul>
                                                    <?php
                                                    foreach ($hotel_fac as $facility) {
                                                        ?>

                                                        <li>
                                                            <?php
                                                            echo $facility;
                                                            ?>
                                                        </li> 

                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                          
                                        <?php }
                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-map">
                                  
                                    
                                     <?php echo $map['html']; ?>
                                    <div>
                                        <h3>List of Nearest places, attractions near Red Sun Serviced Apartments , Chennai</h3>
                                        
                                        <ul> 
                                    <?php
                                    foreach ($nearby_hotel as $popular) {
                                        ?>
                                        <li>

                                            <a title="<?php echo $popular->hotel_name ?>"  href="<?php echo WEB_URL; ?>hotel/hotel_detail/<?php echo $popular->api_temp_hotel_id; ?>"> <table width="100%"><tr><td width="70%"><?php echo substr($popular->hotel_name, 0, 22); ?></td><td><?php echo round($popular->distance, 2) . ' KM'; ?></td></tr></table></a>

                                        </li> 

                                    <?php }
                                    ?>
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
                    <div class="searchHdr">Nearby hotels</div>
                    <div class="row">
                        <?php 
                        foreach($nearby_hotel as $near)
                        {                       
                        
                        ?>
                        
                        
                        <div class="col-md-12 htl-type"> <img src="<?php echo $near->image ?>" width="100" height="100" alt="hotel-aloft">
                            <div class="htl-type-dtls">
                                <div class="row">
                                    <div class="col-md-12 htlDetailsCntr">
                                        <div class="htlname" style="font-size: 15px;"><?php echo $near->hotel_name ?></div>
                                        <div class="htlreview"><i class="fa fa-eye"></i> Star Rating: 
                                        <?php if ($near->star == '1') { ?>
                                            <span class="star star1"></span>
                                        <?php } elseif ($near->star == '2') { ?>
                                            <span class="star star2"></span>
                                        <?php } elseif ($near->star == '3') { ?>
                                            <span class="star star3"></span>
                                        <?php } elseif ($near->star == '4') { ?>
                                            <span class="star star4"></span>
                                        <?php } elseif ($near->star == '5') { ?>
                                            <span class="star star4"></span>
                                        <?php } ?>
 </div>
                                        <div class="htllocation"> <i class="fa fa-map-marker"><?php echo round($near->distance,2). 'K. M' ?></i> <?php echo $near->address ?> </div>
                                        <a href="<?php echo WEB_URL; ?>hotel/hotel_detail/<?php echo $near->api_temp_hotel_id; ?>"> VIEW DETAILS</a> </div>
                                </div>
                            </div>
                        </div>
                        
                         <?php 
                        
                        
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