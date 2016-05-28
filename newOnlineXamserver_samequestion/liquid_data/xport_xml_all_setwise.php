<?php

include("database_connection.php");
//***********************************************//
//$id_of_last_qus = $_GET['lastQuestionNumber'];
//$id_of_app = $_GET['appId'];
//$id_of_device= $_GET['deviceIMEI'];
//$langCode = $_GET['LangCode'];
//$gcmId = $_REQUEST['gcmId'];

$TotalSets = 4; 
//**********************************************//

//$TotalLimit = 200;


//*********************************************//

/*$insertDownloadQuery = "insert into downloadcounter (AppId,DeviceId,LangCode,gcmId) values (".$id_of_app.",".$id_of_device.",'".$langCode."','".$gcmId."')";*/
//echo $insertDownloadQuery."<br>";
/*mysql_query($insertDownloadQuery);*/
//echo "Insert id is :".mysql_insert_id()."<br>";



////    www.xercesblue.in/onlinexamserver/liquid_data/xport_xml.php?lastQuestionNumber=1&appId=1&deviceIMEI=232323232323&LangCode=hi

$engcategoryid = array(
                    19=>6,
					21=>8,
					22=>5,
					23=>10,
					24=>5,
					47=>3,
					48=>3
					
					);
				//("catid"=>"ques_per_set")
$allcategoryid = array(
	/*reasoning*/	6=>8,
					//7=>2,
					8=>8,
					9=>2,
					10=>3,
					11=>2,
					12=>2,
					13=>2,
					//14=>1,
					15=>2,
					16=>2,
					17=>2,
					18=>7,

	/*Maths*/		25=>5,
					26=>5,
					27=>2,
					28=>1,
					29=>2,
					30=>2,
					31=>1,
					32=>1,
					33=>1,
					34=>2,
					35=>2,
					36=>1,
					37=>2,
					38=>2,
					39=>1,
					43=>3,
					44=>2,
					45=>2,
					46=>3,
					
	/*GK*/			41=>30,
					42=>10,
					
	/*Computer*/	5=>40	
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

$lastQidArrayEn = array(
	/*reasoning*/	6=>0,
					7=>0,
					8=>0,
					9=>0,
					10=>0,
					11=>0,
					12=>0,
					13=>0,
					14=>0,
					15=>0,
					16=>0,
					17=>0,
					18=>0,

	/*Maths*/		25=>0,
					26=>0,
					27=>0,
					28=>0,
					29=>0,
					30=>0,
					31=>0,
					32=>0,
					33=>0,
					34=>0,
					35=>0,
					36=>0,
					37=>0,
					38=>0,
					39=>0,
					43=>0,
					44=>0,
					45=>0,
					46=>0,
					
	/*GK*/			41=>0,
					42=>0,
					
	/*Computer*/	5=>0,

	/*english*/		19=>0,
					21=>0,
					22=>0,
					23=>0,
					24=>0,
					47=>0,
					48=>0
				);
$lastQidArrayHi = array(
	/*reasoning*/	6=>0,
					7=>0,
					8=>0,
					9=>0,
					10=>0,
					11=>0,
					12=>0,
					13=>0,
					14=>0,
					15=>0,
					16=>0,
					17=>0,
					18=>0,

	/*Maths*/		25=>0,
					26=>0,
					27=>0,
					28=>0,
					29=>0,
					30=>0,
					31=>0,
					32=>0,
					33=>0,
					34=>0,
					35=>0,
					36=>0,
					37=>0,
					38=>0,
					39=>0,
					43=>0,
					44=>0,
					45=>0,
					46=>0,
					
	/*GK*/			41=>0,
					42=>0,
					
	/*Computer*/	5=>0
				);

$allquestionsarray = array();
//echo "<html><head><meta charset='utf-8'/></head><body><pre>";
for($lp=0;$lp<$TotalSets;$lp++)
{
	get_questions($allcategoryid,'en');
	get_questions($allcategoryid,'hi');
	get_questions($engcategoryid,'en');
}
//print_r($allquestionsarray);

function get_questions($categoryarray,$langCode)
{
	global $lastQidArrayEn,$lastQidArrayHi,$catid2sendcatid,$allquestionsarray;
	foreach ($categoryarray as $catid => $limit)
	{
		if($langCode == 'en')
			$lastQid = $lastQidArrayEn[$catid];
		else if($langCode == 'hi')
			$lastQid = $lastQidArrayHi[$catid];
		$qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg,prtxt.id as prtxtid FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid = ".$catid." and qr.lang_id = '".$langCode."' and qr.id > ".$lastQid." limit ".$limit;
		$qus_result = mysql_query($qusquery);

		$singlesetquestions = array();
		while($row = mysql_fetch_array($qus_result) )
		{
			$singlequs = array();

			$singlequs['QuesId'] = $row['id'];
			$singlequs['LangId'] = $row['lang_id'];
			$singlequs['questext'] = $row['pretext']."\n\n".$row['ques_text'];
			$singlequs['originalcatid'] = $row['quescatid'];
			$singlequs['CatSendId']  = $catid2sendcatid[$row['quescatid']];
			$singlequs['bankName'] = $row['bankname'];
			$singlequs['year'] = $row['year'];
			$singlequs['prtxtid'] = $row['prtxtid'];
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

			array_push($singlesetquestions, $singlequs);
		}
		$singlesetquestions = bubblesort($singlesetquestions);
	    foreach($singlesetquestions as $row)
	        array_push($allquestionsarray, $row);
	}
}

function bubblesort($objtosort)
{
	global $lastQidArrayEn,$lastQidArrayHi;
	for($i=0;$i<count($objtosort);$i++)
	{
		for($j=$i+1;$j<count($objtosort);$j++)
		{

			if(!empty($objtosort[$j]['prtxtid']) && !empty($objtosort[$i]['prtxtid']))
			{
				//print_r($objtosort[$j]['prtxtid']);
    			if($objtosort[$i]['prtxtid'] == $objtosort[$j]['prtxtid'])
    			{
    				$temp = $objtosort[$j];
    				array_splice($objtosort,$j,1);
    				array_splice($objtosort,$i+1,0,array($temp));
                    $i++;
    			}
    		}
		}
		/*echo "<br>QuesId:".$objtosort[$i]['QuesId']."       pretextId:";
		print_r($objtosort[$i]['prtxtid']);*/
	}
    for($i=0;$i<count($objtosort);$i++)
    {
    	if($objtosort[$i]['LangId'] == 'en')
		{
			if($objtosort[$i]['QuesId'] > $lastQidArrayEn[ $objtosort[$i]['originalcatid'] ])
			{
				$lastQidArrayEn[ $objtosort[$i]['originalcatid'] ] = $objtosort[$i]['QuesId'];
			}
		}
		else if($objtosort[$i]['LangId'] == 'hi')
		{
			if($objtosort[$i]['QuesId'] > $lastQidArrayHi[ $objtosort[$i]['originalcatid'] ])
			{
				$lastQidArrayHi[ $objtosort[$i]['originalcatid'] ] = $objtosort[$i]['QuesId'];
			}
		}
    }
	return $objtosort;
}

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
		$answer = $doc->createElement('Answer',$value['solution']);
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



$mime = 'application/xml';
$file_name = "questionDatabase";

header('Pragma:public');
header('Expires:0');
header('Cache-Control: private',false);
header('Content-Type: '.$mime);
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');


echo $doc->saveXML();

?>