<?php

include("../database_connection.php");

$currentAppId = $_REQUEST['AppId'];

 $total_users_Query = "select * from GcmRegisteredUser where AppId=".$currentAppId;
            //$result_users = mysql_query($total_users_Query);
            $result_users = $db->query($total_users_Query);
                echo mysqli_num_rows($result_users);

?>