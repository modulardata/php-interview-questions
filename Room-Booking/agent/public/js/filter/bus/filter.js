/*
#################################### jQuery UI Slider #######################################
### 											  ###
###  Programmed By: PRASANNA, PRASANNAVVET@GMAIL.COM                                        	  ###
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
                $output.html(+ ui.values[ 0 ] + " to "+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    $output.html(+$selector.slider( "values", 0 ) + " To "+ $selector.slider( "values",1) );
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
    $AirLine1=new Array;
    $FareRule=new Array;
    
    $(".Stop:checked").each(function()
    {
        $stopNum=$(this).val();
        $stops.push($stopNum); 
    });
    
    $(".AirLine:checked").each(function()
    { //alert('asd');
        $airlineName=$(this).val();
        $AirLine.push($airlineName);
    });
      $(".AirLine1:checked").each(function()
    { 
        $airlineName1=$(this).val();
        $AirLine1.push($airlineName1);
    });
    
    $(".FareRule:checked").each(function()
    {
        $FareRule.push($(this).val());
    });
    var flightCount=0;
    $(".BusInfoBox").each(function()
    {
		
//        $datastop=$(this).attr("data-stop");
//        $dataduration=parseInt($(this).attr("data-duration"));
//		$datadeparture=parseInt($(this).attr("data-departure"));
		
        $dataairline=$(this).attr("data-airline");
         $dataairline1=$(this).attr("data-airline1");
  //      $farerule=$(this).attr("data-fare");
     
        $dataprice=parseInt($(this).attr("data-price"));
       
//        var stopShow=$.inArray($datastop, $stops)>=0?true:false;
        var airlineShow=$.inArray($dataairline, $AirLine)>=0?true:false;
         var airlineShow1=$.inArray($dataairline1, $AirLine1)>=0?true:false;
 //       var fareRuleShow=$.inArray($farerule,$FareRule)>=0?true:false;
        
      // alert(($dataprice<=$maxPr && $dataprice>=$minPr) && ($dataduration<=$maxTime && $dataduration>=$minTime));
	  
	    //alert($dataduration);
       
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && airlineShow && airlineShow1)
        {
			flightCount++;
            $(this).parents(".searchbus_box").show();
        }
        else
        {
            $(this).parents(".searchbus_box").hide();
        }
		
    });  
	
	$("#flightCount").text(flightCount);
    
    $(".onwardRadio:visible:first,.returnRadio:visible:first").attr("checked","checked");
    $(".onwardRadio::visible:first").trigger("click");
    $(".returnRadio::visible:first").trigger("click");
    
    //triggerFirstFlights();
	
}

