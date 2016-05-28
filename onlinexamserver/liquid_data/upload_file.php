<?php
//if ($_FILES["jaspal"]["error"] > 0) 
//{
//	echo "Error: " . $_FILES["jaspal"]["error"] . "<br>";
//} 
//else 
//{
	echo "Upload: " . $_FILES["jaspal"]["name"] . "<br>";
	echo "Type: " . $_FILES["jaspal"]["type"] . "<br>";
	echo "Size: " . ($_FILES["jaspal"]["size"] / 1024) . " kB<br>";
	echo "Stored in: " . $_FILES["jaspal"]["tmp_name"];
//}
?>