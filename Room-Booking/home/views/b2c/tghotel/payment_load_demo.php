<?php //echo '<pre>';print_r($this->session->all_userdata());exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="docs-assets/ico/favicon.ico">
<title>loading...</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR; ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/custom.css">
<!--<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customhome.css">-->
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/datepicker.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/jquery-ui.css">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

    <body onload="call()">
        <?php
        $selected_room = $this->session->userdata('selected_room');
        $total_amount = $selected_room['total_amount'];
        $amount = round($total_amount);
        $product = 'Hotel Booking';
        $pass_info = $this->session->userdata('pass_info');
        $firstname = $pass_info['afname']['0'];
        $email = $pass_info['pemail'];
        $pmobile = $pass_info['pmobile'];
        $random = rand(000000, 9999999);
        ?>
        <?php
        //===========================================
        
        //For Demo
        $url = 'https://test.payu.in/_payment.php';
        $key = 'C0Dr8m';
        $SALT = '3sf0jURk';
        
         //For Live
//        $url = 'https://secure.payu.in/_payment';
//        $SALT = '9ub2mwSf';
//        $key = 'dM6nDm';
//        
//        
        //For Live
//        $url = 'https://secure.payu.in/_payment';
//        $SALT = '9TgxP8VF';
//        $key = 'RCEb10';

        //===========================================
        ?>


        <form name="payment_sub" action="<?php echo $url; ?>" method="post">
            <input type="hidden" name="key" value="<?php echo $key; ?>" />
            <input type="hidden" name="txnid" value="<?php echo $random; ?>" />
            <input type="hidden" name="Amount" value="<?php echo $amount; ?>" />
            <input type="hidden" name="productinfo" value="<?php echo $product; ?>" />
            <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
            <input type="hidden" name="email" value="<?php echo $email; ?>" />
            <input type="hidden" name="phone" value="<?php echo $pmobile; ?>" />
            <input type="hidden" name="surl" value="<?php echo WEB_URL; ?>dhotel/booking_final_tg" />
            <input type="hidden" name="Furl" value="<?php echo WEB_URL; ?>dhotel/payfailed" />

            <input type="hidden" name="Pg" value="CC" />
            <?php
            //key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT
            $text1 = $key . '|' . $random . '|' . $amount . '|' . $product . '|' . $firstname . '|' . $email . '|||||||||||' . $SALT;
            $str1 = hash("sha512", $text1);
            ?>
            <input type="text" name="Hash" value="<?php echo $str1; ?>" />
            <!--    <input type="submit" name="submit" value="submit" />-->
        </form>


<script type="text/javascript">

    function call()
    {	
        document.payment_sub.submit();
    }

</script>
<!--Custom loader for results-->
<div class="loader" style="display:block;"><span>Payment in Progress ...</span></div>
<!--Results loads here-->
    </body>
</html>