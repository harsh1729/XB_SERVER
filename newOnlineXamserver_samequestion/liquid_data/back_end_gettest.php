<?php
include("database_connection.php");
	$category = $_REQUEST['category'];
	 $array =array();
    $query = "select id from daily_test_table where category=".$category." order by id asc";
    $result = mysqli_query($db,$query);
    while($row = mysqli_fetch_array($result))
    {
     $id = $row['id'];    
        array_push($array,$id);
    }
    echo json_encode($array);

 ?>