<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
</head>
 
<?php
$Ques_No=0;
$i=1;
$cars = array();

 $hostname = "localhost";
 $username = "xercewwv_kabila";
 $password = "Xerces@1985";
 $database_name = "xercewwv_examkabilaDB";
 $db = mysqli_connect($hostname,$username,$password,$database_name);
 if (mysqli_connect_errno()) {
     printf("Connect failed: %s\n", mysqli_connect_error());
     exit();
 }

$language=$_REQUEST['language'];
$itemid=(int)$_REQUEST['itemid'];
$setno=$_REQUEST['setno'];
$set_type = $_REQUEST['type'];

	$pdf_setno = $setno;
$setno='<b><h2 align="center" color="#0066CC" >Set'.$setno.'</h2></b>';


//print_r($month);



$sql = "SELECT options.OptionText,options.image as optimg,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,pretext_record.pretext,pretext_record.image as pretext_image From qrecord INNER JOIN ques_info ON (ques_info.quesid = qrecord.quesid) LEFT JOIN pretext_record ON (pretext_record.id = qrecord.pretextid) INNER JOIN options ON (qrecord.id = options.QuesId) AND (ques_info.correctopt = options.OptionNo) where set_no=".$itemid." and type='".$set_type."' and qrecord.lang_id='".$language."' order by qrecord.id asc";




    $callTypeResult = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($callTypeResult)){
//print_r($row);

$pretext = str_replace("<","&lt;",$row['pretext']);
$pretext = str_replace(">","&gt;",$pretext);

$pretext_image = str_replace("<","&lt;",$row['pretext_image']);
$pretext_image = str_replace(">","&gt;",$pretext_image);

$ques_text = str_replace("<","&lt;",$row['ques_text']);
$ques_text = str_replace(">","&gt;",$ques_text);

$ques_image = str_replace("<","&lt;",$row['ques_image']);
$ques_image = str_replace(">","&gt;",$ques_image);

$OptionText = str_replace("<","&lt;",$row['OptionText']);
$OptionText = str_replace(">","&gt;",$OptionText);

$sol_text = str_replace("<","&lt;",$row['sol_text']);
$sol_text = str_replace(">","&gt;",$sol_text);

$sol_image = str_replace("<","&lt;",$row['sol_image']);
$sol_image = str_replace(">","&gt;",$sol_image);

$opt_image = str_replace("<","&lt;",$row['optimg']);
$opt_image = str_replace(">","&gt;",$opt_image );
	







	 	$Ques_No=$Ques_No+($i);
	
	if($row['pretext'] != null )
	{
		array_push($cars, '<b>Q.'.$Ques_No.':</b>&nbsp;&nbsp;'.$pretext.'<br>');	
	}
	
	if($row['pretext_image'] != null)
	{
		array_push($cars, "&nbsp;&nbsp;<img src='http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image."'/>"."<br>");
//echo "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$pretext_image;
	}
	 if($row['pretext'] == null || $row['pretext'] == "")
        {
	   array_push($cars, '<b>Q.'.$Ques_No.':</b>&nbsp;&nbsp;'.$ques_text.'<br>');
        }
        else
       {
         array_push($cars, ''.$ques_text.'<br>');
        }
	if($row['ques_image'] != "")
	{
		array_push($cars, "&nbsp;&nbsp;<img src='http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$ques_image."'>"."<br>");
	}
   array_push($cars, '<b>Ans:</b>&nbsp;&nbsp;'.$OptionText.'<br>');
   if($row['optimg'] != "")
   {
      array_push($cars, "&nbsp;&nbsp;<img src='http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$opt_image ."'>"."<br>");

   }
   if($row['sol_text'] != "")
   {
   	array_push($cars, '<b>Sol:</b>&nbsp;&nbsp;'.$sol_text.'<br><br>');
//echo $row['sol_text'];
   }
   else
   {
   	array_push($cars, '<br>');
   }
   if($row['sol_image'] !="")
   {
   	array_push($cars, "sol. &nbsp;&nbsp;<img src='http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$sol_image."'>"."<br><br>");
   }
   else
   {
   		array_push($cars, '<br>');
   }
   
}
//mysql_connect($hostname,$username,$password);
if($language == 'hi')
{
	$english_categoryid = array(
					19,
					21,
					22,
					23,
					24,
					47,
					48
					);
	$sql = 	"SELECT options.OptionText,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,pretext_record.pretext,pretext_record.image as pretext_image From qrecord INNER JOIN ques_info ON (ques_info.quesid = qrecord.quesid) LEFT JOIN pretext_record ON (pretext_record.id = qrecord.pretextid) INNER JOIN options ON (qrecord.id = options.QuesId) AND (ques_info.correctopt = options.OptionNo) where ques_info.quescatid in (".implode(',',$english_categoryid).") and set_no=".$itemid." and type='".$set_type."' order by qrecord.id asc";
	  $callTypeResult = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($callTypeResult)){
//print_r($row);
	
	 $pretext = str_replace("<","&lt;",$row['pretext']);
$pretext = str_replace(">","&gt;",$pretext);

$pretext_image = str_replace("<","&lt;",$row['pretext_image']);
$pretext_image = str_replace(">","&gt;",$pretext_image);

$ques_text = str_replace("<","&lt;",$row['ques_text']);
$ques_text = str_replace(">","&gt;",$ques_text);

$ques_image = str_replace("<","&lt;",$row['ques_image']);
$ques_image = str_replace(">","&gt;",$ques_image);

$OptionText = str_replace("<","&lt;",$row['OptionText']);
$OptionText = str_replace(">","&gt;",$OptionText);

$sol_text = str_replace("<","&lt;",$row['sol_text']);
$sol_text = str_replace(">","&gt;",$sol_text);

$sol_image = str_replace("<","&lt;",$row['sol_image']);
$sol_image = str_replace(">","&gt;",$sol_image);


	







	 	$Ques_No=$Ques_No+($i);
	
	if($row['pretext'] != null)
	{
		array_push($cars, '<b>Q.'.$Ques_No.':</b>&nbsp;&nbsp;'.$pretext.'<br>');	
	}
	
	if($row['pretext_image'] != null)
	{
		array_push($cars, "&nbsp;&nbsp;<img src='http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image."'/>"."<br>");

	}
        if($row['pretext'] == null || $row['pretext'] == "")
        {
	   array_push($cars, '<b>Q.'.$Ques_No.':</b>&nbsp;&nbsp;'.$ques_text.'<br>');
        }
        else
       {
         array_push($cars, ''.$ques_text.'<br>');
        }
	if($row['ques_image'] != "")
	{
		array_push($cars, "&nbsp;&nbsp;<img src='http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$ques_image."'>"."<br>");
	}
   array_push($cars, '<b>Ans:</b>&nbsp;&nbsp;'.$OptionText.'<br>');
   if($row['sol_text'] != "")
   {
   	array_push($cars, '<b>Sol:</b>&nbsp;&nbsp;'.$sol_text.'<br><br>');
//echo $row['sol_text'];
   }
   else
   {
   	array_push($cars, '<br>');
   }
   if($row['sol_image'] !="")
   {
   	array_push($cars, "&nbsp;&nbsp;<img src='http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$sol_image."'>"."<br><br>");
   }
   else
   {
   		array_push($cars, '<br>');
   }
   
}
}
$save = "";
for($i=0;$i<count($cars);$i++){
	$save = $save.$cars[$i];
	//print_r($cars[$i]);

}

$html = '
<style>
body, p, div { font-size: 14pt; font-family: freeserif;line-height:1.5em;}

</style>
<h1 align="center" color="#0066CC" ><u>Banking Gk</u></h1>


'.$setno.$save;
//echo $html;

//==============================================================
//==============================================================
//==============================================================
include("mpdf60/mpdf.php");
$mpdf=new mPDF('','A4'); 
$mpdf->AddPage();
//$mpdf->SetWatermarkImage('mp;df60/nameIcon.png');
$mpdf->showWatermarkImage = true;
$mpdf->WriteHTML('<watermarkimage src="mpdf60/nameIcon.jpg" alpha="0.3" size="180,30" />');
$mpdf->setFooter('{PAGENO}');
$mpdf->WriteHTML($html);
$mpdf->Output('Set'.$pdf_setno.'.pdf','D');
exit;

//==============================================================
//==============================================================


?>
</html>
