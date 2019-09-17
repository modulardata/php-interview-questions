function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto();
    });
	
    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto();
    });
	
    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};
$(function(){
    $('.scrollCntr').niceScroll();
    jQuery('#mycarousel').jcarousel({
        auto: 3,
        wrap: 'last',
        scroll: 1,
        initCallback: mycarousel_initCallback
    });

    jQuery('#mycarousel2').jcarousel({
        auto: 4,
        wrap: 'last',
        scroll: 1,
        initCallback: mycarousel_initCallback
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
			
    //date picker for flights
    var checkinF1 = $('#dpf1').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkinF1.hide();
    }).data('datepicker');
			
    var checkinF2 = $('#dpf2').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkinF2.hide();
    }).data('datepicker');

    //date picker for h0tels
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
			
			
    $('.searchBtn, .sbtn').click(function(e){
        $('.top-search-drop').slideToggle('fast');
    });
			
    $('.menuBtn').click(function(e){
        $('.top-menu-drop').slideToggle('fast');
    });
//    $('body').click(function(e){
//        if(!$(event.target).hasClass('acm'))
//            $('.top-menu-drop').slideUp('fast');
//        if(!$(event.target).hasClass('acs'))
//            $('.top-search-drop').slideUp('fast');				
//    });
			
    $("input[name='bus']").change(function(){
        $('#dpb2Cntr').slideToggle(0);
    });
    $("input[name='flights']").change(function(){
        $('#dpf2Cntr').slideToggle(0);
    });			
			
    $('.btn-viewseat, .seatclose').click(function(){
        
        var _this = $(this).parents('.bus-row');
        $(_this).find('.btn-viewseat').children('span').toggleClass('hideseat');
        $(_this).find('.btn-viewseat').children('i').toggleClass('fa-hand-o-up');
        $(_this).find('.seatselectionCntr').slideToggle('fast');	
    });
     $('.showseat').click(function(){ 
         $(_this).find('.seatselectionCntr').val();
        $(_this).find('.seatselectionCntr').hide();
	
    });
	 		
    $('a.available-seat, a.ladies-seat').click( function(){
        $(this).toggleClass('selected-seat');
    });
    $('a.available-sleeper, a.ladies-sleeper, a.ladies-sleeperV, a.available-sleeperV').click( function(){
        $(this).toggleClass('selected-sleeper');
    });
			
    $('#mod-search-close, #modify-search-btn').click(function(){
        $('.modify-search').slideToggle('slow');	
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