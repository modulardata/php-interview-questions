<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="docs-assets/ico/favicon.ico">
<title>loading...</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR; ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/custom.css">
<!--<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customhome.css">-->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<!-- NAVBAR
================================================== -->
<body onload="call()">
    
<div class="navbar-wrapper">
            <div class="container">
               <a href="<?php echo WEB_URL; ?>home/index"><div class="col-md-4 logo">
                    <img src="<?php echo WEB_DIR; ?>public/img/logo.png" style="width:100%;height:98px" alt="Roombooking">
                    </div></a>
                <div class="col-md-8">
                    <div class="row topsearchSection">
                        <div class="col-md-8 userNav">
                            <ul>
                                <?php
                                $user = $this->session->userdata('user_logged_in');
                                if ($user != '1') {
                                    ?>
                                    <li><a href="#" data-toggle="modal" data-target="#modalLogin"><span class="glyphicon glyphicon-lock"></span> Sign In</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modalRegister2"><span class="glyphicon glyphicon-user"></span> Register</a></li>
    <!--                                    <li><a href="#" data-toggle="modal" data-target="#"><span class="glyphicon glyphicon-cog"></span>Booking History</a></li>-->
                                    <li><a href="<?php echo WEB_DIR; ?>agent"><span class="glyphicon glyphicon-user"></span> Agent</a></li>
                                <?php } else { ?>
                                    <li>
                                        <div class="dropdown">
                                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
                                                Welcome <?php echo $this->session->userdata('user_first_name'); ?><span class="caret"></span>
                                            </a>                
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                <li><a href="<?php echo WEB_URL; ?>">Dashboard</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>user/user_booking"><span class="glyphicon glyphicon-cog"></span>Booking History</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>user/view_profile">Profile</a></li>
                                                <li><a href="#">Travellers</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>user/change_password">Settings</a></li>

                                                <li><a href="<?php echo WEB_URL; ?>user/logout"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
<!--                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav">
                                <ul>
                                    <li><a href="<?php echo WEB_URL; ?>" class="active">HOME</a></li>
<!--                                    <li><a href="#">HOTELS</a></li>-->

                                    <li><a href="<?php echo WEB_URL; ?>home/about_us">ABOUT US</a></li>
                                    <li><a href="<?php echo WEB_URL; ?>home/contact_us">TESTIMONILAS</a></li>
                                    <li><a href="<?php echo WEB_URL; ?>home/contact_us">CONTACT US</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<form name="searchProgress" action="<?php print WEB_URL; ?>dhotel/search_progress" onSubmit="return ray.ajax()" method="post">
    <input name="api_name" type="hidden" value="travelguru" readonly />
</form>

<!-----  Top destination content ----->
<div class="flightsContainer">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-criteria"><strong>Location:</strong> 
                                <?php
                                $hotel_search_data = $this->session->userdata('hotel_search_data');
                                $room_datasess = $this->session->userdata('room_data');
                                echo $hotel_search_data['city'];
                                ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Check In: <?php echo $hotel_search_data['checkin']; ?> - Check Out: <?php echo $hotel_search_data['checkout']; ?>
                 <!--<span class="flt-criteria"> ( Fri, 27 Dec | <span id="flt-adult">1 adult</span> | <span id="flt-children">1 Children</span> )</span>--> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span> <span class="result-date-range pull-right"> <!--<span>DATES: </span> <a href="#" class="date">JAN 29</a> <a href="#" class="date">JAN 30</a> <a href="#" class="date active">JAN 31</a> <a href="#" class="date">FEB 1</a> <a href="#" class="date">FEB 2</a> </span> --></div>
                            <div class="modify-search"> <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                <div class="row">
                                    <div class="col-md-7">
                                        <form role="form">
                                            <!--Search critiria for flights-->
                                            <div class="searchpanel">
                                                <div class="padder">
                                                    <div id="flight-search">
                                                        <h3>Modify your Search</h3>

                                                        <div id="O-R-Trip">
                                                            <div class="row form-group">
                                                                <div class="col-md-6">
                                                                    <label for="inputCity">Location</label>
                                                                    <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcity" type="text" class="form-control" required />
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="inputCity">Check in</label>
                                                                    <input placeholder="CHECK IN" class="datePickerIcon form-control" id="datepicker"  name="checkin" readonly required />
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="inputCity">Check out</label>
                                                                    <input placeholder="CHECK OUT" class="datePickerIcon form-control" id="datepicker1"  name="checkout" readonly required />
                                                                </div>

                                                            </div>

                                                            <div class="row" id="room1">
                                                                <div class="col-md-2 htl-rooms">
                                                                    <label>Rooms</label>
                                                                    <select class="form-control" id="rooms" name="room_count">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <!--                                                    <option value="4">4</option>-->
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-adults" >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control" name="adult[]">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-selectChild">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control selectchildAge" id="slect-room1ChildAge" name="child[]">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge1" id="htl-child1Age-room1">
                                                                    <label>Child 1 Age</label>
                                                                    <select class="form-control" name="childage_1_1">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room1">
                                                                    <label>Child 2 Age</label>
                                                                    <select class="form-control" name="childage_1_2">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room1">
                                                                    <label>Child 3 Age</label>
                                                                    <select class="form-control" name="childage_1_3">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="room2">
                                                                <div class="col-md-2 htl-rooms"><span>Room 2</span></div>
                                                                <div class="col-md-2 htl-adults" >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control" name="adult[]">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-selectChild">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control selectchildAge" id="slect-room2ChildAge" name="child[]">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room2">
                                                                    <label>Child 1 Age</label>
                                                                    <select class="form-control" name="childage_2_1">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room2">
                                                                    <label>Child 2 Age</label>
                                                                    <select class="form-control" name="childage_2_2">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room2">
                                                                    <label>Child 3 Age</label>
                                                                    <select class="form-control" name="childage_2_3">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="room3">
                                                                <div class="col-md-2 htl-rooms"><span>Room 3</span></div>
                                                                <div class="col-md-2 htl-adults" >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control" name="adult[]">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-selectChild">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control selectchildAge" id="slect-room3ChildAge" name="child[]">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room3">
                                                                    <label>Child 1 Age</label>
                                                                    <select class="form-control" name="childage_3_1">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room3">
                                                                    <label>Child 2 Age</label>
                                                                    <select class="form-control" name="childage_3_2">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room3">
                                                                    <label>Child 3 Age</label>
                                                                    <select class="form-control" name="childage_3_3">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="searchBtncntr">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">SEARCH HOTELS <i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
                                                </li>
                                                <li>
                                                    <h4><i class="fa fa-caret-down"></i> Amenities</h4>
                                                    <div class="hotel-search-cntr amenities" style="display:none;">
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Air conditioning<span class="hotel_counts">324</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Bar<span class="hotel_counts">12</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Business centre<span class="hotel_counts">56</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Coffee shop<span class="hotel_counts">65</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Gym<span class="hotel_counts">37</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Internet Access<span class="hotel_counts">86</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Pool<span class="hotel_counts">112</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Restaurant<span class="hotel_counts">37</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
                                                            Room service<span class="hotel_counts">86</span></label>
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="star">
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- baggage rules -->

<?php echo $this->load->view('home/footer'); ?>
<script type="text/javascript">

    function call()
    {	
        document.searchProgress.submit();
    }

</script>
<!--Custom loader for results-->
<div class="loader" style="display:block;"><span>Searching for Hotels ...</span></div>
<!--Results loads here-->