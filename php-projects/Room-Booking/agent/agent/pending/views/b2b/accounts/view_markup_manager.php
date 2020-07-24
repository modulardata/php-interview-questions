<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<!-----  Top destination content ----->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">

<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">      
            <div class="col-md-12">

                <h2 class="agentHdng">Add Agent Markup</h2>

                <form class="form-horizontal" action="<?php echo WEB_URL; ?>home/add_markup" method="post">


                    <div class="white-container padding20">

                        <div class="row">
                            <div class="col-md-2 ">Agent number:<span class="red">*</span> </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control form-group" value="<?php echo $agent_no; ?>" name="agent_no" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 ">Service type:<span class="red">*</span> </div>
                            <div class="col-md-4">
                                <select class="form-control form-group" name="service_type" required>
                                    <option>Select Service Type</option>
                                    <option value="1">Hotel</option>
                                    <option value="2">Flight</option>  
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 ">Markup(%):<span class="red">*</span> </div>
                            <div class="col-md-4">
                                <input type="text" name="markup" value="<?php if (isset($markup)) echo $markup; ?>" class="form-control form-group" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 "></div>
                            <div class="col-md-6 form-group">
                                <button type="submit" class="btn btn-primary btn-register">ADD / EDIT MARKUP</button>
                                <button type="reset" class="btn btn-warning btn-register">CANCEL</button> 

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">

                                <?php if (validation_errors() != "") { ?>


                                    <div class="alert alert-danger alert-dismissable">

                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>Warning!</strong>  <?php echo validation_errors(); ?>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </form>

                <div class="white-container padding20">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr> 
                                    <th>SI.No</th>                             	
                                    <th>Service Type</th>
                                    <th>Markup (%)</th>
                                    <th>Status</th>
                                    <th>Created DateTime</th>                                 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($agent_markup_manager)) { ?>
                                    <?php for ($i = 0; $i < count($agent_markup_manager); $i++) { ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td>
                                                <?php
                                                if ($agent_markup_manager[$i]->service_type == 1)
                                                    echo 'Hotel';
                                                else
                                                    echo 'Flight';
                                                ?>
                                            </td>
                                            <td class="center"><?php echo $agent_markup_manager[$i]->markup; ?></td>
                                            <td class="center">
                                                <?php
                                                if ($agent_markup_manager[$i]->status == 1)
                                                    echo 'Active';
                                                else
                                                    echo 'In-Active';
                                                ?>
                                            </td>
                                            <td class="center"><?php echo $agent_markup_manager[$i]->updated_datetime; ?></td>             
                                            <td class="center">
                                                <?php if ($agent_markup_manager[$i]->status == 1) { ?>
                                                    <a href="<?php echo WEB_URL; ?>home/markup_status/<?php echo $agent_markup_manager[$i]->markup_id; ?>/0">In-Active</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo WEB_URL; ?>home/markup_status/<?php echo $agent_markup_manager[$i]->markup_id; ?>/1">Active</a>
                                                <?php } ?>
                                            </td>           
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>

                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">Ã—</button>
                                    <strong>Error!</strong>
                                    No Markup Summary Found...
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

<!-- FOOTER -->


<?php echo $this->load->view('home/footer'); ?>

