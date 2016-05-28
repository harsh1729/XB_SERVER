<?php
include("../database_connection.php");
session_start();

$LangCode = $_REQUEST['Language_select_option'];
$GkContent = addslashes($_REQUEST['GkContent']);
$dateRecieved = $_REQUEST['datePicker'];
$AppId = $_SESSION['Application_Id'];


$gkimage = $_REQUEST['gkimage'];
$insertQueryGk = "insert into GkUpdates (GkContent,langCode,date,image) values ('".$GkContent."','".$LangCode."','".$dateRecieved."','".$gkimage."')";
//$insertQueryGk = "insert into GkUpdates (GkContent,langCode,date) values ('".$GkContent."','".$LangCode."','".$dateRecieved."')";
//mysql_query($insertQueryGk);
$db->query($insertQueryGk);
$GkIdGenerated = mysqli_insert_id($db);

if($GkIdGenerated > 0)
{
    $insertMapping = "insert into GkAppMapping (GkId,AppId) values (".$GkIdGenerated.",".$AppId.")";
    //mysql_query($insertMapping);
    $db->query($insertMapping);
    
    echo "Content Saved succesfully !\n";
    echo "langCode: ".$LangCode;
    echo "\nContent: ".$GkContent;
}
else
{    
    echo "Content Not Saved !";
    //echo "langCode: ".$LangCode;
   // echo "\nContent: ".$GkContent;
}




?>