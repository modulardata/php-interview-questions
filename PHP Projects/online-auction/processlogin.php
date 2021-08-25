<?php
session_start();
include('config1.php');
//Fetches username and password variables
$username = $_POST['name'];
$password = $_POST['password'];

//Checks and validates password and accepts or displays errors
if($uname == $username && $pword == $password)
{
header('Location: '.$target);
}
else
{ 
header('Location: '.$error1);
}
?>