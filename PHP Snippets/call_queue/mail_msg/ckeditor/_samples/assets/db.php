<?php
session_start();
$con  = mysql_pconnect("localhost",'root','')
	 or die("<b>Cannot open connection to database</b>.");
	
	mysql_select_db("test")

	 or die("<b>could not select database</b>.");

?>