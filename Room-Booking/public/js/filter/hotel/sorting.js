$(document).ready(function()
{
	$(".HotelSorting").click(function()
	{		
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    sortHotels($order,$sortBy,$(this));
	   
	});	
	
});

function sortHotels($order,$sortBy,curSel)
{
    var hotels = $('.resultHotel .searchhotel_box').get();
    hotels.sort(function(a,b)
    {
	if($sortBy=="data-hotel-name")
	{
	    //============= To Check Non Numerical VAlues=====================
	    var keyA = $(a).find('.HotelInfoBox').attr($sortBy);
	    var keyB = $(b).find('.HotelInfoBox').attr($sortBy);
	}
	else
	{
	    //============= To Check Numerical VAlues=========================
	    var keyA = parseInt($(a).find('.HotelInfoBox').attr($sortBy));
	    var keyB = parseInt($(b).find('.HotelInfoBox').attr($sortBy));
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
                
                
    var container = $('.resultHotel');
    $.each(hotels, function(i, ul)
    {
	container.append(ul);
    });
    
    if($order=="asc")
	curSel.attr("data-order",'desc');                    
    else
	curSel.attr("data-order",'asc');
}
