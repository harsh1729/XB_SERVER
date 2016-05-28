<?php
include("database_connection.php");
session_start();
$AppId=$_SESSION['Application_Id'];
$pdf_name = $_REQUEST['pdf_name'];
$pdf_type = (int)$_REQUEST['pdf_type'];
$pdf_pay_type = (int)$_REQUEST['pdf_pay_type'];
$pdf_link =  $_REQUEST['pdf_link'];
$size=  $_REQUEST['pdf_size'];
$discription = $_REQUEST['discription'];



if(isset($_REQUEST['pay_amount']))
{
    $pdf_pay_amount =(int)$_REQUEST['pdf_amount'];
}

if($pdf_pay_amount !== "" && $pdf_pay_amount !== null)
{
  $query = "insert into pdf_table(type,name,pay_type,amount,pdf_link,size,discription)values(".$pdf_type.",'".$pdf_name."',".$pdf_pay_type.",".$pdf_pay_amount.",'".$pdf_link."','".$size."   KB','".$discription."')";
  mysqli_query($db,$query);  
  $id = (int)mysqli_insert_id($db);
  
  $query1 ="update pdf_table set item_id=".$id." where id=".$id;
  mysqli_query($db,$query1); 
  echo json_encode($pdf_pay_amount);
}
else
{
   $query = "insert into pdf_table(type,name,pay_type,pdf_link,size,discription)values(".$pdf_type.",'".$pdf_name."',".$pdf_pay_type .",'".$pdf_link."','".$size."KB','".$discription."')";
  mysqli_query($db,$query);  
   $id = mysqli_insert_id($db);
  
  $query1 ="update pdf_table set item_id=".$id." where id=".$id;
  mysqli_query($db,$query1); 
    echo json_encode($id);

}


?>