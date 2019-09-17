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
//die();
?>




<?php
/*
session_start();
function send_msg($phonenumber,$contant)
{
	
$text=urlencode("xxx");
// Initialize the sender variable
$sender=urlencode("xxxxx");
// Initialize the URL variable
$URL="www.unicel.in/SendSMS/sendmsg.php";
// Create and initialize a new cURL resource
$ch = curl_init();
// Set URL to URL variable
curl_setopt($ch, CURLOPT_URL,"http://$URL");
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
	/*$senderid=$_SESSION['user'];
	//Please Enter Your Details
	 $user="thoughtfocus"; //your username
	 $password="renewind6"; //your password
	 $mobilenumbers="$phonenumber"; //enter Mobile numbers comma seperated
	 $message = "$contant"; //enter Your Message 
	 $messagetype="N"; //Type Of Your Message
	 $DReports="Y"; //Delivery Reports
	 $url="http://www.smscountry.com/SMSCwebservice.asp";
	 $message = urlencode($message);
	 $ch = curl_init(); 
	 if (!$ch){die("Couldn't initialize a cURL handle");}
	 $ret = curl_setopt($ch, CURLOPT_URL,$url);
	 curl_setopt ($ch, CURLOPT_POST, 1);
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	 curl_setopt ($ch, CURLOPT_POSTFIELDS, 
	"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
	 $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


	//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
	// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");



	 $curlresponse = curl_exec($ch); // execute
	if(curl_errno($ch))
		echo 'curl error : '. curl_error($ch);

	 if (empty($ret)) 
	 {
		// some kind of an error happened
		die(curl_error($ch));
		curl_close($ch); // close cURL handler
	 } 
	 else 
	 {
		$info = curl_getinfo($ch);
		curl_close($ch); // close cURL handler
		//echo "<br>";
		$curlresponse=$curlresponse."<br>$phonenumber  $contant";    //echo "Message Sent Succesfully" ;
	 }
	 
	
		return($curlresponse);
}*/
?>