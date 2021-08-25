<html>
<head>
<?php
	session_start();
	include("../db.php");
	include("mail_class.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$check=$_POST['check'];
	$remks=$_POST['remks'];

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
$t=0;
$s=0;	
if($check)
{
	
	for($i=0;$i<sizeof($check);$i++)
	{
		$sql123=mysql_query("select first_name,last_name , msgphone from student_m where id='$check[$i]'");
		while($r=mysql_fetch_array($sql123))
		{
			if($r[2]=='' || $r[2]==0 || $r[2]=='0')
			{
				echo "hai";
			}
			else	
			{
				 
				 $mobilenumbers= "$r[2]"; //enter Mobile numbers comma seperated
				 $message = "Announcement $remks"; //enter Your Message 
				 send_msg($mobilenumbers,$message);
				 $s++;
			}
			$t++;
		//end sms code
		}
	}
}
else
{
   
   $sql12.="select first_name,last_name , msgphone from student_m where id is not null and archive='N'";
	if($branch!=0)
	{
	$sql12.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql12.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql12.=" and class_section_id=$class_section_id  ";
	}
	$sql12.=" order by first_name";
	$sql1=mysql_query($sql12);
	$t=0;
	$s=0;
	while($r=mysql_fetch_array($sql1))
	{
		if($r[2]=='' || $r[2]==0 || $r[2]=='0')
		{
			
		}
		else	
		{
				$mobilenumbers= "$r[2]"; //enter Mobile numbers comma seperated
				 $message = "Announcement $remks"; //enter Your Message 
				 send_msg($mobilenumbers,$message);
				 $s++;
		}
		$t++;
	//end sms code
	}
}
echo "<h5>Out of $t students $s MSG Sent Succesfully </h5>\n" ;
?>
</body>
</html>

