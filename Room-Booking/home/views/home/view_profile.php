
<?php echo $this->load->view('home/homeheader'); ?>
<!-- Search section
    ================================================== -->
<!-----  Top destination content ----->


<div class="accountCntr">
    <div class="container"> 
        <form action="<?php echo WEB_URL; ?>user/update_profile_info" enctype="multipart/form-data" method="post">

            <!--hotel search section-->
            <div class="row">


                <div class="col-md-3">

                    <div class="white-container">
                        <ul class="dashboard-nav">
<!--                            <li><a href="<?php //echo WEB_URL; ?>home/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
                            <li><a href="<?php echo WEB_URL; ?>user/user_booking"><i class="fa fa-briefcase"></i> Booking History</a></li>
                            <li><a href="<?php echo WEB_URL; ?>user/view_profile" class="active"><i class="fa fa-user"></i> Profile</a></li>
<!--                            <li><a href="<?php echo WEB_URL; ?>"><i class="fa fa-group"></i> Travellers</a></li>
                            <li><a href="#"><i class="fa fa-road"></i> Expressway</a></li>-->
                            <li><a href="<?php echo WEB_URL; ?>user/change_password"><i class="fa fa-gears"></i> Settings</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-9">

                    <div class="white-container">
                        <div class="row">
                            <h2>My profile</h2>
                            <div class="col-md-6">
                                <?php if (validation_errors() != "") { ?>
                                    <div class="alert alert-error">
                                        <button class="close" data-dismiss="alert" type="button"><img src="<?php echo WEB_DIR; ?>public/img/close.png"/></button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                <?php } ?>

                                <?php
                                if ($status == '1') {
                                    ?>
                                    <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert" type="button"><img src="<?php echo WEB_DIR; ?>public/img/close.png"/></button>
                                        <strong>Success!</strong>
                                        User Profile Updated Successfully.
                                    </div>
                                    <?php
                                } else if ($status == '2') {
                                    ?>
                                    <div class="alert alert-error">
                                        <button class="close" data-dismiss="alert" type="button"><img src="<?php echo WEB_DIR; ?>public/img/close.png"/></button>
                                        <strong>Error!</strong>
                                        User Profile Not Updated. Please try after some time...
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php
                                if (!empty($errors)) {
                                    ?>
                                    <div class="alert alert-error">
                                        <button class="close" data-dismiss="alert" type="button"><img src="<?php echo WEB_DIR; ?>public/img/close.png"/></button>
                                        <strong>Error!</strong>
                                        <?php echo $errors; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                    	
                                <div class="greyBox">

                                    <div class="row">
                                        <div class="col-md-3 text-right">Title</div>
                                        <div class="col-md-2">
                                            <select class="form-control form-group">
                                                <option value="Mr" <?php if ($user_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
                                                <option value="Mrs" <?php if ($user_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
                                                <option value="Dr" <?php if ($user_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 text-right">Full name</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-group" placeholder="first name" name="first_name" value="<?php echo $user_info->first_name; ?>" required/>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-group" placeholder="Middle name" name="middle_name" value="<?php echo $user_info->middle_name; ?>"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 text-right">Last name</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-group" name="last_name" value="<?php echo $user_info->last_name; ?>" required/>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3>Contact details</h3>

                                <input type="hidden" name="user_id" value="<?php echo $user_info->user_id; ?>" /> 
                                <input type="hidden" name="user_email" value="<?php echo $user_info->user_email; ?>" />					
    <!--                            <input type="hidden" name="user_logo" value="<?php echo $user_info->user_logo; ?>" />-->
                                <div class="row marginTop25">
                                    <div class="col-md-3 text-right">Email address</div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-group" placeholder="Email address" value="<?php echo $user_info->user_email; ?>" readonly=""/>
                                        <span class="font12">This is also your Cleartrip username, visit settings to change it.</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right">Mobile no.</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-group" placeholder="Mobile no" name="mobile_no" value="<?php echo $user_info->mobile_no; ?>" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right">Address</div>
                                    <div class="col-md-6">
                                        <textarea class="form-control form-group" placeholder="Enter street address here" name="address" required><?php echo $user_info->address; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right">City</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-group" placeholder="City" name="city" value="<?php echo $user_info->city; ?>" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right">State</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-group" placeholder="State" name="state"  value="<?php echo $user_info->state; ?>" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right">Post Code</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-group" placeholder="Pin / Zip Code"  name="pin_code" value="<?php echo $user_info->pin_code; ?>" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right">Country</div>
                                    <div class="col-md-4">
                                        <select class="form-control form-group" collapser="true" name="country" required>
                                            <option value="">Select Your Country</option>

                                            <?php for ($i = 0; $i < count($country_list); $i++) { ?>
                                                <?php if ($user_info->country == $country_list[$i]->name) { ?>
                                                    <option value="<?php echo $country_list[$i]->name; ?>" selected><?php echo $country_list[$i]->name; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>										

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right"><button type="submit" class="btn btn-primary">Update</button></div>

                                </div>

                            </div>


                        </div>



                    </div>

                </div>

            </div>



        </form>
    </div>
</div>
</div>

<!-- FOOTER -->
<?php echo $this->load->view('home/footer'); ?>