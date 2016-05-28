<?php
    
include("../database_connection.php");

$QuesId = $_REQUEST['QuesId'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$query = "delete from qrecord where QuesId =".$QuesId;
 mysqli_query($db,$query);
$oquery = "delete from options where QuesId =".$QuesId;
mysqli_query($db,$oquery);
header("location:../show_newonlineserver_data.php?from=".$from."&to=".$to); 

?>