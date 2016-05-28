<?php

	include("database_connection.php");
	$category_no = $_REQUEST['category_no1'];
	$category = $_REQUEST['category1'.$category_no];
	$date =  date('d-m-Y');

	$sql = "INSERT INTO daily_test_table(category,dates)VALUES(".$category.",'".$date."')";
            mysqli_query($db,$sql);

           echo "success"; 

?>