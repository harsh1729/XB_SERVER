<?php

include("database_connection.php");

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$AppId = $_REQUEST['Appid'];

$query = "select * from dataentryusers where username='".$username."' and password='".$password."'";
//$r = mysql_query($query);
$r = $db->query($query) or die(mysqli_error($db));
//$count = mysql_num_rows($r);
$count = mysqli_num_rows($r);
if($count==1)
{
	$row = mysqli_fetch_array($r);
	session_start();
	$_SESSION['data_login_id'] = $row['id'];
	$_SESSION['Application_Id'] = $AppId;
	header("location:question_entry.php");
}
else
{
	header("location:../index.php");
}

?>