<?php
$timestart = time();

include("database_connection.php");
//***********************************************//
//$id_of_last_qus = $_GET['lastQuestionNumber'];
$id_of_last_qus = 50;
//$id_of_app = $_GET['appId'];
//$id_of_device= $_GET['deviceIMEI'];
$langCode = $_GET['LangCode'];
//$gcmId = $_REQUEST['gcmId'];
$catidget = $_REQUEST['catid'];
//**********************************************//

//$TotalLimit = 200;


//*********************************************//

/*$insertDownloadQuery = "insert into downloadcounter (AppId,DeviceId,LangCode,gcmId) values (".$id_of_app.",".$id_of_device.",'".$langCode."','".$gcmId."')";*/
//echo $insertDownloadQuery."<br>";
/*mysql_query($insertDownloadQuery);*/
//echo "Insert id is :".mysql_insert_id()."<br>";



////    www.xercesblue.in/onlinexamserver/liquid_data/xport_xml.php?lastQuestionNumber=1&appId=1&deviceIMEI=232323232323&LangCode=hi

/*$engcategoryid = array(
    				19=>24,
					21=>32,
					22=>20,
					23=>40,
					24=>20,
					47=>12,
					48=>12
					
					);*/
				//("catid"=>"ques_per_set")
$allcategoryid = array(
					array(/*reasoning*/	6=>32,
										//7=>2,
										8=>32,
										9=>8,
										10=>12,
										11=>8,
										12=>8,
										13=>8,
										//14=>1,
										15=>8,
										16=>8,
										17=>8,
										18=>28
						),
					array(/*English*/	19=>24,
										21=>32,
										22=>20,
										23=>40,
										24=>20,
										47=>12,
										48=>12
						),

					array(/*Maths*/		25=>20,
										26=>20,
										27=>8,
										28=>4,
										29=>8,
										30=>8,
										31=>4,
										32=>4,
										33=>4,
										34=>8,
										35=>8,
										36=>4,
										37=>8,
										38=>8,
										39=>4,
										43=>12,
										44=>8,
										45=>8,
										46=>12
						),					

						array(/*GK*/	41=>120,
										42=>40
						),
						array(/*Computer*/	5=>160)

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
//echo "<html><head><meta charset='utf-8'/></head><body><pre>";
$needcategoryquestions = $allcategoryid[$catidget-1];
//print_r($needcategoryquestions);
foreach ($needcategoryquestions as $catid => $limit)
{
	$qusquery = "SELECT qr.id,qr.ques_text,qr.ques_image,qr.lang_id,qr.sol_text,qr.sol_image,qinfo.quescatid,qinfo.correctopt,qinfo.hint,qinfo.bankname,qinfo.year,prtxt.pretext,prtxt.image as prtxtimg FROM qrecord as qr inner join ques_info as qinfo on qinfo.quesid = qr.quesid left join pretext_record as prtxt on prtxt.id = qr.pretextid where qinfo.quescatid = ".$catid." and qr.lang_id = '".$langCode."' and qr.id > ".$id_of_last_qus." limit ".$limit;
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
}
print_r($allquestionsarray);
$timeend = time();
echo $timeend-$timestart;
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



//$mime = 'application/xml';
//$file_name = "questionDatabase";

//header('Pragma:public');
//header('Expires:0');
//header('Cache-Control: private',false);
//header('Content-Type: '.$mime);
//header('Content-Disposition: attachment; filename="'.basename($file_name).'"');


//echo $doc->saveXML();

?>