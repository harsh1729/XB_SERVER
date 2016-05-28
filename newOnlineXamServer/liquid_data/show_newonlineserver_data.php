<?php
session_start();
if(!isset($_SESSION['newonlineserver_login_id']))
    header("location:index.php");
?>
<?php
include("database_connection.php");
   
?>
<html>
<head>
<meta charset="utf-8" />
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
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
    <script>
    var page ;
    </script>
</head>
<body>
 <?php
 if(isset($_REQUEST['page']))
	$page = $_REQUEST['page'];
else
	$page = 0;
if(isset($_REQUEST['from']))
	$from = $_REQUEST['from'];
else
	$from = "";
if(isset($_REQUEST['to'])) 
	 $to = $_REQUEST['to'];
else
	$to = "";
    if($_SESSION['newonlineserver_login_id'] == 4)
    {
     echo "<div class='row'>";
         echo "<div class='col-md-2'>";
           echo "<a href='questionentry.php'><input type='button' class='btn btn-info btn-lg' value='Home' style='margin-left:10px;margin-top:10px;'></a>";
        echo "</div>";
        echo "<div class='col-md-2'>";
        echo "</div>";
        echo "<form role='form' action='show_newonlineserver_data.php'>";
        echo "<div class='col-md-1'>";
            echo "<input type='text' class='form-control' id='from' name='from' style='margin-top:10px;' placeholder='From'>";
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<input type='text' class='form-control' id='to' name='to' style='margin-top:10px;' placeholder='To'>";
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<input type='submit' class='btn btn-lg btn-success btn-block'>";
        echo "</div>";
        echo "</form>";
        echo "<div class='col-md-3'>";
        echo "</div>";
         echo "<form role='form' action='session_destroy.php'>";
        echo "<div class='col-md-2'>";
            echo "<input type='submit' class='btn btn-danger btn-lg' value='logout' style='margin-left:100px; margin-top:10px;'>";
        echo "</div>";
        echo "</form>";
    echo "</div>";
    }
    else
    {
         echo "<div class='row'>";
     echo "<div class='col-md-2'>";
           echo "<a href='questionentry.php'><input type='button' class='btn btn-info btn-lg' value='Home' style='margin-left:10px;margin-top:10px;'></a>";
    echo "</div>";
        echo "<div class='col-md-1'>";
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<a href='show_newonlineserver_data.php?page=".($page-1)."'><input type='button' class='btn btn-default btn-lg' value='<<pre' style='margin-left:10px;margin-top:10px;'></a>";        
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<a href='show_newonlineserver_data.php?page=".($page+1)."'><input type='button' class='btn btn-default btn-lg' value='next>>' style='margin-left:10px;margin-top:10px;'></a>";
        echo "</div>";
        echo "<div class='col-md-2'>";
            echo "<select class='form-control' id='page_list' style='margin-left:10px;margin-top:10px;'>";
                    
            echo "</select>";
        echo "</div>";
        echo "<div class='col-md-3'>";
        echo "</div>";
         echo "<form role='form' action='session_destroy.php'>";
        echo "<div class='col-md-2'>";
            echo "<input type='submit' class='btn btn-danger btn-lg' value='logout' style='margin-left:100px; margin-top:10px;'>";
        echo "</div>";
        echo "</form>";
    echo "</div>";
    }

  echo "<table>";
	echo "<tr>";
    
		$no_of_opts_query = "select count(*) from options GROUP BY QuesId ORDER BY count(*) desc";
/*	required query


		 select MAX(no)  from ( select count(*) as no from options GROUP BY QuesId ) as t  
		 
*/
		$no_of_opts = mysqli_query($db,$no_of_opts_query);
		$no_value = mysqli_fetch_row($no_of_opts);
	
		$max_no_of_opts = $no_value[0];
	
        
		echo "<th>";
			echo "Qus no.";
		echo "</th>";
    	echo "<th>";
			echo "Update";
		echo "</th>";
        if($_SESSION['newonlineserver_login_id'] == 3 || $_SESSION['newonlineserver_login_id'] == 4)
    	{
			echo "<th>";
				echo "Delete";
			echo "</th>";
		}
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
			echo "Solution";
		echo "</th>";
        echo "<th>";
            echo "category";
        echo "</th>";
        echo "<th>";
            echo "Bankname";
        echo "</th>";
        echo "<th>";
            echo "Year";
        echo "</th>";
        echo "<th>";
            echo "userid";
        echo "</th>";
	echo "</tr>";
        $qus_qry ="";
		if($_SESSION['newonlineserver_login_id'] == 3)
        {
            $qus_qry = "select * from qrecord where QuesId in ( select QuesId from qusappmapping where AppId = ".$_SESSION['Application_Id']." and QuesId >".($page*100).") ORDER BY QuesId asc limit ".($page*50).",50";
        }
        else if($_SESSION['newonlineserver_login_id'] == 4)
        {
            if($from == "" || $to == "")
            {
                 $qus_qry = "select * from qrecord where QuesId in ( select apt.QuesId from qusappmapping as apt) ORDER BY QuesId desc limit 10";
            }
            else
            {
                 $qus_qry = "select * from qrecord where QuesId in ( select apt.QuesId from qusappmapping as apt where QuesId > ".($from-1)." and  QuesId < ".($to+1).") ORDER BY QuesId asc limit 100";
            }
        }
        else
        {
            $qus_qry = "select * from qrecord where QuesId in ( select apt.QuesId from qusappmapping as apt where AppId = ".$_SESSION['Application_Id']." ) and userid=".$_SESSION['newonlineserver_login_id']." ORDER BY QuesId desc limit ".($page*50).", 50";
          
        }
		//print_r($qus_qry);
		$qus_result = mysqli_query($db,$qus_qry);
       
		while($qus_row=mysqli_fetch_array($qus_result))
		{
			
			echo "<tr>";
			echo "<td>";
				echo $qus_row['QuesId'];
			echo "</td>";
            echo "<td>";
                echo "<a href='updateQuestions/updateEntry.php?QuesId=".$qus_row['QuesId']."' >Update_".$qus_row['QuesId']."</a>";
            echo "</td>";
            if($_SESSION['newonlineserver_login_id'] == 3 || $_SESSION['newonlineserver_login_id'] == 4)
    		{
				echo "<td>";
                echo "<a href='updateQuestions/DeleteEntry.php?QuesId=".$qus_row['QuesId']."&from=".$from."&to=".$to."' id='".$qus_row['QuesId']."' class='delete_button'>Delete_".$qus_row['QuesId']."</a>";
            echo "</td>";
			}
			echo "<td class='question'>";
				echo $qus_row['Question'];
				if($qus_row['image'] !== "")
					echo "<img src='uploads_image/".$qus_row['image']."' >";
			echo "</td>";
            
             $cat_qry ="select * from questioncategory where QuesCatId=".$qus_row['QuesCatId'];
            $cat_result = mysqli_query($db,$cat_qry);
            $category="";
            while($cat_row=mysqli_fetch_array($cat_result))
            {
                $category = $cat_row['QuesCat'];
            }
            
            $userquery = "select * from dataentryusers where id=".$qus_row['userid'];
            $userresult = mysqli_query($db,$userquery);
            $user="";
            while($user_row=mysqli_fetch_array($userresult))
            {
                $user = $user_row['name'];
            }
            
			$opt_qry = "select * from options where QuesId=".$qus_row['QuesId'];
			$opt_result = mysqli_query($db,$opt_qry);
			$i=1;
			while($opt_row=mysqli_fetch_array($opt_result))
			{
				if($opt_row['OptionNo'] == $qus_row['CorrectOption'])
				{
					echo "<td class='optionsAnswer'>";
						echo $opt_row['OptionText'];
						if($opt_row['image'] !== "")
						{
							echo "<img src='uploads_image/".$opt_row['image']."' >";
						}
					echo "</td>";
				}
				else
				{
					echo "<td class='options'>";
						echo $opt_row['OptionText'];
						if($opt_row['image'] !== "")
						{
							echo "<img src='uploads_image/".$opt_row['image']."' >";
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
                if($qus_row['solutionImage'] !== "")
                {
                    echo "<img src='uploads_image/".$qus_row['solutionImage']."' >";
                }
			echo "</td>";
            echo "<td>";
                echo $category;
            echo "</td>";
             echo "<td>";
                   echo $qus_row['bankName'];
            echo "</td>";
             echo "<td>";
                   echo $qus_row['Year'];
            echo "</td>";
             echo "<td>";
                   echo $user;
            echo "</td>";
        echo "</tr>";    
		}
        
        echo "</table>";
	?>

  
<script src="js/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
   
    $(document).ready(function(e) {
        $(document).on('click','.delete_button',function(){
			var id = $(this).prop('id');
			restart = false;
   			 var txt;
			
    		var r = confirm("Are you sure to delete question "+id);
    		if (r == true)
			{
					return true;			
			} 
			else 
			{
        		return false;
    		}
    

		});
    });
</script>       
 
</body>
</html>