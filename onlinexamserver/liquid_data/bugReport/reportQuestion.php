<?php

include("../database_connection.php");

$QuesId = $_REQUEST['quesID'];
$gcmId = $_REQUEST['gcmID'];
$message= $_REQUEST['bugDetail'];

$insertQuery = "insert into QusBugReport (QuesId,gcmId,bug_detail) values (".$QuesId.",'".$gcmId."','".$message."')";
//mysql_query($insertQuery);
$db->query($insertQuery);

?>