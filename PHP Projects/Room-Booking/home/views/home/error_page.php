
                <?php echo $this->load->view('home/header'); ?>

                <br></br><br></br><br></br>



                <div class="hotel_container"> 
                    <div align="center" style="width: 90%; padding: 5%; text-align: center; border:1px solid #CCC;margin: auto; margin-top: 20px; height: 200px"> 
                        <table align="center">
                            <tbody>
                                <tr>
                                    <td class="msgIcon"><img src="<?php echo WEB_DIR; ?>public/images/Warning.png"></td>
                                    <td tabindex="-1" class="noticeTextType1 strongText">
                                        <strong>ERROR MESSAGE : 

                                            <?php 
                                            $text = base64_decode($error);
                                           


                                            echo $text;
                                            ?>
                                        </strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>




            <?php echo $this->load->view('home/footer');  ?>
