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
				if(NoOfOptions == 4 )
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
                                "<div class='col-md-1'>"+
							        "<input class='form-control'  type='radio'  name='correctOption'   value='"+NoOfOptions+"'  required/>"+
                                "</div>"+
                            
							      
							"</div>";

                     if(updateVar != 0)
                     {       
					   $("#opt"+updateVar+"div").after(row);
					 }
                     else
                     {
                        $("#questionImage").after(row);
                     }
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
                <a href="../questionentry.php"><input type="button" class="btn btn-info btn-lg" value="Home" style="margin-top:10px; margin-bottom:10px;"></a>
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
   
    echo "<form action='updateSubmit.php' method='post'  enctype='multipart/form-data' id='updateForm'>";

    //$getQuestionQuery = "select * from qrecord where id = ".$_REQUEST['QuesId'];
    $getQuestionQuery = "select ques_info.quesid,ques_info.quescatid,ques_info.correctopt,ques_info.userid,ques_info.datetime,ques_info.bankname,ques_info.year,qrecord.id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid from ques_info INNER JOIN qrecord ON ques_info.quesid = qrecord.quesid where id=".$_REQUEST['QuesId'];

    $getQuestionResult = mysqli_query($db,$getQuestionQuery);
   while($getQuestionRow = mysqli_fetch_array( $getQuestionResult ) )
    {
        
        $timedate = $getQuestionRow['datetime'];
        echo "<input type='hidden' value='".$timedate."' name='datetime'>";
      
        
       echo "<div class='container-fluid'>";
        echo "<div class='row'>";
         echo "<div class='col-md-2'>";
                $catquery = "select * from category_table";
                $catresult = mysqli_query($db,$catquery);
                echo "<select class='form-control' name='update_category'>";
                    while($catrow = mysqli_fetch_array( $catresult ))
                    {
                        if($catrow['id'] == $getQuestionRow['quescatid'])
                        {
                            echo "<option selected value='".$catrow['id']."'>".$catrow['category']."</option>";
                        }
                        else
                        {
                                echo "<option value='".$catrow['id']."'>".$catrow['category']."</option>";
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
       
         echo "<input type='text' class='form-control lang_class' name='bankname' value=".$getQuestionRow['bankname'].">";
        echo"</div>";
        echo "<div class='col-md-2'>";
         echo "<input type='text' class='form-control lang_class' name='year' value=".$getQuestionRow['year'].">";
        echo"</div>";
        echo "<div class='col-md-2'>";
        echo"</div>";
        echo "</div>";
        
        if($getQuestionRow['pretextid'] != 0)
        {
             $pretextquery = "select * from pretext_record where id=".$getQuestionRow['pretextid'];
                $pretextresult = mysqli_query($db,$pretextquery);
                $pretext = "";
                 while($pretext_row=mysqli_fetch_array($pretextresult))
                {

                    if($pretext_row['pretext'] !== "")
                    {
                        $pretext = $pretext_row['pretext'];
                    }
                   
                }
             
              echo "<div class='row' style='margin-bottom:20px;'>";
                    echo "<div class='col-md-12'>";
                        echo "<div >";
                            echo "pretext : <textarea rows='8' class='form-control lang_class' id='pretext' name='pretext'>".$pretext."</textarea>";
                             echo "<input type='hidden' name='pretext_id' value='".$getQuestionRow['pretextid']."'  />";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
        }
            echo "<div class='row'>";
                echo "<div class='col-md-12'>";
                    echo "<div >";
                        echo "Question : <textarea rows='8' class='form-control lang_class' id='questionText' name='questionText'>".$getQuestionRow['ques_text']."</textarea>";
    	                echo "<input type='hidden' name='TotalOptions' value='0' id='TotalOptions' />";
		                echo "<input type='hidden' name='QuesId' value='".$_REQUEST['QuesId']."'  />";
                        echo "<input type='hidden' name='ques_info_id' value='".$getQuestionRow['quesid']."'  />";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        if( $getQuestionRow['ques_image'] != "" )
        {
            echo "<div id='questionImage' class='row'>";
                echo "<div class='col-md-8 text-right'>";
                     
                echo "</div>";
                 echo "<div class='col-md-2 text-right'>";
                     echo " <input type='file' name='questionImage' class='form-control'   accept='image/*'/>";
                echo "</div>";
                echo "<div class='col-md-2 text-right'>";
                    echo "<img src='../uploads_image/".$getQuestionRow['ques_image']."' style=width:100%;'/>";
                echo "</div>";
            echo "</div>";
    		echo "<script>QuestionImage = 1;</script>";
        }
		else
		{
			echo "<div id='questionImage' class='row'>";
                echo "<div class='col-md-10 text-right'>";
                echo "</div>";
                echo "<div class='col-md-2 text-right'>";
                    echo " <input type='file' name='questionImage' class='form-control'  accept='image/*'/>";
                echo "</div>";
            echo "</div>";
		}


     
        $getOptionsQuery = "select * from options where QuesId = ".$_GET['QuesId']." order by OptionNo asc";
        $getOptionsResult = mysqli_query($db, $getOptionsQuery );
        $i = 1;
		echo "<div id='optionsContainer'>";
        while( $getOptionsRow = mysqli_fetch_array($getOptionsResult) )
        {
			if( $getQuestionRow['correctopt'] == $i )
			{
                echo "<div class='row'  id='opt".$i."div' style='background-color:green;>";
				    echo "<div  '>";
				    echo "<script> NoOfOptions =".$i."</script>";
                    
                    echo "<div class='col-md-1'>";
                        echo "Option ".$i. ":";
                    echo "</div>";
                    echo "<div class='col-md-4'>";
                        echo "<textarea rows='5' class='form-control lang_class' value='".$getOptionsRow['OptionText']."' name='opt".$i."'>".trim($getOptionsRow['OptionText'])."</textarea>";
                         if( $getOptionsRow['image'] != "")
        	            {
                            echo "<div class='row'>";
                                echo "<div class='col-md-2'>";
                                echo "</div>";
                                echo "<div class='col-md-6'>";
                                     echo "<input type='file' class='form-control' name='opt".$i."image'/>";
                                echo "</div>";
                                echo "<div class='col-md-4'>";
                                    echo "<img src='../uploads_image/".$getOptionsRow['image']."' style='width:100%;' accept='image/*'/>";
                                echo "</div>";
                            echo "</div>";
			            }
                        else
                        {
                            echo "<div class='row'>";
                                 echo "<div class='col-md-5'>";
                                 echo "</div>";
                                echo "<div class='col-md-7 text-right'>";
                                    echo "<input type='file' class='form-control' name='opt".$i."image'/>";
                                echo "</div>";
                            echo "</div>";
                        }
                    echo "</div>";
                    echo "<div class='col-md-1'>";
				        echo "<input type='radio' class='form-control' name='correctOption' value='$i' required/>";
                    echo "</div>";
                echo "</div>";
                
			}
			else
			{
                echo "<div class='row' id='opt".$i."div'>";
				    echo "<div >";
				    echo "<script> NoOfOptions=".$i."</script>";
                 
                    echo "<div class='col-md-1'>";
        	            echo "Option" .$i. ":"; 
                    echo "</div>";
                    echo "<div class='col-md-4'>";
                        echo "<textarea rows='5' class='form-control lang_class' value='".$getOptionsRow['OptionText']."'  name='opt".$i."'>".trim($getOptionsRow['OptionText'])."</textarea>";
                         if( $getOptionsRow['image'] != "")
                        {
                            echo "<div class='row'>";
                                echo "<div class='col-md-2'>";
                                echo "</div>";
                                echo "<div class='col-md-6'>";
                                     echo "<input type='file' class='form-control' name='opt".$i."image'/>";
                                echo "</div>";
                                echo "<div class='col-md-4'>";
                                    echo "<img src='../uploads_image/".$getOptionsRow['image']."' style='width:100%;' accept='image/*'/>";
                                echo "</div>";
                            echo "</div>";
			            }
                        else
                        {
                            echo "<div class='row'>";
                                 echo "<div class='col-md-5'>";
                                 echo "</div>";
                                echo "<div class='col-md-7 text-right'>";
                                    echo "<input type='file' class='form-control' name='opt".$i."image'/>";
                                echo "</div>";
                            echo "</div>";
                        }
                    echo "</div>";
                    echo "<div class='col-md-1'>";
				        echo "<input type='radio' class='form-control' name='correctOption' value='$i'  required/>";
                    echo "</div>";
                echo "</div>";
			}
		
			echo "</div><br>";
            $i++;
        }
        
                 echo "<div class='row'>";
                    echo "<div class='col-md-12'>";
                        echo "<div >";
                            echo "Solution : <textarea rows='7' class='form-control lang_class' id='solutionText' name='solutionText'>".$getQuestionRow['sol_text']."</textarea>";
    	                     if( $getQuestionRow['sol_image'] !== "")
                            {
                                echo "<div class='row'>";
                                    echo "<div class='col-md-8'>";
                                    echo "</div>";
                                    echo "<div class='col-md-3'>";
                                        echo "<input type='file' class='form-control' name='solutionimage'/>";
                                    echo "</div>";
                                    echo "<div class='col-md-1'>";
                                        echo "<img src='../uploads_image/".$getQuestionRow['sol_image']."' style='width:100%;' accept='image/*'/>";
                                    echo "</div>";
                                echo "</div>";
    		                }
                            else
                            {
                                echo "<div class='row'>";
                                     echo "<div class='col-md-9'>";
                                     echo "</div>";
                                     echo "<div class='col-md-3 text-right'>";
                                        echo "<input type='file' class='form-control' name='solutionimage'/>";
                                     echo "</div>";
                                echo "</div>";
                            }
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            
      
	//	echo "</div>";
    }    
    
	echo "<label for='correctOption' class='error'>Please select your Answer first !</label><br>";
    echo "<div class='row'>";
        echo "<div class='col-md-2'>";
            echo "<input type='button' id='button_delete' value='Delete Option' class='addDeleteOpt btn btn-lg btn-danger btn-block'>";
        echo "</div>";
        echo "<div class='col-md-2'>";
            echo "<input type='button'  id='button_add' value='Add Option' class='addDeleteOpt btn btn-lg btn-info btn-block'>";
        echo "</div>";
        echo "<div class='col-md-6'>";
        echo "</div>";
        echo "<div class='col-md-2'>";
	        echo "<input type='button' id='clear_all_data' class='btn btn-lg btn-danger btn-block' value='Clear all Data ! '/>";
        echo "</div>";
    echo "</div>";       
    if(isset( $_GET['fromPage'] ))
    {
        echo "<input type='hidden' name='fromPage' />";
    }
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

?>


       
    </body>
 
</html>
