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
		
	$bodydet1="INSERT INTO `mail_det` (`mail_subject`, `mail_content`, `status`, `mail_date`, `username`, `count`) VALUES
( '".$subject."', '".$bodydet."', '1', '".$datedet."', '".$user."', 0)";

mysql_query($bodydet1) or die(mysql_error());

	exit;
	
	
}
header('Location: ../../output_html.php');

?>