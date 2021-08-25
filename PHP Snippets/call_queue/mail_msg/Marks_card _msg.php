<html>
<head>
<?php
session_start();
include("../db.php");
die();
?>
<?php
	$stuid=$_POST['stuid'];
	$stuname=$_POST['stuname'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$admissionid=$_POST['admissionid'];
	$student_id=$_POST['student_id'];
	$check=$_POST['check'];


?>
<script LANGUAGE="JavaScript">
function setPageBreak()
{
document.getElementById("footer").style.pageBreakAfter="always";
}
function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
</head>
<body>
<?php
		$sqlt=mysql_query("select * from college");
		while($r=mysql_fetch_array($sqlt))
		{
			
			$col_name=$r[col_name];
			$col_code=$r[col_code];
			$col_addr=$r[col_addr];
			$col_pin=$r[col_pin];
			$col_phone=$r[col_phone];
			$col_fax=$r[col_fax];
			$email=$r[email];
		}
if(!$check)
{
//start	
$sql111=mysql_query("SELECT posi FROM exam_topers WHERE exam_id='$examid' and stud_id='$studentid'");
if(mysql_num_rows($sql111)>0)
{
?>

      <?php $examnamed1=mysql_fetch_row(mysql_query("SELECT descr FROM exam_m where id='$examid'")); 
	$phonenum=mysql_fetch_row(mysql_query("SELECT msgphone FROM student_m where id='$studentid'"));
	$stuname=mysql_fetch_row(mysql_query("SELECT first_name FROM student_m where id='$studentid'"));
	$det=$examnamed1[0]."   Name.$stuname[0] ";
	$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=mysql_fetch_array($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
	$max_mark=$r1['max_mark'];
}
$assmk='a.assmk'.$exam_count;
$assmk1='assmk'.$exam_count;
$ba="a.ba".$exam_count;
$totalmark=0;
$scormark=0;
if(sizeof($subid)<11)
$arrsize=10;
for($i=0;$i<=$arrsize;$i++)
{
	$tablename="marks_".$branch."_".$sem;	
	$markqury=mysql_query("select $assmk,b.subject_code,$ba from $tablename a, subject_m b where a.studid='$studentid' and a.subid='$subid[$i]' and b.subject_id=a.subid");
	
		$markqury1=mysql_query("select sub_type from subject_m  where subject_id='$subid[$i]'");
		$name=mysql_fetch_row($markqury1);
		while($mark=mysql_fetch_array($markqury))
		{
		$markqury12=mysql_query("select max($assmk) from $tablename a where subid='$subid[$i]' and accyr='$accyear' ");
		$maxmarkt=mysql_fetch_row($markqury12);
	
		if($name[0]<3)
			$det.="   $mark[1]";
		else
			$det.="   $mark[1] #";
		$det.="-$mmks[$i]";
		if($mark[0]>0)
		{
			$per=$mark[0]*100/$mmks[$i];
			if($per<35)
			{
				if($name[0]<3)
					$ovrflg="Fail";
				$det.="/$mark[0] *";
			}	
			else
				$det.="/$mark[0]";
		}
		else
		{
			$per=0;
			if($name[0]<3)
			{
				if($ovrflg!='Fail')
					$ovrflg='Ab';
			}
			$det.="/Ab";
		}
		
		  if($name[0]<3)
			{
				$marktotal=$marktotal+$mmks[$i];
				$scormark=$scormark+$mark[0];
			}
		}
	
}
		$sql6=mysql_query("SELECT posi FROM exam_topers WHERE exam_id='$examid' and stud_id='$studentid'");
		$stposi=mysql_fetch_row($sql6);
		$sql7=mysql_query("SELECT count(posi) FROM exam_topers WHERE exam_id='$examid' and sec_id='$class_section_id'");
		$maxposi=mysql_fetch_row($sql7);
		$det.="   TOT=$marktotal/$scormark"; 
        $det.="   POSI=";
	if($ovrflg=='Fail')
		$det.="Fail";
	elseif($ovrflg=='Ab')
		$det.="Ab";
	else
	$det.="$stposi[0]/$maxposi[0]";
$ks1=10-$ks;
$ct=0;
$rs_ec=execute("select id from exam_m where curriculam='$branch' and class='$sem' and id<='$examid' and accyear='$accyear' ");
	if($scormark>0)
	{
		$pert=(100*$scormark)/$marktotal;
		$det.="   PER=".round($pert, 2);
	}
	else
$det.='0';
	if($ovrflg=='Fail')
	{
		$markqury14=mysql_query("select name,remarks from grade where g_from<='$pert' and g_to>='$pert' ");
		$maxmark4=mysql_fetch_row($markqury14);
		$maxmark4[1]='Fail';
	}
	elseif($ovrflg=='Ab')
	{
		$maxmark4[0]='&nbsp';
		$maxmark4[1]='&nbsp';
	}
	else
	{
		$markqury14=mysql_query("select name,remarks from grade where g_from<='$pert' and g_to>='$pert' ");
		$maxmark4=mysql_fetch_row($markqury14);
	}
 
$det.="($maxmark4[0])";
	$ccval=fetcharray(execute("select cc,ca,sub_remks from exam_topers where exam_id='$examid' and stud_id='$studentid'"));
	$cc=$ccval[cc];
	$ca=$ccval[ca];
	$sub_remks=stripslashes($ccval[sub_remks]);
    $det.="   ATT=$cc/$ca" ?>
    <?php 
	//echo "PER".$teee=round(($ca*100)/$cc,2);
	 echo $phonenum[0]."   ".$det;
	 ?>
   

	<?php
//end

	}
	else
	{
		echo "<div><font color='brown'><b>Marks for selected examination not entered...</b></font></div>";
	}
}
$examid=$_POST['examname'];
for($d1=0;$d1<sizeof($check);$d1++)
{
$ovrflg='';
$stuid=$_POST['stuid'.$check[$d1]];
$stuname=$_POST['stuname'.$check[$d1]];
$studentid=$check[$d1];
$admissionid=$_POST['admissionid'.$check[$d1]];
//start	
$sql111=mysql_query("SELECT posi FROM exam_topers WHERE exam_id='$examid' and stud_id='$studentid'");
if(mysql_num_rows($sql111)>0)
{
?>

      <?php $examnamed1=mysql_fetch_row(mysql_query("SELECT descr FROM exam_m where id='$examid'")); 
	  $phonenum=mysql_fetch_row(mysql_query("SELECT msgphone FROM student_m where id='$studentid'"));
	$stuname=mysql_fetch_row(mysql_query("SELECT first_name FROM student_m where id='$studentid'"));
	$det=$examnamed1[0]."   NAME : $stuname[0] ";
	$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=mysql_fetch_array($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
	$max_mark=$r1['max_mark'];
}
$assmk='a.assmk'.$exam_count;
$assmk1='assmk'.$exam_count;
$ba="a.ba".$exam_count;
$totalmark=0;
$scormark=0;
if(sizeof($subid)<11)
$arrsize=10;
for($i=0;$i<=$arrsize;$i++)
{
	$tablename="marks_".$branch."_".$sem;	
	$markqury=mysql_query("select $assmk,b.subject_code,$ba from $tablename a, subject_m b where a.studid='$studentid' and a.subid='$subid[$i]' and b.subject_id=a.subid");
	
		$markqury1=mysql_query("select sub_type from subject_m  where subject_id='$subid[$i]'");
		$name=mysql_fetch_row($markqury1);
		while($mark=mysql_fetch_array($markqury))
		{
		$markqury12=mysql_query("select max($assmk) from $tablename a where subid='$subid[$i]' and accyr='$accyear' ");
		$maxmarkt=mysql_fetch_row($markqury12);
	
		if($name[0]<3)
			$det.="   $mark[1]";
		else
			$det.="   $mark[1] #";
		
		if($mark[0]>0)
		{
			$per=$mark[0]*100/$mmks[$i];
			if($per<35)
			{
				if($name[0]<3)
					$ovrflg="-Fail";
				$det.="-$mark[0] *";
			}	
			else
				$det.="-$mark[0]";
		}
		else
		{
			$per=0;
			if($name[0]<3)
			{
				if($ovrflg!='Fail')
					$ovrflg='Ab';
			}
			$det.="-Ab";
		}
		$det.="/$mmks[$i]";
		  if($name[0]<3)
			{
				$marktotal=$marktotal+$mmks[$i];
				$scormark=$scormark+$mark[0];
			}
		}
	
}
		$sql6=mysql_query("SELECT posi FROM exam_topers WHERE exam_id='$examid' and stud_id='$studentid'");
		$stposi=mysql_fetch_row($sql6);
		$sql7=mysql_query("SELECT count(posi) FROM exam_topers WHERE exam_id='$examid' and sec_id='$class_section_id'");
		$maxposi=mysql_fetch_row($sql7);
		$det.="   TOT=$scormark/$marktotal"; 
        $det.="   POSI=";
	if($ovrflg=='Fail')
		$det.="Fail";
	elseif($ovrflg=='Ab')
		$det.="Ab";
	else
	$det.="$stposi[0]/$maxposi[0]";
$ks1=10-$ks;
$ct=0;
$rs_ec=execute("select id from exam_m where curriculam='$branch' and class='$sem' and id<='$examid' and accyear='$accyear' ");
	if($scormark>0)
	{
		$pert=(100*$scormark)/$marktotal;
		$det.="   PER=".round($pert, 2);
	}
	else
$det.='0';
	if($ovrflg=='Fail')
	{
		$markqury14=mysql_query("select name,remarks from grade where g_from<='$pert' and g_to>='$pert' ");
		$maxmark4=mysql_fetch_row($markqury14);
		$maxmark4[1]='Fail';
	}
	elseif($ovrflg=='Ab')
	{
		$maxmark4[0]='&nbsp';
		$maxmark4[1]='&nbsp';
	}
	else
	{
		$markqury14=mysql_query("select name,remarks from grade where g_from<='$pert' and g_to>='$pert' ");
		$maxmark4=mysql_fetch_row($markqury14);
	}
 
$det.="($maxmark4[0])";
	$ccval=fetcharray(execute("select cc,ca,sub_remks from exam_topers where exam_id='$examid' and stud_id='$studentid'"));
	$cc=$ccval[cc];
	$ca=$ccval[ca];
	$sub_remks=stripslashes($ccval[sub_remks]);
    $det.="   ATT=$ca/$cc" ?>
    <?php 
	//echo "PER".$teee=round(($ca*100)/$cc,2);
	// echo $phonenum[0]."   ".$det;
	 ?>
      

	<?php
//end
if($phonenum[0]=='' or $phonenum[0]==0)
{
echo "<h3><font color='RED'>Number of Found Unable to send Marks to $stuname[0] Parrents</h3>\n" ;
}
else
{
/************* SMS API Starts ***************/


	 $user="cniblr"; //your username
	 $password="123456"; //your password
	 $mobilenumbers= "$phonenum[0]"; //enter Mobile numbers comma seperated
	 $message = "$det"; //enter Your Message 
	 $senderid="CNI HQ"; //Your senderid
	 $senderid="NAVANEETH"; //Your senderid
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
		echo 'Oops, we encountered some error : '. curl_error($ch);

	 if (empty($ret)) {
		// some kind of an error happened
		die(curl_error($ch));
		curl_close($ch); // close cURL handler
	 } else {
		$info = curl_getinfo($ch);
		curl_close($ch); // close cURL handler
		//echo "   ";
		//echo $curlresponse;    
		echo "<h3><font color='blue'>Marks Sent Succesfully to $stuname[0] Parrents</font></h3>\n" ;
	}
}

//end sms code
	}
}
?>
</body>
</html>

