<?php
    
include("../database_connection.php");

$QuesId = $_REQUEST['QuesId'];

$query2 = "select id from qrecord where quesid=".$QuesId;
$result = mysqli_query($db,$query2);
$array = array();
while($row = mysqli_fetch_array($result))
{
    array_push($array, $row['id']);
}

$query1 = "delete from ques_info where quesid =".$QuesId;
mysqli_query($db,$query1);

$query = "delete from qrecord where quesid =".$QuesId;
mysqli_query($db,$query);



$oquery = "delete from options where QuesId  in (".implode(',',$array).")";
mysqli_query($db,$oquery);

header("location:../show_newonlineserver_data.php?from=".$from."&to=".$to); 

?>