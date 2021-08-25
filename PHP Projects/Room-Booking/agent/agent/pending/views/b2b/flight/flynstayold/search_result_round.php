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
	
	 $(document).on("click", '.onwardRadio', function ($e) {
  			
			$this=$(this);
			
			$airline=$this.parents('.FlightInfoBox').attr('data-airline');
			$airlinename=$this.parents('.FlightInfoBox').attr('data-airlinename');
		   	$price=$this.parents('.FlightInfoBox').attr('data-price');	
			$departure=$this.parents('.FlightInfoBox').attr('data-departure');	
			$arrival=$this.parents('.FlightInfoBox').attr('data-arrival');	
			$flightno=$this.parents('.FlightInfoBox').attr('data-flightno');
			
			$origin=$this.parents('.FlightInfoBox').attr('data-origin');
			$destination=$this.parents('.FlightInfoBox').attr('data-destination');
			$departdate=$this.parents('.FlightInfoBox').attr('data-departdate');
			
			$flightId=$this.parents('.FlightInfoBox').attr('data-flightid');
			$idval=$this.parents('.FlightInfoBox').attr('data-idval');
			
			$dtime = formatMinutes($departure);
			$atime = formatMinutes($arrival);
			
			priceInfoOnward ='<span class="timing-logo-holder"><span style="float:left;"><img width="32" height="25" alt="'+$airlinename+'" src="http://www.cleartrip.com/images/logos/air-logos/'+$airline+'.png" /></span><span class="bottom-naming">'+$airline+'-'+$flightno+'</span></span><span class="spanOne"><span class="labelOne">'+$origin+'-'+$destination+' | '+$departdate+'</span><span class="timingSelection">'+$dtime+' - '+$atime+'</span><input type="hidden" name="onwardFlightId" value="'+$flightId+'" /><input type="hidden" name="onwardIdVal" value="'+$idval+'" /></span>';
			   
		    $(".priceInfoOnward").html(priceInfoOnward);
		    $(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
	} );
	
	$(document).on("click", '.returnRadio', function ($e) {
  			
			$this=$(this);
		    			
			$airline=$this.parents('.FlightInfoBox').attr('data-airline');
			$airlinename=$this.parents('.FlightInfoBox').attr('data-airlinename');
		   	$price=$this.parents('.FlightInfoBox').attr('data-price');	
			$departure=$this.parents('.FlightInfoBox').attr('data-departure');	
			$arrival=$this.parents('.FlightInfoBox').attr('data-arrival');	
			$flightno=$this.parents('.FlightInfoBox').attr('data-flightno');
			
			$origin=$this.parents('.FlightInfoBox').attr('data-origin');
			$destination=$this.parents('.FlightInfoBox').attr('data-destination');
			$departdate=$this.parents('.FlightInfoBox').attr('data-departdate');
			
			$flightId=$this.parents('.FlightInfoBox').attr('data-flightid');
			$idval=$this.parents('.FlightInfoBox').attr('data-idval');
			
			$dtime = formatMinutes($departure);
			$atime = formatMinutes($arrival);
			
			priceInfoReturn ='<span class="timing-logo-holder"><span style="float:left;"><img width="32" height="25" alt="'+$airlinename+'" src="http://www.cleartrip.com/images/logos/air-logos/'+$airline+'.png" /></span><span class="bottom-naming">'+$airline+'-'+$flightno+'</span></span><span class="spanOne"><span class="labelOne">'+$destination+'-'+$origin+' | '+$departdate+'</span><span class="timingSelection">'+$dtime+' - '+$atime+'</span><input type="hidden" name="returnFlightId" value="'+$flightId+'" /><input type="hidden" name="returnIdVal" value="'+$idval+'" /></span>';
							    
		    $(".priceInfoReturn").html(priceInfoReturn);
		    $(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
			
			
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
    if ($(this).scrollTop() >= scroller_anchor && $('.timingAmountResult, .m-s-search').css('position') != 'fixed') 
    {    
        $('.timingAmountResult, .m-s-search').css({
            //'background': '#CCC',
            'position': 'fixed',
            'top': '0px'
        });
        //$('.scroller_anchor').css('height', '50px');
    } 
    else if ($(this).scrollTop() < scroller_anchor && $('.timingAmountResult, .m-s-search').css('position') != 'relative') 
    {    
        //$('.scroller_anchor').css('height', '0px');
        $('.timingAmountResult, .m-s-search').css({
            'position': 'relative'
        });
    }
});


	// Pricing Info Onward and Return
	$(".onwardRadio:first:visible").trigger("click");
	$(".returnRadio:first:visible").trigger("click");
	$(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
			
		
	 });
	 
	 function doTotal()
	 {
		var TotalPriceOnSelection=0;
		TotalPriceOnSelection+=parseFloat($(".onwardRadio:checked").parents('.FlightInfoBox').attr('data-price'));
		TotalPriceOnSelection+=parseFloat($(".returnRadio:checked").parents('.FlightInfoBox').attr('data-price'));
		return "<span class='WebRupee'>₹</span> "+TotalPriceOnSelection;
	 }
	 
	 function formatMinutes(minutes) 
	 {
		function pad(n) 
		{
			return n > 9
				? n
				: ("0" + n);
		}
		
    	var hours = Math.floor(minutes / 60),
        	mins = minutes % 60;
    	return pad(hours) + ":" + pad(mins);
		
	}	
	
	
// Filter Matrix

  function matrix(selector)
  {		
		$.ajax
		({
			url:'<?php echo WEB_URL; ?>flight/rateMatrix',
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
    
     <div class="firstDetails">
        	<span class="tagline"><span class="yellowTagline">Special Return Fares:</span> Discounted faces for round trips on the same airline | <span class="blueTagline"><a href="#">View All Fares</a></span></span>
            <span class="spanOneToFour">
                <span class="logoAlignment"><img src="<?php echo WEB_DIR?>public/images/rocket.jpg" alt="roc" /></span>
                <span class="rupeeFont"><span class="WebRupee">₹</span>4,851</span>
            </span>
            <span class="spanOneToFour">
            	<span class="logoAlignment"><img src="<?php echo WEB_DIR?>public/images/redIcon.jpg" alt="image" /></span>
                <span class="rupeeFont"><span class="WebRupee">₹</span>4,851</span>
            </span>
            <span class="spanOneToFour">
            	<span class="logoAlignment"><img src="<?php echo WEB_DIR?>public/images/plane-small.jpg" alt="palne" /></span>
                <span class="rupeeFont"><span class="WebRupee">₹</span>4,851</span>
            </span>
            <span class="spanOneToFour">
            	<span class="logoAlignment"><img src="<?php echo WEB_DIR?>public/images/jetConnect.jpg" alt="jet" /></span>
                <span class="rupeeFont"><span class="WebRupee">₹</span>4,851</span>
            </span>
            <span class="spanOneToFour">
            	<span class="logoAlignment"><img src="<?php echo WEB_DIR?>public/images/yellow-logo.jpg" alt="image" /></span>
                <span class="rupeeFont"><span class="WebRupee">₹</span>4,851</span>
            </span>
        </div>
        
     <div class="rightContainer">
    	<div class="timingAmountResult">
      <form action="<?php echo WEB_URL;?>flight/flight_details" method="post"  name="flight_details" >

        <div class="secondBox">
        	<div class="currentSelection">Current Selection </div>
            
            <div class="timingDetails priceInfoOnward">            	
            </div>            
           <div class="timingDetails priceInfoReturn">            
            </div>
            
            <div class="totalBookNowHolder priceInfoTotal">
            	<span class="totalDisplay">
                	<span class="total-label">You Pay</span>
                    <span class="totalAmount"><!--<span class="WebRupee">₹</span>--></span> 
                </span>
                <span class="bookTotalNow"> 
                <input type="image" src="<?php echo WEB_DIR; ?>public/images/book_now.png" />
                </span>
            </div>
            
        </div>
        </form>
    	
        <div class="thirdBox">
              <?php $session_data = $this->session->userdata('flight_search_data'); ?>          
            <div class="leftArrival">
            	<span class="leftBookingRates">
                	<span class="prevButton"><span style="padding:0 3px 0 0;">
                    <img src="<?php echo WEB_DIR; ?>public/images/leftArrow.png" alt="arrow" /></span>Prev day</span>
                    <span class="preRupee">
                    	<span class="WebRupee">₹</span>4,851
                    </span>
                </span>
                <span class="middleContainer">
                	<span class="middleLabels"><?php echo $result[0]->Origin;?>-<?php echo $result[0]->Destination;?></span>
                    <span class="middleBottomLabels">
			<?php 
			$sess_departDate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$session_data['departDate']);
			echo date('D, j M',strtotime($sess_departDate));
			?>
                    </span>
                </span>
                <div class="rightCalender">
            	<div class="prev-btn">
                	<span class="prevButton">Next day<span style="padding:0 0 0 3px;">
                    <img src="<?php echo WEB_DIR?>public/images/rightArrow.png" alt="right" /></span>
                    </span>
                    <span class="preRupee">
                    	<span class="WebRupee">₹</span>4,851
                    </span>
                </div>
                <div class="rupee-calender"></div>
            </div>
            <div class="bottomLinks" style="font-size:11px;">
            	<span>
                	<a href="javascript:void(0);" title="Sort By Airline" rel="data-airlinename" data-order="asc" class="FlightSorting" style="text-decoration: underline">Airline</a> 
                    <a href="javascript:void(0);" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSorting" style="text-decoration: underline">Depart</a> 
                    <span><img src="<?php echo WEB_DIR; ?>public/images/arrow.png" alt="image" /></span>
                     <a href="javascript:void(0);" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSorting" style="text-decoration: underline">Arrive</a> 
                    <a href="javascript:void(0);" title="Sort By Fare Type" rel="data-fare" data-order="asc" class="FlightSorting" style="text-decoration: underline">Fare Type</a>
                     <a href="javascript:void(0);" title="Sort By Total Fare" rel="data-price" data-order="asc" class="FlightSorting" style="text-decoration: underline">Per Adult Fare</a>
                </span>
            </div>
            </div>
            
            <div class="rightArrival">
            	<span class="leftBookingRates">
                	<span class="prevButton"><span style="padding:0 3px 0 0;"><img src="<?php echo WEB_DIR;?>public/images/leftArrow.png" alt="arrow" /></span>Prev day</span>
                   
                </span>
                <span style="float:left; margin:0 0 0 20px; text-align:center;">
                	<span style="width:100%; float:left; font-size:12px; font-weight:bold;"><?php echo $result1[0]->Destination;?>-<?php echo $result1[0]->Origin;?></span>
                    <span style="width:100%; float:left; font-size:11px; color:#6c685f;">
			<?php 
			$sess_returnDate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$session_data['returnDate']);
			echo date('D, j M',strtotime($sess_returnDate));
			?>
                </span>
                </span>
                <div class="rightCalender">
            	<div class="prev-btn">
                	<span class="prevButton">Next day<span style="padding:0 0 0 3px;"><img src="<?php echo WEB_DIR;?>public/images/rightArrow.png" alt="right" /></span></span><span class="preRupee">
                    	<span class="WebRupee">₹</span>4,851
                    </span>
                </div>
                <div class="rupee-calender"></div>
            </div>
            <div class="bottomLinks" style="font-size:11px;">
            	<span>
                	<a href="javascript:void(0);" title="Sort By Airline" rel="data-airlinename" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Airline</a> 
                    <a href="javascript:void(0);" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Depart</a> 
                    <span><img src="<?php echo WEB_DIR; ?>public/images/arrow.png" alt="image" /></span>
                     <a href="javascript:void(0);" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Arrive</a> 
                    <a href="javascript:void(0);" title="Sort By Fare Type" rel="data-fare" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Fare Type</a>
                     <a href="javascript:void(0);" title="Sort By Total Fare" rel="data-price" data-order="asc" class="FlightSortingReturn" style="text-decoration: underline">Per Adult Fare</a>
                </span>
            </div>
            </div>
            
        </div>
        
        </div>
        <div class="scroller_anchor"></div>
       
        <!--   Left Grids Starting  -->
        <div style="width:100%; border: 1px solid #CCCCCC; border-top:none;">
        <div style="float:left; width:49.9%;" class="resultOnward">
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
		  
		  $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[0]);
		  list($DDate, $DTime) = explode(" ", $Ddatetime);
		  
		  $Duration = explode(',',$result[$i]->Duration);		  
		  
		  $ArrivalCode = explode(',',$result[$i]->Arrival_LocationCode);
		  $Departure_CityName = explode(',',$result[$i]->Departure_CityName);
		  $Arrival_CityName = explode(',',$result[$i]->Arrival_CityName);
		  
		  $Total_Duration = $result[$i]->Total_Duration;
		  $FareType = $result[$i]->FareType;
		  
		  $Origin = $result[$i]->Origin;
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
             <div class="searchflight_box">
             <div class="splitLeftRight br1 searchflightallsearch FlightInfoBox" data-price="<?php echo $result[$i]->TotalFare; ?>" data-airlinename="<?php echo $MarketingAirline_Name[0]; ?>"  data-airline="<?php echo $MarketingAirline_Code[0]; ?>" data-duration="<?php echo $totalJourneyDuration; ?>" data-fare="<?php echo $FareType; ?>" data-departure="<?php echo $DepartureTimeInMin; ?>" data-arrival="<?php echo $ArrivalTimeInMin; ?>" data-stop="<?php echo $Stops; ?>" data-flightno="<?php echo $FlightNumber[0];?>" data-origin="<?php echo $Origin;?>" data-destination="<?php echo $Destination;?>" data-departdate="<?php echo date('D, j M',strtotime($DDate));?>" data-flightid="<?php echo $result[$i]->flight_t_id;?>" data-idval="<?php echo $result[$i]->id_val;?>" style="height: auto;">
           
            <?php for($j=0;$j< count($DepartureCode);$j++) {?>
               
                <table width="100%">
              <tr>
              <td width="15%">
                	<table width="100%" border="0">
                      <tr>
                        <td><img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j];?>.png" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j];?>" /></td>
                      </tr>
                      <tr>
                        <td style="font-size:9px;"><?php echo $MarketingAirline_Code[$j];?>-<?php echo $FlightNumber[$j];?></td>
                      </tr>
                    </table>
                </td>
                <td width="37%" class="pd5L">
                	<table width="100%" border="0">
                          <tr>
                            <td>
                            	<table width="100%" border="0" class="txt13B">
                                  <tr>
                                    <td>
									<?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[$j],'time');?>
                                    </td>
                                    <td>
                                    <img src="<?php echo WEB_DIR;?>public/images/arrow-black.png" width="20" height="5" alt="arrow" />
                                    </td>
                                    <td>
									<?php echo $this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime[$j],'time');?>
                                    </td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td class="txt10">Non Stop</td>
                          </tr>
                          <!--<tr>
                            <td class="txt10">
                            <span>
                            <img src="<?php //echo WEB_DIR;?>public/images/clock.png" width="13" height="14" alt="clock" />
                            </span>
                            <a href="#login_form">Stats</a></td>
                          </tr>-->
                    </table>

                </td>
                
                 <td width="22%" class="pd5L">
                	<span style="width:100%; text-align:center;" class="txt10">
                    <a href="#login_form"><?php echo $result[$i]->FareType;?></a>
                    </span>
                    <span class="txt10">Paid meal</span>
                </td>
                <?php if($j==0) { ?>
                <td width="33%" class="pd5L">
                	<span class="bookNowRupeeStyle" style="float:left;">
                    <span class="WebRupee">₹</span><?php echo $result[$i]->TotalFare;?></span>
          			 <input type="radio" name="onwardRadio" class="onwardRadio" value="radio" />   	    
	    			
                </td>
                <?php }else{ ?>
                  <td width="33%" class="pd5L">&nbsp;
                	
                </td>
                <?php } ?>
              </tr>
              
               <?php if($ArrivalCode[$j] != $Destination){ ?> 
               <tr>
                <td width="100%" colspan="4">
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
                </td>
                </tr>
              <?php } ?>
                             
            </table>
                 
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
    
    <!--   Left Grids Ending -->
    
    <!--   Right Grids Starting  -->
    <div style="float:right; width:49.9%;" class="resultReturn">
    <div class="splitRight">
    <?php if(!empty($result1)) {?>
      <?php
	    for($i=0;$i< count($result1);$i++)
		{ 
		  $DepartureCode = explode(',',$result1[$i]->Departure_LocationCode);
		  $MarketingAirline_Code = explode(',',$result1[$i]->MarketingAirline_Code);
		  $MarketingAirline_Name = explode(',',$result1[$i]->MarketingAirline_Name);
		  $FlightNumber = explode(',',$result1[$i]->FlightNumber);
		  
		  $DepartureDateTime = explode(',',$result1[$i]->DepartureDateTime);
		  $ArrivalDateTime = explode(',',$result1[$i]->ArrivalDateTime);
		  
		  $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[0]);
		  list($DDate, $DTime) = explode(" ", $Ddatetime);
		  
		  $Duration = explode(',',$result1[$i]->Duration);		  
		  
		  $ArrivalCode = explode(',',$result1[$i]->Arrival_LocationCode);
		  $Departure_CityName = explode(',',$result1[$i]->Departure_CityName);
		  $Arrival_CityName = explode(',',$result1[$i]->Arrival_CityName);
		  
		  $Total_Duration = $result1[$i]->Total_Duration;
		  $FareType = $result1[$i]->FareType;
		  
		  $Origin = $result1[$i]->Origin;
		  $Destination = $result1[$i]->Destination;	  
		  
		  $totalJourneyDuration = $this->Flight_Model->DurationTimeInMin($Total_Duration);
		
		  $DepartureTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(current(array_values($DepartureDateTime)),'mins');	 
		  $ArrivalTimeInMin = $this->Flight_Model->getDate_TimeFromDateTime(end(array_values($ArrivalDateTime)),'mins');
		  
		  $Stops = $result1[$i]->Stops;
		  if($Stops == 0)
		      $Stops = 0;
		  else
		      $Stops = $Stops - 1;
			  
		  $totalPriceAry[] = $result1[$i]->TotalFare;
		  
		?>
             <div class="searchflight_box">
             <div class="splitLeftRight br1 searchflightallsearch FlightInfoBox" data-price="<?php echo $result[$i]->TotalFare; ?>" data-airlinename="<?php echo $MarketingAirline_Name[0]; ?>"  data-airline="<?php echo $MarketingAirline_Code[0]; ?>" data-duration="<?php echo $totalJourneyDuration; ?>" data-fare="<?php echo $FareType; ?>" data-departure="<?php echo $DepartureTimeInMin; ?>" data-arrival="<?php echo $ArrivalTimeInMin; ?>" data-stop="<?php echo $Stops; ?>" data-flightno="<?php echo $FlightNumber[0];?>" data-origin="<?php echo $Origin;?>" data-destination="<?php echo $Destination;?>" data-departdate="<?php echo date('D, j M',strtotime($DDate));?>" data-flightid="<?php echo $result1[$i]->flight_t_id;?>" data-idval="<?php echo $result1[$i]->id_val;?>" style="height: auto;">
           
            <?php for($j=0;$j< count($DepartureCode);$j++) {?>
               
                <table width="100%">
              <tr>
              <td width="15%">
                	<table width="100%" border="0">
                      <tr>
                        <td><img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j];?>.png" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j];?>" /></td>
                      </tr>
                      <tr>
                        <td style="font-size:9px;"><?php echo $MarketingAirline_Code[$j];?>-<?php echo $FlightNumber[$j];?></td>
                      </tr>
                    </table>
                </td>
                <td width="37%" class="pd5L">
                	<table width="100%" border="0">
                          <tr>
                            <td>
                            	<table width="100%" border="0" class="txt13B">
                                  <tr>
                                    <td>
									<?php echo $this->Flight_Model->getDate_TimeFromDateTime($DepartureDateTime[$j],'time');?>
                                    </td>
                                    <td>
                                    <img src="<?php echo WEB_DIR;?>public/images/arrow-black.png" width="20" height="5" alt="arrow" />
                                    </td>
                                    <td>
									<?php echo $this->Flight_Model->getDate_TimeFromDateTime($ArrivalDateTime[$j],'time');?>
                                    </td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td class="txt10">Non Stop</td>
                          </tr>
                          <!--<tr>
                            <td class="txt10">
                            <span>
                            <img src="<?php //echo WEB_DIR;?>public/images/clock.png" width="13" height="14" alt="clock" />
                            </span>
                            <a href="#login_form">Stats</a></td>
                          </tr>-->
                    </table>

                </td>
                
                 <td width="22%" class="pd5L">
                	<span style="width:100%; text-align:center;" class="txt10">
                    <a href="#login_form"><?php echo $result1[$i]->FareType;?></a>
                    </span>
                    <span class="txt10">Paid meal</span>
                </td>
                <?php if($j==0) { ?>
                <td width="33%" class="pd5L">
                	<span class="bookNowRupeeStyle" style="float:left;">
                    <span class="WebRupee">₹</span><?php echo $result1[$i]->TotalFare;?></span>
          			
	    	    	<input type="radio" name="returnRadio" class="returnRadio" value="radio" />    	    
	    			
                </td>
                <?php }else{ ?>
                  <td width="33%" class="pd5L">&nbsp;
                	
                </td>
                <?php } ?>
              </tr>
              
               <?php if($ArrivalCode[$j] != $Origin){ ?> 
               <tr>
                <td width="100%" colspan="4">
                <div class="spanHolder changeplanesplit">
					<span class="srpSprite yticonFlt">
						<img width="18" height="16" alt="plane" src="<?php echo WEB_DIR?>public/images/planeStop.png">
					</span>
                    <?php
					$ArrDateTime = preg_replace("/[T]/", " ", $ArrivalDateTime[$j]);
					
					$DepDateTime = preg_replace("/[T]/", " ", $DepartureDateTime[$j+1]);
					
					?>
					<span class="verAlignMid">Change flight at <?php echo $Arrival_CityName[$j];?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime,$DepDateTime);?></span>
				</div>
                </td>
                </tr>
              <?php } ?>
                           
            </table>
                 
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
    
    <!--   Right Grids Ending -->
    
    
    
    
    
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
