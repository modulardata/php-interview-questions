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
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customhome.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">


    </head>
    <!-- NAVBAR
    ================================================== -->
    <body>
        <div class="navbar-wrapper">
            <div class="container">
                 <a href="<?php echo WEB_URL; ?>home/index"><div class="col-md-6 logo">
                    <img src="<?php echo WEB_DIR; ?>public/img/logo.png" style="width:100%;height:98px" alt="Roombooking">
                    </div></a>
                <div class="col-md-6">
                    <div class="row topsearchSection">
                        <div class="col-md-12 userNav">
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
                                                <li><a href="<?php echo WEB_URL; ?>home/booking">Booking History</a></li>
                                                <li ><a href="<?php echo WEB_URL; ?>home/deposit_history">Deposit History</a></li>
                                                  <li><a href="<?php echo WEB_URL; ?>home/markup_manager">Markup Management</a></li>
                                                <li><a href="<?php echo WEB_URL; ?>home/view_profile">Profile</a></li>

                                                <li><a href="#">Settings</a></li>
<!--                                                <li><a href="#"><span class="glyphicon glyphicon-remove-circle"></span>cancellation</a></li>-->
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
