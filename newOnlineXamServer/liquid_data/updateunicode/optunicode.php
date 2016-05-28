<?php
include('../database_connection.php');
echo "<html><head><meta charset='utf-8'></head></html>";
echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'अाॅ','ऑ') where OptionText like '%अाॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'अॅ','ॲ') where OptionText like '%अॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'ाॅ','ॉ') where OptionText like '%ाॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'एे','ऐ') where OptionText like '%एे%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'अाै','औ') where OptionText like '%अाै%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'अाे','ओ') where OptionText like '%अाे%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'अा','आ') where OptionText like '%अा%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'ाै','ौ') where OptionText like '%ाै%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'ाे','ो') where OptionText like '%ाे%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'एॅ','ऍ') where OptionText like '%एॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE options SET OptionText = REPLACE(OptionText,'ॅं','ँ') where OptionText like '%ॅं%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";


?>