<?php echo $this->load->view('home/header'); ?>
<?php echo $map['js']; ?>
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
    <div class="rg-image-wrapper">
        {{if itemsCount > 1}}
        <div class="rg-image-nav">
            <a href="#" class="rg-image-nav-prev">Previous Image</a>
            <a href="#" class="rg-image-nav-next">Next Image</a>
        </div>
        {{/if}}
        <div class="rg-image"></div>
        <div class="rg-loading"></div>
    </div>
</script>


<div class="hotelCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-12">
                <div class="hotelResultsCntr padding10"> 



                    <fieldset>
                        <legend>Cancellation Information</legend>
                        <div class="control-group warning">
                            <label class="control-label" for="focusedInput">Booking_reference_ID</label>
                            <div class="controls">
                                <?php echo $Ref_id ?>
                                <input type="hidden" namr="Ref_id" value="<?php echo $Ref_id ?>"/>
                            </div>
                        </div>
                        <div class="control-group warning">
                            <label class="control-label" for="focusedInput">Surname</label>
                            <div class="controls">
                                <?php echo $surname ?>
                                <input type="hidden" namr="surname" value="<?php echo $surname ?>"/>
                            </div>
                        </div>
                        <div class="control-group warning">
                            <label class="control-label" for="focusedInput">Email</label>
                            <div class="controls">
                                <?php echo $email ?>
                            </div>
                        </div>
                        <div class="control-group warning">
                            <label class="control-label" for="focusedInput">Cancellation</label>
                            <div class="controls">
                                <?php echo "Hotel has been Cancelled" ?>
                            </div>
                        </div>

                    </fieldset>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script>
    function moreroomfull(hotel_code){
        // alert('hotel_code');
        $("#more_details_"+hotel_code).toggle(500);

    }
    $( ".loop:odd" ).css( "background-color", "#009ed9" ).css("color","white");
    //$( ".review_contailer:odd" ).css( "background-color", "grey" ).css("color","white");
</script>
<?php echo $this->load->view('home/footer'); ?>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>public/js/gallery.js"></script>



