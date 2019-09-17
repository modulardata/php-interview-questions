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



                    <form class="form-horizontal" action="<?php echo WEB_URL; ?>hoteld/hotel_cancel_confirm" enctype="multipart/form-data" method="post">
                        <fieldset>
                            <input type="hidden" namr="case" value="Cancel"/>
                            <legend>Cancellation Information</legend>
                            <div class="control-group warning">
                                <label class="control-label" for="focusedInput">Booking_reference_ID</label>
                                <div class="controls">
                                    <?php echo $Ref_id ?>
                                    <input type="hidden" name="Ref_id" value="<?php echo $Ref_id ?>"/>
                                </div>
                            </div>
                            <div class="control-group warning">
                                <label class="control-label" for="focusedInput">Surname</label>
                                <div class="controls">
                                    <?php echo $surname ?>
                                    <input type="hidden" name="surname" value="<?php echo $surname ?>"/>
                                </div>
                            </div>
                            <div class="control-group warning">
                                <label class="control-label" for="focusedInput">Email</label>
                                <div class="controls">
                                    <?php echo $email ?>
                                    <input type="hidden" name="email" value="<?php echo $email ?>"/>
                                </div>
                            </div>
                            <div class="control-group warning">
                                <label class="control-label" for="focusedInput">Cancellation</label>
                                <div class="controls">
                                    <?php echo $curlresp ?>

                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Confirm Cancel</button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>




        </div>
    </div>
</div>

<!-- FOOTER --><?php echo $this->load->view('home/footer'); ?>