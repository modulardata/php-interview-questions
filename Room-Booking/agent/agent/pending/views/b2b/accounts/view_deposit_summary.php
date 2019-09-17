<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<!-----  Top destination content ----->

<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
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

                <h2 class="agentHdng">Deposite information</h2>
                <div class="white-container padding20">

                    <table class="table">
                        <tr>
                            <td>Balance</td>
                            <td width="5">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Last Credit</td>
                            <td width="5">:</td>
                            <td>INR 898.00</td>
                        </tr>
                    </table>
                </div>       

            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 border0">
                        <h1><i class="fa fa-money"></i> Deposite History</h1>
                    </div>
                </div>


                <h2 class="agentHdng">Deposit amount for Account balance</h2>
                <div class="white-container padding20">
                    <?php if (!empty($agent_info)) { ?>
                        <form class="form-horizontal" action="<?php echo WEB_URL; ?>home/add_deposit_request" method="post">
                            <input type="hidden" name="agent_id" value="<?php echo $agent_info->agent_id; ?>" />								  
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
                                    <button class="close" data-dismiss="alert" type="button">Ã—</button>
                                    <strong>Error!</strong>
                                    <?php echo $errors; ?>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-4 ">Agent number:<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-group" value="<?php echo $agent_info->agent_no ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">Available balance:<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-group" value="<?php echo $agent_info->closing_balance ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">Deposit Amount:<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" name="amount" class="form-control form-group">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">Date of Deposit:<span class="red">*</span> </div>
                                <div class="col-md-4">

                                    <input id="deposit_date" class="datePickerIcon form-control form-group" type="text" value="<?php if (isset($value_date)) echo $value_date; ?>" name="value_date" required readonly> 
                                    <input id="today_date" type="hidden" value="<?php echo date('d/m/Y'); ?>" />             

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">Transaction modes<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <select class="form-control form-group" name="transaction_mode" required>
                                        <option value="">Select Transaction Mode</option>
                                        <option value="cash">Cash</option>
                                        <option value="NEFT">NEFT</option>
                                        <option value="RTGS">RTGS</option>
                                        <option value="cheque">Cheque/DD</option>	
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">Bank<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" name="bank" name="bank"  class="form-control form-group">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">Branch<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" name="branch" class="form-control form-group">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">City<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" name="city" class="form-control form-group">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">Transaction Id/Cheque No <span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" name="transaction_id" class="form-control form-group">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">Remarks<span class="red">*</span> </div>
                                <div class="col-md-4">
                                    <input type="text" name="remarks" class="form-control form-group">
                                </div>
                            </div>
                            <button type="reset" class="btn btn-primary btn-register">RESET</button>
                            <button type="submit" class="btn btn-success btn-register">SUBMIT</button>       

                        </form>
                    <?php } ?>  

                </div>




            </div>

        </div>
    </div>
</div>
</div>

<!-- FOOTER --><?php echo $this->load->view('home/footer'); ?>