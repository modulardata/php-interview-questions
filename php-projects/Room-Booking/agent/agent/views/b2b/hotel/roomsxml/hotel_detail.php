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

                                <a href="<?php echo WEB_URL ?>hotel/backtosearch" class="btn btn-primary marginTop10">BACK TO RESULTS</a> 
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

                                            <div class="col-md-3">Price(Taxes Extra)</div>
                                        </div>


                                        <div class="htl-rm-detail">
                                            <?php
                                            foreach ($hotel_detail_room as $rooms) {
                                                ?>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <?php echo $rooms->room_type; ?>
                                                    </div>
                                                    <div class="col-md-3"> <a href="#"><?php echo $rooms->inclusion; ?></a> </div>

                                                    <div class="col-md-3 htl-rm-price"> <?php echo $rooms->xml_currency; ?><span><?php echo $rooms->total_cost; ?></span> <span class="font12">(all incl. )</span>





                                                    </div>
                                                    <div class="col-md-3">  <a href="<?php echo WEB_URL; ?>hotel/itenarary/<?php echo $rooms->api_temp_hotel_id; ?>/<?php echo $rooms->hotel_code; ?>">  <button type="submit" class="btn btn-primary"> BOOK  <i class="fa fa-angle-double-right"></i> </button></a></div>
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
                    foreach ($nearby_hotel as $popular) {
                        ?>
                        <div class="col-md-12 htl-type"> <img src="http://www.roomsxml.com<?php echo $popular->image ?>" width="100" height="100" alt="hotel-aloft">
                            <div class="htl-type-dtls">
                                <div class="row">
                                    <div class="col-md-12 htlDetailsCntr">
                                        <div class="htlname"><?php echo $popular->hotel_name ?></div>
                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area:<?php echo $popular->location ?> </div>
                                        <a title="<?php echo $popular->hotel_name ?>"  href="<?php echo WEB_URL; ?>hotel/hotel_detail/<?php echo $popular->hotel_search_result_info_id; ?>"> VIEW DETAILS</a> </div>
                                </div>
                            </div>
                        </div>

                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>