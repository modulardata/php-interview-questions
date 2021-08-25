$(document).ready(function()
{
	$(".FlightSorting").click(function()
	{		
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    sortFlights($order,$sortBy,$(this));
	   
	}); 
	
	
});

function sortFlights($order,$sortBy,curSel)
{
    var flights = $('.resultOnward .searchflight_box').get();
    flights.sort(function(a,b)
    {
	if($sortBy=="data-airlinename" || $sortBy=="data-fare")
	{
	    //============= To Check Non Numerical VAlues=====================
	    var keyA = $(a).find('.FlightInfoBox').attr($sortBy);
	    var keyB = $(b).find('.FlightInfoBox').attr($sortBy);
	}
	else
	{
	    //============= To Check Numerical VAlues=========================
	    var keyA = parseInt($(a).find('.FlightInfoBox').attr($sortBy));
	    var keyB = parseInt($(b).find('.FlightInfoBox').attr($sortBy));
	}
	if($order=="asc")
	{
	    if (keyA < keyB) return -1;
	    if (keyA > keyB) return 1;
	}
	else
	{
	    if (keyA > keyB) return -1;
	    if (keyA < keyB) return 1;
	}
	return 0;
    });
                
                
    var container = $('.resultOnward');
    $.each(flights, function(i, ul)
    {
	container.append(ul);
    });
    
    if($order=="asc")
	curSel.attr("data-order",'desc');                    
    else
	curSel.attr("data-order",'asc');
}
