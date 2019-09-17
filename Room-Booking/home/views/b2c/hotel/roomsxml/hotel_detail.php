<?php echo $this->load->view('home/header'); ?>
<?php echo $map['js']; ?>
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
    <div class="rg-image-wrapper">
        {{if itemsCount > 1}}
        <div class="rg-image-nav">
            <a href="#" class="rg-image-nav-prev">Previous Image</a>
            <a href="#" class="rg-image-nav-next">Next Image</a>
        </div>
        {{/if}}
        <div class="rg-image"></div>
        <div class="rg-loading"></div>
    </div>
</script>


<div class="flightCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-8">
                <div class="hotelResultsCntr padding10"> 
                    <!-- this row will repeat based on hotels availability -->
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $RoomsStatic_data = file_get_contents("RoomsHotelDetailXml/" . $hotel_detail->hotel_code . ".xml");
                                // echo '<pre>';print_r($RoomsStatic_data);
                                if ($RoomsStatic_data != '') {
                                    $dom3 = new DOMDocument();
                                    $dom3->loadXML($RoomsStatic_data);
                                    // extracting the gallery images
                                    $sHotelElement = $dom3->getElementsByTagName("HotelElement");
                                    foreach ($sHotelElement as $val_1) {
                                        $sName = $val_1->getElementsByTagName('Name')->item(0)->nodeValue;
                                    }
                                    $sAddress = $dom3->getElementsByTagName("Address");
                                    foreach ($sAddress as $val_1) {
                                        $sCity = $val_1->getElementsByTagName('City')->item(0)->nodeValue;
                                        $sCountry = $val_1->getElementsByTagName('Country')->item(0)->nodeValue;
                                    }
                                    $sStars = $val_1->getElementsByTagName('Stars')->item(0)->nodeValue;
                                    /*                                                    <li><a href="#"><img src="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" data-large="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" alt="image02" data-description="A plaintful story from a sistering vale" /></a></li> */
                                    // extracting the gallery images
                                }
                                ?>
                                <div class="hotel-details"> <span class="font20"><strong><?php echo $sName ?></strong></span> <br>
                                    <?php echo $sCity . ', ' . $sCountry; ?> 
                                    <?php if ($sStars == '0' || $sStars == '') { ?>
                                        <span class="star star "></span>
                                    <?php } elseif ($sStars == '1') { ?>
                                        <span class="star star1 "></span>
                                    <?php } elseif ($sStars == '2') { ?>
                                        <span class="star star2 "></span>
                                    <?php } elseif ($sStars == '3') { ?>
                                        <span class="star star3 "></span>
                                    <?php } elseif ($sStars == '4') { ?>
                                        <span class="star star4 "></span>
                                    <?php } elseif ($sStars == '5') { ?>
                                        <span class="star star5 "></span>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="col-md-12 galleryCntr marginTop15">
                                <div id="rg-gallery" class="rg-gallery">
                                    <div class="rg-thumbs">
                                        <!-- Elastislide Carousel Thumbnail Viewer -->
                                        <div class="es-carousel-wrapper">
                                            <div class="es-nav">
                                                <span class="es-nav-prev">Previous</span>
                                                <span class="es-nav-next">Next</span>
                                            </div>
                                            <div class="es-carousel">
                                                <ul>
                                                    <?php
// echo '<pre>';print_r($RoomsStatic_data);
                                                    if ($RoomsStatic_data != '') {
                                                        $dom3 = new DOMDocument();
                                                        $dom3->loadXML($RoomsStatic_data);
                                                        // extracting the gallery images
                                                        $sPhoto = $dom3->getElementsByTagName("Photo");
                                                        foreach ($sPhoto as $val_1) {
                                                            $sUrl = $val_1->getElementsByTagName('Url')->item(0)->nodeValue;
                                                            $sThumbnailUrl = $val_1->getElementsByTagName('ThumbnailUrl')->item(0)->nodeValue;
                                                            echo '<li><a href="#"><img src="http://www.roomsxml.com' . $sThumbnailUrl . '" data-large="http://www.roomsxml.com' . $sUrl . '" alt="image01" data-description="From off a hill whose concave womb reworded" /></a></li>';
                                                        }
                                                        /*                                                    <li><a href="#"><img src="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" data-large="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" alt="image02" data-description="A plaintful story from a sistering vale" /></a></li> */
                                                        // extracting the gallery images
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End Elastislide Carousel Thumbnail Viewer -->
                                    </div><!-- rg-thumbs -->
                                </div>
                                <a href="<?php echo WEB_URL ?>hotel/backtosearch" class="btn btn-primary marginTop10">BACK TO RESULTS</a> </div>
                        </div>
                        <div class="htl-tabs-cntr marginTop15"> 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#htl-overview" data-toggle="tab">Hotel Overview</a></li>
                                <li><a href="#htl-am" data-toggle="tab">Hotel Amenities</a></li>
                                <li><a href="#htl-map" data-toggle="tab">Map & Attractions</a></li>
                                <!--                                <li><a href="#htl-review" data-toggle="tab">Reviews</a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="htl-overview">
                                    <?php
                                    $hotel_search_data = $this->session->userdata('hotel_search_data');
                                    $checkin = $hotel_search_data['checkin'];
                                    $checkout = $hotel_search_data['checkout'];
                                    $rooms = $hotel_search_data['room_count'];
                                    $noofnights = $hotel_search_data['noofnights'];
                                    $adults = $hotel_search_data['adultvalue'];
                                    $child = $hotel_search_data['childvalue'];
                                    ?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4><strong><?php echo $hotel_name . ', ' . $city; ?></strong></h4>
                                                <div class="selected-flight-dtls">
                                                    <div class="row detailed-row">
                                                     
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12 ">
                                                                    <h4 class="marginTop5 borderDashedBtm"><strong><?php echo $rooms; ?> rooms for <?php echo $noofnights; ?> nights</strong></h4>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <span class="font12">Check-in</span>
                                                                    <h4 class="rdtheme"><strong><?php echo $checkin; ?></strong></h4>
    <!--                                                                <span class="font12">Thu, 3 pm</span>-->
                                                                </div>	
                                                                <div class="col-md-2 text-center">
                                                                    <h4 class=""><i class="fa fa-clock-o"></i></h4>
                                                                    <?php echo $noofnights; ?> nights
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <span class="font12">Check-out</span>
                                                                    <h4 class="rdtheme"><strong><?php echo $checkout; ?></strong></h4>
    <!--                                                                <span class="font12">Thu, 3 pm</span>-->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <?php for ($r = 0; $r < $rooms; $r++) { ?>
                                                                        <div class="row padding10 <?php if ($r != ($rooms - 1)) { ?>borderDashedBtm <?php } ?>"">
                                                                             <div class="col-md-4">Room <?php echo $r + 1; ?></div>
                                                                             <div class="col-md-8"><?php echo $adults[$r]; ?> Adults and <?php echo $child[$r]; ?> Child <!-- <span class="font11">(4years)</span>--></div>
                                                                        </div>
                                                                    <?php } ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
                                                                <?php echo $hotel_detail->room_type; ?>, <?php echo $hotel_detail->inclusion; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <h3>Room Details</h3>
                                    <div class="hotel-room-row">
                                        <div class="row htl-rm-header">
                                            <div class="col-md-4">Room Type</div>
                                            <div class="col-md-3">Inclusion</div>
                                            <div class="col-md-2">Price</div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <?php foreach ($hotel_detail_room as $room) { ?>
                                            <div class="htl-rm-detail">
                                                <div class="row">
                                                    <div class="col-md-4"> 
                                                        <span><?php echo $room->room_type; ?></span>

                                 <!--<a class="htl-ind-rm-dtls">VIEW DETAILS <i class="fa fa-caret-down"></i></a>-->
                                                    </div>
                                                    <div class="col-md-3"> 

                                                        <span><p><?php if ($room->inclusion) echo $room->inclusion;else echo 'Room Only'; ?></p></span>
                                                        <!--<a class="htl-ind-rm-dtls">VIEW DETAILS <i class="fa fa-caret-down"></i></a>-->
                                                    </div>
                                                    <div class="col-md-2"> <span><!--<i class="fa fa-rupee"></i>--><?php echo $room->xml_currency; ?><?php echo round($room->total_cost,0); ?></span>  </div>
                                                    <div class="col-md-3 htl-rm-price"> 
                                                        <div>
                                                            <a href="<?php echo WEB_URL; ?>hotel/itenarary/<?php echo $room->api_temp_hotel_id; ?>/<?php echo $room->hotel_code; ?>"> <button class="btn btn-primary"> BOOK  <i class="fa fa-angle-double-right"></i> </button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--                                                <div class="row htl-ind-details" id="htl-ind-details">
                                                                                                    <div class="col-md-12">
                                                                                                        <p>Deluxe Rooms are spacious with approximate dimension of 28 sq. m. Rooms are well equipped with air conditioner and offer amenities like cable television, superfast internet, electronic locks, mini bar, electronic safe, en suite bathrooms with toiletries, bathtub, hair dryer and supply of hot and cold water, welcome drink, fruit basket, cookies, mineral bottle water, daily newspaper and direct dial STD/ISD telephone services.</p>
                                                                                                    </div>
                                                                                                    <div class="col-md-12 htl-dtls-amen">
                                                                                                        <h4>Amenities</h4>
                                                                                                        <ul>
                                                                                                            <li>&raquo; Air Conditioning</li>
                                                                                                            <li>&raquo; Alarm Clock</li>
                                                                                                            <li>&raquo; Cable / Satellite / Pay TV available</li>
                                                                                                            <li>&raquo; Ensuite / Private Bathroom</li>
                                                                                                            <li>&raquo; Hairdryer (on request)</li>
                                                                                                            <li>&raquo; Mini bar - On Charge</li>
                                                                                                            <li>&raquo; Telephone</li>
                                                                                                            <li>&raquo; Newspapers Complimentary</li>
                                                                                                            <li>&raquo; Hot / Cold Running Water</li>
                                                                                                            <li>&raquo; Safe - In - Room</li>
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                </div>-->
                                            </div>

                                        <?php } ?>

                                        <!-- hotel details -->
                                        <div class="row htl-desc">
                                            <div class="col-md-12"> 
                                                <?php
                                                if ($RoomsStatic_data != '') {
                                                    $dom3 = new DOMDocument();
                                                    $dom3->loadXML($RoomsStatic_data);
                                                    // extracting the gallery images
                                                    $sDescription = $dom3->getElementsByTagName("Description");
                                                    foreach ($sDescription as $val_1) {
                                                        $sText = $val_1->getElementsByTagName('Text')->item(0)->nodeValue;
                                                        echo '<p style="text-align:justify;">' . $sText . '</p>';
                                                    }
                                                    /*                                                    <li><a href="#"><img src="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" data-large="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" alt="image02" data-description="A plaintful story from a sistering vale" /></a></li> */
                                                    // extracting the gallery images
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-am">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="hotel-dtls-amenities">
                                                <h4>Amenities</h4>
                                                <ul>

                                                    <?php
                                                    if ($RoomsStatic_data != '') {
                                                        $dom3 = new DOMDocument();
                                                        $dom3->loadXML($RoomsStatic_data);
                                                        // extracting the gallery images
                                                        $sAmenity = $dom3->getElementsByTagName("Amenity");
                                                        foreach ($sAmenity as $val_1) {
                                                            $sText = $val_1->getElementsByTagName('Text')->item(0)->nodeValue;
                                                            echo '<li>&raquo;' . $sText . '</li>';
                                                        }
                                                        /*                                                    <li><a href="#"><img src="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" data-large="<?php echo WEB_DIR; ?>public/img/htl-gallery/hotel2.jpg" alt="image02" data-description="A plaintful story from a sistering vale" /></a></li> */
                                                        // extracting the gallery images
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
                                <!--                                <div class="tab-pane" id="htl-review">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="htd_trrtwrp" id="gi_htl_reviewTA">
                                                                                <ul class="htd_tradul">
                                                                                    <li class="htd_tradli">
                                                                                        <div class="htd_tradrt"><b>TripAdvisor traveller rating:</b> <img src="http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/4.0-15797-1.gif" style="float:right" alt=""> <span>(based on 26 reviews)</span></div>
                                                                                    </li>
                                                                                    <li class="htd_tradli">
                                                                                        <div class="htd_tradrt" style="border-bottom: 1px !important; "><b>Reviews from Tripadvisor:</b></div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <ul class="htd_trpbotul">
                                                                                            <li class="htd_trpbotli">
                                                                                                <div class="htd_trp_hdng">"Remarkable servised hotel appartment in deed expressing my self in a short statement"</div>
                                                                                                <div class="htd_trpbotcnt">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-9"> <span class="htd_trpbotcont"> <em class="htd_trpbotby db">by WilhelmP293962 on 2013-08-29T11:10:25-04:00 from Colombo, Sri Lanka</em></span> </div>
                                                                                                        <div class="col-md-3"> <span class="htd_trpbotimg"> User Rating : <span class="htliq_htiq_sprite">5/5 <img src="http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/5.0-15797-1.gif"></span> </span> </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div id="summary_0"> <span class="htd_trpbotcnt_rev" id="summary">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress......</span></div>
                                                                                                <div class="htd_trpbotcnt_rev" id="review_0" style="display:none">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress and Miss Poornima at the front office desk did extend their services going even beyond their allowed limitations with the intention of assisting and satisfying the customers.The kitchen staff and not forgetting the main man behind the screen the "Chef" served us with excellent authentic Indian food. In one word it was "FANTASTIC" and would suit any pallet with no doubt.The staff too is very friendly and cooperative willing to fulfill the needs of  the customers, understanding their value -categorizing them as 'Customer is the king,We wish them good luck from the bottom of our hearts..</div>
                                                                                            </li>
                                                                                            <li class="htd_trpbotli">
                                                                                                <div class="htd_trp_hdng">"Remarkable servised hotel appartment in deed expressing my self in a short statement"</div>
                                                                                                <div class="htd_trpbotcnt">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-9"> <span class="htd_trpbotcont"> <em class="htd_trpbotby db">by WilhelmP293962 on 2013-08-29T11:10:25-04:00 from Colombo, Sri Lanka</em></span> </div>
                                                                                                        <div class="col-md-3"> <span class="htd_trpbotimg"> User Rating : <span class="htliq_htiq_sprite">5/5 <img src="http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/5.0-15797-1.gif"></span> </span> </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div id="summary_0"> <span class="htd_trpbotcnt_rev" id="summary">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress......</span></div>
                                                                                                <div class="htd_trpbotcnt_rev" id="review_0" style="display:none">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress and Miss Poornima at the front office desk did extend their services going even beyond their allowed limitations with the intention of assisting and satisfying the customers.The kitchen staff and not forgetting the main man behind the screen the "Chef" served us with excellent authentic Indian food. In one word it was "FANTASTIC" and would suit any pallet with no doubt.The staff too is very friendly and cooperative willing to fulfill the needs of  the customers, understanding their value -categorizing them as 'Customer is the king,We wish them good luck from the bottom of our hearts..</div>
                                                                                            </li>
                                                                                            <li class="htd_trpbotli">
                                                                                                <div class="htd_trp_hdng">"Remarkable servised hotel appartment in deed expressing my self in a short statement"</div>
                                                                                                <div class="htd_trpbotcnt">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-9"> <span class="htd_trpbotcont"> <em class="htd_trpbotby db">by WilhelmP293962 on 2013-08-29T11:10:25-04:00 from Colombo, Sri Lanka</em></span> </div>
                                                                                                        <div class="col-md-3"> <span class="htd_trpbotimg"> User Rating : <span class="htliq_htiq_sprite">5/5 <img src="http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/5.0-15797-1.gif"></span> </span> </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div id="summary_0"> <span class="htd_trpbotcnt_rev" id="summary">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress......</span></div>
                                                                                                <div class="htd_trpbotcnt_rev" id="review_0" style="display:none">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress and Miss Poornima at the front office desk did extend their services going even beyond their allowed limitations with the intention of assisting and satisfying the customers.The kitchen staff and not forgetting the main man behind the screen the "Chef" served us with excellent authentic Indian food. In one word it was "FANTASTIC" and would suit any pallet with no doubt.The staff too is very friendly and cooperative willing to fulfill the needs of  the customers, understanding their value -categorizing them as 'Customer is the king,We wish them good luck from the bottom of our hearts..</div>
                                                                                            </li>
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
                                                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!--                <div class="white-container htl-dtls-amen">
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
                                </div>-->
                <!--                <div class="white-container htl-dtls-amen">
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
                                </div>-->
                <!--                <div class="white-container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="searchHdr">Related hotels</div>
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-12 htl-type"> <img src="<?php echo WEB_DIR; ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                                            <div class="htl-type-dtls">
                                                <div class="row">
                                                    <div class="col-md-12 htlDetailsCntr">
                                                        <div class="htlname">The Hotel</div>
                                                        <div class="htlreview">
                                                            <div class="review">
                                                                <span class="taLogo"></span>
                                                                <span title="4/5" class="rating"></span>
                                                                <span><a class="hotelDetails font12" data-hash="#taReviews">282 reviews</a></span>
                                                            </div>
                                                        </div>
                                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                                        <a href="#"> VIEW DETAILS</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 htl-type"> <img src="<?php echo WEB_DIR; ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                                            <div class="htl-type-dtls">
                                                <div class="row">
                                                    <div class="col-md-12 htlDetailsCntr">
                                                        <div class="htlname">The Hotel</div>
                                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                                        <a href="#"> VIEW DETAILS</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 htl-type"> <img src="<?php echo WEB_DIR; ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                                            <div class="htl-type-dtls">
                                                <div class="row">
                                                    <div class="col-md-12 htlDetailsCntr">
                                                        <div class="htlname">The Hotel</div>
                                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                                        <a href="#"> VIEW DETAILS</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 htl-type"> <img src="<?php echo WEB_DIR; ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                                            <div class="htl-type-dtls">
                                                <div class="row">
                                                    <div class="col-md-12 htlDetailsCntr">
                                                        <div class="htlname">The Hotel</div>
                                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                                        <a href="#"> VIEW DETAILS</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                <div class="white-container marginTop15">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">Nearby hotels</div>
                        </div>
                    </div>

                    <div class="row">

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
                                            <a title="<?php echo $popular->hotel_name ?>"  href="<?php echo WEB_URL; ?>hotel/hotel_detail/<?php echo $popular->api_temp_hotel_id; ?>"> VIEW DETAILS</a> </div>
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
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/gallery.js"></script>



