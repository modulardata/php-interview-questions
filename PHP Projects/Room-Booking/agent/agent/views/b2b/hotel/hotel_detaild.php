<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<?php echo $map['js']; ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">


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
                                    <div>
                                        <h3>Hotel Search Details</h3>
                                        <?php $hotel_search_data = $this->session->userdata('hotel_search_data'); ?>

                                        <div class="row">
                                            <div class="col-md-3"> 
                                                Hotel Name:
                                            </div>
                                            <div class="col-md-3"> 
                                                <strong><?php echo $hotel_detail->hotel_name ?></strong>
                                            </div>
                                            <div class="col-md-3"> 
                                                Location: 
                                            </div>
                                            <div class="col-md-3"> 
                                                <?php echo $hotel_search_data['city']; ?>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"> 
                                                Check In: 
                                            </div>
                                            <div class="col-md-3"> 
                                                <?php echo $hotel_search_data['checkin']; ?>
                                            </div>
                                            <div class="col-md-3"> 
                                                Check Out:
                                            </div>
                                            <div class="col-md-3"> 
                                                <?php echo $hotel_search_data['checkout']; ?>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <?php
                                            $adultvalue = $hotel_search_data['adultvalue'];
                                            $childvalue = $hotel_search_data['childvalue'];
                                            $room_count = $hotel_search_data['room_count'];

                                            for ($j = 0; $j < $room_count; $j++) {

                                                $acount = +$adultvalue[$j];
                                                $ccount = +$childvalue[$j];

                                                $adult_count = $adult_count + $acount;
                                                $child_count = $child_count + $ccount;
                                            }
                                            ?>
                                            <div class="col-md-3"> 
                                                Adults: 
                                            </div>
                                            <div class="col-md-3"> 
                                                <?php echo $adult_count; ?>
                                            </div>
                                            <div class="col-md-3"> 
                                                Child:
                                            </div>
                                            <div class="col-md-3"> 
                                                <?php echo $child_count; ?>
                                            </div>

                                        </div>

                                    </div>
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
                                                   <div class="col-md-3"> 

                                                        <span><p><?php if ($rooms->rate_plan_inclusion) echo $rooms->rate_plan_inclusion;else echo 'Room Only'; ?></p></span><br/>
                                                        <a href="javascript:void(0)" onclick="return moreroomfull('<?php echo $rooms->hotel_search_result_info_id; ?>');">More</a>

                                                                                    <!--<a class="htl-ind-rm-dtls">VIEW DETAILS <i class="fa fa-caret-down"></i></a>-->
                                                    </div>
                                                    <div class="col-md-3"> <a href="#"><?php echo 'Adults: ' . $rooms->adult_max_occ . 'Child: ' . $rooms->child_max_occ; ?></a> </div>
                                                    <div class="col-md-3 htl-rm-price"> <span><i class="fa fa-rupee"></i><?php echo round($rooms->total_amount, 0); ?></span> <span class="font12">(all incl. )</span>
                                                        <div>
                                                            <form action="<?php echo WEB_URL; ?>hoteld/pre_booking" method="post">
                                                                <input type="hidden" value="<?php echo $rooms->room_type_code; ?>" name="room_type_code">
                                                                <input type="hidden" value="<?php echo $rooms->rate_plan_code; ?>" name="rate_plan_code">
                                                                <input type="hidden" value="<?php echo $rooms->hotel_code; ?>" name="hotel_code">
                                                                <input type="hidden" value="<?php echo $rooms->hotel_search_result_info_id; ?>" name="hotel_search_result_info_id">
                                                                <input type="hidden" value="<?php echo $rooms->net_amount; ?>" name="net_amount">
                                                                <input type="hidden" value="<?php echo round($rooms->total_amount, 0); ?>" name="total_amount">
                                                                <input type="hidden" value="<?php echo $rooms->tax; ?>" name="tax">
                                                                <input type="hidden" value="<?php echo $rooms->admin_markup; ?>" name="admin_markup">
                                                                <input type="hidden" value="<?php echo $rooms->admin_markup; ?>" name="admin_markup">
                                                                <input type="hidden" value="<?php echo $rooms->payment_charge; ?>" name="payment_charge">

                                                                <button type="submit" class="btn btn-primary"> BOOK  <i class="fa fa-angle-double-right"></i> </button>
                                                            </form>


                                                        </div>
                                                    </div>
                                                </div>
                                                   <div class="row" id="more_details_<?php echo $rooms->hotel_search_result_info_id; ?>" style="display:none;">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="<?php echo $rooms->room_image; ?>" width="80" height="80"></img>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <p style="text-align: justify">  <?php echo $rooms->room_description; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p><b>Inclusion</b></p>
                                                            <p><?php if ($rooms->rate_plan_inclusion) echo $rooms->rate_plan_inclusion;else echo 'Room Only'; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p><b>Cancellation Policy</b></p>
                                                            <p style="text-align: justify"> <?php echo substr($rooms->calcellation_policy, 0, -1); ?></p>
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
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="htd_trrtwrp" id="gi_htl_reviewTA">
                                                            <ul class="htd_tradul">
                                                                <li class="htd_tradli">
                                                                    <div class="htd_tradrt"><b>TripAdvisor traveller rating:</b> <span>(based on <?php echo ': ' . $hotel_review_count; ?>  reviews)</span></div>
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
                                                                                    <div class="htd_trp_hdng">"<?php echo substr($val->comments, 0, 80); ?>..."</div>
                                                                                    <div class="htd_trpbotcnt">
                                                                                        <div class="row">
                                                                                            <div class="col-md-9"> <span class="htd_trpbotcont"> <em class="htd_trpbotby db">by <?php echo $val->customer_name; ?> from <?php echo $val->customer_city; ?>, <?php echo $val->customer_country; ?></em></span> </div>
                                                                                            <div class="col-md-3"> <span class="htd_trpbotimg"> User Rating : <span class="htliq_htiq_sprite"><?php echo $val->room_quality; ?>/5 </span> </span> </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="summary_0"> <span class="htd_trpbotcnt_rev" id="summary"><?php echo $val->comments; ?></span></div>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </ul>
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="white-container">
                    <?php
                    if ($nearby_hotel !== '') {
                        ?>
                        <div class="white-container">
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

<script>
    function moreroomfull(hotel_code){
        // alert('hotel_code');
        $("#more_details_"+hotel_code).toggle(500);

    }
    $( ".loop:odd" ).css( "background-color", "#009ed9" ).css("color","white");
    //$( ".review_contailer:odd" ).css( "background-color", "grey" ).css("color","white");
</script>
<?php echo $this->load->view('home/footer'); ?>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/gallery.js"></script>