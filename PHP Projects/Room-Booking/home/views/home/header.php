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
        <title>:: Roombooking ::</title>

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

        
        
        
        <!--
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        Developed By:   Mallikarjun S
                        Prasanna L
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        -->
        
        
    </head>
    <!-- NAVBAR
    ================================================== -->
    <body>
        <div class="navbar-wrapper">
            <div class="container">
                <a href="<?php echo WEB_URL; ?>home/index">
                    <div class="col-md-6 logo">
                    <img src="<?php echo WEB_DIR; ?>public/img/logo.png" style="width:100%;height:98px" alt="Roombooking">
                    </div></a>
                <div class="col-md-6">
                    <div class="row topsearchSection">
                        <div class="col-md-12 userNav">
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
<!--                                                <li><a href="<?php echo WEB_URL; ?>">Dashboard</a></li>-->
                                                <li><a href="<?php echo WEB_URL; ?>user/user_booking"><span class="glyphicon glyphicon-cog"></span>Booking History</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>user/view_profile">Profile</a></li>
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
                    

                                    <li><a href="<?php echo WEB_URL; ?>home/about_us">ABOUT US</a></li>
                              
                                    <li><a href="<?php echo WEB_URL; ?>home/contact_us">CONTACT US</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign in -->
        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="myModalLabel">Sign in to Roombooking</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" role="form" action="<?php echo WEB_URL; ?>user/user_login" method="post">
                            <h2 class="form-signin-heading">Please sign in</h2>
                            <input type="email" class="form-control form-group" placeholder="Email address" name="user_email" required autofocus="">
                            <input type="password" class="form-control form-group" placeholder="Password" name="user_password" required>
                            <label class="checkbox">
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
            <!-- Register 2 -->
    <div class="modal fade" id="modalRegister2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Get a Roombooking Account</h3>
                </div>
                <div class="modal-body">
                    <form class="form-signin" role="form" action="<?php echo WEB_URL; ?>user/user_register" enctype="multipart/form-data" method="post">
                             <?php if (validation_errors() != "") { ?>
                                                <div class="alert alert-error">
                                                    <button class="close" data-dismiss="alert" type="button">X</button>
                                                    <?php echo validation_errors(); ?>
                                                </div>
                                            <?php } ?>
                        <label>Email address</label>
                        <input type="text" class="form-control form-group" placeholder="Email address" name="user_email" required autofocus="">        
                        <label>Set a password</label>
                        <input type="password" class="form-control form-group" placeholder="Password" name="user_password" required>
                         <label>Set Confirm password</label>
                        <input type="password" class="form-control form-group" placeholder="Confirm Password" name="passconf" required>
                        <label>Your name</label>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control form-group" name="title" required>
                                    <option selected>Title</option>
                                    <option value="Mr">Mr.</option>
                                    <option value="Mrs">Mrs.</option>
                                </select>
                            </div>
                            <div class="col-md-5"><input type="text" class="form-control form-group" placeholder="First name" name="first_name"  required="" autofocus=""></div>
                            <div class="col-md-4"><input type="text" class="form-control form-group" placeholder="Last name" name="last_name" required="" autofocus=""></div>
                        </div>

                        <label>Mobile No.</label>
                        <input type="text" class="form-control form-group" placeholder="Enter your mobile number" name="mobile_no" required="" autofocus="">

                        <label class="checkbox">
                            <input type="checkbox" name="travel_offers" value="1"> Send me travel offers, deals and news by email
                        </label>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
                    </form>
                </div>

            </div>
        </div>
    </div>