	
<div class="row"  style="overflow:hidden;background-color:;margin:15px;">
	
	<!-- <div class="col-md-1" style="padding-left:0px;margin-top:35px;">
		
	</div> -->
	<div class="col-md-12" id="bankpo_home" >
	  <!--  <?php print_r($status);?> -->
	   	
	   	
		<div class="row " style="">

			<div class="col-md-7 " id="bank_test_container_scroll" style="height:100vx;overflow-y:auto;overflow-x:hidden;">
			<!-- <div class="nicescroll" style="height:900px; overflow:hidden;overflow-y:scroll; "> -->
					<div class="row">
			           <div class="col-sm-12" style="margin-bottom:20px">
					          <div id="advertisement" style="height:40px;width:100%;background-color:#fff;margin-top:10px;">
										<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
										<!-- Latest_add -->
										<ins class="adsbygoogle"
										     style="display:block"
										     data-ad-client="ca-pub-7116540457133316"
										     data-ad-slot="4977674380"
										     data-ad-format="auto"></ins>
										<script>
										(adsbygoogle = window.adsbygoogle || []).push({});
										</script>
								</div> 
				        </div>	
			        </div>	
			  

					<?php if(sizeof($status)>0){ ?>
						<?php $tempdate="";
						$page=$status[0]['page'];
						$allpage= (int)$status[0]['rows'];?>

						<?php  foreach($status as $index => $row): ?>
					
								<div class="row" style="margin-bottom:30px;margin-top:20px">
									<div class="col-md-12">
										<?php $year=substr($row['date'],0,4);
										$month=substr($row['date'],5,2);
										$day=substr($row['date'],8,2);
										$date=$row['date'];
									   /*echo $year;
									    echo $month;
									    echo $day;*/
									    if($month=='01')
									    {
									    $month1= 'January';	

									    }
									    else if($month=='02')
									    {
									    	$month1= 'February';		
									    }
									    else if($month=='03')
									    {
									    	$month1= 'March';	
									    }
									    else if($month=='04')
									    {
									    	$month1= 'April';	
									    }
									    else if($month=='05')
									    {
									    	$month1= 'May';	
									    }
									    else if($month=='06')
									    {
									    	$month1= 'June';	
									    }
									    else if($month=='07')
									    {
									    	$month1= 'July';	
									    }
									    else if($month=='08')
									    {
									    	$month1= 'August';	
									    }
									    else if($month=='09')
									    {
									    	$month1= 'September';	
									    }
									    else if($month=='10')
									    {
									    	$month1= 'October';	
									    }
									    else if($month=='11')
									    {
									    	$month1= 'November';	
									    }
									    else if($month=='12')
									    {
									    	$month1= 'December';	
									    }

									    ?>
										<?php if($tempdate != $day){ ?>
											<div class="row">
												<div class="col-md-12">
													<div style="margin-top:25px">
														<?=$day.'-'.$month1.'-'.$year; ?>	
													</div>
												</div>
											</div>
											<?php $tempdate = $day; }  ?>

											<div class="row">
												<div class="col-md-12" style="margin-top:20px;font-size:20px;font-weight:bold">
													<div style="font-size:24px;">
													<?=$row['heading']; ?>
													</div>
												</div>
												
											</div>
											<div class="row">
												<div class="col-md-12" style="margin-top:20px;font-size:20px;">
												     <img src="<?=$row['image']?>" class="image" width="200px;" style="float:right; margin-left:15px;">
													 <div style="text-align: justify;font-size:15px;">
																<?=$row['content']; ?>
												     </div>

												</div>
											</div>
									
											<?php if($row['category']== "1"){  ?>
												 
												<div class="row">
													<div class="col-md-12" style="margin-top:20px;font-size:20px;font-weight:bold">
														<div>
															<a href="<?=base_url('bankpo/current_affaires/'.$date.'5');?>"><div class="btn btn-sm btn-success">Read more</div></a>

														</div>
																
													</div>
												</div>
											
											<?php } else if ($row['category']== "2") { ?>
												<div class="row">
														<div class="col-md-12" style="margin-top:20px;font-size:20px;font-weight:bold">
															<div>
																<a href="<?=base_url('bankpo/daily_test_exam/current_affaire/'.$date);?>"><div class="btn btn-sm btn-success">Read more</div></a>
															</div>
														</div>
												</div>
											<?php } else if ($row['category']== "4") {  ?>
												<div class="row">
													<div class="col-md-12" style="margin-top:20px;font-size:20px;font-weight:bold">
														<div>
															<a href="<?=base_url('Blog/'.$row['lastid']);?>"><div class="btn btn-sm btn-success">Read more</div></a>
														</div>
													</div>
												</div>
											<?php } ?>
									</div>
											<?php if($index%3==0){ ?>
											<div class="row" style="margin-top:20px">
												<div class="col-md-12">
													<div id="advertisement" style="height:40px;width:100%;background-color:#fff;margin-top:10px;">
															<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
															<!-- examkabila -->
														<ins class="adsbygoogle"
														     style="display:block"
														     data-ad-client="ca-pub-7116540457133316"
														     data-ad-slot="5667411582"
														     data-ad-format="auto"></ins>
														<script>
														(adsbygoogle = window.adsbygoogle || []).push({});
														</script>
													</div> 
												</div>	
											</div>	
											<?php } ?>
							</div>
						<?php endforeach; ?>
						
							<div class="row">
								<div class="col-sm-12">
									<nav>
									  <ul class="pagination pagination-lg">
									    <!-- <li class="enabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li> -->
									   <?php for($i=1;$i<=$allpage;$i++){ ?>
									   <?php if($page==0){ ?>
									   <li class="active"><a href="<?=base_url('Bankpo/index/');?>"><span class="sr-only">(current)</span></a></li>
									    <?php } else if($page==$i){ ?>
									    <li class="active"><a href="<?=base_url('Bankpo/index/'.$i);?>"><?=$i ?> <span class="sr-only">(current)</span></a></li>
									    <?php } else { ?>
									    <li class=""><a href="<?=base_url('Bankpo/index/'.$i);?>"><?=$i ?><span class="sr-only">(current)</span></a></li>
									    <?php } ?>

									    
									      <?php } ?>
									        
									    
									    
									  </ul>
									</nav> 
							
								</div>
							</div>
					<?php } ?>
				<!-- </div> -->
				</div>


			
			<div class="col-md-5" style="height:100vx;">
			
				<div style="height:100vx;overflow-y:hidden;overflow-x:hidden;">
				<div class="row">
				<!-- <div class="col-md-3"></div> -->
				<?php if($this->session->userdata('is_logged_in')) { ?>
				  <div class="col-md-4">
					<a href="<?=base_url('bankpo/video')?>" style='color:#fff;'>
						<div class="form-control text-center" style="; margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Current Affairs Videos</blink>
						</div>
					</a>
                   </div>
                   <div class="col-md-4">
					<a href="<?=base_url()?>bankpo/daily_test_exam/current_affaire" style='color:#fff;'>
						<div class="form-control text-center" style="margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Current Affairs Quiz</blink>
						</div>
					</a>
                   </div>
                   <div class="col-md-4">
					<a href="<?=base_url()?>bankpo/navigationexam_portal" style='color:#fff;'>
						<div class="form-control text-center" style="; margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Online IBPS Exam Portal</blink>
						</div>
					</a>
                   </div>

                   <?php } else { ?>
                   <div class="col-md-4 not_logged_in">
					<!-- <a href="<?=base_url('bankpo/video')?>" style='color:#fff;'> -->
						<div class="form-control text-center" style="margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;cursor:pointer">
							<blink>Current Affairs Videos</blink>
						</div>
					</a>
                   </div>
                   <div class="col-md-4">
					<a href="<?=base_url()?>bankpo/daily_test_exam/current_affaire" style='color:#fff;'>
						<div class="form-control text-center" style="margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Current Affairs Quiz</blink>
						</div>
					</a>
                   </div>
                   <div class="col-md-4">
					<a href="<?=base_url()?>bankpo/navigationexam_portal" style='color:#fff;'>
						<div class="form-control text-center" style="; margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Online IBPS Exam Portal</blink>
						</div>
					</a>
                   </div>
                   <?php } ?>
                   <div class="col-md-3"></div>
				</div>
				 <div class="row">
				 <!-- <div class="col-md-6.5">
					<a href="<?=base_url()?>bankpo/daily_test_exam/current_affaire" style='color:#fff;'>
						<div class="form-control text-center" style="margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Daily CA Quiz</blink>
						</div>
					</a>
                   </div>
                    -->
                   <!-- <div class="col-md-5.5">
					<a href="<?=base_url()?>bankpo/navigationexam_portal" style='color:#fff;'>
						<div class="form-control text-center" style="; margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Online IBPS Exam Portal</blink>
						</div>
					</a>
                   </div> -->
				</div>
				<div class="row" style="margin-top:30px;">
					<div class="col-md-2"></div>
					<div class="col-md-8" style="height:250px;">
						
          <!-- <div class="fb-like" style="position:absolute;z-index:2000;" data-href="https://www.facebook.com/Exam-Kabila-786375854763781/timeline/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                <div id="fb-root"></div> -->
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FExam-Kabila-786375854763781%2F&width=340&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        
					</div>
				</div>
				     <div class="col-md-2"></div>

                                       <!--  <a href="https://play.google.com/store/apps/details?id=com.xercesblue.onlinebankexampo" target="blank">
						<div id="app_add" style="width:100%;height:60px;background-color:#999;">
						
						</div>
					</a> -->
					<div class="row">
			           <div class="col-sm-12 col-sm-12" style="margin-bottom:20px">
					          <div id="advertisement" style="height:400px;width:400px;background-color:#fff;margin-top:10px;">
										<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
										<!-- Latest_add -->
										<ins class="adsbygoogle"
										     style="display:block"
										     data-ad-client="ca-pub-7116540457133316"
										     data-ad-slot="4977674380"
										     data-ad-format="auto"></ins>
										<script>
										(adsbygoogle = window.adsbygoogle || []).push({});
										</script>
								</div> 
				        </div>	
			        </div>	
					       <div style="margin-top:5px;">
								<!-- <video id="examkabila_intro_video" onclick="videoplayPause()"  width="100%" controls style="cursor:pointer;">
								   <!-- <source src="<?=base_url()?>docs/videos/demo.mp4" type="video/mp4"> -->
								   <!-- <source src="https://www.youtube.com/watch?v=PaKtLxA1LD0" type="video/mp4"> 
								  </video>-->
								<iframe title="YouTube video player" class="youtube-player" type="text/html" 
								width="100%" height="300px"  src="https://www.youtube.com/embed/PaKtLxA1LD0?"
							frameborder="0" allowFullScreen="true"></iframe>
							</div>
					   
					<!-- 8L5PqL4ylIU
					https://www.youtube.com/watch?v=8L5PqL4ylIU
					https://www.youtube.com/embed/PaKtLxA1LD0 -->
						<div class="row" style="width:340;height:300">
						   <div class="col-md-12 col-sm-12">
							<div id="advertisement" style="height:40px;width:100%;background-color:#fff;margin-top:10px;">
										<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
										<!-- Latest_add -->
										<ins class="adsbygoogle"
										     style="display:block"
										     data-ad-client="ca-pub-7116540457133316"
										     data-ad-slot="4977674380"
										     data-ad-format="auto"></ins>
										<script>
										(adsbygoogle = window.adsbygoogle || []).push({});
										</script>
								</div> 
							</div>
					</div>
					<div class="row" style="margin-top:15px">
					    <div class="col-md-12">	
						 <div class="text-center" style="margin-top:10%;background-color:#7ADBF0;width:40%;padding:8px;color:#fff;font-size:130%">
						 	
						 	 Important PDF 

						 </div>
					 <div style="width:100%;height:1px;background-color:#7ADBF0;">
							
						</div>
					 <?php if($this->session->userdata('is_logged_in')) { ?>
					  <marquee scrollamount="2" direction="up" onmouseover="this.stop();" onmouseout="this.start();"><div  style="margin-top:5px;" id="ContainerImportantPDF">
                      <?php foreach($pd as $index => $row): ?>
                      	<div class="download_section " style="padding:3px 0px;cursor:pointer">
                      	<a href="<?=base_url()?>bankpo/importantpdf" >
                      	
						<div class="" style="color:#000;margin-top:3px;margin-left:5px">
							<?= $row['pdf_name']; ?>
						</div>
					    </a>
					    </div>
                      <?php endforeach; ?> 
						 
							
					 </div></marquee>
					 <?php } else {?>
					 					<marquee scrollamount="2" direction="up" onmouseover="this.stop();" onmouseout="this.start();"><div  style="margin-top:3px;" id="ContainerImportantPDF">
							                      <?php foreach($pd as $index => $row): ?>
							                      	<!-- <a href="<?=base_url()?>bankpo/importantpdf" style='color:#fff;'> -->
							                      	<div class="download_section not_logged_in" data-controller="Bankpo/importantpdf" style="padding:3px 0px;cursor:pointer" >
													<div class="" style="color:#000;margin-top:3px;margin-left:5px">
														<?= $row['pdf_name']; ?>
													</div>
												    </div>
							                      <?php endforeach; ?> 
						 
							
					 					</div></marquee>

					 			<?php } ?>
					 		</div>
					 	</div>	

                        <div class="row" style="margin-top:15px">
					    <div class="col-md-12">	
						 <div class="text-center" style="margin-top:10%;background-color:#7ADBF0;width:40%;padding:8px;color:#fff;font-size:130%">
						 	
						 	 Current Affairs PDF 

						 </div>
					 <div style="width:100%;height:1px;background-color:#7ADBF0;">
							
						</div>
					 <!-- <div style="height:300px"> -->
					  <marquee scrollamount="2" direction="up" onmouseover="this.stop();" onmouseout="this.start();"><div  style="margin-top:5px;height:150px;"  id="ContainerImportantPDF">
                      <?php foreach($gkpdf as $index => $row): ?>
                      	<div class="download_section " style="padding:3px 0px;cursor:pointer">
                      	<a href="<?=base_url()?>bankpo/bankinggkpdf" >
                      	<?php $count = $index+1; $price=20; 
					$year = substr($row['pdf_date'],0,4);
					$check = substr($row['pdf_date'],5);
					$month = "";
						if($check == '01')
						{
							$month = 'January';
						}
						else if($check == '02')
						{
							$month = 'February';
						}
						else if($check == '03')
						{
							$month = 'March';
						}
						else if($check == '04')
						{
							$month = 'April';
						}
						else if($check == '05')
						{
							$month = 'May';
						}
						else if($check == '06')
						{
							$month = 'June';
						}
						else if($check == '07')
						{
							$month = 'July';	
						}
						else if($check == '08')
						{
							$month = 'August';
						}
						else if($check == '09')
						{
							$month = 'September';	
						}
						else if($check == '10')
						{
							$month = 'October';
						}
						else if($check == '11')
						{
							$month = 'November';
						}
						else if($check == '12')
						{
							$month = 'December';
						}

					?>
						<div class="" style="color:#000;margin-top:3px;margin-left:5px">
							Current Affairs <?=$month?> <?=$year?>
						</div>
					    </a>
					    </div>
                      <?php endforeach; ?> 
					</div></marquee>
					 <!-- //</div> -->
					 		</div>
					 	</div>




					 			<!-- added by boney -->
					 			<?php for($i=0;$i<sizeof($allpage);$i++){ ?>
					 			<div class="row" style="margin-top:40px">
						            <div class="col-md-12 col-sm-12">

										 <div id="advertisement" style="height:400px;width:400px;background-color:#fff;margin-top:10px;">
													<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
														<!-- Latest_add -->
														<ins class="adsbygoogle"
														     style="display:block"
														     data-ad-client="ca-pub-7116540457133316"
														     data-ad-slot="4977674380"
														     data-ad-format="auto"></ins>
														<script>
														(adsbygoogle = window.adsbygoogle || []).push({});
														</script>
										</div> 
								    </div> 
							    </div> 	
							    <?php } ?>	
							<!-- end by boney -->

							
				</div>
				
			</div>
		</div>
		<!--<div class="row" style="background-color:#000;">
			
			<div class="col-md-2" style="background-color:#000;margin-left:-15px;color:#fff;font-weight:bold;">
				<div style="height:30px;" class="center_container text-center">
					<a href="<?=base_url()?>client_requests/examtest/seenexams" style="color:#fff;text-decoration:none;"><p class="center_content" style="position:relative;cursor:pointer;">examsrecord</p></a>
				</div>
			</div>
		</div> -->
		
		
	</div>
	<!-- <div class="col-md-1" style="margin-top:35px;">
                
	
	</div> -->
	
</div>

<div class="row" style="margin-top:10px;">
			<div class="col-xs-12 col-sm-12 col-md-12" style="height:200px;background-color:#7ADBF0" id="app_advt">
				
					<!--<div class="row">
						<div class="col-xs-6 text-center" style="line-height:1.2em;font-size:28px;color:#fff;padding-top:15px;padding-bottom:15px;">
							<span>Download our Mobile App</span><br>
							<span>for</span><br>
							<span>IBPS Banking Exams</span><br><br>
							
						</div>
						<div class="col-xs-6">
							
						</div>
						
					</div>-->
					<div class="row">
						<div class="col-xs-6" >
							
						</div>
						<div class="col-xs-3 text-center" >
							<a href="https://play.google.com/store/apps/details?id=com.xercesblue.onlinebankexampo" target="blank"><button type="button" class="btn btn-lg btn-warning"  style="margin-top:60px;">Download</button></a>
						</div>
						<div class="col-xs-3" >
							
						</div>
					</div>
			
				
			</div>
			
</div>