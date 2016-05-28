<?php
include("database_connection.php");

$test_no = $_REQUEST['test_no'];
    
    $query = "select ques_info.quesid,qrecord.pretextid  from ques_info INNER JOIN qrecord ON ques_info.quesid = qrecord.quesid where ques_info.test_no=".$test_no." and daily_test=1 and qrecord.lang_id='en'";
    $result = mysqli_query($db,$query);
    $num_rows = mysqli_num_rows($result);
    echo json_encode($num_rows);








 ?>