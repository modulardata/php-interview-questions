<?php
session_start();
include("../../db.php");
$user=$_SESSION['user'];

if($_POST)
{
	$notify_fromname=$_POST['notify_fromname'];
	$notify_fromaddress=$_POST['notify_fromaddress'];
	$Domain_name=$_POST['Domain_name'];
	$mail_smtpserver=$_POST['mail_smtpserver'];
	$mail_smtpport=$_POST['mail_smtpport'];
	$mail_smtpuser=$_POST['mail_smtpuser'];
	$mail_smtppass=$_POST['mail_smtppass'];
	$Signatore=$_POST['Signatore'];
	if($notify_fromname!='' and $notify_fromaddress!='' and $Domain_name!='' and $mail_smtpserver!='' and $mail_smtpport!='' and $mail_smtpuser!='' and $mail_smtppass!='' and $Signatore!='')
	{
		$countid=mysql_num_rows(mysql_query("select id from `mail_settings` where `user_id`='$user' and status='1'"));
		if(!$countid)
		{
			mysql_query("INSERT INTO `mail_settings` ( `user_id`, `status`, `From_name`, `From_address`, `Domain_name`, `SMTP`, `SMTP_Port`, `Username`, `Password`, `Count`,`Signatore`) VALUES ( '$user', '1', '$notify_fromname', '$notify_fromaddress', '$Domain_name', '$mail_smtpserver', '$mail_smtpport', '$mail_smtpuser', '$mail_smtppass', '0','$Signatore')");
		}
		else
		{
			mysql_query("update `mail_settings` set From_name='$notify_fromname', `From_address`='$notify_fromaddress', `Domain_name`='$Domain_name', `SMTP`='$mail_smtpserver', `SMTP_Port`='$mail_smtpport', `Username`='$mail_smtpuser', `Password`='$mail_smtppass', `Signatore`='$Signatore' where `user_id`='$user' and status=1");
		}
	?>
    	<script language="javascript">
			alert("Updated successfully ");
        </script>
    <?php	
		$quer=mysql_query("select * from `mail_settings` where `user_id`='$user' and status='1'");
		while($r1=mysql_fetch_array($quer))
		{
			$notify_fromname=$r1['From_name'];
			$notify_fromaddress=$r1['From_address'];
			$Domain_name=$r1['Domain_name'];
			$mail_smtpserver=$r1['SMTP'];
			$mail_smtpport=$r1['SMTP_Port'];
			$mail_smtpuser=$r1['Username'];
			$mail_smtppass=$r1['Password'];
			$Signatore=$r1['Signatore'];
		}
	}
	else
	{
	?>
    	<script language="javascript">
			alert("All the fields mandatory to fill");
        </script>
    <?php	
	}
}
else
{
		$quer=mysql_query("select * from `mail_settings` where `user_id`='$user' and status='1'");
		while($r1=mysql_fetch_array($quer))
		{
			$notify_fromname=$r1['From_name'];
			$notify_fromaddress=$r1['From_address'];
			$Domain_name=$r1['Domain_name'];
			$mail_smtpserver=$r1['SMTP'];
			$mail_smtpport=$r1['SMTP_Port'];
			$mail_smtpuser=$r1['Username'];
			$mail_smtppass=$r1['Password'];
			$Signatore=$r1['Signatore'];
	
		}
	
}
?>
<html>
<head>

<script LANGUAGE="JavaScript">
function validateForm(tempn)
{

	var x=document.forms["frm"][tempn].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	  {
	  		alert("Not a valid e-mail address");
			return false;
	  }
	  else
	  {
		  var stlength=x.length;
		  var startlet=atpos+1;
		  
	  	  document.getElementById("mail_smtpuser").value=x;
		  document.getElementById("Domain_name").value=x.substr(startlet,stlength);
		  
	  }
	  
}
function validateFor(tempn)
{
	document.getElementById("mail_smtpserver").value="smtp."+tempn;
}

function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='mailsettings.php';
	document.frm.submit();
}


function gmail1(str)
{
	if(str==1)
	{
		document.getElementById("mail_smtpserver").value="smtp.gmail.com";
		document.getElementById("mail_smtpport").value="465";
		document.getElementById("Domain_name").value="gmail.com";
	}
	else if(str==2)
	{
		document.getElementById("mail_smtpserver").value="smtp.mail.yahoo.com";
		document.getElementById("mail_smtpport").value="465";
		document.getElementById("Domain_name").value="yahoo.com";
	}
	else
	{
		document.getElementById("mail_smtpserver").value="";
		document.getElementById("mail_smtpport").value="";
	
		document.getElementById("Domain_name").value="";
	}

	
}
</script>
 </head>
<body>
<br>
<br>

<form name="frm" action="" method="post">
<table border="1" cellpadding="0" align="center" cellspacing="0" widtd="80%">
    
      <tr>
         <td scope="row" colspan="4" align="center" class='head'>Outgoing Mail Configuration</td>
            </tr>
            
<tr>
              <td width="137" scope="row" nowrap>From Name </td>
              <td colspan="3">
              <input id="notify_fromname" name="notify_fromname" tabindex="1" size="25" maxlengtd="128" value="<?php echo $notify_fromname; ?>" type="text"></td>
            </tr>
            <tr>
              <td scope="row" nowrap>From Address </td>
              <td colspan="3"><input id="notify_fromaddress" name="notify_fromaddress" tabindex="1"  onBlur="validateForm(this.name)"  size="25" maxlengtd="128" value="<?php echo $notify_fromaddress; ?>" type="text"></td>
            </tr>
              <tr id="smtp_autd2">
                      <td scope="row" widtd="20%" nowrap>Domain Name</td>
                      <td colspan="3"><input id="Domain_name" name="Domain_name" size="25" onBlur="validateFor(this.value)" maxlengtd="64" value="<?php echo $Domain_name; ?>" tabindex="1" type="text"></td>
                    </tr>
            <tr>
              <td scope="row" colspan="4" align="left">Choose your Email provider</td>
            </tr>
            <tr>
              <td colspan="4">
 <input type="button" name="gmail"  class="bgbutton" value="gmail" onClick="gmail1(1)">
 <input type="button" name="yahoomail"  class="bgbutton" value="yahoomail" onClick="gmail1(2)">
 <input type="button" name="other"  class="bgbutton" value="other" onClick="gmail1(3)">
                </td>
            </tr>
                  
                    <tr id="mailsettings1">
                      <td scope="row" widtd="20%" nowrap>SMTP Mail Server</td>
                      <td width="222" widtd="30%">
                      <input id="mail_smtpserver" name="mail_smtpserver" tabindex="1" size="25" maxlengtd="64" value="<?php echo $mail_smtpserver; ?>" type="text"></td>
                      <td width="103" scope="row" widtd="20%">SMTP Port</td>
                      <td width="115" widtd="30%"><input id="mail_smtpport" name="mail_smtpport" tabindex="1" size="5" maxlengtd="5" value="<?php echo $mail_smtpport; ?>" type="text"></td>
                    </tr>
                    <tr id="smtp_autd1">
                      <td scope="row" widtd="20%" nowrap>Username</td>
                      <td colspan="3"><input id="mail_smtpuser" name="mail_smtpuser" size="25" maxlengtd="64" value="<?php echo $mail_smtpuser; ?>" tabindex="1" type="text"></td>
                    </tr>
                    <tr id="smtp_autd2">
                      <td scope="row" widtd="20%" nowrap>Password</td>
                      <td colspan="3"><input id="mail_smtppass" name="mail_smtppass" size="25" maxlengtd="64" value="<?php echo $mail_smtppass; ?>" tabindex="1" type="password"></td>
                    </tr>
                    <tr >
                      <td scope="row" widtd="20%" nowrap>Signatore</td>
                      <td colspan="3"><textarea name='Signatore'  cols='44' rows='4'><?php echo $Signatore; ?></textarea></td>
                    </tr>

  </table>
   <br>
   <div align="center">
     <input type="button" name="save"  class="bgbutton" value="save" onClick="reload()">
     <a href= "javascript:OpenWind2('sendtestmail.php?mailid=<?=$mailid?>')">
     <input type="button" name="Send Test Mail"  class="bgbutton" value="Send Test Mail" onClick="SendTestMail()"></a>
   </div>
   
   
</form>
