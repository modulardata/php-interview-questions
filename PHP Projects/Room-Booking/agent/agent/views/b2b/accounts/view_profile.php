<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<!-----  Top destination content ----->

<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">



            <div class="row">
                <div class="row">

                    <div class="col-md-4">


                        <h2 class="agentHdng">Account information</h2>
                        <div class="white-container padding20">

                            <table class="table noBorder">
                                <tr>
                                    <td>Available Balance</td>
                                    <td width="5">:</td>
                                    <td> <?php echo $agent_info->closing_balance ?> </td>
                                </tr>
                                <tr>
                                    <td>Total Deposits</td>
                                    <td width="5">:</td>
                                    <td><?php echo $agent_info->debited_balance ?> </td>
                                </tr>
                                <tr>
                                    <td>Total Withdraws</td>
                                    <td width="5">:</td>
                                    <td><?php echo $agent_info->credited_balance ?> </td>
                                </tr>
                            </table>
                        </div>  

                        <h2 class="agentHdng">Agency Logo</h2>
                        <div class="white-container padding20">
                            <div>
                                <img class="grayscale" alt="Agent Logo" src="<?php echo $agent_info->agent_logo; ?>" style="display: block;" height="100px" width="100px" align="middle">
                            </div>

                        </div>       

                    </div>
                    <?php if (!empty($agent_info)) { ?>

                        <form action="<?php echo WEB_URL; ?>home/update_profile_info" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="agent_id" value="<?php echo $agent_info->agent_id; ?>" /> 
                            <input type="hidden" name="agent_email" value="<?php echo $agent_info->agent_email; ?>" />					
                            <input type="hidden" name="agent_logo" value="<?php echo $agent_info->agent_logo; ?>" />
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12 border0">
                                        <h1><i class="fa fa-user"></i> My Profile</h1>
                                    </div>
                                </div>



                                <h2 class="agentHdng">Member Information</h2>
                                <div class="white-container padding20">
                                    <?php if (validation_errors() != "") { ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">Ã—</button>
                                            <?php echo validation_errors(); ?>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if ($status == '1') {
                                        ?>
                                        <div class="alert alert-success">
                                            <button class="close" data-dismiss="alert" type="button">Ã—</button>
                                            <strong>Success!</strong>
                                            Agent Registration Successfully Created.<br/>
                                            Thanks for your Interest and Submitting Online Agent Registration.<br/>
                                            Next 5 to 6 Business Hours. We will get in touch with you for Login Details along with the SignUp documents will be emailed to you.
                                        </div>
                                        <?php
                                    } else if ($status == '2') {
                                        ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">Ã—</button>
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
                                            <button class="close" data-dismiss="alert" type="button">Ã—</button>
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

                                                <option value="Mr" <?php if ($agent_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
                                                <option value="Mrs" <?php if ($agent_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
                                                <option value="Dr" <?php if ($agent_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 ">Enter First Name:<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group"id="focusedInput" type="text" name="first_name" placeholder="First Name" value="<?php echo $agent_info->first_name; ?>" required>   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">Enter Middle Name: </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group"id="focusedInput" type="text" name="middle_name" value="<?php echo $agent_info->middle_name; ?>" placeholder="Middle Name" >   
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 ">Enter Last Name:<span class="red">*</span> </div>
                                        <div class="col-md-4">
                                            <input class="form-control form-group"id="focusedInput" type="text" name="last_name" value="<?php echo $agent_info->last_name; ?>" placeholder="Last Name" required>   
                                        </div>
                                    </div>


                                </div>

                                <h2 class="agentHdng">Login Information</h2>
                                <div class="white-container padding20">

                                    <div class="row">
                                        <div class="col-md-4 ">Email Address (As Username):<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group" id="focusedInput" type="email" value="<?php echo $agent_info->agent_email; ?>" name="agent_email" placeholder="Email address" readonly  required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 ">Password:<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group" id="focusedInput" placeholder="Password" readonly="readonly" value="************" type="password" name="agent_password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">&nbsp;<span class="red"></span> </div>
                                        <div class="col-md-4">

                                          <a href="<?php echo WEB_URL; ?>home/change_password" title="Click here to Reset Agent password" data-rel="tooltip" class="btn btn-warning">Reset Password</a>
                                        </div>
                                    </div>


                                </div>

                                <h2 class="agentHdng">Contact Information</h2>
                                <div class="white-container padding20">
                                    <div class="row">
                                        <div class="col-md-4 ">Your Address:<span class="red">*</span> </div>
                                        <div class="col-md-4">
                                            <textarea class="form-control form-group" id="focusedInput" placeholder="Address" name="address" required><?php echo $agent_info->address; ?></textarea> 

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 ">Mobile No:<span class="red">*</span> </div>
                                        <div class="col-md-4">
                                            <input class="form-control form-group" id="focusedInput" type="tel" name="mobile_no" placeholder="Mobile No" value="<?php echo $agent_info->mobile_no; ?>" required></input>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">Office No: </div>
                                        <div class="col-md-4">
                                            <input class="form-control form-group" id="focusedInput" type="tel" name="office_phone_no" value="<?php echo $agent_info->office_phone_no; ?>" placeholder="Office No"  value="" >  
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 ">City<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group" id="focusedInput" type="text" name="city" placeholder="City" value="<?php echo $agent_info->city; ?>" ></input>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">State<span class="red">*</span> </div>
                                        <div class="col-md-4">


                                            <input class="form-control form-group" id="focusedInput" type="text" name="state" placeholder="State" value="<?php echo $agent_info->state; ?>" required></input>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">Your postal /Zip Code:<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group" id="focusedInput" type="text" name="pin_code" placeholder="Post Code" value="<?php echo $agent_info->pin_code; ?>" ></input>

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

                                            <input class="form-control form-group" id="disabledInput" type="text" placeholder="<?php echo $agent_info->agent_no; ?>" disabled="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 ">Agency / Company Name</div>
                                        <div class="col-md-6">
                                            <input class="form-control form-group" id="focusedInput" type="text" name="agency_name" value="<?php echo $agent_info->agency_name; ?>" required> 
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 ">Agency Logo</div>
                                        <div class="col-md-6">
                                            <input type="file" name="agency_logo" size="19" class="form-control form-group"  />
                                        </div>
                                    </div>


                                </div>

<!--                                <button type="reset" class="btn btn-primary btn-register">RESET</button>-->
                                <button type="submit" class="btn btn-success btn-register">SUBMIT</button>          

                            </div>

                        </form>      


                    <?php } else { ?>
                        <div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">Ã—</button>
                            <strong>Error!</strong>
                            No Data Found. Please try after some time...
                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- FOOTER --><?php echo $this->load->view('home/footer'); ?>