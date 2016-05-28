<html>
<head>
<meta charset="utf-8" />
<script>

</script>
</head>
<body>
 
</body>
</html>
<?php
include("database_connection.php");
 $query = "select * from qrecord where QuesId=1";
 $result = mysqli_query($db,$query);
 
 while($row = mysqli_fetch_array($result))
 {
     $a = $row['Question'];
echo "<div>".$a[0]."</div>";     
    }

?>