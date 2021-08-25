<?php
      require_once('db.php');    
	  $assigned_user=$_REQUEST['agent_name'];
	 
    if($assigned_user)
    {
			$flag = '1';
    }
		
#############################  PROGRAM TO DISPLAY RECORDS IN ROUND-ROBIN FASHION  ###############################################
	
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
			         $name=$row[4];
			         $course_intersted=$row[5];
			         $location=$row[6];
				     $phone_no=$row[7];
				     $email_id=$row[8];
					 $comments=$row[15];
            }
          
       //}
	   
          //echo "<p>Assigned User :$assigned_user</p>";
		  //echo "<p>MAX Priority :$max_priority</p>";	   
	   
		  $result=mysql_query("UPDATE call_queue SET status=0 WHERE assigned_user='$assigned_user' AND priority='$max_priority'");
		   
		  $result=mysql_query("UPDATE call_queue SET status=1 WHERE assigned_user='$assigned_user' AND priority < '$max_priority'");
		   
		}
	
##############################   WHEN CURSOR WILL REACH FIRST-INDEX VALUE  #########################################################

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
							 $name=$row[4];
							 $course_intersted=$row[5];
							 $location=$row[6];
							 $phone_no=$row[7];
							 $email_id=$row[8];
							 $comments=$row[15];
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
	<link rel="stylesheet" href="css/screen.css" media="screen" />
	<script type="text/javascript" src="../ckeditor.js"></script>
	<script src="sample.js" type="text/javascript"></script>
	<!--<link href="sample.css" rel="stylesheet" type="text/css" />-->
	<!--<link type="text/css" rel="stylesheet" href="calendar/calendar.css" media="screen"></link>-->
	<!--<link type="text/css" rel="stylesheet" href="calendar/calendar.css?random=20051112" media="screen"></link>-->
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
</script>
<script language="JavaScript">
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
</script>
<script language="JavaScript">
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
}
</script>	
</head>

<body>
 <!--<div id="container">-->
	  <table align="center">
	   <tr>
	     <td width="100%" height="100%" background="./images/form2/bgy.gif" colspan="0"  rowspan="0">
	
		 <form id="form2" action="call_queue_exec.php" method="post">
		 
			<h3 align="center"><span>Enquiry Details</span></h3>
		
			<fieldset><legend>Enquire form</legend>
			     <p>
					<label for="Enquire">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enquire No.&nbsp;&nbsp;
					<input type="text" name="enq_id" id="enq_id" value="<?=$enq_id?>" size="50" />	 
			
	<!--<label for="Select Mail Template">-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Mail Template   &nbsp;&nbsp;&nbsp;
	<select name='Mail_template'  onChange="reload()">
	<?php
			
     $qury=mysql_query("select id, mail_subject  FROM `mail_det` where status=1 and (username='$user' or username='administrator') ORDER BY `mail_date` DESC");            //or die(mysql_error());
			echo "<option value=''>--Select--</option>";
			while($r=mysql_fetch_array($qury))
			{
				if($Mail_template==$r[id])
				echo "<option value='$r[id]' selected>$r[mail_subject]</option>";
				else
				echo "<option value='$r[id]'>$r[mail_subject]</option>";

            }
     ?>
</select>
</p></label></label> 
		<p>
			<label for="Name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name &nbsp;&nbsp;
			<input type="text" name="name" id="name" value="<?=$name?>" size="50" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Custom Email:
		</p></label>
				<p align="left">
					<label for="Course">Course Interested &nbsp;&nbsp; 
					<input type="text" name="course_intersted" id="course_intersted" value="<?=$course_intersted?>" size="50" />
					
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject&nbsp;&nbsp;&nbsp;&nbsp;
			
      <input type="text" width="50" id="subject" name="subject" size="50" maxlength="50" max="50" />
		</p></label>	
				<p>
					<label for="Location">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Location&nbsp;&nbsp;
					<input type="text" name="location" id="location" value="&nbsp;<?=$location?>" size="50" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <textarea cols="80" id="editor1" name="editor1" rows="10" ><?php echo $mail_boday; ?></textarea>
				 </p></label>
				<p>
					<label for="Phone_No">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone No.&nbsp;&nbsp;
					<input type="text" name="phone_no" id="phone_no" value="<?=$phone_no?>" size="50" />
				</p></label>
				<p>
					<label for="Email">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email &nbsp;&nbsp;
					<input type="text" name="email_id" id="email_id" value="<?=$email_id?>" size="50" />
				</p></label>
				<p >
					<label for="Comments">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comments &nbsp;&nbsp;
					<textarea name="comments" id="comments" cols="4" rows="3" tabindex="1" maxlength="255" ><?=$comments?></textarea>
				</p></label>
				<p align="left">
					<label for="Enquiry_status">&nbsp;&nbsp;&nbsp;&nbsp;Enquiry Status<font color="red">*</font>&nbsp;&nbsp;&nbsp;
					<select name='enq_status'>
						   <option value='Interested' onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;" selected>Interested</option>
						   <option value='Not Interested' onclick ="javascript:ShowHide1('HiddenDiv1')" href="javascript:;" selected>Not Interested</option>
						   <option value='Enrolled' selected>Enrolled</option>
						   <option value='Want LC MBA' selected>Want LC MBA</option>
						    <option value='Enquiry' selected>Enquiry</option>
							<option value='' selected></option>
					</select>
             <div class="mid" id="HiddenDiv" style="DISPLAY: none" >
             <p align="left">
					<label for="Follow Up date">&nbsp;&nbsp;&nbsp;
					Follow Up date&nbsp;&nbsp;&nbsp;&nbsp;
					<select name='follow_up_date'> 
						   <option value='' onclick ="javascript:ShowHide3('HiddenDiv3')" href="javascript:;" selected>Follow Up date</option>
						   <option value='Prospectus Sent' selected>Prospectus Sent</option>
						   <option value='Application Sent' selected>Application Sent</option>
						   <option value='Application Filled' selected>Application Filled</option>
						   <option value='Payment Made' selected>Payment Made</option>
						   <option value='Documents Sent' selected>Documents Sent</option>
						   <option value='' selected></option>
					</select>
             </div></p></label> 
		
			 <div class="mid" id="HiddenDiv1" style="DISPLAY: none" >   
			  <p align="left">
					<label for="Reason for Not Interested">Reason for Not Interested &nbsp;&nbsp;
					<select name='reason'>
						   <option value='Other Reasons' onclick ="javascript:ShowHide2('HiddenDiv2')" href="javascript:;" selected>Other Reasons</option>
						   <option value='Required Course not available' selected>Required Course not available</option>
						   <option value='Fee too high' selected>Fee too high</option>
						   <option value='' selected></option>
					</select></p></label>
					
				<div class="mid" id="HiddenDiv2" style="DISPLAY: none" >	
				<p>
					<label for="Other Reason">Other Reasons &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<textarea name="other_reason" id="other_reason" cols="68" rows="3" tabindex="1" maxlength="255" ><?=$comments?></textarea>
					
         </div></div></p></label> 
			 
		  <div class="mid" id="HiddenDiv3" style="DISPLAY: none" >
		    <p>
			 <label for="Follow Up Date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date & Time &nbsp;&nbsp;  
			 <input type="text" id="follow_up_date_time" value="<?=$follow_up_date_time?>" readonly name="follow_up_date_time">
			 <img src="images/iconCalendar.gif" onmouseover="displayCalendar(document.forms[0].follow_up_date_time,'yyyy-mm-dd hh:ii',this,true)">
			 </label></p></div> 			
		
			     <!--<p  align="center" class="submit"><div align="center"><button type="submit"> Save </button></div>-->
			     <!--<input type="submit" id="submit" value="submit"/>-->	
		
		<!--<form class="new1" action="_posteddata.php" method="post">-->
			<div align="center"><button type="submit" id="submit"> Save </button></div>
	</fieldset>	
</form>							
		
<br/><br/><br/><br/><br/><br/><br/><br/>
</td></tr>
</table>
</div>		
</body>
</html>
