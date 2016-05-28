<?php


include("../database_connection.php");
//***********************************************//
$id_of_last_qus = $_GET['lastQuestionNumber'];
$id_of_app = $_GET['appId'];
$id_of_device= $_GET['deviceIMEI'];
//**********************************************//


$insertDownloadQuery = "insert into downloadcounter (AppId,DeviceId) values (".$id_of_app.",".$id_of_device.")";
//echo $insertDownloadQuery."<br>";
mysql_query($insertDownloadQuery);
//echo "Insert id is :".mysql_insert_id()."<br>";


//**********************************************//


$file_name = "QuestionDatabase.xml";
$mime = 'application/xml';
$file_size = filesize($file_name);////1024;


header('Pragma:public');
header('Expires:0');
header('Cache-Control: private',false);
header('Content-Length:'.sprintf('%u',filesize($file_name)));    // provide file size
header('Content-Type: '.$mime);
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
//header('Content-Transfer-Encoding: binary');
//header('Connection:close'); 
//header("Keep-Alive: timeout=10,max=1");
readfile($file_name);		// push it out
exit();

?>