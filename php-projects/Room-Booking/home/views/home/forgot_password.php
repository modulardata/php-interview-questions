<?php echo $this->load->view('home/homeheader'); ?>

<!-----  Top destination content ----->



<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">

            <div class="col-md-3">

                <div class="white-container">
                    <ul class="dashboard-nav">
<!--                        <li><a href="<?php //echo WEB_URL;  ?>home/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
                        <li><a href="<?php echo WEB_URL; ?>user/user_booking"><i class="fa fa-briefcase"></i> Booking History</a></li>
                        <li><a href="<?php echo WEB_URL; ?>user/view_profile" ><i class="fa fa-user"></i> Profile</a></li>
<!--                            <li><a href="<?php echo WEB_URL; ?>"><i class="fa fa-group"></i> Travellers</a></li>
                        <li><a href="#"><i class="fa fa-road"></i> Expressway</a></li>-->
                        <li><a href="<?php echo WEB_URL; ?>user/change_password" class="active"><i class="fa fa-gears"></i> Settings</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-md-9">
                <div class="white-container">
                    <div class="row">
                        <div class="col-md-12">                    	
                            <div class="greyBox" style="padding-top:1px;">
                                <h3>Your login details</h3>
                                <div class="row">
                                    <!--                                    <div class="col-md-3 text-right">Username</div>
                                                                        <div class="col-md-2">
                                                                            <span class="font20"><?php echo $user_info->user_email ?></span>
                                                                        </div>-->
                                    <form action="<?php echo WEB_URL; ?>user/restore_password" enctype="multipart/form-data" method="post">
                                        <?php
                                        if ($status == '1') {
                                            ?>
                                            <div class="alert alert-success">
                                                <button class="close" data-dismiss="alert" type="button">×</button>
                                                <strong>Success!</strong>
                                                Your Password Successfully Reseted.
                                            </div>
                                            <?php
                                        }
                                        if (!empty($errors)) {
                                            ?>
                                            <div class="alert alert-error">
                                                <button class="close" data-dismiss="alert" type="button">×</button>
                                                <strong>Error!</strong>
                                                <?php echo $errors; ?>
                                            </div>
                                        <?php }
                                        ?>
                                        <input type="hidden" value="<?php echo $user_id; ?>" name="user_id"/>
                                        <label>Email id</label>
                                        <input type="text" class="form-control form-group" placeholder="<?php echo $email; ?>" name=""  readonly="">

                                        <label>Enter a new password</label>
                                        <input type="password" class="form-control form-group" placeholder="Password" name="password" required="">

                                        <label>Confirm new password</label>
                                        <input type="password" class="form-control form-group" placeholder="Confirm Password" name="passconf" required="">

                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 text-right"></div>
                                    <div class="col-md-6 marginTop10">

                                        <!--                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalChangePassword">Change Password</button>-->


                                        <!-- Change password -->
                                        <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <!--                                            <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                                    <h3 class="modal-title" id="myModalLabel">Reset your password</h3>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <form action="<?php //echo WEB_URL;  ?>user/restore_password" enctype="multipart/form-data" method="post">
                                            <?php
                                            //
                                            //if ($status == '1') {
                                            ?>
                                                                                                    <div class="alert alert-success">
                                                                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                                                                        <strong>Success!</strong>
                                                                                                        Your Password Successfully Reseted.
                                                                                                    </div>
                                            <?php
                                            }
                                            //if (!empty($errors)) {
                                            ?>
                                                                                                    <div class="alert alert-error">
                                                                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                                                                        <strong>Error!</strong>
                                            <?php // echo $errors;  ?>
                                                                                                    </div>
                                            <?php }
                                            ?>
                                                                                                        <input type="hidden" value="<?php // echo $user_id;  ?>" name="user_id"/>
                                                                                                        <label>Email id</label>
                                                                                                        <input type="text" class="form-control form-group" placeholder="<?php // echo $email;  ?>" name=""  readonly="">
                                            
                                                                                                        <label>Enter a new password</label>
                                                                                                        <input type="password" class="form-control form-group" placeholder="Password" name="password" required="">
                                            
                                                                                                        <label>Confirm new password</label>
                                                                                                        <input type="password" class="form-control form-group" placeholder="Confirm Password" name="passconf" required="">
                                            
                                                                                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
                                                                                                    </form>
                                                                                                </div>
                                            
                                                                                            </div>
                                                                                        </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- FOOTER -->
<?php echo $this->load->view('home/footer'); ?>



