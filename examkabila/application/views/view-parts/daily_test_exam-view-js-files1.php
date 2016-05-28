<script type="text/javascript">
	
$('#menu_container').css("display","block");
$('#loading_div').css("display","none");

$('.question_pannel').niceScroll();
var response;
var current_question = 0; 
$(window).load(function(e){

$('#daily_curren_gk_test_name_container').niceScroll({horizrailenabled:false});
if ($('#daily_curren_gk_test_name_container').children().first().attr('data-testno') && $('#daily_curren_gk_test_name_container').children().first().attr('data-category')){
	
	var testno  = $('#daily_curren_gk_test_name_container').children().first().data('testno');
	var cat  = $('#daily_curren_gk_test_name_container').children().first().data('category');
	$.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/get_daily_test_question',
				data: {'testno':testno,'cat':cat},
				dataType: 'json',
				async:true,
				
				success:function(response1)
				{
					console.log(response1);
					response = response1;

					var str = $('#daily_curren_gk_test_name_container').children().first().text();
					str = str.trim();
					str = str.substring(7, str.length);

					console.log(str);
					$('#test_name').empty();
					$('#question_no').empty();
					$('#question_text').empty();
					$('#option_div').empty();
					$('#test_name').html('Daily Test '+str);
					$('#question_no').html('Question NO.1');
					if(response.length>0)
					{
						if(response[0].pretext != "")
						{
							$("<span>"+response[0].pretext+"</span><br>").appendTo( "#question_text" );	
						}
						if(response[0].pretext_image != "")
						{
							$("<span><img src='"+response[0].pretext_image+"' ></span><br>").appendTo( "#question_text" );		
						}
						if(response[0].q_img != "")
						{
							$("<span><img src='"+response[0].q_img+"' ></span><br>").appendTo( "#question_text" );			
						}
						//$('#question_text').html(response[0].q_text);
						$("<span>"+response[0].q_text+"</span>").appendTo( "#question_text" );
					}
					if(response.length > 0)
					{	
						for(i=0;i<response[0].options.length;i++)
						{
							var data ="<div id='option"+(i+1)+"' class='form-control option' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
										""+response[0].options[i].option_text+""+
									"</div>";

									
									$(data).appendTo($( "#option_div"));
						}
					}
					for(i=0;i<response.length;i++)
					{
						if(i < 9)
						{
							var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;'>"+
											""+(i+1)+""+
										"</button>";
								$(data).appendTo($('#question_pallet_button'))	;
						}
						else
						{
							var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;padding:10px 11.5px;'>"+
											""+(i+1)+""+
										"</button>";
								$(data).appendTo($('#question_pallet_button'))	;	
						}	
					}
					$('#button1').css('background-color','#ccc');
					$('#daily_curren_gk_test_name_container').children().first().css("background-color","#eee");
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
		});	
}
else
{
	$.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/get_daily_test_current_affaire_question',
				data: "",
				dataType: 'json',
				async:true,
				
				success:function(response1)
				{
					console.log(response1);
					response = response1;

					var str = $('#daily_curren_gk_test_name_container').children().first().text();
					str = str.trim();
					str = str.substring((str.length-11),(str.length));

					console.log(str);
					$('#test_name').empty();
					$('#question_no').empty();
					$('#question_text').empty();
					$('#option_div').empty();
					$('#test_name').html('Daily Current GK Quiz '+str);
					$('#question_no').html('Question NO.1');
					$('#question_text').html(response[0].q_text);
					for(i=0;i<response[0].options.length;i++)
					{
						var data ="<div id='option"+(i+1)+"' class='form-control option' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
									""+response[0].options[i].option_text+""+
								"</div>";

								
								$(data).appendTo($( "#option_div"));
					}

					for(i=0;i<response.length;i++)
					{
						if(i < 9)
						{
							var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;'>"+
											""+(i+1)+""+
										"</button>";
								$(data).appendTo($('#question_pallet_button'))	;
						}
						else
						{
							var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;padding:10px 11.5px;'>"+
											""+(i+1)+""+
										"</button>";
								$(data).appendTo($('#question_pallet_button'))	;	
						}	
					}
					$('#button1').css('background-color','#ccc');
					$('#daily_curren_gk_test_name_container').children().first().css("background-color","#eee");
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
		});	
}


	
	
});

$('#next_button').click(function(e){

	$('#solution_div').css('display','none');
	$('#solution_div').appendTo($('#test_name').parent());

	if(current_question == (response.length-1))
	{
		current_question =-1;
	}
	current_question = current_question+1;

	$('.question_button').css('background-color','#fff');
	$('#button'+(current_question+1)).css('background-color','#ccc');

	$('#question_no').empty();
	$('#question_text').empty();
	$('#option_div').empty();
	$('#question_no').html('Question NO.'+(current_question+1));
						if(response[current_question].pretext != "")
						{
							$("<span>"+response[current_question].pretext+"</span><br>").appendTo( "#question_text" );	
						}
						if(response[current_question].pretext_image != "")
						{
							$("<span><img src='"+response[current_question].pretext_image+"' ></span><br>").appendTo( "#question_text" );		
						}
						if(response[current_question].q_img != "")
						{
							$("<span><img src='"+response[current_question].q_img+"' ></span><br>").appendTo( "#question_text" );			
						}
						//$('#question_text').html(response[0].q_text);
						$("<span>"+response[current_question].q_text+"</span>").appendTo( "#question_text" );


	//$('#question_text').html(response[current_question].q_text);
	if(response[current_question].status == '0')
	    {	
		    for(i=0;i<response[current_question].options.length;i++)
			{
				var data ="<div id='option"+(i+1)+"' class='form-control option' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";

									
									$(data).appendTo($( "#option_div"));
			}
		}
		else
		{
			for(i=0;i<response[current_question].options.length;i++)
			{
				if((i+1) == response[current_question].u_answer)
				{
					if(response[current_question].answer == response[current_question].u_answer)
					{
						if(response[current_question].solution !== '')
						{
							var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>"+
							"<div id='' style='position:relative;border:1px solid #ccc;display:;padding:10px;width:100%;'>"+
							"<span>Discription:-</span>"+response[current_question].solution+
							"</div>";
						}
						else
						{
							var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>";
						}
					}
					else
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#f00;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";
					}
				}
				else if((i+1) == response[current_question].answer)
				{
					if(response[current_question].solution !== '')
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>"+
							"<div id='' style='position:relative;border:1px solid #ccc;display:;padding:10px;width:100%;'>"+
							"<span>Discription:-</span>"+response[current_question].solution+
						"</div>";

					}
					else
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>";
					}	
				}
				else
				{
					var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";	
				}
				
									
									$(data).appendTo($( "#option_div"));
			}
		}

	
});

$('#pre_button').click(function(e){

		$('#solution_div').css('display','none');
	$('#solution_div').appendTo($('#test_name').parent());

		if(current_question == 0)
		{
			current_question = response.length;
		}
		current_question = current_question -1;

		$('.question_button').css('background-color','#fff');
		$('#button'+(current_question+1)).css('background-color','#ccc');

		$('#question_no').empty();
		$('#question_text').empty();
		$('#option_div').empty();
		$('#question_no').html('Question NO.'+(current_question+1));
						if(response[current_question].pretext != "")
						{
							$("<span>"+response[current_question].pretext+"</span><br>").appendTo( "#question_text" );	
						}
						if(response[current_question].pretext_image != "")
						{
							$("<span><img src='"+response[current_question].pretext_image+"' ></span><br>").appendTo( "#question_text" );		
						}
						if(response[current_question].q_img != "")
						{
							$("<span><img src='"+response[current_question].q_img+"' ></span><br>").appendTo( "#question_text" );			
						}
						//$('#question_text').html(response[0].q_text);
						$("<span>"+response[current_question].q_text+"</span>").appendTo( "#question_text" );
	  // $('#question_text').html(response[current_question].q_text);
	    if(response[current_question].status == '0')
	    {	
		    for(i=0;i<response[current_question].options.length;i++)
			{
				var data ="<div id='option"+(i+1)+"' class='form-control option' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";

									
									$(data).appendTo($( "#option_div"));
			}
		}
		else
		{
			for(i=0;i<response[current_question].options.length;i++)
			{
				if((i+1) == response[current_question].u_answer)
				{
					if(response[current_question].answer == response[current_question].u_answer)
					{
						if(response[current_question].solution !== '')
						{
							var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>"+
							"<div id='' style='position:relative;border:1px solid #ccc;display:;padding:10px;width:100%;'>"+
							"<span>Discription:-</span>"+response[current_question].solution+
							"</div>";
						}
						else
						{
							var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>";
						}
					}
					else
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#f00;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";
					}
				}
				else if((i+1) == response[current_question].answer)
				{
					if(response[current_question].solution !== '')
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>"+
							"<div id='' style='position:relative;border:1px solid #ccc;display:;padding:10px;width:100%;'>"+
							"<span>Discription:-</span>"+response[current_question].solution+
						"</div>";
					}
					else
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>";
					}	
				}
				else
				{
					var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";	
				}
				
									
									$(data).appendTo($( "#option_div"));
			}
		}

		
});



//////////////////// get question by dierect button 


$(document).on('click',".question_button",function(e){

	$('#solution_div').css('display','none');
	$('#solution_div').appendTo($('#test_name'));

	$('.question_button').css('background-color','#fff');
	$(this).css('background-color','#ccc');
	current_question = $(this).data('question');
	$('#question_no').empty();
		$('#question_text').empty();
		$('#option_div').empty();
		$('#question_no').html('Question NO.'+(current_question+1));
						if(response[current_question].pretext != "")
						{
							$("<span>"+response[current_question].pretext+"</span><br>").appendTo( "#question_text" );	
						}
						if(response[current_question].pretext_image != "")
						{
							$("<span><img src='"+response[current_question].pretext_image+"' ></span><br>").appendTo( "#question_text" );		
						}
						if(response[current_question].q_img != "")
						{
							$("<span><img src='"+response[current_question].q_img+"' ></span><br>").appendTo( "#question_text" );			
						}
						//$('#question_text').html(response[0].q_text);
						$("<span>"+response[current_question].q_text+"</span>").appendTo( "#question_text" );
	   // $('#question_text').html(response[current_question].q_text);
	    if(response[current_question].status == '0')
	    {	
		    for(i=0;i<response[current_question].options.length;i++)
			{
				var data ="<div id='option"+(i+1)+"' class='form-control option' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";

									
									$(data).appendTo($( "#option_div"));
			}
		}
		else
		{
			for(i=0;i<response[current_question].options.length;i++)
			{
				if((i+1) == response[current_question].u_answer)
				{
					if(response[current_question].answer == response[current_question].u_answer)
					{
						if(response[current_question].solution !== '')
						{
							var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>"+
							"<div id='' style='position:relative;border:1px solid #ccc;display:;padding:10px;width:100%;'>"+
							"<span>Discription:-</span>"+response[current_question].solution+
						"</div>";
						}
						else
						{
							var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>";
						}
					}
					else
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#f00;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";
					}
				}
				else if((i+1) == response[current_question].answer)	
				{
					if(response[current_question].solution !== '')
					{
						var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>"+
							"<div id='solution_div' style='position:relative;border:1px solid #ccc;display:;padding:10px;width:100%;'>"+
							"<span>Discription:-</span>"+response[current_question].solution+
						"</div>";
					}
					else
					{
							var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;background-color:#0f0;'>"+
								""+response[current_question].options[i].option_text+""+
							"</div>";
					}		
				}
				else
				{
					var data ="<div id='option"+(i+1)+"' class='form-control' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
							""+response[current_question].options[i].option_text+""+
						"</div>";	
				}
				
									
									$(data).appendTo($( "#option_div"));
			}
		}
});






$(document).on('click',".daily_curren_gk_test_name",function(e){



	

	$('.daily_curren_gk_test_name').css('background-color','#fff');
	$(this).css("background-color","#eee");
	
		if ($(this).attr('data-testno') && $(this).attr('data-category'))
		{
			var str = $(this).text();
			str = str.trim();
			str = str.substring(7, str.length);
			var testno  = $(this).data('testno');
			var cat  = $(this).data('category');
			var date = $(this).data('date');
			console.log(date);
			$.ajax({
					  	type :'POST',
						url :global_namespace.baseurl+'client_requests/Bankpo/get_daily_test_question',
						data: {'testno':testno,'cat':cat},
						dataType: 'json',
						async:true,
						
						success:function(response1)
						{
							current_question = 0; 
							console.log(str);
							response = response1;

							$('#test_name').empty();
							$('#test_name').html('Daily test '+str);
							$('#solution_div').css('display','none');
							$('#solution_div').appendTo($('#test_name'));

							$('#question_no').empty();
							$('#question_text').empty();
							$('#option_div').empty();
							

							$('#question_pallet_button').empty();
							$('#question_no').html('Question NO.1');
							if(response[0].pretext != "")
							{
								$("<span>"+response[0].pretext+"</span><br>").appendTo( "#question_text" );	
							}
							if(response[0].pretext_image != "")
							{
								$("<span><img src='"+response[0].pretext_image+"' ></span><br>").appendTo( "#question_text" );		
							}
							if(response[0].q_img != "")
							{
								$("<span><img src='"+response[0].q_img+"' ></span><br>").appendTo( "#question_text" );			
							}
							//$('#question_text').html(response[0].q_text);
							$("<span>"+response[0].q_text+"</span>").appendTo( "#question_text" );

							for(i=0;i<response[0].options.length;i++)
							{
								var data ="<div id='option"+(i+1)+"' class='form-control option' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
											""+response[0].options[i].option_text+""+
										"</div>";

										
										$(data).appendTo($( "#option_div"));
							}

							for(i=0;i<response.length;i++)
							{
								if(i < 9)
								{
									var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;'>"+
													""+(i+1)+""+
												"</button>";
										$(data).appendTo($('#question_pallet_button'))	;
								}
								else
								{
									var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;padding:10px 11.5px;'>"+
													""+(i+1)+""+
												"</button>";
										$(data).appendTo($('#question_pallet_button'))	;	
								}		
							}
							
							$('#button1').css('background-color','#ccc');
						},
						error:function(jqXHR,textStatus,errorThrown)
						{
							console.log("Error:"+errorThrown,textStatus,jqXHR);
						}
				});	
			}
	else
	{
		var str = $(this).text();
		str = str.trim();
		str = str.substring((str.length-11),(str.length));
		var date = $(this).data('date');
			console.log(date);
			$.ajax({
					  	type :'POST',
						url :global_namespace.baseurl+'client_requests/Bankpo/get_daily_test_current_affaire_question',
						data: {"date":date},
						dataType: 'json',
						async:true,
						
						success:function(response1)
						{
							current_question = 0; 
							console.log(str);
							response = response1;

							$('#test_name').empty();
							$('#test_name').html('Daily Current GK Quiz '+str);
							$('#solution_div').css('display','none');
							$('#solution_div').appendTo($('#test_name'));

							$('#question_no').empty();
							$('#question_text').empty();
							$('#option_div').empty();
							

							$('#question_pallet_button').empty();
							$('#question_no').html('Question NO.1');
							$('#question_text').html(response[0].q_text);
							for(i=0;i<response[0].options.length;i++)
							{
								var data ="<div id='option"+(i+1)+"' class='form-control option' data-optionNo='"+(i+1)+"' style='margin-top:5px;cursor:pointer;'>"+
											""+response[0].options[i].option_text+""+
										"</div>";

										
										$(data).appendTo($( "#option_div"));
							}

							for(i=0;i<response.length;i++)
							{
								if(i < 9)
								{
									var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;'>"+
													""+(i+1)+""+
												"</button>";
										$(data).appendTo($('#question_pallet_button'))	;
								}
								else
								{
									var data =	"<button id='button"+(i+1)+"' class='btn btn-lg btn-default question_button' data-question='"+i+"' style='margin:5px;padding:10px 11.5px;'>"+
													""+(i+1)+""+
												"</button>";
										$(data).appendTo($('#question_pallet_button'))	;	
								}		
							}
							
							$('#button1').css('background-color','#ccc');
						},
						error:function(jqXHR,textStatus,errorThrown)
						{
							console.log("Error:"+errorThrown,textStatus,jqXHR);
						}
				});	
	}
});


$(document).ready(function(e){
	$(document).on('click','.option',function(e){
	 var option_no = $(this).data('optionno');
	 
	 response[current_question].u_answer = option_no;
	 response[current_question].status = "1";
	 $('.option').removeClass( "option" );
	 if(option_no == response[current_question].answer)
	 {
	 	console.log(option_no);
		$('#option'+option_no).css('background-color','#0f0');	 	
	 }
	 else
	 {
	 	console.log(response[current_question].answer);
	 	$('#option'+option_no).css('background-color','#f00');
	 	$('#option'+response[current_question].answer).css('background-color','#0f0');		
	 }
	 if(response[current_question].solution != "")
	 {
	 	$('#solution_div').empty();
	 	$('#solution_div').insertAfter( $("#option"+response[current_question].answer));
	 	$('#solution_div').html('<span style="font-weight:bold">Discription:- </span>'+response[current_question].solution);	
	 	 $( "#solution_div" ).slideDown( "slow",function(){
	 	 	$('.question_pannel').height(370);
	 	 	$('.question_pannel').height(380);
	 	 });
	 	 
	 }	
	 else if(response[current_question].solution_img != "")
	 {
	 	$('#solution_div').empty();
	 	$('#solution_div').insertAfter( $("#option"+response[current_question].answer));
	 	$('#solution_div').html('<span style="font-weight:bold">Discription:- </span> <img src="'+response[current_question].solution_img+'">');	
	 	 $( "#solution_div" ).slideDown( "slow",function(){
	 	 	 $('.question_pannel').height(370);
	 	 	$('.question_pannel').height(380);
	 	 });
	 	 
	 	
	 }

});	
})



</script>