<?php
//Table GkUpdates
//            id,text,langCode
//Table GkAppMapping
//          id,GkId,AppId
include("../database_connection.php");

session_start();

$AppId = $_SESSION['Application_Id'];
if(!isset($_SESSION['data_login_id']))
{
    header("location:../../index.php");
}


?>
<html>
    <head>
    	<meta charset="utf-8" />
        <script src="../../src/jquery.min.js" ></script>
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
        <style>
			*
			{
				margin:0;
				padding:0;
			}
			#submitButton
			{
				margin-top:10px;
                margin-left:10%;
			}
			.btnStyle{
				-moz-box-shadow:inset 0px 1px 0px 0px #caefab;
				-webkit-box-shadow:inset 0px 1px 0px 0px #caefab;
				box-shadow:inset 0px 1px 0px 0px #caefab;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #77d42a), color-stop(1, #5cb811) );
				background:-moz-linear-gradient( center top, #77d42a 5%, #5cb811 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77d42a', endColorstr='#5cb811');
				background-color:#77d42a;
				-webkit-border-top-left-radius:37px;
				-moz-border-radius-topleft:37px;
				border-top-left-radius:37px;
				-webkit-border-top-right-radius:0px;
				-moz-border-radius-topright:0px;
				border-top-right-radius:0px;
				-webkit-border-bottom-right-radius:37px;
				-moz-border-radius-bottomright:37px;
				border-bottom-right-radius:37px;
				-webkit-border-bottom-left-radius:0px;
				-moz-border-radius-bottomleft:0px;
				border-bottom-left-radius:0px;
				text-indent:0;
				border:1px solid #268a16;
				display:inline-block;
				color:#306108;
				font-family:Courier New;
				font-size:15px;
				font-weight:bold;
				font-style:normal;
				height:45px;
				line-height:45px;
				width:131px;
				text-decoration:none;
				text-align:center;
				text-shadow:1px 1px 0px #aade7c;
			}
			.btnStyle:hover {
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5cb811), color-stop(1, #77d42a) );
				background:-moz-linear-gradient( center top, #5cb811 5%, #77d42a 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5cb811', endColorstr='#77d42a');
				background-color:#5cb811;
			}
            .btnStyle:active {
				position:relative;
				top:1px;
			}
    		#GkContent
			{
				width:80%;
				height:60%;
				margin-left:10%;
				margin-top:20px;
                resize:none;
			}
            #datePicker
            {
                float:right;
                margin-right:3%;
                margin-top:10px;
                height:24px;
            }
            #language_select_option{
                margin-top:10px;
                width:10%;
                height:24px;
                float:right;
                margin-right:10%;
            }
            #gkFormContainer
            {
                height:38%;
            }
			#gkContentMainContainer
            {
                width:100%;
                background-color:green;
                height:55%;
            }
            #leftContainer
            {
                width:50%;
                height:100%;
                float:left;
                background-color:#cccccc;            
                overflow-y:auto;
            }
            #rightContainer
            {
                width:50%;
                height:100%;
                float:left;
                background-color:#dddddd;            
                overflow-y:auto;
            }
            .TopHeadContainer
            {
                width:100%;   
                padding-left:25%;
    	        font-weight:bolder;       
                background-color:#aaaaaa;
    	        position:fixed;  
            }
            #nextPrevious
            {
                width:100%;
                background-color:blue;
            }
            #leftSideBtnContainer
            {
                float:left;
            }
            #rightSideBtnContainer
            {
                float:right;
            }
            .gkShowData
            {
                width:90%;
                background-color:#999999;
                margin-top:30px;
                margin-left:3%;
                border:2px solid #000000;
                border-radius:15px;
                min-height:40px;
                padding:5px;
                
            }
		</style>
        <script>
        var LeftEngPageNumber = 1;
        var RightHiPageNumber = 1;
                $(document).ready(function(e) {
                    $('#GkcontentForm').submit(function(e) {
                            if($('#GkContent').val() == "")
                            {
                                alert("Content Field Must not be Empty !");
                            }
                            else
                            {
                                var postData = $(this).serializeArray();
                                var formUrl = $(this).attr("action");
                                
                               // postData.push(imageObj);
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
                                                            $("#GkContent").val('');
                                                            loadLeft(1);
                                                            loadRight(1);                                                        
                                                        }
                                                        //self.submit();
                                                        },
                                                error: function(jqXHR, textStatus, errorThrown) 
                                                 {
                                                    console.log(jqXHR + "\n" + textStatus + "\n" + errorThrown);
                                                    alert(textStatus);
                                                 }  
                                });
                            }   
                            e.preventDefault();
                            //e.unbind();
                    });
                    
                    loadLeft(1);
                    loadRight(1);
                    
                });
                
        function loadLeft(pg_number)
        {
                    jQuery.ajax({
                            async:true,
                            Type: 'POST',
                            dataType: 'json',
                            url: "getLatestGkUpdates.php",
                            data : {"pageno" :pg_number , "langCode" : 'en' , "AppId" : 1},
                            success: function(data,textStatus,jqXHR)
                                            {
                                                //console.log(data);
                                                $("#leftsideTopDiv").nextAll('div').remove();
                                                $.each(data,function(key,value)
                                                            {
                                                                //console.log(value); 
                                                                $("<div class='gkShowData'>"+value+"</div>").insertAfter("#leftsideTopDiv");
                                                            }
                                                        );
                                            },
                            error: function(){alert("error");}
                    });
                    
        
        }
        function loadRight(pg_number)
        {
                    jQuery.ajax({
                            async:true,
                            Type: 'POST',
                            dataType: 'json',
                            url: "getLatestGkUpdates.php",
                            data : {"pageno" : pg_number , "langCode" : 'hi' , "AppId" : 1},
                            success: function(data,textStatus,jqXHR)
                                            {
                                                //console.log(data);
                                                $("#rightsideTopDiv").nextAll('div').remove();
                                                $.each(data,function(key,value)
                                                            {
                                                                //console.log(value); 
                                                                $("<div class='gkShowData'>"+value+"</div>").insertAfter("#rightsideTopDiv");
                                                            }
                                                        );
                                            },
                            error: function(jqXHR, exception){alert("error:"+jqXHR.status);}
                    });
        
        }
        $('document').ready( function(e){
        
                $("#leftNextBtn").on('click',function(e){
                        $('#leftPreviousBtn').prop('disabled',false);
            	        LeftEngPageNumber++;
                        loadLeft( LeftEngPageNumber );
        		});
                $("#leftPreviousBtn").on('click',function(e){
                        LeftEngPageNumber--;
                        loadLeft( LeftEngPageNumber );
                        if(LeftEngPageNumber == 1)
                            $('#leftPreviousBtn').prop('disabled',true);
        		});
                
                
                $("#rightNextBtn").on('click',function(e){
                        $('#rightPreviousBtn').prop('disabled',false);
                        RightHiPageNumber++;
                        loadRight( RightHiPageNumber );
        		});
                $("#rightPreviousBtn").on('click',function(e){
                        RightHiPageNumber--;
                        loadRight( RightHiPageNumber );
                        if(RightHiPageNumber == 1)
                            $('#rightPreviousBtn').prop('disabled',true);
        		});
                Date.prototype.toDateInputValue = (function() {
                            var local = new Date(this);
                            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                            return local.toJSON().slice(0,10);
                        });
                $('#datePicker').val(new Date().toDateInputValue());
        } );
        </script>
    </head>
    <body>
        <div id="gkFormContainer">
        	<form id="GkcontentForm" method="post" action="submitGkUpdate.php">
                
            	<textarea name="GkContent" id="GkContent" class="lang_class"></textarea>
    			<center>
                	<input type="submit" id="submitButton" class="btnStyle"/>
        	        <select name="Language_select_option" id="language_select_option">
                    </select>
                    <input type="date" id="datePicker" name="datePicker"/>
                    <div style="float:clear;"></div>
    			</center>
            </form>
        </div>
        <div id="gkContentMainContainer">
            <div id="leftContainer">
                <div class="TopHeadContainer" id="leftsideTopDiv">
                English
                </div>
            </div>
            <div id="rightContainer">
                <div class="TopHeadContainer" id="rightsideTopDiv">
                Hindi
                </div>
            </div>
        </div>
        <div id="nextPrevious">
            <div id="leftSideBtnContainer">
                <input type= "button" value=" <<< PREVIOUS" id="leftPreviousBtn" disabled/>
                <input type= "button" value=" NEXT >>> " id="leftNextBtn"/>
            </div>
            <div id="rightSideBtnContainer">
                <input type= "button" value=" <<< PREVIOUS" id="rightPreviousBtn" disabled/>
                <input type= "button" value=" NEXT >>> " id="rightNextBtn"/>
            </div>
        </div>
    </body>
</html>