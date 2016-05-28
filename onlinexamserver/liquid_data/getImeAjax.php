<?php
include("database_connection.php");
$lan = $_REQUEST['language'];

$query  = "SELECT * FROM language a,language_table b where a.Lang=b.lang_name and code='".$lan."'";

//$res = mysql_query($query);
$res = $db->query($query);
while($row = mysqli_fetch_array($res))
{
	echo $row['input_method'];
}
?>