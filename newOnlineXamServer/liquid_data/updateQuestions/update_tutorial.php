<?php
session_start();
if(!isset($_SESSION['newonlineserver_login_id']))
    header("location:index.php");
?>
<?php
include("../database_connection.php");
//$db = "xamDB";
//mysql_connect("localhost","root","");
//mysql_select_db($db)or die("unable to select database");


?>

<html>
    <head>
        <meta charset="utf-8" />
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
           <link href="../ime_work/css/jquery.ime.css" rel="stylesheet"  />
           
       
        <style>
        	label.error
			{
				display:none;
				color:#F00;
				border:2px solid #F00;
			}
		</style>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script src="jquery.validate.js" ></script>
        <script src="../ime_work/libs/rangy/rangy-core.js" ></script>
        <script src="../ime_work/src/jquery.ime.js"></script>
        <script src="../ime_work/src/jquery.ime.selector.js"></script>
        <script src="../ime_work/src/jquery.ime.preferences.js"></script>
        <script src="../ime_work/src/jquery.ime.inputmethods.js"></script>
        <script src="../ime_work/js/script1.js"></script>

       
 <script>
          var selectedlanguage;
            
            var NoOfOptions = 0;
        	var QuestionImage = 0;
       
			$(document).ready(function(e) {
				
				$('#updateForm').validate();
				
				$('#TotalOptions').val(NoOfOptions);
				if(NoOfOptions == 4)
				{
					$('#button_delete').prop('disabled',true);
				}
                $('#button_add').click(function(e) {
						
					if(NoOfOptions == 4)
					{
						$('#button_delete').prop('disabled',false);
					}
					var updateVar = NoOfOptions;
					NoOfOptions++;
					var row ="<div class='row' id='opt"+NoOfOptions+"div' style='margin-top:20px;'>"+
                            "<div>"+
                                "<div class='col-md-1'>"+                    
				                    "Option "+NoOfOptions+" :"+
                                "</div>"+
                                "<div class='col-md-4'>"+
                                    "<textarea rows='5' class='form-control lang_class' name='opt"+NoOfOptions+"'></textarea>"+
                                     "<div class='row'>"+
                                            "<div class='col-md-5'>"+
                                            "</div>"+
                                            "<div class='col-md-7 text-right'>"+
                                                 "<input type='file' class='form-control' name='opt"+NoOfOptions+"image'/>"+
                                             "</div>"+
                                     "</div>"+
                                "</div>"+
                                "<div class='col-md-1>"+
							        "<input type='radio' class='form-control' name='correctOption'   value='"+NoOfOptions+"'  required/>"+
                                "</div>"+
                            
							"</div>"+       
							"</div>";
                            
					$("#opt"+updateVar+"div").after(row);
					
					$('#TotalOptions').val(NoOfOptions);
					if(NoOfOptions == 8)
					{
						$('#button_add').prop('disabled',true);
					}
                });
				$('#button_delete').click(function(e) {
                    $('#button_add').prop('disabled',false);
					$("#opt"+NoOfOptions+"div").remove();
					NoOfOptions--;
					if(NoOfOptions == 4)
						$('#button_delete').prop('disabled',true);
					
					$('#TotalOptions').val(NoOfOptions);
                });
				$('#clear_all_data').click(function(e) {
                    $('input:text').val("");
					$('textarea').val("");
					if(QuestionImage == 1)
					{
						$('#questionImage').remove();
						var imgAddRow = "<div id='questionImage'><input type='file' name='questionImage'  accept='image/*' /></div>";
						$('#questionText').after(imgAddRow);
					}
					$('#optionsContainer').remove();
					var optionsCont = "<div id='optionsContainer'>";
					for(i=1;i<=NoOfOptions;i++)
					{
						optionsCont += "<div id='opt"+i+"div'>";
						optionsCont += "<br>Option "+i+" : <input type='text' name='opt"+i+"'/>";
						optionsCont += "<input type='radio' name='correctOption'  value='"+i+"'  required/>";
						optionsCont += "<br><input type='file' name='opt"+i+"image'  accept='image/*'/>";
						optionsCont += "</div><br>";
					}
						optionsCont += "</div>";
					$('#hrAboveOptions').after(optionsCont);
                });
			$.extend($.validator.messages,{required:"Please Select your Answer First!"});
            });
        </script>
      
        
    </head>
    <body>
   
    <form role="form" action="../session_destroy.php">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <a href="../entertutorial.php"><input type="button" class="btn btn-info btn-lg" value="Home" style="margin-top:10px; margin-bottom:10px;"></a>
            </div>
            <div class="col-md-8">
            </div>
            <div class="col-md-2">
                <input type="submit" class="btn btn-danger btn-lg" value="logout" style="margin-left:110px; margin-top:10px;">
            </div>
      
        </div>
        
    </div>
    </form>
    <?php
if( isset( $_GET['updateStatus'] ) )
{
    echo "<script>alert( '".$_GET['updateStatus']."' );</script>";
}

if(isset( $_GET['QuesId'] ))
{
   
    echo "<form action='update_tutorial_submit.php' method='post'  enctype='multipart/form-data' id='updateForm'>";

    $getQuestionQuery = "select * from Turorials where id = ".$_GET['QuesId'];
    $getQuestionResult = mysqli_query($db,$getQuestionQuery);
   while($getQuestionRow = mysqli_fetch_array( $getQuestionResult ) )
    {
        $timedate = $getQuestionRow['datetime'];
        echo "<input type='hidden' value='".$timedate."' name='datetime'>";
        $cat_q = "select * from questioncategory where QuesCatId=".$getQuestionRow['CatId'];
        $cat_re = mysqli_query($db,$cat_q);
        while($cat_r = mysqli_fetch_array($cat_re))
        {
            $cat =  $cat_r['QuesCatId'];   
        }
        
       echo "<div class='container-fluid'>";
        echo "<div class='row'>";
         echo "<div class='col-md-2'>";
        $cat_query = "select * from questioncategory";
        $cat_result = mysqli_query($db,$cat_query);
        
        echo "<select name='update_category' id='update_category' class='form-control'>";
            while($cat_row = mysqli_fetch_array($cat_result))
            {
             
                if($cat == $cat_row['QuesCatId'])
                {
                    echo "<option selected value=".$cat_row['QuesCatId'].">".$cat_row['QuesCat']."</option>";
                }
                else
                {
                    echo "<option value=".$cat_row['QuesCatId'].">".$cat_row['QuesCat']."</option>";
                }
                
            }
        echo "</select>";
        echo "</div>";
        echo "<div class='col-md-2'>";
            echo "<select id='language' name='language' class='form-control' required>";
            echo "</select>";
        echo "</div>";
        echo "<div class='col-md-2'>";
            echo "<select class='form-control' name='inputmethod' id='imeSelector'>";
            echo "</select>";
        echo "</div>";
        echo "<div class='col-md-2'>";
       
         echo "<input type='text' class='form-control lang_class' name='bankname' value=".$getQuestionRow['reference'].">";
        echo"</div>";
       
        echo "<div class='col-md-2'>";
        echo"</div>";
        echo "</div>";
         
            echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                    echo "<div >";
                        echo "Tutorial : <textarea rows='10' style='resize:none;' class='form-control lang_class' id='questionText' name='questionText'>".$getQuestionRow['text']."</textarea>";
    	               echo "<input type='hidden' name='QuesId' value='".$_GET['QuesId']."'  />";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
       
       
    echo "<br><br><div class='row'>";
        echo "<div class='col-md-5'>";
        echo "</div>";
        echo "<div class='col-md-2'>";
            echo "<input type='submit' value='Update Question' class='btn btn-lg btn-success btn-block' />";
        echo "</div>";
        echo "<div class='col-md-5'>";
        echo "</div>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
}
}
?>


       
    </body>
 
</html>