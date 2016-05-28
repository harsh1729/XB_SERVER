<script type="text/javascript">
var pre_exam_button_id;
var question_data;
$('#menu_container').css("display","block");

$(document).on("click",".seenexam",function(e){
	$('#loading_div').css("display","block");
	$('#'+pre_exam_button_id).css('background-color','#E21A10');
	exam_id = this.id;
	exam_no = parseInt(exam_id.substring(4, exam_id.length));
	language = $(this).attr('data-language');
	$('#'+exam_id).css('background-color',"#7BB635");
	pre_exam_button_id = exam_id;
	$('#question_detail').css("display","none");
	var a = $('#question_detail');
	$('#question_detail_container').append(a);

	
	$.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/get_seenexams_question',
				data:{"exam_no":exam_no,"language":language},
				dataType: 'json',
				async:true,
				
				success:function(response)
				{
					$('#loading_div').css("display","none");
					question_data=response;
					console.log("seen question status ",response);
					
						$('#seenquestion_container').empty();

						for(i=0;i<response.length;i++)
						{
							if(response[i].answer == '-1')
							{
								var singleq_no_answer = "<div class='row'>"+
										"<div class='col-md-12'  style='padding:right; color:#fff;margin-top:5px;'>"+
											"<div class='' data-language='' id='ques_container"+i+"' style='background-color:#999;height:30px;width:100%;padding-top:4px;padding-bottom:4px;'>"+
												"<div class='text-center' style='float:left;width:11%;padding:2px;' >"+
													"<div style='height:20px;width:20px;background-color:#fff;border-radius:10px;align:center;margin-left:5px;padding:7px;'>"+
														
													"</div>"+
												"</div>"+
												"<span>Q."+(i+1)+" &nbsp;&nbsp;</span>"+
												"<span>"+response[i].question.substring(0,50)+"....</span>"+
												"<div style='float:right;margin-right:5px;'> <button type='button' id='detail"+i+"' class='show_detail_button btn btn-xs btn-info' >Detail</button></div>"+
												
											"</div>"+
						
										"</div>"+
									"</div>";	
									$('#seenquestion_container').append(singleq_no_answer);
							}
							else if(response[i].correctopt == response[i].answer)
							{
								var singleq_right = "<div class='row'>"+
										"<div class='col-md-12'  style='padding:right; color:#fff;margin-top:5px;'>"+
											"<div class='' data-language='' id='ques_container"+i+"' style='background-color:#999;height:30px;width:100%;padding-top:4px;padding-bottom:4px;'>"+
												"<div class='text-center' style='float:left;width:11%;padding:2px;' >"+
													"<div style='height:20px;width:20px;background-color:#fff;border-radius:10px;align:center;margin-left:5px;padding:7px;'>"+
														"<div style='height:6px;width:6px;background-color:#0f0;border-radius:3px;align:center;'></div>"+
													"</div>"+
												"</div>"+
												"<span>Q."+(i+1)+" &nbsp;&nbsp;</span>"+
												"<span>"+response[i].question.substring(0,50)+"....</span>"+
												"<div style='float:right;margin-right:5px;'> <button type='button' id='detail"+i+"' class='show_detail_button btn btn-xs btn-info' >Detail</button></div>"+
												
											"</div>"+
						
										"</div>"+
									"</div>";	
									$('#seenquestion_container').append(singleq_right);
							}
							else
							{
								var singleq_wrong = "<div class='row'>"+
										"<div class='col-md-12'  style='padding:right; color:#fff;margin-top:5px;'>"+
											"<div class='' data-language='' id='ques_container"+i+"' style='background-color:#999;height:30px;width:100%;padding-top:4px;padding-bottom:4px;'>"+
												"<div class='text-center' style='float:left;width:11%;padding:2px;' >"+
													"<div style='height:20px;width:20px;background-color:#fff;border-radius:10px;align:center;margin-left:5px;padding:7px;'>"+
														"<div  style='height:6px;width:6px;background-color:#f00;border-radius:3px;align:center;'></div>"+
													"</div>"+
												"</div>"+
												"<span>Q."+(i+1)+" &nbsp;&nbsp;</span>"+
												"<span>"+response[i].question.substring(0,50)+"....</span>"+
												"<div style='float:right;margin-right:5px;'> <button type='button'  id='detail"+i+"' class='show_detail_button btn btn-xs btn-info' >Detail</button></div>"+
												
												
												
											"</div>"+
						
										"</div>"+
									"</div>";
									$('#seenquestion_container').append(singleq_wrong);
									
							}	

						}					
										
					
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					$('#loading_div').css("display","none");
					console.log("Error:",errorThrown,jqXHR,textStatus);
				}
	});
});

var pre_show_detail= -1;
$(document).on("click",".show_detail_button",function(e){

	
	var question_no = parseInt(this.id.substring(6, this.id.length));
	if(pre_show_detail == question_no)
	{
		
		$( "#question_detail" ).slideUp( "slow", function() {
    		var a = $('#question_detail');
			$('#question_detail_container').append(a);
			pre_show_detail= -1;
		
  		});
	}	
	else
	{
		
		$( "#question_detail" ).css("display","none");
		if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg == "")   
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}
		else if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg == "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg == "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg == "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image == "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg == "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg == "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img == "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"</div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg == "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img == "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg == "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}

		else if(question_data[question_no].pretext_image != "" && question_data[question_no].solution_img != "" && question_data[question_no].q_img != "" && question_data[question_no].option[0].optimg != "")
		{
			var s ="<div style='color:#000;padding:7px;'>"+
					"<div style='float:left;font-weight:bold'>Ques:</div>"+
					"<div style='margin-left:55px;'><img src='"+question_data[question_no].pretext_image+"'>"+question_data[question_no].question+"<img src='"+question_data[question_no].q_img+"'></div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>answer:</div>"+
					"<div style='margin-left:60px;'><img src='"+question_data[question_no].option[0].optimg+"'>"+question_data[question_no].option[0].opttext+"</div>"+
					"<br><br>"+
					"<div style='float:left;font-weight:bold'>sol:</div>"+
					"<div style='margin-left:55px;'>"+question_data[question_no].solution+"<img src='"+question_data[question_no].solution_img+"'></div>"+
				"</div>";	
		}
		$( "#question_detail" ).empty();
			$( "#question_detail" ).html(s);
		$( "#question_detail" ).insertAfter( "#ques_container"+question_no );
		//$( "#question_detail" ).css("display","block");
		$( "#question_detail" ).slideDown( "slow" );
		pre_show_detail = question_no;
	}
});
$('#loading_div').css("display","none");
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67214090-1', 'auto');
  ga('send', 'pageview');

</script>