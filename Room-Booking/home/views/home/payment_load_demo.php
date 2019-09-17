<?php //echo '<pre>';print_r($this->session->all_userdata());exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <title>::Roombooking ::</title>
          

            <script type="text/javascript">

                function call()
                {	
                    document.payment_sub.submit();
                }

            </script>

            <script type="text/javascript">

                var ray={
                    ajax:function(st)
                    {
                        this.show('load');
                    },
                    show:function(el)
                    {
                        this.getID(el).style.display='';
                    },
                    getID:function(el)
                    {
                        return document.getElementById(el);
                    }
                }
            </script>
            <style type="text/css">
                #load{	
                    text-align:center;	
                    font-family:"Trebuchet MS", verdana, arial,tahoma;
                    font-size:13pt;
                }
            </style>

    </head>

    <body onload="call()">
        <?php
        $selected_room = $this->session->userdata('selected_room');
        $total_amount = $selected_room['total_amount'];
        $amount = $total_amount;
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
//
//        //For Live
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
            <input type="hidden" name="surl" value="<?php echo WEB_URL; ?>hotel/booking_final_tg" />
            <input type="hidden" name="Furl" value="<?php echo WEB_URL; ?>hotel/payfailed" />

            <input type="hidden" name="Pg" value="CC" />
            <?php
            //key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT
            $text1 = $key . '|' . $random . '|' . $amount . '|' . $product . '|' . $firstname . '|' . $email . '|||||||||||' . $SALT;
            $str1 = hash("sha512", $text1);
            ?>
            <input type="text" name="Hash" value="<?php echo $str1; ?>" />
            <!--    <input type="submit" name="submit" value="submit" />-->
        </form>
     

    </body>
</html>