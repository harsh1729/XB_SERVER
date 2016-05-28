<?php

include("../database_connection.php");

$regId = $_REQUEST['regId'];
$AppId =$_REQUEST['AppId'];
$Imei = $_REQUEST['Imei'];
////**************************************************////

if(strlen(trim($regId) ) == 0  &&  strlen(trim($Imei ) ) == 0 )
{
  return json_encode(array("status"=>"false"));
}


if(strlen(trim($Imei )) != 0 )
	$checkQuery = "select * from GcmRegisteredUser where Imei='".$Imei."' and AppId=".$AppId;
else   	
	$checkQuery = "select * from GcmRegisteredUser where regId='".$regId."' and AppId=".$AppId;
//$checkResult = mysqli_query($db,$checkQuery);
$checkResult = $db->query($checkQuery);
$checkRows = mysqli_num_rows($checkResult);

 //echo json_encode(array("status"=>$checkRows ));
////**************************************************////

if($checkRows == 0 )
{
    if(strlen(trim($regId) ) != 0 ){
    	$regUserQuery = "insert into GcmRegisteredUser (regId,AppId,Imei) values ('".$regId."',".$AppId.",'".$Imei."')";
    
    	//mysql_query($regUserQuery);
    	$db->query($regUserQuery);
    	$userId = mysqli_insert_id($db);
    	if($userId>0)
        	echo json_encode(array("status"=>"registered"));
    	else
           	echo json_encode(array("status"=>"false"));
        	//echo "false";        
        }
        else
         	echo json_encode(array("status"=>"false"));
}    
else
{
	if(strlen(trim($Imei )) != 0){
    		$regUserQuery = "update GcmRegisteredUser SET regId = '".$regId."' WHERE Imei = '".$Imei."'" ;
    
    		//mysql_query($regUserQuery);
    		$db->query($regUserQuery);
    		$userId = mysqli_insert_id($db);
    		if($userId>0)
    		 	echo json_encode(array("status"=>"registered"));
    		else
         		echo json_encode(array("status"=>"false"));
    }
    else
         		echo json_encode(array("status"=>"false"));
}
?>