
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>:: Admin Console ::</title>
        <meta name="description" content="">

        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.jgrowl.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="dashboard.html"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="dashboard.html">
                            Dashboard
                        </a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="main">
            <?php echo $this->load->view('leftpanel'); ?>
            <div class="container-fluid">
                <div class="content">
                    <?php echo $this->load->view('topmenu'); ?>


                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box">
                                <div class="box-head">
                                    <h3>View/Edit User Info</h3>
                                </div>                       
                                <div class="box-content">
                                    <?php if (!empty($user_info)) { ?>

                                        <form class="form-horizontal" action="<?php echo site_url(); ?>/b2c/update_user_info" enctype="multipart/form-data" method="post">
                                            <fieldset>

                                                <?php if (validation_errors() != "") { ?>
                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <?php echo validation_errors(); ?>
                                                    </div>
                                                <?php } ?>

                                                <?php
                                                if ($status == '1') {
                                                    ?>
                                                    <div class="alert alert-success">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Success!</strong>
                                                        User Profile Updated Successfully Done.
                                                    </div>
                                                    <?php
                                                } else if ($status == '2') {
                                                    ?>
                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
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
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Error!</strong>
                                                    <?php echo $errors; ?>
                                                    </div>
        <?php
    }
    ?>

                                                <legend>Login Information</legend>

                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Email-Id</label>
                                                    <div class="controls">
                                                        <div class="input-append">
                                                            <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $user_info->user_email; ?>" disabled="">	
                                                            <input type="hidden" name="user_id" value="<?php echo $user_info->user_id; ?>" /> 
                                                            <input type="hidden" name="user_email" value="<?php echo $user_info->user_email; ?>" />					
                                                            <input type="hidden" name="user_logo" value="<?php echo $user_info->user_logo; ?>" />							 
                                                            <span class="help-inline">(No permission to update Login Email-Id)</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="control-group warning">
                                                    <label class="control-label" for="disabledInput">Password</label>
                                                    <div class="controls">
                                                        <div class="input-append">
                                                            <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="********" disabled="">
                                                            <a href="<?php echo site_url(); ?>/b2c/change_user_password/<?php echo $user_info->user_id; ?>" title="Click here to Reset User password" data-rel="tooltip" class="btn btn-warning">Reset Password</a>
                                                            <span class="help-inline">The password is hidden for security</span>
                                                        </div>
                                                    </div>
                                                </div> 

                                                <legend>User Information</legend>

                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">User Number</label>
                                                    <div class="controls">
                                                        <div class="input-append">
                                                            <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $user_info->user_no; ?>" disabled="">								 
                                                            <span class="help-inline">(No permission to update Unique User Number)</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="control-group">
                                                                                   <label class="control-label">User Profile Logo</label>
                                                                                   <div class="controls">
                                                                                           <div id="uniform-undefined" class="uploader">
                                                                                                   <input type="file" name="agency_logo" size="19" style="opacity: 0;">
                                                                                           <span class="filename" style="-moz-user-select: none;"></span>
                                                                                           <span class="action" style="-moz-user-select: none;">Choose File</span>
                                                                                           </div>
                                                       <img class="grayscale" alt="Agent Logo" src="<?php //echo $user_info->user_logo;  ?>" style="display: block;" height="100px" width="100px" align="middle">
                                                                                   </div>
                                                                            </div>-->


                                                <legend>Personal Information</legend>

                                                <div class="control-group">
                                                    <label class="control-label" for="selectError3">Title</label>
                                                    <div class="controls">
                                                        <select id="selectError3" name="title" required>
                                                            <option value="Mr" <?php if ($user_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
                                                            <option value="Mrs" <?php if ($user_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
                                                            <option value="Dr" <?php if ($user_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="focusedInput">First Name</label>

                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="first_name" value="<?php echo $user_info->first_name; ?>" required>                                   
                                                    </div>
                                                </div>

                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Middle Name</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="middle_name" value="<?php echo $user_info->middle_name; ?>" />
                                                        <span class="help-inline">(Optional)</span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="focusedInput">Last Name</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="last_name" value="<?php echo $user_info->last_name; ?>" required>                                   
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="focusedInput">Mobile Number</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="number" name="mobile_no" value="<?php echo $user_info->mobile_no; ?>" required>                                   
                                                    </div>
                                                </div>                              

                                                <div class="control-group">
                                                    <label class="control-label" for="focusedInput">Address</label>
                                                    <div class="controls">
                                                        <textarea class="input-xlarge focused" id="focusedInput" type="text" name="address" required><?php echo $user_info->address; ?></textarea>                                   
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="focusedInput">Pin Code</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="pin_code" value="<?php echo $user_info->pin_code; ?>" required>                                   
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="focusedInput">City</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="city" value="<?php echo $user_info->city; ?>" required>                                   
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="focusedInput">State</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="state"  value="<?php echo $user_info->state; ?>" required>                                   
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="selectError2">Country</label>
                                                    <div class="controls">
                                                        <select data-placeholder="Select Your Country" id="selectError3" data-rel="chosen" name="country" required>
                                                            <option value=""></option>
                                                            <optgroup label="Country List">                                       
    <?php for ($i = 0; $i < count($country_list); $i++) { ?>
        <?php if ($user_info->country == $country_list[$i]->name) { ?>
                                                                        <option value="<?php echo $country_list[$i]->name; ?>" selected><?php echo $country_list[$i]->name; ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>										
                                                            </optgroup>										
                                                        </select>
                                                    </div>
                                                </div>  

                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                                    <a href="<?php echo site_url(); ?>/b2c/user_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                                </div>

                                            </fieldset>
                                        </form>

<?php } else { ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Error!</strong>
                                            No Data Found. Please try after some time...
                                        </div>
<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>	
            </div>
        </div>	
        <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>public/js/less.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.jgrowl_minimized.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bbq.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.wizard-min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
    </body>
</html>