<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='attendance.php';
	document.frm.submit();
	
}
	
</SCRIPT>
</HEAD>

<body>
<?php 
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$examname=$_POST['examname'];
$class_section_id=$_POST['class_section_id'];
$sess=$_POST['sess'];
$tablename="att_".$branch."_".$sem;
$msgidnumaber=$_POST['msgidnumaber'];
$msgidname=$_POST['msgidname'];
$sysdate=date("Y-m-d");
session_start();
require("../db.php");
include("mail_class.php");
if($_POST['open'])
{
	$sysdate1=date("d-m-Y");
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	$tt=0;
	$flag=1;
	for($i=0;$i<sizeof($studentid);$i++)
	{
		$sql5=execute(" select id from $tablename where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and mor='0'");
		if(mysql_num_rows($sql5)>0)
		{
			$message="Dear Parent, your ward $msgidname[$i] is absent today $sysdate1";
			$mobilenumbers=$msgidnumaber[$i];
			
			send_msg($mobilenumbers,$message);
			$flag=0;
			$tt++;
		}	
		
	}
	$sql6=execute("select count(mor) from $tablename where att_date='$sysdate' and sec='$class_section_id' ");
	if(mysql_num_rows($sql6)>0)
	{	
		$flag=0;
	}
	if($flag==1)
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("attendance not taken");
		</SCRIPT>
		<?php
	}
	else
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Msg Sent Succesfully to Parent");
		</SCRIPT>
		<?php
	}
	
}
	

?>		<form name="frm" action="" method="post" >
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">SEND ATTENDANCE TO PARENTS</td>
    </tr>
     
  <tr>
    <td>&nbsp;&nbsp;School Division:</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------ALL-----</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=mysql_fetch_array($rs);

						if($branch==$r[course_id])
						{
							?>
							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
							<?php
						}
					}
				?>
			</select>
			</td>
		
  </tr>
  <tr>
   <td>&nbsp;&nbsp;Class :</td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='0'>-----ALL----</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
			?>
			</select>

		</td>
  </tr>

  <tr>
  <td height="28">&nbsp;&nbsp;Section </td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
<?
$rs_section=execute("select * from class_section");
echo "<option value=''>--ALL--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>

</td>
  </tr>
 
</table>
<?php
 if($branch=='0')
	die();
	if($sem=='0')
	die();
	if($class_section_id=='')
	die();
   $sql123.="select id, first_name, msgphone from student_m where id is not null and archive='N'";
	if($branch!=0)
	{
	$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='-1')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by first_name";

$sq1=mysql_query($sql123);
while($r5=mysql_fetch_array($sq1))
{

	echo "
	<input type='hidden' name='studentid[]' value='$r5[0]' >
	<input type='hidden' name='msgidname[]' value='$r5[1]' >
	<input type='hidden' name='msgidnumaber[]' value='$r5[2]'>";
}	
	


?>
<br>
<div align="center"><input type="submit" class="bgclass" name="open" value="SEND" ></div><br>
</form>	
</body>
</html>
