<?php

include("database_connection.php");
session_start();


$categoryIdExisting = $_REQUEST['category'];
$categoryTextNew = $_REQUEST['categoryText'];
$categorySendId = $_REQUEST['AppCategoryId'];
$table_name = "questioncategory";

//echo $language."   ***lang<br>";
//echo $category."   ***cat"; 
//echo "<br>select category id :".$categoryIdExisting;
//echo "<br>category Name :".$categoryTextNew;

$validQuery = "select * from questioncategory where QuesCatId=".$categoryIdExisting;
//$validResult = mysql_query($validQuery);
$validResult = $db->query($validQuery);
$validCount = mysqli_num_rows($validResult);
//echo "<br>".$validCount;
$validRow = mysqli_fetch_row($validResult);
//echo "<br>".$validRow[1];

	if($validCount == 1 && $validRow[1] == $categoryTextNew)
	{
		$insertCatAppMapping = "insert into catappmapping (CatId,AppId,CatSendId) values (".$categoryIdExisting.",".$_SESSION['Application_Id'].",".$categorySendId.") ";		
		//echo "<br>".$insertCatAppMapping;
		//mysql_query($insertCatAppMapping);
		$db->query($insertCatAppMapping);
	}
	else if($validCount == 0)
	{
		$insertQuesCatQuery = "insert into questioncategory (QuesCat) values ('".trim($categoryTextNew)."')";
		//echo "<br>".$insertQuesCatQuery;
		//mysql_query($insertQuesCatQuery);
		$db->query($insertQuesCatQuery);
		$idGenerated = mysqli_insert_id();
		
		$insertCatAppMapping = "insert into catappmapping (CatId,AppId,CatSendId) values (".$idGenerated.",".$_SESSION['Application_Id'].",".$categorySendId.") ";		
		//echo "<br>".$insertCatAppMapping;
		//mysql_query($insertCatAppMapping);
		$db->query($insertCatAppMapping);
	}


//$insert_query = "insert into ".$table_name." (QuesCat) values ('".$category."')";
//mysql_query($insert_query);

//echo $insert_query;

header("location:question_entry.php");

?>