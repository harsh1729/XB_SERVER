<?php
//Table GkUpdates
//            id,text,langCode
//Table GkAppMapping
//          id,GkId,AppId

//      http://xercesblue.in/onlinexamserver/liquid_data/CurrentGKCenter/getLatestGkUpdates.php?pageno=1&langCode=hi&AppId=1

//      Link with complete date based
//      http://xercesblue.in/onlinexamserver/liquid_data/CurrentGKCenter/getLatestGkUpdates.php?pageno=1&langCode=hi&AppId=1

include("../database_connection.php");

$pageNum =  $_REQUEST['pageno'];
$LangCode = $_REQUEST['langCode'];
$AppId = $_REQUEST['AppId'];

$totalLimit = 6;
$pageNumLimit = ( $pageNum - 1 ) * $totalLimit;

$selectQuery = "select * from GkUpdates where id in ( select GkId from GkAppMapping where AppId = ".$AppId." ) and langCode = '".$LangCode."' order by id desc limit ".$pageNumLimit.",".$totalLimit;                           
//echo "query:     " . $selectQuery;

$jsonArray = array();
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
        //array_push($jsonArray,$row['GkContent']);
        $jsonArray[ $rowCount ] = $row['GkContent'];
        
        $rowCount++;
    }
}
echo json_encode($jsonArray);

?>