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

                        <form class="form-horizontal" action="<?php echo WEB_URL; ?>home/change_password" method="post">
                            <fieldset>
                                <?php
                                if ($status == '1') {
                                    ?>
                                    <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert" type="button">Ã—</button>
                                        <strong>Success!</strong>
                                        Your Password Successfully Reseted.
                                    </div>
                                    <?php
                                }
                                if (!empty($errors)) {
                                    ?>
                                    <div class="alert alert-error">
                                        <button class="close" data-dismiss="alert" type="button">Ã—</button>
                                        <strong>Error!</strong>
                                        <?php echo $errors; ?>
                                    </div>
                                <?php }
                                ?>


                                <?php if (validation_errors() != '') { ?> 
                                    <div class="alert alert-error">
                                        <button class="close" data-dismiss="alert" type="button">Ã—</button>
                                        <?php echo validation_errors(); ?>                               
                                    </div>
                                <?php } ?> 
                                
                                <h2 class="agentHdng">Login Information</h2>
                                <div class="white-container padding20">

                                    <div class="row">
                                        <div class="col-md-4 ">Email Address (As Username):<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group" id="focusedInput" type="email" value="<?php echo $agent_info->agent_email; ?>" name="agent_email" placeholder="Email address" readonly  required>
                                        </div>
                                    </div>

  
                                    <div class="row">
                                        <div class="col-md-4 ">New Password:<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group" id="focusedInput" placeholder="Password"  type="password" name="password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 "> Confirm Password:<span class="red">*</span> </div>
                                        <div class="col-md-4">

                                            <input class="form-control form-group" id="focusedInput" placeholder="Conf Password" type="password" name="passconf" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="<?php echo WEB_URL; ?>home/view_profile" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                </div>
                                
                                
   \

                            </fieldset>
                        </form>

                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- FOOTER --><?php echo $this->load->view('home/footer'); ?>