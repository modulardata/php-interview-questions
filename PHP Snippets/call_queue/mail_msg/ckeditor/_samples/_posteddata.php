<?php
session_start();
include("../../../db.php");
$bodydet=$_POST['editor1'];
$subject=$_POST['subject'];
$user=$_SESSION['user'];
$datedet=date("Y-m-d");
$timedet='00:00';

if ( isset( $_POST ) )
	$postArray = &$_POST ;			// 4.1.0 or later, use $_POST
else
	$postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS

foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
	else
		$postedValue = htmlspecialchars( $value ) ;
		
	
}
if($_POST['modify']>0)
{
	$id=$_POST['modify'];
	$bodydet1="update `mail_det` set `mail_subject`='".$subject."', `mail_content`='".$bodydet."', `mail_date`='".$datedet."' where id='".$id."' and count=0";
}
else
{
	$bodydet1="INSERT INTO `mail_det` (`mail_subject`, `mail_content`, `status`, `mail_date`, `username`, `count`) VALUES
	( '".$subject."', '".$bodydet."', '1', '".$datedet."', '".$user."', 0)";
	$url='modifymail.php';
}
mysql_query($bodydet1);

?>
<html>
<head>
 <SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    	alert("Mail Template Updated Successfully");
		document.form1.action="modifymail.php";
	 	document.form1.submit();
	}
	 </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>