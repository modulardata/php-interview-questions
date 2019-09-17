<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
<!--        <link rel="shortcut icon" href="docs-assets/ico/favicon.ico">-->
        <title>:: Roombooking ::</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR; ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customhome.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">


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
                                $user = $this->session->userdata('agent_logged_in');
                                if ($user == '1') {
                                    ?>

                                    <li>
                                        <div class="dropdown">
                                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
                                                <?php echo $this->session->userdata('agency_name') ?><span class="caret"></span>
                                            </a>                
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                <li><a href="<?php echo WEB_URL; ?>home/dashboard">Dashboard</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>home/booking"><span class="glyphicon glyphicon-cog"></span>Manage Booking</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>home/view_profile">Profile</a></li>

                                                <li><a href="#">Settings</a></li>
                                                <li><a href="#"><span class="glyphicon glyphicon-remove-circle"></span>cancellation</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>home/logout"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <?php
                                } else {
                                    ?>
    <!--                                        <li><a href="#" data-toggle="modal" data-target="#modalLogin"><span class="glyphicon glyphicon-lock"></span> Sign In</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalRegister"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                                            <li><a href="<?php echo WEB_DIR; ?>agent"><span class="glyphicon glyphicon-user"></span> Agent</a></li>-->

                                    <?php
                                }
                                ?>


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

                </div>
            </div>
        </div>

<!-- agent navigation  -->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="<?php echo WEB_URL; ?>home/dashboard">Dashboard</a></li>
                <li><a href="<?php echo WEB_URL; ?>home/view_profile">My Profile</a></li>
                <li><a href="<?php echo WEB_URL; ?>home/booking">Booking History</a></li>
                <li ><a href="<?php echo WEB_URL; ?>home/deposit_history">Deposit History</a></li>
                <li><a href="<?php echo WEB_URL; ?>home/markup_manager">Markup Management</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/custom.css">
<!-----  Top destination content ----->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">

<!-----  Top destination content ----->
<div class="selectBusCntr">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-criteria">
                                <span class="htl-loc"><?php
                                    $hotel_search_data = $this->session->userdata('hotel_search_data');
                                    $room_datasess = $this->session->userdata('room_data');
                                    echo $hotel_search_data['city'];
                                    ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Check In: <?php echo $hotel_search_data['checkin']; ?> - Check Out: <?php echo $hotel_search_data['checkout']; ?>
                            </div>
                            <div class="search-criteria-counts">
                                <span class="htl-critrerias-counts"><i class="fa fa-home"></i> <span><?php echo $hotel_search_data['room_count'] ?></span>Rooms</span>
                                <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span><?php echo $room_datasess['adult_count']; ?></span>Adults</span>
                                <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span><?php echo $room_datasess['child_count']; ?></span>Children</span>
                                <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span>
                            </div>
                            <div class="search-criteria modify-search">
                                <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                <?php if ($api == 'hotelpro') { ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="<?php echo WEB_URL; ?>hotel/hotel_search" method="post">
                                                <!--Search critiria for hotel-->
                                                <div class="searchpanel">
                                                    <div class="padder">
                                                        <div class="form-group">
                                                            <h3>Book Hotel Online</h3>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="inputCity">Location</label>
                                                                    <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcity" type="text" class="form-control" required />
                                                                </div>
                                                                <!--                                                            <div class="col-md-6">
                                                                                                                                <label for="inputCity">To City</label>
                                                                                                                                <input type="text" class="form-control" id="inputFromCity" placeholder="Enter a City">
                                                                                                                            </div>-->
                                                            </div>  
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                                <label for="fromDate">Check-in</label>
                                                                <input type="text" class="form-control datePickerIcon" placeholder="From Date" name="checkin" id="datepicker" autocomplete= "off">
                                                                <input id="date_depart" type="hidden" value="<?php echo date('d/m/Y'); ?>" />  
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="toDate">Check-out</label>
                                                                <input type="text" class="form-control datePickerIcon" placeholder="To Date"  name="checkout" id="datepicker1" autocomplete= "off">
                                                            </div>
                                                        </div>
                                                        <div class="row" id="room1">
                                                            <div class="col-md-2 htl-rooms">
                                                                <label>Rooms</label>
                                                                <select class="form-control" id="rooms" name="room_count">
                                                                    <option value="1" selected>1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <!--                                                                <option value="4">4</option>-->
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
                                                                <select class="form-control"  name="childage_1_1">

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
                                                                <select class="form-control" name="childage_1_2">

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
                                                                <select class="form-control" name="childage_1_3" >

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
                                                                <select class="form-control" name="childage_2_2">

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
                                                                <select class="form-control" name="childage_2_3">

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
                                                                <select class="form-control" name="childage_3_2">

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
                                                                <select class="form-control" name="childage_3_3">

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
                                                        <!--                                                    <div class="row" id="room4">
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
                                                                                                            </div>-->
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
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="<?php echo WEB_URL; ?>hotel/hotel_search_domestic" method="post">
                                                <!--Search critiria for hotel-->
                                                <div class="searchpanel">
                                                    <div class="padder">
                                                        <div class="form-group">
                                                            <h3>Book Hotel Online</h3>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="inputCity">Location</label>
                                                                    <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION IN INDIA" name="City" id="hotelcitydom" type="text" class="form-control" required />
                                                                </div>
                                                                <!--                                                            <div class="col-md-6">
                                                                                                                                <label for="inputCity">To City</label>
                                                                                                                                <input type="text" class="form-control" id="inputFromCity" placeholder="Enter a City">
                                                                                                                            </div>-->
                                                            </div>  
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                                <label for="fromDate">Check-in</label>
                                                                <input type="text" class="form-control datePickerIcon" placeholder="From Date" name="checkin" id="datepickerhdom" autocomplete= "off">
                                                                <input id="date_depart" type="hidden" value="<?php echo date('d/m/Y'); ?>" />  
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="toDate">Check-out</label>
                                                                <input type="text" class="form-control datePickerIcon" placeholder="To Date"  name="checkout" id="datepickerhdom1" autocomplete= "off">
                                                            </div>
                                                        </div>
                                                        <div class="row" id="room1">
                                                            <div class="col-md-2 htl-rooms">
                                                                <label>Rooms</label>
                                                                <select class="form-control" id="rooms" name="room_count">
                                                                    <option value="1" selected>1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <!--                                                                <option value="4">4</option>-->
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
                                                                <select class="form-control"  name="childage_1_1">

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
                                                                <select class="form-control" name="childage_1_2">

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
                                                                <select class="form-control" name="childage_1_3" >

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
                                                                <select class="form-control" name="childage_2_2">

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
                                                                <select class="form-control" name="childage_2_3">

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
                                                                <select class="form-control" name="childage_3_2">

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
                                                                <select class="form-control" name="childage_3_3">

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
                                                        <!--                                                    <div class="row" id="room4">
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
                                                                                                            </div>-->
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
                                <?php } ?>
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
<form name="searchProgress" action="<?php print WEB_URL; ?>hoteld/search_progress" onSubmit="return ray.ajax()" method="post">

    <input name="api_name" type="hidden" value="<?php echo $api_name_h; ?>" readonly />

</form>
<!--Custom loader for results-->
<div class="loader" style="display:block;"><span>Searching for Hotels ...</span></div>
<!--Results loads here-->