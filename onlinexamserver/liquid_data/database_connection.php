<?php

	$hostname = "localhost";
	$username = "xercewwv_dbuser";
	$password = "Xerces@1985";
	$database_name = "xercewwv_xamDB";
	
	//mysql_connect($hostname,$username,$password);
	//mysql_select_db($database_name)	or die("Database not Found!");
	
	//$db = mysqli_connect($hostname,$username,$password,$database_name) or die("Error " . mysqli_error($db)); 
	
	$db = mysqli_connect($hostname,$username,$password,$database_name);
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	

?>