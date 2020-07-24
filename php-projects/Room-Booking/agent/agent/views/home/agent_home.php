<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<!-----  Top destination content ----->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
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

<!--                <h2 class="agentHdng">Notice Board</h2>
                <div class="white-container padding20">

                    <h3>Notice</h3>
                </div>       -->

            </div>

            <div class="col-md-8">        

                <div class="row">
                    <div class="col-md-12 border0">
                        <h1>&nbsp;</h1>
                    </div>
                </div>
               
                
                    <?php echo $this->load->view('home/search_form'); ?>
              


            </div>

        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>

<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/datepickerScript.js"></script>

<!-- Airport AutoComplete List-->
<!--<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo WEB_DIR ?>public/js/autocomplete/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR ?>public/css/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript">
    $(function() {	
        $("#hotelcity").autocomplete({
            source: "<?php echo WEB_URL; ?>home/hotel_autolist",
            minLength: 2,
            autoFocus: true
        });
    });
     $(function() {	
        $("#hotelcityd").autocomplete({
            
            source: "<?php echo WEB_URL; ?>home/dhotel_autolist",
            minLength: 2,
            autoFocus: true
        });
    });

</script>

