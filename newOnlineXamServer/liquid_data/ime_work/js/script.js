$( document ).ready( function () {
	'use strict';

	var imeselector, languages, $imeSelector, $langselector;

//	$( '.lang_class' ).ime({ imePath: '../../' });
	$( '.lang_class' ).ime({ imePath: 'ime_work/' });

	$( '#bold' ).click( function () {
		document.execCommand( 'bold', false, null );
	} );

	$( '#italic' ).click( function () {
		document.execCommand( 'italic', false, null );
	} );

	$( '#underline' ).click( function () {
		document.execCommand( 'underline', false, null );
	} );

	
	// get an instance of inputmethods
	imeselector = $( '.lang_class' ).data( 'imeselector' );
	imeselector.$imeSetting = $([]);
	languages = $.ime.languages;
	// Also test system inputmethods.
	$imeSelector = $( 'select#imeSelector' );
	$langselector = $( 'select#language' );

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
			if(lang == "hi")	
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
		imeselector.selectIM( inputmethod );
		//imeselector.$element.focus();
	} );
	$langselector.on( 'change', function () {
		var language = $langselector.find( 'option:selected' ).val();
		imeselector.selectLanguage( language );
		listinputmethods( language );
	} );
} );
