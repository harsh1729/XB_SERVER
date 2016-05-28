// JavaScript Document
var returnValue = false;
function formValidate()
{
	if(document.getElementById('ced').value.trim() == "" || document.getElementById('ced') == null)
	{
		document.getElementById('qus_span').className = "validate";
		document.getElementById('qus_span').innerHTML = "Question Text cant't be left empty !";
		returnValue = false;
	}
	else
	{
		document.getElementById('qus_span').className = "";
		document.getElementById('qus_span').innerHTML = "";
		returnValue = true;
	}
	for(i=1;i<=rowNum;i++)
	{
		if( document.getElementById('opt'+i).value.trim() == "" || document.getElementById('opt'+i) == null )					
		{
			if( document.getElementById('opt'+i+'file').value == "" )
			{
				document.getElementById('opt'+i+'_span').className = "validate";
				document.getElementById('opt'+i+'_span').innerHTML = "Option "+i+" can't be left empty !";
				document.getElementById('opt'+i+'div').style.height = 140+"px";
				returnValue = false;
			}
			else if( returnValue !== false )
			{
				document.getElementById('opt'+i+'_span').className = "";
				document.getElementById('opt'+i+'_span').innerHTML = "";
				document.getElementById('opt'+i+'div').style.height = 100+"px";
				returnValue = true;
			}
		}
		else if( returnValue !== false )
		{
			document.getElementById('opt'+i+'_span').className = "";
			document.getElementById('opt'+i+'_span').innerHTML = "";
			document.getElementById('opt'+i+'div').style.height = 100+"px";
			returnValue = true;
		}
	}
	var rad = document.getElementsByName('option');
	
	var cnt = -1;
	for(i=0;i<rad.length;i++)
	{
		if(rad[i].checked)
			cnt=i;			
	}
	if(cnt == -1)
	{
		document.getElementById('answer_span').className = "validate";
		document.getElementById('answer_span').innerHTML = "select any of the options below for your <B>ASNWER</B>";
		returnValue = false;
	}
	else if( returnValue !== false )
	{
		document.getElementById('answer_span').className = "";
		document.getElementById('answer_span').innerHTML = "";
		returnValue = true;		
	}
	return returnValue;

}

var CategoryReturnVal = false;
function addCategoryFormValidation()
{
//	alert(document.getElementById('edit_category_list').value);
	if(document.getElementById('edit_category_list').value == -1 && document.getElementById('AddText').value.trim() == "")
	{
		document.getElementById('CatOptionSpan').innerHTML = "Please Write the name of the new Category !";
		document.getElementById('CatOptionSpan').className = "validateCategory";
		CategoryReturnVal = false;
	}
	else
	{
		document.getElementById('CatOptionSpan').innerHTML = "";
		document.getElementById('CatOptionSpan').className = "";
		CategoryReturnVal = true;
	}
	if(document.getElementById('edit_category_list').value > 0 && document.getElementById('AddText').value.trim() != document.getElementById('edit_category_list').options[document.getElementById('edit_category_list').selectedIndex].text )
	{
		document.getElementById('CatOptionSpan').innerHTML = "Select ADD NEW from list above to add new !";
		document.getElementById('CatOptionSpan').className = "validateCategory";
		CategoryReturnVal = false;
	}
	else
	{
		if(document.getElementById('CatOptionSpan').innerHTML == "Select ADD NEW from list above to add new !")
		{
			document.getElementById('CatOptionSpan').innerHTML = "";
			document.getElementById('CatOptionSpan').className = "";
			CategoryReturnVal = true;
		}
	}
	
	
	return CategoryReturnVal;
}