
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
                                <div class="box-head tabs">
                                    <h3>Account Summary</h3>

                                    <ul class="nav  nav-pills">                           
                                        <li class="active">
                                            <a data-toggle="tab" href="#agent_acc">Agent Acc Summary</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#agent_approved">Agents Approved</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#agent_pending">Agents Pending</a>
                                        </li>
                                    </ul>							
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="agent_acc" style="overflow:auto;">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th>
                                                        <th>Agent No</th>
                                                        <th>Transaction_summary</th>
                                                        <th>Deposit_amount</th>
                                                        <th>Withdraw_amount</th>
                                                        <th>Transaction_id</th>
                                                        <th>Bank</th>                                                   
                                                        <th>Branch</th>                                                    
                                                        <th>City</th>
                                                        <th>Value_date</th>
                                                        <th>Transaction_datetime</th>
                                                        <th>Available_balance</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                        <th>Actions</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($agent_acc_summary)) { ?>
                                                        <?php for ($i = 0; $i < count($agent_acc_summary); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->agent_no; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->transaction_summary; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->deposit_amount; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->withdraw_amount; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->transaction_id; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->bank; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->branch; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->city; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->value_date; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->transaction_datetime; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->available_balance; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->status; ?></td>
                                                                <td><?php echo $agent_acc_summary[$i]->remarks; ?></td>

                <!--                                                            <td>
                    <a href="<?php // echo site_url();  ?>/b2b/hotel_voucher/<?php //echo $hotel_booking_summary[$i]->AL_RefNo;  ?>">Voucher</a>
                </td>-->
                                                                <td class="center">

                                                                    <a class="tip btn btn-mini " href="<?php echo site_url(); ?>home/b2b_deposite_approve/<?php echo $agent_acc_summary[$i]->deposit_id; ?>/<?php echo $agent_acc_summary[$i]->agent_no; ?>" title="Approve" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >
                                                                        <i class="icon-ok"></i>			                                          
                                                                    </a>
                                                                    <a class="tip btn btn-mini " href="javascript:void(0);" title="Decline" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="0" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >										
                                                                        <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                                    </a>


                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
                                                    </div>                               

                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="agent_approved" style="overflow:auto;">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>
                                                        <th>Agent No</th>
                                                        <th>Transaction_summary</th>
                                                        <th>Deposit_amount</th>
                                                        <th>Withdraw_amount</th>
                                                        <th>Transaction_id</th>
                                                        <th>Bank</th>                                                   
                                                        <th>Branch</th>                                                    
                                                        <th>City</th>
                                                        <th>Value_date</th>
                                                        <th>Transaction_datetime</th>
                                                        <th>Available_balance</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($agent_acc_summary_approved)) { ?>
                                                        <?php for ($i = 0; $i < count($agent_acc_summary_approved); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->agent_no; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->transaction_summary; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->deposit_amount; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->withdraw_amount; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->transaction_id; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->bank; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->branch; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->city; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->value_date; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->transaction_datetime; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->available_balance; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->status; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->remarks; ?></td>
                                                                <td class="center">

                                                        
                                                                    
                                                                    <a class="tip btn btn-mini " href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="0" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >										
                                                                        <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                                    </a>
                                                                   
                                                                    
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
                                                    </div>

                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="agent_pending" style="overflow:auto;">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>
                                                        <th>Agent No</th>
                                                        <th>Transaction_summary</th>
                                                        <th>Deposit_amount</th>
                                                        <th>Withdraw_amount</th>
                                                        <th>Transaction_id</th>
                                                        <th>Bank</th>                                                   
                                                        <th>Branch</th>                                                    
                                                        <th>City</th>
                                                        <th>Value_date</th>
                                                        <th>Transaction_datetime</th>
                                                        <th>Available_balance</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($agent_acc_summary_pending)) { ?>
                                                        <?php for ($i = 0; $i < count($agent_acc_summary_pending); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->agent_no; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->transaction_summary; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->deposit_amount; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->withdraw_amount; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->transaction_id; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->bank; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->branch; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->city; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->value_date; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->transaction_datetime; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->available_balance; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->status; ?></td>
                                                                <td><?php echo $agent_acc_summary_approved[$i]->remarks; ?></td>
                                                                <td class="center">

                                                                    <a class="tip btn btn-mini " href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >
                                                                        <i class="icon-ok"></i>			                                          
                                                                    </a>
                                                                    <a class="tip btn btn-mini " href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="0" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >										
                                                                        <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                                    </a>
                                                                    <a class="tip btn btn-mini btn-danger " href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="2" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >
                                                                        <i class="icon-trash icon-white"></i> 

                                                                    </a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
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