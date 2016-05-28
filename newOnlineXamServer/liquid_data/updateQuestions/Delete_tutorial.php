<?php
    
include("../database_connection.php");

$tutorial_id = $_REQUEST['tutorial_id'];
$page = $_REQUEST['page'];

$query = "delete from Turorials where id =".$tutorial_id;
 mysqli_query($db,$query);
header("location:../show_newonlineserver_tutorial.php?page=".$page); 

?>