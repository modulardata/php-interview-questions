<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<div class="container pt20">
    <div style="width: 98%; padding: 1%;border:1px solid #CCC;margin-bottom: 10px;"> 

        <table>
            <tbody>
                <tr>
                    <td class="msgIcon"><img src="<?php echo WEB_DIR; ?>images/Warning.png"></td>
                    <td tabindex="-1" class="noticeTextType1 strongText">
                        <strong>ERROR MESSAGE : 

                            <?php
                                                       
                            echo $text = str_replace("%20", " ", base64_decode($error));
                            
                            ?></strong></td>
                </tr>
            </tbody>
        </table>

        <strong>What now? Call us and we'll help you find a hotel:</strong>
        <ul>
            <li>
                Speak to a Roombooking.in travel specialist: <strong>614-808-1754</strong>,&nbsp;24 Hours,&nbsp;</li>
        </ul>
    </div>
</div>
<div class="footer">
    <?php $this->load->view('home/footer'); ?>                                 
</div>
</div>

</body>
</html>
