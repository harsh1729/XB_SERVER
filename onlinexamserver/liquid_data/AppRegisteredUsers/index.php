<html>
    <head>
        <meta charset="utf-8" />
        <style>
            table,td,th,tr
            {
                border:2px solid;
                border-collapse:collapse;
            }
        </style>
    </head>
    <body>
<?php

include("../database_connection.php");

$selectQuery = "select * from AppRegisteredUsers order by id desc";
//$selectResult = mysql_query( $selectQuery );
$selectResult = $db->query( $selectQuery );

echo "<table>";
echo "<tr><th>Id</th><th>name</th><th>Mobile</th><th>email</th><th>city</th></tr>";
$count = 0;
while( $selectRow = mysqli_fetch_array( $selectResult ) )
{
    echo "<tr>";
    echo "<td>".$selectRow['id']."</td>";
    echo "<td>".$selectRow['name']."</td>";
    echo "<td>".$selectRow['mobile']."</td>";
    echo "<td>".$selectRow['email']."</td>";
    echo "<td>".$selectRow['city']."</td>";
    echo "</tr>";
    $count++;
}

echo "</table>";

echo "<p style='color:red;background-color:#003300;text-align:center;font-weight:bolder;'>Total : ".$count."</p>";

?>