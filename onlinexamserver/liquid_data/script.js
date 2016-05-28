
$( document ).ready( function () {
	'use strict';
	
	$('input[type="text"]').ime();
	$("textarea").ime();

	var imeselector, imeselectorAddNew, languages, $imeSelector, $langselector , $write_lang ;

	$( '#ced' ).ime({ imePath: '../' });
	$( '#testLangInput' ).ime({ imePath: '../' });


	// get an instance of inputmethods
	imeselector = $( '#ced' ).data( 'imeselector' );
	imeselector.$imeSetting = $([]); 
	
	imeselectorAddNew = $( '#testLangInput' ).data('imeselector');
	imeselectorAddNew.$imeSetting = $([]); 
	
	languages = $.ime.languages;
	// Also test system inputmethods.
	//$imeSelector = $( 'select#imeSelector' );
	//$langselector = $( 'select#language' );
	//$write_lang = $('#language_select_option');
	
	$imeSelector = $( 'select#imeSelector' );
	$langselector = $( 'select#language' );
	$write_lang = $('#language_select_option');

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
		$langselector.append( $( '<option></option>' )
			.attr( 'value', lang )
			.text( language.autonym ) );
	} );
	$imeSelector.on( 'change', function () {
		var inputmethod = $imeSelector.find( 'option:selected' ).val();
		//imeselector.selectIM( inputmethod );
		//imeselector.$element.focus();
		imeselectorAddNew.selectIM( inputmethod );
		imeselectorAddNew.$element.focus();
	} );
	
	$langselector.on( 'change', function () {
		var language = $langselector.find( 'option:selected' ).val();
		//imeselector.selectLanguage( language );
		imeselectorAddNew.selectLanguage( language );
		
		listinputmethods( language );
	} );
		
	$write_lang.on('change',function() {
		var lan = $write_lang.find('option:selected').val();
		
		imeselector.selectLanguage(lan);
		//ime_select_Ajax(lan);
		$.ajax({url:"getImeAjax.php",
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
	});
	
	
	
	/*
	$( '#bold' ).click( function () {
		document.execCommand( 'bold', false, null );
	} );

	$( '#italic' ).click( function () {
		document.execCommand( 'italic', false, null );
	} );
	$( '#underline' ).click( function () {
		document.execCommand( 'underline', false, null );
	} );
		*/
		
		
		
		var $categoryMain = $('#category');

$categoryMain.on('change',function() {
	
		var catId = $('#category').find('option:selected').val();
		$.ajax({url:"getSubCategoryAJAX.php",
		async:true,
		data:"catId="+catId,
		type:"POST",
		success: function(result)
				{
					if(!result)
					{
						alert("Failed to load data !");
					}
					else
					{
						//alert(result);
						$('#Subcategory').empty();
						console.log("Result is :"+ result); 
						$.each($.parseJSON(result),function( idx , obj )
							{
								//alert(obj.id+":"+obj.name);
								$('#Subcategory').append( $('<option></option>').attr('value',obj.id).text(obj.name) );
							});
					}
				}			
			});
	});
	
	
	
	
	
		
} );

////////////*********************************   INSTANT IMAGE LOADING SCRIPT   ************************/////////////////////
window.onload = function(){
	
	$(function()
	{
		$('#ced').focus();
	});
        
    //Check File API support
    if(window.File && window.FileList && window.FileReader)
    {
        var filesInput0 = document.getElementById("files");  		//file browse button ....      
        filesInput0.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("result");            // Image span Area...
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];                
                //Only pics
                if(!file.type.match('image'))
                  continue;                
                var picReader = new FileReader();                
                picReader.addEventListener("load",function(event)
				{                    
                    var picFile = event.target;                    
                    
					var div = document.createElement("div");                    
                    //div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    //        "title='" + picFile.name + "'/>";                    
                    output.insertBefore(div,null);            
                	output.innerHTML = "<img class='thumbnail' src='"+picFile.result+"'"+" title='"+picFile.name+"' />";
					//document.getElementById('result').style.backgroundImage = 'url('+picFile.result+')';
                });                
                 //Read the image
                picReader.readAsDataURL(file);
            }                                          
        });
		
		
		
		
        var filesInput1 = document.getElementById("opt1file");  		//file browse button ....      
        filesInput1.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("opt1img");            // Image span Area...
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];                
                //Only pics
                if(!file.type.match('image'))
                  continue;                
                var picReader = new FileReader();                
                picReader.addEventListener("load",function(event)
				{                    
                    var picFile = event.target;                    
                    var div = document.createElement("div");                    
                    //div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    //        "title='" + picFile.name + "'/>";                    
                    output.insertBefore(div,null);            
                	output.innerHTML = "<img class='thumbnail' src='"+picFile.result+"'"+" title='"+picFile.name+"' />";
					//document.getElementById('opt1img').style.backgroundImage = 'url('+picFile.result+')';
                });                
                 //Read the image
                picReader.readAsDataURL(file);
            }                                          
        });
		
		
		
		
        var filesInput2 = document.getElementById("opt2file");  		//file browse button ....      
        filesInput2.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("opt2img");            // Image span Area...
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];                
                //Only pics
                if(!file.type.match('image'))
                  continue;                
                var picReader = new FileReader();                
                picReader.addEventListener("load",function(event)
				{                    
                    var picFile = event.target;                    
                    var div = document.createElement("div");                    
                    //div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    //        "title='" + picFile.name + "'/>";                    
                    output.insertBefore(div,null);            
                	output.innerHTML = "<img class='thumbnail' src='"+picFile.result+"'"+" title='"+picFile.name+"' />";
					//document.getElementById('opt2img').style.backgroundImage = 'url('+picFile.result+')';
                });                
                 //Read the image
                picReader.readAsDataURL(file);
            }                                          
        });
		
		
		
		
        var filesInput3 = document.getElementById("opt3file");  		//file browse button ....      
        filesInput3.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("opt3img");            // Image span Area...
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];                
                //Only pics
                if(!file.type.match('image'))
                  continue;                
                var picReader = new FileReader();                
                picReader.addEventListener("load",function(event)
				{                    
                    var picFile = event.target;                    
                    var div = document.createElement("div");                    
                    //div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    //        "title='" + picFile.name + "'/>";                    
                    output.insertBefore(div,null);            
                	output.innerHTML = "<img class='thumbnail' src='"+picFile.result+"'"+" title='"+picFile.name+"' />";
					//document.getElementById('opt3img').style.backgroundImage = 'url('+picFile.result+')';
                });                
                 //Read the image
                picReader.readAsDataURL(file);
            }                                          
        });
		
		
		
		
        var filesInput4 = document.getElementById("opt4file");  		//file browse button ....      
        filesInput4.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("opt4img");            // Image span Area...
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];                
                //Only pics
                if(!file.type.match('image'))
                  continue;                
                var picReader = new FileReader();                
                picReader.addEventListener("load",function(event)
				{                    
                    var picFile = event.target;                    
                    var div = document.createElement("div");                    
                    //div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    //        "title='" + picFile.name + "'/>";                    
                    output.insertBefore(div,null);            
                	output.innerHTML = "<img class='thumbnail' src='"+picFile.result+"'"+" title='"+picFile.name+"' />";
					//document.getElementById('opt4img').style.backgroundImage = 'url('+picFile.result+')';
                });                
                 //Read the image
                picReader.readAsDataURL(file);
            }                                          
        });
		
		
		
        var filesInputsolution = document.getElementById("solution_file");  		//file browse button ....      
        filesInputsolution.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("solution_img_div");            // Image span Area...
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];                
                //Only pics
                if(!file.type.match('image'))
                  continue;                
                var picReader = new FileReader();                
                picReader.addEventListener("load",function(event)
				{                    
                    var picFile = event.target;                    
                    var div = document.createElement("div");                    
                    //div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    //        "title='" + picFile.name + "'/>";                    
                    output.insertBefore(div,null);            
                	output.innerHTML = "<img class='thumbnail' src='"+picFile.result+"'"+" title='"+picFile.name+"' />";
					//document.getElementById('opt4img').style.backgroundImage = 'url('+picFile.result+')';
                });                
                 //Read the image
                picReader.readAsDataURL(file);
            }                                          
        });
		
		
    }
    else
    {
        console.log("Your browser does not support File API");
    }
	
	
	$('#edit_category_list').on('change',function(){
			var catSelect = $('#edit_category_list').find('option:selected').text();
			var catId = $('#edit_category_list').find('option:selected').val();
			if(catId == -1)
			{
				$('#AddText').val("");
			}
			else
			{
				$('#AddText').val(catSelect);
			}
		});
}
