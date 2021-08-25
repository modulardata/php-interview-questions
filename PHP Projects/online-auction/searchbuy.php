<?php
		session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="3600" />
  <meta name="revisit-after" content="2 days" />
  <meta name="robots" content="index,follow" />
  <meta name="publisher" content="Pradeep Kumar" />
  <meta name="copyright" content="BMS Institute of Technology" />
  <meta name="author" content="Design: Pradeep Kumar  / Author: MCA 6th sem student" />
  <meta name="distribution" content="global" />
  <meta name="description" content="Design and Development of Multi-Attribute Decision making model in Reverse Auction" />
  <meta name="keywords" content="online auction,reverse auction, eprocurement ,multi-attribute reverse auction,online bidding,multi-attribute auction" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout4_setup.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout4_text.css" />
  <link rel="icon" type="image/x-icon" href="./img/auction1.png" />
  <link href="./style.css" rel="stylesheet" type="text/css" media="all">
  <script src="./cb=gapi.loaded0" async=""></script><script type="text/javascript" async="" src="./plusone.js" gapi_processed="true"></script><script type="text/javascript" src="./jquery.1.3.2.jquery.min.js"></script>
  <link href="./stylesDynamic.css" rel="stylesheet" type="text/css" media="all">
 <!-- <link href="./style/style.css" rel="stylesheet" type="text/css" media="all">-->
  <script type="text/javascript" src="./scripts.js"></script>
  <script type="text/javascript" src="./scriptSlider.js"></script>
  <link href="./stylesDynamic(1).css" rel="stylesheet" type="text/css">
  <link><link><link><link></head><body><div id="dropmenudiv" style="visibility:hidden;width:165px;background-color:#7e8aa2" onmouseover="clearhidemenu()" onmouseout="dynamichide(event)"></div>
 <script type="text/javascript">
  jQuery(document).ready(function(){
	$('#pageNav').addClass('active');
	$('#pageNav ul li:first').addClass('active');	
});
</script>
  <title>Online Auction | Bid Submission</title>
</head>
<!--###########################    CODE FOR DISABLE BACK BUTTON   #########################-->

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript">
   function disableBackButton()
   {
     window.history.forward();
   }
  
  setTimeout("disableBackButton()", 0);
  (function($) { disableBackButton(); }); 
    
var isNS = (navigator.appName == "Netscape") ? 1 : 0;

if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);

function mischandler(){
return false;
}
function mousehandler(e){
	
var myevent = (isNS) ? e : event;
var eventbutton = (isNS) ? myevent.which : myevent.button;
var eventbutton1 =  myevent.button;


if((eventbutton==2)||(eventbutton==3))
	return false;
}

document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;

</script></head>

<!-------------------------------------------------------------------------->

<!-- Global IE fix to avoid layout crash when single word size wider than column width -->
<!--[if IE]><style type="text/css"> body {word-wrap: break-word;}</style><![endif]-->

<body>
  <!-- Main Page Container -->
  <div class="page-container">

   <!-- For alternative headers START PASTE here -->

    <!-- A. HEADER -->      
    <div class="header">
      
      <!-- A.1 HEADER TOP -->
      <div class="header-top">
        
        <!-- Sitelogo and sitename -->
        <a class="sitelogo" href="#" title="Go to Start page"></a>
        <div class="sitename">
          <h1><a href="index.html" title="Go to Start page">Online Auction<span style="font-weight:normal;font-size:50%;"></span></a></h1>
          <h2></h2>
        </div>
    
        <!-- Navigation Level 0 -->
        <div class="nav0">
          <ul>
		   <li><a href="#" title="home in India"><img src="./img/flag_India.jpg" alt="Image description" /></a></li>
            <li><a href="#" title="Pagina home in Italiano"><img src="./img/flag_italy.gif" alt="Image description" /></a></li>
            <li><a href="#" title="Homepage auf Deutsch"><img src="./img/flag_germany.gif" alt="Image description" /></a></li>
            <li><a href="#" title="Hemsidan p&aring; svenska"><img src="./img/flag_sweden.gif" alt="Image description" /></a></li>
          </ul>
        </div>			

        <!-- Navigation Level 1 -->
        <div class="nav1">
          <ul>
            <li><a href="../r/home.html" title="Go to Start page">Home</a></li>
            <li><a href="../r/index.html" title="Get to know who we are">About</a></li>
            <li><a href="http://localhost/r/Contact Us.php" title="Get in touch with us">Contact</a></li>																		
            <li><a href="afterNews.html" title="Get an overview of Procurement Process">Help</a></li>
          </ul>
        </div>              
      </div>
      
     <!--########################    SLIDING HEADER   ######################-->
     
	  
   <div id="pageBanner">
        	<div class="pageBannerContent">
            	<div id="gallery">
                    <div id="slides" style="width: 4990px; margin-left: -1810.2179892840595px; ">
                        <div class="pageBannerInnerCont" style="">
                            <h3>EXTENSIVE SUPPLIER DATABASE</h3>
                            <p>Whether you are a manufacturer, distributor or a service provider we can provide that vital link to a large community of Buyers that could mean increased business opportunities for you.
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="pageBannerInnerCont bannerTwo" style="">
                            <h3>ONLINE REQUEST</h3>
                            <p>Do you need help sourcing new Suppliers for a contract you have available? Use our expertise and experience to help you with cross border sourcing.
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="pageBannerInnerCont bannerThree" style="">
                            <h3>SUPPLIER SCAN REPORTS</h3>
                            <p>Do you already know the suppliers in the market but need extra information, take a look at our available reports.
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="pageBannerInnerCont bannerFour" style="">
                            <h3>CROSS-BORDER SOURCING</h3>
                            <p>Are you a professional Buyer and need help in locating new suppliers for a contract you have available, then search our extensive database and find the right suppliers you need.
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="pageBannerInnerCont bannerFive" style="">
                            <h3>eTENDERING TOOL</h3>
                            <p>Deliver increased savings by using our self-service, on demand and low-cost eSourcing Tool to create your own specific RFI, RFP or RFQ to evaluate and compare your Suppliers.
                            </p>
                            <div class="clear"></div>
                        </div>
                    </div>
             	</div>
				
		<a href="../r/index.html" title="register today"><script type="text/javascript">writePngImage('/r/img/bgRegister.png', 145, 63, 'register today');</script><img alt="Register Today" src="../r/img/bgRegister.png" style="width: 145px; height: 63px;"></a>
                <div class="bannerNav">
                	<ul>
                		                    		<li class="menuItem"><a href="#">Extensive Supplier </a><span>bg</span></li>
                		                		
                		                		
                		                        	<li class="menuItem"><a href="#">Online Request</a><span>bg</span></li>
                                                
                                                
                                                	
                        	<li class="menuItem active "><a href="#">Supplier Scan Reports</a><span>bg</span></li>
                        	
                                                	<li class="menuItem"><a href="#">Cross-border Sourcing</a><span>bg</span></li>
                                                
                                                
                        	
                        	<li class="menuItem"><a href="#">eTendering Tool</a><span>bg</span></li>
                                                
                                                
                        	
                    </ul>
                </div> 
            </div>        
      	</div> 

<!--------------------------------------------------------------------------->
	 
      
      <!-- A.3 HEADER BOTTOM -->
      <div class="header-bottom">
      
        <!-- Navigation Level 2 (Drop-down menus) -->
        <div class="nav2">
	
            <!-- Navigation item -->
          <ul>
            <li><a href="../r/home.html">Home</a></li>
          </ul>
          
          <!-- Navigation item -->
          <ul>
            <li><a href="#">Buyer<!--[if IE 7]><!--></a><!--<![endif]-->
              <!--[if lte IE 6]><table><tr><td><![endif]-->
                <ul>
                  <li><a href="buyer.html">Buyer</a></li>
                  <li><a href="Buyer Agreement.html">Register</a></li>
                  
				  <li><a href="benefits.html">Buyer Benefits</a></li>
				  
                                                    
                </ul>
              <!--[if lte IE 6]></td></tr></table></a><![endif]-->
            </li>
          </ul>          

          <!-- Navigation item -->
          <ul>
            <li><a href="#">Supplier<!--[if IE 7]><!--></a><!--<![endif]-->
              <!--[if lte IE 6]><table><tr><td><![endif]-->
                <ul>
                  <li><a href="supplier.html">Supplier</a></li>
                  <li><a href="Supplier Agreement.html">Register</a></li>
                  
				  <li><a href="afterNews.html">Futured Suppliers</a></li>
                </ul>
              <!--[if lte IE 6]></td></tr></table></a><![endif]-->
            </li>
          </ul> 
         </li>
        </ul> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<script src="script.js" type="text/javascript" align="right"></script>
   
<!--###########################   CODE FOR DYNAMIC CLOCK   ###########################-->

<!--<head>
<script type="text/javascript">
function clock1()
 {
  
   var d=new Date();
   var t=d.toLocaleTimeString();
   document.myform.txt.value=t;
   setTimeout("clock1()",1000);


  }
</script>
</head>

<form name="myform">
<center><input type="text" id="txt" size=4 /></center>
<body onload="clock1()"></body>
</form>
        
<!----------------------------------------------------------------------------------------->         
		 
		 
        </div>
	  </div>

      <!-- A.4 HEADER BREADCRUMBS -->

      <!-- Breadcrumbs -->
      <div class="header-breadcrumbs">
        <ul>
          <li><a href="../r/home.html">Home&nbsp;</a></li>
          <li><a href="../r/index.html">About Us&nbsp;</a></li>
          <li><a href="http://localhost/r/Contact Us.php">Contact&nbsp;</a></li>
         
        </ul>

        <!----------- SEARCH FORM ---------------->    
		
        <div class="searchform">
          <form action="#" method="get" class="form">
            <fieldset>
              <input value=" Search..." name="field" class="field" />
              <input type="submit" value="GO!" name="button" class="button" />
            </fieldset>
          </form>
        </div>
		</div>
	 </div>
		
    

    <!-- For alternative headers END PASTE here -->

    <!-- B. MAIN -->
    <div class="main">
 
      <!-- B.1 MAIN NAVIGATION -->
      <div class="main-navigation">

        <!-- Navigation Level 3 -->
        <div class="round-border-topright"></div>
        <h1 class="first">Sign in Here</h1>

        <!-- Navigation with grid style -->
        <dl class="nav3-grid">
          <dt><a href="http://localhost/r/product.php">Post new bid</a></dt>
          <dt><a href="http://localhost/r/bidstatus.php">View bid status</a></dt>
          <dt><a href="#">winner information</a></dt>
          <dt><a href="#">Invoice details</a></dt>
		  <dt><a href="#">Close bid</a></dt>
		  <dt><a href="http://localhost/r/logout.php">Logout</a></dt>
		 <dt><a href="#"></a></dt>
        </dl> 
		
        
      </div>
 
      <!-- B.2 MAIN CONTENT -->
      <div class="main-content">
        
        <!-- Pagetitle -->
        <h1 class="pagetitle">Bid Submission Page</h1>

 <!--######################  BID SUBMISSION PAGE  ##################-->

        

      <div class="column1-unit"><table><tr>
<!--<td valign="top" style="padding-left: 5px; text-align: justify;">-->
<p><font color=red>                          </font></p>

     <h1 class="block">Bid Remaining Time</h1>
                                   
 <?php
         
$connection=mysql_connect('localhost','root') or die('unable to connect'); 
        mysql_select_db("corner");



	  $result=mysql_query("select buyerno from buyer where login='".$_SESSION['SESS_MEMBER_ID']."'");
	  
	if ($result && mysql_num_rows($result) > 0) {
    $query_data=mysql_fetch_array($result);
    $buyerno=$query_data["buyerno"];
  }

//echo "<p>The BUYER LOGIN is: $buyerno </p>";

############ SET DEFAULT SERVER TIME-ZONE  ############### 

  $curdate=date('Y-m-d H:i:s');

  date_default_timezone_set('Asia/Calcutta');
  $date = date('m/d/Y h:i:s a', time());
  
  $timezone = date_default_timezone_get();
  //echo "The current server timezone is: " . $timezone;

########################################################## 

   $buyerno=$buyerno;
   $name=$_POST['name'];
   $brand=$_POST['brand'];
   $size=$_POST['size'];
   $quantity=$_POST['quantity'];
   $day=$_POST['day'];
   $month=$_POST['month'];
   $year=$_POST['year'];
   $hour=$_POST['hour'];
   $minute=$_POST['minute'];
   $second=$_POST['second'];

/*  
$query="insert into bid
 values('bid_id','$buyerno','$name','$brand','$size','$quantity','$day','$month','$year','$hour','$minute','$second')"; 
        
	$ins=mysql_query($query);
    $result=mysql_query($ins);
   // echo ' '.$res;
  */ 
   //mysql_free_result($result);
 /* mysql_close($connection);
  
?>



<?php

$connection=mysql_connect('localhost','root') or die('unable to connect'); 
        mysql_select_db("corner");   */



/*// Define your target date here
	$targetYear  = $_POST['year'];;
	$targetMonth = $_POST['month'];;
	$targetDay   = $_POST['day'];
	$targetHour  = $_POST['hour'];
	$targetMinute= $_POST['minute'];
	$targetSecond= $_POST['second'];
// End target date definition */

// Define date format
$dateFormat = "Y-m-d H:i:s";

$targetDate = mktime($hour,$minute,$second,$month,$day,$year);
$actualDate = time();

$secondsDiff = $targetDate - $actualDate;

 if($secondsDiff < 0 )
  {
	   ?>
		<body>
		<script type="text/javascript">

			 document.write("<h5><font color=red>Invalid Bid Closing Time</font></h5>");

		</script>
		<body>
		<?php

			goto exit_label;
	   }


$remainingDay     = floor($secondsDiff/60/60/24);
$remainingHour    = floor(($secondsDiff-($remainingDay*60*60*24))/60/60);
$remainingMinutes = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))/60);
$remainingSeconds = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))-($remainingMinutes*60));

$targetDateDisplay = date($dateFormat,$targetDate);
$actualDateDisplay = date($dateFormat,$actualDate);


$query="insert into bid (bid_id, buyerno, name, brand, size, quantity, bid_start, day, month, year, hour, minute, second)
 
 VALUES('bid_id','$buyerno','$name','$brand','$size','$quantity',NOW(),'$day','$month','$year','$hour','$minute','$second')"; 
        
	$ins=mysql_query($query);
    $result=mysql_query($ins);


		mysql_close($connection);
?>

<!--------------------------------------------------------------------------->
<head>
<script type="text/javascript">

  var days = <?php echo $remainingDay; ?>  
  var hours = <?php echo $remainingHour; ?>  
  var minutes = <?php echo $remainingMinutes; ?>  
  var seconds = <?php echo $remainingSeconds; ?>  

function setCountDown()
{
  seconds--;
  if (seconds < 0){
      minutes--;
      seconds = 59
  }
  if (minutes < 0){
      hours--;
      minutes = 59
  }
  if (hours < 0){
      days--;
      hours = 23
  }
  document.getElementById("remain").innerHTML = days+" days, "+hours+" hours, "+minutes+" minutes, "+seconds+" seconds";
   setTimeout ( "setCountDown()", 1000 );
}

</script>
</head>

<body onload="setCountDown();">
<br/><br/>
<div id="container">
	<div id="header"><div id="header_left"></div>
	<div id="header_main">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<!--Bid Closing Time<!--</div><div id="header_right"></div></div>-->
    <!--<div id="content">-->
       <!-- <table class="countTable">-->
           <tr><td>Closing date:</td><td><?php echo $targetDateDisplay; ?></td></tr>
           <tr><th colspan="2" id="remain"><?php echo "$remainingDay days, $remainingHour hours, $remainingMinutes minutes, $remainingSeconds seconds";?></th></tr>
           <tr><td>Actual date:</td><td><?php echo $actualDateDisplay; ?></td></tr>
       </table>
    </div>
   <div id="footer"><a href="#" target="_blank"></a></body>
<!----------------------------------------------------------------------------------------->
</span></td>
        </tr>
      
      <tr>
        <td><div align="right"></div></td>
        <td colspan="2"><form id="form3" name="form3" method=post action="http://localhost/r/bidstatus.php">
          <label><span class="style4">                      </span>
         <!-- <center><input type="submit" name="Submit2" value="View Bid Status" /></center>-->
          </label>
        </form>
		
		<?php

      exit_label:
?>
		
		</td>
        </tr>
</td></tr></table>




</div></div>



<!-------------------------------------------------------------------------->

 <!-- B.3 SUBCONTENT -->
      <div class="main-subcontent">

        <!-- Subcontent unit -->
        <div class="subcontent-unit-border">
          <div class="round-border-topleft"></div><div class="round-border-topright"></div>
          <h1 class="green">Buyer Options</h1>
          <p>Buyer can give their requirement after  filling registration form.</p>
          <p>He has a option to give req according to their owm choice.</p>
          <p>After bidding process,buyer will get alert for supplier details.</p>
        </div>

        <!-- Subcontent unit -->
        <div class="subcontent-unit-border">
          <div class="round-border-topleft"></div><div class="round-border-topright"></div>
          <h1 class="green">Supplier Options</h1>
          <p>All the intersted supplier should have to register before bid.</p>   
          <p>If the supplier will agree with all the terms and condition then only they will allow to bid for that.</p>
          <p>After limited time period winner will be announced.</p>
        </div>

        <!--################   PRODUCT ADVERTISEMENT CODE   #############-->

      

       <div class="subcontent-unit-border-orange">
          <div class="round-border-topleft"></div><div class="round-border-topright"></div>
          <h1 class="orange">Advertisement</h1>


	             <tr>
					<td valign="top" align="middle" width="100%" height="100"><iframe name="news" id="news" border="0" src="./news.htm" frameborder="0" width="180" scrolling="no" height="200"> </iframe>&nbsp;
					</td>
				</tr></div>
			<!--</tbody></table>-->


        <!-- Subcontent unit -->
        <div class="subcontent-unit-border-green">
          <div class="round-border-topleft"></div><div class="round-border-topright "></div> 
          <h1 class="green" >It's free!</h1>
          <p>Enjoy the bidding process. There are no restrictions in the license. As a sign of appreciation, please keep the author credits "<a href="http://www.1-2-3-4.info">Design by Pradeep Kumar .</a>" Thanks!</p>
        </div>
      </div>
    </div>
        
      
    <!--###########   FOOTER AREA   ###########-->      

    <div class="footer">
      <p>Copyright &copy; 2012 BMS Institute of Technology | All Rights Reserved</p>
      <p class="credits">Original design by : <a href="http://www.bmsit.org.in" title="Designer Homepage">Pradeep Kumar</a> | USN : <a href="http://www.bmsit.org.in" title="Designer Homepage">1BY09MCA28</a></p>
    </div>      
  </div> 
</body>
</html>



