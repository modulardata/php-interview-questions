
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
	$delete=$_REQUEST['delete'];
	if($delete==1 and $id1>0)
	{
		$bodydet1="update `mail_det` set `status`='0' where id='".$id1."' and count=0";
		mysql_query($bodydet1);
		?>
			<SCRIPT LANGUAGE ="JavaScript">
			alert("Mail Template Deleted Successfully");
			</script>
		<?php
	}
	
$qury=mysql_query("select *  FROM `mail_det` where status=1 ORDER BY `mail_date` DESC") or die(mysql_error());
  
 ?>
&nbsp;&nbsp;&nbsp;&nbsp;  
    <a href="output_html.php" ><input type="button" name="Modify" value="Add New" class="bgbutton"  /></a>
	<br /><br />
<br />
<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="6" class="head">Modify Mail Template</td>
  </tr>
  <tr>
    <td align="center" class="row3" width="8%">&nbsp;Sl No.</td>
    <td align="center" class="row3" width="50%">&nbsp;Mail</td>
    <td align="center" class="row3">&nbsp;Date</td>
    <td align="center" class="row3">&nbsp;Action</td>
    <td align="center" class="row3">&nbsp;Delete</td>
    <td align="center" class="row3">&nbsp;Count</td>
  </tr>
  
<?php
$i=1;
while($r=mysql_fetch_array($qury))
{

echo "  <tr>
    <td align='center'>&nbsp;$i</td>
    <td>&nbsp;$r[1]</td>
    <td align='center'>&nbsp;$r[4]</td>";
	if($r[6]==0)
	{
echo "<td align='center'><a href='ajax_html.php?id=$r[0]'>Modify</a></td>
    <td align='center'><a href='modifymail.php?id=$r[0]&delete=1'>Delete</a></td>";
	}
	else
	{
echo "	<td align='center'>Modify</td>
    	<td align='center'>Delete</td>";
	}
echo "<td align='center'>";
if($r[6]!=0)
{
	?>
	<a href='javascript:OpenWind2("sentmaildet.php?id=<?php echo $r[0]; ?>")'>
	<?php
	echo "$r[6]</a>";
}
else
echo "$r[6]";

echo "</td></tr>";
$i++;
}
?>

</table>
</form>

</body>
</html>