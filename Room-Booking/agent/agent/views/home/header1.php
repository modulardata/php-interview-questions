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
        <title>:: Roombooking ::</title>

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
    <body>
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
                    <div class="col-md-4 Tickmango_logo"><a href="<?php echo WEB_URL; ?>"><img src="<?php echo WEB_DIR; ?>public/img/logo.png" align="tickmango"></a></div>
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
                            <div class="col-md-12 userNav pull-right">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
