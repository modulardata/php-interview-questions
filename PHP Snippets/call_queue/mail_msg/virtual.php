<?php
//function send_msg($phonenumber,$contant)

	$msgcot=str_split($_REQUEST['msg'],3);//str_split($str, 3);
	if($msgcot[0]=='TAT')
	{
		//echo "testatsms.aceweb.in".$_REQUEST['msg'];
		header('Location: http://testatsms.aceweb.in/Parse.aspx?sender='.$_REQUEST[sender].'&msg='.$_REQUEST[msg].'');
		
	}
	if($msgcot[0]=='PAT')
	{
		//echo "atsms.aceweb.in".$_REQUEST['msg'];
		header('Location: http://atsms.aceweb.in/Parse.aspx?sender='.$_REQUEST[sender].'&msg='.$_REQUEST[msg].'');

	}
	if($msgcot[0]!='TAT' and $msgcot[0]!='PAT')
	{
		$phonenumber='8050458035';
		//sender=%S&msg=%M&dest=%D
		$contant="Announcement SENDER NUMBER (".$_REQUEST['sender'].") MSG(".$_REQUEST['msg'].")";
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
?>