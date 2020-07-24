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
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout1_setup.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout1_text.css" />
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
  <title>Online Auction | Supplier Registration Form</title>
</head>
<!--###############    CODE FOR DISABLE BACK BUTTON    ################-->

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
            <li><a href="home.html">Home</a></li>
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

		  <!-- Navigation item -->
         <!-- <ul>
            <li><a href="#">Service Details</a>
               <ul>
                  <li><a href="#">Our Services</a></li>
                  <li><a href="#">Methodology</a></li>
                  <li><a href="#">Process</a></li>
				  <li><a href="#">Benefits</a></li>
                  <li><a href="afterNews.html">Current News</a></li>
                </ul>
              <!--[if lte IE 6]></td></tr></table></a><![endif]-->
            </li>
          </ul> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<script src="script.js" type="text/javascript" align="right"></script>
   
<!--############   CODE FOR DYNAMIC CLOCK   #############-->
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

        <!--################   SEARCH FORM   ###################-->    
		
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
<!--------------------------------------------------------------------------->		
    
    <!-- For alternative headers END PASTE here -->

    <!-- B. MAIN -->
    <div class="main">
 
     <!-- B.2 MAIN CONTENT -->
      <div class="main-content">
        
        <!-- Pagetitle -->
        <h1 class="pagetitle">Supplier Registration Form</h1>

 
 <!--###################  SUPPLIER REGISTRATION FORM   ####################-->

<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>

 <form id="loginForm" name="loginForm" method=post action="http://localhost/r/sregister-exec.php">
 <p>
              To request a <span style="color:#00cc00"><b><em>Online Auction</em></b></span> project then please complete our online <a href="contact Us.php#"><em>Request Form</em></a>. If you need more information regarding our Sourcing Services then please feel free to contact us using the message form below:</p>
              <p>Please note that <b><font color=red>all</font></b> fields are mandatory. </p>
                                   
<!--<h1 class="block">6 - Contact form</h1>-->
<div class="column2-unit-left">
       <div class="column1-unit">
          <div class="contactform">
          
            <fieldset><legend>&nbsp;CONTACT&nbsp;&nbsp;&nbsp;PERSON</legend>
                <p><label for="contact_title" class="left">Title:</label>
                  <select name="title" id="title" class="combo">
                   <option value="choose"> Select... </option>
                   <option value="mrs"> Mrs. </option>
                   <option value="mr"> Mr. </option></select></p>
                 <p><label for="contact_title" class="left">Name:</label>
                   <input type="text" name="fname" id="fname" class="field" value="" tabindex="1" /></p>
				 <p><label for="contact_title" class="left">Surname:</label>
                   <input type="text" name="lname" id="lname" class="field" value="" tabindex="1" /></p>
				 <p><label for="contact_title" class="left">Login Id:</label>
                   <input type="text" name="login" id="login" class="field" value="" tabindex="1" /></p>
				 <p><label for="contact_title" class="left">Password:</label>
                   <input type="password" name="password" id="password" class="field" value="" tabindex="1" /></p>
				 <p><label for="contact_title" class="left">Confirm Password:</label>
                   <input type="password" name="cpassword" id="cpassword" class="field" value="" tabindex="1" /></p>
				 <p><label for="address" class="left">Address:</label>
                   <textarea name="address" id="address" cols="45" rows="7" tabindex="1"></textarea></p>
			     <p><label for="contact_title" class="left">Fax:</label>
                   <input type="text" name="fax" id="fax" class="field" value="" tabindex="1" maxlength=18/></p>
                 <p><label for="contact_title" class="left">Phone No:</label>
                   <input type="text" name="phoneno" id="phoneno" class="field" value="" tabindex="1" maxlength=10 /></p>
                 <p><label for="contact_title" class="left">Email Id:</label>
                   <input type="text" name="emailid" id="emailid" class="field" value="" tabindex="1" /></p><br/>
                
              </fieldset>
			  <fieldset><legend>&nbsp;MESSAGE DETAILS&nbsp;</legend>
                <p><label for="subject" class="left">Subject:</label>
                   <input type="text" name="subject" id="subject" class="field" value="" tabindex="1" /></p>
                <p><label for="urgency" class="left">Please reply:</label>
                   <select name="urgency" id="urgency" class="combo">
                     <option value="choose"> Select... </option>
                     <option value="today"> Latest today </option>
                     <option value="tomorrow"> Latest tomorrow </option>
                     <option value="threedays"> Latest in 3 days </option>
                     <option value="week"> Latest in a week </option>
                     <option value="month"> Latest in a month </option></select></p>
                <p><label for="message" class="left">Message:</label>
                <textarea name="message" id="message" cols="45" rows="5"tabindex="1"></textarea></p></fieldset>
            
            
            
  </div></div></div>


<div class="column2-unit-right">
	<div class="column1-unit">
          <div class="contactform">

           
            <fieldset><legend>&nbsp;ORGANISATION&nbsp;&nbsp;DETAILS&nbsp;</legend>
			       <p><label for="company_title" class="left">Company Name:</label>
                   <input type="text" name="company" id="company" class="field" value="" tabindex="1" /></p>
				   <p><label for="company_title" class="left">Website:</label>
                   <input type="text" name="website" id="website" class="field" value="" tabindex="3" /></p>
				   <p><label for="company_title" class="left">Street:</label>
                   <input type="text" name="street" id="street" class="field" value="" tabindex="3" /></p>
				   <p><label for="company_title" class="left">Postal Code:</label>
                   <input type="text" name="postal" id="postal" class="field" value="" tabindex="3" /></p>
				   <p><label for="company_title" class="left">City:</label>
                   <input type="text" name="city" id="city" class="field" value="" tabindex="3" /></p>
				   <p><label for="company_title" class="left">Office No:</label>
                   <input type="text" name="ophoneno" id="ophoneno" class="field" value="" tabindex="2" maxlength=15 /></p>
				   <p><label for="company_title" class="left">Country:</label>
                   <select name="country" name="country" id="country" class="combo">
				   <option value="27">Afghanistan</option>
                   <option value="29">Albania</option>
                   <option value="30">Algeria</option>
                   <option value="31">American Samoa</option>
                   <option value="33">Andorra</option>
                   <option value="34">Angola</option>
                   <option value="35">Anguilla</option>
                   <option value="36">Antarctica</option>
                   <option value="37">Antigua and Barbuda</option>
                   <option value="38">Argentina</option>
                   <option value="39">Armenia</option>
                   <option value="40">Aruba</option>
                   <option value="41">Australia</option>
                   <option value="1">Austria</option>
                   <option value="42">Azerbaijan</option>
                   <option value="43">Bahamas</option>
                   <option value="44">Bahrain</option>
                   <option value="45">Bangladesh</option>
                   <option value="46">Barbados</option>
                   <option value="51">Belarus</option>
                   <option value="2">Belgium</option>
                   <option value="47">Belize</option>
                   <option value="48">Benin</option>
                   <option value="49">Bermuda</option>
                   <option value="50">Bhutan</option>
                   <option value="52">Bolivia </option>
                   <option value="53">Bosnia and Herzegovina</option>
                   <option value="54">Botswana</option>
                   <option value="55">Bouvet Island</option>
                   <option value="56">Brazil</option>
                   <option value="57">British Indian Ocean Territory</option>
                   <option value="59">Brunei Darussalam</option>
                   <option value="60">Bulgaria</option>
                   <option value="61">Burkina Faso</option>
                   <option value="62">Burundi</option>
                   <option value="117">Cambodia</option>
                   <option value="118">Cameroon</option>
                   <option value="3">Canada</option>
                   <option value="119">Cape Verde</option>
                   <option value="116">Cayman Islands</option>
                   <option value="206">Central African Republic</option>
                   <option value="125">Cocos (Keeling) Islands</option>
                   <option value="126">Colombia</option>
					<option value="127">Comoros</option>
					<option value="128">Congo</option>
					<option value="63">Cook Islands</option>
					<option value="132">Costa Rica</option>
					<option value="103">Croatia</option>
					<option value="133">Cuba</option>
					<option value="64">Cyprus</option>
					<option value="5">Czech republic</option>
					<option value="130">Democratic Peoples Republic of Korea&nbsp;</option>
					<option value="129">Democratic Republic of the Congo</option>
					<option value="7">Denmark</option>
					<option value="71">Djibouti</option>
					<option value="69">Dominica</option>
					<option value="70">Dominican Republic</option>
					<option value="73">Ecuador</option>
					<option value="72">Egypt</option>
					<option value="193">El Salvador</option>
					<option value="188">Equatorial Guinea</option>
					<option value="74">Eritrea</option>
					<option value="75">Estonia</option>
					<option value="76">Ethiopia</option>
					<option value="78">Falkland Islands (Malvinas)</option>
					<option value="77">Faroe Islands</option>
					<option value="79">Fiji</option>
					<option value="9">Finland</option>
					<option value="10">France</option>
					<option value="81">French Guiana</option>
					<option value="82">French Polynesia</option>
					<option value="83">French Southern Territories</option>
					<option value="84">Gabon</option>
					<option value="85">Gambia</option>
					<option value="90">Georgia</option>
					<option value="6">Germany</option>
					<option value="86">Ghana</option>
					<option value="87">Gibraltar</option>
					<option value="12">Greece</option>
					<option value="89">Greenland</option>
					<option value="88">Grenada</option>
					<option value="91">Guadeloupe</option>
					<option value="92">Guam</option>
					<option value="93">Guatemala</option>
					<option value="94">Guernsey</option>
					<option value="95">Guinea</option>
					<option value="96">Guinea-Bissau</option>
					<option value="97">Guyana</option>
					<option value="98">Haiti</option>
					<option value="99">Heard Island and McDonald Islands</option>
					<option value="238">Holy See</option>
					<option value="101">Honduras</option>
					<option value="102">Hong Kong</option>
					<option value="13">Hungary</option>
					<option value="65">Chad</option>
					<option value="67">Chile</option>
					<option value="68">China</option>
					<option value="240">Christmas Island</option>
					<option value="108">Iceland</option>
					<option value="105">Indonesia</option>
					<option value="107">Iran (Islamic Republic of)</option>
					<option value="106">Iraq</option>
					<option value="14">Ireland</option>
					<option value="151">Isle of Man</option>
					<option value="109">Israel</option>
					<option value="15">Italy</option>
					<option value="110">Jamaica</option>
					<option value="16">Japan</option>
					<option value="112">Jernsey</option>
					<option value="113">Jordan</option>
					<option value="121">Kazakhstan</option>
					<option value="122">Kenya</option>
					<option value="124">Kiribati</option>
					<option value="131">Korea, Republic of</option>
					<option value="134">Kuwait</option>
					<option value="123">Kyrgyzstan</option>
					<option value="142">Latvia</option>
					<option value="137">Lebanon</option>
					<option value="136">Lesotho</option>
					<option value="138">Liberia</option>
					<option value="139">Libyan Arab Jamahiriya</option>
					<option value="140">Liechtenstein</option>
					<option value="141">Lithuania</option>
					<option value="28">Lland Islands</option>
					<option value="17">Luxembourg</option>
					<option value="143">Macao</option>
					<option value="145">Madagascar</option>
					<option value="147">Malawi</option>
					<option value="146">Malaysia</option>
					<option value="148">Maldives</option>
					<option value="149">Mali</option>
					<option value="150">Malta</option>
					<option value="153">Marshall Islands</option>
					<option value="154">Martinique</option>
					<option value="156">Mauritania</option>
					<option value="155">Mauritius</option>
					<option value="157">Mayotte</option>
					<option value="159">Mexico</option>
					<option value="160">Micronesia (Federated States of)</option>
					<option value="163">Monaco</option>
					<option value="164">Mongolia</option>
					<option value="66">Montenegro</option>
					<option value="165">Montserrat</option>
					<option value="152">Morocco</option>
					<option value="166">Mozambique</option>
					<option value="161">Myanmar</option>
					<option value="167">Namibia</option>
					<option value="168">Nauru</option>
					<option value="169">Nepal</option>
					<option value="18">Netherlands</option>
					<option value="100">Netherlands Antilles</option>
					<option value="175">New Caledonia</option>
					<option value="20">New Zealand</option>
					<option value="172">Nicaragua</option>
					<option value="170">Niger</option>
					<option value="171">Nigeria</option>
					<option value="173">Niue</option>
					<option value="174">Norfolk Island</option>
					<option value="198">Northern Mariana Islands</option>
					<option value="19">Norway</option>
					<option value="176">Oman</option>
					<option value="177">Pakistan</option>
					<option value="178">Palau</option>
					<option value="179">Palestinian Territory, Occupied</option>
					<option value="180">Panama</option>
					<option value="181">Papua New Guinea</option>
					<option value="182">Paraguay</option>
					<option value="183">Peru</option>
					<option value="80">Philippines</option>
					<option value="184">Pitcairn</option>
					<option value="21">Poland</option>
					<option value="22">Portugal</option>
					<option value="186">Puerto Rico</option>
					<option value="120">Qatar</option>
					<option value="162">Republic of Moldova</option>
					<option value="189">Romania</option>
					<option value="190">Russian Federation</option>
					<option value="191">Rwanda</option>
					<option value="211">Saint Helena, Ascension and Tristan da Cunha</option>
					<option value="214">Saint Kitts and Nevis</option>
					<option value="212">Saint Lucia</option>
					<option value="215">Saint Martin (French part)</option>
					<option value="192">Saint Pierre and Miquelon</option>
					<option value="217">Saint Vincent and the Grenadines</option>
					<option value="194">Samoa</option>
					<option value="195">San Marino</option>
					<option value="216">Sao Tome and Principe</option>
					<option value="196">Saudi Arabia</option>
					<option value="197">Senegal</option>
					<option value="204">Serbia</option>
					<option value="199">Seychelles</option>
					<option value="200">Sierra Leone</option>
					<option value="201">Singapore</option>
					<option selected="selected" value="104">India</option>
					<option value="24">Slovenia</option>
					<option value="219">Solomon Islands</option>
					<option value="202">Somalia</option>
					<option value="114">South Africa</option>
					<option value="115">South Georgia and the South Sandwich Islands</option>
					<option value="8">Spain</option>
					<option value="205">Sri Lanka</option>
					<option value="207">Sudan</option>
					<option value="208">Suriname</option>
					<option value="209">Svalbard&nbsp;Jan Mayen</option>
					<option value="210">Swaziland</option>
					<option value="23">Sweden</option>
					<option value="4">Switzerland</option>
					<option value="218">Syrian Arab Republic</option>
					<option value="221">Taiwan, Province of China</option>
					<option value="220">Tajikistan</option>
					<option value="223">Thailand</option>
					<option value="144">The former Yugoslav Republic of Macedonia</option>
					<option value="242">Timor-Leste</option>
					<option value="224">Togo</option>
					<option value="225">Tokelau</option>
					<option value="226">Tonga</option>
					<option value="227">Trinidad and Tobago</option>
					<option value="228">Tunisia</option>
					<option value="229">Turkey</option>
					<option value="230">Turkmenistan</option>
					<option value="231">Turks and Caicos Islands</option>
					<option value="232">Tuvalu</option>
					<option value="233">Uganda</option>
					<option value="234">Ukraine</option>
					<option value="203">United Arab Emirates</option>
					<option value="11">United Kingdom</option>
					<option value="222">United Republic of Tanzania</option>
					<option value="158">United States Minor Outlying Islands</option>
					<option value="235">Uruguay</option>
					<option value="26">USA</option>
					<option value="236">Uzbekistan</option>
					<option value="237">Vanuatu</option>
					<option value="239">Venezuela (Bolivarian Republic of)</option>
					<option value="241">Viet Nam</option>
					<option value="32">Virgin Islands of the US</option>
					<option value="58">Virgin Islands, British</option>
					<option value="243">Wallis and Futuna</option>
					<option value="245">Western Sahara</option>
					<option value="111">Yemen</option>
					<option value="244">Zambia</option>
					<option value="246">Zimbabwe</option>
                 </select></p></fieldset>
		 <fieldset><legend>&nbsp;ADMINISTRATIVE DETAILS&nbsp;</legend>
               
                <p><label for="message" class="left">Legal form:</label>
				<select name="lform" id="lform" class="combo">
                <option value="17">budgetary organization</option>
				<option value="7">cooperative</option>
				<option value="11">entrepreneur-physical person-not entered in Business Register</option>
				<option value="5">Indian company (SE)</option>
				<option value="8">Indian Cooperative Society (SCE)</option>
				<option value="14">foundation</option>
				<option value="13">interest association</option>
				<option value="4">joint stock company</option>
				<option value="3">limited liability company</option>
				<option value="10">municipality/municipal office</option>
				<option value="15">not profitable organization</option>
				<option value="26">not specified legal type</option>
				<option value="25">office of local government</option>
				<option value="18">organization based on state contributions</option>
				<option value="23">political party, political movement</option>
				<option value="12">private farmer not entered in Business Register</option>
				<option value="1">public commercial company</option>
				<option value="19">public legal institution</option>
				<option value="6">state enterprise</option>
				</select></p>
			 <p><label for="company_title" class="left">ID:</label>
               <input type="text" name="id" id="id" class="field" value="" tabindex="1" /></p>
			 <p><label for="company_title" class="left">Tax ID:</label>
               <input type="text" name="taxid" id="taxid" class="field" value="" tabindex="1" /></p>
			<p><label for="company_title" class="left">VAT ID:</label>
               <input type="text" name="vatid" id="vatid" class="field" value="" tabindex="1" /></p>
               
             <p><label for="company_title" class="left">Experience(Yr):</label>                 <input type="text" name="exp" id="exp" class="field" value="" tabindex="1" /></p>
			 <p><label for="company_title" class="left">No of Clients:</label>
         <input type="text" name="client" id="client" class="field" value="" tabindex="1" /></p>
				  <p><label for="company_title" class="left" title="Select any one">Company Certified:</label>
                   <select name="certified" id="certified" class="combo">
                     <option value="choose"> Select... </option>
                     <option value="ISO 9001">ISO 9001 </option>
                     <option value="ISO 27001">ISO 27001 </option>
                     <option value="ISO 14001">ISO 14001 </option>
					 <option value="ISO 9000">ISO 9000 </option>
                     <option value="ISO 27000">ISO 27000 </option>
                     <option value="ISO 14000">ISO 14000 </option>
					 <option value="ISO 22000">ISO 22000 </option>
                     <option value="ISO/TS 21095:2001">ISO/TS 21095:2001 </option>
                     <option value="ISO/TS 16949:2002">ISO/TS 16949:2002 </option>
					 <option value="none">None of Above </option>
					 </select></p>
				  <p><label for="company_title" class="left">Revenu(Yr):</label>
                   <input type="revenu" name="revenu" id="revenu" class="field" value="" tabindex="1" /></p>
				 
                
                <p><label for="company_title" class="left" title="Company production capacity of last 3 years">Production Capacity:</label>
                   <input type="text" name="pcapacity" id="pcapacity" class="field" value="" tabindex="2" /></p>
	<p><input type="submit" name="submit" id="submit" class="button" value="Submit Form" tabindex="1" /></p>
            
              </fieldset>

            
             <!-- <center><input type="submit" name="Submit" value="Register" /></center>-->
            </form>
     </div>              
    </div>
  </div>
    
  <div class="clear"></div>
         <div style="height:50px;"></div>
       <div class="clear"></div></table>
 
</div>
</div>

<!---------------------------------------------------------------------------->

        
       <!--####  FOOTER AREA  ####-->      

    <div class="footer">
      <p>Copyright &copy; 2012 BMS Institute of Technology | All Rights Reserved</p>
      <p class="credits">Original design by : <a href="http://www.bmsit.org.in" title="Designer Homepage">Pradeep Kumar</a> | USN : <a href="http://www.bmsit.org.in" title="Designer Homepage">1BY09MCA28</a></p>
    </div>      
  </div> 
</body>
</html>



