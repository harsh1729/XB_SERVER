<?php
include("database_connection.php");
session_start();
$AppId=$_SESSION['Application_Id'];
$pay_type = $_REQUEST['pay_type'];
if(isset($_REQUEST['pay_amount']))
{
    $pay_amount =$_REQUEST['pay_amount'];
}

if($pay_amount !== "")
{
  $query = "insert into set_info(pay_type,payment_amount,app_id)values(".$pay_type.",".$pay_amount.",".$AppId.")";
  mysqli_query($db,$query);  
}
else
{
    $query = "insert into set_info(pay_type,app_id)values(".$pay_type.",".$AppId.")";
  mysqli_query($db,$query);
}
  



?>