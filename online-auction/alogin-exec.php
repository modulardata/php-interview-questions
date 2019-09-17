<?php
	
	session_start();
	

	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	

$connection=mysql_connect('localhost','root') or die('unable to connect');
        
        mysql_select_db("corner");
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
       //$login=mysql_real_escape_string($_GET['login']);
	   //$password=mysql_real_escape_string($_GET['password']);
      
	  


	$login=clean($_POST['login']);
	$password=clean($_POST['password']);
	
	//Input Validations
	/*if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}*/
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		//header("location: login-form.php");
		header("location:Administrator Login.html");
		exit();
	}
	//$p=$_GET['password'];
	//Create query


$query="SELECT * FROM admin 
WHERE login='".$_POST['login']."' AND password='".md5($_POST['password'])."'";
	
		$result=mysql_query($query);

//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_FIRST_NAME'] = $member['fname'];
			$_SESSION['SESS_LAST_NAME'] = $member['lname'];
			$_SESSION['SESS_MEMBER_ID'] = $member['login'];
			session_write_close();
			header("location:amember-index.php");
			exit();
		}else {
			//Login failed
			header("location:alogin-failed.html");
			//header("location:Administrator Login.html");
			exit();
		}
	}else {
		die("Query failed");
	}
?>