<?php

include("../database_connection.php");

?>
<html>
    <head>
        <meta charset="utf-8" />
        <style>
            table,td,th
            {
                border-collapse:collapse;
                border:1px solid;
            }
            .newBug
            {
                background-color:#00ff00;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>
                    id
                </th>
                <th>
                    Question
                </th>
                <th>
                    bug_detail
                </th>
            </tr>
            <?php
                $selectQuery = "select * from QusBugReport";
                //$selectResult = mysql_query($selectQuery);
                $selectResult = $db->query($selectQuery);
                while($selectRow = mysqli_fetch_array( $selectResult ) )
                {
                    if($selectRow['done'] == 0)
                        echo "<tr class='newBug'>";
                    else
                        echo "<tr>";
                            echo "<td>";
                                echo "<a href='../updateQuestions/updateEntry.php?QuesId=".$selectRow['QuesId']."&fromPage=bugReport' >".$selectRow['QuesId']."</a>";
                            echo "</td>";
                            echo "<td>";
                                $getQusQuery = "select * from qrecord where QuesId = ".$selectRow['QuesId'];
                                //$getQusResult = mysql_query( $getQusQuery );
                                $getQusResult = $db->query( $getQusQuery );
                                while( $getQusRow = mysqli_fetch_array($getQusResult) )
                                {
                                    echo $getQusRow['Question'];
                                }
                            echo "</td>";
                            echo "<td>";
                              echo $selectRow['bug_detail'];
                            echo "</td>";
                        echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>