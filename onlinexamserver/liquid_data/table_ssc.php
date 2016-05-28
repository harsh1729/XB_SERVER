<?php

include("database_connection.php");
session_start();
if(!isset($_SESSION['data_login_id']))
    header("location:../index.php");

?>
<html>
<head>
<meta charset="utf-8" />
	<style>
		table
		{
			border:solid 1px;
			border-collapse:collapse;
			width:100%;
		}
		th
		{
			border:solid 1px;
		}
		tr,td
		{
			border:solid 1px;
		}
		.options
		{
			background-color:#9CF;
		}
		.optionsAnswer
		{
			background-color:#9F6;
		}
		.answer
		{
			background-color:#CFC;
		}
		.question
		{
			background-color:#66C;
		}
		
	</style>
</head>
<body>
<?php
  echo "<table>";
	echo "<tr>";
    
		$no_of_opts_query = "select count(*) from options GROUP BY QuesId ORDER BY count(*) desc";
/*	required query


		 select MAX(no)  from ( select count(*) as no from options GROUP BY QuesId ) as t  
		 
*/
		//$no_of_opts = mysql_query($no_of_opts_query);
		$no_of_opts = $db->query($no_of_opts_query);
		$no_value = mysqli_fetch_row($no_of_opts);
	
		$max_no_of_opts = $no_value[0];
	
        
		echo "<th>";
			echo "Qus no.";
		echo "</th>";
		echo "<th>";
			echo "Question Text";
		echo "</th>";
		for($i=1;$i<=$max_no_of_opts;$i++)
		{		
			echo "<th>";
				echo "Option ".$i;
			echo "</th>";
		}
		echo "<th>";
			echo "Answer";
		echo "</th>";
	echo "</tr>";

		
		$qus_qry = "select * from qrecord where QuesId in ( select apt.id from qusappmapping as apt where AppId = 2 ) ORDER BY QuesId asc";
		//$qus_result = mysql_query($qus_qry);
		$qus_result = $db->query($qus_qry);
		while($qus_row=mysqli_fetch_array($qus_result))
		{
			
			echo "<tr>";
			echo "<td>";
				echo $qus_row['QuesId'];
			echo "</td>";
			echo "<td class='question'>";
				echo $qus_row['Question'];
				if($qus_row['image'] != "NULL")
					echo "<img src='".$qus_row['image']."' >";
			echo "</td>";
			$opt_qry = "select * from options where QuesId=".$qus_row['QuesId'];
			//$opt_result = mysql_query($opt_qry);
			$opt_result = $db->query($opt_qry);
			$i=1;
			while($opt_row=mysqli_fetch_array($opt_result))
			{
				if($opt_row['OptionNo'] == $qus_row['CorrectOption'])
				{
					echo "<td class='optionsAnswer'>";
						echo $opt_row['OptionText'];
						if($opt_row['image'] != "NULL")
						{
							echo "<img src='".$opt_row['image']."' >";
						}
					echo "</td>";
				}
				else
				{
					echo "<td class='options'>";
						echo $opt_row['OptionText'];
						if($opt_row['image'] != "NULL")
						{
							echo "<img src='".$opt_row['image']."' >";
						}
					echo "</td>";
				}
				$i++;
			}
			for(;$i<=$max_no_of_opts;$i++)
			{
				echo "<td class='options'>";
				echo "</td>";
			}
			
			echo "<td class='answer'>";
				echo $qus_row['Solution'];
                if($qus_row['solutionImage'] != "NULL")
                {
                    echo "<img src='".$qus_row['solutionImage']."' >";
                }
			echo "</td>";
		}
	?>

  </table>
       
 
</body>
</html>