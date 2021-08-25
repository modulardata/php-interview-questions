<?php echo $this->load->view('home/homeheader'); ?>
<!-- Search section
    ================================================== -->
<div class="SearchSection">

    <div class="container banner_top_text"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <?php
                if ($search_key == '0') {
                    echo $this->load->view('home/search_form');
                } else if ($search_key == '1') {
                    echo $this->load->view('home/search_formd');
                } else if ($search_key == '2') {
                    echo $this->load->view('home/search_formi');
                }
                ?>
            </div>
            <div class="col-md-5">
                <div class="banner_add"><img src="<?php echo WEB_DIR; ?>public/img/bannerAdd.jpg" style="width:100%" alt="banner add"></div>
         
            </div>
        </div>
    </div>
</div>

<!-- Marketing messaging and featurettes
    ================================================== --> 
<!-- Wrap the rest of the page in another container to center all the content. -->

<!-----  Top destination content ----->
<div class="topDestination">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><span>Top Destinations</span></h3>
                <div class="topDestinationScrollCntr">
                    <div class=" jcarousel-skin-tango">
                        <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                            <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                                <ul id="mycarousel" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: -595px; width: 950px;">
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/mysore.jpg" alt="top destinations">
                                        <span>
                                            <h5>Mysore</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/MYSORE (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-2 jcarousel-item-2-horizontal" jcarouselindex="2" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/goa.jpg" alt="top destinations">
                                        <span>
                                            <h5>Goa</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/GOA (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-3 jcarousel-item-3-horizontal" jcarouselindex="3" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Singapore</h5>
                                            <a href="<?php echo WEB_URL; ?>home/int_search/Singapore, Singapore">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-4 jcarousel-item-4-horizontal" jcarouselindex="4" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/york.jpg" alt="top destinations">
                                        <span>
                                            <h5>New York City</h5>
                                            <a href="<?php echo WEB_URL; ?>home/int_search/New York City, USA">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-5 jcarousel-item-5-horizontal" jcarouselindex="5" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/agra.jpg" alt="top destinations">
                                        <span>
                                            <h5>Agra</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/AGRA (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-6 jcarousel-item-6-horizontal" jcarouselindex="6" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/amritsar.jpg" alt="top destinations">
                                        <span>
                                            <h5>Amritsar</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/AMRITSAR (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-7 jcarousel-item-7-horizontal" jcarouselindex="7" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/pic2.jpg" alt="top destinations">
                                        <span>
                                            <h5>London</h5>
                                           <a href="<?php echo WEB_URL; ?>home/int_search/London, Canada">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-7 jcarousel-item-7-horizontal" jcarouselindex="7" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/top-destinations/pic2.jpg" alt="top destinations">
                                        <span>
                                            <h5>Sydney, Australia</h5>
                                            <a href="<?php echo WEB_URL; ?>home/int_search/Sydney, Australia">More Details</a>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                            <div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div>
                            <div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-----  featured content ----->
<div class="featuredContent">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Featured Offers <a href="#" class="pull-right">More Details</a></h3>
                <div class="featuredContentScrollCntr">
                    <div class=" jcarousel-skin-tango">
                        <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                            <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                                <ul id="mycarousel2" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: -595px; width: 950px;">
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Bangalore</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/BANGALORE (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-2 jcarousel-item-2-horizontal" jcarouselindex="2" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Chennai</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/CHENNAI (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-3 jcarousel-item-3-horizontal" jcarouselindex="3" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Sydney</h5>
                                            <a href="<?php echo WEB_URL; ?>home/int_search/Sydney, Australia">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-4 jcarousel-item-4-horizontal" jcarouselindex="4" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Sydney</h5>
                                            <a href="<?php echo WEB_URL; ?>home/int_search/Sydney, Australia">More Details</a>
                                        </span>
                                    </li>
                                    <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-5 jcarousel-item-5-horizontal" jcarouselindex="5" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Dubai</h5>
                                            <a href="<?php echo WEB_URL; ?>home/int_search/Dubai, UAE">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-6 jcarousel-item-6-horizontal" jcarouselindex="6" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Shimla</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/SHIMLA (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-7 jcarousel-item-7-horizontal" jcarouselindex="7" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Shimoga</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/SHIMOGA (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-8 jcarousel-item-8-horizontal" jcarouselindex="8" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Hawaii Beaches</h5>
                                            <a href="<?php echo WEB_URL; ?>home/search/SHIMOGA (India)">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-9 jcarousel-item-9-horizontal" jcarouselindex="9" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Hawaii Beaches</h5>
                                            <a href="#">More Details</a>
                                        </span>
                                    </li>
                                    <li class=" jcarousel-item jcarousel-item-horizontal jcarousel-item-10 jcarousel-item-10-horizontal" jcarouselindex="10" style="float: left; list-style: none;"><img src="<?php echo WEB_DIR; ?>public/img/featured/pic1.jpg" alt="top destinations">
                                        <span>
                                            <h5>Hawaii Beaches</h5>
                                            <a href="#">More Details</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div>
                            <div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"> <img src="<?php echo WEB_DIR; ?>public/img/Add-pic.jpg" width="100%" style="margin-top:44px;" alt="Budget friendly thailand"></div>
        </div>
     
    </div>
</div>
<?php echo $this->load->view('home/homefooter'); ?>
<script src="<?php echo WEB_DIR; ?>public/js/customize.js"></script>
<!-- Datepicket Script-->
<script src="<?php echo WEB_DIR ?>public/js/datepickerScript.js"></script>

<!-- Airport AutoComplete List-->
<!--<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-ui.min.js"></script>
<!--<link rel="stylesheet" href="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-ui.min.css" type="text/css" /> -->
<script type="text/javascript">
    $(function() {	
        $("#hotelcity").autocomplete({
            source: "<?php echo WEB_URL; ?>home/hotel_autolist",
            minLength: 2,
            autoFocus: true
        });
    });
    $(function() {	
        $("#hotelcityd").autocomplete({
            
            source: "<?php echo WEB_URL; ?>home/dhotel_autolist",
            minLength: 2,
            autoFocus: true
        });
    });

</script>
</body>
</html>
