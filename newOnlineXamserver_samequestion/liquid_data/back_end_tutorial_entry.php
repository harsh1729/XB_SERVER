<?php
include("database_connection.php");


    	//  imgfield
session_start();

$AppId = $_SESSION['Application_Id'];
$category = $_REQUEST['category'];
$subcategory = $_REQUEST['subcategory'];
$language = $_REQUEST['language'];
$reference = trim($_REQUEST['reference']);
$year = $_REQUEST['year'];
$username= $_SESSION['newonlineserver_login_id'];
$tutorial_text = trim($_REQUEST['tutorial_text']);
$dtObj = new DateTime("now");
$dtObj->setTimeZone( new DateTimeZone("Asia/Kolkata") );
$datetime = $dtObj->format("Y-m-d H:i:s");
if($subcategory == "")
{
    $sql_question="INSERT INTO Turorials (CatId, text, LangId , reference,userid, datetime) VALUES(".$category.", '".mysql_real_escape_string($tutorial_text)."', '".$language."', '".$reference."', ".$username.",'".$datetime."')";
}
else
{
		$sql_question="INSERT INTO Turorials (CatId, Sub_Cat_Id, text, LangId , reference,userid, datetime) VALUES(".$category.",".$subcategory.", '".mysql_real_escape_string($tutorial_text)."', '".$language."', '".$reference."', ".$username.",'".$datetime."')";
}
mysqli_query($db,$sql_question);

//header('location: questionentry.php');
echo json_encode($AppId);
?>