<?php

include("database_connection.php");
//***********************************************//
$id_of_last_qus = $_GET['lastQuestionNumber'];
$id_of_app = $_GET['appId'];
$id_of_device= $_GET['deviceIMEI'];
$langCode = $_GET['LangCode'];
$gcmId = $_REQUEST['gcmId'];
//**********************************************//

$TotalLimit = 200;


//*********************************************//

$insertDownloadQuery = "insert into downloadcounter (AppId,DeviceId,LangCode,gcmId) values (".$id_of_app.",".$id_of_device.",'".$langCode."','".$gcmId."')";
//echo $insertDownloadQuery."<br>";
//mysql_query($insertDownloadQuery);
$db->query($insertDownloadQuery);
//echo "Insert id is :".mysql_insert_id()."<br>";



////    www.xercesblue.in/onlinexamserver/liquid_data/xport_xml.php?lastQuestionNumber=1&appId=1&deviceIMEI=232323232323&LangCode=hi


$doc = new DOMDocument('1.0', 'UTF-8');
// we want a nice output
$doc->formatOutput = true;
$root = $doc->createElement("Question_Database");
$root = $doc->appendChild($root);


if($langCode == "hi")
{
	
//	$qus_query = "select * from ( select * from qrecord as t2 where t2.QuesId in ( select t1.QuesId from qusappmapping as t1 where t1.AppId = 1 ) ) as t3 where t3.QuesId > 0 and LangId='en' and QuesCatId=2 limit 50";
	$qus_query = "select * from ( select * from qrecord as t2 where t2.QuesId in ( select t1.QuesId from qusappmapping as t1 where t1.AppId = ".$id_of_app." ) ) as t3 where t3.QuesId > ".$id_of_last_qus." and LangId = 'en' and QuesCatId=2 limit 40";	
	
	//$qus_result = mysql_query($qus_query);
	$qus_result = $db->query($qus_query);

	while($qus_row=mysqli_fetch_array($qus_result))
	{
	
			$title = $doc->createElement('Question');
			$title = $root->appendChild($title);
				$qus_lang = $doc->createAttribute('language');
				$qus_lang->value = $qus_row['LangId'];
				$title->appendChild($qus_lang);
				
				$qus_ID = $doc->createAttribute('QuesId');
				$qus_ID->value = $qus_row['QuesId'];
				$title->appendChild($qus_ID);
				
				////////*****************************		RESEARCH    	************///////////////
				$categorySelectQuery = "select * from catappmapping where CatId=".$qus_row['QuesCatId']." and AppId=".$id_of_app." ";
				//$categorySelectResult = mysql_query($categorySelectQuery);
				$categorySelectResult = $db->query($categorySelectQuery);
				while($categorySelectRow = mysqli_fetch_array($categorySelectResult))
				{
					$qus_cat = $doc->createAttribute('CategoryId');
					$qus_cat->value = $categorySelectRow['CatSendId'];
					$title->appendChild($qus_cat);
				}
				if($qus_row['bankName'] != "")
				{
					$qus_Bank = $doc->createAttribute('BankName');
					$qus_Bank->value = $qus_row['bankName'];
					$title->appendChild($qus_Bank);
				}
				if($qus_row['Year'] != "")
				{
					$qus_Year = $doc->createAttribute('Year');
					$qus_Year->value = $qus_row['Year'];
					$title->appendChild($qus_Year);
				}
			$qus_text = $doc->createElement('Question_Text');
			//TODO JASPAL
			$qus_text_node = $doc->createTextNode($qus_row['Question']);
			$qus_text->appendChild($qus_text_node);
			
			$qus_text = $title->appendChild($qus_text);
			if($qus_row['image'] != "")
			{
				$qus_Image = $doc->createAttribute('Image');
				$qus_Image->value = $qus_row['image'];
				$qus_text->appendChild($qus_Image);
			}
			
			$no_of_opts_query = "select count(*) from options where QuesId=".$qus_row['QuesId'];
			//$no_of_opts = mysql_query($no_of_opts_query);
			$no_of_opts = $db->query($no_of_opts_query);
			$no_value = mysqli_fetch_row($no_of_opts);
			
			$qus_opt = $doc->createElement('Options');
			$qus_opt = $title->appendChild($qus_opt);
			$qus_tot_opt = $doc->createAttribute('total_options');
			$qus_tot_opt->value = $no_value[0];
			$qus_opt->appendChild($qus_tot_opt);
				
				$opt_qry = "select * from options where QuesId=".$qus_row['QuesId'];
				//$opt_result = mysql_query($opt_qry);
				$opt_result = $db->query($opt_qry);
				//$i = 0;
				while($opt_row=mysqli_fetch_array($opt_result))
				{
					//$i=$i+1;
					//$opt_number = "Option_".$i;
                    //$opt_number = "Option_".$opt_row['OptionNo'];
					if($opt_row['OptionText'] != "")
					{
						//$option = $doc->createElement($opt_number);
                        $option = $doc->createElement("Option");
						$option_text_node = $doc->createTextNode($opt_row['OptionText']);
						$option->appendChild($option_text_node);
						$option = $qus_opt->appendChild($option);
                        
					}
					else
					{
						$option = $doc->createElement("Option"," ");
						$option = $qus_opt->appendChild($option);
					}
                    
                    
                    $optNumber = $doc -> createAttribute("Number");
                    $optNumber->value = $opt_row['OptionNo'];
                    $option->appendChild($optNumber);
                    
					if($opt_row['image'] != "")
					{
						$opt_Image = $doc->createAttribute('Image');
						$opt_Image->value = $opt_row['image'];
						$option->appendChild($opt_Image);
					}
				}
				
			if($qus_row['Solution'] != "")
			{
				$answer = $doc->createElement('Answer',$qus_row['Solution']);
				$answer = $title->appendChild($answer);
			}
			else
			{
				$answer = $doc->createElement('Answer'," ");
				$answer = $title->appendChild($answer);
			}
			if($qus_row['solutionImage'] != "")
			{
				$solution_Image = $doc->createAttribute('Image');
				$solution_Image->value = $qus_row['solutionImage'];
				$answer->appendChild($solution_Image);			
			}
			
			$choice_number = $doc->createAttribute('Option_number');
			$choice_number->value = $qus_row['CorrectOption'];
			$answer->appendChild($choice_number);
	}
	
	$TotalLimit = 160;	
}




$qus_query = "select * from ( select * from qrecord as t2 where t2.QuesId in ( select t1.QuesId from qusappmapping as t1 where t1.AppId = ".$id_of_app." ) ) as t3 where t3.QuesId > ".$id_of_last_qus." and LangId = '".$langCode."' limit ".$TotalLimit;

//$qus_result = mysql_query($qus_query);
$qus_result = $db->query($qus_query);

while($qus_row=mysqli_fetch_array($qus_result))
{

        $title = $doc->createElement('Question');
		$title = $root->appendChild($title);
			$qus_lang = $doc->createAttribute('language');
			$qus_lang->value = $qus_row['LangId'];
			$title->appendChild($qus_lang);
            
    		$qus_ID = $doc->createAttribute('QuesId');
			$qus_ID->value = $qus_row['QuesId'];
			$title->appendChild($qus_ID);
			
			////////*****************************		RESEARCH    	************///////////////
			$categorySelectQuery = "select * from catappmapping where CatId=".$qus_row['QuesCatId']." and AppId=".$id_of_app." ";
			//$categorySelectResult = mysql_query($categorySelectQuery);
			$categorySelectResult = $db->query($categorySelectQuery);
			while($categorySelectRow = mysqli_fetch_array($categorySelectResult))
			{
				$qus_cat = $doc->createAttribute('CategoryId');
				$qus_cat->value = $categorySelectRow['CatSendId'];
				$title->appendChild($qus_cat);
			}
			if($qus_row['bankName'] != "")
			{
				$qus_Bank = $doc->createAttribute('BankName');
				$qus_Bank->value = $qus_row['bankName'];
				$title->appendChild($qus_Bank);
			}
			if($qus_row['Year'] != "")
			{
				$qus_Year = $doc->createAttribute('Year');
				$qus_Year->value = $qus_row['Year'];
				$title->appendChild($qus_Year);
			}
		$qus_text = $doc->createElement('Question_Text');
        //TODO JASPAL
        $qus_text_node = $doc->createTextNode($qus_row['Question']);
        $qus_text->appendChild($qus_text_node);
        
		$qus_text = $title->appendChild($qus_text);
		if($qus_row['image'] != "")
		{
			$qus_Image = $doc->createAttribute('Image');
			$qus_Image->value = $qus_row['image'];
			$qus_text->appendChild($qus_Image);
		}
		
		$no_of_opts_query = "select count(*) from options where QuesId=".$qus_row['QuesId'];
		//$no_of_opts = mysql_query($no_of_opts_query);
		$no_of_opts = $db->query($no_of_opts_query);
		$no_value = mysqli_fetch_row($no_of_opts);
		
		$qus_opt = $doc->createElement('Options');
		$qus_opt = $title->appendChild($qus_opt);
		$qus_tot_opt = $doc->createAttribute('total_options');
		$qus_tot_opt->value = $no_value[0];
		$qus_opt->appendChild($qus_tot_opt);
			
			$opt_qry = "select * from options where QuesId=".$qus_row['QuesId'];
			//$opt_result = mysql_query($opt_qry);
			$opt_result = $db->query($opt_qry);
			//$i = 0;
			while($opt_row=mysqli_fetch_array($opt_result))
			{
				//$i=$i+1;
				//$opt_number = "Option_".$i;
                
                //$opt_number = "Option_".$opt_row['OptionNo'];
				if($opt_row['OptionText'] != "")
				{
					$option = $doc->createElement("Option");
                    $option_text_node = $doc->createTextNode($opt_row['OptionText']);
                    $option->appendChild($option_text_node);
					$option = $qus_opt->appendChild($option);
				}
				else
				{
					$option = $doc->createElement("Option"," ");
					$option = $qus_opt->appendChild($option);
				}
                    
                $optNumber = $doc->createAttribute("Number");
                $optNumber->value = $opt_row['OptionNo'];
                $option->appendChild($optNumber);
                
				if($opt_row['image'] != "")
				{
					$opt_Image = $doc->createAttribute('Image');
					$opt_Image->value = $opt_row['image'];
					$option->appendChild($opt_Image);
				}
			}
			
		if($qus_row['Solution'] != "")
		{
			$answer = $doc->createElement('Answer',$qus_row['Solution']);
			$answer = $title->appendChild($answer);
		}
		else
		{
			$answer = $doc->createElement('Answer'," ");
			$answer = $title->appendChild($answer);
		}
		if($qus_row['solutionImage'] != "")
		{
			$solution_Image = $doc->createAttribute('Image');
			$solution_Image->value = $qus_row['solutionImage'];
			$answer->appendChild($solution_Image);			
		}
		
		$choice_number = $doc->createAttribute('Option_number');
		$choice_number->value = $qus_row['CorrectOption'];
		$answer->appendChild($choice_number);
}

//echo 'Wrote: ' . $doc->save("downloadXmlFile/test.xml") . ' bytes'; // Wrote: 72 bytes
//echo htmlspecialchars($doc->saveXML());
//header('Content-type: text/xml');
//header('Content-Disposition: attachment; filename="tempQuestionDatabase.xml"');



$mime = 'application/xml';
$file_name = "questionDatabase";

header('Pragma:public');
header('Expires:0');
header('Cache-Control: private',false);
header('Content-Type: '.$mime);
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');


echo $doc->saveXML();


//$doc->save("downloadXmlFile/QuestionDatabase.xml");
//header("location: downloadXmlFile/DownloadXml.php?lastQuestionNumber=".$id_of_last_qus."&appId=".$id_of_app."&deviceIMEI=".$id_of_device);
?>