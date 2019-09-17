$(document).ready(function(){
	/* This code is executed after the DOM has been completely loaded */
	var totWidth=0;
	var positions = new Array();
	
	$('#slides .pageBannerInnerCont').each(function(i){
		
		/* Traverse through all the slides and store their accumulative widths in totWidth */
		
		positions[i]= totWidth;
		totWidth += $(this).width();
		
		/* The positions array contains each slide's commulutative offset from the left part of the container */
		
		if(!$(this).width())
		{
			alert("Please, fill in width & height for all your images!");
			return false;
		}
		
	});
	
	$('#slides').width(totWidth);
	var slide = 1;

	/* Change the cotnainer div's width to the exact width of all the slides combined */

	$('.bannerNav ul li').click(function(e,keepScroll){

			/* On a thumbnail click */
			if(slide == 2){ 
	
				$('li.menuItem').removeClass('active ');
				$(this).addClass('active ');
				
				var pos = $(this).prevAll('.menuItem').length;
				
				$('#slides').stop().animate({marginLeft:-positions[pos]+'px'},1000);
				/* Start the sliding animation */
				
				e.preventDefault();
				/* Prevent the default action of the link */
				
				
				// Stopping the auto-advance if an icon has been clicked:
				if(!keepScroll) clearInterval(itvl);
				slide = 1;
			}
	});
	
	$('.bannerNav ul li.menuItem:first').addClass('active ');
	/* On page load, mark the first thumbnail as active */
	
	
	
	/*****
	 *
	 *	Enabling auto-advance.
	 *
	 ****/
	 
	var current=1;
	function autoAdvance()
	{   slide = 2;
		if(current==-1) return false;
		
		$('.bannerNav ul li').eq(current%$('.bannerNav ul li').length).trigger('click',[true]);	// [true] will be passed as the keepScroll parameter of the click function on line 28
		
	
			
		current++;
	}

	// The number of seconds that the slider will auto-advance in:
	
	var changeEvery = 8;

	var itvl = setInterval(function(){autoAdvance()},changeEvery*1000);

	/* End of customizations */
});