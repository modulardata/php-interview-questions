/*
#################################### jQuery UI Slider #######################################
### 											  ###
###  Programmed By: Saahil, prasannavvet@gmail.com                                        	  ###
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
   // alert(setPriceMin);alert(setPriceMax);alert(currency);
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
    $stars=new Array;
	
    $(".StarRating:checked").each(function()
    {
        $starNum=$(this).val();
        $stars.push($starNum); 
    });
   
    var hotelCount=0;
    $(".HotelInfoBox").each(function()
    {
        $dataprice=parseInt($(this).attr("data-price"));
        $datastar=$(this).attr("data-star");
		
        var starShow=$.inArray($datastar, $stars)>=0?true:false;
		
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && starShow)
        {
            hotelCount++;
            $(this).parents(".searchhotel_box").show();
        }
        else
        {
            $(this).parents(".searchhotel_box").hide();
        }		
				
    });     
  
    $("#hotelCount").text(hotelCount);
}
