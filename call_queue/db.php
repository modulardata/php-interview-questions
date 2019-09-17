<?php
$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];

session_start();

	$con  = mysql_pconnect("localhost","root","")
	 or die("<b>Cannot open connection to database</b>.");
	
	mysql_select_db("renew_smu")

	 or die("<b>could not select database</b>.");


?>