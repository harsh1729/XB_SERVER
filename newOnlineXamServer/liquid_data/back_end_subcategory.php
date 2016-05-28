<?php
include("database_connection.php");
session_start();
$subcategory = $_REQUEST['QuesCatId'];
$query = mysqli_query($db,"select * from subcategory_table where QuesCatId=".$subcategory." and AppId=".$_SESSION['Application_Id']);
$subcat = array();
while($row=mysqli_fetch_array($query))
{
    $subcat1['id'] = $row['sub_cat_id'];
	$subcat1['name']=$row['sub_cat_name'];
	array_push($subcat,$subcat1);
}
echo json_encode($subcat);



?>