<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="" description="" />

<title>::FlyNStay::</title>
<link href="<?php echo WEB_DIR;?>public/css/styles.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">

<script src="http://cdn.webrupee.com/js" type="text/javascript"></script>
<script src="<?php echo WEB_DIR;?>public/js/jquery-1.9.1.js"></script>
<script src="<?php echo WEB_DIR;?>public/js/jquery-ui.js"></script>

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/filter.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/sorting.js"></script>

<script type="text/javascript">

    $(document).on("click", '.AirLine', function ($e) {
  			
			filter();
	} );
	
   $(document).ready(function() 
    {
		$(".Stop").click(function()
		{
			filter();
		});
		
		$(".FareRule").click(function()
		{
			filter();
		});		
		
      //==================Callbacks===============================	
	  	setPriceSlider();			
		setTimeSlider();
		
		// Airline Code and Airline Name
		
		var data_airline=new Array;
		var data_airlineNames=new Array;
					
		var flightCount=0;						
		$(".FlightInfoBox").each(function()
		{
			flightCount++;
			data_airline.push($(this).attr("data-airline"));
			data_airlineNames.push($(this).attr("data-airlinename"));
			
		});	
		
		$("#flightCount").text(flightCount);	
				
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
			if(typeof airlineCode=="undefined" || airlineCode=="") {}
			else
			{
			AirlineString+='<div class="leftLabels"><span><input id="AirLine_space" class="AirLine" type="checkbox" value="'+airlineCode+'" checked="checked"> </span><label>'+airlineName+'</label></div>';
			}				
		}
		$(".AirLines").html(AirlineString);
		
		//show matrix
		//matrix('onwardMatrix');
		
		<!--==  Hide show  ==---->
  $('.nav-toggle').click(function(){
					//get collapse content selector
					var collapse_content_selector = $(this).attr('href');					
					
					//make the collapse content to be shown or hide
					var toggle_switch = $(this);
					$(collapse_content_selector).slideToggle(function(){
						if($(this).css('display')=='none'){
							toggle_switch.html('Show Matrix');//change the button label to be 'Show'
						}else{
							toggle_switch.html('Hide Matrix');//change the button label to be 'Hide'
						}
					});
				});
				
				
$(".labelsFilter").click(function(){
		$(this).next(".leftDetailsContainer").slideToggle('slow'); 
		var plusmin;
		plusmin = $(this).children(".plusminus").text();
		
		if( plusmin == '+')
		$(this).children(".plusminus").text('-');
		else
		$(this).children(".plusminus").text('+');
	});
	
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
			
		
	 });

// Filter Matrix

  function matrix(selector)
  {		
		$.ajax
		({
			url:'<?php echo WEB_URL; ?>flight/int_rateMatrix',
			data: '',
			dataType: "json",		
			success: function(data)
			{
				alert(data.matrix);
				$("."+selector).html(data.matrix);
			}
		});
  }
	
</script>
</head>
<body>
<div id="container">
  
  
  <?php echo $this->load->view('home/header');?>
    
  <div class="buttonHolder">
  <button type="button">Bangalore -  Chennai</button>
  </div>
 
  <div class="onwardMatrix airlineDetails" id="collapse1">
    <!--<table width="100%" height="100%" class="tableDetails" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="0">
      <tr>
        <td style="width:16%;"><label><a href="#">Show all Airlines</a></label>
          <span class="marginLeft4"><img src="<?php echo WEB_DIR?>public/images/right-arrow.jpg" alt="rightArrow" /></span><br />
          <label><a href="#">Departure</a></label>
          <span class="marginLeft4"><img src="<?php echo WEB_DIR?>public/images/down-arrow.jpg" alt="down" /></span> </td>
        <td style="padding: 10px 0;"><table width="100%" class="spiceJet" border="0" cellspacing="0" align="center" cellpadding="0">
            <tr>
              <td><img src="<?php echo WEB_DIR?>public/images/redIcon.jpg" alt="icon" /></td>
            </tr>
            <tr>
              <td>Spicejet</td>
            </tr>
            <tr>
              <td class="flights-results"><a href="#">3 Flights</a></td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" class="airlineIndigo" align="center" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><img src="<?php echo WEB_DIR?>public/images/plane-small.jpg" alt="plane" /></td>
            </tr>
            <tr>
              <td>Indigo</td>
            </tr>
            <tr>
              <td class="flights-results"><a href="#">6 Flights</a></td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" class="jetAirways" align="center" cellpadding="0">
            <tr>
              <td><img src="<?php echo WEB_DIR?>public/images/jet.jpg" alt="jet" /></td>
            </tr>
            <tr>
              <td>JetKonnect</td>
            </tr>
            <tr>
              <td class="flights-results"><a href="#">1 Flights</a></td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" class="rocketWays" align="center" cellpadding="0">
            <tr>
              <td><img src="<?php echo WEB_DIR?>public/images/rocket.jpg" alt="rock" /></td>
            </tr>
            <tr>
              <td>Air India</td>
            </tr>
            <tr>
              <td class="flights-results"><a href="#">4 Flights</a></td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" align="center" class="airlineYellow" cellpadding="0">
            <tr>
              <td><img src="<?php echo WEB_DIR?>public/images/yellow-logo.jpg" alt="image" /></td>
            </tr>
            <tr>
              <td>Jet Airways</td>
            </tr>
            <tr>
              <td class="flights-results"><a href="#">12 Flights</a></td>
            </tr>
          </table></td>
      </tr>
      <tr bgcolor="#eff2f7">
        <td>05.00 - 12.00</td>
        <td><span  class="WebRupee">₹</span>4,851</td>
        <td>&nbsp;</td>
        <td><span  class="WebRupee">₹</span>4,851</td>
        <td>&nbsp;</td>
        <td><span  class="WebRupee">₹</span>16,332</td>
      </tr>
      <tr>
        <td>05.00 - 12.00</td>
        <td><span  class="WebRupee">₹</span>4,851</td>
        <td>&nbsp;</td>
        <td><span  class="WebRupee">₹</span>4,851</td>
        <td><span  class="WebRupee">₹</span>4,977</td>
        <td><span  class="WebRupee">₹</span>5,166</td>
      </tr>
      <tr bgcolor="#eff2f7">
        <td>05.00 - 12.00</td>
        <td><span  class="WebRupee">₹</span>4,851</td>
        <td><span  class="WebRupee">₹</span>4,851</td>
        <td><span  class="WebRupee">₹</span>4,851</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>05.00 - 12.00</td>
        <td><span  class="WebRupee">₹</span>15,964</td>
        <td>&nbsp;</td>
        <td><span  class="WebRupee">₹</span>9,395</td>
        <td>&nbsp;</td>
        <td><span  class="WebRupee">₹</span>16,280</td>
      </tr>
    </table>-->
  </div>
  
  <div class="matrixBtnHold">
    <div class="matrix">
      <button type="button" href="#collapse1" class="nav-toggle">Hide Matrix
      <span class="marginLeft4">
      <img src="<?php echo WEB_DIR?>public/images/matrix-arrow.jpg" alt="arrow" />
      </span>
    </button>
      
    </div>
  </div>
  <!--  Modify Search   -->
  
   <!-- popup form #1 -->
        <a href="#x" class="overlay" id="login_form"></a>
        	 
        <div class="popup" style="padding:0;">
            <h3 class="popover-title clearfix">
            <span class="popover-titlecontent modalTitle">Flights Stats</span></h3>
            <div class="popover-content modalBody pZero">
		
	<table width="100%" cellspacing="0" cellpadding="0" class="zebra FlightStat txtSmall">
		<tbody>
			<tr>
				<td><b>Airline</b></td>
				<td>Spicejet</td>
			</tr>
			<tr>
				<td><b>Flight No.</b></td>
				<td>803</td>
			</tr>
			<tr>
				<td><b>On time performance</b></td>
				<td>98.41 %</td>
			</tr>
			<tr>
				<td><b>Risk of Cancellation</b></td>
				<td>0</td>
			</tr>
			
			<tr>
				<td><b>Average Delay</b></td>
				<td>0 mins</td>
			</tr>
			<tr style="height:60px;">
				<td><b>Star Rating</b></td>
				<td id="star-rating">
					<ul class="inline">
						<li class="stars_5">&nbsp;</li>
						<li class="hide">&nbsp;</li>
						
					</ul>
					<ul class="inline">
						<li style="background-color:#fff !important;">5 of 5 <br>Excellent</li>
					</ul>
				</td>
			</tr>
			
		</tbody>
	</table>
			
</div>

            <a class="close" href="#close"></a>
        </div>
        <!-- popup form #2 -->
        <a href="#x" class="overlay" id="join_form"></a>
      <div class="popup">
            <div class="tabs">
       <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
       <label for="tab-1" class="tab-label-1">Domestic Flights</label>
       <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2 tabs-selector2" />
       <label for="tab-2" class="tab-label-2">International Flights</label>
       <div class="clear-shadow"></div>
       <div class="content">
        <div class="content-1" class="font13"> 
        <span style="float:left;">
              <input type="radio" id="dl" value="YES" name="yesno" class="marginTopRight3" /><p class="onewayRound">Oneway</p>
              <input type="radio" id="dl" value="NO" name="yesno" checked  class="marginTopRight3"  /><p class="onewayRound">Round Trip</p></span>
           <div class="fromToHolder">
            <div class="fromLeft"> <span class="spanHolder">From</span> <span class="spanHolder">
              <select>
                <option value="volvo">Delhi</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
              </select>
              </span> </div>
            <div class="toRight"> <span class="spanHolder">To</span> <span class="spanHolder">
              <select>
                <option value="volvo">Bangalore</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
              </select>
              </span> </div>
          </div>
           
           <!---  Departure  --->
           
           <div class="departureHolder">
            <form action="#" method="get">
            <div data-role="fieldcontain"  class="calenderContainer">
            	<div class="departureHold">
                <span class="floatLeft">Departure: </span><br />
               <span> <input class="datePickerIcon" id="datepicker" /></span>
                </div>
                <div class="returnHold">
                <span class="floatLeft">Return: </span><br />
                <span><input class="datePickerIcon" id="datepicker2" /></span>
                </div>
            </div>        
        </form>
          </div>
           <!---  Adults and childs Details  --->
           <div class="adults-childs-infants">
            <div class="adultsHold"> <span>Adult 12+ Yrs</span> <span>
              <select class="selectDropdown">
              		<option value="one">1</option>
                    <option value="one">2</option>
                    <option value="one">3</option>
                    <option value="one">4</option>
                    <option value="one">5</option>
                    <option value="one">6</option>
                    <option value="one">7</option>
                    <option value="one">8</option>
                    <option value="one">9</option>
              </select>
              </span> </div>
            <div class="childHold"> <span>Adult 12+ Yrs</span> <span>
             <select class="selectDropdown">
             		<option value="one">0</option>
              		<option value="one">1</option>
                    <option value="one">2</option>
                    <option value="one">3</option>
                    <option value="one">4</option>
                    <option value="one">5</option>
                    <option value="one">6</option>
                    <option value="one">7</option>
                    <option value="one">8</option>
              </select>
              </span> </div>
            <div class="infantsHold"> <span>Infants below 2yrs</span> <span>
             <select class="selectDropdown">
              		<option value="one">0</option>
                    <option value="one">1</option>
                    <option value="one">2</option>
              </select>
              </span> </div>
            <div class="classHold"> <span>Class</span> <span>
              <select>
                <option value="volvo">Economy</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
              </select>
              </span> </div>
          </div>
           <div class="searchBtnHolder" style="width:99%;">
            <button type="button">Search Flights</button>
          </div>
         </div>
      </div>
     </div>

            <a class="close" href="#close"></a>
        </div>
  
  <div class="modifySearchHolder">
    <div class="m-s-search">
      <div class="modifytheSearchBtn"> <span class="searchIcon"></span> <span class="searchLabel"><a href="#join_form" id="join_pop">Modify the Search</a></span> </div>
      <div class="filterSearch">
        <div class="filterSearchHeader"> <span class="towerIcon"><img src="<?php echo WEB_DIR;?>public/images/tower.png" alt="tower" /></span> <span class="filterSearchLabel">Filter Search</span> </div>
        
         <label class="menu_head labelsFilter">Price Range: <span class="plusminus">-</span></label>
        <div class="leftDetailsContainer">
        	<!--<p>
  			<label for="amount"></label><input type="text" id="amount" />
			</p> 
		<div id="slider-range"></div>-->
			<span id="priceSliderOutput" style="font-weight: normal;"></span>
            <div style="padding:0px; margin: 0px;">
                <div id="priceSlider"  style="z-index:0;"></div>
                <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
            </div>

        </div>
          <label class="menu_head labelsFilter">Onward depart time: <span class="plusminus">-</span></label>
        <div class="leftDetailsContainer">
      <!--  <div id="time-range">
            <p><span class="slider-time">10:00 AM</span> - <span class="slider-time2">12:00 PM</span>
            
            </p>
            <div class="sliders_step1">
            <div id="slider-range-time" style="z-index:0;"></div>
            </div>
        </div>-->
        <span id="timeSliderOutput" style="font-weight: normal;"></span>
        <div style="padding:0px;">
            <div id="timeSlider" style="z-index:0;"></div>
            <input type="hidden" name="minTime" id="minTime" class="autoSubmit"  />
            <input type="hidden" name="maxTime" id="maxTime" class="autoSubmit"  />
        </div> 

        </div>
          <label class="menu_head labelsFilter">Airlines: <span class="plusminus">-</span></label>
        <div class="leftDetailsContainer AirLines">
          <!-- Airlines Display -->
        </div>
          <label class="menu_head labelsFilter">No. of stops: <span class="plusminus">-</span></label>
        <div class="leftDetailsContainer noOfStopHeight">
          <div class="noHgtChkbx"> <span>            
            <input class="Stop" type="checkbox" value="0" checked="checked"  id="AirLine_space"/>
            </span>
            <label>Non Stop</label>
          </div>
          <div class="noHgtChkbx"> <span>
           <input class="Stop" type="checkbox" value="1" checked="checked"  id="AirLine_space"/>
            </span>
            <label>1</label>
          </div>
           <div class="noHgtChkbx"> <span>
           <input class="Stop" type="checkbox" value="2" checked="checked"  id="AirLine_space"/>
            </span>
            <label>1+</label>
          </div>
        </div>
          <label class="menu_head labelsFilter">Fare type: <span class="plusminus">-</span></label>
        <div class="leftDetailsContainer">
          <div class="noHgtChkbx"> <span>
             	<input class="FareRule" type="checkbox" checked="checked" value="Refundable"  id="AirLine_space"/>
            </span>
            <label>Refundable</label>
          </div>
          <div class="noHgtChkbx"> <span>  
          <input class="FareRule" type="checkbox" checked="checked" value="Non-Refundable"  id="AirLine_space"/>
            </span>
            <label>Non Refundable</label>
          </div>
        </div>
      </div>
    </div>
   	 <div class="rightContainer rightContainerOneway">
    	<div class="resultHeader">
    	<div class="headerHolder">
        	<div class="leftBookingRates">
            	<span class="prevButton"><span class="paddingRight3"><img src="<?php echo WEB_DIR;?>public/images/leftArrow.png" alt="arrow" /></span>Prev day</span>
                    <span class="preRupee">
                    	<span class="WebRupee">₹</span>4,851
                </span>
            </div>
            <div class="rightBookingRates">
            <span><div id="flightCount"></div>Bangalore - Chennai</span>
            <span>Thu 12 - Sep</span></div>
            <div class="rightCalender">
            	<div class="prev-btn">
                	<span class="prevButton">Next day<span class="paddingLeft3"><img src="<?php echo WEB_DIR?>public/images/rightArrow.png" alt="right" /></span></span>
                    <span class="preRupee">
                    	<span class="WebRupee">₹</span>4,851
                    </span>
                </div>
                <div class="rupee-calender"></div>
            </div>
        </div>
        <div class="videowall-grid" style="display: block; ">
            <div id="row" style="font-weight:bold;">
                <div id="1_1" class="square">
                <a href="javascript:void(0);" title="Sort By Airline" rel="data-airlinename" data-order="asc" class="FlightSorting"><img src="<?php echo WEB_DIR; ?>public/images/uparror.png" border="0" /> <span class="pricespace_flights">Airline</span> <img src="<?php echo WEB_DIR; ?>public/images/downarror.png" border="0" /></a>
                </div>
                <div id="1_2" class="square">
                <a  href="javascript:void(0);" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSorting"><img src="<?php echo WEB_DIR; ?>public/images/uparror.png" border="0" /> <span class="pricespace_flights">Departure</span> <img src="<?php echo WEB_DIR; ?>public/images/downarror.png" border="0" /></a>                
                </div>
                <div id="1_3" class="square">&nbsp;&nbsp;<img src="<?php echo WEB_DIR;?>public/images/arrow.png" alt="arrow"></div>
                <div id="1_4" class="square">
                 <a  href="javascript:void(0);" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSorting"><img src="<?php echo WEB_DIR; ?>public/images/uparror.png" border="0" /> <span class="pricespace_flights">Arrival</span> <img src="<?php echo WEB_DIR; ?>public/images/downarror.png" border="0" /></a>
                </div>
                <div id="1_5" class="square">
                <a  href="javascript:void(0);" title="Sort By Fare Type" rel="data-fare" data-order="asc" class="FlightSorting"><img src="<?php echo WEB_DIR; ?>public/images/uparror.png" border="0" /> <span class="pricespace_flights">Fare Type</span> <img src="<?php echo WEB_DIR; ?>public/images/downarror.png" border="0" /></a>
                </div>
                <div id="1_6" class="square">
                 <a  href="javascript:void(0);" title="Sort By Duration" rel="data-duration" data-order="asc" class="FlightSorting"><img src="<?php echo WEB_DIR; ?>public/images/uparror.png" border="0" /> <span class="pricespace_flights">Duration</span> <img src="<?php echo WEB_DIR; ?>public/images/downarror.png" border="0" /></a>                
                </div>
                <div id="1_7" class="square">
               <a  href="javascript:void(0);" title="Sort By Total Fare" rel="data-price" data-order="asc" class="FlightSorting"><img src="<?php echo WEB_DIR; ?>public/images/uparror.png" border="0" /> <span class="pricespace_flights">Total Fare</span> <img src="<?php echo WEB_DIR; ?>public/images/downarror.png" border="0" /></a>
                </div>
            </div>
        </div>
        </div>
        <div class="scroller_anchor"></div>
       
        <!--   Grids Starting  -->
       
        <div id="videowall-grid" class="resultOnward" style="display: block;">
    <?php if(!empty($result)) {?>
      <?php
	    for($i=0;$i< count($result);$i++)
		{ 
		  $DepartureCode = explode(',',$result[$i]->Departure_LocationCode);
		  $MarketingAirline_Code = explode(',',$result[$i]->MarketingAirline_Code);
		  $MarketingAirline_Name = explode(',',$result[$i]->MarketingAirline_Name);
		  $FlightNumber = explode(',',$result[$i]->FlightNumber);
		  
		  $DepartureDateTime = explode(',',$result[$i]->DepartureDateTime);
		  $ArrivalDateTime = explode(',',$result[$i]->ArrivalDateTime);
		  $Duration = explode(',',$result[$i]->Duration);		  
		  
		  $ArrivalCode = explode(',',$result[$i]->Arrival_LocationCode);
		  $Departure_CityName = explode(',',$result[$i]->Departure_CityName);
		  $Arrival_CityName = explode(',',$result[$i]->Arrival_CityName);
		  
		  $Total_Duration = $result[$i]->Total_Duration;
		  $FareType = $result[$i]->FareType;
		  
		  $Destination = $result[$i]->Destination;	  
		  
		  $totalJourneyDuration = $this->Flight_Model->DurationTimeInMin($Total_Duration);
		
		  $DepartureTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(current(array_values($DepartureDateTime)),'mins');	 
		  $ArrivalTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime)),'mins');
		  
		  $Stops = $result[$i]->Stops;
		  if($Stops == 0)
		      $Stops = 0;
		  else
		      $Stops = $Stops - 1;
			  
		  $totalPriceAry[] = $result[$i]->TotalFare;
		  
		?>
             <div id="row" class="searchflight_box">
             <div class="searchflight searchflightallsearch FlightInfoBox font10" data-price="<?php echo $result[$i]->TotalFare; ?>" data-airlinename="<?php echo $MarketingAirline_Name[0]; ?>"  data-airline="<?php echo $MarketingAirline_Code[0]; ?>" data-duration="<?php echo $totalJourneyDuration; ?>" data-fare="<?php echo $FareType; ?>" data-departure="<?php echo $DepartureTimeInMin; ?>" data-arrival="<?php echo $ArrivalTimeInMin; ?>" data-stop="<?php echo $Stops; ?>" style="height: auto;">
           
            <?php for($j=0;$j< count($DepartureCode);$j++) {?>
               
                <div id="2_1" class="square">
                    <span class="rowSpanGrid"><img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j];?>.png" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j];?>" /></span>
                    <span class="rowSpanGrid"><?php echo $MarketingAirline_Name[$j];?></span>
                    <span class="rowSpanGrid"><?php echo $MarketingAirline_Code[$j];?> - <?php echo $FlightNumber[$j];?></span>
                </div>
                <div id="2_2" class="square">
                    <span class="rowSpanGrid"><strong>
					<?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[$j],'time');?>
                    </strong></span>
                    <span class="rowSpanGrid"><?php echo $Departure_CityName[$j];?></span>
                </div>
                <div id="2_3" class="square"><img src="<?php echo WEB_DIR;?>public/images/arrow.png" alt="arrow" /></div>
                <div id="2_4" class="square">
                    <span class="rowSpanGrid">
                    <strong>
					<?php echo $this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime[$j],'time');?></strong>
                    </span>
                    <span class="rowSpanGrid"><?php echo $Arrival_CityName[$j];?></span>
                </div>
                <div id="2_5" class="square">
                    <span class="rowSpanGrid">
                    <span style="color:#0066FF;">
                    <a href="#login_form"><?php echo $result[$i]->FareType;?></a>
                    </span>
                    </span>
                    <span class="rowSpanGrid">Paid Meal</span>
                </div>
                <div id="2_6" class="square">
                    <span class="rowSpanGrid"><?php echo $this->Flight_Model->GetHoursAndMinutes($Duration[$j]);?></span>
                    <span class="rowSpanGrid">
                    <?php 
					if($result[$i]->Stops == 0)				
                     	echo "Non Stop";				
					else				
						echo ($result[$i]->Stops-1)." Stop";					
					?>
                    </span>
                    <!--<span class="rowSpanGrid" style="color:#0066FF">
                    <span><img src="<?php echo WEB_DIR;?>public/images/clock.png" alt="clock" /></span>
                    <a href="#login_form">Stats</a>
                   </span>-->
                </div>
                <?php if($j==0) { ?>
               
                <div id="2_7" class="square">
                    <span class="bookNowRupeeStyle">
                    <span  class="WebRupee">₹</span>
					<?php echo $result[$i]->TotalFare;?></span>
                    <span>
                     <form action="<?php echo WEB_URL;?>flight/flight_int_details" method="post"  name="flight_details" >
                    <!--<a href="<?php //echo WEB_URL.'flight/flight_details/'.$result[$i]->flight_t_id.'/'.$i; ?>" ><button type="button">Book Now</button></a> -->                   
                 <input type="hidden" name="onwardFlightId" value="<?php echo $result[$i]->flight_t_id;?>" />
                 <input type="hidden" name="onwardIdVal" value="<?php echo $result[$i]->id_val;?>" />
                  <input type="image" src="<?php echo WEB_DIR; ?>public/images/book_now.png" />
                   </form>
                    </span>
                </div>
               
                <?php }else{ ?>
                  <div id="2_6" class="square">
                  &nbsp;
                  </div>
                <?php } ?>
               
              <?php if($ArrivalCode[$j] != $Destination){ ?> 
                <div class="spanHolder changeplanesplit">
					<span class="srpSprite yticonFlt">
						<img width="18" height="16" alt="plane" src="<?php echo WEB_DIR?>public/images/planeStop.png">
					</span>
                    <?php
					$ArrDateTime = preg_replace("/[T]/", " ", $ArrivalDateTime[$j]);
					//list($ArrDate, $ArrTime) = explode(" ", $ArrDateTime);
					$DepDateTime = preg_replace("/[T]/", " ", $DepartureDateTime[$j+1]);
					//list($DepDate, $DepTime) = explode(" ", $DepDateTime);					
					//$Diff = strtotime($DepTime) - strtotime($ArrTime);
					//$DiffTime = date('H:i:s', $Diff);
					?>
					<span class="verAlignMid">Change flight at <?php echo $Arrival_CityName[$j];?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime,$DepDateTime);?></span>
				</div>
              <?php } ?>
                <br />
                
                <?php } ?>
                </div>
            </div>
            
        <?php } ?>   
       
        
        <?php }else{ ?>
             <div id="row" class="font10">
             	<div align="center">No matching flights found... Please try again...</div>
             </div>
        <?php } ?>    
      
</div>        

    </div>
  </div>
   
        <input type="hidden" id="setMinPrice" value="<?php echo min($totalPriceAry);?>" />                               
        <input type="hidden" id="setMaxPrice" value="<?php echo max($totalPriceAry);?>" />                         
        <input type="hidden" id="setCurrency" value="Rs." /> 
        <input type="hidden" id="setMinTime" value="0" />                               
        <input type="hidden" id="setMaxTime" value="1440" /> 
  
  <?php echo $this->load->view('home/footer');?>
</div>


</body>
</html>
