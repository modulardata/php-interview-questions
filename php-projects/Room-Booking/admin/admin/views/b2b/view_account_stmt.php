
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
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/home">
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
                                    <h3>Deposit/Withdraw/View Account Summary</h3>

                                </div>
                                <div class="box-content">

                                    <?php if (!empty($agent_info)) { ?>
                                        <form class="form-horizontal" action="<?php echo site_url(); ?>/b2b/add_transaction_info" method="post">
                                            <fieldset>

                                                <?php if (validation_errors() != "") { ?>
                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <?php echo validation_errors(); ?>
                                                    </div>
                                                <?php } ?>

                                                <legend>Deposit/Withdraw Account Balance</legend>

                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Agent Number</label>
                                                    <div class="controls">
                                                        <div class="input-append">
                                                            <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $agent_info->agent_no; ?>" disabled="">	
                                                            <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>" />								  
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="control-group warning">
                                                    <label class="control-label" for="focusedInput">Available Balance</label>
                                                    <div class="controls">
                                                        <div class="input-append">
                                                            <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php if (!empty($agent_acc_summary)) echo $agent_info->currency_type . ' ' . $agent_acc_summary[0]->available_balance; else echo $agent_info->currency_type . ' 0.00'; ?>" disabled="">								 

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label">Transaction Type</label>
                                                    <div class="controls">

                                                        <label class="radio">
                                                            <div class="uniRadio" id="uniform-radio2">
                                                                <span class="checked">
                                                                    <input type="radio" id="radio1" checked="" value="deposit" class="uniform" name="transaction_type" style="opacity: 0;">
                                                                </span>
                                                            </div> 
                                                            Deposit Amount
                                                        </label>

                                                        <div style="clear:both"></div>

                                                        <label class="radio">
                                                            <div class="uniRadio" id="uniform-radio2">
                                                                <span class="checked">
                                                                    <input type="radio" id="radio2" value="withdraw" class="uniform" name="transaction_type" style="opacity: 0;">
                                                                </span>
                                                            </div> 
                                                            Withdraw Amount
                                                        </label>

                                                    </div>
                                                </div>     

                                                <div class="control-group">
                                                    <label class="control-label" for="disabledInput">Amount Deposit/Withdraw *</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="amount" value="<?php if (isset($amount)) echo $amount; ?>" required>              

                                                    </div>
                                                </div> 

                                                <div class="control-group">
                                                    <label class="control-label" for="date01">Date of Deposit/Withdraw *</label>
                                                    <div class="controls">                             								  

                                                        <input type="text" class="datepick" id="datepicker" value="<?php if (isset($value_date)) echo $value_date; ?>" name="value_date" required>        

                                                    </div>
                                                </div> 

                                                <div class="control-group">
                                                    <label class="control-label" for="selectError2">Transaction Modes</label>
                                                    <div class="controls">
                                                        <select id="selectError2" name="transaction_mode" required>
                                                            <option value="">Select Transaction Mode</option>
                                                            <optgroup label="Transaction Modes"> 
                                                                <option value="cash">Cash</option>
                                                                <option value="NEFT">NEFT</option>
                                                                <option value="RTGS">RTGS</option>
                                                                <option value="cheque">Cheque/DD</option>							
                                                            </optgroup>										
                                                        </select>
                                                    </div>
                                                </div>  

                                                <div class="control-group">
                                                    <label class="control-label" for="disabledInput">Bank </label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="bank" value="<?php if (isset($bank)) echo $bank; ?>" required>              

                                                    </div>
                                                </div> 

                                                <div class="control-group">
                                                    <label class="control-label" for="disabledInput">Branch </label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="branch" value="<?php if (isset($branch)) echo $branch; ?>" required>              

                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="disabledInput">City </label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="city" value="<?php if (isset($city)) echo $city; ?>" required>              

                                                    </div>
                                                </div>  

                                                <div class="control-group">
                                                    <label class="control-label" for="disabledInput">Transaction Id/Cheque No *</label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="transaction_id" value="<?php if (isset($transaction_id)) echo $transaction_id; ?>" required>              

                                                    </div>
                                                </div>    

                                                <div class="control-group">
                                                    <label class="control-label" for="disabledInput">Remarks </label>
                                                    <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" name="remarks" value="<?php if (isset($remarks)) echo $remarks; ?>" required>              

                                                    </div>
                                                </div>                                           

                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="<?php echo site_url(); ?>/b2b/agent_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                                </div>

                                            </fieldset>
                                        </form>
                                    <?php } ?>


                                    <table class='table table-striped dataTable table-bordered'>
                                        <thead>
                                            <tr> 
                                                <th>SI.No</th>                             	
                                                <th>Value Date</th>
                                                <th>Narration</th>
                                                <th>Transaction DateTime</th>
                                                <th>Deposit</th>                                 
                                                <th>Withdraw</th>                                  
                                                <th>Closing Balance</th>
                                            </tr>
                                        </thead>   
                                        <tbody>
                                            <?php if (!empty($agent_acc_summary)) { ?>
                                                <?php for ($i = 0; $i < count($agent_acc_summary); $i++) { ?>
                                                    <tr>
                                                        <td><?php echo $i + 1; ?></td>
                                                        <td><?php echo $agent_acc_summary[$i]->value_date; ?></td>
                                                        <td class="center"><?php echo $agent_acc_summary[$i]->transaction_summary; ?></td>
                                                        <td class="center"><?php echo $agent_acc_summary[$i]->transaction_datetime; ?></td>
                                                        <td class="center"><?php echo $agent_acc_summary[$i]->deposit_amount; ?></td>             
                                                        <td class="center"><?php echo $agent_acc_summary[$i]->withdraw_amount; ?></td>
                                                        <td class="center"><?php echo $agent_acc_summary[$i]->available_balance; ?></td>

                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>

                                            <div class="alert alert-error">
                                                <button class="close" data-dismiss="alert" type="button">×</button>
                                                <strong>Error!</strong>
                                                No Account Summary Found...
                                            </div>

                                        <?php } ?>

                                        </tbody>
                                    </table> 

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
        <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>

        <!-- My Custom JS-->
        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

    </body>
</html>