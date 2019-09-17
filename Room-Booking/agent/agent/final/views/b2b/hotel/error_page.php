<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Final Booking</title>
        <!---==  styles  ===---->
        <link href="<?php echo WEB_DIR ?>css/styles.css" rel="stylesheet" type="text/css"  />

    </head>
    <body >
        <div class="container">
            <div class="header">
                <?php $this->load->view('home/header'); ?>                                 
            </div>

            <div class="container pt20">
                <div style="width: 98%; padding: 1%;border:1px solid #CCC;margin-bottom: 10px;"> 

                    <table>
                        <tbody>
                            <tr>
                                <td class="msgIcon"><img src="<?php echo WEB_DIR; ?>images/Warning.png"></td>
                                <td tabindex="-1" class="noticeTextType1 strongText">
                                    <strong>ERROR MESSAGE : 

                                        <?php echo $error; ?></strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <strong>What now? Call us and we'll help you find a hotel:</strong>
                    <ul>
                        <li>
                            Speak to a tickmango.com travel specialist: <strong>614-808-1754</strong>,&nbsp;24 Hours,&nbsp;</li>
                    </ul>
                </div>
            </div>
             <div class="footer">
                <?php $this->load->view('home/footer'); ?>                                 
            </div>
        </div>

    </body>
</html>
