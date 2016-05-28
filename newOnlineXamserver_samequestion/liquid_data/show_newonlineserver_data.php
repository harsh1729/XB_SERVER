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
$page = $_REQUEST['page'];
if($page < 0)
{
    $page = 0;
}
 $from = $_REQUEST['from'];
 $to = $_REQUEST['to'];
 $choose_category = $_REQUEST['choose_category'];

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
            echo "<a href='show_newonlineserver_data.php?page=".($page-1)."&choose_category=".$choose_category."'><input type='button' class='btn btn-default btn-lg' value='<<pre' style='margin-left:10px;margin-top:10px;'></a>";        
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<a href='show_newonlineserver_data.php?page=".($page+1)."&choose_category=".$choose_category."'><input type='button' class='btn btn-default btn-lg' value='next>>' style='margin-left:10px;margin-top:10px;'></a>";
        echo "</div>";
        echo "<div class='col-md-2'>";
            echo "<select class='form-control' id='page_list' style='margin-left:10px;margin-top:10px;'>";
                    
            echo "</select>";
        echo "</div>";
        echo "<div class='col-md-2'>";
                echo "<select class='form-control' id='select_cat' style='margin-left:10px;margin-top:10px;'>";
                       $catarray = array("all","Reasoning","English","math","GK","computer");
                        for($x=0;$x<6;$x++)
                        {
                           if($x == $choose_category )
                           {
                                echo "<option value='".$x."' selected>".$catarray[$x]."</option>";
                           } 
                           else
                           {
                                 echo "<option value='".$x."'>".$catarray[$x]."</option>";
                           }
                        }
                        
                echo "</select>";
        echo "</div>";
        echo "<div class='col-md-1'>";
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
                  echo "Q.no";
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
			echo "Solution";
		echo "</th>";
        echo "<th>";
            echo "Pretext";
        echo "</th>";
        echo "<th>";
            echo "category";
        echo "</th>";
        
        echo "<th>";
            echo "userid";
        echo "</th>";
	echo "</tr>";
        $qus_qry ="";


		//if($_SESSION['newonlineserver_login_id'] == 3 || $_SESSION['newonlineserver_login_id'] == 4)
		if($_SESSION['Application_Id'] == 7)
        {
           
           // $qus_qry = "select * from qrecord where QuesId in ( select QuesId from qusappmapping where AppId = ".$_SESSION['Application_Id']." and QuesId >".($page*100).") ORDER BY QuesId asc limit ".($page*50).",50";
             if($choose_category != 0)
             {
                

               // $AppId=$_SESSION['Application_Id'];
               $AppId=1;
                $query_empty=1;
                $cat_all = array();
                $cat_id = array();
                array_push($cat_id,(int)$choose_category);
                if($choose_category == 3)
                {
                    array_push($cat_id,43);
                    array_push($cat_id,44);
                    array_push($cat_id,45);
                    array_push($cat_id,46);
                }
                function repeat()
                {
                    global $parentId,$AppId,$query_empty,$cat_all,$cat_id,$choose_category,$db;
                    $cat = array();
                    $query = mysqli_query($db,"select * from category_table where parentId=".$choose_category." and AppId=".$AppId);
                   $query_empty = mysqli_num_rows($query);
                   
                    while($row=mysqli_fetch_array($query))
                    {
                        $cat1['id'] = $row['id'];
                        $cat1['name']=$row['category'];
                        array_push($cat,$cat1);
                        array_push($cat_id,(int)$row['id']);
                    }
                    array_push($cat_all,$cat);
                    if(count($cat)>0)
                        $choose_category = $cat[0]['id'];

                }
                while( $query_empty !== 0 )
                {
                   
                    repeat();
                }
                $qus_qry = "select ques_info.quesid,ques_info.quescatid,ques_info.correctopt,ques_info.userid,qrecord.id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid  from ques_info INNER JOIN qrecord ON ques_info.quesid = qrecord.quesid where ques_info.quescatid in (".implode(',',$cat_id).") ORDER BY id desc limit ".($page*100).", 100";
             }
             else
             {
               $qus_qry = "select ques_info.quesid,ques_info.quescatid,ques_info.correctopt,ques_info.userid,qrecord.id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid  from ques_info INNER JOIN qrecord ON ques_info.quesid = qrecord.quesid ORDER BY id desc limit ".($page*100).", 100"; 
             }
        }
        else
        {
            //$qus_qry = "select * from qrecord where QuesId in ( select apt.QuesId from qusappmapping as apt where AppId = ".$_SESSION['Application_Id']." ) and userid=".$_SESSION['newonlineserver_login_id']." ORDER BY QuesId desc limit ".($page*50).", 50";
            $qus_qry ="select ques_info.quesid,ques_info.quescatid,ques_info.correctopt,ques_info.userid,qrecord.id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid  from ques_info INNER JOIN qrecord ON      ques_info.quesid = qrecord.quesid where userid=".$_SESSION['newonlineserver_login_id']." ORDER BY id desc limit ".($page*100).", 100";
          
        }
		$z=0;
		$qus_result = mysqli_query($db,$qus_qry);
       
		while($qus_row=mysqli_fetch_array($qus_result))
		{
			global $z;
    		$z=$z+1;
			echo "<tr>";
			echo "<td>";
			//	echo $qus_row['QuesId'];
            echo $z;
			echo "</td>";
            echo "<td>";
                echo "<a href='updateQuestions/updateEntry.php?QuesId=".$qus_row['id']."' >Update_".$qus_row['id']."</a>";
            echo "</td>";
            if($_SESSION['newonlineserver_login_id'] == 3 || $_SESSION['newonlineserver_login_id'] == 4)
    		{
				echo "<td>";
                echo "<a href='updateQuestions/DeleteEntry.php?QuesId=".$qus_row['quesid']."&pretextid=".$qus_row['pretextid']."' id='".$qus_row['id']."' class='delete_button'>Delete_".$qus_row['id']."</a>";
            echo "</td>";
			}
                  echo "<td>";
                      echo $qus_row['quesid'];
                  echo "</td>";
			echo "<td class='question'>";
				echo $qus_row['ques_text'];
				if($qus_row['ques_image'] !== "" && $qus_row['ques_image'] !== null)
					echo "<img src='uploads_image/".$qus_row['ques_image']."' >";
			echo "</td>";
            
             $cat_qry ="select * from category_table where id=".$qus_row['quescatid'];
            $cat_result = mysqli_query($db,$cat_qry);
            $category="";
            while($cat_row=mysqli_fetch_array($cat_result))
            {
                $category = $cat_row['category'];
            }

           
            $pretextquery = "select * from pretext_record where id=".$qus_row['pretextid'];
            $pretextresult = mysqli_query($db,$pretextquery);
            $pretext = "";
            $pretext_image ="";
             while($pretext_row=mysqli_fetch_array($pretextresult))
            {

                if($pretext_row['pretext'] !== "")
                {
                    $pretext = $pretext_row['pretext'];
                }
                if($pretext_row['image'] !== "")
                {
                    $pretext_image = $pretext_row['image'];
                }
            }

            $userquery = "select * from dataentryusers where id=".$qus_row['userid'];
            $userresult = mysqli_query($db,$userquery);
            $user="";
            while($user_row=mysqli_fetch_array($userresult))
            {
                $user = $user_row['name'];
            }
            
			$opt_qry = "select * from options where QuesId=".$qus_row['id'];
			$opt_result = mysqli_query($db,$opt_qry);
			$i=1;
			while($opt_row=mysqli_fetch_array($opt_result))
			{
				if($opt_row['OptionNo'] == $qus_row['correctopt'])
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
				echo nl2br($qus_row['sol_text']);
                if($qus_row['sol_image'] !== "" && $qus_row['sol_image'] !== null)
                {
                    echo "<img src='uploads_image/".$qus_row['sol_image']."' >";
                }
			echo "</td>";
            echo "<td>";
                echo $pretext."<br>";
                if($pretext_image != "")
                {
                 echo "<img src='uploads_image/".$pretext_image."' >";
                }
            echo "</td>";
            echo "<td>";
                echo $category;
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
        $('#select_cat').change(function(){

         var page =0;
            location.href="show_newonlineserver_data.php?page="+page+"&choose_category="+$("#select_cat option:selected").val();

        });
    });
</script>       
 
</body>
</html>