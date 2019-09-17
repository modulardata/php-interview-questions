
<!-- FOOTER -->
<footer>
    <style>
        .col-md-3 ul li a{
            color: white;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h5>Our Company</h5>
                <ul>
                    <li><a href="<?php echo WEB_URL ?>">Home</a></li>
                    <li><a href="<?php echo WEB_URL; ?>home/about">About us</a></li>
                    <li><a href="<?php echo WEB_URL; ?>home/contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Top Destinations</h5>
                <ul>

                    <li><a href="<?php echo WEB_URL; ?>home/search/AMRITSAR (India)">Amritsar</a></li>
                    <li><a href="<?php echo WEB_URL; ?>home/search/AGRA (India)">Agra</a></li>
                    <li><a href="<?php echo WEB_URL; ?>home/search/GOA (India)">Goa</a></li>


                </ul>
            </div>
            <div class="col-md-2">
                <h5>Top Destinations</h5>
                <ul>

                    <li><a href="<?php echo WEB_URL; ?>home/int_search/Dubai, UAE">Dubai</a></li>
                    <li><a href="<?php echo WEB_URL; ?>home/int_search/Sydney, Australia">Sydney</a></li>
                    <li><a href="<?php echo WEB_URL; ?>home/int_search/New York City, USA">New York</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Information</h5>
                <ul>
                    <li><a href="<?php echo WEB_URL; ?>home/terms_conditions">Terms & Conditions</a></li>
                    <li><a href="<?php echo WEB_URL; ?>home/privacy">Privacy Policy</a></li>
<!--                    <li><a href="<?php echo WEB_URL; ?>home/faq">Help & FAQ's</a></li>-->
                    <li><a href="<?php echo WEB_URL; ?>home/contact_us">Contact Us</a></li>
                </ul>
            </div>
             <div class="col-md-2">
                <h5>Information</h5>
                <ul>
                    <li><a href="<?php echo WEB_URL; ?>home/disclaimer">Disclaimer</a></li>
             
                    <li><a href="<?php echo WEB_URL; ?>home/faq">Help & FAQ's</a></li>
                  
                </ul>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p>Copyright &copy; 2013 - Roombooking Online Private Limited, India. All rights reserved. 
            </div>
            <div class="col-md-2">
                <p class="pull-right"><a href="#">Back to top</a></p>
            </div>
            <div class="col-md-2">

                <strong>  Powered By: <a href="http://www.travelpd.com"><font style="color: #ffffff">TravelPd</font></a></strong>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="<?php echo WEB_DIR; ?>public/js/jquery-1.10.2.min.js"></script> 
<script src="<?php echo WEB_DIR; ?>public/js/bootstrap.min.js"></script> 
<script src="<?php echo WEB_DIR; ?>public/docs-assets/js/holder.js"></script> 
<script src="<?php echo WEB_DIR; ?>public/js/jquery.nicescroll.min.js"></script> 
<script src="<?php echo WEB_DIR; ?>public/js/jquery.jcarousel.min.js"></script>
<script src="<?php echo WEB_DIR; ?>public/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo WEB_DIR; ?>public/js/customize.js"></script>
<script>
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
            scroll: 2,
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
			
        //enable only if need to show default date as today
        /*var today = new Date(); var dd = today.getDate(); var mm = today.getMonth()+1;
                        var yyyy = today.getFullYear(); 
                        if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} var today = mm+'/'+dd+'/'+yyyy;
                        $('#dpd1').val(today);*/
			
        var checkin = $('#dpd1').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
            }
            checkin.hide();
            $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout.hide();
        }).data('datepicker');
        $('#dphd').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
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
</script>