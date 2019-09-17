<?php echo $this->load->view('home/header'); ?>
<!-----  Top destination content ----->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<div class="accountCntr">
    <div class="container"> 
        <!--hotel search section-->
        <div class="row">

            <form action="<?php echo WEB_URL; ?>home/agent_register" enctype="multipart/form-data" method="post">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 border0">
                            <h1><i class="fa fa-user"></i> Agent Sign Up</h1>
                        </div>
                    </div>
                    <h2 class="agentHdng">Member Information</h2>
                    <div class="white-container padding20">
                        <?php if (validation_errors() != "") { ?>
                            <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">X</button>
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>

                        <?php
                        if ($status == '1') {
                            ?>
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert" type="button">X</button>
                                <strong>Success!</strong>
                                Agent Registration Successfully Created.<br/>
                                Thanks for your Interest and Submitting Online Agent Registration.<br/>
                                Next 5 to 6 Business Hours. We will get in touch with you for Login Details along with the SignUp documents will be emailed to you.
                            </div>
                            <?php
                        } else if ($status == '2') {
                            ?>
                            <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">X</button>
                                <strong>Error!</strong>
                                Agent Registration Not Done. Please try after some time...
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        if (!empty($errors)) {
                            ?>
                            <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">X</button>
                                <strong>Error!</strong>
                                <?php echo $errors; ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-4 ">Title:<span class="red">*</span> </div>
                            <div class="col-md-4">

                                <select class="form-control form-group" id="selectError3" name="title" required>
                                    <option value="0">Select</option>
                                    <option value="Mr">Mr.</option>
                                    <option value="Mrs">Mrs.</option>
                                    <option value="Miss">Miss.</option>
                                    <option value="MSS">Mss.</option>
                                    <option value="Prof">Prof.</option>
                                    <option value="Dr">Dr.</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Enter First Name:<span class="red">*</span> </div>
                            <div class="col-md-4">

                                <input class="form-control form-group"id="focusedInput" type="text" name="first_name" placeholder="First Name" required>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ">Enter Middle Name: </div>
                            <div class="col-md-4">

                                <input class="form-control form-group"id="focusedInput" type="text" name="middle_name" placeholder="Middle Name" >   
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Enter Last Name:<span class="red">*</span> </div>
                            <div class="col-md-4">
                                <input class="form-control form-group"id="focusedInput" type="text" name="last_name" placeholder="Last Name" required>   
                            </div>
                        </div>


                    </div>

                    <h2 class="agentHdng">Login Information</h2>
                    <div class="white-container padding20">

                        <div class="row">
                            <div class="col-md-4 ">Email Address (As Username):<span class="red">*</span> </div>
                            <div class="col-md-4">

                                <input class="form-control form-group" id="focusedInput" type="email" name="agent_email" placeholder="Email address"  required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Password:<span class="red">*</span> </div>
                            <div class="col-md-4">

                                <input class="form-control form-group" id="focusedInput" placeholder="Password" type="password" name="agent_password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Confirm Password:<span class="red">*</span> </div>
                            <div class="col-md-4">

                                <input class="form-control form-group" id="focusedInput" placeholder="Confirm Password" type="password" name="passconf" required>
                            </div>
                        </div>
                    </div>

                    <h2 class="agentHdng">Contact Information</h2>
                    <div class="white-container padding20">
                        <div class="row">
                            <div class="col-md-4 ">Your Address:<span class="red">*</span> </div>
                            <div class="col-md-4">
                                <textarea class="form-control form-group" id="focusedInput" placeholder="Address" name="address" required></textarea> 

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Mobile No:<span class="red">*</span> </div>
                            <div class="col-md-4">
                                <input class="form-control form-group" id="focusedInput" type="tel" name="mobile_no" placeholder="Mobile No" value="" required></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ">Office No: </div>
                            <div class="col-md-4">
                                <input class="form-control form-group" id="focusedInput" type="tel" name="office_phone_no" placeholder="Office No"  value="" >  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">City<span class="red">*</span> </div>
                            <div class="col-md-4">

                                <input class="form-control form-group" id="focusedInput" type="text" name="city" placeholder="City" value="" ></input>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ">State<span class="red">*</span> </div>
                            <div class="col-md-4">


                                <input class="form-control form-group" id="focusedInput" type="text" name="state" placeholder="State" value="" required></input>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ">Your postal /Zip Code:<span class="red">*</span> </div>
                            <div class="col-md-4">

                                <input class="form-control form-group" id="focusedInput" type="text" name="pin_code" placeholder="Post Code" value="" ></input>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Select Your Country:<span class="red">*</span> </div>
                            <div class="col-md-4">
                                <select name="country" class="form-control form-group" required>
                                    <option value="">Select Your Country</option>

                                    <?php for ($i = 0; $i < count($country_list); $i++) { ?>
                                        <?php if ($agent_info->country == $country_list[$i]->name) { ?>
                                            <option value="<?php echo $country_list[$i]->name; ?>" selected><?php echo $country_list[$i]->name; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>										

                                </select>

                            </div>
                        </div>


                    </div>



                    <h2 class="agentHdng">Agency Information</h2>
                    <div class="white-container padding20">

                        <div class="row">
                            <div class="col-md-4 ">Agent Number</div>
                            <div class="col-md-6">

                                <input class="form-control form-group" id="disabledInput" type="text" placeholder="RBXXXX format" disabled="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Agency / Company Name</div>
                            <div class="col-md-6">
                                <input class="form-control form-group" id="focusedInput" type="text" name="agency_name" value="" required> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ">Agency Logo</div>
                            <div class="col-md-6">
                                <input type="file" name="agency_logo" size="19" class="form-control form-group"  />
                            </div>
                        </div>


                    </div>

                    <button type="reset" class="btn btn-primary btn-register">RESET</button>
                    <button type="submit" class="btn btn-success btn-register">SUBMIT</button>          

                </div>

            </form>      

            <div class="col-md-4 marginTop41">

                <div class="row text-center marginTop25">
                    <div class="lock-icon marginTop25">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center" style="border:0; padding:30px;">
                        <h1>For Existing member</h1>
                        If you are already a Member, please login to your existing account and enjoy all Member Benefits.<br>
                        <a href="<?php echo WEB_DIR; ?>"><button class="btn btn-success btn-join marginTop25">Login</button></a>
                    </div>
                </div> 

            </div>
        </div>
    </div>
</div>
</div>

<?php echo $this->load->view('home/footer'); ?>