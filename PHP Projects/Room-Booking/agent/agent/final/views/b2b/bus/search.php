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
        <title>:: LOADING ::</title>

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
    <body onload="call()">
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
                    <div class="col-md-4 Tickmango_logo"><a href="<?php echo WEB_URL; ?>home/index"><img src="<?php echo WEB_DIR; ?>public/img/logo.png" align="TICKMANGO"></a></div>
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
                    <div class="col-md-12">
                        <h3>Select a Bus</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="busesCntr">
                        <div class="container">
                            <ul class="selecttrip">
                                <li class="active">
                                    <?php $sess = $this->session->userdata('bus_search_data'); ?>
                                    <span id="fromBus"><?php echo $sess['sourcename']; ?></span> to 
                                    <span id="toBus"><?php echo $sess['destiname']; ?></span>
                                    <span class="seats"></span>
                                </li>
                                <!--                                <li>
                                                                    <span id="fromBus">Chennai</span> to 
                                                                    <span id="toBus">Bangalore</span>
                                                                    <span class="seats"> (3143 seats found)</span>
                                                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="busCntr">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 selectedDate">
                        <h4> <?php echo $sess['from_date']; ?></h4>
                    </div>
                </div>

                <!--filters section-->
                <div class="row bus-filters">
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a id="dLabel" class="active" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                <i class="fa fa-truck"></i> Travels <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li>KSRTC Travles</li>
                                <li>VRL Travels</li>
                                <li>SRS Travels</li>
                                <li>Sugama Travels</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                <i class="fa fa-bookmark"></i> Bus Type <span class="caret"></span>
                            </a>                
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><label><input type="checkbox" value="ac">A/C</label></li>
                                <li><label><input type="checkbox" value="nonac">Non A/C</label></li>
                                <li><label><input type="checkbox" value="sleeper">Sleeper</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                <i class="fa fa-user"></i> Amenities <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li>Water Bottle</li>
                                <li>Movie</li>
                                <li>Blanket</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                <i class="fa fa-map-marker"></i> Boarding Points <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li>Bboarding point</li>
                                <li>Another Point</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                <i class="fa fa-map-marker"></i> Dropping Points <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li>Bboarding point</li>
                                <li>Another Point</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                <i class="fa fa-star-half-o"></i> Bus Rating <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li>High rated</li>
                                <li>Low rated</li>
                                <li>All Buses</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--active filter section-->
                <div class="active-filter"></div>

                <!--buses container-->
                <div class="row buses">
                    <div class="col-md-12">
                        <!--Custom loader for results-->
<!--                        <div class="loader" style="display:block;"><span>Searchin for Buses ...</span></div>-->
                        <!--Results loads here-->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        function call()
        {	
            document.searchProgress.submit();
        }

    </script>
    <form name="searchProgress" action="<?php echo WEB_URL; ?>bus/search_progress" onSubmit="return ray.ajax()" method="post">

        <input name="api_name" type="hidden" value="<?php echo $api_name_b; ?>" readonly />
    </form>

    <?php //echo $this->load->view('home/footer'); ?>
    <!--Custom loader for results-->
    <div class="loader" style="display:block;"><span>Searching for Buses ...</span></div>
    <!--Results loads here-->
