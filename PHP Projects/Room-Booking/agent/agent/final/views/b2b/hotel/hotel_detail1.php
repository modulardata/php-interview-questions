<?php echo $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery.galleryview-3.0-dev.css">
<!-----  Top destination content ----->
<div class="selectBusCntr">
    <div class="container">
        <div class="row">
            <div class="busesCntr">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-criteria"> Home → India<span class="font12">(10651)</span> → Chennai → Red Sun Serviced Apartments  </div>
                            <div class="search-criteria-counts"> <span class="htl-critrerias-counts"><i class="fa fa-home"></i> <span>2</span>Rooms</span> <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>2</span>Adults</span> <span class="htl-critrerias-counts"><i class="fa fa-users"></i> <span>3</span>Children</span> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span> </div>
                            <div class="search-criteria modify-search"> <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
                                <div class="row">
                                    <div class="col-md-7">
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
            <div class="col-md-8">
                <div class="hotelResultsCntr"> 
                    <!-- this row will repeat based on hotels availability -->
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hotel-details"> <span class="font20"><?php echo $hotel_detail->hotel_name; ?></span>, <br>
                                    Inner Ring Road , Koyambedu , Chennai | View on Map <span class="star star4"></span></div>
                            </div>
                            <div class="col-md-12 galleryCntr">
                                <ul id="myGallery">
                                    <?php for ($k = 1; $k < count($hotel_images); $k++) { ?>
                                        <li><img src="<?php echo $hotel_images[$k]->image_url; ?>" alt="Hotel" /></li>
                                    <?php } ?>
                                </ul>
                                <a href="#" class="btn btn-primary marginTop10">BACK TO RESULTS</a> </div>
                        </div>
                        <div class="htl-tabs-cntr"> 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#htl-overview" data-toggle="tab">Hotel Overview</a></li>
                                <li><a href="#htl-am" data-toggle="tab">Hotel Amenities</a></li>
                                <li><a href="#htl-map" data-toggle="tab">Map & Attractions</a></li>
                                <li><a href="#htl-review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="htl-overview">
                                    <h3>Room Details</h3>
                                    <div class="hotel-room-row">
                                        <div class="row htl-rm-header">
                                            <div class="col-md-6">Room Type</div>
                                            <div class="col-md-3">Services & Conditions</div>
                                            <div class="col-md-3">Price(Taxes Extra)</div>
                                        </div>

                                        <?php
                                        $hotel_detail_resp = $this->session->userdata('hotel_detail_resp');
                                        $dom2 = new DOMDocument();
                                        $dom2->loadXML($hotel_detail_resp);
                                        $roomstay = $dom2->getElementsByTagName("RoomStay");
                                        foreach ($roomstay as $val) {
                                            $RoomRate = $val->getElementsByTagName("RoomRate");
                                            foreach ($RoomRate as $val1) {
                                                $RoomID = $val1->getAttribute('RoomID');
                                                $RatePlanCode = $val1->getAttribute('RatePlanCode');

                                                $Rate = $val1->getElementsByTagName("Rate");
                                                $Base = $val1->getElementsByTagName("Base");
                                                $AmountBeforeTax = $Base->item(0)->getAttribute('AmountBeforeTax');

                                                $addAmountBeforeTax = array();
                                                if ($val1->getElementsByTagName("AdditionalGuestAmounts")) {
                                                    $AdditionalGuestAmounts = $val1->getElementsByTagName("AdditionalGuestAmounts");
                                                    foreach ($AdditionalGuestAmounts as $guesiss) {
                                                        $AdditionalGuestAmount = $guesiss->getElementsByTagName("AdditionalGuestAmount");
                                                        foreach ($AdditionalGuestAmount as $add) {
                                                            $addAmountBeforeTax[] = $add->getElementsByTagName("Amount")->item(0)->getAttribute('AmountBeforeTax');
                                                            //$addAmountBeforeTax[] = $Amount->item(0)->getAttribute('AmountBeforeTax');
                                                        }
                                                        break;
                                                    }
                                                }
                                                //  echo '<pre>';print_r($addAmountBeforeTax);

                                                $Taxes = $val1->getElementsByTagName('Taxes');
                                                $Taxesval = $Taxes->item(0)->getAttribute('Amount');
                                                $Discountval = 0;
                                                $TPA_Discountval = array();
                                                if ($val1->getElementsByTagName('Discount')) {
                                                    $Discounts = $val1->getElementsByTagName('Discount');
                                                    foreach ($Discounts as $dis) {
                                                        $AppliesTo = $dis->getAttribute('AppliesTo');
                                                        if ($AppliesTo == 'Base') {
                                                            $Discountval = $dis->getAttribute('AmountBeforeTax');
                                                        } else {
                                                            if ($dis->getAttribute('ItemRPH')) {
                                                                $itemRPH = $dis->getAttribute('ItemRPH');
                                                                if ($itemRPH == '') {
                                                                    $TPA_Discountval[] = $dis->getAttribute('AmountBeforeTax');
                                                                }
                                                            }
                                                        }
                                                        //$Discountval = $dis->getAttribute('AmountBeforeTax');
                                                    }
                                                }
                                                // add on 12-23-2013
//                                                    $TPA_Discountval = array();
//                                                    if ($val1->getElementsByTagName('TPA_Extensions')) {
//                                                        $TPA_Extensions = $val1->getElementsByTagName('TPA_Extensions');
//                                                        foreach ($TPA_Extensions as $ext) {
//                                                            if ($ext->getElementsByTagName('Discount')) {
//                                                                $adddisc = $ext->getElementsByTagName('Discount');
//                                                                foreach ($adddisc as $discval) {
//                                                                    $TPA_Discountval[] = $discval->getAttribute('AmountBeforeTax');
//                                                                }
//                                                            }
//                                                        }
//                                                        
//                                                    }
                                                // added on 12-23-2013
                                                // $netrate = ($AmountBeforeTax + $Taxesval) - ($Discountval);
                                                //calculating rate from hotel model
                                                $netrate = $this->Hotel_Model->detail_calculate_rate($AmountBeforeTax, $Discountval, $Taxesval, $addAmountBeforeTax, $TPA_Discountval);

                                                // getting the romm type data start using roomid from roomrat above
                                                $RoomType = $val->getElementsByTagName("RoomType");
                                                foreach ($RoomType as $val2) {
                                                    $RoomTypeCode = $val2->getAttribute('RoomTypeCode');
                                                    if ($RoomTypeCode == $RoomID) {

                                                        $RoomType = $val2->getElementsByTagName("RoomDescription");
                                                        $Roomtext = $RoomType->item(0)->getElementsByTagName("Text");
                                                        $Roomtextval = $Roomtext->item(0)->nodeValue;

                                                        $Roomimage = $RoomType->item(0)->getElementsByTagName("Image");
                                                        $Roomimageval = $Roomimage->item(0)->nodeValue;

                                                        $RoomTypename = $val2->getAttribute('RoomType');
                                                        $NonSmoking = $val2->getAttribute('NonSmoking');
                                                        $Occupancy = $val2->getElementsByTagName("Occupancy");
                                                        foreach ($Occupancy as $occ) {
                                                            $AgeQualifyingCode = $occ->getAttribute('AgeQualifyingCode');

                                                            if ($AgeQualifyingCode == '10') {
                                                                $adultMaxOccupancy = $occ->getAttribute('MaxOccupancy');
                                                            } else {
                                                                $childMaxOccupancy = $occ->getAttribute('MaxOccupancy');
                                                            }
                                                        }
                                                    }
                                                }
                                                // getting the romm type data end using roomid from roomrat above
                                                // getting the rateplan data start using rateplancode from the above
                                                $RatePlan = $val->getElementsByTagName("RatePlan");
                                                foreach ($RatePlan as $ratpln) {
                                                    $RatePlanCodeval = $ratpln->getAttribute('RatePlanCode');
                                                    $AvailableQuantity = $ratpln->getAttribute('AvailableQuantity');

                                                    if ($RatePlanCodeval == $RatePlanCode) {
                                                        $CancelPenalty = $ratpln->getElementsByTagName("CancelPenalty");
                                                        $NonRefundable = $CancelPenalty->item(0)->getAttribute('NonRefundable');

                                                        $RatePlanDescription = $ratpln->getElementsByTagName("RatePlanDescription");
                                                        foreach ($RatePlanDescription->item(0)->getElementsByTagName("Text") as $Text) {
                                                            $RatePlanDescriptionval = $Text->nodeValue;
                                                            //break;
                                                        }
                                                        $RatePlanInclusionDesciption = $ratpln->getElementsByTagName("RatePlanInclusionDesciption");
                                                        foreach ($RatePlanInclusionDesciption->item(0)->getElementsByTagName("Text") as $Text) {
                                                            $RatePlanInclusionDesciptionval = $Text->nodeValue;
                                                            break;
                                                        }

                                                        $CancelPenalties = $ratpln->getElementsByTagName("CancelPenalties");
                                                        $PenaltyDescription = $ratpln->getElementsByTagName("PenaltyDescription");

                                                        foreach ($PenaltyDescription->item(0)->getElementsByTagName("Text") as $Text) {
                                                            $PenaltyDescriptionval = $Text->nodeValue;
                                                            //break;
                                                        }
                                                        foreach ($PenaltyDescription->item(1)->getElementsByTagName("Text") as $Text) {
                                                            $PenaltyDescriptionval1 = $Text->nodeValue;
                                                            //break;
                                                        }

                                                        $DiscountCouponDisplayIndicator = $ratpln->getElementsByTagName("DiscountCouponDisplayIndicator");
                                                        $DiscountCouponDisplayIndicatorval = $DiscountCouponDisplayIndicator->item(0)->getAttribute('Enabled');
                                                    }
                                                }
                                                ?>
                                                <div class="htl-rm-detail">
                                                    <div class="row">
                                                        <div class="col-md-6 htl-type"> <img src="<?php echo $Roomimageval; ?>" width="100" height="100" alt="hotel-aloft">
                                                            <div class="htl-type-dtls"> <span><?php echo $RoomTypename; ?></span>
                                                                <p><strong>Description:</strong><?php echo $Roomtextval; ?></p>
        <!--                                                                <a class="htl-ind-rm-dtls">VIEW DETAILS <i class="fa fa-caret-down"></i></a> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3"> <a href="#">Cancellation Policy</a> </div>
                                                        <div class="col-md-3 htl-rm-price"> <span><i class="fa fa-rupee"></i><?php echo $netrate; ?></span> <span class="font12">(all incl. )</span>
                                                            <div>
                                                                <form action="<?php echo WEB_URL; ?>hotel/pre_booking" method="post">
<!--                                                                    <a href="<?php echo WEB_URL; ?>hotel/pre_booking/<?php echo $RoomID; ?>/<?php echo $RatePlanCode; ?>/<?php echo $hotel_detail->hotel_code; ?>/<?php echo $hotel_detail->hotel_search_result_info_id; ?>/<?php echo $netrate; ?>/<?php echo $Taxesval; ?>"><button>Book</button></a>-->
                                                                    <input type="hidden" name="roomid" value="<?php echo $RoomID; ?>" />
                                                                    <input type="hidden" name="rateplancode" value="<?php echo $RatePlanCode; ?>" />
                                                                    <input type="hidden" name="hotel_code" value="<?php echo $hotel_detail->hotel_code; ?>" />
                                                                    <input type="hidden" name="hotel_search_id" value="<?php echo $hotel_detail->hotel_search_result_info_id; ?>" />
                                                                    <input type="hidden" name="net_rate" value="<?php echo $netrate; ?>" />
                                                                    <input type="hidden" name="tax" value="<?php echo $Taxesval; ?>" />
                                                                    <button class="btn btn-success"> BOOK <i class="fa fa-hand-o-right"></i> </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="row htl-ind-details" id="htl-ind-details">
                                                                                                            <div class="col-md-12">
                                                                                                                <p>Deluxe Rooms are spacious with approximate dimension of 28 sq. m. Rooms are well equipped with air conditioner and offer amenities like cable television, superfast internet, electronic locks, mini bar, electronic safe, en suite bathrooms with toiletries, bathtub, hair dryer and supply of hot and cold water, welcome drink, fruit basket, cookies, mineral bottle water, daily newspaper and direct dial STD/ISD telephone services.</p>
                                                                                                            </div>
                                                                                                            <div class="col-md-12 htl-dtls-amen">
                                                                                                                <h4>Amenities</h4>
                                                                                                                <ul>
                                                                                                                    <li>&raquo; Air Conditioning</li>
                                                                                                                    <li>&raquo; Alarm Clock</li>
                                                                                                                    <li>&raquo; Cable / Satellite / Pay TV available</li>
                                                                                                                    <li>&raquo; Ensuite / Private Bathroom</li>
                                                                                                                    <li>&raquo; Hairdryer (on request)</li>
                                                                                                                    <li>&raquo; Mini bar - On Charge</li>
                                                                                                                    <li>&raquo; Telephone</li>
                                                                                                                    <li>&raquo; Newspapers Complimentary</li>
                                                                                                                    <li>&raquo; Hot / Cold Running Water</li>
                                                                                                                    <li>&raquo; Safe - In - Room</li>
                                                                                                                </ul>
                                                                                                            </div>
                                                                                                        </div>-->
                                                </div>

                                                <?php
                                            }
                                        }
                                        ?>

                                        <!-- hotel details -->
                                        <div class="row htl-desc">
                                            <div class="col-md-8"><?php echo $hotel_detail->description; ?> </div>
                                            <div class="col-md-4 htl-dtls-amen">
                                                <h4>Hotel Amenities</h4>
                                                <ul>
                                                    <li>&raquo; Major Credit Cards Accepted</li>
                                                    <li>&raquo; Parking Facilities Available</li>
                                                    <li>&raquo; Currency Exchange</li>
                                                    <li>&raquo; Internet Access</li>
                                                    <li>&raquo; Doctor On Call</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-am">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="hotel-dtls-amenities">
                                                <h4><?php echo $hotel_detail->hotel_name; ?> - Room - Amenities</h4>
                                                <ul>
                                                    <?php
                                                    if ($hotel_amenities != '') {
                                                        foreach ($hotel_amenities as $val) {
                                                            if ($val->amenity_type == 'room') {
                                                                ?>
                                                                <li>&raquo; <?php echo $val->description; ?></li>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="hotel-dtls-amenities">
                                                <h4><?php echo $hotel_detail->hotel_name; ?> - Hotel - Amenities</h4>
                                                <ul>
                                                    <?php
                                                    if ($hotel_amenities != '') {
                                                        foreach ($hotel_amenities as $val) {
                                                            if ($val->amenity_type == 'property') {
                                                                ?>
                                                                <li>&raquo; <?php echo $val->description; ?></li>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane htl-dtls-amen" id="htl-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m5!3m3!1m2!1s0x3bae176e4a1497a9%3A0x259bddacaf2571d6!2sManyata+Embassy+Business+Park%2C+Block+G1%2C+Manyata+Embassy+Business+Park%2C+Outer+Ring+Road+Bengaluru%2C+KA+560045+India%2C+Manayata+Tech+Park%2C+Thanisandra%2C+Bangalore%2C+Karnataka%2C+India!5e0!3m2!1sen!2sus!4v1386529996401" width="100%" height="300" frameborder="0" style="border:0"></iframe>
                                    <div>
                                        <h3>List of Nearest places, attractions near Red Sun Serviced Apartments , Chennai</h3>
                                        <ul>
                                            <?php foreach ($hotel_inandaround as $val) { ?>
                                                <li>&raquo; <?php echo $val->Name_of_attraction; ?> , <?php echo $val->distance; ?>km</li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="htl-review">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="htd_trrtwrp" id="gi_htl_reviewTA">
                                                <ul class="htd_tradul">
                                                    <li class="htd_tradli">
                                                        <div class="htd_tradrt"><b>TripAdvisor traveller rating:</b> <img src="<?php echo WEB_DIR; ?>public/http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/4.0-15797-1.gif" style="float:right" alt=""> <span>(based on 26 reviews)</span></div>
                                                    </li>
                                                    <li class="htd_tradli">
                                                        <div class="htd_tradrt" style="border-bottom: 1px !important; "><b>Reviews from Tripadvisor:</b></div>
                                                    </li>
                                                    <li>
                                                        <ul class="htd_trpbotul">
                                                            <?php foreach ($hotel_review as $val) { ?>
                                                                <li class="htd_trpbotli">
                                                                    <div class="htd_trp_hdng">"Remarkable servised hotel appartment in deed expressing my self in a short statement"</div>
                                                                    <div class="htd_trpbotcnt">
                                                                        <div class="row">
                                                                            <div class="col-md-9"> <span class="htd_trpbotcont"> <em class="htd_trpbotby db">by <?php echo $val->customer_name; ?> from <?php echo $val->customer_city; ?>, <?php echo $val->customer_country; ?></em></span> </div>
                                                                            <div class="col-md-3"> <span class="htd_trpbotimg"> User Rating : <span class="htliq_htiq_sprite"><?php echo $val->room_quality; ?>/5 <img src="http://www.tripadvisor.in/img/cdsi/img2/ratings/traveler/5.0-15797-1.gif"></span> </span> </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="summary_0"> <span class="htd_trpbotcnt_rev" id="summary"><?php echo $val->comments; ?></span></div>
                                                                    <!--                                                                <div class="htd_trpbotcnt_rev" id="review_0" style="display:none">My family was pleased during the short stay of six nights at Red Sun Hotel Apartments.Being a Sri Lankan we openly pronounce the remarkable hospitality provided to us.Ms. Kousalya the manageress and Miss Poornima at the front office desk did extend their services going even beyond their allowed limitations with the intention of assisting and satisfying the customers.The kitchen staff and not forgetting the main man behind the screen the "Chef" served us with excellent authentic Indian food. In one word it was "FANTASTIC" and would suit any pallet with no doubt.The staff too is very friendly and cooperative willing to fulfill the needs of  the customers, understanding their value -categorizing them as 'Customer is the king,We wish them good luck from the bottom of our hearts..</div>-->
                                                                </li>
                                                            <?php } ?>


                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div style="float:right;font-size:13px;padding-top:5px;"> <a href="http://www.tripadvisor.in/UserReview-g304556-d2097038-m15797-Red_Sun_Serviced_Apartments-Chennai_Madras_Tamil_Nadu.html?partnerReturnTo=[RETURNTO]" target="_blank">Write a Review</a> </div>
                                                        <div style="float:left;font-size:13px;padding-top:5px;"><a href="http://www.tripadvisor.in/ShowUserReviews-g304556-d2097038-r156034572-m15797-Red_Sun_Serviced_Apartments-Chennai_Madras_Tamil_Nadu.html" target="_blank">Read all 26 reviews</a> </div>
                                                    </li>
                                                    <li style="float:left;width:100%;">
                                                        <div style="float:right;font-size:13px;padding-top:5px;"> <span class="hd_vs fr_tripad">&nbsp;</span><span style="padding-top:9px;float:right;font-size:11px;">© 2008 <a target="_blank" href="http://www.tripadvisor.in">TripAdvisor</a> LLC. All rights reserved</span> </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="white-container htl-dtls-amen">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">What happens after I book?</div>
                            <ul>
                                <li>&raquo; Receive confirmation SMS</li>
                                <li>&raquo; Receive voucher on Email</li>
                                <li>&raquo; Print hotel voucher</li>
                                <li>&raquo; Contact customer care in case of issues</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="white-container htl-dtls-amen">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="searchHdr">FAQ</div>
                            <ul>
                                <li>&raquo; <a href="#">How to get the confirmation from hotels?</a></li>
                                <li>&raquo; <a href="#">How to pay the money?</a></li>
                                <li>&raquo; <a href="#">How to contact customer care?</a></li>
                                <li>&raquo; <a href="#">How to cancel the hotel booking?</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="white-container">
                    <div class="searchHdr">Related hotels</div>
                    <div class="row">
                        <div class="col-md-12 htl-type"> <img src="<?php
                                                            echo WEB_DIR;
                                                            ;
                                                            ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                            <div class="htl-type-dtls">
                                <div class="row">
                                    <div class="col-md-12 htlDetailsCntr">
                                        <div class="htlname">The Hotel</div>
                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                        <a href="#"> VIEW DETAILS</a> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 htl-type"> <img src="<?php
                                                            echo WEB_DIR;
                                                            ;
                                                            ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                            <div class="htl-type-dtls">
                                <div class="row">
                                    <div class="col-md-12 htlDetailsCntr">
                                        <div class="htlname">The Hotel</div>
                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                        <a href="#"> VIEW DETAILS</a> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 htl-type"> <img src="<?php
                                                            echo WEB_DIR;
                                                            ;
                                                            ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                            <div class="htl-type-dtls">
                                <div class="row">
                                    <div class="col-md-12 htlDetailsCntr">
                                        <div class="htlname">The Hotel</div>
                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                        <a href="#"> VIEW DETAILS</a> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 htl-type"> <img src="<?php
                                                            echo WEB_DIR;
                                                            ;
                                                            ?>public/img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                            <div class="htl-type-dtls">
                                <div class="row">
                                    <div class="col-md-12 htlDetailsCntr">
                                        <div class="htlname">The Hotel</div>
                                        <div class="htlreview"><i class="fa fa-eye"></i> Review: <span class="rating rating4"></span> 138 reviews </div>
                                        <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                        <a href="#"> VIEW DETAILS</a> </div>
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
<?php echo $this->load->view('home/footer'); ?>