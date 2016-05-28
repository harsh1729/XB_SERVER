<?php
include("../database_connection.php");
//$db = "xamDB";
//mysql_connect("localhost","root","");
//mysql_select_db($db)or die("unable to select database");

session_start();

$AppId = $_SESSION['Application_Id'];


$questionCategoryId = 1;
$datetime = $_REQUEST['datetime'];
$category = $_REQUEST['update_category'];
$reference = $_REQUEST['bankname'];
$QuestionText = addslashes($_REQUEST['questionText']);
$quesIdGen = $_REQUEST['QuesId'];

	
//////********************************************************/
/*	 UPDATE QUESTION COLUMNS WHERE QuesId = QUESTIONiD	  	 */
//////********************************************************/
$updateQuestionTable = "update Turorials set text = '".$QuestionText."' , CatId= ".$category.", reference= '".$reference."',datetime='".$datetime."' where id = ".$quesIdGen;
$updateQuestionResult = mysqli_query($db, $updateQuestionTable );
if( !$updateQuestionResult )
{
	header("location:updateEntry.php?updateStatus=Question Not Updated! Please Check your Question !") or die();
}
else
{
header("location:update_tutorial.php?updateStatus=Updated succesfully&QuesId=".$quesIdGen);
}	
	

?>