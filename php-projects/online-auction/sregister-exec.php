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

  #############  CONTACT PERSON  ############
	
	//$sellerno=$_POST['sellerno'];
    $title=$_POST['title'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$login=$_POST['login'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$address=$_POST['address'];
	$fax=$_POST['fax'];
	$phoneno=$_POST['phoneno'];
	$emailid=$_POST['emailid'];
    $subject=$_POST['subject'];
	$urgency=$_POST['urgency'];
	$message=$_POST['message'];

  ###########	COMPANY DETAILS  ###############
	
	$company=$_POST['company'];
	$website=$_POST['website'];
	$street=$_POST['street'];
	$postal=$_POST['postal'];
	$city=$_POST['city'];
	$ophoneno=$_POST['ophoneno'];
	$country=$_POST['country'];

 ##########  ADMINISTRATIVE DETAILS  ##############	
	
	$lform=$_POST['lform'];
	$id=$_POST['id'];
	$taxid=$_POST['taxid'];
	$vatid=$_POST['vatid'];
	$exp=$_POST['exp'];
	$client=$_POST['client'];
	$certified=$_POST['certified'];
    $revenu=$_POST['revenu'];
	$pcapacity=$_POST['pcapacity'];
	
	
	

	
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
	if($address == '') {
		$errmsg_arr[] = '<font color=red>Address Field missing</font>';
		$errflag = true;
	}
	if($fax == '') {
		$errmsg_arr[] = '<font color=red>Fax field missing</font>';
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
		$errmsg_arr[] = '<font color=red><h3><b>Passwords do not match !!!</b></h3></font>';
		$errflag = true;
	}
	/*if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location:#");
		//header("location: register-exec1.php");
		exit();
	}
	*/
	if($subject == '') {
		$errmsg_arr[] = '<font color=red>Subject Field missing</font>';
		$errflag = true;
	}
	if($urgency == '') {
		$errmsg_arr[] = '<font color=red>Reply Field missing</font>';
		$errflag = true;
	}
	if($message == '') {
		$errmsg_arr[] = '<font color=red>Message missing</font>';
		$errflag = true;
	}
	if($company == '') {
		$errmsg_arr[] = '<font color=red>Company name missing</font>';
		$errflag = true;
	}
	if($website == '') {
		$errmsg_arr[] = '<font color=red>Website Field missing</font>';
		$errflag = true;
	}
	if($street == '') {
		$errmsg_arr[] = '<font color=red>Street Field missing</font>';
		$errflag = true;
	}
	if($postal == '') {
		$errmsg_arr[] = '<font color=red>Postal Code missing</font>';
		$errflag = true;
	}
	if($city == '') {
		$errmsg_arr[] = '<font color=red>City Field missing</font>';
		$errflag = true;
	}
	if($ophoneno == '') {
		$errmsg_arr[] = '<font color=red>Office No missing</font>';
		$errflag = true;
	}
	if($country == '') {
		$errmsg_arr[] = '<font color=red>Country Field missing</font>';
		$errflag = true;
	}
	if($lform == '') {
		$errmsg_arr[] = '<font color=red>Legal Form missing</font>';
		$errflag = true;
	}
	if($id == '') {
		$errmsg_arr[] = '<font color=red>ID Field missing</font>';
		$errflag = true;
	}
	if($taxid == '') {
		$errmsg_arr[] = '<font color=red>TAX ID Field missing</font>';
		$errflag = true;
	}
	if($vatid == '') {
		$errmsg_arr[] = '<font color=red>VAT ID Field missing</font>';
		$errflag = true;
	}
	if($exp == '') {
		$errmsg_arr[] = '<font color=red>Experience Field missing</font>';
		$errflag = true;
	}
	if($client == '') {
		$errmsg_arr[] = '<font color=red>Client Field missing</font>';
		$errflag = true;
	}
	if($certified == '') {
		$errmsg_arr[] = '<font color=red>Company Cetrified missing</font>';
		$errflag = true;
	}
	if($revenu == '') {
		$errmsg_arr[] = '<font color=red>Revenu Field missing</font>';
		$errflag = true;
	}
	if($pcapacity == '') {
		$errmsg_arr[] = '<font color=red>Production Capacity missing</font>';
		$errflag = true;
	}
	
	//Check for duplicate login ID
	if($login != '') {
		$query = "SELECT * FROM sellerl WHERE login='$login'";
		$result = mysql_query($query);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed(register-exec-1)");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location:sregister-form.php");
		//header("location: register-exec1.php");
		exit();
	}

	
$password=$_POST['password'];

/*
$query="insert into sellerl
values('sellerno','$title','$fname','$lname','$login','$password','$cpassword','$address','$fax','$phoneno','$emailid','$subject','$urgency','$message','$company','$website','$street','$postal','$city','$ophoneno','$country','$lform','$id','$taxid','$vatid','$exp','$client','$certified','$revenu','$pcapacity')";
*/

$query="INSERT INTO sellerl(sellerno, title, fname, lname, login, password, address, fax, phoneno, emailid, subject, urgency, message, company, website, street, postal, city, ophoneno, country, lform, id, taxid, vatid, exp, client, certified, revenu, pcapacity)

values('sellerno','$title','$fname','$lname','$login','".md5($_POST['password'])."','$address','$fax','$phoneno','$emailid','$subject','$urgency','$message','$company','$website','$street', '$postal', '$city', '$ophoneno', '$country', '$lform', '$id', '$taxid', '$vatid', '$exp','$client','$certified','$revenu','$pcapacity')";

	//$result = @mysql_query($query);
 
    $result=mysql_query($query);
   // $res=mysql_query($result);
    //echo ' '.$res;
	
	//Check whether the query was successful or not
	if($result) {
		header("location:sregister-success.php");
		exit();
	}else {
		die("Query failed(register-exec-2)");
	}
?>