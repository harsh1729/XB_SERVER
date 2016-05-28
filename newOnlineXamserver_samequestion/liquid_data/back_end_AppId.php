<?php
include("database_connection.php");

$query = mysqli_query($db,"select * from app_table");
$cat = array();
while($row=mysqli_fetch_array($query))
{
    $App1['id'] = $row['id'];
	$App1['name']=$row['Name'];
	array_push($cat,$App1);
}
echo json_encode($cat);



?>