<?php echo $this->load->view('home/header'); ?>
<!-----  Top destination content ----->

<div class="selectBusCntr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Select a Bus which suits you</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="selecttrip">
                  <li class="active">
                        <?php $sess = $this->session->userdata('bus_search_data'); ?>
                        <span id="fromBus"><?php echo $sess['sourcename']; ?></span> ---> 
                        <span id="toBus"><?php echo $sess['destiname']; ?></span><br>
                        <span class="seats"></span>
                    </li>
                    <li>
                        <span id="fromBus"><?php echo $sess['destiname']; ?></span> ---> 
                        <span id="toBus"><?php echo $sess['sourcename']; ?></span><br>
                        <span>&nbsp;</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="busResults">
    <div class="container">
        <div class="row">
    	<div class="col-md-12">
        	<div class="busCntr ResultsCntr verySoftShadow">
	<div class="row">
        	<div class="col-md-6 selectedDate">
                <h4><?php echo $sess['from_date']; ?></h4>
            </div>
            <div class="col-md-6">
<!--            	<span class="result-date-range pull-right"> <span>DATES: </span> <a href="#" class="date">JAN 29</a> <a href="#" class="date">JAN 30</a> <a href="#" class="date active">JAN 31</a> <a href="#" class="date">FEB 1</a> <a href="#" class="date">FEB 2</a> </span>-->
        </div>
        </div>

        <!--filters section-->
        <div class="row bus-filters">
            <div class="col-md-3">
                <div class="dropdown">
                    <a id="dLabel" class="active" role="button" data-toggle="dropdown" data-target="#">
                        <i class="fa fa-truck"></i> Travels <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu AirLines" role="menu" aria-labelledby="dLabel">
                        <!--                        <li>KSRTC Travles</li>
                                                <li>VRL Travels</li>
                                                <li>SRS Travels</li>
                                                <li>Sugama Travels</li>-->
                        <!-- travels display  -->
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dropdown">
                    <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
                        <i class="fa fa-bookmark"></i> Bus Type <span class="caret"></span>
                    </a>                
                    <ul class="dropdown-menu AirLines1" role="menu" aria-labelledby="dLabel">
<!--                        <li><label><input type="checkbox" value="ac">A/C</label></li>
                        <li><label><input type="checkbox" value="nonac">Non A/C</label></li>
                        <li><label><input type="checkbox" value="sleeper">Sleeper</label></li>-->
                        <!-- bus type  -->
                    </ul>
                </div>
            </div>

            <div class="col-md-2">
                <div class="dropdown">
                    <div class="slider">Price: Rs                        
                        <span id="priceSliderOutput" style="font-weight: normal;"></span>           
                        <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                        <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />

                        <div id="priceSlider"  style="z-index:0;"></div>          
                    </div>
                </div>
            </div>

            <!--            <div class="col-md-2">
                            <div class="dropdown">
                                <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
                                    <i class="fa fa-map-marker"></i> Dropping Points <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li>Bboarding point</li>
                                    <li>Another Point</li>
                                </ul>
                            </div>
                        </div>-->
            <!--            <div class="col-md-2">
                            <div class="dropdown">
                                <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
                                    <i class="fa fa-star-half-o"></i> Bus Rating <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li>High rated</li>
                                    <li>Low rated</li>
                                    <li>All Buses</li>
                                </ul>
                            </div>
                        </div>-->
        </div>

        <!--active filter section-->
        <div class="active-filter"></div>

        <!--buses container-->
        <div class="row buses">
            <div class="col-md-12">
                <!--Custom loader for results-->
                <div class="loader"><span>Searching for Buses ...</span></div>
                <!--Results loads here-->

                <div id="buses">
                    <div class="bus-header">
                        <div class="bus-travels"><div>Travels | Bus type</div></div>
                        <div class="bus-amenities"><div>Amenitites</div></div>
                        <div class="bus-deparr"><div>Dep | Arr | Hrs.<span class="mob-fare">| Fare</span></div></div>
                        <div class="bus-rating"><div>Fare</div></div>
                        <div class="bus-fare"><div> Seats</div></div>
                    </div>

                    <!--Will repeat as per bus availability-->
                    <?php
                    if ($result != '') {
                        foreach ($result as $data) {
                            $totalPriceAry[] = $data->price;
                            ?>
                            <div class="bus-row searchbus_box" >
                                <div class="bus-rowInner BusInfoBox" data-price="<?php echo $data->price; ?>" data-airlinename="<?php echo $data->travels; ?>"  data-airline="<?php echo $data->travels; ?>" data-airlinename1="<?php echo $data->bus_type; ?>"  data-airline1="<?php echo $data->bus_type; ?>" data-duration="<?php echo '123'; ?>" data-fare="<?php echo '1'; ?>" data-departure="<?php echo '1'; ?>" data-arrival="<?php echo '1'; ?>" data-stop="<?php echo '1'; ?>">
                                    <div class="bus-travels">
                                        <div>
                                            <span class="travels"><?php echo $data->travels; ?></span>
                                        </div>
                                        <div>
                                            <?php echo $data->bus_type; ?>
                                        </div>
                                        <!--                                        <div><a href="#">canc. policy</a> | <a href="#">address</a></div>-->
                                    </div>
                                    <div class="bus-amenities">
                                        <div>
                                            <span>info unavailable</span>
                                        </div>
                                        <?php if ($data->mticket_enabeld == 'true') { ?>
                                            <div>
                                                <span><i class="fa fa-tablet mticket"></i> mTicket</span>
                                                <div class="section" id="dLabel" role="button" data-toggle="dropdown">

                                                    <i class="fa fa-chevron-circle-down"></i>                                        
                                                </div>
                                                <div class="toolTip dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                    <table><tr><td>This Bus can boarded by simply showing an mTicket SMS</td></tr></table> 
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div>
                                           <!-- <span><i class="fa fa-picture-o"></i> <span class="viewGallery">Photos</span>  | <i class="fa fa-video-camera"></i> Videos</span>-->
                                        </div>
                                    </div>
                                    <div class="bus-deparr">
                                        <div>
                                            <div class="section" id="dLabel" role="button" data-toggle="dropdown">
                                                <span class="busdep">DEP: <i class="fa fa-long-arrow-right"></i></span>
                                                <?php echo $this->Bus_Model->getTime($data->depart_time); ?><i class="fa fa-chevron-circle-down"></i>                                        
                                            </div>
                                            <div class="toolTip dropdown-menu" role="menu" aria-labelledby="dLabel">

                                                <table width="100%">
                                                    <tr>
                                                        <th colspan="2">Departures <span>(Boarding points)</span></th>
                                                    </tr>
                                                    <?php
                                                    $boarding = $this->Bus_Model->getboarding($data->bus_search_result_info_id);
                                                    $dropping = $this->Bus_Model->getdropping($data->bus_search_result_info_id);

                                                    foreach ($boarding as $val) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $val->location; ?></td>
                                                            <td><?php echo $this->Bus_Model->getTime($val->time); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="section" id="dLabel" role="button" data-toggle="dropdown">
                                                <span class="busarr">ARR: <i class="fa fa-long-arrow-left"></i></span>
                                                <?php echo $this->Bus_Model->getTime($data->arrival_time); ?> <i class="fa fa-chevron-circle-down"></i>
                                            </div>
                                            <div class="toolTip dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                <table width="100%">
                                                    <tr>
                                                        <th colspan="2">Arrivals<span>(Dropping points)</span></th>
                                                    </tr>
                                                    <?php foreach ($dropping as $val) { ?>

                                                        <tr>
                                                            <td><?php echo $val->location; ?></td>
                                                            <td><?php echo $this->Bus_Model->getTime($val->time); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                           <!-- <span class="busdur">DUR: <i class="fa fa-clock-o"></i></span> 7.30 Hrs  -->
                                        </div>
                                    </div>
                                    <div class="bus-rating">
                                        <div>
                                           <!-- <span class="rating rating2"></span> -->
                                            <span class="price"><i class="fa fa-rupee"></i><?php echo $data->price; ?></span>
                                        </div>
                                        <!--                                        <div>
                                                                                    <span>operator rating</span>
                                                                                </div>-->
                                    </div>
                                    <div class="bus-fare">
                                        <!--                                        <div>
                                                                                 
                                                                                </div>-->
                                        <div>
                                            <?php echo $data->available_seats; ?> Seats Available
                                        </div>
                                        <div>
                                            <!--                                            <button class="btn btn-danger btn-viewseat">
                                                                                            <span class="showseat">VIEW SEATS</span>
                                                                                            <span class="hideseat">HIDE SEATS</span> <i class="fa fa-arrow-down"></i>
                                                                                        </button>-->
                                            <button class="btn btn-danger btn-viewseat" id="get_<?php echo $data->bus_search_result_info_id; ?>" tripid="<?php echo $data->id; ?>" onclick="get_seat(<?php echo $data->bus_search_result_info_id . ',' . $data->id.',3'; ?>);">
                                                <span class="showseat" >VIEW SEATS</span>
                                                <span class="hideseat">HIDE SEATS</span> <i class="fa fa-hand-o-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="bus-seat-row">
                                    <div class="seatselectionCntr" id="display_seat_<?php echo $data->bus_search_result_info_id; ?>">
                                        <span align="center" class="col-md-11"><span>Please wait...</span><br><span><img src="<?php echo WEB_DIR; ?>public/images/ajax-loader-2.gif" /></span></span>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        echo '
<div class="bus-row"> No Results Found for your search
</div>
';
                    }
                    ?>
                    <input type="hidden" id="setMinPrice" value="<?php if (!empty($totalPriceAry)) echo min($totalPriceAry); else echo '0'; ?>" />                             
                    <input type="hidden" id="setMaxPrice" value="<?php if (!empty($totalPriceAry)) echo max($totalPriceAry); else echo '0'; ?>" />                         
                    <input type="hidden" id="setCurrency" value="Rs." /> 
                </div>    
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>
<script>

  
    function get_seat(bus_id,id,triptype){
   
        var newid=$("#get_"+bus_id).attr('tripid');
        $.ajax({url:"<?php echo WEB_URL; ?>bus/get_layout/"+newid+"/"+bus_id+"/"+triptype,
            success:function(result){
                $("#display_seat_"+bus_id).html(result);
            }});
    }
</script>

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/bus/filter.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/bus/sorting.js"></script>

<script type="text/javascript">

    $(document).on("click", '.AirLine','.AirLine12', function ($e) {
        //alert('suc');	
        filter();
    } );
   
    $(document).ready(function()    
    
    {
        $('.AirLines1').click(function(){ 
            filter();
        })
        //        $(".Stop").click(function()
        //        {
        //            filter();
        //        });
		
        //        $(".FareRule").click(function()
        //        {
        //            filter();
        //        });		
		
        //==================Callbacks===============================	
        setPriceSlider();			
        //        setTimeSlider();
		
        // Airline Code and Airline Name
		
        var data_airline=new Array;
        var data_airlineNames=new Array;
					
        var flightCount=0;						
        $(".BusInfoBox").each(function()
        {
            flightCount++;
            data_airline.push($(this).attr("data-airline"));
            data_airlineNames.push($(this).attr("data-airlinename")); 
			
        });	
		
        $("#flightCount").text(flightCount);
        $("#flightCount1").text(flightCount);	
				
        data_airline = $.grep(data_airline, function(v, k)
        {			   
            return $.inArray(v ,data_airline) === k;
        });
			
        data_airlineNames = $.grep(data_airlineNames, function(v, k)
        {
            return $.inArray(v ,data_airlineNames) === k;
        });
		
        var AirlineString="";
        for(var ai=0;ai<data_airline.length;ai++)		
        {
            var airlineCode=data_airline[ai];
            var airlineName=data_airlineNames[ai];
            if(typeof airlineCode=="undefined" || airlineCode=="" || airlineName=="") {}
            else
            {
                AirlineString+='<div class="leftLabels"><span><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked"> </span><label>'+airlineName+'</label></div>';
            }				
        }
        $(".AirLines").html(AirlineString);
						
				
        $(".labelsFilter").click(function(){
            $(this).next(".leftDetailsContainer").slideToggle('slow'); 
            var plusmin;
            plusmin = $(this).children(".plusminus").text();
		
            if( plusmin == '+')
                $(this).children(".plusminus").text('-');
            else
                $(this).children(".plusminus").text('+');
        });
        
        // this is for travels filter
   	
        var data_airline1=new Array;
        var data_airlineNames1=new Array;
					
        var flightCount=0;						
        $(".BusInfoBox").each(function()
        {
            flightCount++;
            data_airline1.push($(this).attr("data-airline1"));
            data_airlineNames1.push($(this).attr("data-airlinename1")); 
			
        });	
		
        $("#flightCount").text(flightCount);
        $("#flightCount1").text(flightCount);	
				
        data_airline1 = $.grep(data_airline1, function(v, k)
        {			   
            return $.inArray(v ,data_airline1) === k;
        });
			
        data_airlineNames1 = $.grep(data_airlineNames1, function(v, k)
        {
            return $.inArray(v ,data_airlineNames1) === k;
        });
		
        var AirlineString1="";
        for(var ai=0;ai<data_airline1.length;ai++)		
        {
            var airlineCode1=data_airline1[ai];
            var airlineName1=data_airlineNames1[ai];
            if(typeof airlineCode1=="undefined" || airlineCode1=="" || airlineName1=="") {}
            else
            {
                AirlineString1+='<div class="leftLabels"><span><input id="AirLine_space" class="AirLine1" type="checkbox" value="'+airlineCode1+'" checked="checked"> </span><label>'+airlineName1+'</label></div>';
            }				
        }
        $(".AirLines1").html(AirlineString1);
	
        //this is for the travels type filter
	
        <!--=====  Scrolling   =====--->
        $(window).scroll(function(e) {
            var scroller_anchor = $(".scroller_anchor").offset().top;
            if ($(this).scrollTop() >= scroller_anchor && $('.resultHeader, .m-s-search').css('position') != 'fixed') 
            {    
                $('.resultHeader, .m-s-search').css({
                    //'background': '#CCC',
                    'position': 'fixed',
                    'top': '0px'
                });
                //$('.scroller_anchor').css('height', '50px');
            } 
            else if ($(this).scrollTop() < scroller_anchor && $('.resultHeader, .m-s-search').css('position') != 'relative') 
            {    
                //$('.scroller_anchor').css('height', '0px');
                $('.resultHeader, .m-s-search').css({
                    'position': 'relative'
                });
            }
        });		
		
    })
	
</script>
<!-- Airport AutoComplete List-->
<!--<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/autocomplete/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/autocomplete/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.min.css" type="text/css" /> 