<?php
//Table GkUpdates
//            id,text,langCode
//Table GkAppMapping
//          id,GkId,AppId

//      http://xercesblue.in/onlinexamserver/liquid_data/CurrentGKCenter/getLatestGkUpdates.php?pageno=1&langCode=hi&AppId=1

//      Link with complete date based
//      http://xercesblue.in/onlinexamserver/liquid_data/CurrentGKCenter/getLatestGkUpdates.php?pageno=1&langCode=hi&AppId=1

include("../database_connection.php");

//$pageNum =  $_REQUEST['pageno'];
$LangCode = $_REQUEST['langCode'];
$AppId = $_REQUEST['AppId'];
$date = $_REQUEST['date'];

/*$totalLimit = 6;
$pageNumLimit = ( $pageNum - 1 ) * $totalLimit;*/

/*$selectQuery = "select * from GkUpdates where id in ( select GkId from GkAppMapping where AppId = ".$AppId." ) and langCode = '".$LangCode."' order by id desc limit ".$pageNumLimit.",".$totalLimit;*/                           
//echo "query:     " . $selectQuery;
if( isset($_REQUEST['date']) && $date!=''){
$selectQuery = "select * from GkUpdates where id in ( select GkId from GkAppMapping where AppId = ".$AppId." ) and langCode = '".$LangCode."' AND date = '".$date."' order by date desc";
}else{
	$selectQuerydate = "select * from GkUpdates where id in ( select GkId from GkAppMapping where AppId = ".$AppId." ) and langCode = '".$LangCode."' order by date desc limit 1";
    $dateTime = $db->query( $selectQuerydate );
     while( $QuestionSelectRow = mysqli_fetch_array( $dateTime ) )
    {
         $date = $QuestionSelectRow['date'];

    }
    $selectQuery = "select * from GkUpdates where id in ( select GkId from GkAppMapping where AppId = ".$AppId." ) and langCode = '".$LangCode."' AND date = '".$date."' order by date desc";
}


//echo $selectQuery;
$jsonArrayMain = array();
//$queryResult = mysql_query($selectQuery);
$queryResult = $db->query($selectQuery);
$rowCount = mysqli_num_rows($queryResult) ;
if($rowCount <= 0)
{
    $jsonArray['errorNoMorePages'] = "Please go back to previous page! No more content.";
}
else if($rowCount > 0)
{
    $rowCount = 1;
    while($row = mysqli_fetch_array( $queryResult ) ) 
    {
    	$jsonArray = array();
        //array_push($jsonArray,$row['GkContent']);
        $jsonArray['id'] = $row['id'];
        $jsonArray['content'] = $row['GkContent'];
        $jsonArray['date'] = $row['date'];
        if($row['image']!='')
        $jsonArray['image'] = "http://www.xercesblue.in/onlinexamserver/liquid_data/uploadedImages/".$row['image'];
        else
         $jsonArray['image'] = "";
         	
        array_push($jsonArrayMain, $jsonArray);
        $rowCount++;
    }
}
$slide = array();
$slide['slide'] = $jsonArrayMain;
echo json_encode($slide);

?>