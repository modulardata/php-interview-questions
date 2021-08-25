<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<!-----  Top destination content ----->

<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">




            <div class="col-md-12">
                <h2 class="agentHdng">Cancellation Information</h2>
                <div class="white-container padding20">


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
                        <div class="form-actions">
                            <a href="<?php echo WEB_URL ?>home/booking"> <button type="submit" class="btn btn-primary">Back to booking history</button></a>
                        </div>

                    </fieldset>



                </div>
            </div>




        </div>
    </div>
</div>

<!-- FOOTER --><?php echo $this->load->view('home/footer'); ?>