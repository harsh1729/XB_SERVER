<?php
include("database_connection.php");

$newLanguage = $_REQUEST['language'];
$imeSelector = $_REQUEST['imeSelector'];

//echo $newLanguage;
//echo "<br>".$imeSelector;

$langCodeQuery = "select * from language_table where code = '".$newLanguage."'";
//$codeResult = mysql_query($langCodeQuery);
$codeResult = $db->query($langCodeQuery);
while($codeRow = mysqli_fetch_array($codeResult))
{
		$langName = $codeRow['lang_name'];
		$insertQuery = "insert into language (Lang,input_method) values('$langName','$imeSelector')";
		//mysql_query($insertQuery);
		$db->query($insertQuery);
}

header("location: question_entry.php");
?>