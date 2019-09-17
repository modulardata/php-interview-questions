<?php
function send_msg($phonenumber,$contant)
{
	//$text=urlencode("xxx");
	// Initialize the sender variable
	//$sender=urlencode("xxxxx");
	// Initialize the URL variable
	//$URL="www.unicel.in/SendSMS/sendmsg.php";
	// Create and initialize a new cURL resource
	if($phonenumber!='' and $phonenumber!=0)
	{
		$ch = curl_init();
		// Set URL to URL variable
		curl_setopt($ch, CURLOPT_URL,"http://www.unicel.in/SendSMS/sendmsg.php");
		// Set URL HTTP post to 1
		curl_setopt($ch, CURLOPT_POST, 1);
		// Set URL HTTP post field values
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		"uname=ThFoEd&pass=Focus&send=Promo&dest=$phonenumber&msg=$contant");
		// Set URL return value to True to return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// The URL session is executed and passed to the browser
		$curl_output =curl_exec($ch);
			
		$curlresponse=$curl_output ;	
	}
}	
function send_mail_msg($phonenumber,$contant,$mailid,$mailsubject,$mailcontent)
{
	//$text=urlencode("xxx");
	// Initialize the sender variable
	//$sender=urlencode("xxxxx");
	// Initialize the URL variable
	//$URL="www.unicel.in/SendSMS/sendmsg.php";
	// Create and initialize a new cURL resource
	if($phonenumber!='' and $phonenumber!=0)
	{
		$ch = curl_init();
		// Set URL to URL variable
		curl_setopt($ch, CURLOPT_URL,"http://www.unicel.in/SendSMS/sendmsg.php");
		// Set URL HTTP post to 1
		curl_setopt($ch, CURLOPT_POST, 1);
		// Set URL HTTP post field values
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		"uname=ThFoEd&pass=Focus&send=Promo&dest=$phonenumber&msg=$contant");
		// Set URL return value to True to return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// The URL session is executed and passed to the browser
		$curl_output =curl_exec($ch);
			
		$curlresponse=$curl_output ;	
	}
//mail class
	require("mail/class.phpmailer.php");

  /* Uncomment when using SASL authentication mechanisms */
	
	require("mail/class.smtp.php");
	

	$from = "navinsullia@gmail.com";                           /* Change this to your address like "me@mydomain.com"; */
	$sender_line=__LINE__;
	
	$to   = "$mailid";                             /* Change this to your test recipient address */ 
	$recipient_line=__LINE__;

	if(strlen($from)==0)
		die("Please set the messages sender address in line ".$sender_line." of the script ".basename(__FILE__)."\n");
	if(strlen($to)==0)
		die("Please set the messages recipient address in line ".$recipient_line." of the script ".basename(__FILE__)."\n");

	$smtp=new smtp_class;

	$smtp->host_name="smtp.gmail.com";       /* Change this variable to the address of the SMTP server to relay, like "smtp.myisp.com" */
	$smtp->host_port=465;                /* Change this variable to the port of the SMTP server to use, like 465 */
	$smtp->ssl=1;                       /* Change this variable if the SMTP server requires an secure connection using SSL */
	$smtp->start_tls=0;                 /* Change this variable if the SMTP server requires security by starting TLS during the connection */
	$smtp->localhost="localhost";       /* Your computer address */
	$smtp->direct_delivery=0;           /* Set to 1 to deliver directly to the recepient SMTP server */
	$smtp->timeout=10;                  /* Set to the number of seconds wait for a successful connection to the SMTP server */
	$smtp->data_timeout=0;              /* Set to the number seconds wait for sending or retrieving data from the SMTP server.
	                                       Set to 0 to use the same defined in the timeout variable */
	$smtp->debug=1;                     /* Set to 1 to output the communication with the SMTP server */
	$smtp->html_debug=1;                /* Set to 1 to format the debug output as HTML */
	$smtp->pop3_auth_host="";           /* Set to the POP3 authentication host if your SMTP server requires prior POP3 authentication */
	$smtp->user="navinsullia";                     /* Set to the user name if the server requires authetication */
	$smtp->realm="gmail.com";                    /* Set to the authetication realm, usually the authentication user e-mail domain */
	$smtp->password="navinsullia!@#";                 /* Set to the authetication password */
	$smtp->workstation="";              /* Workstation name for NTLM authentication */
	$smtp->authentication_mechanism="PLAIN"; /* Specify a SASL authentication method like LOGIN, PLAIN, CRAM-MD5, NTLM, etc..
	                                       Leave it empty to make the class negotiate if necessary */
	$contant="http://localhost/mbis/renew/studatt/p_Marks_Attendance2.php?user=MBIS131";
	if($smtp->direct_delivery)
	{
		if(!function_exists("GetMXRR"))
		{
			$_NAMESERVERS=array();
			include("mail/getmxrr.php");
		}
	}

	if($smtp->SendMessage(
		$from,
		array(
			$to
		),
		array(
			"From: $from",
			"To: $to",
			"Subject: $mailsubject",
			"Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")
		),
		"". $mailcontent." \n")
		)
		
		echo " ";
	else
		echo "\n";




//mail class end
}
//die();
?>




