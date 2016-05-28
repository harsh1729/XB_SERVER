<?php
include("database_connection.php");
session_start();
    $array =array();
    $query = "select id from set_info order by id desc";
    $result = mysqli_query($db,$query);
    while($row = mysqli_fetch_array($result))
    {
     $id = $row['id'];    
        array_push($array,$id);
    }
    echo json_encode($array);
?>