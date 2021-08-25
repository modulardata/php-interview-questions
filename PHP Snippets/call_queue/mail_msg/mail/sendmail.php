<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
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

<body onBlur="">
<?php 
session_start();
require("../../db.php");
$user=$_SESSION['user'];
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}

$class_section_id=$_POST['class_section_id'];
$Mail_template=$_POST['Mail_template'];

echo '<form name="frm" action="" method="post" >';	

?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Send Email</td>
    </tr>
     
  <tr>
    <td nowrap>&nbsp;&nbsp;School Division</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
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
   <td>&nbsp;&nbsp;Class </td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='0'>-----Select----</option>
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
echo "<option value=''>--Select--</option>";
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

  <tr>
  <td height="28">&nbsp;&nbsp;Mail Template</td><td>&nbsp;<select name='Mail_template'  onChange="reload()">
<?
$qury=mysql_query("select id, mail_subject  FROM `mail_det` where status=1 and (username='$user' or username='administrator') ORDER BY `mail_date` DESC") or die(mysql_error());
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
</td>
  </tr>
 </table>
<br>
<div align="center"><input type="button" name="open" value="Send Mail"  class="bgbutton" onClick="reload1()"> <a href= "javascript:OpenWind2('ViewTemplate.php?mailid=<?=$Mail_template?>')">
     <input type="button" name="View Template"  class="bgbutton" value="View Template" ></a></div><br>
  <?php
  if($branch=='0')
	die();
	if($sem=='0')
	die();
	if($class_section_id=='')
	die();
	if($Mail_template=='')
	die();
   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'";
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
	
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td width="10%" class="head">Sl No.</td>
    <td width="40%" align="center" class="head">Name</td>
    <td width="20%" align="center" class="head">Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
    <td width="7%" align="center" class="head" nowrap><div class="head" id="checkAll" 
onClick="selectMe()" Title="Click to Select all Students">Select ALL<input type="checkbox"></div></td>
  </tr>
  <?php
  $i=1;
  while($r1=mysql_fetch_array($rs))
  { 
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    ";
	?>
  <td align="center">
	<input type="checkbox" name="check[]" value="<?=$r1[id]?>" >
    
    </td>
  </tr><?php
$i++;  }
  ?>
  
</table>
				
</form>	
</body>
</html>