<?php echo $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">
<!-----  Top destination content ----->

<style>
    .padd{
        padding:10px;  
    }
</style>
<div class="hotelCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-12 bookedDetails">


                <?php
                $hotel_detail_resp = $this->session->userdata('hotel_detail_resp');
                $hotel_search_data = $this->session->userdata('hotel_search_data');
                //echo '<pre>'; print_r($this->session->all_userdata()); exit;
                $dom2 = new DOMDocument();
                $dom2->loadXML($hotel_detail_resp);
                $roomstay = $dom2->getElementsByTagName("RoomStay");
                foreach ($roomstay as $val) {
                    $BasicPropertyInfo = $val->getElementsByTagName("BasicPropertyInfo");
                    $HotelName = $BasicPropertyInfo->item(0)->getAttribute('HotelName');

                    $Address = $val->getElementsByTagName("Address");
                    foreach ($Address as $add) {
                        $AddressLine = $add->getElementsByTagName("AddressLine");
                        $AddressLineval = $AddressLine->item(0)->nodeValue;

                        $StateProv = $add->getElementsByTagName("StateProv");
                        $StateProvval = $StateProv->item(0)->nodeValue;
                    }

                    $HotelBasicInformation = $val->getElementsByTagName("HotelBasicInformation");
                    foreach ($HotelBasicInformation as $info) {
                        //$HotelBasicInformation = $info->getElementsByTagName("HotelBasicInformation");
                        $Multimedia = $info->getElementsByTagName('Multimedia');
                        $ImageUrl = $Multimedia->item(0)->getAttribute('ImageUrl');
                        //$ImageUrl = $Multimedia->getAttribute('ImageUrl');
                    }
                }
                $user_id = $this->session->userdata('user_id');
                $title = $this->session->userdata('title');
                $user_first_name = $this->session->userdata('user_first_name');

                //$country = $this->session->userdata('country');
                $city = $hotel_search_data['city'];
                $checkin = $hotel_search_data['checkin'];
                $checkout = $hotel_search_data['checkout'];
                //$pin_code = $this->session->userdata('pin_code');
                ?>



                <form action="<?php echo WEB_URL; ?>hoteld/provisional_booking" method="post">



                    <!-- login details -->
                    <section  id="emailDetails" class="verySoftShadow">
                        <div class="bdOpen " id="loginOpen">
                            <div class="bdTitle">
                                <h3>Email address</h3>
                            </div>


                            <div class="row">

                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Your email address</div>
                                        <div class="col-md-4">
                                            <input type="text"  class="form-control" tabindex="143" maxlength="75" placeholder="Your booking details will be sent here" title="Enter your email id" id="userEmailId" name="userEmailId"  onblur="return email_validate(this.id);"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Mobile No</div>
                                        <div class="col-md-4">
                                            <input type="text"  class="form-control" tabindex="143" maxlength="10" placeholder="Enter Mobile Number" title="Enter Mobile Number" id="userMobilNo" name="userMobilNo"  onblur="return mobile_validate(this.id);"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Country</div>
                                        <div class="col-md-4" >
                                            <select name="country" class="form-control" >

                                                <?php
                                                foreach ($country as $val) {
                                                    ?>
                                                    <option value="<?php echo $val->name; ?>" ><?php echo $val->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">City</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="CITY" name="city" required /> 

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="padd">
                                        <div class="col-md-2">Postal Code</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="POSTAL CODE" name="p_code" required /> 

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>

                        </div>
                        <div class="bdDone" id="loginDone"></div>
                    </section>

                    <!-- traveller details -->
                    <section  id="travellerDetails" class="verySoftShadow">
                        <div class="bdOpen " id="travellersOpen">
                            <div class="bdTitle">
                                <h3>Travellers</h3>
                            </div>
                            <div class="row ">
                                <input type="hidden" name="email_id" id="travMail" />
                                <input type="hidden" name="mobile_no" id="travMobile" />

                                <div class="BkdtrvlrDtls">


                                    <?php $session_dat = $this->session->userdata('hotel_search_data'); //echo '<pre>';print_r($session_dat);   ?>
                                    <?php for ($j = 0; $j < $session_dat['room_count']; $j++) { ?>
                                        <?php for ($k = 0; $k < $session_dat['adultvalue'][$j]; $k++) { ?>
                                            <div class="row">
                                                <div class="col-md-2 txtRight">&nbsp;Adult - <?php echo $k + 1; ?> </div>
                                                <div class="col-md-1 form-group">
                                                    <select name="atitle[]" class="form-control">
                                                        <option>Title</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="MS">Ms</option>
                                                        <option value="Mrs">Mrs</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <input type="text" name="afname[]" class="form-control" placeholder="First Name"/>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <input type="text" name="amname[]" class="form-control" placeholder="Middle Name"/>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <input type="text" name="alname[]" class="form-control" placeholder="Last Name"/>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>

                                        <?php if ($session_dat['childvalue'][$j] != 0) { ?>
                                            <?php for ($k = 0; $k < $session_dat['childvalue'][$j]; $k++) { ?>
                                                <div class="row">
                                                    <div class="col-md-2 txtRight">&nbsp;Child - <?php echo $k + 1; ?> </div>
                                                    <div class="col-md-1 form-group">
                                                        <select name="ctitle[]" class="form-control">
                                                            <option>Title</option>
                                                            <option value="Mr">Mr</option>
                                                            <option value="MS">Ms</option>
                                                            <option value="Mrs">Mrs</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <input type="text" name="cfname[]" class="form-control" placeholder="First Name"/>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <input type="text" name="cmname[]" class="form-control" placeholder="Middle Name"/>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <input type="text" name="clname[]" class="form-control" placeholder="Last Name"/>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        <?php } ?> 
                                    <?php } ?>







                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5"><button type="submit" class="btn btn-primary">CONTINUE</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="bdDone" id="travellersDone"></div>
                    </section>

                </form>
            </div>

        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>