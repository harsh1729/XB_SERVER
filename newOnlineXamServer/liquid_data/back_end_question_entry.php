<?php
include("database_connection.php");


		//  imgfield
session_start();
$imgquestion = $_REQUEST['imgquestion'];
$imgsolution = $_REQUEST['imgsolution'];		

$AppId = $_SESSION['Application_Id'];

$hidden =	$_REQUEST['hidden'];
$category = $_REQUEST['category'];
$subcategory = $_REQUEST['subcategory'];
$answer = $_REQUEST['answer'];
$reference = $_REQUEST['reference'];

$language = $_REQUEST['language'];

$bankname = trim($_REQUEST['bankname']);
$year = $_REQUEST['year'];
$username= $_SESSION['newonlineserver_login_id'];
$question_text = trim($_REQUEST['question_text']);
$solution = trim($_REQUEST['solution']);
$option_array = array();
$imgoption_array = array();

$dtObj = new DateTime("now");
$dtObj->setTimeZone( new DateTimeZone("Asia/Kolkata") );
$datetime = $dtObj->format("Y-m-d H:i:s");

for($i=1;$i<=$hidden;$i++)
{
	$option = trim($_REQUEST['option'.$i]);
	$option_array[$i]=$option;
	$imgoption =$_REQUEST['imgoption'.$i];
	$imgoption_array[$i] = $imgoption;
}

if($subcategory == "")
{
    $sql_question="INSERT INTO qrecord (QuesCatId, Question, CorrectOption, Solution, LangId ,Year ,Bankname, image, solutionImage, userid, datetime,reference) VALUES(".$category.", '".mysql_real_escape_string($question_text)."', ".$answer.", '".mysql_real_escape_string($solution)."', '".$language."', '".$year."', '".mysql_real_escape_string($bankname)."', '".$imgquestion."', '".$imgsolution."', ".$username.",'".$datetime."','".$reference."')";
}
else
{
		$sql_question="INSERT INTO qrecord (QuesCatId,QuesSubCatId, Question, CorrectOption, Solution, LangId ,Year ,Bankname, image, solutionImage, userid, datetime,reference) VALUES(".$category.",".$subcategory.", '".mysql_real_escape_string($question_text)."', ".$answer.", '".mysql_real_escape_string($solution)."', '".$language."', '".$year."', '".mysql_real_escape_string($bankname)."', '".$imgquestion."', '".$imgsolution."', ".$username.",'".$datetime."','".$reference."')";
}
mysqli_query($db,$sql_question);

$question_id = mysqli_insert_id($db);
$mappingquery = "insert into qusappmapping (QuesId,AppId) values (".$question_id.",".$AppId.")";
mysqli_query($db,$mappingquery);
$option_no=1;
	foreach($option_array as $options)
	{
		
		$sql_option="INSERT INTO options (QuesId, OptionText, OptionNo ,image) VALUES(".$question_id.", '".mysql_real_escape_string($options)."', ".$option_no.",'".$imgoption_array[$option_no]."')";
		mysqli_query($db,$sql_option);
		$option_no=$option_no+1;
	}
//header('location: questionentry.php');
echo json_encode($AppId);
?>