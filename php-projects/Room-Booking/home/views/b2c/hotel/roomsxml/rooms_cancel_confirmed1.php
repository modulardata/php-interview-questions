<?php echo $this->load->view('home/header'); ?>



<div class="flightCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-8">


                <fieldset>
                    <input type="hidden" namr="case" value="Cancel"/>
                    <legend>Cancellation Information</legend>
                    <?php $cancel_data = $this->session->userdata('cancel_confirm_array'); ?>
                    <div class="control-group warning">
                        <label class="control-label" for="focusedInput">Booking_reference_ID</label>
                        <div class="controls">
                            <?php echo $cancel_data['HotelId'] ?>
                            <input readonly="readonly" type="hidden" name="HotelId" value="<?php echo $cancel_data['HotelId'] ?>"/>
                        </div>
                    </div>
                    <div class="control-group warning">
                        <label class="control-label" for="focusedInput">Booking Reference</label>
                        <div class="controls">
                            <?php echo $cancel_data['Book_reference']; ?>
                            <input type="hidden" name="Book_reference" value="<?php echo $cancel_data['Book_reference']; ?>"/>
                        </div>
                    </div>
                    <div class="control-group warning">
                        <label class="control-label" for="focusedInput">Created Date</label>
                        <div class="controls">
                            <?php echo $cancel_data['Book_CreationDate']; ?>
                            <input type="hidden" name="Book_CreationDate" value="<?php echo $cancel_data['Book_CreationDate']; ?>"/>
                        </div>
                    </div>
                    <div class="control-group warning">
                        <label class="control-label" for="focusedInput">Status</label>
                        <div class="controls">
                            <?php echo $cancel_data['Status'] . ' '; ?>

                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><a href="<?php echo site_url(); ?>home">Home</a></button>
                    </div>

                </fieldset>

            </div>
        </div>
    </div>
</div>
<?php echo $this->load->view('home/footer'); ?>
