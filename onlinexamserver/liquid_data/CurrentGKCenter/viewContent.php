<html>
    <head>
        <meta charset="utf-8" />
        <style>
            table,tr,td,th
            {
                border:2px solid;
                border-collapse:collapse;
            }
        </style>
    </head>
<body>
<table>
<tr>
<th>id</th>
<th>content</th>
<th>date</th>
</tr>

<?php

include("../database_connection.php");

$LangId = $_REQUEST['langId'];

$selectQuery = "select * from GkUpdates where langCode = '".$LangId."' order by date asc";
//echo $selectQuery;
//$selectResult = mysql_query($selectQuery);
$selectResult = $db->query($selectQuery);
while( $selectRow = mysqli_fetch_array( $selectResult ) )
{
    echo "<tr>";
    echo "<td>".$selectRow['id']."</td>";
    echo "<td>".$selectRow['GkContent']."</td>";
    echo "<td>".$selectRow['date']."</td>";
    echo "</tr>";
}


?>
</body>
</html>