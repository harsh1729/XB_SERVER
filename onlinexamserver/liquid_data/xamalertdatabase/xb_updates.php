<?php

include("../database_connection.php");
$checkQuery = "select * from Xb_Updates";
//$checkResult = mysqli_query($db,$checkQuery);
$checkResult = $db->query($checkQuery);
$rowCount = mysqli_num_rows($checkResult ) ;
$jsonArrayMain = array();
if( $rowCount > 0 )
{
    
    foreach ($checkResult as $key => $QuestionSelectRow){
        $jsonArray = array();
        $jsonArray['id'] = $QuestionSelectRow['id'];
        $jsonArray['heading'] = $QuestionSelectRow['heading'];
        $jsonArray['url'] = $QuestionSelectRow['url'];
        $jsonArray['image'] = "http://www.xercesblue.in/onlinexamserver/liquid_data/uploadedImages/".$QuestionSelectRow['image'];
        array_push($jsonArrayMain, $jsonArray);
    }
}

$arrayvideo = array();
$arrayvideo['update'] = $jsonArrayMain;
echo json_encode($arrayvideo);
?>