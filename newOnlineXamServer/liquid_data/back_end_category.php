<?php
include("database_connection.php");
session_start();
$query = mysqli_query($db,"select * from questioncategory where QuesCatId in(select CatId from catappmapping where AppId=".$_SESSION['Application_Id'].")");
$cat = array();
while($row=mysqli_fetch_array($query))
{
    $cat1['id'] = $row['QuesCatId'];
	$cat1['name']=$row['QuesCat'];
	array_push($cat,$cat1);
}
echo json_encode($cat);



?>