<?php
session_start();
if(isset($_SESSION['data_login_id']))
    header("location:../../index.php");
?>
<?php

include("../database_connection.php");

$ExamName = $_REQUEST['XamName'];
//$OpeningDate =  $_REQUEST['OpeningDate'];
$OpeningDate = "";
$OnlineLastDate = "";
$OfflineLastDate = "";


if($_REQUEST['OpeningDate'] != "")
$OpeningDate =  date("d-m-Y",strtotime( $_REQUEST['OpeningDate'] ) );

//$OfflineLastDate = $_REQUEST['OfflineLastDate'];
if($_REQUEST['OfflineLastDate'] != "")
$OfflineLastDate = date("d-m-Y",strtotime( $_REQUEST['OfflineLastDate'] ) );


//$OnlineLastDate = $_REQUEST['OnlineLastDate'];
if($_REQUEST['OnlineLastDate'] != "")
$OnlineLastDate = date("d-m-Y",strtotime( $_REQUEST['OnlineLastDate'] ) );

$TotalPost = $_REQUEST['TotalPost'];

$RankName = array();
$TotalSeats = array();
$Salary = array();
$seats = "";

$XamDateTotal = array();
$XamDates2DArray = array();

for($i=0;$i < $TotalPost;$i++)
{
    array_push($RankName, $_REQUEST['PostName'.($i+1)] );
	//echo "rank name:".$RankName[$i].":<br>";
    $seats = $_REQUEST['TotalSeats'.($i+1)];
    array_push($TotalSeats, $seats);
	array_push($Salary,$_REQUEST['Salary'.($i+1)]);
	
	array_push($XamDateTotal, $_REQUEST['PostName'.($i+1).'XamDateTotal']);
	$XamArrayTemp = array();
	for( $j = 0; $j < 	$_REQUEST['PostName'.($i+1).'XamDateTotal']; $j++)
	{  
       // date("d-m-Y",strtotime
        $newTempDate = $_REQUEST['PostName'.($i+1).'XamDate'.($j+1)];

        
		//array_push($XamArrayTemp, $_REQUEST['PostName'.($i+1).'XamDate'.($j+1)] );
        array_push($XamArrayTemp, $newTempDate );
	}
	array_push($XamDates2DArray,$XamArrayTemp);
}

$XamAlert_Details_Query = "insert into XamAlert_Details_Test (Name,OpeningDate,OfflineLastDate,OnlineLastDate,TotalPost) values ('".$ExamName."','".$OpeningDate."','".$OfflineLastDate."','".$OnlineLastDate."',".$TotalPost.") ";
//mysql_query($XamAlert_Details_Query);
$db->query($XamAlert_Details_Query);
$XamAlertDetailsId = mysqli_insert_id();


//echo "<br>detail id: ".$XamAlertDetailsId;

for($i=0 ; $i < $TotalPost ; $i++)
{
	$XamAlert_Posts_Query = "insert into XamAlert_Posts_Test (XamDetailId,TotalSeats,Salary,RankName) values (".$XamAlertDetailsId.",".$TotalSeats[$i].",".$Salary[$i].",'".$RankName[$i]."')";				
	//echo "<br>".$XamAlert_Posts_Query;
	//mysql_query($XamAlert_Posts_Query);
	$db->query($XamAlert_Posts_Query);
	$XamAlertPostsId = mysqli_insert_id();
	
	//echo "<br>post id : ".$XamAlertPostsId;
	
	for($j = 0; $j < $XamDateTotal[$i];$j++)
	{
		$XamAlert_Dates_Query = "insert into XamAlert_Dates_Test (PostId,Date) values (".$XamAlertPostsId.",'".$XamDates2DArray[$i][$j]."')";
		//echo "<br>".$XamAlert_Dates_Query;
		//mysql_query($XamAlert_Dates_Query);
		$db->query($XamAlert_Dates_Query);
		$id = mysqli_insert_id();
		
		//echo "<br>date id :".$id;
	}
	
}
header("location: index.php");
?>