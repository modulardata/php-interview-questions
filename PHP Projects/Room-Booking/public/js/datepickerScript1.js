function zeroPad(num,count)
{
    var numZeropad = num + '';
    while(numZeropad.length < count) 
    {
        numZeropad = "0" + numZeropad;
    }
    return numZeropad;
}
function dateADD(currentDate)
{
    var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
    var newDate =new Date(valueofcurrentDate);
    return newDate;
}
function dateADD1(currentDate)
{
    var valueofcurrentDate=currentDate.valueOf()-(24*60*60*1000);
    var newDate =new Date(valueofcurrentDate);
    return newDate;
}

$(function() 
{    
    $( "#datepicker" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 0,
        maxDate: '$("#date_depart").val()+12m'
		  
    });
    $( "#datepicker1" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 1,
        maxDate: '$("#date_depart").val()+12m'		  
    });
		
		
    $('#datepicker').change(function()
    {
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepicker1" ).val();
			
        var predayDate  = dateADD(selectedDate);
        var str2 = zeroPad(predayDate.getDate(),2)+"/"+zeroPad((predayDate.getMonth()+1),2)+"/"+(predayDate.getFullYear());
	
		
        var dt1  = parseInt(str1.substring(0,2),10);
        var mon1 = parseInt(str1.substring(3,5),10);
        var yr1  = parseInt(str1.substring(6,10),10);
        var dt2  = parseInt(str2.substring(0,2),10);
        var mon2 = parseInt(str2.substring(3,5),10);
        var yr2  = parseInt(str2.substring(6,10),10);
        var date1 = new Date(yr1, mon1, dt1);
        var date2 = new Date(yr2, mon2, dt2);
        if(date2 < date1)
        {
			 
        }
        else
        {
            var nextdayDate  = dateADD(selectedDate);
            var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
	
            $t = nextDateStr;
            $( "#datepicker1" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 1
            });
            $( "#datepicker1" ).val($t);
        }
    });
		  
    $('#datepicker1').change(function()
    {
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepicker" ).val();
			
        var predayDate  = dateADD1(selectedDate);
        var str2 = zeroPad(predayDate.getDate(),2)+"/"+zeroPad((predayDate.getMonth()+1),2)+"/"+(predayDate.getFullYear());
	
		
        var dt1  = parseInt(str1.substring(0,2),10);
        var mon1 = parseInt(str1.substring(3,5),10);
        var yr1  = parseInt(str1.substring(6,10),10);
        var dt2  = parseInt(str2.substring(0,2),10);
        var mon2 = parseInt(str2.substring(3,5),10);
        var yr2  = parseInt(str2.substring(6,10),10);
        var date1 = new Date(yr1, mon1, dt1);
        var date2 = new Date(yr2, mon2, dt2);
        if(date2 < date1)
        {
            var nextdayDate  = dateADD1(selectedDate);
            var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
	
            $t = nextDateStr;
            $( "#datepicker" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 0
            });
            $( "#datepicker" ).val($t);
        }
        else
        {		 
        // $('#datepicker1').datepicker('option', 'minDate', $t);
        }
    });  
		
});	  

$(function() 
{    
    $( "#deposit_date" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'mm/dd/yy',			
        minDate: '$("#today_date").val()-10d',
        maxDate: '$("#today_date").val()+10d'
		  
    });
	
	
});
