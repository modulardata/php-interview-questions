
<html>
<head>

    <link href="../../../mistStyle.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
 </head>

<body class="samplebody">


<form>
 <?php
	 include("../../../db.php");
	 
	$id1=$_REQUEST['id'];
	
$maidet=mysql_fetch_row(mysql_query("select `mail_subject`  FROM `mail_det` where id='$id1'"));
  
 ?>
<br />
<br />
<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="6" class="head">Email Template - <?php echo $maidet[0]; ?></td>
  </tr>
  <tr>
    <td align="center" class="row3" width="5%" nowrap>&nbsp;Sl No.</td>
    <td align="center" class="row3" nowrap>&nbsp;Student Name</td>
    <td align="center" class="row3" nowrap>&nbsp;Recipient Email</td>
    <td align="center" class="row3" nowrap>&nbsp;Sent Date</td>
    <td align="center" class="row3" nowrap>&nbsp;Hits</td>
  </tr>
  
<?php
	
$qury=mysql_query("select *  FROM `mail_sent_count` where mail_det_id='$id1' ORDER BY `id` DESC") or die(mysql_error());
  

$i=1;
while($r=mysql_fetch_array($qury))
{

echo "  <tr>
    <td align='center'>&nbsp;$i</td>";
    $student=mysql_fetch_row(mysql_query("select first_name, last_name  FROM `student_m` where id='$r[5]'"));
	echo "
	<td >&nbsp;$student[0] $student[1]</td>";
	
	echo "<td>&nbsp;$r[4]</td>
	<td align='center'>$r[6]</td>
    <td align='center'>$r[8]</td></tr>";
$i++;
}
?>

</table>
</form>

</body>
</html>