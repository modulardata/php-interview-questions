<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	

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
	//$adminno=$_POST['adminno'];
	$title=$_POST['title'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$login=$_POST['login'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$address=$_POST['address'];
	$phoneno=$_POST['phoneno'];
	$emailid=$_POST['emailid'];
	
	

	
	//Input Validations
	if($title == '') 
	{
		$errmsg_arr[] = '<font color=red>Title missing</font>';
		$errflag = true;
	}
	if($fname == '') 
	{
		$errmsg_arr[] = '<font color=red>First name missing</font>';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = '<font color=red>Last name missing</font>';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = '<font color=red>Login ID missing</font>';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = '<font color=red>Password missing</font>';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = '<font color=red>Confirm password missing</font>';
		$errflag = true;
	}

	if( $phoneno <= 1000000000 || $phoneno >9999999999) {
		$errmsg_arr[] = '<font color=red>Invalid Phone Number</font>';
		$errflag = true;
	}
   
    if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$emailid)) {
    /*echo "Your email is ok.";*/
    } else {
         $errmsg_arr[] = '<font color=red>Wrong email address</font>';
	     $errflag =true;
    }
	
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = '<font color=red>Passwords do not match</font>';
		$errflag = true;
	}
	/*if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: doctor.html");
		//header("location: register-exec1.php");
		exit();
	}
	*/
	
	//Check for duplicate login ID
	if($login != '') {
		$query = "SELECT * FROM admin WHERE login='$login'";
		$result = mysql_query($query);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = '<font color="red">Login ID already in use</font>';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location:aregister-form.php");
		//header("location: register-exec1.php");
		exit();
	}

	
$password=$_POST['password'];

/*
$query="insert into admin
values('adminno','$title','$fname','$lname','$login','$password','$cpassword','$address','$phoneno','$emailid')";
*/

$query="INSERT INTO admin(adminno, title, fname, lname, login, password, address, phoneno, emailid)
values('adminno','$title','$fname','$lname','$login','".md5($_POST['password'])."','$address','$phoneno','$emailid')";

	//$result = @mysql_query($query);
 
    $result=mysql_query($query);
   // $res=mysql_query($result);
    //echo ' '.$res;
	
	//Check whether the query was successful or not
	if($result) {
		header("location:aregister-success.php");
		exit();
	}else {
		die("Query failed");
	}
?>