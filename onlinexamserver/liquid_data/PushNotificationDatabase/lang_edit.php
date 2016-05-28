<?php

include("../database_connection.php");

$langCode= $_REQUEST['langCode'];
$AppId =$_REQUEST['AppId'];
$Imei = $_REQUEST['Imei'];
$regId = $_REQUEST['regId'];

if(strlen(trim($regId) ) == 0 && strlen(trim($Imei ) ) == 0)
{
  return json_encode(array("status"=>"false"));
}

if(strlen(trim($Imei )) != 0 )
	$checkQuery = "update GcmRegisteredUser SET selected_lang= '".$langCode."' where Imei='".$Imei."' and AppId=".$AppId;
else
	$checkQuery = "update GcmRegisteredUser SET selected_lang= '".$langCode."' where regId ='".$regId ."' and AppId=".$AppId;
	
$db->query($checkQuery );
$insertid= mysqli_insert_id($db);
 if($insertid>0)
     echo json_encode(array("status"=>$checkQuery));
    else
     echo json_encode(array("status"=>$checkQuery));
?>