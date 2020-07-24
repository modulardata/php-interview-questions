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
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">

        <!--[if IE 7]>
        <link rel="stylesheet" href="css/font-awesome-ie7.css"/>
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->

    </head>
    <!-- NAVBAR
    ================================================== -->
    <body onload="call()">
        <form name="searchProgress" action="<?php print WEB_URL; ?>flight/search_progress" onSubmit="return ray.ajax()" method="post">

            <input name="api_name" type="hidden" value="<?php echo $api_name_f; ?>" readonly />
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
                    <div class="col-md-4 Tickmango_logo"><a href="index.html"><img src="<?php echo WEB_DIR; ?>public/img/logo.png" align="tickmango"></a></div>
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
                                <?php
                                $session_data = $this->session->userdata('flight_search_data');
                                $sess_tripType = $session_data['tripType'];
                                $originCity = explode(',', $session_data['originCity']);
                                $destinationCity = explode(',', $session_data['destinationCity']);

                                $sess_departDate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!', "$3-$2-$1", $session_data['departDate']);
                                ?>

                                <span class="triptype">Oneway Trip: </span><?php echo $originCity[1]; ?> → <?php echo $destinationCity[1]; ?> <span class="flt-criteria"> ( <?php echo date('D, jS M, Y', strtotime($sess_departDate)); ?> <!--| <span id="flt-adult">1 adult</span> | <span id="flt-children">1 Children</span>--> )</span> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span>
                            </div>


                                    <div class="search-criteria modify-search">
                                        <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <form role="form">
                                                    <!--Search critiria for flights-->
                                                    <div class="searchpanel">
                                                        <div class="padder">
                                                            <div id="flight-search">
                                                                <h3>Modify your Search</h3>
                                                                <div class="row">
                                                                    <div class="col-md-10 duration" style="padding:10px 15px;">
                                                                        <label><input type="radio" value="oneway" name="flights" checked>One way</label>
                                                                        <label><input type="radio" value="roundtrip" name="flights">Round Trip</label>
                                                                    </div>
                                                                </div>
                                                                <div id="O-R-Trip">
                                                                    <div class="row form-group">
                                                                        <div class="col-md-6">
                                                                            <label for="inputCity">From City</label>
                                                                            <input type="text" class="form-control" id="inputToCity" placeholder="Enter from city">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="inputCity">To City</label>
                                                                            <input type="text" class="form-control" id="inputFromCity" placeholder="Enter to city">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-md-6 form-group form-inline" data-date-format="dd-mm-yyyy">
                                                                            <label for="fromDate">Date of Journey</label>
                                                                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" id="dpf1" autocomplete= "off">
                                                                        </div>
                                                                        <div class="col-md-6 form-group" id="dpf2Cntr">
                                                                            <label for="toDate">Date of Return (Optional)</label>
                                                                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" value id="dpf2" autocomplete= "off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-md-2 " >
                                                                            <label>Adults (12+)</label>
                                                                            <select class="form-control">
                                                                                <option value="1" selected>1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 ">
                                                                            <label>Child(0-12)</label>
                                                                            <select class="form-control">
                                                                                <option value="0" selected>0</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 ">
                                                                            <label>Infants(0-2)</label>
                                                                            <select class="form-control">
                                                                                <option value="0" selected>0</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Class of Travel</label>
                                                                            <select class="form-control">
                                                                                <option value="economy" selected>Economy</option>
                                                                                <option value="2">Business</option>
                                                                                <option value="3">First</option>
                                                                                <option value="3">Premium Economy</option>
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
                                                                <button type="submit" class="btn btn-primary">SEARCH FLIGHTS <i class="fa fa-search"></i></button>
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
                            <div class="searchHdr">Filter Flight Results:</div>
                            <div><span>104 of 104 flights</span></div>
                            <ul class="flight-search">
                                <li>
                                    <h4><i class="fa fa-caret-down"></i> Price</h4>
                                    <div class="flight-search-cntr">
                                        <input type="text" class="range-value" id="price-start">
                                        <input type="text" class="range-value range-value-end" id="price-end">                           
                                        <div id="price-range" class="slider-range"></div>
                                        <label>
                                            <input type="checkbox">
                                            <span class="airlines-name">Show only refundable fares</span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <h4><i class="fa fa-caret-down"></i> Stops</h4>
                                    <div class="flight-search-cntr stops">
                                        <label>
                                            <input type="checkbox" checked value="1"> 1
                                        </label>
                                        <label>
                                            <input type="checkbox" checked value="2"> 2
                                        </label>
                                        <label>
                                            <input type="checkbox" checked value="3"> 3
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <h4><i class="fa fa-caret-down"></i> Airlines</h4>
                                    <div class="flight-search-cntr airlines">
                                    
                                   
                                    </div>
                                </li>
                                <li>
                                    <h4><i class="fa fa-caret-down"></i> Departure time</h4>
                                    <div class="flight-search-cntr">
                                        <input type="text" class="range-value" id="time-start">
                                        <input type="text" class="range-value range-value-end" id="time-end">                           
                                        <div id="time-range" class="slider-range"></div>
                                    </div>
                                </li>
                                <li>
                                    <h4><i class="fa fa-caret-down"></i> Trip duration</h4>
                                    <div class="flight-search-cntr">
                                        <input type="text" class="range-value " id="dur-start">
                                        <input type="text" class="range-value range-value-end" id="dur-end">                           
                                        <div id="dur-range" class="slider-range"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="flightResultsCntr">
                            <!-- this row will repeat based on hotels availability -->
                            <div class="dtlsOffer"><i class="fa fa-tags"></i> FLIGHTS FLASH SALE ! Use HOT DEAL and Get Flat 25% Off on this flight booking. <a href="#" class="knwmoreoffrBtn">Know More</a></div>
                            <div class="fligh-results-row">
                          
                            </div>
                        </div>
                    </div>
                </div>        

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalCheckRules" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Fare Rule Information</h3>
                </div>
                <div class="modal-body">
                    <table class="checkRulesCnt">
                        <tr>
                            <td>Rescheduling/Change Penalty*</td>
                            <td width="15px">:</td>
                            <td>Rs. 1500 per person per sector</td>
                        </tr>
                        <tr>
                            <td>Cancellation Penalty*</td>
                            <td>:</td>
                            <td>Rs. 1500 per person per sector</td>
                        </tr>
                        <tr>
                            <td>Tickmango Service Fee**</td>
                            <td>:</td>
                            <td>Rs. 200 or Rs. 250</td>
                        </tr>
                    </table>

                    <div>
                        <ul>
                            <li>*The penalty is subject to 4 hrs before departure. No Changes are allowed after that.</li>
                            <li>*The charges are per passenger per sector.</li>
                            <li>*Rescheduling Charges = Rescheduling/Change Penalty + Fare Difference (if applicable)</li>
                            <li>*Partial cancellation is not allowed on tickets booked under special discounted fares.</li>
                            <li>*In case of no-show or ticket not cancelled within the stipulated time, only statutory taxes are refundable subject to Goibibo Service Fee.</li>
                            <li>*No Baggage Allowance for Infants</li>
                            <li>**Goibibo Service fee will be Rs. 200 in case of online cancellation and Rs. 250 in case of customer-care assisted cancellation</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>



    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h5>Corporate Information</h5>
                    <ul>
                        <li>About Us</li>
                        <li>The Tickmango Team</li>
                        <li>Board of Directors</li>
                        <li>Our Investors</li>
                        <li>Tickmango Blog</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Tickmango Services</h5>
                    <ul>
                        <li>Terms & Conditions</li>
                        <li>Privacy Policy</li>
                        <li>Fare Rules</li>
                        <li>User Agreement</li>
                        <li>Useful Links</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Customer Care</h5>
                    <ul>
                        <li>Help & FAQ's</li>
                        <li>Contact Us</li>
                        <li>Tickmango in your City</li>
                        <li>Tickmango Experts</li>
                        <li>Visa Information</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Why Buy with Tickmango</h5>
                    <ul>
                        <li>Testimonials</li>
                        <li>Awards Won</li>
                        <li>Tickmango in the News</li>
                        <li>Press Releases</li>
                        <li>Tickmango Blog</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Partner With Us</h5>
                    <ul>
                        <li>Become an Affiliate</li>
                        <li>Become a Channel Partner</li>
                        <li>Become Franchise Partner</li>
                        <li>Register your Hotel</li>
                        <li>Advertise with Us</li>
                        <li>Careers</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>More</h5>
                    <ul>
                        <li>Corporate Travel</li>
                        <li>Travel Agents</li>
                        <li>Buzzin Town</li>
                        <li>Tickmango.com - Anroid App</li>
                    </ul>
                </div>
            </div>
        </div>  
    </footer>
    <div class="footerBtm">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p>Copyright &copy; 2013 - Tickmango Online Private Limited, India. All rights reserved. 
                </div>
                <div class="col-md-4">
                    <p class="pull-right">Powered by <span class="powered"><a href="#">Travelpd</a></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
        ================================================== --> 
    <!-- Placed at the end of the document so the pages load faster --> 
    <script src="<?php echo WEB_DIR; ?>public/js/jquery-1.10.2.min.js"></script> 
    <script src="<?php echo WEB_DIR; ?>public/js/bootstrap.min.js"></script> 

    <script src="<?php echo WEB_DIR; ?>public/js/jquery.nicescroll.min.js"></script> 
    <script src="<?php echo WEB_DIR; ?>public/js/jquery.jcarousel.min.js"></script> 
    <script src="<?php echo WEB_DIR; ?>public/js/bootstrap-datepicker.js"></script> 
    <script src="<?php echo WEB_DIR; ?>public/js/jquery.timers-1.2.js"></script> 
    <script src="<?php echo WEB_DIR; ?>public/js/jquery.galleryview-3.0-dev.js"></script>
    <script src="<?php echo WEB_DIR; ?>public/js/jquery-ui.js"></script>
    <script src="<?php echo WEB_DIR; ?>public/js/bjqs-1.3.min.js"></script>
    <script src="<?php echo WEB_DIR; ?>public/js/customize.js"></script>
    <script type="text/javascript">

        function call()
        {	
            document.searchProgress.submit();
        }

    </script>

    <script type="text/javascript">

        var ray={
            ajax:function(st)
            {
                this.show('load');
            },
            show:function(el)
            {
                this.getID(el).style.display='';
            },
            getID:function(el)
            {
                return document.getElementById(el);
            }
        }
    </script>
    <style type="text/css">
        #load{	
            text-align:center;	
            font-family:"Trebuchet MS", verdana, arial,tahoma;
            font-size:13pt;
        }
    </style>
       <!--Custom loader for results-->
    <div class="loader" style="display:block;"><span>Searching for Flights ...</span></div>
    <!--Results loads here-->
</body>
</html>
