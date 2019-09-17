<form action="<?php echo WEB_URL; ?>dhotel/hotel_search" method="post"> <div class="col-md-12">
        <?php $hotel_search_data = $this->session->userdata('hotel_search_data'); ?>
        <div class="search-criteria"><strong>Location: <?php echo $hotel_search_data['city']; ?></strong> 

            <?php
            $rooms = $hotel_search_data['room_count'];
            $adults = $hotel_search_data['adultvalue'];
            $childs = $hotel_search_data['childvalue'];
            $nation = $hotel_search_data['nationality'];

            //echo '<pre>';        print_r($this->session->all_userdata()) ; exit;
            ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Check In: <?php echo $hotel_search_data['checkin']; ?> - Check Out: <?php echo $hotel_search_data['checkout']; ?>
          <!--<span class="flt-criteria"> ( Fri, 27 Dec | <span id="flt-adult">1 adult</span> | <span id="flt-children">1 Children</span> )</span>--> <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span> <span class="result-date-range pull-right"> <!--<span>DATES: </span> <a href="#" class="date">JAN 29</a> <a href="#" class="date">JAN 30</a> <a href="#" class="date active">JAN 31</a> <a href="#" class="date">FEB 1</a> <a href="#" class="date">FEB 2</a> </span> --></div>

        <div class="modify-search"> <span class="mod-search-close" id="mod-search-close"><i class="fa fa-times-circle"></i></span>
            <div class="row">
                <div class="col-md-10">

                    <div class="searchpanel">
                        <div class="padder">
                            <div class="form-group">
                                <h3>Book Hotel Online</h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="inputCity">Where to Go? (Destination City)</label>
                                        <input title="Type City Name" autocomplete="off" autocorrect="off" autocapitalize="off" tabindex="5" placeholder="TYPE THE LOCATION" name="City" id="hotelcityd" value="<?php echo $hotel_search_data['city']; ?>" type="text" class="form-control" required />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputNationality">Nationality</label>
                                        <select class="form-control" name="nationality" required title="Nationality">
                                            <option value="">Select Nationality</option>
                                            <?php
                                            foreach ($nationality as $val) {
                                                
                                                if ($val->code == $nation) {
                                                    ?>
                                                    <option value="<?php echo $val->code; ?>" selected><?php echo $val->country; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $val->code; ?>"><?php echo $val->country; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group form-inline" data-date-format="dd-mm-yyyy">
                                        <label for="fromDate">Date of Check-In</label>
                                        <input type="text" class="form-control" placeholder="Check-In Date" id="datepickerhot" name="checkin" value="<?php echo $hotel_search_data['checkin']; ?>" required />
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="toDate">Date of Check-Out</label>
                                        <input type="text" class="form-control" placeholder="Check-Out Date" id="datepickerhot1" name="checkout" value="<?php echo $hotel_search_data['checkout']; ?>" required />
                                    </div>
                                </div>
                            </div>

                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                                ?>
                                <div class="row" id="room<?php echo $i; ?>" <?php echo ($i <= $rooms ? 'style="display:block;"' : 'style="display:none;"'); ?>>
                                    <div class="col-md-2 htl-rooms">
                                        <?php if ($i == 1) { ?>
                                            <input type="hidden" id="total_rooms" value="4" />
                                            <label>Rooms</label>
                                            <select class="form-control" id="rooms" name="room_count">
                                                <?php for ($r = 1; $r <= 3; $r++) { ?>
                                                    <option value="<?php echo $r; ?>" <?php echo($r == $rooms ? 'selected="selected"' : ''); ?>><?php echo $r; ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } else { ?>
                                            <span>Room <?php echo $i; ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-2 htl-adults" >
                                        <label>Adults (12+)</label>
                                        <select class="form-control" name="adult[]" id="adult_count_<?php echo $i; ?>">
                                            <?php for ($a = 1; $a <= 4; $a++) { ?>
                                                <option value="<?php echo $a; ?>" <?php echo ((isset($adults[$i - 1]) && $a == $adults[$i - 1]) ? 'selected="selected"' : ''); ?>><?php echo $a; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 htl-selectChild">
                                        <label>Child (0-11)</label>
                                        <select class="form-control selectchildAge" id="slect-room<?php echo $i; ?>ChildAge child_count_<?php echo $i; ?>" name="child[]">
                                            <option value="0" selected>0</option>
                                            <?php for ($c = 1; $c <= 3; $c++) { ?>
                                                <option value="<?php echo $c; ?>" <?php echo ((isset($childs[$i - 1]) && $c == $childs[$i - 1]) ? 'selected="selected"' : ''); ?>><?php echo $c; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php
                                    if (!empty($childs_ages) && isset($childs_ages[$i - 1])) {
                                        $ages = explode(',', $childs_ages[$i - 1]);
                                        /* if(empty($ages))
                                          $ages = array(0,0,0); */
                                    } else {
                                        $ages = array(0, 0, 0);
                                    }
                                    ?>
                                    <div class="col-md-2 htl-age htl-childAge1" id="htl-child1Age-room<?php echo $i; ?>" <?php echo ($ages[0] > 0 ? 'style="display:block;"' : 'style="display:none;"'); ?>>
                                        <label>Child 1 Age</label>
                                        <select class="form-control" name="childs_ages_room<?php echo $i; ?>[]">
                                            <?php for ($cage = 1; $cage <= 11; $cage++) { ?>
                                                <option value="<?php echo $cage; ?>" <?php echo((isset($ages[0]) && $cage == $ages[0]) ? 'selected="selected"' : ''); ?>><?php echo $cage; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 htl-age htl-childAge2" id="child2Age-room<?php echo $i; ?>" <?php echo ((isset($ages[1]) && $ages[1] > 0) ? 'style="display:block;"' : 'style="display:none;"'); ?>>
                                        <label>Child 2 Age</label>
                                        <select class="form-control" name="childs_ages_room<?php echo $i; ?>[]">
                                            <?php for ($cage = 1; $cage <= 11; $cage++) { ?>
                                                <option value="<?php echo $cage; ?>" <?php echo ((isset($ages[1]) && $cage == $ages[1]) ? 'selected="selected"' : ''); ?>><?php echo $cage; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 htl-age htl-childAge3" id="child3Age-room<?php echo $i; ?>" <?php echo ((isset($ages[2]) && $ages[2] > 0) ? 'style="display:block;"' : 'style="display:none;"'); ?>>
                                        <label>Child 3 Age</label>
                                        <select class="form-control" name="childs_ages_room<?php echo $i; ?>[]">
                                            <?php for ($cage = 1; $cage <= 11; $cage++) { ?>
                                                <option value="<?php echo $cage; ?>" <?php echo ((isset($ages[2]) && $cage == $ages[2]) ? 'selected="selected"' : ''); ?>><?php echo $cage; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>



                            <?php } ?>           
                        </div>
                    </div>
                    <div class="searchBtncntr marginTop5">

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="searchHotelsBtn">SEARCH HOTELS <i class="fa fa-search"></i></button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div>
</form>
