<?php

include("../database_connection.php");

$DeviceId = $_REQUEST['deviceId'];
$Message = addslashes($_REQUEST['msg']);
$mailId = $_REQUEST['email'];
$gcmId = $_REQUEST['gcmId'];

$insertQuery = "insert into userReview (deviceId,Message,email,gcmId) values ('".$DeviceId."','".$Message."','".$mailId."','".$gcmId."')";
//mysql_query($insertQuery);
$db->query($insertQuery);

?>