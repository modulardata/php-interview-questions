
    	$(function(){	
			//range slider
			$( "#price-range" ).slider({
			  range: true,
			  min: 0,
			  max: 500,
			  values: [ 75, 450 ],
			  slide: function( event, ui ) {
				$( "#price-start" ).val( "$" + ui.values[ 0 ]);
				$( "#price-end" ).val("$" + ui.values[ 1 ] );
			  }
			});
			
			
			$('#time-range').slider({
				range: true,
				min: 0,
				max: 1440,
				step: 15,
				values: [ 0, 1440 ],
				slide: function( event, ui ) {
					var hours1 = Math.floor(ui.values[0] / 60);
					var minutes1 = ui.values[0] - (hours1 * 60);
		
					if(hours1.length < 10) hours1= '0' + hours;
					if(minutes1.length < 10) minutes1 = '0' + minutes;
		
					if(minutes1 == 0) minutes1 = '00';
		
					var hours2 = Math.floor(ui.values[1] / 60);
					var minutes2 = ui.values[1] - (hours2 * 60);
		
					if(hours2.length < 10) hours2= '0' + hours;
					if(minutes2.length < 10) minutes2 = '0' + minutes;
		
					if(minutes2 == 0) minutes2 = '00';
		
					$('#time-start').val(hours1+':'+minutes1);
					$('#time-end').val(hours2+':'+minutes2 );
				}
			});
	
	
			$( "#dur-range" ).slider({
			  range: true,
			  min: 12,
			  max: 41,
			  values: [ 12, 41 ],
			  slide: function( event, ui ) {
				$( "#dur-start" ).val(ui.values[ 0 ] + ' hours');
				$( "#dur-end" ).val(ui.values[ 1 ] + ' hours');
			  }
			});
			
			$( "#rating-range" ).slider({
			  range: true,
			  min: 0,
			  max: 5,
			  values: [ 0, 5 ],
			  slide: function( event, ui ) {
				$( "#rating-start" ).val('Rating ' + ui.values[ 0 ]);
				$( "#rating-end" ).val('Rating ' + ui.values[ 1 ]);
			  }
			});
			
			$('#return-range').slider({
				range: true,
				min: 0,
				max: 1440,
				step: 15,
				values: [ 0, 1440 ],
				slide: function( event, ui ) {
					var hours1 = Math.floor(ui.values[0] / 60);
					var minutes1 = ui.values[0] - (hours1 * 60);
		
					if(hours1.length < 10) hours1= '0' + hours;
					if(minutes1.length < 10) minutes1 = '0' + minutes;
		
					if(minutes1 == 0) minutes1 = '00';
		
					var hours2 = Math.floor(ui.values[1] / 60);
					var minutes2 = ui.values[1] - (hours2 * 60);
		
					if(hours2.length < 10) hours2= '0' + hours;
					if(minutes2.length < 10) minutes2 = '0' + minutes;
		
					if(minutes2 == 0) minutes2 = '00';
		
					$('#return-start').val(hours1+':'+minutes1);
					$('#return-end').val(hours2+':'+minutes2 );
				}
			});
			
			
			$( "#layover-range" ).slider({
			  range: true,
			  min: 0,
			  max: 22,
			  values: [ 0, 22 ],
			  slide: function( event, ui ) {
				$( "#layover-start" ).val(ui.values[ 0 ] + ' hours');
				$( "#layover-end" ).val(ui.values[ 1 ] + ' hours' );
			  }
			});
			$( "#price-start" ).val( "$" + $( "#price-range" ).slider( "values", 0 ));			 
			$( "#price-end" ).val("$" + $( "#price-range" ).slider( "values", 1 ));
			$( "#time-start" ).val('Any time');			 
			$( "#time-end" ).val('');
			$( "#dur-start" ).val($( "#dur-range" ).slider( "values", 0 ) + ' hours');			 
			$( "#dur-end" ).val($( "#dur-range" ).slider( "values", 1 ) + ' hours');
			
			$( "#rating-start" ).val('Any Rating');			 
			//$( "#rating-end" ).val(' Rating' + $( "#rating-range" ).slider( "values", 1 ));
			$( "#return-start" ).val('Any time');		 
			$( "#return-end" ).val('');
			$( "#layover-start" ).val($( "#layover-range" ).slider( "values", 0 ) + ' hours');			 
			$( "#layover-end" ).val($( "#layover-range" ).slider( "values", 1 ) + ' hours'); 
		
			//search accordion
			$('.flight-search > li > h4').click(function(){
				$(this).children('i').toggleClass('fa-caret-right')
				$(this).next('div').slideToggle('slow');	
			});
			
			
			//tabs
			$(".searchtabs > ul > li > a").click(function(e) {
				var activeTab = "#" + e.target.id;
				var activeTabContent = "#tab_content_" + activeTab.substring(1, activeTab.length);
	
				$(".tab_content").css("display", "none");
				$(activeTabContent).css("display", "block");
				$(".searchtabs > ul > li a").removeClass("active");
				$(activeTab).addClass("active");
				return false;

			});
			
			
			//datepicker code
			var nowTemp = new Date();
			var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
			
			//date picker for Holidays
			var checkinHD = $('#dphd').datepicker({
			  onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  checkinHD.hide();
			}).data('datepicker');
			
			//date picker for bus
			var checkinB1 = $('#dpb1').datepicker({
			  onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  checkinB1.hide();
			}).data('datepicker');
			
			var checkinB2 = $('#dpb2').datepicker({
			  onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  checkinB2.hide();
			}).data('datepicker');
			
			var checkinDP = $('.dp').datepicker({
			  onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  checkinDP.hide();
			  $('.datepicker').hide();
			}).data('datepicker');
			
			//date picker for flights
			var checkinF = $('#dpf1').datepicker({
			  onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  if (ev.date.valueOf() > checkoutF.date.valueOf()) {
				var newDate = new Date(ev.date)
				newDate.setDate(newDate.getDate() + 1);
				checkoutF.setValue(newDate);
			  }
			  checkinF.hide();
			  $('#dpf2')[0].focus();
			}).data('datepicker');
			var checkoutF = $('#dpf2').datepicker({
			  onRender: function(date) {
				return date.valueOf() <= checkinF.date.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  checkoutF.hide();
			}).data('datepicker');
			
			

			//date picker for hotels
			var checkinH = $('#dph1').datepicker({
			  onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  if (ev.date.valueOf() > checkoutH.date.valueOf()) {
				var newDate = new Date(ev.date)
				newDate.setDate(newDate.getDate() + 1);
				checkoutH.setValue(newDate);
			  }
			  checkinH.hide();
			  $('#dph2')[0].focus();
			}).data('datepicker');
			var checkoutH = $('#dph2').datepicker({
			  onRender: function(date) {
				return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
			  }
			}).on('changeDate', function(ev) {
			  checkoutH.hide();
			}).data('datepicker');
			
			
			
			$("input[name='bus']").change(function(){
				$('#dpb2Cntr').slideToggle(0);
			});
			$("input[name='flights']").change(function(){
				if($(this).val() == 'oneway'){
					$('#O-R-Trip').fadeIn('fast');
					$('#dpf2Cntr, #multicity').hide();
				}
				if($(this).val() == 'roundtrip'){
					$('#O-R-Trip, #dpf2Cntr').fadeIn('fast');
					$('#multicity').hide();
				}
				else if($(this).val() == 'multicity'){
					$('#O-R-Trip').hide();
					$('#multicity').fadeIn('fast');
				}
			});			
			
						
			// flight details open
			
			$('.details-row, .oneway, .roundtrip').click(function(event){
				if(!$(event.target).hasClass('femail')){		
				$(this).parents('.results-row').find('.flight-details-Cntr').slideToggle('fast');
				$(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');
				}
			});
			
			//hotel individual details
			$('.htl-ind-rm-dtls').click( function(){
				$(this).parents('.htl-rm-detail').find('#htl-ind-details').slideToggle(600);
				$(this).find('i').toggleClass('fa-caret-up');
			});
			
						
			$('#mod-search-close, #modify-search-btn').click(function(){
				$('.modify-search').slideToggle('fast');	
			});
			
			$("select#rooms").change(function(){
				if($(this).val() == '1'){
					$('#room2, #room3, #room4').fadeOut('fast');
				}
				if($(this).val() == '2'){
					$('#room2').fadeIn('fast');
					$('#room3, #room4').fadeOut('fast');
				}
				if($(this).val() == '3'){
					$('#room2, #room3').fadeIn('fast');
					$('#room4').fadeOut('fast');
				}
				if($(this).val() == '4'){
					$('#room2, #room3, #room4').fadeIn('fast');
				}
			});
			$('.selectchildAge').change(function(){
				if($(this).val() == '1'){
					$(this).parent('.htl-selectChild').parent('.row').find('.htl-age').hide();
					$(this).parent('.htl-selectChild').parent('.row').find('.htl-childAge1').show();
				}
				if($(this).val() == '2'){
					$(this).parent('.htl-selectChild').parent('.row').find('.htl-age').hide();
					$(this).parent('.htl-selectChild').parent('.row').find('.htl-childAge1, .htl-childAge2').show();
				}
				if($(this).val() == '3'){
					$(this).parent('.htl-selectChild').parent('.row').find('.htl-age').show();
				}
				if($(this).val() == '0'){
					$(this).parent('.htl-selectChild').parent('.row').find('.htl-age').hide();
				}
			});
			
		});