<?php
include("database_connection.php");


  
session_start();
$test_no = (int)$_REQUEST['select_test'];
$set_no = (int)$_REQUEST['set_no'];
$type = $_REQUEST['select_section'];
$category_no = $_REQUEST['category_no'];
//echo "category_no=".$category_no."<br>";
$imgquestion = $_REQUEST['imgquestion'];
$imgsolution = $_REQUEST['imgsolution'];	
$imgpre_text = $_REQUEST['imgpre_text'];	

$AppId = $_SESSION['Application_Id'];
$hidden =	$_REQUEST['hidden'];
$category = $_REQUEST['category'.$category_no];
//echo "category=".$category."<br>";
$answer = $_REQUEST['answer'];
$reference = $_REQUEST['reference'];
$language = $_REQUEST['language'];
$bankname = trim($_REQUEST['bankname']);
$year = $_REQUEST['year'];
$username= $_SESSION['newonlineserver_login_id'];
$question_text_hindi = trim($_REQUEST['question_text_hindi']);
$question_text_english = trim($_REQUEST['question_text_english']);
$solution_hindi = trim($_REQUEST['solution_hindi']);
$solution_english = trim($_REQUEST['solution_english']);
$hindi_option_array = array();
$english_option_array = array();
$imgoption_array = array();

$pretext_hindi = trim($_REQUEST['pretext_hindi']);
$pretext_english = trim($_REQUEST['pretext_english']);

 if(isset($_REQUEST['pretext_select']))
					{
						$pretext_select = $_REQUEST['pretext_select'];
					}
					else
					{
						$pretext_select = "null";
					}

$level = $_REQUEST['level'];

$dtObj = new DateTime("now");
$dtObj->setTimeZone( new DateTimeZone("Asia/Kolkata") );
$datetime = $dtObj->format("Y-m-d H:i:s");
$ispost = 0;
for($i=1;$i<=$hidden;$i++)
{
	$option = trim($_REQUEST['hindi_option'.$i]);
	$hindi_option_array[$i]=$option;
	$imgoption =$_REQUEST['imgoption'.$i];
	$imgoption_array[$i] = $imgoption;
}

for($i=1;$i<=$hidden;$i++)
{
	$option = trim($_REQUEST['english_option'.$i]);
	$english_option_array[$i]=$option;
	
}
	
		if($pretext_select !== "" && $pretext_select !== "null")
		{
			$pretext_id_hindi = $pretext_select;
			$pretext_id_english = $pretext_select+1;
		}
        else if($pretext_english !== "" && $imgpre_text == "")
        {
        	

            $sql_pretext2 = "INSERT INTO pretext_record(pretext,lang_id)VALUES( '".mysqli_real_escape_string($db,$pretext_hindi)."','".hi."')";
            mysqli_query($db,$sql_pretext2);
            $pretext_id_hindi = mysqli_insert_id($db);

            $sql_pretext3 = "INSERT INTO pretext_record(pretext,lang_id)VALUES( '".mysqli_real_escape_string($db,$pretext_english)."','".en."')";
            mysqli_query($db,$sql_pretext3);
            $pretext_id_english = mysqli_insert_id($db);

            
        }
		else if($pretext_hindi == "" && $imgpre_text !== "")
		{
			

			 $sql_pretext2 = "INSERT INTO pretext_record(image,lang_id)VALUES( '".mysqli_real_escape_string($db,$imgpre_text)."','".hi."')";
            mysqli_query($db,$sql_pretext2);
            $pretext_id_hindi = mysqli_insert_id($db);

             $sql_pretext3 = "INSERT INTO pretext_record(image,lang_id)VALUES( '".mysqli_real_escape_string($db,$imgpre_text)."','".en."')";
            mysqli_query($db,$sql_pretext3);
            $pretext_id_english = mysqli_insert_id($db);
            
		}
		else if($pretext_hindi !== "" && $imgpre_text !== "")
		{
			

        	$sql_pretext2 = "INSERT INTO pretext_record(pretext,lang_id,image)VALUES( '".mysqli_real_escape_string($db,$pretext_hindi)."','".hi."','".mysqli_real_escape_string($db,$imgpre_text)."')";
            mysqli_query($db,$sql_pretext2);
            $pretext_id_hindi = mysqli_insert_id($db);

            $sql_pretext3 = "INSERT INTO pretext_record(pretext,lang_id,image)VALUES( '".mysqli_real_escape_string($db,$pretext_english)."','".en."','".mysqli_real_escape_string($db,$imgpre_text)."')";
            mysqli_query($db,$sql_pretext3);
            $pretext_id_english = mysqli_insert_id($db);

		}
        else
        {
			
			$pretext_id_english = 0;
			$pretext_id_hindi = 0;
            
        }
       
        
     
		$sql_question="INSERT INTO ques_info (quescatid,correctopt,year,bankname,userid,datetime,level,set_no,type,app_id,daily_test,test_no) VALUES(".$category.", ".$answer.",'".$year."', '".mysqli_real_escape_string($db,$bankname)."', ".$username.",'".$datetime."',".$level.",".$set_no.",'".$type."',".$AppId.",1,".$test_no.")";
        mysqli_query($db,$sql_question);
        $lastquesidmain = mysqli_insert_id($db);

        
        if($question_text_hindi !== "" )
        {
        $sql_question="INSERT INTO qrecord(ques_text,ques_image,sol_text ,sol_image,lang_id,quesid,pretextid) VALUES('".mysqli_real_escape_string($db,$question_text_hindi)."', '".$imgquestion."', '".mysqli_real_escape_string($db,$solution_hindi)."', '".$imgsolution."','".hi."', ".$lastquesidmain.",".$pretext_id_hindi.")";
        mysqli_query($db,$sql_question);
        $lastquesid = mysqli_insert_id($db);
        

        $mappingquery = "insert into qusappmapping (QuesId,AppId) values (".$lastquesid.",".$AppId.")";
		mysqli_query($db,$mappingquery);

        $option_hindi_no=1;
	foreach($hindi_option_array as $options)
	{
		
		$sql_option="INSERT INTO options (QuesId, OptionText, OptionNo ,image) VALUES(".$lastquesid.", '".mysqli_real_escape_string($db,$options)."', ".$option_hindi_no.",'".$imgoption_array[$option_hindi_no]."')";
		mysqli_query($db,$sql_option);
		$option_hindi_no=$option_hindi_no+1;
	}
}
	$sql_question="INSERT INTO qrecord(ques_text,ques_image,sol_text ,sol_image,lang_id,quesid,pretextid) VALUES('".mysqli_real_escape_string($db,$question_text_english)."', '".$imgquestion."', '".mysqli_real_escape_string($db,$solution_english)."', '".$imgsolution."','".en."', ".$lastquesidmain.",".$pretext_id_english.")";
        mysqli_query($db,$sql_question);
        $lastquesid = mysqli_insert_id($db);

        $mappingquery = "insert into qusappmapping (QuesId,AppId) values (".$lastquesid.",".$AppId.")";
		mysqli_query($db,$mappingquery);

		$option_english_no=1;
	foreach($english_option_array as $options)
	{
		
		$sql_option="INSERT INTO options (QuesId, OptionText, OptionNo ,image) VALUES(".$lastquesid.", '".mysqli_real_escape_string($db,$options)."', ".$option_english_no.",'".$imgoption_array[$option_english_no]."')";
		mysqli_query($db,$sql_option);
		$option_english_no=$option_english_no+1;
	}

	 echo json_encode($pretext_id);

?>