<?php

include("../database_connection.php");

session_start();

$AppId = $_SESSION['Application_Id'];
if(!isset($_SESSION['data_login_id']))
{
    header("location:../index.php");
}

?>

<html>
    <head>
        <meta charset="utf-8" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="jquery.validate.js" ></script>
        <script>
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
					var row = "<div id='opt"+NoOfOptions+"div'>"+
				            "<br><br>Option "+NoOfOptions+" : <input type='text' name='opt"+NoOfOptions+"'/>"+
							"<input type='radio' name='correctOption'   value='"+NoOfOptions+"'  required/>"+
							"<br><input type='file'  name='opt"+NoOfOptions+"image'/>"+
							"</div>";
					$("#opt"+updateVar+"div").after(row);
					
					$('#TotalOptions').val(NoOfOptions);
					if(NoOfOptions == 8)
					{
						$('#button_add').prop('disabled',true);
					}
                });
				$('#button_delete').click(function(e) {
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
        <style>
			label.error
			{
				display:none;
				color:#F00;
				border:2px solid #F00;
			}
		</style>
    </head>
</html>

<?php
if( isset( $_GET['updateStatus'] ) )
{
    echo "<script>alert( '".$_GET['updateStatus']."' );</script>";
}

if(isset( $_GET['QuesId'] ))
{
    echo "<form action='updateSubmit.php' method='post'  enctype='multipart/form-data' id='updateForm'>";
    $getQuestionQuery = "select * from qrecord where QuesId = ".$_GET['QuesId'];
    //$getQuestionResult = mysql_query($getQuestionQuery);
    $getQuestionResult = $db->query($getQuestionQuery);
   while($getQuestionRow = mysqli_fetch_array( $getQuestionResult ) )
    {
        echo "Question : <textarea rows='7' cols='170'  id='questionText' name='questionText'>".$getQuestionRow['Question']."</textarea>";
		echo "<input type='hidden' name='TotalOptions' value='0' id='TotalOptions' />";
		echo "<input type='hidden' name='QuesId' value='".$_GET['QuesId']."'  />";
        if( $getQuestionRow['image'] != "" )
        {
            echo "<div id='questionImage'><img src='".$getQuestionRow['image']."' /></div>";
			echo "<script>QuestionImage = 1;</script>";
        }
		else
		{
			echo "<div id='questionImage'><input type='file' name='questionImage'  accept='image/*'/></div>";
		}
        echo "<hr><hr id='hrAboveOptions'>";
        $getOptionsQuery = "select * from options where QuesId = ".$_GET['QuesId']." order by OptionNo asc";
        //$getOptionsResult = mysql_query( $getOptionsQuery );
        $getOptionsResult = $db->query( $getOptionsQuery );
        $i = 1;
		echo "<div id='optionsContainer'>";
        while( $getOptionsRow = mysqli_fetch_array($getOptionsResult) )
        {
			if( $getQuestionRow['CorrectOption'] == $i )
			{
				echo "<div id='opt".$i."div' style='background-color:green;'>";
				echo "<script> NoOfOptions = $i </script>";
        	    echo "<br>Option $i : <input type='text' value='".$getOptionsRow['OptionText']."' name='opt$i'/>";
				echo "<input type='radio' name='correctOption' value='$i' required/>";
			}
			else
			{
				echo "<div id='opt".$i."div'>";
				echo "<script> NoOfOptions = $i </script>";
        	    echo "<br>Option $i : <input type='text' value='".$getOptionsRow['OptionText']."' name='opt$i'/>";
				echo "<input type='radio' name='correctOption' value='$i'  required/>";
			}
			if( $getOptionsRow['image'] != "")
			{
				echo "<br><img src='".$getOptionsRow['image']."'  accept='image/*'/>";
			}
			else
			{
				echo "<br><input type='file' name='opt".$i."image'/>";
			}
			echo "</div><br>";
            $i++;
        }
		echo "</div>";
    }    
	echo "<label for='correctOption' class='error'>Please select your Answer first !</label><br>";
    echo "<input type='button' id='button_delete' value='Delete Option' class='addDeleteOpt'>";
    echo "<input type='button'  id='button_add' value='Add Option' class='addDeleteOpt'>";
	echo "<input type='button' id='clear_all_data' value='Clear all Data ! '/>";
            
    if(isset( $_GET['fromPage'] ))
    {
        echo "<input type='hidden' name='fromPage' />";
    }
    echo "<br><input type='submit' value='Update Question' />";
    
    echo "</form>";
}

?>