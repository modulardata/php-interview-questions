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

// International Datepicker
$(function() 
{    

    $( "#datepickerh" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 0
    //maxDate: '$("#date_depart").val()+12m'
		  
    });
    $( "#datepickerh1" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 1
    //maxDate: '$("#date_depart").val()+12m'		  
    });
		
		
    $('#datepickerh').change(function()
    {
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerh1" ).val();
			
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
            $( "#datepickerh1" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 1
            });
            $( "#datepickerh1" ).val($t);
        }
    });
		  
    $('#datepickerh1').change(function()
    {
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerh" ).val();
			
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
            $( "#datepickerh" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 0
            });
            $( "#datepickerh" ).val($t);
        }
        else
        {		 
        // $('#datepickerInt1').datepicker('option', 'minDate', $t);
        }
    });  
		
});	


// flight domestic ----------------------------------------
$(function() 
{    

    $( "#datepickerfdom" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 0
    //maxDate: '$("#date_depart").val()+12m'
		  
    });
    $( "#datepickerfdom1" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 1
    //maxDate: '$("#date_depart").val()+12m'		  
    });
		
		
    $('#datepickerfdom').change(function()
    {
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerfdom1" ).val();
			
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
            $( "#datepickerfdom1" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 1
            });
            $( "#datepickerfdom1" ).val($t);
        }
    });
		  
    $('#datepickerfdom1').change(function()
    {
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerfdom" ).val();
			
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
            $( "#datepickerfdom" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 0
            });
            $( "#datepickerfdom" ).val($t);
        }
        else
        {		 
        // $('#datepickerInt1').datepicker('option', 'minDate', $t);
        }
    });  
		
});
// flight domestic-------------------------------------------

// Hotel domestic ----------------------------------------
$(function() 
{    

    $( "#datepickerhdom" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 0
    //maxDate: '$("#date_depart").val()+12m'
		  
    });
    $( "#datepickerhdom1" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 1
    //maxDate: '$("#date_depart").val()+12m'		  
    });
		
		
    $('#datepickerhdom').change(function()
    {
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerhdom1" ).val();
			
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
            $( "#datepickerhdom1" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 1
            });
            $( "#datepickerhdom1" ).val($t);
        }
    });
		  
    $('#datepickerhdom1').change(function()
    {
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerhdom" ).val();
			
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
            $( "#datepickerhdom" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 0
            });
            $( "#datepickerhdom" ).val($t);
        }
        else
        {		 
        // $('#datepickerInt1').datepicker('option', 'minDate', $t);
        }
    });  
		
});
// Hotel domestic-------------------------------------------

// flight domestic ----------------------------------------
$(function() 
{    

    $( "#datepickerfint" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 0
    //maxDate: '$("#date_depart").val()+12m'
		  
    });
    $( "#datepickerfint1" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 1
    //maxDate: '$("#date_depart").val()+12m'		  
    });
		
		
    $('#datepickerfint').change(function()
    {
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerfint1" ).val();
			
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
            $( "#datepickerfint1" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 1
            });
            $( "#datepickerfint1" ).val($t);
        }
    });
		  
    $('#datepickerfint1').change(function()
    {
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerfint" ).val();
			
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
            $( "#datepickerfint" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 0
            });
            $( "#datepickerfint" ).val($t);
        }
        else
        {		 
        // $('#datepickerInt1').datepicker('option', 'minDate', $t);
        }
    });  
		
});
// flight domestic-------------------------------------------


// DATEPICKER FOR BUS
// International Datepicker
$(function() 
{    

    $( "#datepickerb" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 0
    //maxDate: '$("#date_depart").val()+12m'
		  
    });
    $( "#datepickerb1" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',			
        minDate: 1
    //maxDate: '$("#date_depart").val()+12m'		  
    });
		
		
    $('#datepickerb').change(function()
    {
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerb1" ).val();
			
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
            $( "#datepickerb1" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 1
            });
            $( "#datepickerb1" ).val($t);
        }
    });
		  
    $('#datepickerb1').change(function()
    {
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepickerb" ).val();
			
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
            $( "#datepickerb" ).datepicker({
                numberOfMonths: 2,
                dateFormat : 'dd/mm/yy',
                minDate: 0
            });
            $( "#datepickerb" ).val($t);
        }
        else
        {		 
        // $('#datepickerInt1').datepicker('option', 'minDate', $t);
        }
    });  
		
});	


// DATEPICKER FOR DEPOSIT DATE
$(function() 
{    
    $( "#deposit_date" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'mm/dd/yy',			
        minDate: '$("#today_date").val()-10d',
        maxDate: '$("#today_date").val()+10d'
		  
    });
	
	
});
