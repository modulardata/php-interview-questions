/*
#################################### jQuery UI Slider #######################################
### 											  ###
###  Programmed By: Prasanna, prasannavvet@gmail.com                                        	  ###
###  Powered By   :Travelpd.com, Bangalore, India.                         				  ###
### 											  ###
### ====================================================================================  ###
###  Copy this code to your application and call "setPriceSlider() function in  ready     ###
###  state.                                                                               ###
### 											  ###	
###	::  Necessary hidden calls from integration page ::                                   ###
###	Ex: <input type="hidden" id="setMinPrice" value="10" />                               ###
###         <input type="hidden" id="setMaxPrice" value="700" />                          ###
###         <input type="hidden" id="setCurrency" value="INR" />                          ###
### 											  ###
#############################################################################################
 */

function setPriceSlider()
{	
    var setPriceMin=parseInt($("#setMinPrice").val());
    var setPriceMax=parseInt($("#setMaxPrice").val());
    var currency=$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $minPrice=$("#minPrice");
    $maxPrice=$("#maxPrice");
    $selector.slider
    ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output.html(currency+' '+ ui.values[ 0 ] + " to "+currency+' '+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    $output.html(currency+' '+$selector.slider( "values", 0 ) + " To "+currency+' '+ $selector.slider( "values",1) );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}

function setTimeSlider()
{
    var setTimeMin=parseInt($("#setMinTime").val());
    var setTimeMax=parseInt($("#setMaxTime").val());
    callTimeSlider(setTimeMin,setTimeMax);
    priceSorting();
}

function callTimeSlider(setTimeMin,setTimeMax)
{
    $selector1=$( "#timeSlider" );
    $output1=$( "#timeSliderOutput");
    $minTime=$("#minTime");
    $maxTime=$("#maxTime");
    
    $selector1.slider
    ({
        range: true,
        min: setTimeMin,
        max: setTimeMax,
        values: [setTimeMin, setTimeMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+5>=ui.values[1])
            {
                return false;
            }
            else
            {
				var hours1 = Math.floor(ui.values[0] / 60);
				var minutes1 = ui.values[0] - (hours1 * 60);				
				
				if (hours1.toString().length == 1) hours1 = '0' + hours1;
				if (minutes1.toString().length == 1) minutes1 = '0' + minutes1;
				if (minutes1 == 0) minutes1 = '00';
				if (hours1 >= 12) {
					if (hours1 == 12) {
						hours1 = hours1;
						minutes1 = minutes1 + " PM";
					} else if (hours1 == 24) {
						hours1 = 11;
						minutes1 = "59 PM";
					} else {
						hours1 = hours1 - 12;
						minutes1 = minutes1 + " PM";
					}
				} else {
					hours1 = hours1;
					minutes1 = minutes1 + " AM";
				}
				if (hours1 == 0) {
					hours1 = 12;
					minutes1 = minutes1;
				}
				if (hours1.toString().length == 1) hours1 = '0' + hours1;
		
				var hours2 = Math.floor(ui.values[1] / 60);
				var minutes2 = ui.values[1] - (hours2 * 60);
				
				if (hours2.toString().length == 1) hours2 = '0' + hours2;
				if (minutes2.toString().length == 1) minutes2 = '0' + minutes2;
				if (minutes2 == 0) minutes2 = '00';
				if (hours2 >= 12) {
					if (hours2 == 12) {
						hours2 = hours2;
						minutes2 = minutes2 + " PM";
					} else if (hours2 == 24) {
						hours2 = 11;
						minutes2 = "59 PM";
					} else {
						hours2 = hours2 - 12;
						minutes2 = minutes2 + " PM";
					}
				} else {
					hours2 = hours2;
					minutes2 = minutes2 + " AM";
				}
				
				if (hours2.toString().length == 1) hours2 = '0' + hours2;
						
				$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
				$("#minTime").val(ui.values[0]);
				$("#maxTime").val(ui.values[1]);		
			}
			
        }
		
    });    
   
	var hours1 = Math.floor($selector1.slider( "values", 0 )/60);
	var minutes1 = $selector1.slider( "values", 0 ) - (hours1 * 60);

	if (hours1.toString().length == 1) hours1 = '0' + hours1;
	if (minutes1.toString().length == 1) minutes1 = '0' + minutes1;
	if (minutes1 == 0) minutes1 = '00';
	if (hours1 >= 12) {
		if (hours1 == 12) {
			hours1 = hours1;
			minutes1 = minutes1 + " PM";
		} else if (hours1 == 24) {
			hours1 = 11;
			minutes1 = "59 PM";
		} else {
			hours1 = hours1 - 12;
			minutes1 = minutes1 + " PM";
		}
	} else {
		hours1 = hours1;
		minutes1 = minutes1 + " AM";
	}
	if (hours1 == 0) {
		hours1 = 12;
		minutes1 = minutes1;
	}

	var hours2 = Math.floor($selector1.slider( "values", 1 )/60);
	var minutes2 = $selector1.slider( "values", 1 ) - (hours2 * 60);

	if (hours2.toString().length == 1) hours2 = '0' + hours2;
	if (minutes2.toString().length == 1) minutes2 = '0' + minutes2;
	if (minutes2 == 0) minutes2 = '00';
	if (hours2 >= 12) {
		if (hours2 == 12) {
			hours2 = hours2;
			minutes2 = minutes2 + " PM";
		} else if (hours2 == 24) {
			hours2 = 11;
			minutes2 = "59 PM";
		} else {
			hours2 = hours2 - 12;
			minutes2 = minutes2 + " PM";
		}
	} else {
		hours2 = hours2;
		minutes2 = minutes2 + " AM";
	}
	
	$output1.html(hours1+':'+minutes1+' To '+hours2+':'+minutes2);
    $minTime.val($selector1.slider( "values",0));
    $maxTime.val($selector1.slider( "values",1));
	
	
}

function priceSorting()
{
    $(".ui-slider").bind( "slidestop", function() 
    {		
        filter();
    });
}

function filter()
{    
    $minPr=parseInt($("#minPrice").val());
    $maxPr=parseInt($("#maxPrice").val());
    $minTime=parseInt($("#minTime").val());
    $maxTime=parseInt($("#maxTime").val());
		
    $stops=new Array;
    $AirLine=new Array;
    $FareRule=new Array;
    
    $(".Stop:checked").each(function()
    {
        $stopNum=$(this).val();
        $stops.push($stopNum); 
    });
    
    $(".AirLine:checked").each(function()
    {
        $airlineName=$(this).val();
        $AirLine.push($airlineName);
    });
    
    $(".FareRule:checked").each(function()
    {
        $FareRule.push($(this).val());
    });
    var flightCount=0;
    $(".FlightInfoBox").each(function()
    {
		
        $datastop=$(this).attr("data-stop");
        $dataduration=parseInt($(this).attr("data-duration"));
		$datadeparture=parseInt($(this).attr("data-departure"));
		
        $dataairline=$(this).attr("data-airline");
        $farerule=$(this).attr("data-fare");
     
        $dataprice=parseInt($(this).attr("data-price"));
       
        var stopShow=$.inArray($datastop, $stops)>=0?true:false;
        var airlineShow=$.inArray($dataairline, $AirLine)>=0?true:false;
        var fareRuleShow=$.inArray($farerule,$FareRule)>=0?true:false;
        
      // alert(($dataprice<=$maxPr && $dataprice>=$minPr) && ($dataduration<=$maxTime && $dataduration>=$minTime));
	  
	    //alert($dataduration);
       
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && ($datadeparture<=$maxTime && $datadeparture>=$minTime) && stopShow && fareRuleShow && airlineShow)
        {
			flightCount++;
            $(this).parents(".searchflight_box").show();
        }
        else
        {
            $(this).parents(".searchflight_box").hide();
        }
		
    });  
	
	$("#flightCount").text(flightCount);
    
    $(".onwardRadio:visible:first,.returnRadio:visible:first").attr("checked","checked");
    $(".onwardRadio::visible:first").trigger("click");
    $(".returnRadio::visible:first").trigger("click");
    
    //triggerFirstFlights();
	
}


function matrixFilter()
{
    $(".matrixFilter").live("click",function()
    {
        //========= Reset Other filters =================
        $(".AirLine,.FareRule,.Stop").attr("checked","checked");
        
        $data_shift=$(this).attr("data-shift");
        $data_price=parseInt($(this).attr('data-price'));
        $data_airline=$(this).attr('data-airline');        
       
        $(".FlightInfoBox").each(function()
        {
            $data_departure=parseInt($(this).attr("data-departure"));
            $dataairline=$(this).attr("data-airline");
            $dataprice=parseInt($(this).attr("data-price"));
                                   
            if($data_departure>=0 && $data_departure<360)
            {
                $data_shift_val='shift1';
            }
            else if($data_departure>=360 && $data_departure<720)
            {
                $data_shift_val='shift2';
            }
            else if($data_departure>=720 && $data_departure<1440)
            {
                $data_shift_val='shift3';
            }
            else
                $data_shift_val='shift4';
            
            if(($data_shift_val==$data_shift) &&($data_price==$dataprice) && ($dataairline==$data_airline))
            {
                $(this).show();
            }
            else
            {
                $(this).hide();
            }
        });
    });
}
