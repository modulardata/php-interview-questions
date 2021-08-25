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


<div class="hotelCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-8">
                <div class="hotelResultsCntr padding10"> 
                    <!-- this row will repeat based on hotels availability -->
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="hotel-details"> <span class="font20"><strong><?php echo $hotel_detail->hotel_name ?></strong></span> <br>
                                    <?php echo $hotel_detail->city; ?> 
                                    <?php if ($hotel_detail->star == '0' || $hotel_detail->star == '') { ?>
                                        <span class="star star "></span>
                                    <?php } elseif ($hotel_detail->star == '1') { ?>
                                        <span class="star star1 "></span>
                                    <?php } elseif ($hotel_detail->star == '2') { ?>
                                        <span class="star star2 "></span>
                                    <?php } elseif ($hotel_detail->star == '3') { ?>
                                        <span class="star star3 "></span>
                                    <?php } elseif ($hotel_detail->star == '4') { ?>
                                        <span class="star star4 "></span>
                                    <?php } elseif ($hotel_detail->star == '5') { ?>
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


                                                    <?php for ($k = 1; $k < count($hotel_images); $k++) { ?>

                                                        <li><a href="#"><img src="<?php echo $hotel_images[$k]->image_url; ?>" data-large="<?php echo $hotel_images[$k]->image_url; ?>" alt="image01" data-description="From off a hill whose concave womb reworded" /></a></li>
                                                    <?php } ?>

                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End Elastislide Carousel Thumbnail Viewer -->
                                    </div><!-- rg-thumbs -->
                                </div>
                                <a href="<?php echo WEB_URL ?>dhotel/backtosearch" class="btn btn-primary marginTop10">BACK TO RESULTS</a> </div>
                        </div>
                        <div class="htl-tabs-cntr marginTop15"> 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#htl-overview" data-toggle="tab">Hotel Overview</a></li>
                                <li><a href="#htl-am" data-toggle="tab">Hotel Amenities</a></li>
                                <li><a href="#htl-map" data-toggle="tab">Map & Attractions</a></li>
                                <li><a href="#htl-review" data-toggle="tab">Reviews<?php echo ': ' . $hotel_review_count; ?>  reviews</a></li>
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
                                        
                                            <div class="col-md-3"> 
                                                Adults: 
                                            </div>
                                            <div class="col-md-3"> 
                                                <?php echo $hotel_search_data['adult_count']; ?>
                                            </div>
                                            <div class="col-md-3"> 
                                                Child:
                                            </div>
                                            <div class="col-md-3"> 
                                                <?php echo $hotel_search_data['child_count']; ?>
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
                                        <?php foreach ($hotel_rooms as $rooms) { ?>
                                            <div class="htl-rm-detail">
                                                <div class="row">
                                                    <div class="col-md-4"> 
                                                        <span>
                                                            <?php echo $rooms->room_type_name; ?></span>

                                                                                                                             <!--<a class="htl-ind-rm-dtls">VIEW DETAILS <i class="fa fa-caret-down"></i></a>-->
                                                    </div>
                                                    <div class="col-md-3"> 

                                                        <span><p><?php if ($rooms->rate_plan_inclusion) echo $rooms->rate_plan_inclusion;else echo 'Room Only'; ?></p></span><br/>
                                                        <a href="javascript:void(0)" onclick="return moreroomfull('<?php echo $rooms->hotel_search_result_info_id; ?>');">More</a>
                                                    </div>
                                                    <div class="col-md-3"> <span><!--<i class="fa fa-rupee"></i>--><?php echo 'INR ' . round($rooms->total_amount, 0); ?></span>
                                                        <p>(Including all Tax)</p>
                                                    </div>
                                                    <div class="col-md-2 htl-rm-price"> 
                                                        <div>
                                                            <form action="<?php echo WEB_URL; ?>dhotel/pre_booking" method="post">
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

                                            </div>

                                        <?php } ?>



                                        <!-- hotel details -->
                                        <div class="row htl-desc">

                                            <p><?php echo $hotel_detail->description; ?></p>


                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-am">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div style="float: left">
                                                <h3>Room Amenities</h3>
                                                <ul>
                                                    <?php
                                                    if ($hotel_amenities != '') {
                                                        foreach ($hotel_amenities as $val) {
                                                            if ($val->amenity_type == 'room') {
                                                                ?>
                                                                <li style=" width: 50%; float: left"><?php echo $val->description; ?></li>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>


                                            <div style="float: left">
                                                <h3>Hotel Amenities</h3>
                                                <ul>
                                                    <?php
                                                    if ($hotel_amenities != '') {
                                                        foreach ($hotel_amenities as $val) {
                                                            if ($val->amenity_type == 'property') {
                                                                ?>
                                                                <li style=" width: 50%; float: left"><?php echo $val->description; ?></li>
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
                                <div class="tab-pane htl-dtls-amen" id="htl-review">
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
            <?php if ($nearby_hotel) { ?>
                <div class="col-md-4">
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
                                <div class="col-md-12 htl-type"> 
                                    <?php if ($popular->image != '' || $popular->image != '--None--' || $popular->image != '') { ?>
                                        <img src="<?php echo $popular->image ?>" width="100" height="100" alt="hotel-aloft">
                                    <?php } else {
                                        ?>
                                        <img src="<?php echo WEB_URL ?>public/images/default-htl-img.jpg" width="100" height="100" alt="hotel-aloft">
                                    <?php }
                                    ?>
                                    <div class="htl-type-dtls">
                                        <div class="row">
                                            <div class="col-md-12 htlDetailsCntr">
                                                <div class="htlname"><?php echo $popular->hotel_name ?></div>
                                                <div class="htllocation"> <i class="fa fa-map-marker"></i> Area:<?php echo $popular->location ?> </div>
                                                <a title="<?php echo $popular->hotel_name ?>"  href="<?php echo WEB_URL; ?>dhotel/hotel_detail/<?php echo $popular->hotel_search_result_info_id; ?>"> VIEW DETAILS</a> </div>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                            ?>

                        </div>
                    </div>
                </div>
            <?php } ?>
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



