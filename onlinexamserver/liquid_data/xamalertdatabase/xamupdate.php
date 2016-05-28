<?php

include("../database_connection.php");

$doc = new DOMDocument('1.0', 'UTF-8');
// we want a nice output
$doc->formatOutput = true;
$root = $doc->createElement("ExamAlert");
$root = $doc->appendChild($root);

$XamDetailQuery = "select * from XamAlert_Details";
//$XamDetailResult = mysql_query($XamDetailQuery);
$XamDetailResult = $db->query($XamDetailQuery);
while($XamDetailRow = mysqli_fetch_array($XamDetailResult) )
{
	$title = $doc->createElement('ExamName');
	$title = $root->appendChild($title);
			$ExamName = $doc->createAttribute('Exam_Name');
			$ExamName->value = $XamDetailRow['Name'];
			$title->appendChild($ExamName);
			
			$ExamOpeningDate = $doc->createAttribute('Opening_Date');
			$ExamOpeningDate->value = "Opening Date: ".$XamDetailRow['OpeningDate'];
			$title->appendChild($ExamOpeningDate);
			
			$DetailString = "";
			if($XamDetailRow['OfflineLastDate']!=""){
			$DetailString .= "Offline Last Date : ".$XamDetailRow['OfflineLastDate']." $";
			}
            if($XamDetailRow['OnlineLastDate']!=""){
			$DetailString .= "Online Last Date : ".$XamDetailRow['OnlineLastDate']." $$";
            }
			$DetailString .= "Posts : ";
			
			
			$XamPostsQuery = "select * from XamAlert_Posts where XamDetailId=". $XamDetailRow['Id'];
			//$XamPostsResult = mysql_query($XamPostsQuery);
			$XamPostsResult = $db->query($XamPostsQuery);
			$cnt = 1;
			while($XamPostsRow = mysqli_fetch_array($XamPostsResult) )
			{
				$DetailString .= " $$ ".$cnt.". ".$XamPostsRow['RankName']." $ ";
				$DetailString .= "@@Salary : ".$XamPostsRow['Salary']." $ ";
				$DetailString .= "@@Seats : ".$XamPostsRow['TotalSeats']." $ ";
				$DetailString .= "@@Exam Dates : ";
				
				$XamDatesQuery = "select * from XamAlert_Dates where PostId=".$XamPostsRow['Id'];
				//$XamDatesResult = mysql_query($XamDatesQuery);
				$XamDatesResult = $db->query($XamDatesQuery);
				//$DateCnt = 1;
				while($XamDatesRow = mysqli_fetch_array($XamDatesResult) )
				{
					//$DetailString .= " $ ".$DateCnt.".@@".$XamDatesRow['Date'];
					$DetailString .= " $@@@".$XamDatesRow['Date'];
					//$DateCnt++;
				}
				$cnt++;
			}
			//echo $DetailString;
	$detail = $doc->createElement('Details',$DetailString);
	$detail = $title->appendChild($detail);
 
}
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="jaspalCheck.xml"');	
echo $doc->saveXML();

?>