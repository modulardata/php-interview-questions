        <?php
        $selected_room = $this->session->userdata('selected_room');
        $total_amount = $selected_room['total_amount'];
        $amount = $total_amount;
        $product = 'Hotel Booking';
        $pass_info = $this->session->userdata('pass_info');
        $firstname = $pass_info['afname']['0'];
        $email = $pass_info['pemail'];
        $pmobile = $pass_info['pmobile'];
        $random = rand(000000, 9999999);
        ?>
        <?php
        /*
          The merchant developer should ensure the track id passed here is from merchant
          database
         */
        $TranTrackid = $random;
        /*
          The merchant developer should ensure the transaction amount passed here is
          from merchant database
         */
        $TranAmount = $amount;
        /* to pass Tranportal ID provided by the bank to merchant. Tranportal ID is sensitive information
          of merchant from the bank, merchant MUST ensure that Tranportal ID is never passed to customer
          browser by any means. Merchant MUST ensure that Tranportal ID is stored in secure environment &
          securely at merchant end. Tranportal Id is referred as id. Tranportal ID for test and production will be
          different, please contact bank for test and production Tranportal ID */
        $ReqTranportalId = "id=9000507";


        
        /* to pass Tranportal password provided by the bank to merchant. Tranportal password is sensitive 
information of merchant from the bank, merchant MUST ensure that Tranportal password is never passed 
to customer browser by any means. Merchant MUST ensure that Tranportal password is stored in secure 
environment & securely at merchant end. Tranportal password is referred as password. Tranportal 
password for test and production will be different, please contact bank for test and production
Tranportal password */
$ReqTranportalPassword="password=password1";

/* Amount passed here should be from merchant backend system like database and not from customer browser*/
$ReqAmount="amt=".$TranAmount;

/* Track Id passed here should be from merchant backend system like database and not from customer browser*/
$ReqTrackId="trackid=".$TranTrackid;

/* Currency code of the transaction. By default INR i.e. 356 is configured. If merchant wishes 
to do multiple currency code transaction, merchant needs to check with bank team on the available 
currency code */
$ReqCurrency="currencycode=356";

/* Transaction language, THIS MUST BE ALWAYS USA. */
$ReqLangid="langid=USA";
$url_return=WEB_URL;

/* Action Code of the transaction, this refers to type of transaction. Action Code 1 stands of 
Purchase transaction and action code 4 stands for Authorization (pre-auth). Merchant should 
confirm from Bank action code enabled for the merchant by the bank */ 
$ReqAction="action=1";


/* Response URL where Payment gateway will send response once transaction processing is completed 
Merchant MUST esure that below points in Response URL
1- Response URL must start with http://
2- the Response URL SHOULD NOT have any additional paramteres or query string  */
$ReqResponseUrl="responseURL=".$url_return."dhotel/GetHandleRESponse";

/* Error URL where Payment gateway will send response in case any issues while processing the transaction 
Merchant MUST esure that below points in ErrorURL 
1- error url must start with http://
2- the error url SHOULD NOT have any additional paramteres or query string */ 
$ReqErrorUrl="errorURL=".$url_return."dhotel/StatusTRAN";


/* User Defined Fileds as per Merchant or bank requirment. Merchant MUST ensure merchant 
merchant is not passing junk values OR CRLF in any of the UDF. In below sample UDF values 
are not utilized */
$ReqUdf1="udf1=Hotel Booking";
$ReqUdf2="udf2=".$email;
$ReqUdf3="udf3=".$pmobile;
$ReqUdf4="udf4=Bangalore";

/*
NOTE -
ME should now do the validations on the amount value set like - 
a) Transaction Amount should not be blank and should be only numeric
b) Language should always be USA
c) Action Code should not be blank
d) UDF values should not have junk values and CRLF 
(line terminating parameters)Like--> [ !#$%^&*()+[]\\\';,{}|\":<>?~` ]
*/


/*==============================HASHING LOGIC CODE START==============================================*/
	/*Below are the fields/prametres which will use for hashing using (GetSHA256) hashing 
	Algorithm,and need to pass same hashed valued in UDF5 filed only*/
	
	$strhashTID=trim("9000507"); 			 //USE Tranportal ID FIELD Value FOR HASHING 
	$strhashtrackid=trim($TranTrackid);	 //USE Trackid FIELD Value FOR HASHING 
	$strhashamt=trim($TranAmount);  		 //USE Amount FIELD Value FOR HASHING 
	$strhashcurrency=trim("356");			 //USE Currencycode FIELD Value FOR HASHING 
	$strhashaction=trim("1");				 //USE Action code FIELD Value FOR HASHING 
	
	//Create a Hashing String to Hash
	$str = trim($strhashTID.$strhashtrackid.$strhashamt.$strhashcurrency.$strhashaction);
	
	//Use hash method which is defined below for Hashing ,It will return Hashed valued of above string
	$hashstring= hash('sha256', $str); 

	$ReqUdf5="udf5=".$hashstring;      // Passed Calculated Hashed Value in UDF5 Field 
	
/*==============================HASHING LOGIC CODE END==============================================*/		

/*
ME should now do the validations on the amount value set like - 
a) Transaction Amount should not be blank and should be only numeric
b) Language should always be USA
c) Action Code should not be blank
d) UDF values should not have junk values and CRLF (line terminating parameters)Like--> [ !#$%^&*()+[]\\\';,{}|\":<>?~` ]
*/

/* Now merchant sets all the inputs in one string for passing to the Payment Gateway URL */		
$param=$ReqTranportalId."&".$ReqTranportalPassword."&".$ReqAction."&".$ReqLangid."&".$ReqCurrency."&".$ReqAmount."&".$ReqResponseUrl."&".$ReqErrorUrl."&".$ReqTrackId."&".$ReqUdf1."&".$ReqUdf2."&".$ReqUdf3."&".$ReqUdf4."&".$ReqUdf5;

/* This is Payment Gateway Test URL where merchant sends request. This is test enviornment URL, 
production URL will be different and will be shared by Bank during production movement */
$url = "https://securepgtest.fssnet.co.in/pgway/servlet/PaymentInitHTTPServlet";

/* 
Log the complete request in the log file for future reference
Now creating a connection and sending request
Note - In PHP CURL function is used for sending TCPIP request
*/
$ch = curl_init() or die(curl_error()); 
curl_setopt($ch, CURLOPT_POST,1); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$param); 
curl_setopt($ch, CURLOPT_PORT, 443); // port 443
curl_setopt($ch, CURLOPT_URL,$url);// here the request is sent to payment gateway 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0); //create a SSL connection object server-to-server
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0); 
$data1=curl_exec($ch) or die(curl_error());

curl_close($ch); 

$response = $data1;
            try
			{
				
				
				$index=strpos($response,"!-");
				$ErrorCheck=substr($response, 1, $index-1);//This line will find Error Keyword in response
				if($ErrorCheck == 'ERROR')//This block will check for Error in response
				{
					// here redirecting the error page 
					$failedurl=$url_return.'dhotel/StatusTRAN?ResTrackId='.$TranTrackid.'&ResAmount='.$TranAmount.'&ResError='.$response;
					header("location:". $failedurl );
					
												
				}
				else
				{
					// If Payment Gateway response has Payment ID & Pay page URL		
					$i =  strpos($response,":");
					// Merchant MUST map (update) the Payment ID received with the merchant Track Id in his database at this place.
					$paymentId = substr($response, 0, $i);
					$paymentPage = substr( $response, $i + 1);
					// here redirecting the customer browser from ME site to Payment Gateway Page with the Payment ID
					$r = $paymentPage . "?PaymentID=" . $paymentId;
					header("location:". $r );
				}
				
							
			}
			catch(Exception $e)
			{
				var_dump($e->getMessage());
			}