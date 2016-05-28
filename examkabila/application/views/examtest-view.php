<div id="loading_div" style="height:100%;width:100%;background-color:rgba(0,0,0,0.6);position:fixed;z-index:1200;text-align:center;"> <div style="color: #fff;margin-left:47vw;margin-top:47vh;" class="la-ball-clip-rotate la-3x">
  <div></div>
</div></div>
<div id="dialog-confirm" style="z-index:500;"></div>
<div id="virtual_result"  style=" width:450px; margin-left:31%; display:none;overflow:auto;padding:10px;border:1px solid black;"></div>
    <div class="container-fluid" id="main_window_div" style="height:100%">
  
		<div class="row">
			<?php if($this->session->userdata('section') == 'main'){ ?>
				<div id="Exam_Name_Header" 	class="col-xs-12">
					Online Bank Test Main
				</div>
			<?php } else { ?>
			
				<div id="Exam_Name_Header" 	class="col-xs-12">
					Online Bank Test Pre
				</div>
			<?php } ?> 
		</div>
		<div class="row" >
			<div class="col-md-9 col-sm-8 col-xs-8" >
				<div class="row" >
					<div class="col-xs-12" id="section_pannel">
						<div  id="disable_sections" style=" width:100%;height:50px; position:absolute;z-index:100;display:none;">
						</div>	
						<fieldset class="scheduler-border">
						    <legend class="scheduler-border">Sections</legend>
						    	<?php if($this->session->userdata('section') == 'main'){ ?>

								    <div class="row">
								    	<div class="col-xs-1">
								    		
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		<div id="Exam_Section_Reasoning" class="Exam_Section Exam_Section_after_click">
								    			Reasoning
								    		</div>	
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		<div id="Exam_Section_English" class="Exam_Section">
								    			English
								    		</div>	
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		<div id="Exam_Section_Math" class="Exam_Section">
								    			Math
								    		</div>
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		<div id="Exam_Section_General" class="Exam_Section">
								    			GK
								    		</div>
								    	</div>
								    	<div  class="col-xs-2 " style="padding-bottom:8px;">
								    		<div id="Exam_Section_Computer" class="Exam_Section">
								    			 Computer
								    		</div>
								    	</div>
								    	<div class="col-xs-1">
								    		
								    	</div>

								    	
								    </div>

								<?php } else { ?>
											
										 <div class="row">
								    	<div class="col-xs-1">
								    		
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		<div id="Exam_Section_Reasoning" class="Exam_Section Exam_Section_after_click">
								    			Reasoning
								    		</div>	
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		<div id="Exam_Section_English" class="Exam_Section">
								    			English
								    		</div>	
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		<div id="Exam_Section_Math" class="Exam_Section">
								    			Math
								    		</div>
								    	</div>
								    	<div  class="col-xs-2" style="padding-bottom:8px;">
								    		
								    	</div>
								    	<div  class="col-xs-2 " style="padding-bottom:8px;">
								    		
								    	</div>
								    	<div class="col-xs-1">
								    		
								    	</div>

								<?php } ?>    


						   
						</fieldset>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12" >
						<div id="Exam_Quetion_Show" style="height:78%; overflow-y:auto;overflow-x:hidden;">
							<div class="row">
								<div class="col-md-9 col-sm-8 col-xs-6" id="Exam_Quetion_Number" >
									Question.1
									
								</div>
								<div class="col-md-1 col-sm-1 col-xs-2 text-right" style="padding-right:0px;padding-top:7px;font-weight:bold;">
									View in:
								</div>
								<div class="col-md-2 col-sm-3 col-xs-4">
									<?php if($this->session->userdata('language') == 'hi') { ?>
										<select id="change_language" class="form-control">
											<option value="hi">hindi</option>
											<option value="en">english</option>
										</select>
									<?php } else { ?>
										<select id="change_language" class="form-control">
											<option value="en">english</option>
											<option value="hi">hindi</option>
										</select>
									<?php } ?>
								</div>
								<div class="col-xs-12 text-right" >
									<hr id="question_hr" color="#999999" style="height:1px;">
									 
								</div>
								
							</div>
							<div class="row">
								<div  class="col-xs-12" id="Exam_Quetion" style="padding-left:25px; padding-right:25px;padding-top:10px;">
									
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12" id="Exam_Option" style="margin-top:10px;padding-left:30px;">
									
								</div>
								
							</div>
						</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-xs-12" >
						<div id="save_next_button_container">
						
							<div class="row " style="margin-top:5px;margin-bottom:8px;">
							
								<div class="col-md-3 col-sm-4 col-xs-4" style="text-align:center;">
									
									<!--<input type="button" class="form-control" value="Mark for Review and Next" style=" background-color:#283a6e; color:#FFF; cursor:pointer;" id="next_question_button"  />	-->
										<div class="form-control" style=" background-color:#C7DCF0; border:2px solid #A9D0F5; color:#000; cursor:pointer;" id="next_question_button">Mark for Review</div>
									
								</div>
								<div class="col-md-3 col-sm-4 col-xs-4" style="text-align:center;">
								<!--	<input type="button" class="form-control"  value="Clear Response" style="background-color:#283a6e; color:#FFF;cursor:pointer;"  id="Clear_Response_button"/> -->
										<div class="form-control" style="background-color:#C7DCF0; border:2px solid #A9D0F5; color:#000;cursor:pointer;"  id="Clear_Response_button">Clear Response</div>
								</div>
								<div class="col-md-3 col-sm-0 col-sm-0" style="text-align:center;">
								
								</div>
								<div class="col-md-3 col-sm-4 col-xs-4" class="form-control" style="text-align:center;">
									<!--<input type="button" class="form-control"  value="Save and Next" style="background-color:#283a6e; color:#FFF; cursor:pointer;"id="Save_next_button" /> -->
									<div class="form-control" style="background-color:#3274B9; border:2px solid #A9D0F5; color:#FFF; cursor:pointer;" id="Save_next_button">Save and Next</div>
								</div>
								<div id = 'back_button'  style=" width:97%; background-color:white;border:solid 1px gray;position:absolute; bottom:1px; left:15;text-align:center; display:none;  padding:8px"> <input type='button' value='Back' onclick='question_paper_back()'style='height:30px;width:80px; cursor:pointer;'/> </div>
								<div id = 'exam_restart_exit_div' style="width:97%; background-color:white;border:solid 1px gray;position:absolute; bottom:1px; left:15;text-align:center; display:none;padding:8px"><a href="<?=base_url()?>client_requests/examtest/loadexamtestview" style="display:none;"> <input class='btn btn-sm' type='button' value='Restart exam' onclick="restart()" style='height:30px; cursor:pointer;padding:0px 3px; margin-right:40px;'/></a><input type='button' class="btn btn-sm" value='Exit' id="exit_button" style='height:30px;width:80px;  margin-right:40px;cursor:pointer;'/> <input style='' class='btn btn-sm' type='button' style='height:30px;' value='Back' id='detail_back_button'></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-4">
				<div class="row">
					<div class="col-xs-12" id="Exam_Time_Zone" style="text-align:center;">
						<div id="timer" style="margin:20px 0px;">
							2:30:00
						</div>
						
					</div>
					
				</div>
				<div class="row" >
					<div class="col-xs-12" id="Quetion_Pallete">
						<div id="disable_buttons" style="height:100%;width:100%;position:absolute;z-index:100;display:none;"></div>
						<div class="row">
							<div class="col-xs-12"  style="padding-left:0px;">
								<div id="Quetion_Pallete_Sectionname" style="background-color:#e4edf7">
									&nbsp;&nbsp;You are viewing <b> reasoning  </b>section
									<div style="margin-top:15px;margin-left:5px;">&nbsp;&nbsp; Question Palette </div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-left:0px;">
								<div id="Quetion_Pallete_Middle">
									
								</div>
								
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-left:0px;">
								<div id="Quetion_Pallete_Bottom" style="background-color:#e4edf7;">
									<div class="row">
										<div class="col-xs-12" style="font-weight:bold;">
											Legend
										</div>
									</div>	
									<div class="row">
										<div class="col-xs-6" >
											<input type="button" class="button_answered_style" style="margin-left:5%;" /><span style="margin-left:10%; font-size:11px;">Answered </span>
										</div>
										<div class="col-xs-6" >
											<input type="button" class="button_unanswered_style"  /><span style="margin-left:10%;font-size:11px;">Not Answered</span>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6" >
											<input type="button" class="button_marked_style" style="margin-left:5%;"  /><span style="margin-left:10%;font-size:11px;">Marked </span>
										</div>
										<div class="col-xs-6" >
											<input type="button" class="button_notvisited_style"  /><span style="margin-left:10%;font-size:11px;">Not Visited </span>
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-xs-6" >
											<button type="button" id="profile" title="view profile" class="btn btn-block btn-sm" style="background-color:#C7DCF0;color:#000;border:2px solid #A9D0F5;">profile </button>
										</div>
										<div class="col-xs-6" >	
											<button type="button" id="instruction" title="view instructins" class="btn btn-block btn-sm" style="background-color:#C7DCF0;color:#000;border:2px solid #A9D0F5;">Instruction</button>
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-xs-6" >
											<button type="button" id="question_paper" title="entire question paper" class="btn btn-block btn-sm" style="background-color:#C7DCF0;color:#000;border:2px solid #A9D0F5;">Questions </button>
										</div>
										<div class="col-xs-6" >
											<button type="button" id="submit" onclick="submit_function()" title="click to submit" class="btn btn-block btn-sm" style="background-color:#C7DCF0;color:#000; border:2px solid #A9D0F5;">Submit </button>
										</div>
									</div>

								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		 <div id="instruction_english_container" style="width:100%; height:98%;border:solid 1px #999999; padding-right:15px;display:none; position:relative;"> 
                <div style="width:100%; height:93%; overflow:hidden; overflow:auto; margin-left:5px; margin-top:10px;margin-bottom:10px; ">
              
                    <div style="font-weight:bold; text-align:center"> 
                        Please read the following instruction carefully 
                     </div><br />
                    <div style="font-weight:bold; text-decoration:underline">
                                General Instruction:
                    </div><br />
                    <div>
                                <ol start="1">
                                    <li>Total of 2 hour and 30 minutes duration will be given to attempt all the question.</li>
                                    <li>The clock has been set at the server and the countdown timer at the top right corner of your screen will 
                                        display the time remaining for you to complete the exam. When the clock runs out the exam ends by default
                                        - you are not requered to end or submit your exam.</li>
                                    <li>The question palette at the right of screen shows one of the following statues of each of the question numbered:
                                        <ul class="no_bullet">
                                            <li class="not_answered">You have not answered the question</li>
                                            <li class="answered_save">You have answered the question.</li>
                                            <li class="not_answere_marked">You have NOT answered the question but have marked the question for review.</li>
                                            <li class="answere_marked">You have answere the question but marked it for review.</li><br />
                                            <li>The Marked for Review status simply acts as a reminder that you have set to look at the question again.<span style="color:#F00;">
                                                If an answer is selected for a question that is Marked for Review. the answer will be considered in the final evalution.</li>
                                        </ul> 
                                    </li>
                          
                                </ol>
                    </div>
                     <div style="font-weight:bold;text-decoration:underline;"> Navigating to a question:</div><br />
                  
                           <ol start="4">
                                <li>To select a question to answer,you can do one of the followin:
                                        <ol type="a"><br />
                                                <li>Click on the question number on the question palette at the right of your screen to go to that numbered question directly.
                                                    Note that using this option does NOT save your answer to the current question.
                                                </li>
                                                <li>Click on Save and Next to save answer to current question and to go to next question in sequence.</li>
                                                <li>Click on Mark for Review and Next to save answer to current question, mark it for review, and to go to the next question in 
                                                    sequence.
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>You can view the entire paper by clicking on the Question Paper button</li>
                           </ol> <br />
                                      
                    <div style="font-weight:bold;text-decoration:underline;"> Answering questions:</div><br />
                            
                    <ol start="6">
                                <li>For multiple choice type question:
                                        <ol type="a">
                                                <li>
                                                    To select your answer. click on one of the option buttons
                                                </li>
                                                <li>
                                                    To change your answer. click the another desired option button
                                                </li>
                                                <li>
                                                    To save your answer. You must click on <span style="font-weight:bold">Save & Next</span>
                                                </li>
                                                <li>
                                                    To deselect a chosen answer. click on the chosen option again or click on the <span style="font-weight:bold">Clear Response</span>button.
                                                </li>
                                                 <li>
                                                    To mark a question for review click on<span style="font-weight:bold">Mark for Review & Next</span>.<span style="color:#F00;">
                                                    If an answer is selected for a question that is Marked for Review, the answer will be considered in the final evaluation.</span>
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>To change an answer to a question. first select the question and then click on the new answer option followed by a click on the <span style="font-weight:bold">Save & Next</span>button.</li>
                                <li>Question that are saved or marked for review after answering will ONLY be considered for evaluation.</li>
                           </ol> <br />   
                           
                          <div style="font-weight:bold;text-decoration:underline;"> Navigating through sections:</div><br />
                          <ol start="9">
                                <li> 
                                    sections in this question paper are displayed on the top bar of the screen. Question in a section can be viewed by clicking on the
                                    section name. The section you are currently viewing is highlighted.
                                </li>
                                    
                                <li>
                                    After clicking the <span style="font-weight:bold">Save & Next</span> button on the last question for a section, you will automatically be taken
                                    to the first question of the next section.
                                <li>
                                    You can move the mouse cursor over the section names to view the status of the question for that section.
                                </li>
                                <li>
                                    You can shuffle between sections and questions anytime during the examination as per your convenience.
                                </li>
                                
                                </li>
                          
                          </ol>
                  </div>
           
               </div> 




                <div id="instruction_english_container_pre" style="width:100%; height:98%;border:solid 1px #999999; padding-right:15px;display:none; position:relative;"> 
                <div style="width:100%; height:93%; overflow:hidden; overflow:auto; margin-left:5px; margin-top:10px;margin-bottom:10px; ">
              
                    <div style="font-weight:bold; text-align:center"> 
                        Please read the following instruction carefully 
                     </div><br />
                    <div style="font-weight:bold; text-decoration:underline">
                                General Instruction:
                    </div><br />
                    <div>
                                <ol start="1">
                                    <li>Total of 1 hour and 30 minutes duration will be given to attempt all the question.</li>
                                    <li>The clock has been set at the server and the countdown timer at the top right corner of your screen will 
                                        display the time remaining for you to complete the exam. When the clock runs out the exam ends by default
                                        - you are not requered to end or submit your exam.</li>
                                    <li>The question palette at the right of screen shows one of the following statues of each of the question numbered:
                                        <ul class="no_bullet">
                                            <li class="not_answered">You have not answered the question</li>
                                            <li class="answered_save">You have answered the question.</li>
                                            <li class="not_answere_marked">You have NOT answered the question but have marked the question for review.</li>
                                            <li class="answere_marked">You have answere the question but marked it for review.</li><br />
                                            <li>The Marked for Review status simply acts as a reminder that you have set to look at the question again.<span style="color:#F00;">
                                                If an answer is selected for a question that is Marked for Review. the answer will be considered in the final evalution.</li>
                                        </ul> 
                                    </li>
                          
                                </ol>
                    </div>
                     <div style="font-weight:bold;text-decoration:underline;"> Navigating to a question:</div><br />
                  
                           <ol start="4">
                                <li>To select a question to answer,you can do one of the followin:
                                        <ol type="a"><br />
                                                <li>Click on the question number on the question palette at the right of your screen to go to that numbered question directly.
                                                    Note that using this option does NOT save your answer to the current question.
                                                </li>
                                                <li>Click on Save and Next to save answer to current question and to go to next question in sequence.</li>
                                                <li>Click on Mark for Review and Next to save answer to current question, mark it for review, and to go to the next question in 
                                                    sequence.
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>You can view the entire paper by clicking on the Question Paper button</li>
                           </ol> <br />
                                      
                    <div style="font-weight:bold;text-decoration:underline;"> Answering questions:</div><br />
                            
                    <ol start="6">
                                <li>For multiple choice type question:
                                        <ol type="a">
                                                <li>
                                                    To select your answer. click on one of the option buttons
                                                </li>
                                                <li>
                                                    To change your answer. click the another desired option button
                                                </li>
                                                <li>
                                                    To save your answer. You must click on <span style="font-weight:bold">Save & Next</span>
                                                </li>
                                                <li>
                                                    To deselect a chosen answer. click on the chosen option again or click on the <span style="font-weight:bold">Clear Response</span>button.
                                                </li>
                                                 <li>
                                                    To mark a question for review click on<span style="font-weight:bold">Mark for Review & Next</span>.<span style="color:#F00;">
                                                    If an answer is selected for a question that is Marked for Review, the answer will be considered in the final evaluation.</span>
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>To change an answer to a question. first select the question and then click on the new answer option followed by a click on the <span style="font-weight:bold">Save & Next</span>button.</li>
                                <li>Question that are saved or marked for review after answering will ONLY be considered for evaluation.</li>
                           </ol> <br />   
                           
                          <div style="font-weight:bold;text-decoration:underline;"> Navigating through sections:</div><br />
                          <ol start="9">
                                <li> 
                                    sections in this question paper are displayed on the top bar of the screen. Question in a section can be viewed by clicking on the
                                    section name. The section you are currently viewing is highlighted.
                                </li>
                                    
                                <li>
                                    After clicking the <span style="font-weight:bold">Save & Next</span> button on the last question for a section, you will automatically be taken
                                    to the first question of the next section.
                                <li>
                                    You can move the mouse cursor over the section names to view the status of the question for that section.
                                </li>
                                <li>
                                    You can shuffle between sections and questions anytime during the examination as per your convenience.
                                </li>
                                
                                </li>
                          
                          </ol>
                  </div>
           
               </div> 







               <div id="instruction_hindi_container" style="width:100%; height:98%;border:solid 1px #999999; padding-right:15px;position:relative; display:none;"> 
                    <div style="width:100%; height:93%; overflow:hidden; overflow:auto; margin-left:5px; margin-top:10px;margin-bottom:10px; ">
              
                    <div style="font-weight:bold; text-align:center"> 
                        कृपया निम्नलिखित निर्देशो को ध्यान से पढे 
                     </div><br />
                    <div style="font-weight:bold; text-decoration:underline">
                                सामान्य अनुदेश:
                    </div><br />
                    <div>
                                <ol start="1">
                                    <li>सभी प्रश्नो को हल करने के लिए आपको 2 घंटे और 30 मिनट का समय दिया जाएगा।</li>
                                    <li>सर्वर पर घडी लगाई गई है तथा आपकी स्क्रीन के दाहिने कोने मे शीर्श पर काउटडाउन टाइमर मे आपके लिए परीक्षा समाप्त करने के लिए शेश समय प्रदर्शित होगा । परीक्षा समय समाप्त होने पर, आपको अपनी परीक्षा बन्द या जमा करने की जरुरत नही है । यह स्वतः बन्द या जमा हो जाएगी ।</li>
                                    <li>स्क्रीन के दाहीने कोने पर प्रश्न पैलेट, नम्बर दिए प्रत्येक प्रश्न के लिए निम्न मे से कोई एक स्थिति प्रकट करती है :
                                        <ul class="no_bullet">
                                            <li class="not_answered">आपने प्रश्न का उत्तर नही दिया है ।</li>
                                            <li class="answered_save">आप प्रश्न का उत्तर दे चुके है ।</li>
                                            <li class="not_answere_marked">आपने प्रश्न का उत्तर नही दिया है पर प्रश्न को पुनर्विचार के लिए चिन्हित किया है ।</li>
                                            <li class="answere_marked">आपने प्रश्न का उत्तर दे चुके है पर प्रश्न को पुनर्विचार के लिए चिन्हित किया है ।</li><br />
                                            <li>पुनर्विचार के लिए चिन्हित स्थिति सामान्यत अनुस्मारक के रुप मे कार्य करती है जोकि आपने प्रश्न को दुबारा देखने के लिए सेट किया है ।<span style="color:#F00;">
                                                यदि किसी प्रश्न के उत्तर चुना हो जोकि पुनर्विचार के लिए चिन्हित किया है, तब अन्तिम मूल्याकन मे उस उत्तर पर ध्यान दिया जाएगा।</li>
                                        </ul> 
                                    </li>
                          
                                </ol>
                    </div>
                     <div style="font-weight:bold;text-decoration:underline;"> किसी प्रश्न पर जाना:</div><br />
                  
                           <ol start="4">
                                <li>उत्तर देने हेतु कोई प्रश्न चुनने के लिए,आप निम्न मे से कोई एक कार्य कर सकते है:
                                        <ol type="a"><br />
                                                <li>
                                                  स्क्रीन के दायी ओर प्रश्न पटिट्का मे प्रश्न पर सीधे जाने के लिए प्रश्न सन्ख्या पर क्लिक करे । ध्यान दे कि इस विकल्प का प्रयोग करने से मौजुदा प्रश्न के लिए आपका उत्तर सुरक्षित नही होता है ।
                                                </li>
                                                <li>
                                                  वर्तमान प्रश्न का उत्तर सुरक्षित करने के लिए और क्रम मे अगले प्रश्न पर जाने के लिए<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Save & Next</span>पर क्लिक करे ।
                                                </li>
                                                <li>
                                                  वर्तमान प्रश्न का उत्तर सुरक्षित करने के लिए,पुनर्विचार के लिए चिन्हित करने और क्रम मे अगले प्रश्न पर जाने के लिए<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Mark for Review & Next</span>पर क्लिक करे । 
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>आप<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Question Paper</span>बटन पर क्लिक करके स्ंपूर्ण प्रश्नपत्र को देख सकते है । </li>
                           </ol> <br />
                                      
                    <div style="font-weight:bold;text-decoration:underline;">प्रश्नों का उत्तर देना:</div><br />
                            
                    <ol start="6">
                                <li>बहुविकल्प प्रकार प्रश्न के लिए:
                                
                                        <ol type="a">
                                                <li>
                                                   अपना उत्तर चुनने के लिए,विकल्प बटनो मे से किसी एक पर क्लिक करे ।
                                                </li>
                                                <li>
                                                    अपना उत्तर बदलने के लिए, अन्य वान्छित विकल्प बटन पर क्लिक करे ।
                                                </li>
                                                <li>
                                                    अपना उत्तर सुरक्षित करने के लिए, आपको <span style="font-weight:bold;padding-left:8px;padding-right:8px;"> Save & Next </span>पर क्लिक करना जरुरी है ।
                                                </li>
                                                <li>
                                                   चयनित उत्तर को अचयनित करने के लिए <span style="font-weight:bold;padding-left:8px;padding-right:8px;">Clear Response</span>बटन पर क्लिक करे ।
                                                </li>
                                                 <li>
                                                    किसी प्रश्न को पुनर्विचार के लिए चिन्हित करने हेतु<span style="font-weight:bold;padding-left:8px;padding-right:8px;;"> Mark for Review & Next </span>पर क्लिक करे ।<span style="color:#F00;">
                                                   यदि किसी प्रश्न के लिए उत्तर चुना हो जोकि पुनर्विचार के लिए चिन्हित किया है, तब अंतिम मूल्यांकन मे उस उत्तर पर ध्यान दिया जाएगा ।</span>
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>किसी प्रकार का उत्तर बदलने के लिए,पहले प्रश्न का चयन करे,फिर नए उत्तर विकल्प पर क्लिक करने के बाद्<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Save & Next</span>बटन पर क्लिक करे ।</li>
                                <li>उत्तर देने के बाद जो प्रश्न सुरक्षित है या पुनर्विचार के लिए चिन्हित है,सिर्फ उन पर ही मूल्यांकन के लिए ध्यान दिया जएगा ।</li>
                           </ol> <br />   
                           
                          <div style="font-weight:bold;text-decoration:underline;"> खंडो द्वारा प्रश्न पर जाना:</div><br />
                          <ol start="9">
                                <li> 
                                    इस प्रश्नपत्र मे स्क्रीन के शिर्श बार पर खंड प्रदर्शित होते है । किसी खंड मे प्रश्न, खंड नाम पर क्लिक करके देखे जा सकते है । आप वर्तमान मे जिस खंड का उत्तर दे रहें है , वह प्रकाशमान होगा।
                                </li>
                                    
                                <li>
                                    किसी खंड के लिए अंतिम प्रश्न के<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Save & Next</span>बटन पर क्लिक करने के बाद, आप स्वचालित रुप से अगले खंड के प्रथम प्रश्न पर पहुंच जाओगे ।
                                <li>
                                   आप उस खंड के लिए प्रश्नो की स्थिति को देखने के लिए खंड नाम के ऊपर माऊस मूव कर सकते हो ।
                                </li>
                                <li>
                                   आप परीक्षा के दौरान किसी भी समय खंडो और प्रश्नो के बीच अपनी सुविधा के अनुसार फेरबदल कर सकते हो ।
                                </li>
                                
                                </li>
                          
                          </ol>
                    </div>
           
                </div>   



                <div id="instruction_hindi_container_pre" style="width:100%; height:98%;border:solid 1px #999999; padding-right:15px;position:relative; display:none;"> 
                    <div style="width:100%; height:93%; overflow:hidden; overflow:auto; margin-left:5px; margin-top:10px;margin-bottom:10px; ">
              
                    <div style="font-weight:bold; text-align:center"> 
                        कृपया निम्नलिखित निर्देशो को ध्यान से पढे 
                     </div><br />
                    <div style="font-weight:bold; text-decoration:underline">
                                सामान्य अनुदेश:
                    </div><br />
                    <div>
                                <ol start="1">
                                    <li>सभी प्रश्नो को हल करने के लिए आपको 1 घंटे और 30 मिनट का समय दिया जाएगा।</li>
                                    <li>सर्वर पर घडी लगाई गई है तथा आपकी स्क्रीन के दाहिने कोने मे शीर्श पर काउटडाउन टाइमर मे आपके लिए परीक्षा समाप्त करने के लिए शेश समय प्रदर्शित होगा । परीक्षा समय समाप्त होने पर, आपको अपनी परीक्षा बन्द या जमा करने की जरुरत नही है । यह स्वतः बन्द या जमा हो जाएगी ।</li>
                                    <li>स्क्रीन के दाहीने कोने पर प्रश्न पैलेट, नम्बर दिए प्रत्येक प्रश्न के लिए निम्न मे से कोई एक स्थिति प्रकट करती है :
                                        <ul class="no_bullet">
                                            <li class="not_answered">आपने प्रश्न का उत्तर नही दिया है ।</li>
                                            <li class="answered_save">आप प्रश्न का उत्तर दे चुके है ।</li>
                                            <li class="not_answere_marked">आपने प्रश्न का उत्तर नही दिया है पर प्रश्न को पुनर्विचार के लिए चिन्हित किया है ।</li>
                                            <li class="answere_marked">आपने प्रश्न का उत्तर दे चुके है पर प्रश्न को पुनर्विचार के लिए चिन्हित किया है ।</li><br />
                                            <li>पुनर्विचार के लिए चिन्हित स्थिति सामान्यत अनुस्मारक के रुप मे कार्य करती है जोकि आपने प्रश्न को दुबारा देखने के लिए सेट किया है ।<span style="color:#F00;">
                                                यदि किसी प्रश्न के उत्तर चुना हो जोकि पुनर्विचार के लिए चिन्हित किया है, तब अन्तिम मूल्याकन मे उस उत्तर पर ध्यान दिया जाएगा।</li>
                                        </ul> 
                                    </li>
                          
                                </ol>
                    </div>
                     <div style="font-weight:bold;text-decoration:underline;"> किसी प्रश्न पर जाना:</div><br />
                  
                           <ol start="4">
                                <li>उत्तर देने हेतु कोई प्रश्न चुनने के लिए,आप निम्न मे से कोई एक कार्य कर सकते है:
                                        <ol type="a"><br />
                                                <li>
                                                  स्क्रीन के दायी ओर प्रश्न पटिट्का मे प्रश्न पर सीधे जाने के लिए प्रश्न सन्ख्या पर क्लिक करे । ध्यान दे कि इस विकल्प का प्रयोग करने से मौजुदा प्रश्न के लिए आपका उत्तर सुरक्षित नही होता है ।
                                                </li>
                                                <li>
                                                  वर्तमान प्रश्न का उत्तर सुरक्षित करने के लिए और क्रम मे अगले प्रश्न पर जाने के लिए<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Save & Next</span>पर क्लिक करे ।
                                                </li>
                                                <li>
                                                  वर्तमान प्रश्न का उत्तर सुरक्षित करने के लिए,पुनर्विचार के लिए चिन्हित करने और क्रम मे अगले प्रश्न पर जाने के लिए<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Mark for Review & Next</span>पर क्लिक करे । 
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>आप<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Question Paper</span>बटन पर क्लिक करके स्ंपूर्ण प्रश्नपत्र को देख सकते है । </li>
                           </ol> <br />
                                      
                    <div style="font-weight:bold;text-decoration:underline;">प्रश्नों का उत्तर देना:</div><br />
                            
                    <ol start="6">
                                <li>बहुविकल्प प्रकार प्रश्न के लिए:
                                
                                        <ol type="a">
                                                <li>
                                                   अपना उत्तर चुनने के लिए,विकल्प बटनो मे से किसी एक पर क्लिक करे ।
                                                </li>
                                                <li>
                                                    अपना उत्तर बदलने के लिए, अन्य वान्छित विकल्प बटन पर क्लिक करे ।
                                                </li>
                                                <li>
                                                    अपना उत्तर सुरक्षित करने के लिए, आपको <span style="font-weight:bold;padding-left:8px;padding-right:8px;"> Save & Next </span>पर क्लिक करना जरुरी है ।
                                                </li>
                                                <li>
                                                   चयनित उत्तर को अचयनित करने के लिए <span style="font-weight:bold;padding-left:8px;padding-right:8px;">Clear Response</span>बटन पर क्लिक करे ।
                                                </li>
                                                 <li>
                                                    किसी प्रश्न को पुनर्विचार के लिए चिन्हित करने हेतु<span style="font-weight:bold;padding-left:8px;padding-right:8px;;"> Mark for Review & Next </span>पर क्लिक करे ।<span style="color:#F00;">
                                                   यदि किसी प्रश्न के लिए उत्तर चुना हो जोकि पुनर्विचार के लिए चिन्हित किया है, तब अंतिम मूल्यांकन मे उस उत्तर पर ध्यान दिया जाएगा ।</span>
                                                </li>
                                        </ol>
                                
                                </li>
                                <li>किसी प्रकार का उत्तर बदलने के लिए,पहले प्रश्न का चयन करे,फिर नए उत्तर विकल्प पर क्लिक करने के बाद्<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Save & Next</span>बटन पर क्लिक करे ।</li>
                                <li>उत्तर देने के बाद जो प्रश्न सुरक्षित है या पुनर्विचार के लिए चिन्हित है,सिर्फ उन पर ही मूल्यांकन के लिए ध्यान दिया जएगा ।</li>
                           </ol> <br />   
                           
                          <div style="font-weight:bold;text-decoration:underline;"> खंडो द्वारा प्रश्न पर जाना:</div><br />
                          <ol start="9">
                                <li> 
                                    इस प्रश्नपत्र मे स्क्रीन के शिर्श बार पर खंड प्रदर्शित होते है । किसी खंड मे प्रश्न, खंड नाम पर क्लिक करके देखे जा सकते है । आप वर्तमान मे जिस खंड का उत्तर दे रहें है , वह प्रकाशमान होगा।
                                </li>
                                    
                                <li>
                                    किसी खंड के लिए अंतिम प्रश्न के<span style="font-weight:bold;padding-left:8px;padding-right:8px;">Save & Next</span>बटन पर क्लिक करने के बाद, आप स्वचालित रुप से अगले खंड के प्रथम प्रश्न पर पहुंच जाओगे ।
                                <li>
                                   आप उस खंड के लिए प्रश्नो की स्थिति को देखने के लिए खंड नाम के ऊपर माऊस मूव कर सकते हो ।
                                </li>
                                <li>
                                   आप परीक्षा के दौरान किसी भी समय खंडो और प्रश्नो के बीच अपनी सुविधा के अनुसार फेरबदल कर सकते हो ।
                                </li>
                                
                                </li>
                          
                          </ol>
                    </div>
           
                </div>   
	</div>
	