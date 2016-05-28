<?php

//      Link with complete date based
//      http://xercesblue.in/onlinexamserver/liquid_data/CurrentGKCenter/getGKQuestions.php?QuestionNo=3&langCode=hi&date=11&month=08&year=2014

include("../database_connection.php");

$pageNum =  $_REQUEST['QuestionNo'];
$LangCode = $_REQUEST['langCode'];

$totalLimit = 1;
$pageNumLimit = ( $pageNum - 1 ) * $totalLimit;

if( !isset( $_REQUEST['date'] ) and !isset( $_REQUEST['month'] ) and  !isset( $_REQUEST['year'] ) )
{
    $selectQuery = "select * from currentGKQrecord where LangId = '".$LangCode."'  order by QuesId desc limit ".$pageNumLimit.",".$totalLimit;                           
    //echo $selectQuery;
}
else if( $_REQUEST['date'] != "00" )
{
    $selectQuery = "select * from currentGKQrecord where LangId = '".$LangCode."' and date = '".$_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['date']."' order by QuesId desc limit ".$pageNumLimit.",".$totalLimit;                           
    //echo $selectQuery;
}
else if( $_REQUEST['month'] != "00" )
{
    $selectQuery = "select * from currentGKQrecord where LangId = '".$LangCode."' and date like '".$_REQUEST['year']."-".$_REQUEST['month']."-%' order by QuesId desc limit ".$pageNumLimit.",".$totalLimit;                           
    //echo $selectQuery;
}
else if( $_REQUEST['year'] != "00" )
{
    $selectQuery = "select * from currentGKQrecord where LangId = '".$LangCode."' and date like '".$_REQUEST['year']."-%'  order by QuesId desc limit ".$pageNumLimit.",".$totalLimit;                            
    //echo $selectQuery;
}

$jsonArray = array();
//$QuestionSelectResult = mysql_query( $selectQuery );
$QuestionSelectResult = $db->query( $selectQuery );
$rowCount = mysqli_num_rows($QuestionSelectResult) ;
if( $pageNum == 1 && $rowCount <=0 )
{
    $jsonArray['errorNoQuestions'] = "There are no question uploaded on server for this month, please try again later !!!";
}
else if( $rowCount <= 0 )
{
    $jsonArray['errorNoMoreQuestions'] = "No more questions are there for this month !!!";
}
else if( $rowCount > 0 )
{
    while( $QuestionSelectRow = mysqli_fetch_array( $QuestionSelectResult ) )
    {
        $jsonArray['Question'] = $QuestionSelectRow['Question'];
        $jsonArray['correctOption'] = $QuestionSelectRow['correctOption'];
        if( $QuestionSelectRow['Solution'] != "" )
            $jsonArray['Solution'] = $QuestionSelectRow['Solution'];
        $optionsArray = array();
        
        $optionSelectQuery = "select * from currentGKOptions where QuesId = ".$QuestionSelectRow['QuesId'];
        //$optionSelectResult = mysql_query( $optionSelectQuery );
        $optionSelectResult = $db->query( $optionSelectQuery );
        while( $optionSelectRow = mysqli_fetch_array( $optionSelectResult ) )
        {
            //$optionsArray[$optionSelectRow['OptionNo']] = $optionSelectRow['OptionText'];
            array_push($optionsArray,$optionSelectRow['OptionText']);
        }
        $jsonArray['options'] = $optionsArray;
    
    }
}


echo json_encode($jsonArray);
?>