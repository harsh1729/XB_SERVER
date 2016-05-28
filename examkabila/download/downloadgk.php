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
 $username = "xercewwv_dbuser";
 $password = "Xerces@1985";
 $database_name = "xercewwv_xamDB";
 $db = mysqli_connect($hostname,$username,$password,$database_name);
 if (mysqli_connect_errno()) {
     printf("Connect failed: %s\n", mysqli_connect_error());
     exit();
 }

//mysql_connect($hostname,$username,$password);
//mysql_select_db($database) or die("Something went wrong in database!");
$language=$_REQUEST['language'];
$month=$_REQUEST['date'];
$month_name=$_REQUEST['month'];
$pdf_name = $month_name;
$pdf_year = substr($month,0,4);
//$language='hi';
//$month='2015-06';
$month_name='<b><h2 align="center" color="#0066CC" >'.$month_name.'</h2></b>';
$pdf_year_name='<b><h2 align="center" color="#0066CC" style="float:left" >'.$pdf_year.'</h2></b>';
//print_r($month);
$month="%".$month."-%";

//print_r($month);



$sql = "SELECT Question, OptionText
       FROM currentGKQrecord T1
INNER JOIN currentGKOptions T2 ON (T1.QuesId = T2.QuesId) AND (T1.correctOption=T2.OptionNo) Where LangId ='".$language."' AND date LIKE'".$month."'" ;



//mysql_connect($hostname,$username,$password);
    $callTypeResult = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($callTypeResult)){
//print_r($row);

	
	 	$Ques_No=$Ques_No+($i);
	
	array_push($cars, '<b>Q.'.$Ques_No.':</b>&nbsp;&nbsp;'.$row['Question'].'<br>');

   array_push($cars, '<b>Ans:</b>&nbsp;&nbsp;'.$row['OptionText'].'<br><br>');
   
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
<h1 align="center" color="#0066CC" ><u>Current Affairs </u></h1>


'.$month_name.$pdf_year_name.$save;
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
//$html1=utf8_encode($html);
$mpdf->ignore_invalid_utf8 = true;
$mpdf->WriteHTML($html);
$mpdf->Output($pdf_name .'-'.$pdf_year.'.pdf','D');
exit;

//==============================================================
//==============================================================


?>
</html>
