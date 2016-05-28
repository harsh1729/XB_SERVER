<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<head>
</html>

<?php
session_start();
if(!isset($_SESSION['data_login_id']))
    header("location:../index.php");
?>
<?php
include("database_connection.php");
session_start();




if(!isset($_SESSION['categoryId']))
{
	if(isset($_REQUEST['category']))
	{
		$_SESSION['categoryId'] = $_REQUEST['category'];
		$_SESSION['categoryCounter'] = 1;
	}
}
else if($_SESSION['categoryId'] == $_REQUEST['category'])
{
	$_SESSION['categoryCounter'] = $_SESSION['categoryCounter'] + 1;
	if( $_SESSION['categoryCounter'] == 100 )
	{
		header("location: question_entry.php?CounterError=Please change the category!") or die();
	}
}
else
{
	$_SESSION['categoryId'] = $_REQUEST['category'];
	$_SESSION['categoryCounter'] = 1;
}

if(!isset($_SESSION['subcategoryId']))
{
	if(isset($_REQUEST['Subcategory']))
	{
		$_SESSION['subcategoryId'] = $_REQUEST['Subcategory'];
		$_SESSION['subcategoryCounter'] = 1;
	}
}
else if($_SESSION['subcategoryId'] == $_REQUEST['Subcategory'])
{
	$_SESSION['subcategoryCounter'] = $_SESSION['subcategoryCounter'] + 1;
	if( $_SESSION['subcategoryCounter'] == 10 )
	{
		header("location: question_entry.php?CounterError=Please change the subcategory!") or die();
	}
}
else
{
	$_SESSION['subcategoryId'] = $_REQUEST['Subcategory'];
	$_SESSION['subcategoryCounter'] = 1;
}

$Question_Text = addslashes($_REQUEST["ced"]);			/// String of question text
$Answer = $_REQUEST['option'];				///  option number of answer option
$solution = "";							///		text for solution of questions...
$solutionImage = "";					///		Image path for solution of question
$number_of_options = $_REQUEST['number_of_options'];	/// Total number of options 
$opt_array = array();
$opt_image_array = array();
$queston_category = $_REQUEST['category'];;				//// Returns id of the question category from questioncategory table....
$question_sub_category = $_REQUEST['Subcategory'];		//// Returns id of the question sub category from subcategory table....
$language_id = $_REQUEST['Language_select_option'];		////  It returns the ISO language code like en, hi etc. of selected lang
$question_image = "";
$bankName = "";
$questionYear = "";
////***************************  TABLE NAMES OF DATABASES  *///////////////////
$question_table = "qrecord";
$option_table = "options";
///////////************************************************///////////////////
///****************************  QUESTION IMAGE HANDLING     	*******************//////////
if ($_FILES["qusImage"]["error"] > 0)
{
//	echo "Error: " . $_FILES["qusImage"]["error"] . "<br>";
}
else
{
//	echo "Upload: " . $_FILES["qusImage"]["name"] . "<br>";
	$ext = findexts ($_FILES['qusImage']['name']) ; 
	//echo "extension : ".$ext."<br>";
	$imagePath = "uploadedImages/";
	$new_qus_img_name = "question_".$queston_category."_".time()."img.".$ext;
	$finalImagePath = $imagePath.$new_qus_img_name;
	if(move_uploaded_file($_FILES["qusImage"]["tmp_name"],$finalImagePath))
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
if ($_FILES["solution_img"]["error"] > 0)
{
//	echo "Error: " . $_FILES["qusImage"]["error"] . "<br>";
}
else
{
//	echo "Upload: " . $_FILES["solution_img"]["name"] . "<br>";
	$ext = findexts ($_FILES['solution_img']['name']) ; 
	//echo "extension : ".$ext."<br>";
	$imagePath = "uploadedImages/";
	$new_sol_img_name = "Solution_".$queston_category."_".time()."img.".$ext;
	$finalImagePath = $imagePath.$new_sol_img_name;
	if(move_uploaded_file($_FILES["solution_img"]["tmp_name"],$finalImagePath))
	{
//		echo "file saved succesfully !";
		$solutionImage = "http://www.xercesblue.in/onlinexamserver/liquid_data/".$finalImagePath;
	}
	else
	{
		//echo "erro, file not saved !";
		$solutionImage = "";
	}
}
function findexts ($filename) 
 { 
	 $filename = strtolower($filename) ; 
	 $exts = split("[/\\.]", $filename) ; 
	 $n = count($exts)-1; 
	 $exts = $exts[$n]; 
	 return $exts; 
 } 
/////////////************************************************///////////////////////
if(trim($_REQUEST['BankName']) != "")
{
	$bankName = addslashes(trim($_REQUEST['BankName']));
}
if(trim($_REQUEST['paperYear']) != "")
{
	$questionYear = addslashes(trim( $_REQUEST['paperYear'] ));
}
if(trim( $_REQUEST['solutionArea'] ) != "")
{
	$solution = addslashes(trim( $_REQUEST['solutionArea'] ) );
}
$Ques_insert_query = "insert into ".$question_table.
  " (QuesCatId,QuesSubCatId,Question,CorrectOption,Solution,LangId,image,bankName,year,solutionImage) values
 (".$queston_category.",".$question_sub_category.",'".$Question_Text."',".$Answer.",'".$solution."','".$language_id."','".$question_image."','".$bankName."','".$questionYear."','".$solutionImage."')";

//	echo "<br>".$Ques_insert_query."<br>";

    //mysql_query($Ques_insert_query);
    $db->query($Ques_insert_query);
	$quesIdGen = mysqli_insert_id();
//	echo "<br>".$quesIdGen."<br>";	


if($quesIdGen == 0 )
{
    header("location: question_entry.php?QuesState=Question Not Saved! Please Re-insert your Question !") or die();
}

$Ques_App_Mapping_Query = "insert into qusappmapping (QuesId,AppId) values ('".$quesIdGen."','".$_SESSION['Application_Id']."')";
//mysql_query($Ques_App_Mapping_Query);
$db->query($Ques_App_Mapping_Query);
//echo $Ques_App_Mapping_Query;



for($i=1;$i<=$number_of_options;$i++)
{
	$opt_var = "opt".$i;
	$opt_array[$i]= addslashes( $_REQUEST[$opt_var] );
	
	//opt_image_array
	//opt1img	
	if ($_FILES["opt".$i."img"]["error"] > 0)
	{
//		echo "Error: " . $_FILES["opt".$i."img"]["error"] . "<br>";
			$opt_image_array[$i] = "";
	}
	else
	{
		//echo "Upload: " . $_FILES["opt".$i."img"]["name"] ;
		$ext = findexts ($_FILES['opt'.$i.'img']['name']) ; 
		//echo "<br>extension : ".$ext."<br>";
		$imagePath = "uploadedImages/";
		$new_opt_img_name = "Option_".$quesIdGen."_".$i."_".time()."img.".$ext;
		$finalImagePath = $imagePath.$new_opt_img_name;
		//echo $finalImagePath;
		if(move_uploaded_file($_FILES["opt".$i."img"]["tmp_name"],$finalImagePath))
		{
			//echo "file saved succesfully !";
			$opt_image_array[$i] = "http://www.xercesblue.in/onlinexamserver/liquid_data/".$finalImagePath;
		}
		else
		{
			//echo "<br>erro, file not saved !";
			$opt_image_array[$i] = "";
		}
	}	
}
//echo "<br><br>Options list $number_of_options <br><br>";
for($i=1;$i<=$number_of_options;$i++)	
{
	$Opts_insert_query = "insert into ".$option_table." (QuesId,OptionText,OptionNo,Image) values ($quesIdGen.,'$opt_array[$i]',$i,'$opt_image_array[$i]')";
	
	//mysql_query($Opts_insert_query);
	$db->query($Opts_insert_query);
	
//	echo "<br>".mysql_insert_id();
	
//	echo "<br>".$Opts_insert_query;
}


/*
echo "question is 	:		". $Question_Text."<br>";
echo "Question category :    ".$queston_category."<br>";
echo "Question Language :    ".$language_id."<br>";
echo "answer is 	:		".$Answer."<br>";
echo "number of opts :		".$number_of_options."<br>"; 

echo "<br><br><br><br>";
	echo "Upload: " . $_FILES["qusImage"]["name"] . "<br>";
	echo "Type: " . $_FILES["qusImage"]["type"] . "<br>";
	echo "Size: " . ($_FILES["qusImage"]["size"] / 1024) . " kB<br>";
	echo "Stored in: " . $_FILES["qusImage"]["tmp_name"];
//echo $insert_query;
*/

header("location: question_entry.php?QuesState=Question saved succesfully to database!");
?>