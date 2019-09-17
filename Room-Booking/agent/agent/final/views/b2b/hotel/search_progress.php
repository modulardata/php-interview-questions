<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo WEB_DIR; ?>public/ico/favicon.ico">
        <title>:: tickmango ::</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR; ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/custom.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->

    </head>
    <!-- NAVBAR
    ================================================== -->
    <body  onload="call()">
        <form name="searchProgress" action="<?php print WEB_URL; ?>hotel/search_progress" onSubmit="return ray.ajax()" method="post">
            
                <input name="api_name" type="hidden" value="<?php echo $api_name_h; ?>" readonly />
          
        </form>
        <div class="navbar-wrapper">
            <div class="top-menu acm">
                <div class="menuBtn acm"></div>
                <div class="top-menu-drop acm">
                    <div class="arrow-up acm"></div>
                    <ul class="acm">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="#"><i class="fa fa-users"></i> About Us</a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> Testimonials</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Reach Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="top-search acs">
                <div class="searchBtn acs"></div>
                <div class="top-search-drop acs">
                    <div class="input-group acs">
                        <input type="text" class="form-control acs" placeholder="Search">
                        <span class="input-group-btn acs">
                            <button class="btn btn-default acs" type="button"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 Tickmango_logo"><a href="<?php echo WEB_URL; ?>home/index"><img src="<?php echo WEB_DIR; ?>public/img/logo.png" align="tickmango"></a></div>
                    <div class="col-md-8">
                        <div class="row topsearchSection">
                            <!--<div class="col-md-4 pull-right">
                                    <div class="row">
                                    <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                 </div>
                                </div>
                            </div>-->
                            <div class="col-md-8 userNav pull-right">
                                <ul>
                                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign In</a></li>
                                    <li style="display:none;"><a href="#"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Manage Booking</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-remove-circle"></span> Cancellation</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-----  Top destination content ----->
        <div class="selectBusCntr">
            <div class="container">
                <div class="row">
                    <div class="busesCntr">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-criteria">
                                        <span class="htl-loc">Chennai, India: </span>Check In: Sat Nov 30 2013 - Check Out: Sun Dec 01 2013
                                    </div>
                                    <div class="search-criteria-counts">
                                        <span class="htl-critrerias-counts"><i class="fa fa-home"></i> <span>2</span>Rooms</span>
                                        <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>2</span>Adults</span>
                                        <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>3</span>Children</span>
                                        <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span>
                                    </div>
                                    <div class="search-criteria modify-search">
                                        <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form role="form">
                                                    <!--Search critiria for hotel-->
                                                    <div class="searchpanel">
                                                        <div class="padder">
                                                            <div class="form-group">
                                                                <h3>Book Hotel Online</h3>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="inputCity">From City</label>
                                                                        <input type="text" class="form-control" id="inputTOCity" placeholder="Enter a City">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="inputCity">To City</label>
                                                                        <input type="text" class="form-control" id="inputFromCity" placeholder="Enter a City">
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                                    <label for="fromDate">Date of Journey</label>
                                                                    <input type="text" class="form-control" placeholder="From Date" id="dph1" autocomplete= "off">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="toDate">Date of Return (Optional)</label>
                                                                    <input type="text" class="form-control" placeholder="To Date" value id="dph2" autocomplete= "off">
                                                                </div>
                                                            </div>
                                                            <div class="row" id="room1">
                                                                <div class="col-md-2 htl-rooms">
                                                                    <label>Rooms</label>
                                                                    <select class="form-control" id="rooms">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-adults" >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-selectChild">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control selectchildAge" id="slect-room1ChildAge">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge1" id="htl-child1Age-room1">
                                                                    <label>Child 1 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room1">
                                                                    <label>Child 2 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room1">
                                                                    <label>Child 3 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="room2">
                                                                <div class="col-md-2 htl-rooms"><span>Room 2</span></div>
                                                                <div class="col-md-2 htl-adults" >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-selectChild">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control selectchildAge" id="slect-room2ChildAge">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room2">
                                                                    <label>Child 1 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room2">
                                                                    <label>Child 2 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>

                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room2">
                                                                    <label>Child 3 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="room3">
                                                                <div class="col-md-2 htl-rooms"><span>Room 3</span></div>
                                                                <div class="col-md-2 htl-adults" >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-selectChild">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control selectchildAge" id="slect-room3ChildAge">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room3">
                                                                    <label>Child 1 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room3">
                                                                    <label>Child 2 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>

                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room3">
                                                                    <label>Child 3 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="room4">
                                                                <div class="col-md-2 htl-rooms"><span>Room 4</span></div>
                                                                <div class="col-md-2 htl-adults" >
                                                                    <label>Adults (12+)</label>
                                                                    <select class="form-control">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-selectChild">
                                                                    <label>Child(0-12)</label>
                                                                    <select class="form-control selectchildAge" id="slect-room4ChildAge">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge1" id="child1Age-room4">
                                                                    <label>Child 1 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room4">
                                                                    <label>Child 2 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>

                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room4">
                                                                    <label>Child 3 Age</label>
                                                                    <select class="form-control">
                                                                        <option value=""></option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>        
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="5">6</option>
                                                                        <option value="5">7</option>
                                                                        <option value="5">8</option>
                                                                        <option value="5">9</option>
                                                                        <option value="5">10</option>
                                                                        <option value="5">11</option>
                                                                        <option value="5">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="searchBtncntr" style="padding-top:20px;">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">SEARCH HOTELS</button>
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

        <div class="hotelCntr">
            <div class="container">

                <!--hotel search section-->
                <div class="row">
                    <div class="col-md-3">
                        <div class="hotelSearchFilter">
                            <div class="searchHdr">Refine your search</div>
                            <div><span>243 matches found</span></div>
                            <div class="htl-filterCntr">
                                <div>Hotel Star rating</div>
                                <label><input type="checkbox" name="star"> 1<i class="fa fa-star"></i></label></label>
                                <label><input type="checkbox" name="star"> 2<i class="fa fa-star"></i></label></label>
                                <label><input type="checkbox" name="star"> 3<i class="fa fa-star"></i></label></label>
                                <label><input type="checkbox" name="star"> 4<i class="fa fa-star"></i></label></label>
                                <label><input type="checkbox" name="star"> 5<i class="fa fa-star"></i></label></label>
                            </div>

                            <div class="htl-filterCntr">
                                <div>Search by Popularity</div>
                                <select class="form-control">
                                    <option value="option" selected>Lowest price</option>
                                    <option value="option" >Highest price</option>
                                    <option value="option" >Low Star rating</option>
                                    <option value="option" >Low High rating</option>
                                </select>
                            </div>

                            <div class="htl-filterCntr">
                                <div>Search by Name</div>
                                <div class="input-group acs">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                            </div>

                            <div class="htl-filterCntr">
                                <div>Search by price <span class="perRoom">(per room per night)</span></div>
                                <select class="form-control">
                                    <option value="option" selected>500 - 1000</option>
                                    <option value="option" >1000 - 1500</option>
                                    <option value="option" >2000 - 3000</option>
                                    <option value="option" >3000 - 5000</option>
                                    <option value="option" >5000 - 8000</option>
                                </select>
                            </div>

                            <div class="htl-filterCntr">
                                <div>Search by Location</div>
                                <select class="form-control">
                                    <option value="option">Option</option>
                                </select>
                            </div>

                            <div class="htl-filterCntr htl-amnts">
                                <div>Amenities</div>
                                <label><input type="checkbox" name="star"> Gym/ Spa</label></label>
                                <label><input type="checkbox" name="star"> Internet Access</label></label>
                                <label><input type="checkbox" name="star"> Meeting Facilities</label></label>
                                <label><input type="checkbox" name="star"> Parking Facility</label></label>
                                <label><input type="checkbox" name="star"> Swimming Pool</label></label>
                                <label><input type="checkbox" name="star"> Restaurant/ Coffe Shop</label></label>
                                <label><input type="checkbox" name="star"> Travel Assistance</label></label>

                            </div>
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