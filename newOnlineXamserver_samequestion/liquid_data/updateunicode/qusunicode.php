<?php
include('../database_connection.php');
echo "<html><head><meta charset='utf-8'></head></html>";
echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'अाॅ','ऑ') where Question like '%अाॅ%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'अॅ','ॲ') where Question like '%अॅ%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'ाॅ','ॉ') where Question like '%ाॅ%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'एे','ऐ') where Question like '%एे%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'अाै','औ') where Question like '%अाै%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'अाे','ओ') where Question like '%अाे%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'अा','आ') where Question like '%अा%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'ाै','ौ') where Question like '%ाै%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'ाे','ो') where Question like '%ाे%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'एॅ','ऍ') where Question like '%एॅ%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";

echo $selectQuery = "UPDATE qrecord SET Question = REPLACE(Question,'ॅं','ँ') where Question like '%ॅं%' ";
mysql_query($selectQuery);
echo "<br>Number of rows affected:".$numRows = mysql_affected_rows()."<br><br>";


?>