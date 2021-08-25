<?php
	session_start();
	include("../../db1.php");
	$id=$_REQUEST['id'];
	$mailid=$_REQUEST['mailid'];
	$sql=mysql_fetch_row(mysql_query("select mail_count from mail_sent_count where to_mail_id='$mailid' and mail_det_id='$id'"));				
	$newid=$sql[0]+1;
	mysql_query("update mail_sent_count set mail_count='$newid' where to_mail_id='$mailid' and mail_det_id='$id'");
			
?>