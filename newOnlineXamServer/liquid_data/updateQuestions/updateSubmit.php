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
$bankname = $_REQUEST['bankname'];
$year = $_REQUEST['year'];
$TotalOptions = $_REQUEST['TotalOptions'];
$correctOption = $_REQUEST['correctOption'];
$image =($_FILES['questionImage']['name']) ;
$solutionimage=($_FILES['solutionimage']['name']) ;
$QuestionText = addslashes($_REQUEST['questionText']);
$solutiontext = addslashes($_REQUEST['solutionText']);
$question_image = "";
$solution_image="";
$optionImageArray = array();
$opt_array = array();

$quesIdGen = $_REQUEST['QuesId'];

function removeImage( $imgLink )
{
    //$imgLink = "http://www.xercesblue.in/onlinexamserver/liquid_data/uploadedImages/Option_28_1_1405332388img.png";
	$strToRemove = "http://www.xercesblue.in/newonlinexamserver/liquid_data";
	
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
$qrecordUnlinkResult = mysqli_query($db,$qrecordUnlinkQuery);
while( $qrecordUnlinkRow = mysqli_fetch_array($qrecordUnlinkResult) )
{
    if($qrecordUnlinkRow['image'] !== "")
        {
            $question_image =$qrecordUnlinkRow['image'];
            if($image !=="")
            {
    	        removeImage( $qrecordUnlinkRow['image'] );
           
                echo "unlink".$question_image;
            }
        }
	if($qrecordUnlinkRow['solutionImage'] !== "")
    {
        $solution_image = $qrecordUnlinkRow['solutionImage'];
        if($solutionimage !== "")
        {
		    removeImage( $qrecordUnlinkRow['solutionImage'] );
        }
    }
}
//////********************************** ******************************/
/*						Get options query to unlink image 			  */			
//////********************************** ******************************/
$optionsUnlinkQuery = "select * from options where QuesId = ".$quesIdGen;
$optionsUnlinkResult = mysqli_query( $db,$optionsUnlinkQuery );
$img = 1;
while( $optionsUnlinkRow = mysqli_fetch_array( $optionsUnlinkResult ) )
{
    
	if( $optionsUnlinkRow['image'] !== "")
	{
        $optionImageArray[$img]= $optionsUnlinkRow['image'];
        if(addslashes($_REQUEST['opt'.$img.'image']) !== "")
        {
		    removeImage( $optionsUnlinkRow['image'] );
        }
	}
   $img = $img+1; 
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
		$imagePath = "";
		$new_qus_img_name = "updated_question_".$questionCategoryId."_".time()."img.".$ext;
		$finalImagePath = $imagePath.$new_qus_img_name;
		if(move_uploaded_file($_FILES["questionImage"]["tmp_name"],"../uploads_image/".$finalImagePath))
		{
	//		echo "file saved succesfully !";
			$question_image = $finalImagePath;
		}
		else
		{
            echo $question_image;
			//echo "erro, file not saved !";
		//	$question_image = "";
		}
	}



//////********************************** ******************************/
/*    					UPLOAD SOLUTION IMAGE IF EXISTS 			  */			
//////********************************** ******************************/

 if ($_FILES["solutionimage"]["error"] > 0)
    {
		//echo "Error: " . $_FILES["questionImage"]["error"] . "<br>";
	}
	else
	{
	//	echo "Upload: " . $_FILES["qusImage"]["name"] . "<br>";
		$ext = findexts ($_FILES['solutionimage']['name']) ; 
		//echo "extension : ".$ext."<br>";
		$imagePath = "";
		$new_qus_img_name = "updated_question_".$questionCategoryId."_".time()."img.".$ext;
		$finalImagePath = $imagePath.$new_qus_img_name;
		if(move_uploaded_file($_FILES["solutionimage"]["tmp_name"],"../uploads_image/".$finalImagePath))
		{
	//		echo "file saved succesfully !";
			$solution_image = $finalImagePath;
		}
		else
		{
            echo $question_image;
			//echo "erro, file not saved !";
		//	$question_image = "";
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
			//	$optionImageArray[$i] = "";
		}
		else
		{
			//echo "Upload: " . $_FILES["opt".$i."img"]["name"] ;
			$ext = findexts ($_FILES['opt'.$i.'image']['name']) ; 
			//echo "<br>extension : ".$ext."<br>";
			$imagePath = "";
			$new_opt_img_name = "Option_".$quesIdGen."_".$i."_".time()."img.".$ext;
			$finalImagePath = $imagePath.$new_opt_img_name;
			//echo $finalImagePath;
			if(move_uploaded_file($_FILES["opt".$i."image"]["tmp_name"],"../uploads_image/".$finalImagePath))
			{
				//echo "file saved succesfully !";
				$optionImageArray[$i] = $finalImagePath;
			}
			else
			{
				//echo "<br>erro, file not saved !";
				//$optionImageArray[$i] = "";
			}
		}
	}
	
//////********************************************************/
/*	 UPDATE QUESTION COLUMNS WHERE QuesId = QUESTIONiD	  	 */
//////********************************************************/
$updateQuestionTable = "update qrecord set Question = '".$QuestionText."' , CorrectOption = ".$correctOption." , Solution= '".$solutiontext."',QuesCatId= ".$category.", bankName= '".$bankname."',Year= '".$year."' ,image = '".$question_image."',solutionImage = '".$solution_image."',datetime='".$datetime."' where QuesId = ".$quesIdGen;
$updateQuestionResult = mysqli_query($db, $updateQuestionTable );
if( !$updateQuestionResult )
	header("location:updateEntry.php?updateStatus=Question Not Updated! Please Check your Question !") or die();

$deleteOptionsQuery = "delete from options where QuesId = ".$quesIdGen;
mysqli_query( $db,$deleteOptionsQuery );

for($i=1;$i<=$TotalOptions;$i++)	
{
	$Opts_insert_query = "insert into options (QuesId,OptionText,OptionNo,Image) values (".$quesIdGen.",'".$opt_array[$i]."',".$i.",'".$optionImageArray[$i]."')";
	
    mysqli_query($db,$Opts_insert_query);
	
}
    if(isset( $_REQUEST['fromPage'] ))
    {
        $updateDoneBugQuery = "update QusBugReport set done = 1 where QuesId = ".$quesIdGen;
        mysqli_query($db,$updateDoneBugQuery);
        header("location:../bugReport/") or die();
    }

header("location:updateEntry.php?updateStatus=Updated succesfully&QuesId=".$quesIdGen);
	
	

?>