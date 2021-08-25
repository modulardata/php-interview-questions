<?php
    //Start session
	session_start();
	
	define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'file_upload');
	
	$connection=mysql_connect('localhost','root') or die('Server is busy, Please try after some time');
       
        mysql_select_db("file_upload");
?>