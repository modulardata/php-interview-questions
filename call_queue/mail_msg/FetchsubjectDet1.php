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
	document.frm.action='FetchsubjectDet1.php';
	document.frm.submit();
	
}
function reload1()
{
	document.frm.action='Marks_card1.php';
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
echo '<form name="frm" action="" method="post" >';	

session_start();
require("../db.php");
?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">SEND MSG PARRENTS</td>
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
  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
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
   <tr>
   <td colspan="2" align="center" class="head">ENTER MSG</td>
  </tr>
  <tr>
   <td colspan="2" align="center" ><textarea name='remks'  cols='44' rows='4'></textarea></td>
  </tr>
</table>
<br>
<div align="center"><input type="button" name="open" value="Send MSG"  class="bgbutton" onClick="reload1()"></div><br>
  <?php
  if($branch=='0')
	die();
	if($sem=='0')
	die();
	if($class_section_id=='')
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
    <td width="10%" class="rowhead">Sl No.</td>
    <td width="40%" align="center">Name</td>
    <td width="20%" align="center">Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
    <td width="7%" align="center"><div id="checkAll" onMouseOver="this.style.backgroundColor='blue';
this.style.cursor='hand';this.style.color='white'"
onMouseOut="this.style.backgroundColor='#E9D0B6';this.style.cursor='default';this.style.color='black'"
onClick="selectMe()" Title="Click to Select all Students"><b>X</b></div></td>
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