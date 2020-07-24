<!-- filtering js  -->

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/filter/hotel/sorting.js"></script>

<script type="text/javascript">

    $(document).ready(function() 
    {
        $(".StarRating").click(function()
        { //alert('sdsd');
            filter();
        });
		
		
        //==================Callbacks===============================	
        setPriceSlider();	
		
        var hotelCount=0;						
        $(".HotelInfoBox").each(function()
        {
            hotelCount++;			
			
        });	
		
        $("#hotelCount").text(hotelCount);
        $("#hotelCount1").text(hotelCount);
		
		
        $("#hotelName").keyup(function()
        { //alert('as');
            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(), count = 0;
       
            var regex = new RegExp(filter, "i"); // Create a regex variable outside the loop statement

            // Loop through the comment list
            $(".HotelInfoBox").each(function(){			
			
                // If the list item does not contain the text phrase fade it out
                if ($(this).attr("data-hotel-name").search(regex) < 0) { // use the variable here
                    $(this).parents(".searchhotel_box").hide();

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).parents(".searchhotel_box").show();
                    count++;
                }
            });
			
            // Update the count
            $("#hotelCount").text(count);
			
        });	
			
    });

</script>
<!--  filtering js  -->