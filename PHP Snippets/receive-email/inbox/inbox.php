<?php
                        $dns = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
                        $email = "pradeepthoughtfocus@gmail.com";
                        $password = "pradeep!@#";
						

                        $openmail = imap_open($dns,$email,$password);
                        if ($openmail) {

                                    echo  "You have ".imap_num_msg($openmail). " messages in your inbox\n\r";

                                    for($i=1050; $i <= 1054; $i++) {
                                   
                                                $header = imap_header($openmail,$i);
                                                echo "<br>";
                                                echo $header->Subject." (".$header->Date.")";
                                    }

                        echo "\n\r";
                        $msg = imap_fetchbody($openmail,1,"","FT_PEEK");
                       
                        
                        $msgBody = imap_fetchbody ($openmail, $i, "2");
                        if ($msgBody == "") {
                        $partno = "2";
                        $msgBody = imap_fetchbody ($openmail, $i, $partno);
                        }

                        $msgBody = trim(substr(quoted_printable_decode($msgBody), 0, 200));
                       
                        
                        echo $msg;
                        imap_close($openmail);
                        }



                        else {

                        echo "False";

                        }
           
           


?>