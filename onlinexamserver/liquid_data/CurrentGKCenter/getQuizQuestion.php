<?php

//      Link with complete date based
//      http://xercesblue.in/onlinexamserver/liquid_data/CurrentGKCenter/getGKQuestions.php?QuestionNo=3&langCode=hi&date=11&month=08&year=2014

include("../database_connection.php");

//$pageNum =  $_REQUEST['QuestionNo'];
$LangCode = $_REQUEST['langCode'];
$date =  $_REQUEST['date'];
if(!isset( $_REQUEST['date']) && $date == ''){
    $selectQuerydate = "select date from currentGKQrecord where LangId = '".$LangCode."'  order by date desc limit 1";
    $dateTime = $db->query( $selectQuerydate );
     while( $QuestionSelectRow = mysqli_fetch_array( $dateTime ) )
    {
         $date = $QuestionSelectRow['date'];

    }
   // echo $selectQuerydate;
    $selectQuery = "select * from currentGKQrecord where LangId = '".$LangCode."' and date = '".$date."' order by date desc";
}else{
    $selectQuery = "select * from currentGKQrecord where LangId = '".$LangCode."' and date = '".$_REQUEST['date']."' order by date desc";
}

/*$totalLimit = 1;
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
}*/

$jsonArrayMain = array();
 
//$QuestionSelectResult = mysql_query( $selectQuery );
$QuestionSelectResult = $db->query( $selectQuery );
$rowCount = mysqli_num_rows($QuestionSelectResult) ;
/*if( $pageNum == 1 && $rowCount <=0 )
{
    $jsonArray['errorNoQuestions'] = "There are no question uploaded on server for this month, please try again later !!!";
}
else if( $rowCount <= 0 )
{
    $jsonArray['errorNoMoreQuestions'] = "No more questions are there for this month !!!";
}
else */
if( $rowCount > 0 )
    {
    foreach($QuestionSelectResult as $key => $QuestionSelectRow )
        {
         $jsonArray = array();   
         $jsonArray['date'] = $QuestionSelectRow['date'];
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
       array_push($jsonArrayMain, $jsonArray);
    }
}else{
     $jsonArray['errorNoMoreQuestions'] = "No more questions !!!";
}
$jsonObject = array();
/*$dateNext = strtotime("+1 day", strtotime($date));*/
$dateNext = date('Y-m-d', strtotime($date .' +1 day'));
/*$dateBack = strtotime("-1 day", strtotime($date));*/
$dateBack = date('Y-m-d', strtotime($date .' -1 day'));
echo $dateback;
$nextAvaiable = "select date from currentGKQrecord where LangId = '".$LangCode."' and date = '".$dateNext."' order by date desc limit 1";
$backAvaiable = "select date from currentGKQrecord where LangId = '".$LangCode."' and date = '".$dateBack."' order by date desc limit 1";
$QuestionSelectnextAvaiable = $db->query( $nextAvaiable );
$rowCountnextAvaiable = mysqli_num_rows($QuestionSelectnextAvaiable);
if($rowCountnextAvaiable>0){
    $jsonObject['next'] = 1;
}else{
     $jsonObject['next'] = 0;
}

$QuestionSelectbackAvaiable = $db->query( $backAvaiable );
$rowCountbackAvaiable = mysqli_num_rows($QuestionSelectbackAvaiable);
if($rowCountbackAvaiable>0){
    $jsonObject['back'] = 1;
}else{
     $jsonObject['back'] = 0;
}
$jsonObject['total'] = $rowCount;
$jsonObject['date'] = $date;
$jsonObject['Questions']=$jsonArrayMain;

echo json_encode($jsonObject);
?>