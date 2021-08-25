<?php
$to="pradeep.vwa@gmail.com";
/*$to="pradeep.vwa@gmail.com";*/
$fn="Pradeep";
$ln="Kumar";
$name=$fn.' '.$ln;
$from="pradeep.vwa@gmail.com";
$subject = "Welcome to Website";
$message = "Dear $name, 


Your Welcome to our Website.

Hi this is Pradeep Kumar

hereby i am informing you that my email program is sucessfully working.

thanking you


Thanks
www.onlineauction.com
";
include('smtpwork.php');

?>