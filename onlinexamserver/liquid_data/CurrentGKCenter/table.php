<?php

include("../database_connection.php");
?>
<html>
    <head>
        <meta charset="utf-8" />
        <style>
            table,td,tr,th
            {
                border:2px solid;
                border-collapse:collapse;
            }
        </style>
    </head>
    <body>
    <table>
        <tr><th>Id</th><th>question</th>
        <?php
            $no_of_opts_query = "select count(*) from currentGKOptions GROUP BY QuesId ORDER BY count(*) desc";
            //$no_of_opts = mysql_query($no_of_opts_query);
            $no_of_opts = $db->query($no_of_opts_query);
    	    $no_value = mysqli_fetch_row($no_of_opts);
	
		    $max_no_of_opts = $no_value[0];
            for($i=1;$i<=$max_no_of_opts;$i++)
        	{		
    			echo "<th>";
    				echo "Option ".$i;
    			echo "</th>";
    		}
        ?>
        <th>date</th></tr>
<?php


$selectQuery = "select * from currentGKQrecord order by QuesId asc";
//$selectResult = mysql_query( $selectQuery );
$selectResult = $db->query( $selectQuery );
while( $selectRow = mysqli_fetch_array( $selectResult ) )
{
    echo "<tr>";
    echo "<td>".$selectRow['QuesId']."</td>";
    echo "<td>".$selectRow['Question']."</td>";
    
        $optionSelectQuery = "select * from currentGKOptions where QuesId = ".$selectRow['QuesId'];
        //$optionSelectResult = mysql_query( $optionSelectQuery );
        $optionSelectResult = $db->query( $optionSelectQuery );
        $i=0;
        while( $optionSelectRow = mysqli_fetch_array( $optionSelectResult ) )
        {
            if( $optionSelectRow['OptionNo'] == $selectRow['correctOption'] )
                echo "<td style='background-color:#00ff00'>".$optionSelectRow['OptionText']."</td>";
            else
                echo "<td>".$optionSelectRow['OptionText']."</td>";
            $i++;
        }
    
        for(;$i<$max_no_of_opts;$i++)
        {
            echo "<td>...</td>";
        }
    echo "<td>".$selectRow['date']."</td>";
    echo "</tr>";
}

?>
    </table>
    </body>
</html>