
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
                                    <h3>Agent Management</h3>
                                    <!--<ul class='nav nav-tabs'>							
                                                                                 <a href="<?php echo site_url(); ?>/b2b/create_agent" ><button class="btn btn-primary">Create New Agent</button></a>							
                                         </ul>-->

                                    <ul class="nav  nav-pills">
                                        <li>
                                            <a class="tip btn btn-mini" href="<?php echo site_url(); ?>/b2b/create_agent" data-original-title="Create New Agent">
                                                <img alt="" src="<?php echo base_url(); ?>public/img/icons/essen/16/business-contact.png">                      
                                            </a>
                                        </li>&nbsp;&nbsp;&nbsp;
                                        <li class="active">
                                            <a data-toggle="tab" href="#agent-list">Agent List</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#active-agents">Active Agents</a>
                                        </li>
                                    </ul>							
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="agent-list">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th> 
                                                        <th>Agency Logo</th>                            	
                                                        <th>Agent No</th>
                                                        <th>Agency Name</th>
                                                        <th>Email</th>                                 
                                                        <th>Mobile</th>
                                                        <th>City</th>
                                                        <th>Register DateTime</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($agent_info)) { ?>
                                                        <?php for ($i = 0; $i < count($agent_info); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td class="table-image">
                                                                    <a class="preview fancy" href="<?php echo $agent_info[$i]->agent_logo; ?>">
                                                                        <img title="<?php echo $agent_info[$i]->agency_name; ?>" alt="" src="<?php echo $agent_info[$i]->agent_logo; ?>" height="60" width="60">
                                                                    </a>
                                                                </td>
                                                                <td><?php echo $agent_info[$i]->agent_no; ?></td>
                                                                <td class="center"><?php echo $agent_info[$i]->agency_name; ?></td>
                                                                <td class="center"><?php echo $agent_info[$i]->agent_email; ?></td>             
                                                                <td class="center"><?php echo $agent_info[$i]->mobile_no; ?></td>
                                                                <td class="center"><?php echo $agent_info[$i]->city; ?></td>
                                                                <td class="center"><?php echo $agent_info[$i]->register_date; ?></td>
                                                                <td class="center">
                                                                    <?php if ($agent_info[$i]->status == 0) { ?>
                                                                        <span class="label">Inactive</span>
                                                                    <?php } else if ($agent_info[$i]->status == 1) { ?>
                                                                        <span class="label label-success">Active</span>
                                                                    <?php } else if ($agent_info[$i]->status == 2) { ?>
                                                                        <span class="label label-important">Blocked</span>
                                                                    <?php } else { ?>
                                                                        <span class="label label-warning">Pending</span>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="center">

                                                                    <a class="tip btn btn-mini manageStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-agent-id="<?php echo $agent_info[$i]->agent_id; ?>" >
                                                                        <i class="icon-ok"></i>			                                          
                                                                    </a>
                                                                    <a class="tip btn btn-mini manageStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="0" data-agent-id="<?php echo $agent_info[$i]->agent_id; ?>" >										
                                                                        <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                                    </a>
                                                                    <a class="tip btn btn-mini btn-danger manageStatus" href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="2" data-agent-id="<?php echo $agent_info[$i]->agent_id; ?>" >
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

                                        <div class="tab-pane" id="active-agents">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>   
                                                        <th>Logo</th>                          	
                                                        <th>Agent No</th>
                                                        <th>Agency Name</th>
                                                        <th>Email</th>                                 
                                                        <th>Mobile</th>                                
                                                        <th>A/C Balance</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($agent_info)) { ?>
                                                        <?php $j = 0;
                                                        for ($i = 0; $i < count($agent_info); $i++) {
                                                            ?>
        <?php if ($agent_info[$i]->status == 1) { ?>
                                                                <tr>
                                                                    <td><?php echo $j + 1; ?></td>
                                                                    <td class="table-image">
                                                                        <a class="preview fancy" href="<?php echo $agent_info[$i]->agent_logo; ?>">
                                                                            <img title="<?php echo $agent_info[$i]->agency_name; ?>" alt="" src="<?php echo $agent_info[$i]->agent_logo; ?>" height="60" width="60">
                                                                        </a>
                                                                    </td>
                                                                    <td><?php echo $agent_info[$i]->agent_no; ?></td>
                                                                    <td class="center"><?php echo $agent_info[$i]->agency_name; ?></td>
                                                                    <td class="center"><?php echo $agent_info[$i]->agent_email; ?></td>             
                                                                    <td class="center"><?php echo $agent_info[$i]->mobile_no; ?></td>
                                                                    <td class="center">
                                                                        <?php
                                                                        $agent_bal = $this->B2b_Model->get_available_balance($agent_info[$i]->agent_id);
                                                                        if ($agent_bal != '')
                                                                            echo $agent_info[$i]->currency_type . ' ' . $agent_bal;
                                                                        else
                                                                            echo $agent_info[$i]->currency_type . ' 0.00'
                                                                            ?>
                                                                    </td>
                                                                    <td class="center">

                                                                        <a class="tip btn btn-mini btn-primary" href="<?php echo site_url(); ?>/b2b/view_agent_info/<?php echo $agent_info[$i]->agent_id; ?>" title="View / Edit" data-rel="tooltip">
                                                                            <i class="icon-edit icon-white"></i>			                                          
                                                                        </a>

                                                                        <a class="tip btn btn-mini btn-small" href="<?php echo site_url(); ?>/b2b/view_account_stmt/<?php echo $agent_info[$i]->agent_id; ?>" title="View Account" data-rel="tooltip">

                                                                            <img alt="" src="<?php echo base_url(); ?>public/img/icons/essen/16/bank.png">

                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                                <?php $j++;
                                                            } ?>
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