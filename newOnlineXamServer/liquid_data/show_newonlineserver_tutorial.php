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
        td
        {
            padding:10px;
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
$page = $_REQUEST['page'];
         echo "<div class='row'>";
     echo "<div class='col-md-2'>";
           echo "<a href='questionentry.php'><input type='button' class='btn btn-info btn-lg' value='Home' style='margin-left:10px;margin-top:10px;'></a>";
    echo "</div>";
        echo "<div class='col-md-1'>";
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<a href='show_newonlineserver_tutorial.php?page=".($page-1)."'><input type='button' class='btn btn-default btn-lg' value='<<pre' style='margin-left:10px;margin-top:10px;'></a>";        
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<a href='show_newonlineserver_tutorial.php?page=".($page+1)."'><input type='button' class='btn btn-default btn-lg' value='next>>' style='margin-left:10px;margin-top:10px;'></a>";
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
    

  echo "<table>";
	echo "<tr>";
    	echo "<th>";
			echo "Tutorial no.";
		echo "</th>";
    	echo "<th>";
			echo "Update";
		echo "</th>";
        
			echo "<th>";
				echo "Delete";
			echo "</th>";
		
		echo "<th>";
			echo "Tutorial Text";
		echo "</th>";
		echo "<th>";
            echo "category";
        echo "</th>";
        echo "<th>";
            echo "sub_category";
        echo "</th>";
        echo "<th>";
            echo "reference";
        echo "</th>";
        echo "<th>";
            echo "userid";
        echo "</th>";
	echo "</tr>";
        $qus_qry ="";
        
		    $qus_qry = "select * from Turorials ORDER BY id asc limit ".($page*50).", 50";
        
        
		$qus_result = mysqli_query($db,$qus_qry);
       
		while($qus_row=mysqli_fetch_array($db,$qus_result))
		{
			
			echo "<tr>";
			echo "<td>";
				echo $qus_row['id'];
			echo "</td>";
            echo "<td>";
                echo "<a href='updateQuestions/update_tutorial.php?QuesId=".$qus_row['id']."' >Update_".$qus_row['id']."</a>";
            echo "</td>";
            
				echo "<td>";
                echo "<a href='updateQuestions/Delete_tutorial.php?tutorial_id=".$qus_row['id']."&page=".$page."' id='".$qus_row['id']."' class='delete_button'>Delete_".$qus_row['id']."</a>";
            echo "</td>";
			
			echo "<td class='question'>";
				echo $qus_row['text'];
			echo "</td>";
            
             $cat_qry ="select * from questioncategory where QuesCatId=".$qus_row['CatId'];
            $cat_result = mysqli_query($db,$cat_qry);
            $category="";
            while($cat_row=mysqli_fetch_array($cat_result))
            {
                $category = $cat_row['QuesCat'];
            }
            
            $subcat_qry ="select * from subcategory_table where sub_cat_id=".$qus_row['Sub_Cat_Id'];
             $subcat_result = mysqli_query($db,$subcat_qry);
            $subcategory="";
             while($subcat_row=mysqli_fetch_array($subcat_result))
            {
                $subcategory = $subcat_row['sub_cat_name'];
            }
            
            $userquery = "select * from dataentryusers where id=".$qus_row['userid'];
            $userresult = mysqli_query($db,$userquery);
            $user="";
            while($user_row=mysqli_fetch_array($userresult))
            {
                $user = $user_row['name'];
            }
            
		
			
	
            echo "<td>";
                echo $category;
            echo "</td>";
             echo "<td>";
                echo $subcategory;
            echo "</td>";
             echo "<td>";
                   echo $qus_row['reference'];
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