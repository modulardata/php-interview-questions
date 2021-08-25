<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Design and Development of Multi Attribute Decision Making Model in Reverse Auction</title>
</head>

<body>
<?php
       session_start();
if(isset($_SESSION['logged']) && $_SESSION['logged']==1)
{
}
else
{
	$redirect=$_SERVER['PHP_SELF'];
	header("Refresh: 5; URL=http://localhost/r/login.php?redirect=$redirect");
	echo "you are being redirected to the login page!!!<br>";
	echo "(if your browser doesnot support!!! this,"."<a href=\"login.php?redirect=$redirect\">click here</a>)";  
	die();
}
?>


</body>
</html>
