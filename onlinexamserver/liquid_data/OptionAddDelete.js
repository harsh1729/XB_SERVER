// JavaScript Document
/*

       var counter = 1;
var limit = 3;
var i=4;
var dele=1;
var j=1;

	
function Addopt(divName,divName1)
{
	if(dele==1)
	{	
		if(i==4)
		{
			document.getElementById("button2").disabled=false;	
		}
	    if (counter == limit)  
		{
      		document.getElementById("button1").disabled=true;
     	}
        var newdiv = document.createElement('div');
		var newdiv1= document.createElement('div');
		newdiv.id=i;
		newdiv1.id=j;
        newdiv.innerHTML ="Enter the opt" + (counter + 4) + ":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp <input type='text' name='opt"+(i+1)+"'>";
		newdiv1.innerHTML ="<input type='radio' name='option'  value='"+(i+1)+"'>"+"<input type='file' accept='image/x-png' class='opt'><br>";
		  
        document.getElementById(divName).appendChild(newdiv);
		document.getElementById(divName1).appendChild(newdiv1);
		document.getElementById("five").style.marginTop=-131-(j*25);
		document.getElementById(j).style.marginTop=9; 
        counter++;
		i++;
		document.getElementById("hdn_field").value = i;
		j++;
	}
	else
	{
		if(i==5)
		{
			document.getElementById("button2").disabled=true;	
		}
	    var child=document.getElementById(i-1);
		var parent=document.getElementById("third");
		parent.removeChild(child);
		var child1=document.getElementById(j-1);
		var parent1=document.getElementById("five");
		parent1.removeChild(child1);
		document.getElementById("five").style.marginTop=-131+(-25*j)+50;
		dele=1;
		counter--;
		i--;
		document.getElementById("hdn_field").value = i;
		j--
        if(counter!=limit+1)
		{
			document.getElementById("button1").disabled=false;
		}

	 }
	                        
}	
function deleted() 
{
	 dele=0;
	 setTimeout(Addopt(),100);
}
*/

var rowNum = 4;
function Addopt()
{
	rowNum++;
	$('#hdn_field').val(rowNum);
	if(rowNum%2 ==0)
	{	
		$('#opt'+(rowNum-1)+'clr').remove();
		document.getElementById('button2').disabled = false;
		var row = "<div id='opt"+rowNum+"div' style='float:left;width:50%;height:100px;margin-top:20px;'> "+
			"<div style='height:100%;width:60%;background-color:#990;float:left;'>"+
			"Option "+rowNum+":"+
			"<input type='text' class='opt' name='opt"+rowNum+"' id='opt"+rowNum+"'> "+
			"<input type='radio' name='option' class='css-checkbox' value='"+rowNum+"' id='optionRadio"+rowNum+"'>"+
            "<label for='optionRadio"+rowNum+"' class='css-label radGroup1'>Answer</label><br> "+
			"<input type='file' accept='image/*' class='fileinput' id='opt"+rowNum+"file' name='opt"+rowNum+"img'>"+
			"<br><div id='opt"+rowNum+"_span'></div>"+
			" </div> "+
			"<div id='opt"+rowNum+"img' style='width:30%;height:100%;background-color:#FFC;float:left;overflow:auto;'></div>"+
		"</div>"+
		"<div id='opt"+rowNum+"clr' style='clear:left;'></div>";
		$('#opt'+(rowNum-1)+'div').after(row);
	}
	else
	{
		document.getElementById('button2').disabled = false;
		var row = "<div id='opt"+rowNum+"div' style='float:left;width:50%;height:100px;margin-top:20px;'> "+
			"<div style='height:100%;width:60%;background-color:#990;float:left;'>"+
			"Option "+rowNum+":"+
			"<input type='text' class='opt' name='opt"+rowNum+"' id='opt"+rowNum+"'> "+
			"<input type='radio' name='option' class='css-checkbox' value='"+rowNum+"' id='optionRadio"+rowNum+"'>"+
            "<label for='optionRadio"+rowNum+"' class='css-label radGroup1'>Answer</label><br> "+
			"<input type='file' accept='image/*' class='fileinput' id='opt"+rowNum+"file' name='opt"+rowNum+"img'>"+
			"<br><div id='opt"+rowNum+"_span'></div>"+ 
			"</div> "+
			"<div id='opt"+rowNum+"img' style='width:30%;height:100%;background-color:#FFC;float:left;overflow:auto;'></div>"+
		"</div>"+
		"<div id='opt"+rowNum+"clr' style='clear:left;'></div>";
		$('#opt'+(rowNum-1)+'clr').after(row);
	}
	
	////////////////////////////////**********************  iMAGE fILE LISTENER   8////////////////////////	
        var filesInput4 = document.getElementById("opt"+rowNum+"file");  		//file browse button ....      
        filesInput4.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("opt"+rowNum+"img");            // Image span Area...
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
		
	
	$('input').ime();
	if(rowNum == 8)
	{
		document.getElementById('button1').disabled = true;
	}
}
function deleteOpt()
{
		document.getElementById('button1').disabled = false;	
	$('#opt'+rowNum+'div').remove();
	if(rowNum%2 == 0)
	{
		$('#opt'+rowNum+'clr').remove();
		var row = "<div id='opt"+(rowNum-1)+"clr' style='clear:left;'></div>";;
		$('#opt'+(rowNum-1)+'div').after(row);
	}
	else
	{
		$('#opt'+rowNum+'clr').remove();
	}
	rowNum--;
	if(rowNum == 4)
		document.getElementById('button2').disabled = true;
}
