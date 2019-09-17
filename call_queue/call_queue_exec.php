<?php
    require_once('db1.php');
	include("mailclass.php");
	if($_POST)
	{
		$assigned_user=$_REQUEST['agent_name'];
		$enq_id=$_POST['enq_id'];
		$name=$_POST['name'];
		$course_interested=$_POST['course_interested'];
		$location=$_POST['location'];
		$phone_no=$_POST['phone_no'];
		$email_id=$_POST['email_id'];
		$comments=$_POST['comments'];
		$enq_status=$_POST['enq_status'];
		$reason=$_POST['reason'];
		$other_reason=$_POST['other_reason'];
		$follow_up_date=$_POST['follow_up_date'];
		$follow_up_date_time=$_POST['follow_up_date_time'];
		$Mail_template=$_POST['Mail_template'];
	}
	if($_REQUEST)
	{
		$assigned_user=$_REQUEST['agent_name'];
		$enq_id=$_POST['enq_id'];
		$name=$_POST['name'];
		$course_interested=$_POST['course_interested'];
		$location=$_POST['location'];
		$phone_no=$_POST['phone_no'];
		$email_id=$_POST['email_id'];
		$comments=$_POST['comments'];
		$enq_status=$_POST['enq_status'];
		$reason=$_POST['reason'];
		$other_reason=$_POST['other_reason'];
		$follow_up_date=$_POST['follow_up_date'];
		$follow_up_date_time=$_POST['follow_up_date_time'];
	}
	//print_r($_POST);
	//echo "<br/>";
	//print_r($_REQUEST);
	
##########################################################  FOR REMEANING RECORD INSERTITION  ###########################################################
 
  $query="UPDATE call_queue SET enq_status='$enq_status', comments='$comments', follow_up_date='$follow_up_date', follow_up_date_time='$follow_up_date_time', reason='$reason', other_reason='$other_reason' WHERE enq_id='$enq_id' AND phone_no='$phone_no' AND email_id='$email_id'";
	
        $result=mysql_query($query);
/*
	
	$qury1=mysql_fetch_row(mysql_query("select mail_content,mail_subject  FROM `mail_det` where id='$Mail_template'"));
    $message=$qury1[0];
    $subject=$qury1[1];
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

$t=0;
$s=0;
 
$ref = getenv("HTTP_REFERER");
$ref1=explode('call_queue.php',$ref);
$updatelinkname=$ref1[0]."count.php?id=";

if($check)
{
	
	for($i=0;$i<sizeof($check);$i++)
	{
		$sql123=mysql_query("select parent_name, rgmailid from student_m where id='$check[$i]'");
		while($r=mysql_fetch_array($sql123))
		{
			if($r[1]!='')
			{
				$parent_mailid= $r[1];
				$sql=mysql_num_rows(mysql_query("select id from mail_sent_count where to_mail_id='$parent_mailid' and mail_det_id='$Mail_template'"));				
				
					$parent_name= "Dear Mr & Mrs $r[0] <br>";
					$updatelinkname=$updatelinkname.$Mail_template."&mailid=".$parent_mailid;
					
					$sql1="INSERT INTO `mail_sent_count` (`username`, `mail_det_id`, `from_mail_id`, `to_mail_id`, `student_id`, `mail_date`, `mail_time`, `mail_count`) VALUES
	( '".$user."', '".$Mail_template."', '".$notify_fromaddress."', '".$parent_mailid."', '".$check[$i]."', '".date("Y-m-d")."', '".date("H:i:s")."', 0)";
					
					mysql_query($sql1);
					
					$mail_boday=$parent_name.$message."<br><br>".$Signatore.'<img src="'.$updatelinkname.'" width="0" height="0" border="0" />
					<br><br><div align="center"><img class="new1" src="http://focusedu.net/myschoolfooter.jpg"></div>';
					send_mail($notify_fromaddress,$parent_mailid,$mail_smtpserver,$mail_smtpport,$mail_smtpuser,$Domain_name,$mail_smtppass,$subject,$mail_boday);		
				
				$s++;
			}
			$t++;
		//end sms code
		}
	}
}
				$sql2=mysql_fetch_row(mysql_query("select count from mail_det where id='$Mail_template'"));				
				$newtot=$sql2[0]+$s;
				mysql_query("update mail_det set count='$newtot' where  id='$Mail_template'");
echo "<h5>Out of $t students $s Mail Sent Succesfully </h5>\n" ;

*/
         echo "<META HTTP-EQUIV='Refresh' Content='0;URL=call_queue.php'>";
?>
