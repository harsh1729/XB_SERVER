<?php
include("database_connection.php");
session_start();
    $set_no = $_REQUEST['set_no'];
    
    $query = "select ques_info.quesid,ques_info.set_no,ques_info.quescatid,ques_info.correctopt,ques_info.userid,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid  from ques_info INNER JOIN qrecord ON ques_info.quesid = qrecord.quesid where ques_info.set_no=".$set_no." and qrecord.lang_id='en'";
    $result = mysqli_query($db,$query);
    $num_rows = mysqli_num_rows($result);
    echo json_encode($num_rows);
?>