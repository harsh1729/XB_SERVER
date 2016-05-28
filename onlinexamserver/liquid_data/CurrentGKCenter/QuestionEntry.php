<?php

include("../database_connection.php");

session_start();

$AppId = $_SESSION['Application_Id'];
if(!isset($_SESSION['data_login_id']))
{
    //header("location:../index.php");
}
?>

<html>
    <head>
        <meta charset="utf-8" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="jquery.validate.js" ></script>
        <script>
        	var NoOfOptions = 0;
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
				            "<br><br>Option "+NoOfOptions+" : <input type='text' name='opt"+NoOfOptions+"'  id='opt"+NoOfOptions+"'  class='lang_class'  required/>"+
							"<input type='radio' name='correctOption'   value='"+NoOfOptions+"'  required/>"+
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
                    if(NoOfOptions == 8)
                        $('#button_add').prop('disabled',false);
					NoOfOptions--;
					if(NoOfOptions == 4)
						$('#button_delete').prop('disabled',true);
					
					$('#TotalOptions').val(NoOfOptions);
                });
                
                 Date.prototype.toDateInputValue = (function() {
                            var local = new Date(this);
                            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                            return local.toJSON().slice(0,10);
                        });
                $('#datePicker').val(new Date().toDateInputValue());
			
			$.extend($.validator.messages,{required:"Please fill the Required Fields First!"});
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
        <link href="../../css/jquery.ime.css" rel="stylesheet" />
    	<script src="../../libs/rangy/rangy-core.js"></script>
		<script src="../../src/jquery.ime.js"></script>
		<script src="../../src/jquery.ime.selector.js"></script>  
		<script src="../../src/jquery.ime.preferences.js"></script>
		<script src="../../src/jquery.ime.inputmethods.js"></script>
          <script>
            $( document ).ready( function () 
            {
                
                'use strict';
    
                var imeselector, languages, $imeSelector, $langselector;
                $( '.lang_class' ).ime({ imePath: '../../' });
                
                
                // get an instance of inputmethods
                imeselector = $( '.lang_class' ).data( 'imeselector' );
    	        imeselector.$imeSetting = $([]);
    	        languages = $.ime.languages;
    	        // Also test system inputmethods.
    	        $imeSelector = $( 'select#imeSelector' );
    	        $langselector = $( 'select#language_select_option' );
            
    	        function listinputmethods ( language ) {
    		        var inputmethods = $.ime.languages[language].inputmethods;
    		        $imeSelector.empty();
    		        $.each( inputmethods, function ( index, inputmethodId ) {
    			        var inputmethod = $.ime.sources[inputmethodId];
    			        $imeSelector.append( $( '<option></option>' )
    				        .attr( 'value', inputmethodId ).text( inputmethod.name ) );
            		        } );
    		        $imeSelector.trigger( 'change' );
    	        }
            
    	        $.each( languages, function ( lang, language ) {
    		        //console.log(lang+":"+language.autonym);
    		        if(lang == "en" || lang == "hi")
    		        {
    			        if(lang == "en")	
    			        {		
    				        $langselector.append( $( '<option selected></option>' ).attr( 'value', lang ).text( language.autonym ) );
    				    listinputmethods(lang);
            		
    				        imeselector.selectLanguage( lang );
    				        var inputmethod = $imeSelector.find( 'option:selected' ).val();
    				        imeselector.selectIM( inputmethod );
    			        }
    			        else
            				$langselector.append( $( '<option></option>' ).attr( 'value', lang ).text( language.autonym ) );
    		        }
    	        } );
    	        $imeSelector.on( 'change', function () {
    		        var inputmethod = $imeSelector.find( 'option:selected' ).val();
                    //console.log(inputmethod);
    		        imeselector.selectIM( inputmethod );
    		        imeselector.$element.focus();
    	        } );
    	        $langselector.on( 'change', function () {
    		        //var language = $langselector.find( 'option:selected' ).val();
    		        //imeselector.selectLanguage( language );
            		//listinputmethods( language );
                    //imeselector.selectIM( inputmethod );
                                        
                            var lan = $langselector.find('option:selected').val();
                        	
                    		imeselector.selectLanguage(lan);
                    		//ime_select_Ajax(lan);
                    		$.ajax({url:"../getImeAjax.php",
                    				async:true,
                    				data:"language="+lan,
                    				type:"POST",
                    				success: function(result)
                    				{
                    					if(!result)
                    						alert("failed to load data !");
                    					else
                    					{
                    						//$write_ime.val(result);
                    						imeselector.selectIM(result);
                    						imeselector.$element.focus();
                    					}
                    				}		
                    		});
                    		//imeselector.selectIM('hi-transliteration');
                        	        } );
            } );

        </script>
        
        
        <script>
                $(document).ready(function(e) {
                    $('#GkcontentForm').submit(function(e) {
                            //if($('#GkContent').val() == "")
                            //{
                            //    alert("Content Field Must not be Empty !");
                            //}
                            //else
                            //{
                                var postData = $(this).serializeArray();
                                var formUrl = $(this).attr("action");
                                console.log(postData);
                                jQuery.ajax({
                                                async: false,
                                                type: 'POST',
                                                url:formUrl,
                                                //data: encodeURIComponent(postData),
                                                data: postData,
                                                success: function(data, textStatus, jqXHR){
                                                        alert(data);
                                                        if(data != "Content Not Saved !")
                                                        {
                                                            $("#questionText").val('');     
                                                            for(i=1;i<=NoOfOptions;i++)
                                                            {
                                                                $("#opt"+i).val('');
                                                            }
                                                            $("#solutionText").val('');
                                                            $('input[name="correctOption"]').prop('checked', false);
                                                        }
                                                        //self.submit();
                                                        },
                                                error: function(jqXHR, textStatus, errorThrown) 
                                                 {
                                                    console.log(jqXHR + "\n" + textStatus + "\n" + errorThrown);
                                                    alert(textStatus);
                                                 }  
                                });
                            //}   
                            e.preventDefault();
                            //e.unbind();
                    });
                    
                });
        </script>
        
        
    </head>
</html>

<?php
if( isset( $_GET['updateStatus'] ) )
{
    echo "<script>alert( '".$_GET['updateStatus']."' );</script>";
}

    echo "<form action='QuestionSubmit.php' method='post' id='GkcontentForm'>";

    {
        echo "Question : <textarea rows='7' cols='170'  id='questionText' name='questionText'  class='lang_class' required></textarea>";
		echo "<input type='hidden' name='TotalOptions' value='0' id='TotalOptions' />";
        echo "<br>Choose date: <input type='date' name='date' id='datePicker'/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Choose Language : <select name='Language_select_option' id='language_select_option'></select>";
        
        
        echo "<hr><hr id='hrAboveOptions'>";
        $getOptionsQuery = "select * from options where QuesId = ".$_GET['QuesId']." order by OptionNo asc";
        //$getOptionsResult = mysql_query( $getOptionsQuery );
        $getOptionsResult = $db->query( $getOptionsQuery );
		echo "<div id='optionsContainer'>";
        
        for($i=1;$i<=4;$i++)
        {
			
			{
				echo "<div id='opt".$i."div'>";
				echo "<script> NoOfOptions = $i </script>";
        	    echo "<br>Option $i : <input type='text' name='opt$i' id='opt$i' class='lang_class' required/>";
				echo "<input type='radio' name='correctOption' value='$i'  required/>";
			}
			
			echo "</div><br>";
        }
		echo "</div>";
    }    
	echo "<label for='correctOption' class='error'>Please select your Answer first !</label><br>";
    echo "<input type='button' id='button_delete' value='Delete Option' class='addDeleteOpt'>";
    echo "<input type='button'  id='button_add' value='Add Option' class='addDeleteOpt'>";
    echo "<br>Solution : <textarea  rows='7' cols='170'  class='lang_class' name='solutionText' id='solutionText' placeholder='Write your Solution Here !'></textarea>";
    echo "<br><input type='submit' value='Save Question' />";
    
    echo "</form>";


?>