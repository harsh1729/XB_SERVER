<?php

include("../database_connection.php");

$regId = $_REQUEST['regId'];

$Imei = $_REQUEST['Imei'];
////**************************************************////

$checkQuery = "select * from GcmRegisteredGKUser where imei='".$Imei;
//$checkResult = mysqli_query($db,$checkQuery);
$checkResult = $db->query($checkQuery);
$checkRows = mysqli_num_rows($checkResult);


////**************************************************////

if($checkRows == 0)
{
    $regUserQuery = "insert into GcmRegisteredGKUser (gcmid,imei) values ('".$regId."','".$Imei."')";
    
    //mysql_query($regUserQuery);
    $db->query($regUserQuery);
    $userId = mysqli_insert_id($db);
     if($userId>0)
        echo json_encode(array("status"=>"registered"));
    else
        echo json_encode(array("status"=>"false"));       
}    
else
{
    $regUserQuery = "update GcmRegisteredGKUser SET gcmid = '".$regId."' WHERE imei = '".$Imei."'" ;
    
    //mysql_query($regUserQuery);
    $db->query($regUserQuery);
    $userId = mysqli_insert_id($db);
     if($userId>0)
     echo json_encode(array("status"=>"registered"));
    else
    echo json_encode(array("status"=>"false"));
}
?>