<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<!-----  Top destination content ----->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">

<!-----  Top destination content ----->
<div class="flightsContainer">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">            
                    <!-- modify search goes here  -->
                    <?php echo $this->load->view('b2b/hotel/modify_search'); ?>
                    <!-- modify search goes here  -->                       
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


                    <!--
                                        <div class="htl-filterCntr htl-amnts">
                                            <div>Amenities</div>
                                            <label><input type="checkbox" name="star"> Gym/ Spa</label></label>
                                            <label><input type="checkbox" name="star"> Internet Access</label></label>
                                            <label><input type="checkbox" name="star"> Meeting Facilities</label></label>
                                            <label><input type="checkbox" name="star"> Parking Facility</label></label>
                                            <label><input type="checkbox" name="star"> Swimming Pool</label></label>
                                            <label><input type="checkbox" name="star"> Restaurant/ Coffe Shop</label></label>
                                            <label><input type="checkbox" name="star"> Travel Assistance</label></label>
                    
                                        </div>-->
                </div>
            </div>
            <div class="col-md-9">
                <div class="hotelResultsCntr">
                    <!-- this row will repeat based on hotels availability -->
                    <?php
                    if ($result != '') {
                        foreach ($result as $data) {
                            $totalPriceAry[] = $data->total_amount;
                            ?>
                            <div class="htlResultRow searchhotel_box">
                                <div class="row HotelInfoBox" data-price="<?php echo $data->total_amount; ?>" data-star="<?php echo $data->star; ?>" data-hotel-name="<?php echo $data->hotel_name; ?>">
                                    <div class="col-md-12">
                                        <div class="dtlsOffer"><i class="fa fa-tags"></i> <?php echo $data->rate_plan_description; ?></div>
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
                                                    <!--<i class="fa fa-rupee"></i>--><?php echo 'INR'; ?>  <?php echo round($data->total_amount, 0); ?>
                                                    <span>(all including tax)</span>
                                                </div>
                                                
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
        <!--                                                <div><label><input type="checkbox" value="1"> Compare</label></div>-->
                                                <div>
                                                    




                                                        <span class="showseat"><a style="color:white" href="<?php echo WEB_URL; ?>hoteld/hotel_detail/<?php echo $data->hotel_search_result_info_id; ?>"><button class="btn btn-success pull-right">SELECT HOTEL </button><i class="fa fa-hand-o-right"></i> </a></span> 


                                                   
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
                    <?php //echo '<pre>';print_r($totalPriceAry);   ?>
                    <input type="hidden" id="setMinPrice" value="<?php if (!empty($totalPriceAry)) echo min($totalPriceAry); else echo '0'; ?>" />                             
                    <input type="hidden" id="setMaxPrice" value="<?php if (!empty($totalPriceAry)) echo max($totalPriceAry); else echo '0'; ?>" />                         
                    <input type="hidden" id="setCurrency" value="<?php echo 'INR'; ?>." /> 
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
        // hotel city domestic
        $("#hotelcityd").autocomplete({
            source: "<?php echo WEB_URL; ?>home/hotel_autolist_dom",
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