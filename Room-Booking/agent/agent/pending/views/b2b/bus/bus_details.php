<?php echo $this->load->view('home/header'); ?>  
<?php //echo '<pre>';print_r($this->session->all_userdata());exit;          ?>
<?php
$selectbus = $this->session->userdata('selectbus1');
$selectbus2 = $this->session->userdata('selectbus2');
$seat = $selectbus['seatname'];
$seat2 = $selectbus2['seatname'];
$pass = explode(',', $seat);
$bus_search_data = $this->session->userdata('bus_search_data');
$triptype = $bus_search_data['bustrip'];
$fromcity = $bus_search_data['sourcename'];
$tocity = $bus_search_data['destiname'];
$frmdate = $bus_search_data['from_date'];
$todate = $bus_search_data['to_date'];
$travels = $selectbus['travels'];
$bus_type = $selectbus['bus_type'];
$board = $selectbus['location'];
$boardtime = $selectbus['time'];
$sprice = $selectbus['sprice'];
$travels2 = $selectbus2['travels'];
$bus_type2 = $selectbus2['bus_type'];
$board2 = $selectbus2['location'];
$boardtime2 = $selectbus2['time'];
$sprice2 = $selectbus2['sprice'];
?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">
<div class="hotelCntr">
    <div class="container"> 

        <!-- flight trip details section-->
        <div class="row">
            <div class="col-md-9">
                <div class="hotelResultsCntr"> 
                    <form action="<?php echo WEB_URL; ?>bus/iternary" method="post">
                        <!-- traveller details -->
                        <div class="white-container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="searchHdr">Traveller details</div>
                                    <div class="selectedBus-travellerDtls">
                                        <div class="row header">
                                            <div class="col-md-1"><strong>No</strong></div>
                                            <div class="col-md-2"><strong>Title</strong></div>
                                            <div class="col-md-4"><strong>Name</strong></div>
                                            <div class="col-md-2"><span class="marginLeft15"><strong>Gender</strong></span></div>
                                            <div class="col-md-1"><strong>Age</strong></div>
                                        </div>
                                        <div class="results-row font12">
                                            <?php for ($i = 0; $i < count($pass); $i++) { ?>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <?php echo $i + 1; ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <select name="Title[]" class="form-control" required>
                                                            <option value="Mr">Mr</option>
                                                            <option value="Ms">Ms</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="fname[]" id="fname" placeholder="PLEASE ENTER NAME" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="marginLeft15 marginTop10"><input type="radio" name="sex[<?php echo $i; ?>]" value="male" id="male">Male</label>
                                                        <label class="marginLeft15"><input type="radio" name="sex[<?php echo $i; ?>]" value="female" id="female">Female</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="text" class="form-control" name="age[]" id="age" placeholder="AGE" required>
                                                    </div>
                                                </div>
                                                <div class="row"><div class="col-md-1"><span>&nbsp;</span></div></div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="selectedBus-travellerDtls">
                                        <div class="searchHdr">Contact details</div>
                                        <div class="results-row font12">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Mobile</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter your mobile number">
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-md-1"><span>&nbsp;</span></div></div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="email_id" id="email" placeholder="Enter your Email address">
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-md-1"><span>&nbsp;</span></div></div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <textarea class="form-control" name="address"></textarea>
<!--                                                    <input type="text" class="form-control" name="address" id="email" placeholder="Enter your Address">-->
                                                </div>
                                            </div>

                                        </div>
                                        <input type="hidden" name="bus_type" value="<?php echo $bus_type; ?>" />
                                        <input type="hidden" name="travels" value="<?php echo $travels; ?>" />
                                        <input type="hidden" name="boardingtime" value="<?php echo $board; ?> - <?php echo $this->Bus_Model->getTime($boardtime); ?>" />

                                        <div class="results-row font12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label><input type="checkbox" checked id="terms-conditions">
                                                        I agree to all the <a href="#">Terms and Conditions</a>
                                                    </label>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-success make-payment">CONTINUE</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="white-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">Your Booking Details</div>
                            <h4>Onward Journey</h4>
                            <ul class="bookedBusDtls font12">
                                <li><i class="fa fa-map-marker"></i> <span><?php echo $fromcity; ?> to <?php echo $tocity; ?></span></li>
                                <li><i class="fa fa-calendar-o"></i> <span><?php echo $frmdate; ?></span></li>
                                <li><i class="fa fa-bookmark"></i> <span><?php echo $travels; ?></span></li>
                                <li><i class="fa fa-truck"></i> <span><?php echo $bus_type; ?></span></li>
                                <li><i class="fa fa-folder"></i> <span>Seat no(s) : <?php echo $seat; ?></span></li>
                                <li><i class="fa fa-map-marker"></i> <span><?php echo $board; ?> - <?php echo $this->Bus_Model->getTime($boardtime); ?></span></li>
                                <li><i class="fa fa-map-marker"></i> <span>Price: <?php echo $sprice; ?></span></li>
                            </ul>
                            <?php if ($triptype == 'roundtrip') { ?>
                                <h4>Return Journey</h4>
                                <ul class="bookedBusDtls font12">
                                    <li><i class="fa fa-map-marker"></i> <span><?php echo $tocity; ?> to <?php echo $fromcity; ?></span></li>
                                    <li><i class="fa fa-calendar-o"></i> <span><?php echo $todate; ?></span></li>
                                    <li><i class="fa fa-bookmark"></i> <span><?php echo $travels2; ?></span></li>
                                    <li><i class="fa fa-truck"></i> <span><?php echo $bus_type2; ?></span></li>
                                    <li><i class="fa fa-folder"></i> <span>Seat no(s) : <?php echo $seat2; ?></span></li>
                                    <li><i class="fa fa-map-marker"></i> <span><?php echo $board2; ?> - <?php echo $this->Bus_Model->getTime($boardtime2); ?></span></li>
                                    <li><i class="fa fa-map-marker"></i> <span>Price: <?php echo $sprice2; ?></span></li>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>