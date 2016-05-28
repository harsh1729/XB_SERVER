<?php
include('../database_connection.php');
echo "<html><head><meta charset='utf-8'></head></html>";
echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'अाॅ','ऑ') where Solution like '%अाॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'अॅ','ॲ') where Solution like '%अॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'ाॅ','ॉ') where Solution like '%ाॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'एे','ऐ') where Solution like '%एे%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'अाै','औ') where Solution like '%अाै%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'अाे','ओ') where Solution like '%अाे%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'अा','आ') where Solution like '%अा%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'ाै','ौ') where Solution like '%ाै%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'ाे','ो') where Solution like '%ाे%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'एॅ','ऍ') where Solution like '%एॅ%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Solution = REPLACE(Solution,'ॅं','ँ') where Solution like '%ॅं%' ";
mysqli_query($db,$selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";


?>