<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="" description="" />
<title>::FlyNStay::</title>
<link href="<?php echo WEB_DIR;?>public/csss/styles.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/csss/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
<script src="http://cdn.webrupee.com/js" type="text/javascript"></script>
<script src="<?php echo WEB_DIR;?>public/js/jquery-1.9.1.js"></script>
<script src="<?php echo WEB_DIR;?>public/js/jquery-ui.js"></script>
</head>
<body>
<?php //$this->load->view('home/header');?>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="top" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="230" align="center" height="90">
          <a href="<?php echo WEB_URL;?>home">
          	<img src="<?php echo WEB_DIR;?>public/images/logo.png" border="0" />
          </a>
          </td>
          <td class="inputtext"><div align="right"><b>Support Number:</b>&nbsp;+91-1234567890<br/>
              +91-1234567890<br>
              <b>Email:</b>&nbsp;info@flynstay.in</div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td width="979"><table width="98%" align="center" border="0" cellpadding="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <tr>
          <td><div align="center" class="farebreakup" style="font-size: 17px;"><b>E-ticket</b></div></td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <tr>
          <td class="inputtext"><p style="margin-left:10px;">Dear <b><?php echo $passenger_info[0]->title.' '.$passenger_info[0]->first_name.' '.$passenger_info[0]->middle_name.' '.$passenger_info[0]->last_name; ?></b>,
            
            <div class="spacer"></div>
            Your booking for Flight is confirmed. Your FlyNStay Reference Number is <b><?php echo $booking_info->FlyNStayRefNo; ?></b> Please
            use this reference number for all future communications with your 
            booking agent. If you require any further assistance, please contact 
            your booking agent.
            </p></td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <tr>
          <td height="40"><div style="width:44%;float:left; margin-left:15px;" class="bl_13b">Onward Flight</div>
            <div style="width:44%;float:left;" class="bl_13b"> <span class="notice">PNR:&nbsp;</span><strong class="pnrr"><?php echo $booking_info->BookingReferenceId; ?></strong></div></td>
        </tr>
        <tr>
          <td colspan="10" valign="top"><table border="1" width="98%" style="border:1px solid #B2B2B2;margin-left: 10px; border-collapse:collapse;" cellpadding="2" cellspacing="0">
              <tr>
                <td colspan="5" class="notice">Passenger Details</td>
              </tr>
              <tr>
                <td width="32%" align="center" class="hoteltext"><b>Name</b></td>
                <td width="15%" align="center" class="hoteltext"><b>Type</b></td>
                <td width="33%" align="center" class="hoteltext"><b>Ticket Number</b></td>
                <td width="20%" align="center" class="hoteltext"><b>Book Date</b></td>
              </tr>
              <?php 
			
			  	$eticket_no = explode(',',$booking_info->Ticket_Number);
				
			  for($k=0;$k <count($passenger_info);$k++)  {?>
              <tr>
                <td align="center"class="normal"><?php echo $passenger_info[$k]->first_name.' '.$passenger_info[$k]->last_name; ?></td>
                <td align="center" class="normal"><?php echo $passenger_info[$k]->passenger_type; ?></td>
                <td align="center" class="normal"><?php echo $eticket_no[$k];?></td>
                <td align="center" class="normal"><?php echo $booking_info->booking_date;?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <tr>
          <td colspan="10" valign="top"><table style="border:1px solid #B2B2B2;margin-left:10px; border-collapse:collapse;" width="98%" cellpadding="3" cellspacing="0" border="1">
              <tr>
                <td align="center"><strong class="hoteltext">Airline</strong></td>
                <td align="center"><strong class="hoteltext">Flight No</strong></td>
                <td colspan="2" align="center"><strong class="hoteltext">Departure Date &amp; Time</strong></td>
                <td colspan="2" align="center"><strong class="hoteltext">Arrival Date &amp; Time</strong></td>
                <td align="center"><strong class="hoteltext">From</strong></td>
                <td align="center"><strong class="hoteltext">To</strong></td>
              </tr>
              <?php 			  
			  $Departure_LocationCode = explode(',',$booking_info->Departure_LocationCode);
			  $Arrival_LocationCode = explode(',',$booking_info->Arrival_LocationCode);
			  
			  $MarketingAirline_Code = explode(',',$booking_info->MarketingAirline_Code);
			  $MarketingAirline_Name = explode(',',$booking_info->MarketingAirline_Name);
			  $FlightNumber = explode(',',$booking_info->FlightNumber);
			  
			  $DepartureDateTime = explode(',',$booking_info->DepartureDateTime);			  
			  $ArrivalDateTime = explode(',',$booking_info->ArrivalDateTime);
			  
			  $Departure_CityName = explode(',',$booking_info->Departure_CityName);
			  $Arrival_CityName = explode(',',$booking_info->Arrival_CityName);
			  
			  ?>
              <?php for($j=0;$j < count($Departure_LocationCode);$j++) { 
			  
			  $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[$j]);
		  	  list($DDate, $DTime) = explode(" ", $Ddatetime);
			  
			  $Adatetime = preg_replace("/[T]/", " ", $ArrivalDateTime[$j]);
		  	  list($ADate, $ATime) = explode(" ", $Adatetime);
			  
			  ?>
              <tr>
                <td align="center"><img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j];?>.png" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j];?>" /></td>
                <td width="15%"  class="normal" align="center"><?php echo $MarketingAirline_Code[$j].' '.$FlightNumber[$j]; ?></td>
                <td width="15%" class="normal" align="center"><?php echo $DDate;?></td>
                <td width="10%" class="normal" align="center"><?php echo date('h:i A',strtotime($DTime)); ?></td>
                <td width="15%" class="normal" align="center"><?php echo $ADate;?></td>
                <td width="10%" class="normal" align="center"><?php echo date('h:i A',strtotime($ATime)); ?></td>
                <td width="15%" class="normal" align="center"><?php echo $Departure_CityName[$j].'&nbsp;('.$Departure_LocationCode[$j].')'; ?></td>
                <td width="15%" class="normal" align="center"><?php echo $Arrival_CityName[$j].'&nbsp;('.$Arrival_LocationCode[$j].')'; ?></td>
              </tr>
              <?php } ?>
              
            </table>
            </td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <?php 
if($booking_info_return != '') {?>
        <tr>
          <td height="40"><div style="width:44%;float:left; margin-left:15px;" class="bl_13b">Return Flight</div>
            <div style="width:44%;float:left;" class="bl_13b"> <span class="notice">PNR:&nbsp;</span><strong class="pnr"><?php echo $booking_info_return->BookingReferenceId; ?></strong></div></td>
        </tr>
        <tr>
          <td colspan="10" valign="top"><table style="border:1px solid #B2B2B2;margin-left:10px; border-collapse:collapse;" width="98%" cellpadding="3" cellspacing="0" border="1">
              <tr>
                <td colspan="5" class="departing">Passenger Details</td>
              </tr>
              <tr>
                <td  width="32%"><div align="center" class="hoteltext"><b>Name</b> </div></td>
                <td  width="30%"><div align="center" class="hoteltext"><b>Type</b> </div></td>
                <td  width="38%"><div align="center" class="hoteltext"><b>Ticket Number</b> </div></td>
                <td width="20%" align="center" class="hoteltext"><b>Book Date</b></td>
              </tr>
             <?php 
			
			  	$eticket_no = explode(',',$booking_info_return->Ticket_Number);
				
			  for($k=0;$k <count($passenger_info_return);$k++)  {?>
              <tr>
                <td align="center"class="normal"><?php echo $passenger_info_return[$k]->first_name.' '.$passenger_info_return[$k]->last_name; ?></td>
                <td align="center" class="normal"><?php echo $passenger_info_return[$k]->passenger_type; ?></td>
                <td align="center" class="normal"><?php echo $eticket_no[$k];?></td>
                <td align="center" class="normal"><?php echo $booking_info_return->booking_date;?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <tr>
          <td colspan="10" ><div class="spacer"></div></td>
        </tr>
        <tr>
          <td><table style="border:1px solid #B2B2B2;margin-left:10px; border-collapse:collapse;" width="98%" cellpadding="3" cellspacing="0" border="1">
              <tr>
                <td align="center"><strong class="hoteltext">Airline</strong></td>
                <td align="center" class="hoteltext"><strong>Flight No</strong></td>
                <td colspan="2" align="center" class="hoteltext"><strong>Departure Date &amp; Time</strong></td>
                <td colspan="2" align="center" class="hoteltext"><strong>Arrival Date &amp; Time</strong></td>
                <td align="center" class="hoteltext"><strong>From</strong></td>
                <td align="center" class="hoteltext"><strong>To</strong></td>
              </tr>
              <?php 			  
			  $Departure_LocationCode = explode(',',$booking_info_return->Departure_LocationCode);
			  $Arrival_LocationCode = explode(',',$booking_info_return->Arrival_LocationCode);
			  
			  $MarketingAirline_Code = explode(',',$booking_info_return->MarketingAirline_Code);
			  $MarketingAirline_Name = explode(',',$booking_info_return->MarketingAirline_Name);
			  $FlightNumber = explode(',',$booking_info_return->FlightNumber);
			  
			  $DepartureDateTime = explode(',',$booking_info_return->DepartureDateTime);			  
			  $ArrivalDateTime = explode(',',$booking_info_return->ArrivalDateTime);
			  
			  $Departure_CityName = explode(',',$booking_info_return->Departure_CityName);
			  $Arrival_CityName = explode(',',$booking_info_return->Arrival_CityName);
			  
			  ?>
              <?php for($j=0;$j < count($Departure_LocationCode);$j++) { 
			  
			  $Ddatetime = preg_replace("/[T]/", " ", $DepartureDateTime[$j]);
		  	  list($DDate, $DTime) = explode(" ", $Ddatetime);
			  
			  $Adatetime = preg_replace("/[T]/", " ", $ArrivalDateTime[$j]);
		  	  list($ADate, $ATime) = explode(" ", $Adatetime);
			  
			  ?>
              <tr>
                <td align="center"><img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $MarketingAirline_Code[$j];?>.png" width="32" height="25" alt="<?php echo $MarketingAirline_Name[$j];?>" /></td>
                <td width="15%"  class="normal" align="center"><?php echo $MarketingAirline_Code[$j].' '.$FlightNumber[$j]; ?></td>
                <td width="15%" class="normal" align="center"><?php echo $DDate;?></td>
                <td width="10%" class="normal" align="center"><?php echo date('H:i A',strtotime($DTime)); ?></td>
                <td width="15%" class="normal" align="center"><?php echo $ADate;?></td>
                <td width="10%" class="normal" align="center"><?php echo date('H:i A',strtotime($ATime)); ?></td>
                <td width="15%" class="normal" align="center"><?php echo $Departure_CityName[$j].'&nbsp;('.$Departure_LocationCode[$j].')'; ?></td>
                <td width="15%" class="normal" align="center"><?php echo $Arrival_CityName[$j].'&nbsp;('.$Arrival_LocationCode[$j].')'; ?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <?php } ?>
        <tr>
          <td valign="top"><table  style="margin-left: 10px;" width="98%" border="0" cellpadding="2" cellspacing="0">
              <tr bgcolor="#f5f9fc">
                <td width="37%" align="left" height="22"><div class="hoteltext" align="left"><strong>Transaction </strong></div></td>
                <td width="63%"><div class="hoteltext" align="left"><strong>Amount(Rs.)</strong></div></td>
              </tr>
              <tr>
                <td><div class="notice" align="left">Basic Air Fare </div></td>
                <td><div class="normal" align="left">
				<?php 
				if(isset($booking_info_return) && $booking_info_return != '')
					echo $booking_info->BaseFare + $booking_info_return->BaseFare; 
				else
					echo $booking_info->BaseFare; 
				
				?>
                </div></td>
              </tr>
              <tr>
                <td><div class="notice" align="left">Airline Taxes &amp; Surcharges </div></td>
                <td><div class="normal" align="left">			
                <?php 
					$Tax_Amount = explode(',',$booking_info->Tax_Amount);
					if(isset($booking_info_return) && $booking_info_return != '')
					{
						$Tax_Amount_r = explode(',',$booking_info_return->Tax_Amount);
						echo array_sum($Tax_Amount) + array_sum($Tax_Amount_r);
					}
					else
					{
						echo array_sum($Tax_Amount);
					}
				?>
                </div></td>
              </tr>
              <tr>
                <td><div class="notice" align="left">Service Tax </div></td>
                <td><div class="normal" align="left">			
                <?php 
				if(isset($booking_info_return) && $booking_info_return != '')
					echo $booking_info->ServiceTax + $booking_info_return->ServiceTax; 
				else
					echo $booking_info->ServiceTax; 				
				?>
                </div></td>
              </tr>
              <tr>
                <td align="left"><div class="notice" align="left">Total Amount</div></td>
                <td><div class="normal" align="left">
                <?php 
				if(isset($booking_info_return) && $booking_info_return != '')
					echo $booking_info->TotalFare + $booking_info_return->TotalFare; 
				else
					echo $booking_info->TotalFare;				
				?>
				
                </div></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <tr>
          <td valign="top"><table style="margin-left: 10px;" width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><span class="pnrdetailss">* &nbsp;Passenger is requested to check-in 2hrs prior to scheduled depature.<br>
                  * &nbsp;All Passengers including children and infants, must present valid 
                  identity proof ( Passport / Pan Card / election card or any photo 
                  identity proof ) at check-in. It is your responsibility to ensure you 
                  have the appropriate travel documents at all times.<br>
                  * &nbsp;Changes/Cancellations to booking must be made at least 12 hours prior 
                  to scheduled departure time or else should be cancelled directly from 
                  the respective airlines.<br>
                  * If any flight is cancelled or rescheduled by the airline authority, 
                  passenger is requested to get a stamped/endorsed copy of the&nbsp;ticket to 
                  process &nbsp;the refund.<br>
                  * Passenger travelling from Delhi on Indigo and Spice Jet will have to check-in at new Terminal 1D.<br>
                  * Passenger travelling on Air India Express from Delhi and Mumbai, will have to check-in at International Airport.<br>
                  * For any cancellation or modification 4 hours before departure please call: </span><br>
                  <br>
                  <span class="pnrdetailss"><font style="color:black; margin-left:20px;">JET AIRWAYS:</font>&nbsp;1800225522, <font style="color:black; margin-left:20px;">JET CONNECT:</font>&nbsp;1800225522, <font style="color:black; margin-left:20px;">JET LITE:</font>&nbsp;1800223020,<br>
                  <font style="color:black; margin-left:20px;">KINGFISHER:</font>&nbsp;18002093030 / 18001800101 / 18004257008, <font style="color:black; margin-left:20px;">INDIAN 
                  AIRLINES:</font>&nbsp;18001801407<br>
                  <font style="color:black; margin-left:20px;">SPICE JET:</font>&nbsp;18001803333, <font style="color:left; margin-right:20px;">GO AIR:</font>&nbsp;1800222111, <font style="color:black; margin-left:20px;">INDIGO AIRLINES:</font>&nbsp;18001803838,<br>
                  <!--<font style="color:black; margin-left:20px;">PARAMOUNT AIRWAYS:</font>&nbsp;18001801234, <font style="color:black; margin-left:20px;">MDLR AIRWAYS:</font>&nbsp;18001031800--></span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
        <tr>
          <td colspan="10" align="center"><a href="javascript:void();" onclick="window.print();return false;" class="farebreakup"> Print Ticket</a> | <a href="<?php echo WEB_URL;?>home" class="farebreakup">Back To Home</a></td>
        </tr>
        <tr>
          <td><div class="spacer"></div></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php //$this->load->view('home/footer');?>
</body>
</html>
