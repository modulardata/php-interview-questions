<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='lessonplan.php';
	document.frm.submit();
	
}
function reload1()
{
	document.frm.action='lessonplan.php';
	document.frm.submit();
	
}
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}	
</SCRIPT>
</HEAD>

<body>
<?php 
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$examname=$_POST['examname'];
$class_section_id=$_POST['class_section_id'];

session_start();
require("../db.php");
include("mail_class.php");

	$rdate=date("Y-m-d");
	$tdate=date("d-m-Y");
if($_POST['SendMSG'])
{
	$message='';
	$message12="Lesson Plan for $tdate ";
	$sql3=execute("select subject_id, subject_code from subject_m where  course_id='$branch' and course_year_id='$sem' and status='1' order by sub_pre");
	while($r3=mysql_fetch_array($sql3))
	{
		
		$sql24=mysql_query("select topic , description from teacher_lesson_plan where subj='$r3[0]' and  r_date='$rdate' and sec='$class_section_id' and parent_r=1");
		while($r4=mysql_fetch_array($sql24))
		{
			$message.=" $r3[1]- $r4[1] ,";
			
		}	
			
	}
			$t=0;
			$s=0;
			 $sql123=execute("select first_name,msgphone from student_m where id is not null and archive='N' and course_admitted=$branch and course_yearsem=$sem and class_section_id=$class_section_id  order by first_name");
			while($r5=mysql_fetch_array($sql123))
			{
				if($r5[1]=='' || $r5[1]=='0' || $r5[1]==0)
				{
					
				}
				else
				{
					$message=$message12.$message;
					send_msg($r5[1],$message);
					$s++;
				}
				$t++;
			}	
		

	echo "<h5>Out of $t students $s MSG Sent Succesfully </h5>\n" ;
}
echo '<form name="frm" action="" method="post" >';	
	
  ?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">SEND LESSON PLAN TO PARENT</td>
  </tr>
     
  <tr>
    <td>&nbsp;&nbsp;School Division:</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------SELECT-----</option>
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
			<option value='0'>-----SELECT----</option>
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
  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
<?
$rs_section=execute("select * from class_section");
echo "<option value=''>--SELECT--</option>";
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
 
  
</table>
<br>
<div align="center"><input type="submit" name="SendMSG" value="SendMSG" class="bgbutton"></div><br>
			
</form>	
</body>
</html>