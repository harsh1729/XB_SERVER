<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="utf-8" />
    	<style>
			table
			{
				border-collapse:collapse;
				border:2px solid;
			}
			td,th
			{
				border:2px solid;
			}
			.msgSeen
			{
			}
			.msgNotSeen
			{
				border:2px solid #3C0;
				background-color:#0C3;
			}
		</style>
    </head>
    <body>
    	<table>
        	<tr>
            	<th>
                	Sr. No.
                </th>
                <th>
                    Email
                </th>
                <th>
                	Message
                </th>
            </tr>
            	<?php
					include("../database_connection.php");
					$selectQuery = "select * from userReview";
					//$selectResult = mysql_query($selectQuery);
					$selectResult = $db->query($selectQuery);
					$i = 1;
					while($selectRow = mysqli_fetch_array($selectResult) )
					{
						if($selectRow['seen'] == 0)
						{
							echo "<tr class='msgNotSeen'>";
							echo "<td>".$i."</td>";
                            echo "<td>".$selectRow['email']."</td>";
							echo "<td>".$selectRow['Message']."</td>";
							echo "</tr>";
							
						}
						else if($selectRow['seen'] == 1)
						{
							echo "<tr>";
							echo "<td>".$i."</td>";
                            echo "<td>".$selectRow['email']."</td>";
							echo "<td>".$selectRow['Message']."</td>";
							echo "</tr>";
						}
                        $i = $i +1;
					}
					$seenQuery = "update userReview set seen=1";
					//mysql_query($seenQuery);
					$db->query($seenQuery);
					
				?>
        </table>
    </body>
</html>