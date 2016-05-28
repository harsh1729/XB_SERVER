<?php
include("database_connection.php");

$query = mysqli_query($db,"select * from qrecord where QuesId in (select QuesId from qusappmapping where AppId=1)");

while($row=mysqli_fetch_array($query))
{
    echo $row['QuesId']."<br>";
    echo $row['Question']."<br>";
    echo $row['Solution']."<br>";
    echo $row['bankname']."<br>";
    
}
?>