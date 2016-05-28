<?php

include("database_connection.php");
//***********************************************//
$id_of_last_qus = $_GET['lastQuestionNumber'];
//$id_of_last_qus = 2336;
//$id_of_app = $_GET['appId'];
//$id_of_device= $_GET['deviceIMEI'];
$langCode = $_GET['LangCode'];
//$langCode = 'en';
//$gcmId = $_REQUEST['gcmId'];
//**********************************************//

//$TotalLimit = 200;
ob_start();

//*********************************************//

/*$insertDownloadQuery = "insert into downloadcounter (AppId,DeviceId,LangCode,gcmId) values (".$id_of_app.",".$id_of_device.",'".$langCode."','".$gcmId."')";*/
//echo $insertDownloadQuery."<br>";
/*mysql_query($insertDownloadQuery);*/
//echo "Insert id is :".mysql_insert_id()."<br>";



////    www.xercesblue.in/onlinexamserver/liquid_data/xport_xml.php?lastQuestionNumber=1&appId=1&deviceIMEI=232323232323&LangCode=hi

$engcategoryid = array(
    				19,
					21,
					22,
					23,
					24,
					47,
					48
					
					);
				//("catid"=>"ques_per_set")
$reasoningcategoryid = array(
	/*reasoning*/	6,
					7,
					8,
					9,
					10,
					11,
					12,
					13,
					14,
					15,
					16,
					17,
					18
                    );
 $mathcategoryid = array(
	/*Maths*/		25,
					26,
					27,
					28,
					29,
					30,
					31,
					32,
					33,
					34,
					35,
					36,
					37,
					38,
					39,
					43,
					44,
					45,
					46
                    );
					
	/*GK*/
$gkcategoryid = array(
                    41,
					42
                    );
					
	/*Computer*/
$computercategoryid = array(
                5	
				);

				//("catid"=>"ques_per_set")
$catid2sendcatid = array(
	/*reasoning*/	6=>1,
					7=>1,
					8=>1,
					9=>1,
					10=>1,
					11=>1,
					12=>1,
					13=>1,
					14=>1,
					15=>1,
					16=>1,
					17=>1,
					18=>1,

	/*Maths*/		25=>3,
					26=>3,
					27=>3,
					28=>3,
					29=>3,
					30=>3,
					31=>3,
					32=>3,
					33=>3,
					34=>3,
					35=>3,
					36=>3,
					37=>3,
					38=>3,
					39=>3,
					43=>3,
					44=>3,
					45=>3,
					46=>3,
					
	/*GK*/			41=>4,
					42=>4,
					
	/*Computer*/	5=>5,

	/*english*/		19=>2,
					21=>2,
					22=>2,
					23=>2,
					24=>2,
					47=>2,
					48=>2
				);

$allquestionsarray = array();
$limit = 40;
//echo "<html><head><meta charset='utf-8'/></head><body><pre>";
//foreach ($allcategoryid as $catid => $limit)
for($i=0;$i<=4;$i++)
{
    if($i == 0)
    {
        	$qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid in (".implode(',',$reasoningcategoryid).") and qr.lang_id = '".$langCode."' and qr.id > ".$id_of_last_qus." and qr.id>1593 limit ".$limit;
        	$qus_result = mysqli_query($db,$qusquery);
        	while($row = mysqli_fetch_array($qus_result) )
        	{
        		$singlequs = array();
        
        		$singlequs['QuesId'] = $row['id'];
        		$singlequs['LangId'] = $row['lang_id'];
        		$singlequs['questext'] = $row['pretext']."\n\n".$row['ques_text'];
        		$singlequs['CatSendId']  = $catid2sendcatid[$row['quescatid']];
        		$singlequs['bankName'] = $row['bankname'];
        		$singlequs['year'] = $row['year'];
        		if($row['prtxtimg'] != "")
        			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['prtxtimg'];
        		else if($row['ques_image'] != "")
        			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['ques_image'];
        		else
        			$singlequs['image'] = "";
        		$singlequs['correctoption'] = $row['correctopt'];
        		$singlequs['solution']= $row['sol_text'];
        		if($row['sol_image'] != "")
        			$singlequs['solutionimage'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['sol_image'];
        		else
        			$singlequs['solutionimage'] = "";
        
        		$optquery = "select * from options where QuesId = ".$row['id'];
        		$opt_result = mysqli_query($db,$optquery);
        		$totaloptions = mysqli_num_rows($opt_result);
        		$singlequs['total_options'] = $totaloptions;
        		$optArray = array();
        		while($optrow = mysqli_fetch_array($opt_result))
        		{
        			$singleopt = array();
        			$singleopt['id'] = $optrow['OptionId'];
        			$singleopt['optiontext'] = $optrow['OptionText'];
        			$singleopt['optionsnumber'] = $optrow['OptionNo'];
        			if($optrow['image'] != "")
        				$singleopt['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$optrow['image'];
        			else
        				$singleopt['image'] = "";
        
        			array_push($optArray, $singleopt);
        		}
        		$singlequs['options'] = $optArray;
        
        		array_push($allquestionsarray, $singlequs);
        	}
         }    
        else if($i == 1)
        {
                    $qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid in (".implode(',',$engcategoryid).") and qr.lang_id = 'en' and qr.id > ".$id_of_last_qus." and qr.id>1593 limit ".$limit;
                $qus_result = mysqli_query($db,$qusquery);
            	while($row = mysqli_fetch_array($qus_result) )
            	{
            		$singlequs = array();
            
            		$singlequs['QuesId'] = $row['id'];
            		$singlequs['LangId'] = $row['lang_id'];
            		$singlequs['questext'] = $row['pretext']."\n\n".$row['ques_text'];
            		$singlequs['CatSendId']  = $catid2sendcatid[$row['quescatid']];
            		$singlequs['bankName'] = $row['bankname'];
            		$singlequs['year'] = $row['year'];
            		if($row['prtxtimg'] != "")
            			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['prtxtimg'];
            		else if($row['ques_image'] != "")
            			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['ques_image'];
            		else
            			$singlequs['image'] = "";
            		$singlequs['correctoption'] = $row['correctopt'];
            		$singlequs['solution']= $row['sol_text'];
            		if($row['sol_image'] != "")
            			$singlequs['solutionimage'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['sol_image'];
            		else
            			$singlequs['solutionimage'] = "";
            
            		$optquery = "select * from options where QuesId = ".$row['id'];
            		$opt_result = mysqli_query($db,$optquery);
            		$totaloptions = mysqli_num_rows($opt_result);
            		$singlequs['total_options'] = $totaloptions;
            		$optArray = array();
            		while($optrow = mysqli_fetch_array($opt_result))
            		{
            			$singleopt = array();
            			$singleopt['id'] = $optrow['OptionId'];
            			$singleopt['optiontext'] = $optrow['OptionText'];
            			$singleopt['optionsnumber'] = $optrow['OptionNo'];
            			if($optrow['image'] != "")
            				$singleopt['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$optrow['image'];
            			else
            				$singleopt['image'] = "";
            
            			array_push($optArray, $singleopt);
            		}
            		$singlequs['options'] = $optArray;
            
            		array_push($allquestionsarray, $singlequs);
                }
         }
        else if($i == 2)
        {
            $qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid in (".implode(',',$mathcategoryid).") and qr.lang_id = '".$langCode."' and qr.id > ".$id_of_last_qus." and qr.id>1593 limit ".$limit;
        $qus_result = mysqli_query($db,$qusquery);
    	while($row = mysqli_fetch_array($qus_result) )
    	{
    		$singlequs = array();
    
    		$singlequs['QuesId'] = $row['id'];
    		$singlequs['LangId'] = $row['lang_id'];
    		$singlequs['questext'] = $row['pretext']."\n\n".$row['ques_text'];
    		$singlequs['CatSendId']  = $catid2sendcatid[$row['quescatid']];
    		$singlequs['bankName'] = $row['bankname'];
    		$singlequs['year'] = $row['year'];
    		if($row['prtxtimg'] != "")
    			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['prtxtimg'];
    		else if($row['ques_image'] != "")
    			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['ques_image'];
    		else
    			$singlequs['image'] = "";
    		$singlequs['correctoption'] = $row['correctopt'];
    		$singlequs['solution']= $row['sol_text'];
    		if($row['sol_image'] != "")
    			$singlequs['solutionimage'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['sol_image'];
    		else
    			$singlequs['solutionimage'] = "";
    
    		$optquery = "select * from options where QuesId = ".$row['id'];
    		$opt_result = mysqli_query($db,$optquery);
    		$totaloptions = mysqli_num_rows($opt_result);
    		$singlequs['total_options'] = $totaloptions;
    		$optArray = array();
    		while($optrow = mysqli_fetch_array($opt_result))
    		{
    			$singleopt = array();
    			$singleopt['id'] = $optrow['OptionId'];
    			$singleopt['optiontext'] = $optrow['OptionText'];
    			$singleopt['optionsnumber'] = $optrow['OptionNo'];
    			if($optrow['image'] != "")
    				$singleopt['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$optrow['image'];
    			else
    				$singleopt['image'] = "";
    
    			array_push($optArray, $singleopt);
    		}
    		$singlequs['options'] = $optArray;
    
    		array_push($allquestionsarray, $singlequs);
        }
        }
        else if($i ==3)
        {
            $qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid in (".implode(',',$gkcategoryid).") and qr.lang_id = '".$langCode."' and qr.id > ".$id_of_last_qus." and qr.id>1593 limit ".$limit;
        $qus_result = mysqli_query($db,$qusquery);
    	while($row = mysqli_fetch_array($qus_result) )
    	{
    		$singlequs = array();
    
    		$singlequs['QuesId'] = $row['id'];
    		$singlequs['LangId'] = $row['lang_id'];
    		$singlequs['questext'] = $row['pretext']."\n\n".$row['ques_text'];
    		$singlequs['CatSendId']  = $catid2sendcatid[$row['quescatid']];
    		$singlequs['bankName'] = $row['bankname'];
    		$singlequs['year'] = $row['year'];
    		if($row['prtxtimg'] != "")
    			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['prtxtimg'];
    		else if($row['ques_image'] != "")
    			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['ques_image'];
    		else
    			$singlequs['image'] = "";
    		$singlequs['correctoption'] = $row['correctopt'];
    		$singlequs['solution']= $row['sol_text'];
    		if($row['sol_image'] != "")
    			$singlequs['solutionimage'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['sol_image'];
    		else
    			$singlequs['solutionimage'] = "";
    
    		$optquery = "select * from options where QuesId = ".$row['id'];
    		$opt_result = mysqli_query($db,$optquery);
    		$totaloptions = mysqli_num_rows($opt_result);
    		$singlequs['total_options'] = $totaloptions;
    		$optArray = array();
    		while($optrow = mysqli_fetch_array($opt_result))
    		{
    			$singleopt = array();
    			$singleopt['id'] = $optrow['OptionId'];
    			$singleopt['optiontext'] = $optrow['OptionText'];
    			$singleopt['optionsnumber'] = $optrow['OptionNo'];
    			if($optrow['image'] != "")
    				$singleopt['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$optrow['image'];
    			else
    				$singleopt['image'] = "";
    
    			array_push($optArray, $singleopt);
    		}
    		$singlequs['options'] = $optArray;
    
    		array_push($allquestionsarray, $singlequs);
        }
        }
        else if($i == 4)
        {
            $qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid in (".implode(',',$computercategoryid).") and qr.lang_id = '".$langCode."' and qr.id > ".$id_of_last_qus." and qr.id>1593 limit ".$limit;
        $qus_result = mysqli_query($db,$qusquery);
    	while($row = mysqli_fetch_array($qus_result) )
    	{
    		$singlequs = array();
    
    		$singlequs['QuesId'] = $row['id'];
    		$singlequs['LangId'] = $row['lang_id'];
    		$singlequs['questext'] = $row['pretext']."\n\n".$row['ques_text'];
    		$singlequs['CatSendId']  = $catid2sendcatid[$row['quescatid']];
    		$singlequs['bankName'] = $row['bankname'];
    		$singlequs['year'] = $row['year'];
    		if($row['prtxtimg'] != "")
    			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['prtxtimg'];
    		else if($row['ques_image'] != "")
    			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['ques_image'];
    		else
    			$singlequs['image'] = "";
    		$singlequs['correctoption'] = $row['correctopt'];
    		$singlequs['solution']= $row['sol_text'];
    		if($row['sol_image'] != "")
    			$singlequs['solutionimage'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['sol_image'];
    		else
    			$singlequs['solutionimage'] = "";
    
    		$optquery = "select * from options where QuesId = ".$row['id'];
    		$opt_result = mysqli_query($db,$optquery);
    		$totaloptions = mysqli_num_rows($opt_result);
    		$singlequs['total_options'] = $totaloptions;
    		$optArray = array();
    		while($optrow = mysqli_fetch_array($opt_result))
    		{
    			$singleopt = array();
    			$singleopt['id'] = $optrow['OptionId'];
    			$singleopt['optiontext'] = $optrow['OptionText'];
    			$singleopt['optionsnumber'] = $optrow['OptionNo'];
    			if($optrow['image'] != "")
    				$singleopt['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$optrow['image'];
    			else
    				$singleopt['image'] = "";
    
    			array_push($optArray, $singleopt);
    		}
    		$singlequs['options'] = $optArray;
    
    		array_push($allquestionsarray, $singlequs);
        }
	}
}
/*foreach ($engcategoryid as $catid => $limit)
{
	$qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid = ".$catid." and qr.lang_id = 'en' and qr.id > ".$id_of_last_qus." and qr.id>1593 limit ".$limit;
	$qus_result = mysql_query($qusquery);
	while($row = mysql_fetch_array($qus_result) )
	{
		$singlequs = array();

		$singlequs['QuesId'] = $row['id'];
		$singlequs['LangId'] = $row['lang_id'];
		$singlequs['questext'] = $row['pretext']."\n\n".$row['ques_text'];
		$singlequs['CatSendId']  = $catid2sendcatid[$row['quescatid']];
		$singlequs['bankName'] = $row['bankname'];
		$singlequs['year'] = $row['year'];
		if($row['prtxtimg'] != "")
			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['prtxtimg'];
		else if($row['ques_image'] != "")
			$singlequs['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['ques_image'];
		else
			$singlequs['image'] = "";
		$singlequs['correctoption'] = $row['correctopt'];
		$singlequs['solution']= $row['sol_text'];
		if($row['sol_image'] != "")
			$singlequs['solutionimage'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$row['sol_image'];
		else
			$singlequs['solutionimage'] = "";

		$optquery = "select * from options where QuesId = ".$row['id'];
		$opt_result = mysql_query($optquery);
		$totaloptions = mysql_num_rows($opt_result);
		$singlequs['total_options'] = $totaloptions;
		$optArray = array();
		while($optrow = mysql_fetch_array($opt_result))
		{
			$singleopt = array();
			$singleopt['id'] = $optrow['OptionId'];
			$singleopt['optiontext'] = $optrow['OptionText'];
			$singleopt['optionsnumber'] = $optrow['OptionNo'];
			if($optrow['image'] != "")
				$singleopt['image'] = "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$optrow['image'];
			else
				$singleopt['image'] = "";

			array_push($optArray, $singleopt);
		}
		$singlequs['options'] = $optArray;

		array_push($allquestionsarray, $singlequs);
	}
}*/
//print_r($allquestionsarray);


$doc = new DOMDocument('1.0', 'UTF-8');
// we want a nice output
$doc->formatOutput = true;
$root = $doc->createElement("Question_Database");
$root = $doc->appendChild($root);

foreach ($allquestionsarray as $key => $value)
{
	$title = $doc->createElement('Question');
	$title = $root->appendChild($title);
	$qus_lang = $doc->createAttribute('language');
	$qus_lang->value = $value['LangId'];
	$title->appendChild($qus_lang);

	$qus_ID = $doc->createAttribute('QuesId');
	$qus_ID->value = $value['QuesId'];
	$title->appendChild($qus_ID);

	$qus_cat = $doc->createAttribute('CategoryId');
	$qus_cat->value = $value['CatSendId'];
	$title->appendChild($qus_cat);

	if($value['bankName'] != "")
	{
		$qus_Bank = $doc->createAttribute('BankName');
		$qus_Bank->value = $value['bankName'];
		$title->appendChild($qus_Bank);
	}
	if($value['year'] != "")
	{
		$qus_Year = $doc->createAttribute('Year');
		$qus_Year->value = $value['year'];
		$title->appendChild($qus_Year);
	}

	$qus_text = $doc->createElement('Question_Text');
	$qus_text_node = $doc->createTextNode($value['questext']);
	$qus_text->appendChild($qus_text_node);
	$qus_text = $title->appendChild($qus_text);

	if($value['image'] != "")
	{
		$qus_Image = $doc->createAttribute('Image');
		$qus_Image->value = $value['image'];
		$qus_text->appendChild($qus_Image);
	}

	$qus_opt = $doc->createElement('Options');
	$qus_opt = $title->appendChild($qus_opt);
	$qus_tot_opt = $doc->createAttribute('total_options');
	$qus_tot_opt->value = $value['total_options'];
	$qus_opt->appendChild($qus_tot_opt);

	foreach ($value['options'] as $optkey => $optvalue)
	{
		if($optvalue['optiontext'] != "")
		{
			//$option = $doc->createElement($opt_number);
            $option = $doc->createElement("Option");
			$option_text_node = $doc->createTextNode($optvalue['optiontext']);
			$option->appendChild($option_text_node);
			$option = $qus_opt->appendChild($option);
            
		}
		else
		{
			$option = $doc->createElement("Option"," ");
			$option = $qus_opt->appendChild($option);
		}

		$optNumber = $doc -> createAttribute("Number");
        $optNumber->value = $optvalue['optionsnumber'];
        $option->appendChild($optNumber);
        
		if($optvalue['image'] != "")
		{
			$opt_Image = $doc->createAttribute('Image');
			$opt_Image->value = $optvalue['image'];
			$option->appendChild($opt_Image);
		}
	}

	if($value['solution'] != "")
	{
	//	$answer = $doc->createElement('Answer',$value['solution']);
	//	$answer = $title->appendChild($answer);
        
            $answer = $doc->createElement("Answer");
    		$answer_text_node = $doc->createTextNode($value['solution']);
			$answer->appendChild($answer_text_node);
			$answer = $title->appendChild($answer);
        
	}
	else
	{
		$answer = $doc->createElement('Answer'," ");
		$answer = $title->appendChild($answer);
	}
	if($value['solutionimage'] != "")
	{
		$solution_Image = $doc->createAttribute('Image');
		$solution_Image->value = $value['solutionimage'];
		$answer->appendChild($solution_Image);			
	}
	
	$choice_number = $doc->createAttribute('Option_number');
	$choice_number->value = $value['correctoption'];
	$answer->appendChild($choice_number);

}

/*while($row = mysql_fetch_array($qus_result) )
	{
		$singlequs = array();

		$singlequs['QuesId'] = 
	}*/
/*$doc = new DOMDocument('1.0', 'UTF-8');
// we want a nice output
$doc->formatOutput = true;
$root = $doc->createElement("Question_Database");
$root = $doc->appendChild($root);


if($langCode == "hi")
{
	
	$qus_query = "select * from ( select * from qrecord as t2 where t2.QuesId in ( select t1.QuesId from qusappmapping as t1 where t1.AppId = ".$id_of_app." ) ) as t3 where t3.QuesId > ".$id_of_last_qus." and LangId = 'en' and QuesCatId=2 limit 40";	
	
	$qus_result = mysql_query($qus_query);

	while($qus_row=mysql_fetch_array($qus_result))
	{
	
			$title = $doc->createElement('Question');
			$title = $root->appendChild($title);
				$qus_lang = $doc->createAttribute('language');
				$qus_lang->value = $qus_row['LangId'];
				$title->appendChild($qus_lang);
				
				$qus_ID = $doc->createAttribute('QuesId');
				$qus_ID->value = $qus_row['QuesId'];
				$title->appendChild($qus_ID);
				
				$categorySelectQuery = "select * from catappmapping where CatId=".$qus_row['QuesCatId']." and AppId=".$id_of_app." ";
				$categorySelectResult = mysql_query($categorySelectQuery);
				while($categorySelectRow = mysql_fetch_array($categorySelectResult))
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
			$no_of_opts = mysql_query($no_of_opts_query);
			$no_value = mysql_fetch_row($no_of_opts);
			
			$qus_opt = $doc->createElement('Options');
			$qus_opt = $title->appendChild($qus_opt);
			$qus_tot_opt = $doc->createAttribute('total_options');
			$qus_tot_opt->value = $no_value[0];
			$qus_opt->appendChild($qus_tot_opt);
				
				$opt_qry = "select * from options where QuesId=".$qus_row['QuesId'];
				$opt_result = mysql_query($opt_qry);
				//$i = 0;
				while($opt_row=mysql_fetch_array($opt_result))
				{
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

$qus_result = mysql_query($qus_query);

while($qus_row=mysql_fetch_array($qus_result))
{

        $title = $doc->createElement('Question');
		$title = $root->appendChild($title);
			$qus_lang = $doc->createAttribute('language');
			$qus_lang->value = $qus_row['LangId'];
			$title->appendChild($qus_lang);
            
    		$qus_ID = $doc->createAttribute('QuesId');
			$qus_ID->value = $qus_row['QuesId'];
			$title->appendChild($qus_ID);
			
			$categorySelectQuery = "select * from catappmapping where CatId=".$qus_row['QuesCatId']." and AppId=".$id_of_app." ";
			$categorySelectResult = mysql_query($categorySelectQuery);
			while($categorySelectRow = mysql_fetch_array($categorySelectResult))
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
		$no_of_opts = mysql_query($no_of_opts_query);
		$no_value = mysql_fetch_row($no_of_opts);
		
		$qus_opt = $doc->createElement('Options');
		$qus_opt = $title->appendChild($qus_opt);
		$qus_tot_opt = $doc->createAttribute('total_options');
		$qus_tot_opt->value = $no_value[0];
		$qus_opt->appendChild($qus_tot_opt);
			
			$opt_qry = "select * from options where QuesId=".$qus_row['QuesId'];
			$opt_result = mysql_query($opt_qry);
			//$i = 0;
			while($opt_row=mysql_fetch_array($opt_result))
			{
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
}*/




$mime = 'application/xml';
$file_name = "questionDatabase";

header('Pragma:public');
header('Expires:0');
header('Cache-Control: private',true);
header('Content-Type: '.$mime);
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');

echo $doc->saveXML();
header('Content-Length: '.ob_get_length());
ob_end_flush();

//$doc->save("downloadXmlFile/QuestionDatabase.xml");
//header("location: downloadXmlFile/DownloadXml.php?lastQuestionNumber=".$id_of_last_qus."&appId=".$id_of_app."&deviceIMEI=".$id_of_device);

?>