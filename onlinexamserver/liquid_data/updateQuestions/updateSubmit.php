<?php

include("../database_connection.php");

session_start();

$AppId = $_SESSION['Application_Id'];


$questionCategoryId = 1;
$TotalOptions = $_REQUEST['TotalOptions'];
$correctOption = $_REQUEST['correctOption'];
$QuestionText = addslashes($_REQUEST['questionText']);
$question_image = "";
$optionImageArray = array();
$opt_array = array();

$quesIdGen = $_REQUEST['QuesId'];

function removeImage( $imgLink )
{
	//$imgLink = "http://www.xercesblue.in/onlinexamserver/liquid_data/uploadedImages/Option_28_1_1405332388img.png";
	$strToRemove = "http://www.xercesblue.in/onlinexamserver/liquid_data";
	
	$imgName = substr($imgLink,strlen($strToRemove),strlen($imgLink));
	$imgName = "..".$imgName;
	unlink($imgName);
}
function findexts ($filename) 
 { 
	 $filename = strtolower($filename) ; 
	 $exts = split("[/\\.]", $filename) ; 
	 $n = count($exts)-1; 
	 $exts = $exts[$n]; 
	 return $exts; 
 } 

//////********************************** ******************************/
/*						Get qresult query to unlink image			  */			
//////********************************** ******************************/
$qrecordUnlinkQuery = "select * from qrecord where QuesId = ".$quesIdGen;
//$qrecordUnlinkResult = mysql_query($qrecordUnlinkQuery);
$qrecordUnlinkResult = $db->query($qrecordUnlinkQuery);
while( $qrecordUnlinkRow = mysqli_fetch_array($qrecordUnlinkResult) )
{
	if($qrecordUnlinkRow['image'] != "")
		removeImage( $qrecordUnlinkRow['image'] );
	if($qrecordUnlinkRow['solutionImage'] != "")
		removeImage( $qrecordUnlinkRow['solutionImage'] );
}
//////********************************** ******************************/
/*						Get options query to unlink image 			  */			
//////********************************** ******************************/
$optionsUnlinkQuery = "select * from options where QuesId = ".$quesIdGen;
//$optionsUnlinkResult = mysql_query( $optionsUnlinkQuery );
$optionsUnlinkResult = $db->query( $optionsUnlinkQuery );
while( $optionsUnlinkRow = mysqli_fetch_array( $optionsUnlinkResult ) )
{
	if( $optionsUnlinkRow['image'] != "")
	{
		removeImage( $optionsUnlinkRow['image'] );
	}
}


//////********************************** ******************************/
/*						UPLOAD QUESTION IMAGE IF EXISTS 			  */			
//////********************************** ******************************/


	if ($_FILES["questionImage"]["error"] > 0)
	{
		//echo "Error: " . $_FILES["questionImage"]["error"] . "<br>";
	}
	else
	{
	//	echo "Upload: " . $_FILES["qusImage"]["name"] . "<br>";
		$ext = findexts ($_FILES['questionImage']['name']) ; 
		//echo "extension : ".$ext."<br>";
		$imagePath = "uploadedImages/";
		$new_qus_img_name = "updated_question_".$questionCategoryId."_".time()."img.".$ext;
		$finalImagePath = $imagePath.$new_qus_img_name;
		if(move_uploaded_file($_FILES["questionImage"]["tmp_name"],"../".$finalImagePath))
		{
	//		echo "file saved succesfully !";
			$question_image = "http://www.xercesblue.in/onlinexamserver/liquid_data/".$finalImagePath;
		}
		else
		{
			//echo "erro, file not saved !";
			$question_image = "";
		}
	}
	
//////************************************************************************************************/
/*	 UPLOAD OPTIONS IMAGES IF EXISTS and save links in optionImageArray and values in opt_array	  	 */
//////************************************************************************************************/
	
	for($i=1;$i<=$TotalOptions;$i++)
	{
		$opt_var = "opt".$i;
		$opt_array[$i]=addslashes($_REQUEST[$opt_var]);
		if ($_FILES["opt".$i."image"]["error"] > 0)
		{
	//		echo "Error: " . $_FILES["opt".$i."img"]["error"] . "<br>";
				$optionImageArray[$i] = "";
		}
		else
		{
			//echo "Upload: " . $_FILES["opt".$i."img"]["name"] ;
			$ext = findexts ($_FILES['opt'.$i.'image']['name']) ; 
			//echo "<br>extension : ".$ext."<br>";
			$imagePath = "uploadedImages/";
			$new_opt_img_name = "Option_".$quesIdGen."_".$i."_".time()."img.".$ext;
			$finalImagePath = $imagePath.$new_opt_img_name;
			//echo $finalImagePath;
			if(move_uploaded_file($_FILES["opt".$i."image"]["tmp_name"],"../".$finalImagePath))
			{
				//echo "file saved succesfully !";
				$optionImageArray[$i] = "http://www.xercesblue.in/onlinexamserver/liquid_data/".$finalImagePath;
			}
			else
			{
				//echo "<br>erro, file not saved !";
				$optionImageArray[$i] = "";
			}
		}
	}
	
//////********************************************************/
/*	 UPDATE QUESTION COLUMNS WHERE QuesId = QUESTIONiD	  	 */
//////********************************************************/
$updateQuestionTable = "update qrecord set Question = '".$QuestionText."' , CorrectOption = ".$correctOption." , image = '".$question_image."' where QuesId = ".$quesIdGen;
//$updateQuestionResult = mysql_query( $updateQuestionTable );
$updateQuestionResult = $db->query( $updateQuestionTable );
if( !$updateQuestionResult )
	header("location:updateEntry.php?updateStatus=Question Not Updated! Please Check your Question !") or die();

$deleteOptionsQuery = "delete from options where QuesId = ".$quesIdGen;
mysql_query( $deleteOptionsQuery );

for($i=1;$i<=$TotalOptions;$i++)	
{
	$Opts_insert_query = "insert into options (QuesId,OptionText,OptionNo,Image) values (".$quesIdGen.",'".$opt_array[$i]."',".$i.",'".$optionImageArray[$i]."')";
	
    //mysql_query($Opts_insert_query);
    $db->query($Opts_insert_query);
	
}
    if(isset( $_REQUEST['fromPage'] ))
    {
        $updateDoneBugQuery = "update QusBugReport set done = 1 where QuesId = ".$quesIdGen;
        //mysql_query($updateDoneBugQuery);
        $db->query($updateDoneBugQuery);
        header("location:../bugReport/") or die();
    }

header("location:updateEntry.php?updateStatus=Updated succesfully&QuesId=".$quesIdGen);
	
	

?>