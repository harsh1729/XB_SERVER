<?php
session_start();
include("database_connection.php");

// Variables not to be listed (blocked variables... like the submit button)
$blocked = array('submitbtn');
$AppId = $_SESSION['Application_Id'];
$ErrorMessage = "Error";
foreach($_POST as $field_name => $field_value)
{
   if(!in_array($field_name, $blocked))
   {
	   //echo $AppId.":".$field_value,"<br>";
	   $checkDuplicateQuery = "select id from qusappmapping where QuesId='".$field_value."' and AppId='".$AppId."'";
	   //echo $checkDuplicateQuery."<br>";
	   //$checkDuplicateResult = mysql_query($checkDuplicateQuery);
	   $checkDuplicateResult = $db->query($checkDuplicateQuery);
	   $checkDuplicateCount = mysqli_num_rows($checkDuplicateResult);
	   //echo $checkDuplicateCount."<br>";
	   if($checkDuplicateCount == 0)
	   {
		   $QuesSelectQuery = "select * from qrecord where QuesId = ".$field_value;
		   //$QuesSelectResult = mysql_query($QuesSelectQuery);
		   $QuesSelectResult = $db->query($QuesSelectQuery);
		   while( $QuesSelectRow = mysqli_fetch_array($QuesSelectResult) )
		   {
			   $CatSelectQuery = "select * from catappmapping where CatId=".$QuesSelectRow['QuesCatId']." and AppId=".$_SESSION['Application_Id'];			
			   //echo "<br>".$CatSelectQuery;
			   //$CatSelectResult = mysql_query($CatSelectQuery);
			   $CatSelectResult = $db->query($CatSelectQuery);
			   $CatRowCount = mysqli_num_rows($CatSelectResult);
			   if($CatRowCount > 0)
			   {
				   $insertMapQuery = "insert into qusappmapping (QuesId,AppId) values (".$field_value.",".$AppId.")";
				   //echo $insertMapQuery."<br>";
				   //mysql_query($insertMapQuery);
				   $db->query($insertMapQuery);
			   }
			   else
			   {
				   $ErrorMessage = $ErrorMessage.":Selected Application Doesn't Have the Category you select the Questions From....";
				   
			   }
		   }	   
	   }
	   else
	   {
		   $ErrorMessage =$ErrorMessage.":Application Already Containes the Question...";
	   }
	   //echo "<br>".$field_name.":".$field_value."<br>";
   }
}

header("location: choose_saved_question.php? errormsg='".$ErrorMessage."'");
?>