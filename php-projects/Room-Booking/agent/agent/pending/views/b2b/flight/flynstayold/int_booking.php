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

<script type="text/javascript">
	$(document).ready(function() {
	
<!--=====  Scrolling   =====--->
$(window).scroll(function(e) {
    var scroller_anchor = $(".scroller_anchor").offset().top;
    if ($(this).scrollTop() >= scroller_anchor && $('.scrollFixTop').css('position') != 'fixed') 
    {    
        $('.scrollFixTop').css({
            //'background': '#CCC',
            'position': 'fixed',
            'top': '0px'
        });
        //$('.scroller_anchor').css('height', '50px');
    } 
    else if ($(this).scrollTop() < scroller_anchor && $('.scrollFixTop').css('position') != 'relative') 
    {    
        //$('.scroller_anchor').css('height', '0px');
        $('.scrollFixTop').css({
            'position': 'relative'
        });
    }
});

$(function() {
    $types = $('.syncTypes');
    $contacts = $('#contacts');
    $groups = $('#groups');
    $types.change(function() {
        $this = $(this).val();
        if ($this == "types") {
            $groups.slideUp(200);
            $contacts.delay(200).slideDown(200);
        }
        else if ($this == "groups") {
            $contacts.slideUp(200);
            $groups.delay(200).slideDown(200);
        }
    });
});


    //$('.reference').hide();
    $('.plus-minus-accordion').click(function() {
        $(this).next('.booking-details').slideToggle(300);
        return false;
    });
	
	
<!------	Show Hide----->

    $(".hide-show-button").click(function () {
        var txt = $("#hide-show-changed").html();
        txt == 'Show Details' ? 'Hide Details' : 'Show Details';
        $(".hide-show").slideToggle("1000");
        $("#hide-show-changed").html(txt);
        return false;
    });
	$('.hide-show-button').on('click', function () {
    var method;
    $('span', this).text(function (_, text) {
        method = text.toLowerCase();
        return text === 'Show Details' ? 'Hide Details' : 'Show Details';
    }).parent().next()[method]();
});
 
});
</script>

<script type="text/javascript">
	
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/; 
	
	function email_validate(id)
	{  						
		var email=document.getElementById(id).value;
		if(email==''){
			$("#"+id).val("");
			$("#"+id).css("border-color", "red");
			document.getElementById(id).focus(); 
			$("#"+id).attr("placeholder", "Mandatory Field ");                         
			return false;
		}
		else if(!pattern.test(email)){
			$("#"+id).val("");
			$("#"+id).css("border-color", "red");
			document.getElementById(id).focus(); 
			$("#"+id).attr("placeholder", "Invalid E-Mail Address");
			return false;
		}
		 return true;
	}
	
	function mobile_validate(id)
	{	   
		var mobvalue=document.getElementById(id).value;
		var mobcount=mobvalue.length;
		if(mobvalue=='')
		{						
			$("#"+id).val("");
			$("#"+id).css("border-color", "red");
			$("#"+id).attr("placeholder", "Mandatory field ");
			return false;
		}
		else if(isNaN(mobvalue))
		{
			$("#"+id).val("");
			$("#"+id).css("border-color", "red");
			$("#"+id).attr("placeholder", "10 digits Number  ");
			return false;
		}
		else if(mobcount!=10)
		{	 					   
			$("#"+id).val("");
			$("#"+id).css("border-color", "red");
			$("#"+id).attr("placeholder", "10 digits Number ");
			return false;
		}  
		return true;
		
	}
	
	function user_login()
	{
		var email = document.getElementById("userName").value; 
		var pwd = document.getElementById("password").value;		
		
		$.post('<?php echo WEB_URL;?>home/user_login_validate',{'userName':email,'password':pwd},function(data){			
			
			var a=data.split(',');
			
			if(a[0]=='success')
			{
				  document.getElementById("travMail").value = a[1];
				  document.getElementById("travMobile").value = a[5];
			}
			else
			{
				$("#userName").val("");
				$("#userName").css("border-color", "red");
				$("#userName").attr("placeholder", "Invalid Email-ID");
				$("#password").val("");
				$("#password").css("border-color", "red");
				$("#password").attr("placeholder", "Invalid Password");
			}	
			
		});
		
	}

</script>
</head>
<body>
<div id="container">
  
    
  <?php echo $this->load->view('home/header');?>
   
  <!----======   Pagination to payment gate way   =====-------->
  <div class="bcHolder"> 
  <span class="floatRight">
    <ul class="breadcrumb">
      <li><a href="#">Search Result</a></li>
      <li><a href="#"  class="active">Payment</a></li>
      <li><a href="#">Confirmation</a></li>
      <li><a href="#"></a></li>
    </ul>
    </span> </div>
   <form action="<?php echo WEB_URL;?>flight/confirm_int_booking" name="passengerForm" method="post">
  
    <div class="paymentDetailsHolder">
    		<div class="flightDetails pb20">
            	<div class="headerTab">
                <span class="plus-minus-accordion"></span>
               	  
                  <span class="tab-heading">Flight Details</span>
              </div>
              <?php if($flight_result != '') {
				  
				  	$Departure_Code = explode(',',$flight_result->Departure_LocationCode);
					$Arrival_Code = explode(',',$flight_result->Arrival_LocationCode);
					
					$MarketingAirline_Code = explode(',',$flight_result->MarketingAirline_Code);
					$MarketingAirline_Name = explode(',',$flight_result->MarketingAirline_Name);
				  	$FlightNumber = explode(',',$flight_result->FlightNumber);
					
					$Departure_CityName = explode(',',$flight_result->Departure_CityName);
					$Arrival_CityName = explode(',',$flight_result->Arrival_CityName);
					
					$DepartureDateTime = explode(',',$flight_result->DepartureDateTime);
					$ArrivalDateTime = explode(',',$flight_result->ArrivalDateTime);
					
					
					if($flight_result->Departure_Terminal != '')
						$Departure_Terminal = explode(',',$flight_result->Departure_Terminal);				
					else
						$Departure_Terminal[]= '';
					
					if($flight_result->Arrival_Terminal != '')
						$Arrival_Terminal = explode(',',$flight_result->Arrival_Terminal);				
					else
						$Arrival_Terminal[]= '';
						
					$FareType = explode(',',$flight_result->FareType);
					
					$Origin = $flight_result->Origin;
					$Destination = $flight_result->Destination;
					
					$Adults = $flight_result->Adults;
					$Childs = $flight_result->Childs;
					$Infants = $flight_result->Infants;
					
				  for($i=0;$i < count($Departure_Code);$i++) {
					  
					  $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[$i]);
		  			  list($DDate, $DTime) = explode(" ", $Ddatetime);
					  
					  $Adatetime = preg_replace("/[T]/", " ", $ArrivalDateTime[$i]);
		  			  list($ADate, $ATime) = explode(" ", $Adatetime);	
					  
				  ?>
                <div class="booking-details">
                	<span>
                    	<span class="floatLeft">
                        <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$i];?>.png" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$i];?>" />
                        </span>
                        <span class="font10 floatLeft paddingLeft3"><?php echo $MarketingAirline_Name[$i];?>
                        <br /><?php echo $MarketingAirline_Code[$i];?>-<?php echo $FlightNumber[$i];?>
                        </span>
                    </span>
                    <span>
                    	<p class="font13"><strong><?php echo $Departure_CityName[$i];?></strong></p>
                        <p class="font10"><?php echo date('D, j M',strtotime($DDate));?> | <strong><?php echo date('H:i',strtotime($DTime));?></strong></p>
                        <p class="font10"><?php echo $Departure_CityName[$i];?>&nbsp;
						<?php if($Departure_Terminal != '') echo 'T-'.$Departure_Terminal[$i];?></p>
                    </span>
                    <span>
                    	<p class="font13"><strong><?php echo $Arrival_CityName[$i];?></strong></p>
                        <p class="font10"><?php echo date('D, j M',strtotime($ADate));?> | <strong><?php echo date('H:i',strtotime($ATime));?></strong></p>
                        <p class="font10"><?php echo $Arrival_CityName[$i];?>&nbsp;
						<?php if($Arrival_Terminal != '') echo 'T-'.$Arrival_Terminal[$i];?></p>
                    </span>
                    <span style="text-align:right;">
                    	<p class="font10"><?php echo $this->Flight_Model->journeyDuration($Adatetime,$Ddatetime);?>, Non Stop</p>
                        <p class="font10"><?php echo $FareType[$i];?></p>
                        <p class="font10">Baggage: 15 kgs per person</p>
                        <br />
                        <?php if($i == count($flight_result))?>
                        	<p class="font10"><a href="#">Change Flight(s)</a></p>
                    </span>
                    
                     <?php if($Arrival_Code[$i] != $Destination){ ?> 
               
                        <div class="spanHolder changeplanesplit">
                            <span class="srpSprite yticonFlt">
                                <img width="18" height="16" alt="plane" src="<?php echo WEB_DIR?>public/images/planeStop.png">
                            </span>
                            <?php
                            $ArrDateTime = preg_replace("/[T]/", " ", $ArrivalDateTime[$i]);
                            
                            $DepDateTime = preg_replace("/[T]/", " ", $DepartureDateTime[$i+1]);
                            
                            ?>
                            <span class="verAlignMid">Change flight at <?php echo $Arrival_CityName[$i];?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime,$DepDateTime);?></span>
                        </div>
               
              		<?php } ?>
                    
                </div>
                <?php } ?>
            <?php } ?>
            
            
            <?php if($flight_result_return != '') {
				  
				  	$Departure_Code_r = explode(',',$flight_result_return->Departure_LocationCode);
					$Arrival_Code_r = explode(',',$flight_result_return->Arrival_LocationCode);
					
					$MarketingAirline_Code_r = explode(',',$flight_result_return->MarketingAirline_Code);
					$MarketingAirline_Name_r = explode(',',$flight_result_return->MarketingAirline_Name);
				  	$FlightNumber_r = explode(',',$flight_result_return->FlightNumber);
					
					$Departure_CityName_r = explode(',',$flight_result_return->Departure_CityName);
					$Arrival_CityName_r = explode(',',$flight_result_return->Arrival_CityName);
					
					$DepartureDateTime_r = explode(',',$flight_result_return->DepartureDateTime);
					$ArrivalDateTime_r = explode(',',$flight_result_return->ArrivalDateTime);
					
					
					if($flight_result_return->Departure_Terminal != '')
						$Departure_Terminal_r = explode(',',$flight_result_return->Departure_Terminal);				
					else
						$Departure_Terminal_r[]= '';
					
					if($flight_result->Arrival_Terminal != '')
						$Arrival_Terminal_r = explode(',',$flight_result_return->Arrival_Terminal);				
					else
						$Arrival_Terminal_r[]= '';
						
					$FareType_r = explode(',',$flight_result_return->FareType);
					
					$Origin_r = $flight_result_return->Origin;
					$Destination_r = $flight_result_return->Destination;
					
					$Adults_r = $flight_result_return->Adults;
					$Childs_r = $flight_result_return->Childs;
					$Infants_r = $flight_result_return->Infants;
					
				  for($i=0;$i < count($Departure_Code_r);$i++) {
					  
					  $Ddatetime_r = preg_replace("/[T]/", " ", $DepartureDateTime_r[$i]);
		  			  list($DDate_r, $DTime_r) = explode(" ", $Ddatetime_r);
					  
					  $Adatetime_r = preg_replace("/[T]/", " ", $ArrivalDateTime_r[$i]);
		  			  list($ADate_r, $ATime_r) = explode(" ", $Adatetime_r);	
					  
				  ?>
                <div class="booking-details">
                	<span>
                    	<span class="floatLeft">
                        <img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code_r[$i];?>.png" width="32" height="25" alt="<?php echo $MarketingAirline_Name_r[$i];?>" />
                        </span>
                        <span class="font10 floatLeft paddingLeft3"><?php echo $MarketingAirline_Name_r[$i];?>
                        <br /><?php echo $MarketingAirline_Code_r[$i];?>-<?php echo $FlightNumber_r[$i];?>
                        </span>
                    </span>
                    <span>
                    	<p class="font13"><strong><?php echo $Departure_CityName_r[$i];?></strong></p>
                        <p class="font10"><?php echo date('D, j M',strtotime($DDate_r));?> | <strong><?php echo date('H:i',strtotime($DTime_r));?></strong></p>
                        <p class="font10"><?php echo $Departure_CityName_r[$i];?>&nbsp;
						<?php if($Departure_Terminal_r != '') echo 'T-'.$Departure_Terminal_r[$i];?></p>
                    </span>
                    <span>
                    	<p class="font13"><strong><?php echo $Arrival_CityName_r[$i];?></strong></p>
                        <p class="font10"><?php echo date('D, j M',strtotime($ADate_r));?> | <strong><?php echo date('H:i',strtotime($ATime_r));?></strong></p>
                        <p class="font10"><?php echo $Arrival_CityName[$i];?>&nbsp;
						<?php if($Arrival_Terminal_r != '') echo 'T-'.$Arrival_Terminal_r[$i];?></p>
                    </span>
                    <span style="text-align:right;">
                    	<p class="font10"><?php echo $this->Flight_Model->journeyDuration($Adatetime_r,$Ddatetime_r);?>, Non Stop</p>
                        <p class="font10"><?php echo $FareType_r[$i];?></p>
                        <p class="font10">Baggage: 15 kgs per person</p>
                        <br />
                        <?php if($i == count($flight_result_return))?>
                        	<p class="font10"><a href="#">Change Flight(s)</a></p>
                    </span>
                    
                     <?php if($Arrival_Code_r[$i] != $Origin){ ?> 
               
                        <div class="spanHolder changeplanesplit">
                            <span class="srpSprite yticonFlt">
                                <img width="18" height="16" alt="plane" src="<?php echo WEB_DIR?>public/images/planeStop.png">
                            </span>
                            <?php
                            $ArrDateTime_r = preg_replace("/[T]/", " ", $ArrivalDateTime_r[$i]);
                            
                            $DepDateTime_r = preg_replace("/[T]/", " ", $DepartureDateTime_r[$i+1]);
                            
                            ?>
                            <span class="verAlignMid">Change flight at <?php echo $Arrival_CityName_r[$i];?>. Layover: <?php echo $this->Flight_Model->journeyDuration($ArrDateTime_r,$DepDateTime_r);?></span>
                        </div>
               
              		<?php } ?>
                    
                </div>
                <?php } ?>
            <?php } ?>   
            
               
            </div>
            <div class="flightDetails pb20">
            	<div class="headerTab">
                    <span class="tab-heading pl15">FlyNStay Account Details</span>
                </div>
                <div class="booking-details font13">
                	<div class="signInDetails">
                    	<span class="spanHolder guestUser">
                        <input type="radio" value="types" class="syncTypes" checked="checked" name="syncTypes"> Continue as a guest
                        </span>
						<span class="spanHolder flsAccount">
                        <input type="radio" value="groups" class="syncTypes" name="syncTypes"> Sign in to FlyNStay Account
                        </span>
                    </div>
                    <div class="signInUsers">
                    	<div id="contacts" style="padding:3px;top:15px;position:relative">
                        	<p>Enter Email Address</p>
                            <p>
                              <input type="text" tabindex="143" maxlength="75" placeholder="Your booking details will be sent here" title="Enter your email id" id="userEmailId" name="userEmailId" style=" border:1px solid #ABADB3;font-size:100%;padding:4px 5px; width:220px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" onblur="return email_validate(this.id);">
                            </p>
                            <br />
                            <p>Enter Mobile No</p>
                            <p>
                            <input type="text" tabindex="143" maxlength="10" placeholder="Enter Mobile Number" title="Enter Mobile Number" id="userMobilNo" name="userMobilNo" style=" border:1px solid #ABADB3;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" onblur="return mobile_validate(this.id);">
                            </p>
                        </div>
						<div id="groups" style="display:none;padding:3px;top:15px;position:relative">
                        	<p>Enter Email Address</p>
                            <p>
                            <input type="text" tabindex="143" maxlength="75" placeholder="Enter UserName" title="Enter UserName" id="userName" name="userName" style=" border:1px solid #ABADB3;font-size:100%;padding:4px 5px; width:220px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" onblur="return email_validate(this.id);" />
                            </p><br />
                        	<p>Enter Password <span class="font10 txtAlR pl44">
                            <a href="#">Forgot Password?</a>
                            </span></p>
                            <p>
                           <input type="password" mylabel="Enter Password" title="Enter Password" id="password" style="border:1px solid #ABADB3;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;">
                           
                            <span>
                            <input type="button"  value="Continue" style="border: 1px solid #1C5F93;border-radius: 5px;color: #FFFFFF;cursor: pointer;font-size: 14px;font-weight: bold;height: 30px;width: 80px;background: none repeat scroll 0 0 #0066FF;" onclick="return user_login();"/>
                            
                            </span></p>
                        </div>
                    </div>
                    <!--<div class="social-media">
                    	<span>
                        	<p>Sign-In with</p>
                            <span><a href="#"><img src="<?php echo WEB_DIR;?>public/images/fb.png" width="101" height="26" alt="fb" /></a></span>
                        </span>
                    </div>-->
                </div>
            </div>
            
     <!--  <div class="flightDetails pb20">
            	<div class="headerTab">
                	<a href="#" class="plusMinusAccordion"><span class="plus-minus-accordion"></span></a>
                    <span class="tab-heading">Optional Add-ons</span>
                </div>
                <div class="booking-details font10">
                	<div class="AddOnHead"><ul id="opad0">
                        <li class="contentblock">
                          <div class="flL"> <span class="flL">
                            <input type="checkbox" name="tncforCrosssell" attrcheck="tncType" value="Reliance Travel Insurance" checked="checked" class="chkOptAddon0" id="RelianceTravelInsurance_chkd" addontype="insurance">
                            </span> <span class="AddonCheckContent">I want Reliance Insurance. (Passengers travelling are between the ages of 6 months and 70 yrs).</span> </div>
                        </li>
                        <li class="contentblock">
                          <div class="flL"> <span class="flL">
                            <input type="checkbox" name="tncforCrosssell" attrcheck="tncType" value="Reliance Travel Insurance" class="chkT_C" id="RelianceTravelInsurance_chkd_TNC" >
                            </span> <span class="AddonCheckContent">I accept the <a id="yttkd_insTnc" href="#">Terms &amp; Conditions.</a></span> </div>
                        </li>
                        <li class="contentblock">
                          <div class="flL">
                            	<div class="AddonContent hide-show" id="divBody_0" style="display: none;">
																			<div id="reliance_main_note"><b>Notes: </b>We have pre-selected Reliance General Insurance Company Limited for your trip. Please <a id="yttkd_insPol1" href="#">read the policy</a> to see the entire list of benefits.</div>
<div id="reliance_ineligible_note"  style="display:none;"><b>Notes: </b>We have disabled Reliance General Insurance Company Limited for your trip. As Insurance is not applicable for trip starting after 180 days.</div>
<table cellspacing="0" cellpadding="0" border="0">
	<tbody><tr>
		<td class="AddOnBase" id="AddOnBase0">
			<ul class="listbox">
				<li class="ico-ins-tripcancel">&nbsp;</li>
				<li class="txt">Trip Cancellation</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-baggageloss"></li>
				<li class="txt">Baggage Loss</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-flightdelay"></li>
				<li class="txt">Flight Delay</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-medical"></li>
				<li class="txt">Accidental Death</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-reliance"></li>
				<li id="yttkd_insPol2" class="txt"><a href="#">Read the policy</a></li>
			</ul>
			
		</td>
	</tr>
</tbody></table>
</div>
                          </div>
                        </li>
                        <li class="flR" style="margin-top:-28px"> </li>
                        <li class="flR" style="margin-top:-28px"> </li>
                        <li class="flR" style="float: right; margin-top:-28px"><div class="hide-show-button"><span class="hide-show-changed"><a href="#">Show Details</a></span></div></li>
                      </ul></div>
                      
                      <div class="AddOnHead"><ul id="opad0">
                        <li class="contentblock">
                          <div class="flL"> <span class="flL">
                            <input type="checkbox" name="tncforCrosssell" attrcheck="tncType" value="Reliance Travel Insurance" checked="checked" class="chkOptAddon0" id="RelianceTravelInsurance_chkd" addontype="insurance">
                            </span> <span class="AddonCheckContent">I want to be contacted by a Standard Chartered representative to apply for the Standard Chartered Yatra Platinum Credit Card.</span> </div>
                        </li>
                       
                        <li class="contentblock">
                          <div class="flL">
                            	<div class="AddonContent" id="divBody_0" style="display: none;">
																			<div id="reliance_main_note"><b>Notes: </b>We have pre-selected Reliance General Insurance Company Limited for your trip. Please <a id="yttkd_insPol1" href="#">read the policy</a> to see the entire list of benefits.</div>
<div id="reliance_ineligible_note" style="display:none;"><b>Notes: </b>We have disabled Reliance General Insurance Company Limited for your trip. As Insurance is not applicable for trip starting after 180 days.</div>
<table cellspacing="0" cellpadding="0" border="0">
	<tbody><tr>
		<td class="AddOnBase" id="AddOnBase0">
			<ul class="listbox">
				<li class="ico-ins-tripcancel">&nbsp;</li>
				<li class="txt">Trip Cancellation</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-baggageloss"></li>
				<li class="txt">Baggage Loss</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-flightdelay"></li>
				<li class="txt">Flight Delay</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-medical"></li>
				<li class="txt">Accidental Death</li>
			</ul>
			<ul class="listbox">
				<li class="ico-ins-reliance"></li>
				<li id="yttkd_insPol2" class="txt"><a href="#">Read the policy</a></li>
			</ul>
			
		</td>
	</tr>
</tbody></table>
</div>
                          </div>
                        </li>
                        <li class="flR" style="margin-top:-28px"> </li>
                        <li class="flR" style="margin-top:-28px"> </li>
						
                      </ul></div>
                </div>
            </div>
            
            <div class="flightDetails pb20">
            	<div class="headerTab">
                    <span class="tab-heading pl15">Champion a Cause</span>
                </div>
                <div class="booking-details" style="min-height: 75px;">
                	<div class="TabContentBoxFull">
					<div class="OptionalAddOn" id="Being-Human">

						<table cellspacing="0" cellpadding="0" border="0">
							<tbody><tr>
								<td class="AddOnImage" valign="top">
										<img src="<?php echo WEB_DIR;?>public/images/being-human_0.gif" alt="" title="">
								</td>
								<td class="AddOnDesc">
									<table cellspacing="0" cellpadding="0" border="0">
										<tbody><tr>
											<td class="AddOnHead marginPadding">
												
												<ul id="opad0">
															<li class="wfull marginPadding" >
																				<span class="flL mt5"><input type="checkbox" name="tncforCrosssell" value="Being Human" checked="checked" class="chkOptAddon0" id="BeingHuman_chkd" addontype="being human"></span>
																			<span class="flL pl10">I want to make contribution towards Salman Khan's Being Human Foundation with an amount of <span class="RupeeSign">Rs.</span>
																			<select class="w50" id="bHDrp">
																				<option>5</option>
																				<option>10</option>
																				<option>15</option>
																				<option>50</option>
																			</select></span> </li></ul>
												
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						  </tbody></table>

			 </div>
						</div>
                </div>
            </div>
            -->
            
            <div class="flightDetails pb20">
            	<div class="headerTab">
                    <span class="tab-heading pl15">Passenger Details</span>
                </div>
                <div class="booking-details">
                    <div class="PassengerDetails" id="adultId">
                    
                    <input type="hidden" name="onwardFlightId" value="<?php echo $flight_result->flight_t_id;?>" />
                   <?php if($flight_result_return != '') { ?>
                    <input type="hidden" name="returnFlightId" value="<?php echo $flight_result_return->flight_t_id;?>" />
                    <?php } ?>
                    <input type="hidden" name="email_id" id="travMail" />
  					<input type="hidden" name="mobile_no" id="travMobile" />
                    
                 <?php for($k=0;$k < $Adults;$k++) {?>
                    <div class="Adult bdrBottom" id="adult">
					<ul>
						<li class="mt3"><strong>&nbsp;Adult - <?php echo $k+1;?> </strong></li>
						
						<li>
							<select name="atitle[]" id="atitle" style="border:1px solid #ABADB3; width:75px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								<option value="">Select</option>
									<option value="Mr">Mr.</option>
									<option value="Mrs">Mrs.</option>
									<option value="Ms">Ms.</option>
                                    </select>
						</li>
								<li>
									<input type="text" name="afname[]"  title="Enter Passenger First Name" id="afname" placeholder="First Name" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>
								<li>
									<input type="text" name="amname[]" title="Enter Passenger Middle Name" id="amname" placeholder="Middle Name" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>
								<li>
									<input type="text" name="alname[]" placeholder="Last Name" title="Enter Passenger Last Name" id="alname" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>	
					</ul>
						<!--<ul id="mealUl1" style="display: none;">
							<li class="mt3" style="width: 38px;"><div>&nbsp;</div></li>
							<li class="mt5"><b>Meal Preference</b></li>
							<li id="mealOnwardTxt1" style="display: none;" class="mt5">Onward Flight</li>
							<li id="mealOnwardDD1" style="display: none;" class="mt3"><select id="passengerOnwardMeal1" style="width: 145px;">
							</select></li>
							<li id="mealReturnTxt1" style="display: none;" class="mt5">Return Flight</li>
							<li id="mealReturnDD1" style="display: none;" class="mt3"><select id="passengerReturnMeal1" style="width: 145px;">
							</select></li>
						</ul>-->
				</div>
              <?php } ?>
              
             <?php if($Childs != '' && $Childs != 0) {?>
              <?php for($k=0;$k < $Childs;$k++) {?>
                    <div class="Adult bdrBottom" id="adult">
					<ul>
						<li class="mt3"><strong>&nbsp;Child - <?php echo $k+1;?> </strong></li>
						
						<li>
							<select name="ctitle[]" id="ctitle" style="border:1px solid #ABADB3; width:75px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								<option value="">Select</option>
								<option value="Master">Master</option>
								<option value="Miss">Miss</option>
                            </select>
						</li>
								<li>
									<input type="text" name="cfname[]"  title="Enter Passenger First Name" id="cfname" placeholder="First Name" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>
								<li>
									<input type="text" name="cmname[]" title="Enter Passenger Middle Name" id="cmname" placeholder="Middle Name" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>
								<li>
									<input type="text" name="clname[]" placeholder="Last Name" title="Enter Passenger Last Name" id="clname" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>	
					</ul>
						
				</div>
              <?php } ?>
              
          <?php } ?> 
          
          <?php if($Infants != '' && $Infants != 0) {?>
              <?php for($k=0;$k < $Infants;$k++) {?>
                    <div class="Adult bdrBottom" id="adult">
					<ul>
						<li class="mt3"><strong>&nbsp;Infant - <?php echo $k+1;?> </strong></li>
						
						<li>
							<select name="ititle[]" id="ititle" style="border:1px solid #ABADB3; width:75px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								<option value="">Select</option>
									<option value="Master">Master</option>
									<option value="Miss">Miss</option>									
                           </select>
						</li>
								<li>
									<input type="text" name="ifname[]"  title="Enter Passenger First Name" id="ifname" placeholder="First Name" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>
								<li>
									<input type="text" name="imname[]" title="Enter Passenger Middle Name" id="imname" placeholder="Middle Name" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>
								<li>
									<input type="text" name="ilname[]" placeholder="Last Name" title="Enter Passenger Last Name" id="ilname" maxlength="30" size="30" style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" required>
								</li>
                                <li>
                                <input class="datePickerIcon" id="datepicker" name="idob" placeholder="Enter DOB" readonly required style="border:1px solid #ABADB3; width:120px;font-size:100%;padding:4px 5px; box-shadow:1px 2px 3px #D5D3D3; color:#6D6D6D;" />
                                </li>	
					</ul>
						
				</div>
              <?php } ?>
              
          <?php } ?>     
	
    <ul>
		<li class="noteinfo">
		<div class="flL" style="margin-top:-14px; width:560px;">
			<span>Note - Please ensure that the names of all passengers match with their travel documents. </span>
			<!--<span id="mealNote" style="display: none;">- Meals are available only for SpiceJet Flights. </span>-->
		</div>
		</li>
	</ul>
		<ul class="buttonarea" id="buttonareaPTP">
			<li class="proceedPayment">
            <input type="submit" value="Proceed To Payment" id="proceedPymt" class="bttn200">
           </li>
		</ul>
</div>     
                </div>
            </div>
    </div>
    <div class="fare-details-holder">
    	<div class="scrollFixTop">
            	<div class="faredetailsBG">
                	<p>Fare Details</p>
                </div>
                <?php 
					$PassengerBaseFare = explode(',',$flight_result->PassengerBaseFare);
					$PassengerTax_Amount = explode(',',$flight_result->PassengerTax_Amount);
					$PassengerServiceTax = explode(',',$flight_result->PassengerServiceTax);
					$Tax_Amount = explode(',',$flight_result->Tax_Amount);
					
					if($flight_result_return != '')
					{
						$PassengerBaseFare_r = explode(',',$flight_result_return->PassengerBaseFare);
						$PassengerTax_Amount_r = explode(',',$flight_result_return->PassengerTax_Amount);
						$PassengerServiceTax_r = explode(',',$flight_result_return->PassengerServiceTax);
						$Tax_Amount_r = explode(',',$flight_result_return->Tax_Amount);
					}
					
				?>
                <div class="fdContent">
                	<div class="payDetails">
                    	<span class="payDetailsSpan">
                        	<p>Adult x <?php echo $Adults;?> 
                            	<span class="floatRight"><span class="WebRupee">Rs.</span>
								<?php 
								   if($flight_result_return != '')
										echo $PassengerBaseFare[0]*$Adults + $PassengerBaseFare_r[0]*$Adults;
									else
										echo $PassengerBaseFare[0] * $Adults;
								?>
                                </span>
                            </p>
                        </span>
                      <?php if($Childs != '' && $Childs != 0) {?>  
                        <span class="payDetailsSpan">
                        	<p>Child x <?php echo $Childs;?> 
                            	<span class="floatRight"><span class="WebRupee">Rs.</span>
								<?php 
                                if($flight_result_return != '')
										echo $PassengerBaseFare[1]*$Childs + $PassengerBaseFare_r[1]*$Childs;
									else
										echo $PassengerBaseFare[1] * $Childs;
								?>
                                </span>
                            </p>
                        </span>
                      <?php } ?>
                       <?php if($Infants != '' && $Infants != 0) {?>  
                        <span class="payDetailsSpan">
                        	<p>Infant x <?php echo $Infants;?> 
                            	<span class="floatRight"><span class="WebRupee">Rs.</span>								
                                <?php 
                                if($flight_result_return != '')
										echo $PassengerBaseFare[2]*$Infants + $PassengerBaseFare_r[1]*$Infants;
									else
										echo $PassengerBaseFare[2] * $Infants;
								?>
                                </span>
                            </p>
                        </span>
                      <?php } ?>
                        <span class="payDetailsSpan">
                        	<p>Fee & Surcharges <span class="floatRight">
                            	<span  class="WebRupee">Rs.</span>
								<?php 
								if($flight_result_return != '')
									echo array_sum($Tax_Amount) + array_sum($Tax_Amount_r);
								else
									echo array_sum($Tax_Amount);
								?>
                                </span>
                            </p>
                        </span>
                    </div>
              <div class="paddingTopBtm">
                    	<p>
                        <strong>You pay</strong>
                        <span class="floatRight totalRight">
                        <span  class="WebRupee">Rs.</span>						
                        <?php 
							if($flight_result_return != '')
								echo $flight_result->TotalFare + $flight_result_return->TotalFare;
							else
								echo $flight_result->TotalFare;
							?>
                        </span>
                        </p>
                    </div>
                    <!--<div class="payDetails" style="padding:10px 0">
                    	<span class="coinIcon"><span style="padding:0 8px;"><img src="<?php echo WEB_DIR;?>public/images/coins.jpg" width="24" height="19" alt="coin" /></span>Earn 55 Flyandstay miles</span>
                    </div>-->
                </div>
             </div>   
            </div>
    
    </form>
            <div class="scroller_anchor"></div>
   <?php echo $this->load->view('home/footer');?>
</div>
</body>
</html>
