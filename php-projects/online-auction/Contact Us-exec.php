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
	$company=$_POST['company'];
	$title=$_POST['title'];
	$fname=$_POST['fname'];
	$fyname=$_POST['fyname'];
	$address=$_POST['address'];
	$phoneno=$_POST['phoneno'];
	$emailid=$_POST['emailid'];
	$subject=$_POST['subject'];
	$urgency=$_POST['urgency'];
	$message=$_POST['message'];

	
	

	
	//Input Validations
	if($company == '') 
	{
		$errmsg_arr[] = '<font color=red>Company name missing</font>';
		$errflag = true;
	}
	if($title == '') {
		$errmsg_arr[] = '<font color=red>Title missing</font>';
		$errflag = true;
	}
	if($fname == '') {
		$errmsg_arr[] = '<font color=red>First name missing</font>';
		$errflag = true;
	}
	if($fyname == '') {
		$errmsg_arr[] = '<font color=red>Family name missing</font>';
		$errflag = true;
	}
	if($address == '') {
		$errmsg_arr[] = '<font color=red>Address missing</font>';
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
	if($subject == '') {
		$errmsg_arr[] = '<font color=red>Subject missing</font>';
		$errflag = true;
	}
	if($urgency == '') {
		$errmsg_arr[] = '<font color=red>Urgency missing</font>';
		$errflag = true;
	}
	if($message == '') {
		$errmsg_arr[] = '<font color=red>Message missing</font>';
		$errflag = true;
	}

	
	
	//Check for duplicate login ID
	if($login != '') {
		$query = "SELECT * FROM contact WHERE phoneno='$phoneno'";
		$result = mysql_query($query);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = '<font color="red">Your Message has been send all ready</font>';
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
		header("location:Contact Us.php");
		//header("location: register-exec1.php");
		exit();
	}

	
//$password=$_POST['password'];
$query="insert into contact
values('$company','$title','$fname','$fyname','$address','$phoneno','$emailid','$subject','$urgency','message')";
	
	//$result = @mysql_query($query);
 
    $result=mysql_query($query);
   // $res=mysql_query($result);
    //echo ' '.$res;
	
	//Check whether the query was successful or not
	if($result) {
		header("location:Contact Us-success.php");
		exit();
	}else {
		die("Query failed");
	}
?>