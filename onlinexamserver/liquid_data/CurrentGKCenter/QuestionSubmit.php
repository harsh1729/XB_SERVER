<?php

// question table : currentGKQrecord
// Options table : currentGKOptions

include("../database_connection.php");

$question = addslashes($_REQUEST['questionText']);
$correctOption = $_REQUEST['correctOption'];
$langId = $_REQUEST['Language_select_option'];
$date = $_REQUEST['date'];
$totalOptions = $_REQUEST['TotalOptions'];
$Solution = addslashes($_REQUEST['solutionText']);


$SuccessMessage = "";


$insertQuestionQuery = "insert into currentGKQrecord ( Question,correctOption,LangId,date,Solution ) values ( '".$question."',".$correctOption.",'".$langId."','".$date."','".$Solution."' )";
//echo $insertQuestionQuery;
//$insertQuestionResult = mysql_query( $insertQuestionQuery );
$insertQuestionResult = $db->query( $insertQuestionQuery );
$quesIdGen = mysqli_insert_id($db);

if( $quesIdGen > 0 )
{
    for( $i=1;$i<=$totalOptions;$i++ )
    {
        $insertOptionsQuery = "insert into currentGKOptions ( QuesId,OptionText,OptionNo ) values ( ".$quesIdGen.",'".addslashes( $_REQUEST["opt".$i] )."',".$i." )";
        //mysql_query( $insertOptionsQuery );
        $db->query( $insertOptionsQuery );
    }
    $SuccessMessage = "Successfully saved Question !!!";
}
else
{
    $SuccessMessage = "Content Not Saved !";
}


echo $SuccessMessage;
?>