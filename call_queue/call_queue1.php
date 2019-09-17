<?php
      require_once('config.php');    
	  $assigned_user=$_REQUEST['agent_name'];
	 
    if($assigned_user)
    {
			$flag = '1';
    }
		
###########################################  PROGRAM TO DISPLAY RECORDS IN ROUND-ROBIN FASHION   #############################################################
	
if($flag == '1')
{
    
	 $result=mysql_query("SELECT MAX(priority) FROM call_queue WHERE assigned_user='$assigned_user' AND status=1");
	  
	  if ($result){
      $query=mysql_fetch_row($result);
      }
	     $max_priority=$query[0];
	     //echo "<p>MAX Priority :$max_priority</p>";
	  

	$result=mysql_query("SELECT * FROM call_queue WHERE assigned_user='$assigned_user' AND priority='$max_priority' AND  status=1");
	  
	   if(mysql_num_rows($result)>0)
       {

           while($row=mysql_fetch_row($result))
           {
		             $enq_id=$row[1];
			         $name=$row[3];
			         $course_intersted=$row[4];
			         $location=$row[5];
				     $phone_no=$row[6];
				     $email_id=$row[7];
            }
          
       //}
	   
          //echo "<p>Assigned User :$assigned_user</p>";
		  //echo "<p>MAX Priority :$max_priority</p>";	   
	   
		  $result=mysql_query("UPDATE call_queue SET status=0 WHERE assigned_user='$assigned_user' AND priority='$max_priority'");
		   
		  $result=mysql_query("UPDATE call_queue SET status=1 WHERE assigned_user='$assigned_user' AND priority < '$max_priority'");
		   
		}
	
###################################################   WHEN CURSOR WILL REACH FIRST-INDEX VALUE   ####################################################################

	  $result=mysql_query("SELECT status FROM call_queue WHERE assigned_user='$assigned_user'");
	  
	  if ($result){
      $query=mysql_fetch_row($result);
      }
	     $status=$query[0];
	     //echo "<p>All Status :$status</p>";
		 
	  if($status==0)
	  {
	  
	  	   $result=mysql_query("SELECT MIN(priority) FROM call_queue WHERE assigned_user='$assigned_user'");
	  	
			if ($result){
		      $query=mysql_fetch_row($result);
			  }
				 $min_priority=$query[0];
				 //echo "<p>MIN Priority :$min_priority</p>";
				 
				 
				 
	  	    $result=mysql_query("UPDATE call_queue SET status=1 WHERE assigned_user='$assigned_user' AND priority='$min_priority'");	
			
			$result=mysql_query("SELECT * FROM call_queue WHERE assigned_user='$assigned_user' AND priority='$min_priority' AND  status=1");
	  
			   if(mysql_num_rows($result)>0)
			   {
		
				   while($row=mysql_fetch_row($result))
				   {
							 $enq_id=$row[1];
							 $name=$row[3];
							 $course_intersted=$row[4];
							 $location=$row[5];
							 $phone_no=$row[6];
							 $email_id=$row[7];
					}
	 
				 
			$result=mysql_query("UPDATE call_queue SET status=0 WHERE assigned_user='$assigned_user' AND priority='$min_priority'");
		   
		    $result=mysql_query("UPDATE call_queue SET status=1 WHERE assigned_user='$assigned_user' AND priority > '$min_priority'");
			
		}
	//  }
	   
	   else 
	   {
	   		echo "<p><font color='red'>Agent not Exists</font></p>";
			//$name='';
	   }
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Enquiry Details Form</title>	
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
	<meta name="keywords" content=""></meta>
	<!--<link rel="stylesheet" href="css/screen.css" media="screen" />
	<!--<script type="text/javascript" src="../ckeditor.js"></script>
	<script src="sample.js" type="text/javascript"></script>
	<link href="sample.css" rel="stylesheet" type="text/css" />-->
	<link rel="stylesheet" type="text/css" href="./css/layout1_setup.css" />
    <link rel="stylesheet" type="text/css" href="./css/layout1_text.css" />
	<SCRIPT type="text/javascript" src="calendar/calendar.js?random=20060118"></script>
    <style type="text/css">
	body{
		
		background-repeat:no-repeat;
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
		margin:0px;	
	}
	#ad{
		padding-top:220px;
		padding-left:10px;
	}
	</style>
	
<script language="JavaScript">
function ShowHide(divId)
{
	if(document.getElementById(divId).style.display == 'none')
	{
		document.getElementById(divId).style.display='block';
	}
	else
	{
		document.getElementById(divId).style.display = 'none';
	}
}

function ShowHide1(divId)
{
	if(document.getElementById(divId).style.display == 'none')
	{
		document.getElementById(divId).style.display='block';
	}
	else
	{
		document.getElementById(divId).style.display = 'none';
	}
}

function ShowHide2(divId)
{
	if(document.getElementById(divId).style.display == 'none')
	{
		document.getElementById(divId).style.display='block';
	}
	else
	{
		document.getElementById(divId).style.display = 'none';
	}
}

function ShowHide3(divId)
{
	if(document.getElementById(divId).style.display == 'none')
	{
		document.getElementById(divId).style.display='block';
	}
	else
	{
		document.getElementById(divId).style.display = 'none';
	}
}
/*
function ShowHide4(divId)
{
	if(document.getElementById(divId).style.display == 'none')
	{
		document.getElementById(divId).style.display='block';
	}
	else
	{
		document.getElementById(divId).style.display = 'none';
	}
}
*/


function reload()
{
	document.frm.action='sendmail.php';
	document.frm.submit();
	
}
function reload1()
{
	document.frm.action='sendmail1.php';
	document.frm.submit();
	
}

function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
</script>	
</head>

<body>
 <!--<div id="container">-->
	  <table align="center">
	   <tr>
	     <td width="100%" height="100%" background="./images/form2/bgy.gif" colspan="0"  rowspan="0">
	
		 <form id="loginForm" name="loginForm" method=post action="/">
<div class="column2-unit-left">
       <div class="column1-unit">
          <div class="contactform">
          
            <fieldset><legend>&nbsp;ENQUIRY&nbsp;&nbsp;&nbsp;DETAILS</legend>
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
                   <textarea name="address" id="address" cols="30" rows="3" tabindex="1"></textarea></p>
			   <br/>
                
              </fieldset>
  </div></div></div>


<div class="column2-unit-right">
	<div class="column1-unit">
          <div class="contactform">

           
            <fieldset><legend>&nbsp;MAIL&nbsp;&nbsp;DETAILS&nbsp;</legend>

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
                 </select></p></fieldset>
		
	<p><input type="submit" name="submit" id="submit" class="button" value="Submit Form" tabindex="1" /></p>
            
              </fieldset>
            </form>
                
  
   
</td></tr>
</table>	
</body>
</html>
