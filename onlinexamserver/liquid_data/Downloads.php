<?php
session_start();
if(!isset($_SESSION['data_login_id']))
    header("location: www.xercesblue.in/OnlineXamServer/index.php");

include("database_connection.php");

$selectDownloadQuery = "select * from downloadcounter";
//$selectDownloadResult = mysql_query($selectDownloadQuery);
$selectDownloadResult = $db->query($selectDownloadQuery);
$dwnldCount = mysqli_num_rows($selectDownloadResult);
echo "Total downloads are : ".$dwnldCount;

?>