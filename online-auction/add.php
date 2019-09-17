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
  <meta name="author" content="Design: Pradeep Kumar www.bmsit.org.in / Author: MCA 6th sem student" />
  <meta name="distribution" content="global" />
  <meta name="description" content="Design and Development of Multi-Attribute Decision making model in Reverse Auction" />
  <meta name="keywords" content="online auction,reverse auction, eprocurement ,multi-attribute reverse auction,online bidding,multi-attribute auction" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout2_setup.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout2_text.css" />
  <link rel="icon" type="image/x-icon" href="./img/auction1.png" />
  <link href="./style.css" rel="stylesheet" type="text/css" media="all">
  <script src="./cb=gapi.loaded0" async=""></script><script type="text/javascript" async="" src="./plusone.js" gapi_processed="true"></script><script type="text/javascript" src="./jquery.1.3.2.jquery.min.js"></script>
  <link href="./stylesDynamic.css" rel="stylesheet" type="text/css" media="all">
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

  <title>Online Auction | Supplier Information</title>
</head>
<!--##############   CODE FOR DISABLE BACK BUTTON  ###############-->

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
   
<!--####################   CODE FOR DYNAMIC CLOCK   ####################-->
<head>
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
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="txt" size=4 />
<body onload="clock1()"></body>
</form>
        
<!---------------------------------------------------------->         
		 
		 
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

        <!--###############   SEARCH FORM   ##################-->    
		
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
          <dt><a href="../r/Administrator Login.html">Admin Login</a></dt>
          <dt><a href="../r/Supplier Login.html">Supplier Login</a></dt>
          <dt><a href="../r/Buyer Login.html">Buyer Login</a></dt>
          <dt><a href="http://localhost/r/logout.php">Logout</a></dt>
		  
        </dl> 
 
      </div>
 
      <!-- B.2 MAIN CONTENT -->
      <div class="main-content">
        
        <!-- Pagetitle -->
        <h1 class="pagetitle">Supplier Information</h1>

<!--#####################    SUPPLIER INFORMATION   ####################-->


 <div class="column1-unit"><!--<br/><table><tr>
<td valign="top" style="padding-left: 5px; text-align: justify;">-->
                                    
 <?php

		
	 $connection=mysql_connect('localhost','root') or die('unable to connect');
        #echo 'select the database';
        mysql_select_db("corner");

        
		$bid_id1=$_POST['bid_id'];
		$name=$_POST['name'];
		$price=$_POST['price'];
        $discount=$_POST['discount'];
		$warranty=$_POST['warranty'];
		$freeshipment=$_POST['freeshipment'];


		//echo $bid_id1;

	 //Check Supplier ID who already given bid

 	  // if($buyerno != '') {

		//$result = "SELECT bid_id FROM seller WHERE bid_id=1";

	  $result=mysql_query("select sellerno from sellerl where login='".$_SESSION['SESS_MEMBER_ID']."'");
	  
	  if ($result && mysql_num_rows($result) > 0) {
      $query_data=mysql_fetch_array($result);
      $sellerno1=$query_data["sellerno"];
    }


	$result=mysql_query("select bid_id from seller where bid_id='$bid_id1' AND sellerno='$sellerno1'"); 

       $row=mysql_fetch_array($result); 
       $bid_id=stripslashes($row['bid_id']); 
       
 
      //echo "<p>The bid_id : $bid_id</p>";
	
		
		$result=mysql_query("select sellerno from seller where sellerno='$sellerno1'"); 
       $row=mysql_fetch_array($result); 
       $sellerno2=stripslashes($row['sellerno']); 
       
 
      // echo "<p>The bid_id : $bid_id1</p>";

	  $result=mysql_query("select login from sellerl where login='".$_SESSION['SESS_MEMBER_ID']."'");
	  
	  if ($result && mysql_num_rows($result) > 0) {
      $query_data=mysql_fetch_array($result);
      $login1=$query_data["login"];
    }

	// echo "<p>The BID ID  : $bid_id</p>";
	// echo "<p>The BID ID 1: $bid_id1</p>";
	// echo "<p>The SELLER 1: $sellerno1</p>";
	// echo "<p>The SELLER 2: $sellerno2</p>";

	  $login=$_SESSION['SESS_MEMBER_ID'];

	   if($bid_id1 == $bid_id && $sellerno2 == $sellerno1) 
	   {

		  
		 ?>
		<body>
		<script type="text/javascript">

			 document.write("<h5><font color=red>You have already given bid for this Bid ID</font></h5>");

		</script>
		<body>
		<?php

			goto print_table;
	   }

			
		
		/*if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = '<font color="red">You have already given Bid For this ID</font>';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}*/


	$result=mysql_query("select sellerno from sellerl where login='".$_SESSION['SESS_MEMBER_ID']."'");
	  
	if ($result && mysql_num_rows($result) > 0) {
    $query_data=mysql_fetch_array($result);
    $sellerno3=$query_data["sellerno"];
  }

//echo "<p>The SELLER LOGIN ID is: $sellerno </p>";

    $sellerno=$sellerno3;
	$bid_id=$bid_id1;
	

				
 $query="insert into seller
 values
('seller_bid_id','$bid_id','$sellerno','$login','$name','$price','$discount','$warranty','$freeshipment')";
     

        $ins=mysql_query($query);
        $res=mysql_query($ins);
        echo ' '.$res;

print_table :


    $result=mysql_query("select sellerno from sellerl where login='".$_SESSION['SESS_MEMBER_ID']."'");
	  
	if ($result && mysql_num_rows($result) > 0) {
    $query_data=mysql_fetch_array($result);
    $sellerno3=$query_data["sellerno"];
  }

        $sellerno=$sellerno3;
	    $bid_id=$bid_id1;

   $result=mysql_query("select seller.*,bid.* from seller,bid WHERE bid.bid_id=seller.bid_id AND bid.bid_id='$bid_id' AND login='".$_SESSION['SESS_MEMBER_ID']."' GROUP BY seller.name");
       

         if(mysql_num_rows($result)>0)
          {
          
           echo '<table border=1>';
           echo '<tr>
                   <th class="top" scope="col"><center>Seller Id</center>
				   <th class="top" scope="col"><center>Seller Name</center>
				   <th class="top" scope="col"><center>Brand</center>
				   <th class="top" scope="col"><center>Size(GB)</center>
				   <th class="top" scope="col"><center>Quantity</center>
				   <th class="top" scope="col"><center><center>Warranty<br/>(Yr)</center>
				   <th class="top" scope="col"><center>Free<br/>Shipment</center>
				   <th class="top" scope="col"><center>Price(Rs)</center>
				   <th class="top" scope="col"><center>Discount<br/>(%)</center>
				   
		     </tr>';

           while($row=mysql_fetch_row($result))
             {
              echo '<tr>';
              
              echo '<td><center>'.$row[2].'</center></td>';
              echo '<td><center>'.$row[4].'</center></td>';
              echo '<td><center>'.$row[12].'</center></td>';
              echo '<td><center>'.$row[13].'</center></td>';
              echo '<td><center>'.$row[14].'</center></td>';
              echo '<td><center>'.$row[7].'</center></td>';
              echo '<td><center>'.$row[8].'</center></td>';
              echo '<td><center>'.$row[5].'</center></td>';
              echo '<td><center>'.$row[6].'</center></td>';
              
             
		//echo '<td><center>'.$row[12].'/'.$row[13].'/'.$row[14].'</td>';
             
            
             }
           echo '</table>';
           }
         else
          {
            echo 'No rows found';
          }

		  
          //mysql_free_result($result);
          mysql_close($connection);
        ?>

     </td></tr></table></div></div>
<!-------------------------------------------------------------------------->

 
	        <div class="clear"></div>
			<div style="height:300px;"></div>
    </div>
        
      
    <!--######   FOOTER AREA   ######-->      

    <div class="footer">
      <p>Copyright &copy; 2012 BMS Institute of Technology | All Rights Reserved</p>
      <p class="credits">Original design by : <a href="http://www.bmsit.org.in" title="Designer Homepage">Pradeep Kumar</a> | USN : <a href="http://www.bmsit.org.in" title="Designer Homepage">1BY09MCA28</a></p>
    </div>      
  </div> 
</body>
</html>



