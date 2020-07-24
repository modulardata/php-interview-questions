$(document).ready(function()
{
	forwardDate();
	backwardDate();
	$(".FlightSorting").click(function()
	{		
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    sortFlights($order,$sortBy,$(this));
	   	$(".onwardRadio:first:visible").trigger("click");
	    $(".returnRadio:first:visible").trigger("click");
	    $(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
	}); 
	
	$(".FlightSortingReturn").click(function()
	{
	    $order=$(this).attr("data-order");
	    $sortBy=$(this).attr("rel");
	    sortFlightsReturn($order,$sortBy,$(this));
	    $(".onwardRadio:first:visible").trigger("click");
	    $(".returnRadio:first:visible").trigger("click");
	    $(".priceInfoTotal span.totalDisplay span.totalAmount").html(doTotal);
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

function sortFlightsReturn($order,$sortBy,curSel)
{
    var flights = $('.resultReturn .searchflight_box').get();
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
                
                
    var container = $('.resultReturn');
    $.each(flights, function(i, ul)
    {
	container.append(ul);
    });
    
    if($order=="asc")
	curSel.attr("data-order",'desc');                    
    else
	curSel.attr("data-order",'asc');
}

function triggerFirstFlights()
{
    $(".departRdo:visible:first,.returnRdo:visible:first").attr("checked","checked");
     
    var obj = $(".departRdo:visible:first").parents('.FlightInfoBox').clone();
    $('.departRdo', obj).remove();
    $(".selectedDepartFlight").html(obj.html());
                    
    var obj = $(".returnRdo:visible:first").parents('.FlightInfoBox').clone();
    $('.returnRdo', obj).remove();
    $(".selectedReturnFlight").html(obj.html());
}

function selectDepartFlight()
{
    $(".departRdo").click(function()
    {
	var obj = $(this).parents('.FlightInfoBox').clone();
	$('.departRdo', obj).remove();
	$(".selectedDepartFlight").html(obj.html()); 
    });    
}

function selectReturnFlight()
{
    $(".returnRdo").click(function()
    {
	var obj = $(this).parents('.FlightInfoBox').clone();
	$('.returnRdo', obj).remove();
	$(".selectedReturnFlight").html(obj.html());
    });    
}

function forwardDate()
{
    
    $(".forwardDate").click(function()
    {
	var dateString =$("#datepicker2").val();
	var dateStringAry=dateString.split("-");
	dateString=dateStringAry[2]+"-"+dateStringAry[1]+"-"+dateStringAry[0];
	var myDate = new Date(dateString);
	myDate.setDate(myDate.getDate() + 1);
	var y = myDate.getFullYear(),
	m = myDate.getMonth() + 1, // january is month 0 in javascript
	d = myDate.getDate();
	var pad = function(val) 
	{
	    var str = val.toString();
	    return (str.length < 2) ? "0" + str : str
	};
	var dateString1 = [pad(d),pad(m),y].join("-");
	$("#datepicker2").val(dateString1);

	document.modifySearch.submit();
    });
}

function backwardDate()
{
    
    $(".backwardDate").click(function()
    {
	var dateString =$("#datepicker2").val();
	var dateStringAry=dateString.split("-");
	dateString=dateStringAry[2]+"-"+dateStringAry[1]+"-"+dateStringAry[0];
	var myDate = new Date(dateString);
	myDate.setDate(myDate.getDate() -1);
	var y = myDate.getFullYear(),
	m = myDate.getMonth() + 1, // january is month 0 in javascript
	d = myDate.getDate();
	var pad = function(val) 
	{
	    var str = val.toString();
	    return (str.length < 2) ? "0" + str : str
	};
	var dateString1 = [pad(d),pad(m),y].join("-");
	$("#datepicker2").val(dateString1);

	document.modifySearch.submit();
    });
}