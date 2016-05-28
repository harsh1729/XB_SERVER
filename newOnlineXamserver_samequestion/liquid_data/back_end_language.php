<?php
include("database_connection.php");

$query = mysqli_query($db,"select * from language");
$lang = array();
while($row=mysqli_fetch_array($query))
{
	$lang1['name'] = $row['Lang'];
	$lang1['code'] = $row['Code'];
	
	array_push($lang,$lang1);
}
echo json_encode($lang);



?>