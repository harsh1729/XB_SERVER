<script type="text/javascript" src="<?=base_url()?>docs/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
$('#loading_div').css("display","block");
    $(window).load(function()
    {
    	
    	$('.nicescroll').niceScroll({horizrailenabled:false});
  		var rightheight = (window.innerHeight)-($('#Exam_Time_Zone').height())- ($('#Quetion_Pallete_Sectionname').height()) - ($('#Quetion_Pallete_Bottom').height())-($('#Exam_Name_Header').height()) -8;
		var leftheight =  (window.innerHeight) - ($('#Exam_Name_Header').height()) - ($('#section_pannel').height()) - ($('#save_next_button_container').height()) -13;

		console.log($('#save_next_button_container').height());
		$('#Quetion_Pallete_Middle').height(rightheight);
		$('#Exam_Quetion_Show').height(leftheight);  	
    });
	$( window ).resize(function() {
  
		var rightheight = (window.innerHeight)-($('#Exam_Time_Zone').height())- ($('#Quetion_Pallete_Sectionname').height()) - ($('#Quetion_Pallete_Bottom').height())-($('#Exam_Name_Header').height()) -8;
		var leftheight =  (window.innerHeight) - ($('#Exam_Name_Header').height()) - ($('#section_pannel').height()) - ($('#save_next_button_container').height()) -13;

		console.log($('#save_next_button_container').height());
		$('#Quetion_Pallete_Middle').height(rightheight);
		$('#Exam_Quetion_Show').height(leftheight);
	});


var language;




	var response1;  var hour;var minute; var seconds; var current_id=0; var section_id=0; var IsSelected=false;
var marked_answered = "Marked_answered"; var marked_notanswered = "marked_notanswered"; var save_answered = "save_answered"; 
var save_notanswered = "save_notanswered"; var timer_timeout; restart =false;language_section = 0; language_section_second =1;





$.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/get_session_language',
				data: "",
				dataType: 'json',
				async:true,
				
				success:function(response)
				{
					language = response;
					console.log(response);
					if(language == 'hi')
					{
					
						language_section=0;
						language_section_second=1;
					}
					else
					{
						
						language_section_second=0;
						language_section=1;
					}
					
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
	});

function ajax_call(current_q,catid)
{
	
	$.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/set_seen_questionid',
				data: {"seen_question":current_q},
				dataType: 'json',
				async:true,
				
				success:function(response)
				{
					console.log("seen question status ",response);
					
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:",errorThrown,jqXHR,textStatus);
				}
	});
}



$('#change_language').on('change', function() {
  var a = $(this).val();
   

  if(a == 'hi')
  {
  		language='hi';
		language_section_second=1;
		language_section=0;	
  }
  else
  {
  		language='en';
		language_section=1;
		language_section_second=0;
  }


$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$("#instruction_english_container_pre").css("display","none");
				$("#instruction_hindi_container_pre").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));
				$('#main_window_div').append( $("#instruction_hindi_container_pre"));
				$('#main_window_div').append( $("#instruction_english_container_pre"));
 				$('#Exam_Option').empty();
				$('#question_hr').css("display","block");
				if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
				{	
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
					}
					
				}
				else if(response1[language_section][section_id][current_id].pretext_image == "")
				{
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
					}
				}
				else if(response1[language_section][section_id][current_id].q_img == "")
				{
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
						
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
					}
				}
				else
				{
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
					}
				}
				$('#back_button').css("display","none");
				$('#Exam_Quetion_Number').css("display", "block");	
				for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
					{
						if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
						{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}
						}
						else
						{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}

						}				
					}

});








$(document).ready(function(e) 
{
	$(window).load(function()
	{
		
		console.log("ajax called");
		$.ajax({
			  	type :'POST',
				url : global_namespace.baseurl+'client_requests/Bankpo/getexamquestion',
				data: "",
				dataType: 'json',
				async:true,
				success:function(response)
				{
					//console.log(response[0].length);
					if(response[0].length == 3)
					{
						hour =1;
						minute =29;
						seconds = 59;

					}
					else
					{
						hour =2;
						minute =29;
						seconds = 59;						
					}

			 		timer_timeout=setInterval("Timer()",1000);
					
						
						var y,x,i;
						response1 = response;
						if(response[language_section][section_id].length >= 1)
						{
							for(y=1;y<=response[language_section][section_id].length;y++)
							{	
								var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";
								
								var button = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
								 if(y%4==0)
								{
									$(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');	
								}
								else
								{
									$(button).appendTo('#Quetion_Pallete_Middle');
								}
							}
													
							$('#opt'+(current_id+1)).removeClass();						
							$('#opt'+(current_id+1)).addClass('Un_Answered_question');
							
							
							if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
							{
								ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
							}
							response1[language_section][section_id][current_id].status = save_notanswered;
							response1[language_section_second][section_id][current_id].status = save_notanswered;
							

							if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
							{	
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
								}
								
							}
							else if(response1[language_section][section_id][current_id].pretext_image == "")
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
								}
							}
							else if(response1[language_section][section_id][current_id].q_img == "")
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
									
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
								}
							}
							else
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
								}
							}

							$('#Exam_Quetion_Number').html("Queston No."+(current_id+1));
							$("#instruction_english_container").css("display","none");
							$("#instruction_hindi_container").css("display","none");
							$("#instruction_english_container_pre").css("display","none");
							$("#instruction_hindi_container_pre").css("display","none");
							$('#main_window_div').append( $("#instruction_hindi_container"));
							$('#main_window_div').append( $("#instruction_english_container"));
							$('#main_window_div').append( $("#instruction_hindi_container_pre"));
							$('#main_window_div').append( $("#instruction_english_container_pre"));
							$('#Exam_Option').empty();
							
							
							
								
							for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
							{
								if(response1[language_section][section_id][current_id].option[x].optimg == "")
								{
									var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
									"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
								
									$(radio).appendTo('#Exam_Option');			
								}
								else
								{
									var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
									"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
								
									$(radio).appendTo('#Exam_Option');	
								}
							}
						
						}
						$('#loading_div').css("display","none");

				},
						
				error:function(jqXHR,textStatus,errorThrown)
				{
					
					console.log("Error:",errorThrown,textStatus,jqXHR);
				}
			});
			
		});
	});
 





					//********************** GET QUESTION BY NEXT QUESTION BUTTON WITH MARK*******************************


$(document).ready(function(e) 
{

		$('#next_question_button').click(function()
		{
			current_id = current_id+1;
				if(current_id >= response1[language_section][section_id].length)
				{
					current_id = current_id-1;
					var $selected = $('input[name="CorrectOption"]:checked');
						
						if($selected.length == 0) 
						{
		   					response1[language_section][section_id][current_id].status = marked_notanswered;

		   					response1[language_section_second][section_id][current_id].status = marked_notanswered;
						} 
						else 
						{
						    response1[language_section][section_id][current_id].status =marked_answered;	
						    response1[language_section_second][section_id][current_id].status =marked_answered;	
		   					var whichOne = $selected.val();
							console.log("value=" +whichOne);
							response1[language_section][section_id][current_id].answer = whichOne;
							response1[language_section_second][section_id][current_id].answer = whichOne;
		   					IsSelected=true;
						}

						current_id = current_id+1;
						if(IsSelected)
						{
							$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('markedanswered_question');
							IsSelected=false;
						}
						else
						{
				   			$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('markednotanswered_question');
						}

					current_id=0; 

					if(section_id < (response1[language_section].length-1))
					{
						section_id = section_id+1;
					}
					else
					{
						section_id =0;	
					}
					$('#Quetion_Pallete_Sectionname').empty();
					if(section_id == 0)
					{
						$('#Exam_Section_Reasoning').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>REASONING</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 1)
					{
						console.log('vikas');
						$('#Exam_Section_English').addClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>English</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 2)
					{
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
					
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>Math</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 3)
					{
						$('#Exam_Section_General').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
					
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>GK</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 4)
					{
						$('#Exam_Section_Computer').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>Computer</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					var qcount=0;
					for(i=0;i<section_id;i++)
					{
						qcount = qcount+response1[language_section][i].length;
					}
					///////////////// section change

					$("#change_language").css("display","block");
					
					$("#instruction_english_container").css("display","none");
					$("#instruction_hindi_container").css("display","none");
					$("#instruction_english_container_pre").css("display","none");
					$("#instruction_hindi_container_pre").css("display","none");

					$('#main_window_div').append( $("#instruction_hindi_container"));
					$('#main_window_div').append( $("#instruction_english_container"));
					$('#main_window_div').append( $("#instruction_hindi_container_pre"));
					$('#main_window_div').append( $("#instruction_english_container_pre"));
						$('#Exam_Option').empty();
						$('#question_hr').css("display","block");
						$('#back_button').css("display","none");
						$('#Exam_Quetion').css("display", "block");
						$('#Exam_Quetion_Number').css("display", "block");
						$('#Exam_Quetion').empty();
						$('#Quetion_Pallete_Middle').empty();
					
						
						
					if(response1[language_section][section_id].length >=1)
					{	
						
						if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
						{
							ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
						}
						response1[language_section][section_id][current_id].status = save_notanswered;
						response1[language_section_second][section_id][current_id].status = save_notanswered;
						for(y=1;y<=response1[language_section][section_id].length;y++)
						{	
								if(response1[language_section][section_id][y-1].status == marked_answered && response1[language_section_second][section_id][y-1].status == marked_answered)
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'> <br>";																 	   	   
	  									
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == marked_notanswered && response1[language_section_second][section_id][y-1].status == marked_notanswered)
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  													 
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == save_answered && response1[language_section_second][section_id][y-1].status == save_answered)
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  									
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Answered_question' onclick='set_questionby_id(this)'>";	
								}
								else if(response1[language_section][section_id][y-1].status == save_notanswered && response1[language_section_second][section_id][y-1].status == save_notanswered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  													 
										 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question' onclick='set_questionby_id(this)'>";
								}
								else
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";															  																	
	  									var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
								}
								if(y%4==0)
								{
										$(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');	
								}
								else
								{
										$(button).appendTo('#Quetion_Pallete_Middle');
								}
						}
							
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered && response1[language_section_second][section_id][current_id].status == save_notanswered)
						{
								$('#opt'+(current_id+1)).removeClass();
								$('#opt'+(current_id+1)).addClass('Un_Answered_question');
						}
						$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
	   					/*if(response1[language_section][section_id][current_id].q_img == "")
						{			
	   						$('#Exam_Quetion').html(" "+response1[language_section][section_id][current_id].question);
						}
						else
						{
							$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");
									
						}*/

							if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
							{	
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
								}
								
							}
							else if(response1[language_section][section_id][current_id].pretext_image == "")
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
								}
							}
							else if(response1[language_section][section_id][current_id].q_img == "")
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
									
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
								}
							}
							else
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
								}
							}
					
					
						for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
						{
								if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}
								}
								else
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;'  name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}

								}		
						}
						
			
					}

					//////////////////////end section change



				}
				else
				{
						current_id = current_id-1;
						var qcount=0;
						for(i=0;i<section_id;i++)
						{
							var qcount = qcount+response1[language_section][i].length;
						}
						
						var $selected = $('input[name="CorrectOption"]:checked');
						
						if($selected.length == 0) 
						{
		   					response1[language_section][section_id][current_id].status = marked_notanswered;

		   					response1[language_section_second][section_id][current_id].status = marked_notanswered;
						} 
						else 
						{
						    response1[language_section][section_id][current_id].status =marked_answered;	
						    response1[language_section_second][section_id][current_id].status =marked_answered;	
		   					var whichOne = $selected.val();
							console.log("value=" +whichOne);
							response1[language_section][section_id][current_id].answer = whichOne;
							response1[language_section_second][section_id][current_id].answer = whichOne;
		   					IsSelected=true;
						}
								
						var i; 
				 		current_id = current_id+1;
						
						console.log(current_id);
						$("#instruction_english_container").css("display","none");
						$("#instruction_hindi_container").css("display","none");
						$('#main_window_div').append( $("#instruction_hindi_container"));
						$('#main_window_div').append( $("#instruction_english_container"));
						$('#Exam_Option').empty();	
						$('#Exam_Quetion').empty();
						
						if(IsSelected)
						{
							$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('markedanswered_question');
							IsSelected=false;
						}
						else
						{
				   			$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('markednotanswered_question');
						}
						if(current_id>=response1[language_section][section_id].length)
						{
							current_id=0; 
						}
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered || response1[language_section_second][section_id][current_id].status == save_notanswered)
						{
							$('#opt'+(current_id+1)).removeClass();
							$('#opt'+(current_id+1)).addClass('Un_Answered_question');
						}
						if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
							{
								ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
							}
						
						
						$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));
						/*if(response1[language_section][section_id][current_id].q_img == "")
						{			
		   					$('#Exam_Quetion').html(" "+response1[language_section][section_id][current_id].question);
						}
						else
						{
							$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");
										
						}*/

						if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
						{	
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
							}
							
						}
						else if(response1[language_section][section_id][current_id].pretext_image == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
							}
						}
						else if(response1[language_section][section_id][current_id].q_img == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
								
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
							}
						}
						else
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
							}
						}
						
						for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
						{
								if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
								{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}
								}
								else
								{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}
								}	
						}
					}
		
		});
    
   
});





								//********************** GET QUESTION BY DIRECT QUESTION NUMBER*******************************

function set_questionby_id(button)
{
		var i,y,x;
		
		var qcount=0;
				for(i=0;i<section_id;i++)
				{
					var qcount = qcount+response1[language_section][i].length;
				}
				
		var btn_value =button.value-1;
		current_id = btn_value - qcount;
		
					if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
					{
						ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
					}
				$("#change_language").css("display","block");
		 		$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));
				$('#Exam_Option').empty();
				$('#question_hr').css("display","block");
				$('#back_button').css("display","none");
				$('#Exam_Quetion').css("display", "block");
				$('#Exam_Quetion_Number').css("display", "block");	
		$('#Exam_Quetion').empty();
		
		if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "")
		{
			response1[language_section][section_id][current_id].status = save_notanswered;
			response1[language_section_second][section_id][current_id].status = save_notanswered;
			$('#opt'+(current_id+1)).removeClass();
			$('#opt'+(current_id+1)).addClass('Un_Answered_question');
		}
		
		$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
   		

				if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
				{	
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
					}
					
				}
				else if(response1[language_section][section_id][current_id].pretext_image == "")
				{
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
					}
				}
				else if(response1[language_section][section_id][current_id].q_img == "")
				{
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
						
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
					}
				}
				else
				{
					if(response1[language_section][section_id][current_id].pretext == "")
					{
						$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
					}
					else
					{
						$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
					}
				}
				
				
		for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
		{

				if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
				{
						if(response1[language_section][section_id][current_id].option[x].optimg == "")
							{
								var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
								"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
							
								$(radio).appendTo('#Exam_Option');			
							}
							else
							{
								var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
								"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
							
								$(radio).appendTo('#Exam_Option');	
							}
				}
				else
				{
						if(response1[language_section][section_id][current_id].option[x].optimg == "")
							{
								var radio = "<input type='radio' style='height:20px; width:20px;'  name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
								"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
							
								$(radio).appendTo('#Exam_Option');			
							}
							else
							{
								var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
								"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
							
								$(radio).appendTo('#Exam_Option');	
							}
				}			
		}
					
			
				  
}





								//********************** CLICK BUTTON FOR SAVE AND NEXT QUESTION *******************************
								
		
$(document).ready(function(e)
{
			
			$('#Save_next_button').click(function(e)
			{
				current_id = current_id+1;
				if(current_id >= response1[language_section][section_id].length)
				{
					current_id = current_id-1;
					var IsSelected = false;
					var $selected = $('input[name="CorrectOption"]:checked');
						
						if($selected.length == 0) 
						{
   								response1[language_section][section_id][current_id].status = save_notanswered;		
   								response1[language_section_second][section_id][current_id].status = save_notanswered;		
								
						} 
						else 
						{
								response1[language_section][section_id][current_id].status = save_answered;
								response1[language_section_second][section_id][current_id].status = save_answered;
   								var whichOne = $selected.val();
								response1[language_section][section_id][current_id].answer = whichOne;
								response1[language_section_second][section_id][current_id].answer = whichOne;
   								IsSelected=true;
						}
						console.log("without add"+current_id);
						current_id = current_id+1;
						console.log("with add"+current_id);
						if(IsSelected)
						{
							$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('Answered_question');
							IsSelected=false;
						}
						else
						{
		   					$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('Un_Answered_question');
						}


					
					current_id=0; 

					if(section_id < (response1[language_section].length-1))
					{
						section_id = section_id+1;
					}
					else
					{
						section_id =0;	
					}

					$('#Quetion_Pallete_Sectionname').empty();
					if(section_id == 0)
					{
						$('#Exam_Section_Reasoning').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>REASONING</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 1)
					{
						console.log('vikas');
						$('#Exam_Section_English').addClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>English</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 2)
					{
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
					
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>Math</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 3)
					{
						$('#Exam_Section_General').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
					
						$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>GK</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}
					else if(section_id == 4)
					{
						$('#Exam_Section_Computer').addClass('Exam_Section_after_click');
						$('#Exam_Section_English').removeClass('Exam_Section_after_click');
						$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
						$('#Exam_Section_General').removeClass('Exam_Section_after_click');
						
						$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
						document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>Computer</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					}


					var qcount=0;
					for(i=0;i<section_id;i++)
					{
						qcount = qcount+response1[language_section][i].length;
					}
					///////////////// section change

					$("#change_language").css("display","block");
					$("#instruction_english_container").css("display","none");
					$("#instruction_hindi_container").css("display","none");
					$("#instruction_english_container_pre").css("display","none");
					$("#instruction_hindi_container_pre").css("display","none");

					$('#main_window_div').append( $("#instruction_hindi_container"));
					$('#main_window_div').append( $("#instruction_english_container"));
					$('#main_window_div').append( $("#instruction_hindi_container_pre"));
					$('#main_window_div').append( $("#instruction_english_container_pre"));
						$('#Exam_Option').empty();
						$('#question_hr').css("display","block");
						$('#back_button').css("display","none");
						$('#Exam_Quetion').css("display", "block");
						$('#Exam_Quetion_Number').css("display", "block");
						$('#Exam_Quetion').empty();
						$('#Quetion_Pallete_Middle').empty();
						
						
						
					if(response1[language_section][section_id].length >=1)
					{	
						
						if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
						{
							ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
						}
						response1[language_section][section_id][current_id].status = save_notanswered;
						response1[language_section_second][section_id][current_id].status = save_notanswered;
						for(y=1;y<=response1[language_section][section_id].length;y++)
						{	
								if(response1[language_section][section_id][y-1].status == marked_answered && response1[language_section_second][section_id][y-1].status == marked_answered)
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'> <br>";																 	   	   
	  									
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == marked_notanswered && response1[language_section_second][section_id][y-1].status == marked_notanswered)
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  													 
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == save_answered && response1[language_section_second][section_id][y-1].status == save_answered)
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  									
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Answered_question' onclick='set_questionby_id(this)'>";	
								}
								else if(response1[language_section][section_id][y-1].status == save_notanswered && response1[language_section_second][section_id][y-1].status == save_notanswered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  													 
										 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question' onclick='set_questionby_id(this)'>";
								}
								else
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";															  																	
	  									var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
								}
								if(y%4==0)
								{
										$(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');	
								}
								else
								{
										$(button).appendTo('#Quetion_Pallete_Middle');
								}
						}
							
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered && response1[language_section_second][section_id][current_id].status == save_notanswered)
						{
								$('#opt'+(current_id+1)).removeClass();
								$('#opt'+(current_id+1)).addClass('Un_Answered_question');
						}
						$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
	   					/*if(response1[language_section][section_id][current_id].q_img == "")
						{			
	   						$('#Exam_Quetion').html(" "+response1[language_section][section_id][current_id].question);
						}
						else
						{
							$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");
									
						}*/

							if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
							{	
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
								}
								
							}
							else if(response1[language_section][section_id][current_id].pretext_image == "")
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
								}
							}
							else if(response1[language_section][section_id][current_id].q_img == "")
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
									
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
								}
							}
							else
							{
								if(response1[language_section][section_id][current_id].pretext == "")
								{
									$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
								}
								else
								{
									$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
								}
							}
					
					
						for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
						{
								if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}
								}
								else
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;'  name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}

								}		
						}
						
			
					}

					//////////////////////end section change



				}
				else
				{
					current_id = current_id-1;
					console.log("without add"+current_id);
					var qcount=0;
					for(i=0;i<section_id;i++)
					{
						 qcount = qcount+response1[language_section][i].length;
					}
						var $selected = $('input[name="CorrectOption"]:checked');
						
						if($selected.length == 0) 
						{
   								response1[language_section][section_id][current_id].status = save_notanswered;		
   								response1[language_section_second][section_id][current_id].status = save_notanswered;		
								
						} 
						else 
						{
								response1[language_section][section_id][current_id].status = save_answered;
								response1[language_section_second][section_id][current_id].status = save_answered;
   								var whichOne = $selected.val();
								response1[language_section][section_id][current_id].answer = whichOne;
								response1[language_section_second][section_id][current_id].answer = whichOne;
   								IsSelected=true;
						}
			
						
		  				current_id = current_id+1;
		  				console.log("without add"+current_id);
		  				$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));
						$('#Exam_Option').empty();	
						$('#Exam_Quetion').empty();
		
						if(IsSelected)
						{
							$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('Answered_question');
							IsSelected=false;
						}
						else
						{
		   					$('#opt'+current_id).removeClass();
							$('#opt'+current_id).addClass('Un_Answered_question');
						}
			
						
			
						if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
						{
							ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
						}
						
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered || response1[language_section_second][section_id][current_id].status == save_notanswered)
						{
							$('#opt'+(current_id+1)).removeClass();
							$('#opt'+(current_id+1)).addClass('Un_Answered_question');
						}
					
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "")
						{
							response1[language_section][section_id][current_id].status = save_notanswered;
							response1[language_section_second][section_id][current_id].status = save_notanswered;
						}
	        	
						$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
			   			/*if(response1[language_section][section_id][current_id].q_img == "")
						{			
   							$('#Exam_Quetion').html(" "+response1[language_section][section_id][current_id].question);
						}
						else
						{
							$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");
								
						}*/

						if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
						{	
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
							}
							
						}
						else if(response1[language_section][section_id][current_id].pretext_image == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
							}
						}
						else if(response1[language_section][section_id][current_id].q_img == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
								
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
							}
						}
						else
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
							}
						}
				
						
							
						for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
						{
							if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
							{
								if(response1[language_section][section_id][current_id].option[x].optimg == "")
								{
									var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
									"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
								
									$(radio).appendTo('#Exam_Option');			
								}
								else
								{
									var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
									"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
								
									$(radio).appendTo('#Exam_Option');	
								}
							}
							else
							{
								if(response1[language_section][section_id][current_id].option[x].optimg == "")
								{
									var radio = "<input type='radio' style='height:20px; width:20px;'  name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
									"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
								
									$(radio).appendTo('#Exam_Option');			
								}
								else
								{
									var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio' style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
									"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
								
									$(radio).appendTo('#Exam_Option');	
								}
							}
						}
				
		
					}
		
		
				
			});
            
});




									//********************** CLICK BUTTON FOR CLEAR RESPONSE*******************************

$(document).ready(function(e)
{
			$('#Clear_Response_button').click(function(e)
			{
					response1[language_section][section_id][current_id].answer = -1;
					response1[language_section_second][section_id][current_id].answer = -1;
					$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$("#instruction_english_container_pre").css("display","none");
				$("#instruction_hindi_container_pre").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));
				$('#main_window_div').append( $("#instruction_hindi_container_pre"));
				$('#main_window_div').append( $("#instruction_english_container_pre"));
					$('#Exam_Option').empty();	
					$('#opt'+(current_id+1)).removeClass();
					$('#opt'+(current_id+1)).addClass('Un_Answered_question');
					for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
					{
						if(response1[language_section][section_id][current_id].option[x].optimg == "")
							{
								var radio = "<input type='radio' style='height:20px; width:20px;'  name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
								"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
							
								$(radio).appendTo('#Exam_Option');			
							}
							else
							{
								var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'   style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
								"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
							
								$(radio).appendTo('#Exam_Option');	
							}			
					}
		
			});
    
});






										//********************** GET QUESTION BY CLICK REASONING SECTION*******************************

$(document).ready(function(e) 
{
	
			$('#Exam_Section_Reasoning').click(function(e)
			{
					var y,x,i;
					section_id = 0;
					current_id=0;
					
					$("#change_language").css("display","block");
					$('#Exam_Section_English').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
					$('#Exam_Section_General').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Reasoning').addClass('Exam_Section_after_click');
					$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$("#instruction_english_container_pre").css("display","none");
				$("#instruction_hindi_container_pre").css("display","none");

				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));
				$('#main_window_div').append( $("#instruction_hindi_container_pre"));
				$('#main_window_div').append( $("#instruction_english_container_pre"));
					$('#Exam_Option').empty();
					$('#question_hr').css("display","block");
					$('#back_button').css("display","none");
					$('#Exam_Quetion').css("display", "block");
					$('#Exam_Quetion_Number').css("display", "block");
					$('#Exam_Quetion').empty();
					$('#Quetion_Pallete_Middle').empty();
					$('#Quetion_Pallete_Sectionname').empty();
					
					document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>REASONING</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
				if(response1[language_section][section_id].length >=1)
				{	
					
					if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
					{
						ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
					}
					response1[language_section][section_id][current_id].status = save_notanswered;
					response1[language_section_second][section_id][current_id].status = save_notanswered;
					for(y=1;y<=response1[language_section][section_id].length;y++)
					{	
							if(response1[language_section][section_id][y-1].status == marked_answered && response1[language_section_second][section_id][y-1].status == marked_answered)
							{
									var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+y+"' class='markedanswered_question' onclick='set_questionby_id(this)'> <br>";																 	   	   
  									
									var button = "<input type='button'  id='opt"+y+"' value='"+y+"' class='markedanswered_question' onclick='set_questionby_id(this)'>";
							}
							else if(response1[language_section][section_id][y-1].status == marked_notanswered && response1[language_section_second][section_id][y-1].status == marked_notanswered)
							{
									var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+y+"' class='markednotanswered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
  													 
									var button = "<input type='button'  id='opt"+y+"' value='"+y+"' class='markednotanswered_question' onclick='set_questionby_id(this)'>";
							}
							else if(response1[language_section][section_id][y-1].status == save_answered && response1[language_section_second][section_id][y-1].status == save_answered)
							{
									var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
  									
									var button = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Answered_question' onclick='set_questionby_id(this)'>";	
							}
							else if(response1[language_section][section_id][y-1].status == save_notanswered && response1[language_section_second][section_id][y-1].status == save_notanswered)
							{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Un_Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
  													 
									 var button = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Un_Answered_question' onclick='set_questionby_id(this)'>";
							}
							else
							{
									var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";															  																	
  									var button = "<input type='button'  id='opt"+y+"' value='"+y+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
							}
							if(y%4==0)
							{
									$(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');	
							}
							else
							{
									$(button).appendTo('#Quetion_Pallete_Middle');
							}
					}
						
					if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered && response1[language_section_second][section_id][current_id].status == save_notanswered)
					{
							$('#opt'+(current_id+1)).removeClass();
							$('#opt'+(current_id+1)).addClass('Un_Answered_question');
					}
					$('#Exam_Quetion_Number').html("Queston No."+(current_id+1));			
   					

						if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
						{	
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
							}
							
						}
						else if(response1[language_section][section_id][current_id].pretext_image == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
							}
						}
						else if(response1[language_section][section_id][current_id].q_img == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
								
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
							}
						}
						else
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
							}
						}
				
				
					for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
					{
							if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
							{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}
							}
							else
							{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;'  name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}

							}		
					}
					
		
				}
			});
    
	
	
});





								//********************** GET QUESTION BY CLICK ENGLISH SECTION*******************************

$(document).ready(function(e) 
{
	
			$('#Exam_Section_English').click(function(e)
			{
				
					var y,x,i;
					section_id = 1;
					current_id=0;
					
					var qcount ;
					$("#change_language").css("display","block");
					$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
					$('#Exam_Section_General').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
					$('#Exam_Section_English').addClass('Exam_Section_after_click');
					$("#instruction_english_container").css("display","none");
					$("#instruction_hindi_container").css("display","none");
					$('#main_window_div').append( $("#instruction_hindi_container"));
					$('#main_window_div').append( $("#instruction_english_container"));

					$("#instruction_english_container_pre").css("display","none");
					$("#instruction_hindi_container_pre").css("display","none");
					$('#main_window_div').append( $("#instruction_hindi_container_pre"));
					$('#main_window_div').append( $("#instruction_english_container_pre"));

					$('#Exam_Option').empty();
					$('#question_hr').css("display","block");
					$('#back_button').css("display","none");
					$('#Exam_Quetion').css("display", "block");
					$('#Exam_Quetion_Number').css("display", "block");	
					$('#Exam_Quetion').empty();
					$('#Exam_Quetion_Number').empty();
					$('#Quetion_Pallete_Middle').empty();
					$('#Quetion_Pallete_Sectionname').empty();
					
					document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>ENGLISH</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
				if(response1[language_section][section_id].length>=1)
				{	
					qcount = response1[language_section][0].length;
					
					if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
					{
						ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
					}
					response1[language_section_second][section_id][current_id].status = save_notanswered;
					response1[language_section][section_id][current_id].status = save_notanswered;
					for(y=1;y<=response1[language_section][section_id].length;y++)
			        {	
							if(response1[language_section][section_id][y-1].status == marked_answered && response1[language_section_second][section_id][y-1].status == marked_answered)
							{
									var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'> <br>";																 	   	   
  									
									var button = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'>";
							}
							else if(response1[language_section][section_id][y-1].status == marked_notanswered && response1[language_section_second][section_id][y-1].status == marked_notanswered)
							{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='markednotanswered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
  									
									 var button = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='markednotanswered_question' onclick='set_questionby_id(this)'>";
							}
							else if(response1[language_section][section_id][y-1].status == save_answered && response1[language_section_second][section_id][y-1].status == save_answered)
							{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
  											
									 var button = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='Answered_question' onclick='set_questionby_id(this)'>";	
							}
							else if(response1[language_section][section_id][y-1].status == save_notanswered && response1[language_section_second][section_id][y-1].status == save_notanswered)
							{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='Un_Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
  									
									 var button = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='Un_Answered_question' onclick='set_questionby_id(this)'>";
							}
							else
							{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"'  class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";															  																	
  									 var button = "<input type='button'  id='opt"+y+"' value='"+(response1[language_section][0].length+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
							}
							if(y%4==0)
							{
									$(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');			
							}
							else
							{
									$(button).appendTo('#Quetion_Pallete_Middle');
							}
											
												
					}
	 				if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered && response1[language_section_second][section_id][current_id].status == save_notanswered)
					{
							$('#opt'+(current_id+1)).removeClass();
							$('#opt'+(current_id+1)).addClass('Un_Answered_question');
					}
		   			
	        		$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
   					

					if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
					{	
						if(response1[language_section][section_id][current_id].pretext == "")
						{
							$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
						}
						else
						{
							$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
						}
						
					}
					else if(response1[language_section][section_id][current_id].pretext_image == "")
					{
						if(response1[language_section][section_id][current_id].pretext == "")
						{
							$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
						}
						else
						{
							$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
						}
					}
					else if(response1[language_section][section_id][current_id].q_img == "")
					{
						if(response1[language_section][section_id][current_id].pretext == "")
						{
							$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
							
						}
						else
						{
							$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
						}
					}
					else
					{
						if(response1[language_section][section_id][current_id].pretext == "")
						{
							$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
						}
						else
						{
							$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
						}
					}
				
				
					for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
					{
						if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
							{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}
							}
							else
							{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}

							}				
					}
					
		
				}
		
			});
    
	
	
});






										//********************** GET QUESTION BY CLICK MATH SECTION*******************************

$(document).ready(function(e) 
{
	
			$('#Exam_Section_Math').click(function(e)
			{
					var y,x,i;
					section_id = 2;
					current_id=0;
					
					var qcount ;
					$("#change_language").css("display","block");
					$('#Exam_Section_General').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
					$('#Exam_Section_English').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Math').addClass('Exam_Section_after_click');
					$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));

				$("#instruction_english_container_pre").css("display","none");
				$("#instruction_hindi_container_pre").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container_pre"));
				$('#main_window_div').append( $("#instruction_english_container_pre"));
					$('#Exam_Option').empty();
					$('#question_hr').css("display","block");
					$('#back_button').css("display","none");
					$('#Exam_Quetion').css("display", "block");
					$('#Exam_Quetion_Number').css("display", "block");
					$('#Exam_Quetion').empty();
					$('#Quetion_Pallete_Middle').empty();
					$('#Quetion_Pallete_Sectionname').empty();
					document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>MATH</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					if(response1[language_section][section_id].length>=1)
					{	
						qcount = response1[language_section][0].length+response1[language_section][1].length;
						
						if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
						{
							ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
						}
						response1[language_section_second][section_id][current_id].status = save_notanswered;
						response1[language_section][section_id][current_id].status = save_notanswered;
						for(y=1;y<=response1[language_section][section_id].length;y++)
						{	
								if(response1[language_section][section_id][y-1].status == marked_answered && response1[language_section_second][section_id][y-1].status == marked_answered)
								{
										var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'> <br>";																 	   	   
	  													 
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == marked_notanswered && response1[language_section_second][section_id][y-1].status == marked_notanswered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' 	class='markednotanswered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  									
										 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == save_answered && response1[language_section_second][section_id][y-1].status == save_answered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' 	class='Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  													
										 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Answered_question' onclick='set_questionby_id(this)'>";	
								}
								else if(response1[language_section][section_id][y-1].status == save_notanswered && response1[language_section_second][section_id][y-1].status == save_notanswered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' 	class='Un_Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  									 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question' 	onclick='set_questionby_id(this)'>";
								}
								else
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";															  																	
	  									 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
								}
								if(y%4==0)
								{
										 $(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');
								}
								else
								{
								    	 $(button).appendTo('#Quetion_Pallete_Middle');
								}
												
			
														
						}
					    
						
						
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered && response1[language_section_second][section_id][current_id].status == save_notanswered)
						{
								$('#opt'+(current_id+1)).removeClass();
								$('#opt'+(current_id+1)).addClass('Un_Answered_question');
						}
		        	    $('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
	   				

						if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
						{	
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
							}
							
						}
						else if(response1[language_section][section_id][current_id].pretext_image == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
							}
						}
						else if(response1[language_section][section_id][current_id].q_img == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
								
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
							}
						}
						else
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
							}
						}
				
					
					    for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
					   	{
							if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}
								}
								else
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio' style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}

								}				
						}
					
		
					}
		
			});
    
	
	
});




									//********************** GET QUESTION BY CLICK GK SECTION*******************************

$(document).ready(function(e) 
{
	
			$('#Exam_Section_General').click(function(e)
			{
					var y,x,i;
					section_id =3;
					current_id=0;
					
					var qcount;
					$("#change_language").css("display","block");
					$('#Exam_Section_Computer').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
					$('#Exam_Section_English').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
					$('#Exam_Section_General').addClass('Exam_Section_after_click');
					$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));

				$("#instruction_english_container_pre").css("display","none");
				$("#instruction_hindi_container_pre").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container_pre"));
				$('#main_window_div').append( $("#instruction_english_container_pre"));
					$('#Exam_Option').empty();
					$('#question_hr').css("display","block");
					$('#back_button').css("display","none");
					$('#Exam_Quetion').css("display", "block");
					$('#Exam_Quetion_Number').css("display", "block");	
					$('#Exam_Quetion').empty();
					$('#Quetion_Pallete_Middle').empty();
					$('#Quetion_Pallete_Sectionname').empty();
					document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>GK</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					if(response1[language_section][section_id].length >=1)
					{
						qcount=response1[language_section][0].length+response1[language_section][1].length+response1[language_section][2].length;
						
						if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
						{
							ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
						}
						response1[language_section_second][section_id][current_id].status = save_notanswered;
						response1[language_section][section_id][current_id].status = save_notanswered;
						for(y=1;y<=response1[language_section][section_id].length;y++)
				        {	
						      	if(response1[language_section][section_id][y-1].status == marked_answered && response1[language_section_second][section_id][y-1].status == marked_answered)
								{
									var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'> <br>";																 	   	   
	  							 	var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == marked_notanswered && response1[language_section_second][section_id][y-1].status == marked_notanswered)
								{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  													 
									 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == save_answered && response1[language_section_second][section_id][y-1].status == save_answered)
								{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' 	class='Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  													
									 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Answered_question' onclick='set_questionby_id(this)'>";	
								}
								else if(response1[language_section][section_id][y-1].status == save_notanswered && response1[language_section_second][section_id][y-1].status == save_notanswered)
								{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  									
									 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question' onclick='set_questionby_id(this)'>";
								}
								else
								{
									 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";															  																	
	  								 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
								}
								if(y%4==0)
								{
									 $(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');																 																	 							
								}
								else
								{
									 $(button).appendTo('#Quetion_Pallete_Middle');
								}
						}
						
						
						
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered && response1[language_section_second][section_id][current_id].status == save_notanswered)
						{
								$('#opt'+(current_id+1)).removeClass();
								$('#opt'+(current_id+1)).addClass('Un_Answered_question');
						}
						$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
	   				

						if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
						{	
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
							}
							
						}
						else if(response1[language_section][section_id][current_id].pretext_image == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
							}
						}
						else if(response1[language_section][section_id][current_id].q_img == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
								
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
							}
						}
						else
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
							}
						}
						
					
						for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
						{
								if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}
								}
								else
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio' style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}

								}				
						}
						
					}
		
		
		});	
    
	
	
});



									//********************** GET QUESTION BY CLICK COMPUTER SECTION*******************************

$(document).ready(function(e) 
{
			$(document).on("click","#Exam_Section_Computer",function(e)
			//$('#Exam_Section_Computer').click(function(e)
			{
					var y,x,i;
					section_id = 4;
					current_id=0;
					var qcount;
					$("#change_language").css("display","block");
					$('#Exam_Section_Reasoning').removeClass('Exam_Section_after_click');
					$('#Exam_Section_English').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Math').removeClass('Exam_Section_after_click');
					$('#Exam_Section_General').removeClass('Exam_Section_after_click');
					$('#Exam_Section_Computer').addClass('Exam_Section_after_click');
					$("#instruction_english_container").css("display","none");
					$("#instruction_hindi_container").css("display","none");
					$('#main_window_div').append( $("#instruction_hindi_container"));
					$('#main_window_div').append( $("#instruction_english_container"));

					$("#instruction_english_container_pre").css("display","none");
					$("#instruction_hindi_container_pre").css("display","none");
					$('#main_window_div').append( $("#instruction_hindi_container_pre"));
					$('#main_window_div').append( $("#instruction_english_container_pre"));

					$('#Exam_Option').empty();
					$('#question_hr').css("display","block");
					$('#back_button').css("display","none");
					$('#Exam_Quetion').css("display", "block");
					$('#Exam_Quetion_Number').css("display", "block");
					$('#Exam_Quetion').empty();
					$('#Quetion_Pallete_Middle').empty();
					$('#Quetion_Pallete_Sectionname').empty();
					document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>COMPUTER</b> section now <div style='margin-top:15px;margin-left:5px;'> Question_pallate </div>";
					if(response1[language_section][section_id].length >= 1)
					{
						qcount=response1[language_section][0].length+response1[language_section][1].length+response1[language_section][2].length+response1[language_section][3].length;

						if(response1[language_section][section_id][current_id].status== "" && response1[language_section_second][section_id][current_id].status== "")
						{
							ajax_call(response1[language_section][section_id][current_id].id,response1[language_section][section_id][current_id].catid);
						}
						response1[language_section_second][section_id][current_id].status = save_notanswered;
						response1[language_section][section_id][current_id].status = save_notanswered;
						for(y=1;y<=response1[language_section][section_id].length;y++)
				        {	
							    if(response1[language_section][section_id][y-1].status == marked_answered && response1[language_section_second][section_id][y-1].status == marked_answered)
								{
								      	var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' 	onclick='set_questionby_id(this)'> <br>";																 	   	   
	  									
										var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markedanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == marked_notanswered && response1[language_section_second][section_id][y-1].status == marked_notanswered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  								
										 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='markednotanswered_question' onclick='set_questionby_id(this)'>";
								}
								else if(response1[language_section][section_id][y-1].status == save_answered && response1[language_section_second][section_id][y-1].status == save_answered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' 	class='Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  												
										 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Answered_question' onclick='set_questionby_id(this)'>";	
								}
								else if(response1[language_section][section_id][y-1].status == save_notanswered && response1[language_section_second][section_id][y-1].status == save_notanswered)
								{
										 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question'onclick='set_questionby_id(this)'> <br>"; 						 	   	   
	  									
										 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Un_Answered_question' onclick='set_questionby_id(this)'>";
								}
								else
								{
						 				 var buttonwith_nextline = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'> <br>";															  																	
	  									 var button = "<input type='button'  id='opt"+y+"' value='"+(qcount+y)+"' class='Quetion_pallete_margin' onclick='set_questionby_id(this)'>";
								}
								if(y%4==0)
								{
										 $(buttonwith_nextline).appendTo('#Quetion_Pallete_Middle');																 							
								}
								else
								{
										 $(button).appendTo('#Quetion_Pallete_Middle');
								}
												
						}
				
						
				
						if(response1[language_section][section_id][current_id].status == "" && response1[language_section_second][section_id][current_id].status == "" || response1[language_section][section_id][current_id].status == save_notanswered && response1[language_section_second][section_id][current_id].status == save_notanswered)
						{
								$('#opt'+(current_id+1)).removeClass();
								$('#opt'+(current_id+1)).addClass('Un_Answered_question');
						}
						$('#Exam_Quetion_Number').html("Queston No."+(qcount+current_id+1));			
	   				

						if(response1[language_section][section_id][current_id].pretext_image == "" && response1[language_section][section_id][current_id].q_img == "")
						{	
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question);
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question);
							}
							
						}
						else if(response1[language_section][section_id][current_id].pretext_image == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html(""+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");	
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");		
							}
						}
						else if(response1[language_section][section_id][current_id].q_img == "")
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question);		
								
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question);		
							}
						}
						else
						{
							if(response1[language_section][section_id][current_id].pretext == "")
							{
								$('#Exam_Quetion').html("<img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");			
							}
							else
							{
								$('#Exam_Quetion').html(response1[language_section][section_id][current_id].pretext+"<br><img src='"+response1[language_section][section_id][current_id].pretext_image+"'>"+"<br><br>"+response1[language_section][section_id][current_id].question+"<br><img src='"+response1[language_section][section_id][current_id].q_img+"'>");				
							}
						}
				
					
						for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
						{
								if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}
								}
								else
								{
										if(response1[language_section][section_id][current_id].option[x].optimg == "")
										{
											var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
										
											$(radio).appendTo('#Exam_Option');			
										}
										else
										{
											var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
											"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
										
											$(radio).appendTo('#Exam_Option');	
										}

								}				
						}
					}
		
		
		
			});
    
	
	
});










								//********************** GET QUESTION BY CLICK QUESTION PAPER BUTTON *******************************
$(document).ready(function(e) 
{
			$('#question_paper').click(function(e)
			{

				var question_count =1;
				var section=0;
			 	var y;
				var s="";
				$("#change_language").css("display","none");
				$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));

				$("#instruction_english_container_pre").css("display","none");
				$("#instruction_hindi_container_pre").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container_pre"));
				$('#main_window_div').append( $("#instruction_english_container_pre"));

				$('#Exam_Option').empty();
				$('#question_hr').css("display","none");
				$('#back_button').css("display","block");
				$('#Exam_Quetion').css("display", "none");
				$('#Exam_Quetion_Number').css("display", "none");
			
					console.log("jaspal",response1[language_section]);
				for(section=0;section<response1[language_section].length;section++)
				{
					
					for(y=0;y<response1[language_section][section].length;y++)
					{
				    	var span="<br><span>Q."+question_count+"&nbsp;&nbsp;&nbsp;&nbsp;"+response1[language_section][section][y].question+"</span><br><br><hr>"
				     	s+=span;
						question_count++;
					}
				}
				var div = "<div id='question_paper_div' style='overflow-y:auto;height:95%;width:100%;'>"+s+"</div>";
				$(div).appendTo('#Exam_Option');
				
				
			});
    
});

		
		
								//********************** GO BACK AFTER CLICK QUESTION PAPER BACK BUTTON*******************************
								
function question_paper_back()
{
				$("#change_language").css("display","block");
				$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));

				$("#instruction_english_container_pre").css("display","none");
				$("#instruction_hindi_container_pre").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container_pre"));
				$('#main_window_div').append( $("#instruction_english_container_pre"));

 				$('#Exam_Option').empty();
				$('#question_hr').css("display","block");
				$('#Exam_Quetion').css("display", "block");
				$('#back_button').css("display","none");
				$('#Exam_Quetion_Number').css("display", "block");	
				for(x=0;x<=response1[language_section][section_id][current_id].option.length-1;x++)
					{
						if(response1[language_section][section_id][current_id].answer == x && response1[language_section_second][section_id][current_id].answer == x)
						{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' checked name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  checked style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}
						}
						else
						{
									if(response1[language_section][section_id][current_id].option[x].optimg == "")
									{
										var radio = "<input type='radio' style='height:20px; width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<label for='opt"+x+"'  class='leftSpace10'>"+response1[language_section][section_id][current_id].option[x].opttext+"</label><br>";
									
										$(radio).appendTo('#Exam_Option');			
									}
									else
									{
										var radio = "<div style='float:left;margin-left:15px;text-align:center;'><input type='radio'  style='height:20px;width:20px;' name='CorrectOption' id='opt"+x+"'   value="+x+" class='leftSpace10'>"+
										"<div style='margin-top:5px;'><img src='"+response1[language_section][section_id][current_id].option[x].optimg+"'/></div></div>";
									
										$(radio).appendTo('#Exam_Option');	
									}

						}				
					}
}
		
	
		
		
						//********************** GET INSTRUCTIONS BY CLICK INSTRUCTION BUTTON *******************************
						
	$(document).ready(function(e) {
		
		$('#instruction').click(function(){
				$("#change_language").css("display","none");
				$("#instruction_english_container").css("display","none");
				$("#instruction_hindi_container").css("display","none");
				$('#main_window_div').append( $("#instruction_hindi_container"));
				$('#main_window_div').append( $("#instruction_english_container"));
				$('#Exam_Option').empty();
				$('#question_hr').css("display","none");
				$('#back_button').css("display","block");
				$('#Exam_Quetion').css("display", "none");
				$('#Exam_Quetion_Number').css("display", "none");
			
			if(response1[0].length == 3)
			{
				if(language=='hi')
				{
					//$('#Exam_Option').load('<?=base_url()?>client_requests/examtest/instruction_hindi');
					$( "#Exam_Option" ).append( $("#instruction_hindi_container_pre"));
					$('#instruction_hindi_container_pre').css("display","block");
				}
				else
				{
					$( "#Exam_Option" ).append( $("#instruction_english_container_pre"));
					$('#instruction_english_container_pre').css("display","block");
					//$('#Exam_Option').load('<?=base_url()?>client_requests/examtest/instruction_english');
				}
		
			}
			else
			{
				if(language=='hi')
				{
					//$('#Exam_Option').load('<?=base_url()?>client_requests/examtest/instruction_hindi');
					$( "#Exam_Option" ).append( $("#instruction_hindi_container"));
					$('#instruction_hindi_container').css("display","block");
				}
				else
				{
					$( "#Exam_Option" ).append( $("#instruction_english_container"));
					$('#instruction_english_container').css("display","block");
					//$('#Exam_Option').load('<?=base_url()?>client_requests/examtest/instruction_english');
				}
		
			}
			
			
		});
		
		
		
		
		
		
	
		
		
		//********************** GET PROFILE BY CLICK PROFILE BUTTON *******************************
		
		$('#profile').click(function(){
				$.ajax({
					  	type :'POST',
						url :global_namespace.baseurl+'client_requests/Bankpo/get_profile',
						data: "",
						dataType: 'json',
						async:true,
						
						success:function(response)
						{
							$("#change_language").css("display","none");
							$("#instruction_english_container").css("display","none");
							$("#instruction_hindi_container").css("display","none");
							$('#main_window_div').append( $("#instruction_hindi_container"));
							$('#main_window_div').append( $("#instruction_english_container"));
							$('#Exam_Option').empty();
							$('#question_hr').css("display","none");
							$('#back_button').css("display","block");
							$('#Exam_Quetion').css("display", "none");
							$('#Exam_Quetion_Number').css("display", "none");
							var profile_div = "<div style='width:100%;text-align:center;'>"+
													"<h3>condidate information</h3>"+
													"<br><div style='height:auto;width:100%;border:2px solid gray;'>"+
														"<center><div style='margin-left:40px; width:350px;text-align:left;padding:10px;line-height:2em;'>"+
														
															"Name        :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+response.name+"<br>"+
															"Roll_no.    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+response.rollno+"<br>"+
															"email       :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+response.email+"<br>"+
															"username    :&nbsp;&nbsp;"+response.username+"<br>"+
															"contact     :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+response.phone+"<br>"+
														
														"</div></center>"+	
													"</div>"+
												"</div>";
									$(profile_div).appendTo('#Exam_Option');
							
						},
						error:function(jqXHR,textStatus,errorThrown)
						{
							console.log("Error:"+errorThrown,textStatus,jqXHR);
						}
					});			
		});
        
    });	
	
	
	
	///////// close window popup
	
$(window).bind('beforeunload',function(e){
	if(restart)
	{
		return "To restart exam click leave page !";
	}
		
		return "";
});
		
		
		//********************** GET RESULT DETAILS BY CLICK GET DETAIL BUTTON *******************************
						
	function get_detail()
		{
			var question_count =1;
				var section;
			 	var y;
				var s="";
			$('#Exam_Option').empty();
				$('#question_hr').css("display","none");
				
				$('#Exam_Quetion').css("display", "none");
				$('#Exam_Quetion_Number').css("display", "none");
				
			for(section=0;section<response1[language_section].length;section++)
				{
					
					
					for(y=0;y<response1[language_section][section].length;y++)
					{
						//if(response1[language_section][section][y].status != "" && response1[language_section_second][section][y].status != "")
						{
							
							for(x=0;x<=response1[language_section][section][y].option.length-1;x++)
							{
								if(response1[language_section][section][y].answer != -1 && response1[language_section_second][section][y].answer != -1)
								{
									if(response1[language_section][section][y].answer == (response1[language_section][section][y].correctopt-1) && response1[language_section_second][section][y].answer == (response1[language_section_second][section][y].correctopt-1))
									{
										if((response1[language_section][section][y].correctopt-1) == x && (response1[language_section_second][section][y].correctopt-1) == x)
										{
											if(x==0)
											{
												if(question_count<10)
												{
													var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q.0"+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/>";
												}
												else
												{
													var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q."+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/>";
												}
												s+=Result_opt;
											}
											else if(x == response1[language_section][section][y].option.length-1 )
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/><input type='button' style='padding:8px;margin-top:10px; border-radius:5px;border:solid 1px #999999;margin-right:15%;float:right;' data-section='"+section+"' data-index='"+y+"' id='view_button"+question_count+"' class='view_button' value='solution'/>";
													s+=Result_opt;
												}
											else
											{
												var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/>";
												s+=Result_opt;
											}
										}
										else
										{
											if(x==0)
											{
												if(question_count<10)
												{
													var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q.0"+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
												}
												else
												{
													var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q."+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
												}
												s+=Result_opt;
											}
											else if(x == response1[language_section][section][y].option.length-1 )
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button' /><input type='button' style='padding:8px;margin-top:10px; border-radius:5px;border:solid 1px #999999;margin-right:15%;float:right;' value='solution'  data-section='"+section+"' data-index='"+y+"' id='view_button"+question_count+"' class='view_button'/>";
													s+=Result_opt;
												}
											else
											{
												var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
												s+=Result_opt;
											}
										}
									}
									else
									{
										if((response1[language_section][section][y].correctopt-1) == x)
										{
											if(x==0)
												{
													if(question_count<10)
													{
														var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q.0"+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/>";
													}
													else
													{
														var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q."+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/>";
													}
													s+=Result_opt;
												}
												else if(x == response1[language_section][section][y].option.length-1 )
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/><input type='button' style='padding:8px;margin-top:10px; border-radius:5px;border:solid 1px #999999;margin-right:15%;float:right;' value='solution'  data-section='"+section+"' data-index='"+y+"' id='view_button"+question_count+"' class='view_button'/>";
													s+=Result_opt;
												}
												else
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:green;'/>";
													s+=Result_opt;
												}
										}
										else if(response1[language_section][section][y].answer == x && response1[language_section_second][section][y].answer == x)
										{
											if(x==0)
												{
													if(question_count<10)
													{
														var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q.0"+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:red;'/>";
													}
													else
													{
														var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q."+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:red;'/>";
													}
													s+=Result_opt;
												}
												else if(x == response1[language_section][section][y].option.length-1 )
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:red;'/><input type='button' style='padding:8px;margin-top:10px; border-radius:5px;border:solid 1px #999999;margin-right:15%;float:right;' value='solution'  data-section='"+section+"' data-index='"+y+"' id='view_button"+question_count+"' class='view_button'/>";
													s+=Result_opt;
												}
												else
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button' style='background-color:red;'/>";
													s+=Result_opt;
												}
										}
										else
										{
											if(x==0)
												{
													if(question_count<10)
													{
														var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q.0"+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
													}
													else
													{
														var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q."+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
													}
													s+=Result_opt;
												}
												else if(x == response1[language_section][section][y].option.length-1 )
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button'/><input type='button' style='padding:8px;margin-top:10px; border-radius:5px;border:solid 1px #999999;margin-right:15%;float:right;' value='solution'  data-section='"+section+"' data-index='"+y+"' id='view_button"+question_count+"' class='view_button'/>";
													s+=Result_opt;
												}
												else
												{
													var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
													s+=Result_opt;
												}
										}
									}
									
							}
							else
							{
							if(x==0)
								{
									if(question_count<10)
									{
										var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q.0"+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
									}
									else
									{
										var Result_opt ="<br><span style='margin-right:13%;margin-left:12%;'>Q."+question_count+"</span><input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
									}
									s+=Result_opt;
								}
								else if(x == response1[language_section][section][y].option.length-1 )
								{
									var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button'/><input type='button' style='padding:8px; margin-top:10px; border-radius:5px;border:solid 1px #999999;margin-right:15%;float:right;' value='solution'  data-section='"+section+"' data-index='"+y+"' id='view_button"+question_count+"' class='view_button'/>";
									s+=Result_opt;
								}
								else
								{
									var Result_opt ="<input type='button' value='"+(x+1)+"' class='Result_detail_button'/>";
									s+=Result_opt;
								}
							}
						}
						}
						question_count++;
					}
				}
				var div = "<div id='Result_detail_div' style='overflow-y:auto;height:93.3%;text-align:;border:1px solid black;'><div class='text-center' style='border:1px solid black;'><h3>Exam Details</h3></div><br>"+s+"<br></div>";
				$(div).appendTo('#Exam_Option');
					
		}		
		
		
	
	$(document).on('click','#detail_back_button',function(e){
		submit_function();

	});
	
	
		//********************** GET answer with solution after submit BUTTON ******************************
		
	$(document).ready(function(e) {
		
		$(document).on('click','.view_button',function(){
			var id = $(this).attr("id");
			var section = $(this).data("section");
			var index = $(this).data("index");
			var correctopt = response1[language_section][section][index].correctopt-1;
			if(response1[language_section][section][index].q_img == "" && response1[language_section][section][index].option[correctopt].optimg == "")
			{
				if(response1[language_section][section][index].pretext_image == "")
				{
					if(response1[language_section][section][index].pretext == "")
					{
				 			var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].question+"<br><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
					else
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].pretext+"<br>"+response1[language_section][section][index].question+"<br><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
				}
				else
				{
					if(response1[language_section][section][index].pretext == "")
					{
				 			var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :<img src='"+response1[language_section][section][index].pretext_image+"'>"+response1[language_section][section][index].question+"<br><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
					else
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].pretext+"<br><img src='"+response1[language_section][section][index].pretext_image+"'>"+response1[language_section][section][index].question+"<br><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
				}			
			}
			if(response1[language_section][section][index].q_img != "" && response1[language_section][section][index].option[correctopt].optimg == "")
			{
				if(response1[language_section][section][index].pretext_image == "")
				{	
					if(response1[language_section][section][index].pretext == "")
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
					else
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].pretext+"<br>"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
				}
				else
				{
					if(response1[language_section][section][index].pretext == "")
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :<img src='"+response1[language_section][section][index].pretext_image+"'>"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
					else
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].pretext+"<br><img src='"+response1[language_section][section][index].pretext_image+"'>"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}

				}
			}
			if(response1[language_section][section][index].q_img != "" && response1[language_section][section][index].option[correctopt].optimg != "")
			{
				
				if(response1[language_section][section][index].pretext_image == "")
				{	
					if(response1[language_section][section][index].pretext == "")
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<img src='"+response1[language_section][section][index].option[correctopt].optimg+"' style='margin-left:10px;'><br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
					else
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].pretext+"<br>"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<img src='"+response1[language_section][section][index].option[correctopt].optimg+"' style='margin-left:10px;'><br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
				}
				else
				{
					if(response1[language_section][section][index].pretext == "")
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :<img src='"+response1[language_section][section][index].pretext_image+"'>"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<img src='"+response1[language_section][section][index].option[correctopt].optimg+"' style='margin-left:10px;'><br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}
					else
					{
						var div = "<div style=' width:100%;margin-bottom:10px;text-align:left;'>"+
								"Question :"+response1[language_section][section][index].pretext+"<br><img src='"+response1[language_section][section][index].pretext_image+"'>"+response1[language_section][section][index].question+"<br><img src='"+response1[language_section][section][index].q_img+"' style='margin-left:30px;'><br>"+
								"Answer :"+response1[language_section][section][index].option[correctopt].opttext+"<img src='"+response1[language_section][section][index].option[correctopt].optimg+"' style='margin-left:10px;'><br><br>"+
								"Solution :"+response1[language_section][section][index].solution+"<br>"+
							"</div>";
					}

				}			
			}
			
				$('#virtual_result').empty();		
			   $(div).appendTo('#virtual_result');
			   
			   $('#virtual_result').insertAfter('#'+id);
			   $('#virtual_result').css("display","block");
		});
        
    });	
	
	
	
	

		
	
	

		
	//********************** confirmation popup when window close ******************************
	
	$(document).ready(function(e) {
        $(document).on('click','#exit_button',function(){
			restart = false;
   			 var txt;
			
    		var r = confirm("Are you sure to exit ");
    		if (r == true)
			{
					window.close();			
			} 
			else 
			{
        		
    		}
    

		});
    });
	
			
			
			//********************** function for adjust body size *******************************
		
function adjust_body_size()
{ 
     
    resize_body();
  	
	document.getElementById("Quetion_Pallete_Sectionname").innerHTML="you are viewing <b>REASONING</b> section now";
	
}

					
		
		
			//********************** function for resize body *******************************
						
function resize_body()
{
	var W = window.innerWidth;
	var H = window.innerHeight;
	var body = window.document.body;
	body.style.height=H+"px";
	body.style.width=W+"px";
	
}

			
			
			//********************** function for timer () *******************************

   function Timer()
{
	
	
	seconds=seconds-1;
	if(seconds<0)
	{
		minute=minute-1;
		seconds=59;
	}
	if(minute<0)
	{
		hour=hour-1;
		minute=59;
	}
	if(minute<16 && hour==0)
	{
		$('#timer').css("color","red");
	}
	
	if(minute>9 && seconds<10)
	{
		document.getElementById("timer").innerHTML="Time Left :0"+hour+":"+minute+":0"+seconds;
	}
	if(minute<10 && seconds>9)
	{
		document.getElementById("timer").innerHTML="Time Left :0"+hour+":0"+minute+":"+seconds;
	}
	if(minute<10 && seconds<10)
	{
		document.getElementById("timer").innerHTML="Time Left :0"+hour+":0"+minute+":0"+seconds;
	}
	if(minute>9 && seconds>9)
	{
		document.getElementById("timer").innerHTML="Time Left :0"+hour+":"+minute+":"+seconds;
	}
	
	
	if(hour==0 && minute==0 && seconds==0 )
	{
		submit_function();
	}
}



		// //////////// //////  submit function ..........
var submit_flag = false;
function submit_function(){
			restart = true;

			clearInterval(timer_timeout);
			$("#change_language").css("display","none");
			$('#disable_buttons').css("display","block");
			$('#disable_sections').css("display","block");
			$('#exam_restart_exit_div').css("display","block");
			var count_marked_answered1=0 ; var count_marked_notanswered1=0; var count_save_answered1=0; var count_save_notanswered1=0 ;var notvisited1 = 0;
			var count_marked_answered2=0 ; var count_marked_notanswered2=0; var count_save_answered2=0; var count_save_notanswered2=0 ;var notvisited2 = 0;
			var count_marked_answered3=0 ; var count_marked_notanswered3=0; var count_save_answered3=0; var count_save_notanswered3=0 ;var notvisited3 = 0;
			var count_marked_answered4=0 ; var count_marked_notanswered4=0; var count_save_answered4=0; var count_save_notanswered4=0 ;var notvisited4 = 0;
			var count_marked_answered5=0 ; var count_marked_notanswered5=0; var count_save_answered5=0; var count_save_notanswered5=0 ;var notvisited5 = 0;
			var qcount1=0;var qcount2=0;var qcount3=0;var qcount4=0;var qcount5=0; var qtotal=0;
			var total_save_answered=0; var total_save_notanswered=0; var total_marked_answered=0;var total_notvisited=0;
			var marks1=0; var marks2=0; var marks3=0; var marks4=0; var marks5=0; var total_marks=0;
			var total_wrong=0; var total_right=0;
			for(y=0;y<response1[language_section][0].length;y++)
					{
						qcount1++;
				    	
						if(response1[language_section][0][y].status == marked_answered && response1[language_section_second][0][y].status == marked_answered)
						{
							count_marked_answered1++;
							if((response1[language_section][0][y].correctopt-1) == response1[language_section][0][y].answer && (response1[language_section_second][0][y].correctopt-1) == response1[language_section_second][0][y].answer)
							{
								marks1 =marks1+1;
								total_right++;
							}
							else
							{
								marks1 = marks1-(1/2);
								total_wrong++;
							}
						}
						else if(response1[language_section][0][y].status == marked_notanswered && response1[language_section_second][0][y].status == marked_notanswered)
						{
							count_save_notanswered1++;
						}
						else if(response1[language_section][0][y].status == save_answered && response1[language_section_second][0][y].status == save_answered)
						{
							count_save_answered1++;
							if((response1[language_section][0][y].correctopt-1) == response1[language_section][0][y].answer && (response1[language_section_second][0][y].correctopt-1) == response1[language_section_second][0][y].answer)
							{
								marks1 =marks1+1;
								total_right++;
							}
							else
							{
								marks1 = marks1-(1/2);
								total_wrong++;
							}
						}
						else if(response1[language_section][0][y].status == save_notanswered && response1[language_section_second][0][y].status == save_notanswered)
						{
							count_save_notanswered1++;
						}
						else 
						{
							notvisited1++;
						}
					}
					if(response1[language_section].length >= 2)
					{	
						for(y=0;y<response1[language_section][1].length;y++)
						{
					    	qcount2++;
							if(response1[language_section][1][y].status == marked_answered && response1[language_section_second][1][y].status == marked_answered)
							{
								count_marked_answered2++;
								if((response1[language_section][0][y].correctopt-1) == response1[language_section][0][y].answer && (response1[language_section_second][0][y].correctopt-1) == response1[language_section_second][0][y].answer) 
								{
									marks2 =marks2+1;
									total_right++;
								}
								else
								{
									marks2 = marks2-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][1][y].status == marked_notanswered && response1[language_section_second][1][y].status == marked_notanswered)
							{
								count_save_notanswered2++;
							}
							else if(response1[language_section][1][y].status == save_answered && response1[language_section_second][1][y].status == save_answered)
							{
								count_save_answered2++;
								if((response1[language_section][1][y].correctopt-1) == response1[language_section][1][y].answer && (response1[language_section_second][1][y].correctopt-1) == response1[language_section_second][1][y].answer)
								{
									marks2 =marks2+1;
									total_right++;
								}
								else
								{
									marks2 = marks2-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][1][y].status == save_notanswered && response1[language_section_second][1][y].status == save_notanswered)
							{
								count_save_notanswered2++;
							}
							else 
							{
								notvisited2++;
							}
						}
					}
					if(response1[language_section].length >=3)
					{
						for(y=0;y<response1[language_section][2].length;y++)
						{
					    	qcount3++;
							if(response1[language_section][2][y].status == marked_answered && response1[language_section_second][2][y].status == marked_answered)
							{
								count_marked_answered3++;
								if((response1[language_section][2][y].correctopt-1) == response1[language_section][2][y].answer && (response1[language_section_second][2][y].correctopt-1) == response1[language_section_second][2][y].answer)
								{
									marks3 =marks3+1;
									total_right++;
								}
								else
								{
									marks3 = marks3-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][2][y].status == marked_notanswered && response1[language_section_second][2][y].status == marked_notanswered)
							{
								count_save_notanswered3++;
							}
							else if(response1[language_section][2][y].status == save_answered && response1[language_section_second][2][y].status == save_answered)
							{
								count_save_answered3++;
								if((response1[language_section][2][y].correctopt-1) == response1[language_section][2][y].answer && (response1[language_section_second][2][y].correctopt-1) == response1[language_section_second][2][y].answer)
								{
									marks3 =marks3+1;
									total_right++;
								}
								else
								{
									marks3 = marks3-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][2][y].status == save_notanswered && response1[language_section_second][2][y].status == save_notanswered)
							{
								count_save_notanswered3++;
							}
							else 
							{
								notvisited3++;
							}
						}
					}
					if(response1[language_section].length >=4)
					{
						for(y=0;y<response1[language_section][3].length;y++)
						{
							qcount4++;
					    	
							if(response1[language_section][3][y].status == marked_answered && response1[language_section_second][3][y].status == marked_answered)
							{
								count_marked_answered4++;
								if((response1[language_section][3][y].correctopt-1) == response1[language_section][3][y].answer && (response1[language_section_second][3][y].correctopt-1) == response1[language_section_second][3][y].answer)
								{
									marks4 =marks4+1;
									total_right++;
								}
								else
								{
									marks4 = marks4-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][3][y].status == marked_notanswered && response1[language_section_second][3][y].status == marked_notanswered)
							{
								count_save_notanswered4++;
							}
							else if(response1[language_section][3][y].status == save_answered && response1[language_section_second][3][y].status == save_answered)
							{
								count_save_answered4++;
								if((response1[language_section][3][y].correctopt-1) == response1[language_section][3][y].answer && (response1[language_section_second][3][y].correctopt-1) == response1[language_section_second][3][y].answer)
								{
									marks4 =marks4+1;
									total_right++;
								}
								else
								{
									marks4 = marks4-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][3][y].status == save_notanswered && response1[language_section_second][3][y].status == save_notanswered)
							{
								count_save_notanswered4++;
							}
							else 
							{
								notvisited4++;
							}
						}
					}
					if(response1[language_section].length >= 5)
					{
						for(y=0;y<response1[language_section][4].length;y++)
						{
					    	qcount5++;
							if(response1[language_section][4][y].status == marked_answered && response1[language_section_second][4][y].status == marked_answered)
							{
								count_marked_answered5++;
								if((response1[language_section][4][y].correctopt-1) == response1[language_section][4][y].answer && (response1[language_section_second][4][y].correctopt-1) == response1[language_section_second][4][y].answer)
								{
									marks5 =marks5+1;
									total_right++;
								}
								else
								{
									marks5 = marks5-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][4][y].status == marked_notanswered && response1[language_section_second][4][y].status == marked_notanswered)
							{
								count_save_notanswered5++;
							}
							else if(response1[language_section][4][y].status == save_answered && response1[language_section_second][4][y].status == save_answered)
							{
								count_save_answered5++;
								if((response1[language_section][4][y].correctopt-1) == response1[language_section][4][y].answer && (response1[language_section_second][4][y].correctopt-1) == response1[language_section_second][4][y].answer)
								{
									marks5 =marks5+1;
									total_right++;
								}
								else
								{
									marks5 = marks5-(1/2);
									total_wrong++;
								}
							}
							else if(response1[language_section][4][y].status == save_notanswered && response1[language_section_second][4][y].status == save_notanswered)
							{
								count_save_notanswered5++;
							}
							else 
							{
								notvisited5++;
							}
						}
				  	}
					qtotal = qcount1+qcount2+qcount3+qcount4+qcount5;
					total_save_answered =count_save_answered1+count_save_answered2+count_save_answered3+count_save_answered4+count_save_answered5;
					total_save_notanswered= count_save_notanswered1+count_save_notanswered2+count_save_notanswered3+count_save_notanswered4+count_save_notanswered5; 
					total_marked_answered=count_marked_answered1+count_marked_answered2+count_marked_answered3+count_marked_answered4+count_marked_answered5; ;
					total_notvisited=notvisited1+notvisited2+notvisited3+notvisited4+notvisited5;
					total_marks =marks1+marks2+marks3+marks4+marks5;
				$('#Exam_Option').empty();
				$('#question_hr').css("display","none");
				
				$('#Exam_Quetion').css("display", "none");
				$('#Exam_Quetion_Number').css("display", "none");
				if(response1[0].length == 3)
				{
					var result_table = "<table style='border:1px solid ;border-collapse:collapse;margin-top:20px;margin-right:15px;'>"+
											"<tr>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Section Name"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"No.of Question"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Aswered"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Not Answered"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Marked for Review"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Not visited"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"markes"+
												"</th>"+
											"</tr>"+
											
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"Reasoning"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks1+
												"</td>"+
											"</tr>"+
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"English"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks2+
												"</td>"+
											"</tr>"+
											
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"Math"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks3+
												"</td>"+
											"</tr>"+
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;font-weight:bold;'>"+
													"Total"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;font-weight:bold;'>"+
													qtotal+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;font-weight:bold;'>"+
													total_save_answered+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;font-weight:bold;'>"+
													total_save_notanswered+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;font-weight:bold;'>"+
													total_marked_answered+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;font-weight:bold;'>"+
													total_notvisited+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;font-weight:bold;'>"+
													total_marks+
												"</td>"+
											"</tr>"+
											
										"</table>"+
										"<table style='width:100%; border:1px;margin-top:20px;margin-bottom:10px;'>"+
											"<tr>"+
												"<th style='text-align:center;'>"+
													"<input type='button' id='get_detail_button'   value='Get Details' style='padding:10px;' onclick='get_detail()'/>"+
												"</th>"+
											"</tr>"+
										"</table>";

				}
				else
				{
					var result_table = "<table style='border:1px solid ;border-collapse:collapse;margin-top:20px;margin-right:15px;'>"+
											"<tr>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Section Name"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"No.of Question"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Aswered"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Not Answered"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Marked for Review"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"Not visited"+
												"</th>"+
												"<th style='border:1px solid ;padding:10px 15px;'>"+
													"markes"+
												"</th>"+
											"</tr>"+
											
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"Reasoning"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited1+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks1+
												"</td>"+
											"</tr>"+
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"English"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited2+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks2+
												"</td>"+
											"</tr>"+
											
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"Math"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited3+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks3+
												"</td>"+
											"</tr>"+
											
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"General Awareness"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount4+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered4+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered4+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered4+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited4+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks4+
												"</td>"+
											"</tr>"+
											
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"computer"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qcount5+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_answered5+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_save_notanswered5+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													count_marked_answered5+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													notvisited5+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													marks5+
												"</td>"+
											"</tr>"+
											"<tr>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													"Total"+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													qtotal+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													total_save_answered+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													total_save_notanswered+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													total_marked_answered+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													total_notvisited+
												"</td>"+
												"<td align='center' style='border:1px solid ;padding:10px 15px;'>"+
													total_marks+
												"</td>"+
											"</tr>"+
											
										"</table>"+
										"<table style='width:100%; border:1px;margin-top:20px;margin-bottom:10px;'>"+
											"<tr>"+
												"<th style='text-align:center'>"+
													"<input type='button' id='get_detail_button'   value='Get Details' style='padding:10px;' onclick='get_detail()'/>"+
												"</th>"+
											"</tr>"+
										"</table>";
				}	
									
			$(result_table).appendTo('#Exam_Option');

			   
			   
				if(!submit_flag)
				{
			 	
				
					 var examrecord_array = [];
				for(section=0;section<response1[language_section].length;section++)
				{
					
					for(y=0;y<response1[language_section][section].length;y++)
					{
						if(response1[language_section][section][y].status == marked_answered || response1[language_section][section][y].status == save_answered || response1[language_section][section][y].status == save_notanswered || response1[language_section][section][y].status == marked_notanswered)
						{
							if(response1[language_section][section][y].answer == -1)
							{
				    			examrecord_array.push({id:response1[language_section][section][y].ques_info_id,answer:response1[language_section][section][y].answer,status:response1[language_section][section][y].status});
				    		}
				    		else
				    		{
				    			examrecord_array.push({id:response1[language_section][section][y].ques_info_id,answer:parseInt(response1[language_section][section][y].answer)+1,status:response1[language_section][section][y].status});	
				    		}
						}
					}
				}
				

				$.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/submitexamrecord',
				data: {"examrecord_array":examrecord_array,"language":language,"marks":total_marks,"total_attempt":total_marked_answered+total_save_answered,"attempt_wrong":total_wrong,"attempt_right":total_right},
				dataType:'json',
				async:true,
				success:function(response)
				{
					

				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					
					console.log(jqXHR, textStatus ,errorThrown);								
					alert("an error acured");     
				}
			});



			$.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/submitseenexam',
				data:'', 
				dataType:'json',
				async:true,
				success:function(response)
				{
					

				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					
					console.log(jqXHR, textStatus ,errorThrown);								
					alert("an error acured");     
				}
			});	
				
				console.log(examrecord_array);
			}
				submit_flag=true;

		}


</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67214090-1', 'auto');
  ga('send', 'pageview');

</script>