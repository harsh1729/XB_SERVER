	
<div class="row" style="overflow:hidden;background-color:;">
	
	<div class="col-md-1" style="padding-left:0px;margin-top:35px;">
		
	</div>
	<div class="col-md-11" id="bankpo_home" style="margin-top:35px;">
	   
		<div class="row">
			<div class="col-md-7 nicescroll" id="bank_test_container_scroll" style="height:100vx;overflow-y:auto;overflow-x:hidden;">
				<!--<center><div style="width:100%;color:#fff;padding:5px;font-size:20px;background-color:#E21A10;">
					Practice Sets
				</div></center>-->
				 <div id="bank_test_container">
					<?php if($this->session->userdata('is_logged_in')){ ?>
							<?php  foreach($data as $index => $row): ?>
								 <?php $count = $index+1; $price=20;?>
								<?php if($row['pay_type'] == 1 &&  $row['item_id'] == $row['set_info_id'] && $row['seen_set_id'] == $row['set_info_id']){ ;?>
									<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<?php if($row['isactive_pre'] == 0) {  ?>
														<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" disabled style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } else { ?>
															<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>"  style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } ?>

													<?php if($row['isactive_main'] == 0) { ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" style="margin-left:30px;width:60px;margin-top:7px;" data-slug="<?=$row['slug']?>" disabled>Main</button>
													<?php } else{ ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" style="margin-left:30px;width:60px;margin-top:7px;" data-slug="<?=$row['slug']?>">Main</button>
													<?php } ?>

													
												</div>
										</div>
									</div>
							

							<?php } elseif($row['pay_type'] == 1 &&  $row['item_id'] == $row['set_info_id'] && $row['seen_set_id'] !== $row['set_info_id']){ ?>
									<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
													<div class="newflag" style="position:absolute;height:30px;width:50px;"> </div>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<?php if($row['isactive_pre'] == 0) {  ?>
														<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" disabled style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } else { ?>
															<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } ?>

													<?php if($row['isactive_main'] == 0) { ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" style="margin-left:30px;width:60px;margin-top:7px;" disabled>Main</button>
													<?php } else{ ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" style="margin-left:30px;width:60px;margin-top:7px;">Main</button>
													<?php } ?>

													
												</div>
										</div>
									</div>
							<?php } elseif($row['pay_type'] == 1 &&  $row['item_id'] !== $row['set_info_id'] && $row['seen_set_id'] == $row['set_info_id']){ ?>
									<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
									
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>" data-set="<?=$count?>" data-name="Practice Set <?= $count; ?>" class='test_gradiant center_container '>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<button type="button" class="btn btn-sm btn-success add_cart" id="buy_button_<?=$count?>" data-name="Practice set <?= $count?>" data-settype="<?= $row['set_info_type'] ?>" data-price="<?= $price?>"   data-itemid="<?=$row['set_info_id'] ?>"  style="margin-left:130px;width:60px;margin-top:7px;">Buy	</button>
													

													
												</div>
										</div>
									</div>
									
							<?php } elseif($row['pay_type'] == 1 &&  $row['item_id'] !== $row['set_info_id'] && $row['seen_set_id'] !== $row['set_info_id']) {?>

									<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;overflow-x:hidden;' id="practice_set_<?=$count?>" data-set="<?=$count?>" data-name="Practice Set <?= $count; ?>" class='test_gradiant center_container '>
												--<div class="newflag" style="position:absolute;color:#fff;background-color:#f00;right:10px;border-radius:14px;top:0px;padding:3px;font-size:14px;">New</div>
													<div class="newflag" style="position:absolute;height:30px;width:50px;"> </div>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<button type="button" class="btn btn-sm btn-success add_cart" id="buy_button_<?=$count?>" data-name="Practice set <?= $count?>" data-settype="<?= $row['set_info_type'] ?>" data-price="<?= $price?>"   data-itemid="<?=$row['set_info_id'] ?>"  style="margin-left:130px;width:60px;margin-top:7px;">Buy	</button>
													

													
												</div>
										</div>
									</div>

							<?php } elseif($row['pay_type'] !== 1 && $row['seen_set_id'] == $row['set_info_id']) {?>
									<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<?php if($row['isactive_pre'] == 0) {  ?>
														<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" disabled style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } else { ?>
															<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } ?>

													<?php if($row['isactive_main'] == 0) { ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" style="margin-left:30px;width:60px;margin-top:7px;" data-slug="<?=$row['slug']?>" disabled>Main</button>
													<?php } else{ ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" style="margin-left:30px;width:60px;margin-top:7px;" data-slug="<?=$row['slug']?>">Main</button>
													<?php } ?>

													
												</div>
										</div>
									</div>
							<?php } elseif($row['pay_type'] !== 1 &&   $row['seen_set_id'] !== $row['set_info_id']) {?>
								<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
								
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
													<div class="newflag" style="position:absolute;height:30px;width:50px;"> </div>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<?php if($row['isactive_pre'] == 0) {  ?>
														<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" disabled	 style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } else { ?>
															<button type="button" class="btn btn-sm btn-info take_test_button" data-section="pre" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<?php } ?>

													<?php if($row['isactive_main'] == 0) { ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" style="margin-left:30px;width:60px;margin-top:7px;" disabled>Main</button>
													<?php } else{ ?>
														<button type="button" class="btn btn-sm btn-warning take_test_button" data-section="main" data-itemid="<?=$row['set_info_id']?>" data-slug="<?=$row['slug']?>" style="margin-left:30px;width:60px;margin-top:7px;">Main</button>
													<?php } ?>

													
												</div>
										</div>
									</div>
							
							
							<?php }?>
							
						<?php endforeach; ?>	
					<?php } else{ ?>
						<?php  foreach($data as $index => $row): ?>
							<?php $count = $index+1; $price=20;?>
							<?php if($row['pay_type'] ==1){ ?>
								<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
									
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;'  data-set="<?=$count?>" data-name="Practice Set <?= $count; ?>" class='test_gradiant center_container '>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<button type="button" class="btn btn-sm btn-success not_logged_in" id="buy_button_<?=$count?>"  style="margin-left:130px;width:60px;margin-top:7px;">Buy	</button>
													

													
												</div>
										</div>
									</div>
							<?php }else{ ?>
								<div class='row' style='display:hidden;margin-bottom:10px;margin-top:0px;'>
										<div class='col-sm-12'>
												<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' class='test_gradiant center_container '>
													<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
													</div>
													<span style='color:#0080c0;font-size:24px;margin-top:22px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank PO Practice Set <?= $count; ?> </span>
													<span style='color:#000;font-size:18px;margin-left:130px;line-height:.5em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </span><br>
													<button type="button" class="btn btn-sm btn-info  not_logged_in"  style="margin-left:130px;width:60px;margin-top:7px;">Pre</button>
													<button type="button" class="btn btn-sm btn-warning  not_logged_in"  style="margin-left:30px;width:60px;margin-top:7px;" disabled>Main</button>

													
												</div>
										</div>
									</div>
							<?php } ?>
						<?php endforeach; ?>		
					<?php }  ?>		
				</div> 
			</div>
			<!-- <div class="col-md-4" id="gkreading"  style="height:550px; border:1px solid #ccc;background-color:#F6F5F3;margin-bottom:0px;">
				<center><div class="text-center" style="width:100%; background-color:#E21A10; color:#fff;padding:5px;font-size:20px;margin-top:10px;">
					Current Affairs
				</div></center>
				<div class="nicescroll" style="height:435px; overflow:hidden;overflow-y:scroll;font-family:Times New Roman, Times, serif;margin-top:10px;text-align: justify;" id="current_gk_container">
						<?php for($i=0;$i<sizeof($array);$i++): ?>
							<div style="margin-bottom:10px;font-size:17px;">
								<div style="float:left;font-weight:bold;margin-right:10px;"><?= $i+1 ;?>.</div><div style="font-weight:550;"><?= $array[$i]; ?></div>
							</div>	
						<?php endfor; ?> 
					<?php $dates = "2040"; ?>
					<?php  foreach($gk as $index => $row): ?>
						<?php $g = strcasecmp($row['date'],$dates);  ?>
						<?php if($g >= 0){ ?>
							<div style="margin-bottom:15px;font-size:17px;">
								<div style="float:left;font-weight:bold;margin-right:10px;">
										<div style='height:10px;width:10px;border-radius:5px;background-color:#333;margin-top:5px;'>
											
										</div>
								</div>
								<div style="font-weight:550;"><?= $row['GkContent']; ?>
								</div>
							</div>
							<?php $dates = $row['date'] ;?>
						<?php } else { ?>
							<div style="font-size:20px;font-weight:bold;color:#333;font-style: italic;margin-bottom:5px;">Updated on <?=$row['date'] ?></div>
							<div style="margin-bottom:15px;font-size:17px;">
								<div style="float:left;font-weight:bold;margin-right:10px;">
										<div style='height:10px;width:10px;border-radius:5px;background-color:#333;margin-top:5px;'>
											
										</div>
								</div>
								<div style="font-weight:550;"><?= $row['GkContent']; ?>
								</div>
							</div>
							<?php $dates = $row['date'] ;?>
						<?php } ?>	
					<?php endforeach; ?>		


				</div>
				<div class="row">
					<div class="col-xs-12 text-center"  >
						
							<<button type="button" id="next_button" class="btn btn-info btn-sm get_gk" data-id="next" style="margin-right:15px;width:50px;" disabled>next</button>
							<button type="button" id="pre_button" class="btn btn-info btn-sm get_gk" data-id="previous" style=" margin-left:15px;width:50px;" > pre </button>
							<div class="bp-docs-example"><div id="bp-get-started-initialization" style="cursor:pointer;"></div></div>	
							</div>
						
				</div>
			</div> -->
			<div class="col-md-5" style="height:100vx;">
				<div style="height:100vx;overflow-y:auto;overflow-x:hidden;12">
				<div class="row">
				 <div class="col-md-12">
					<a href="<?=base_url()?>bankpo/daily_test_exam/current_affaire" style='color:#fff;'>
						<div class="form-control text-center" style="; margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Daily Current Affairs Quiz</blink>
						</div>
					</a>
                   </div>
                   <!-- <div class="col-md-6">
					<a href="<?=base_url()?>bankpo/daily_test" style='color:#fff;'>
						<div class="form-control text-center" style="; margin-bottom:10px;font-weight:bold;font-size:18px; height: auto;padding:10px;color:#fff;text-decoration: blink;background-color:#E21A10;">
							<blink>Online IBPS Exam Portal</blink>
						</div>
					</a>
                   </div> -->
				</div>
                                        <a href="https://play.google.com/store/apps/details?id=com.xercesblue.onlinebankexampo" target="blank">
						<div id="app_add" style="width:100%;height:60px;background-color:#999;">
						
						</div>
					</a>
                    <div style="margin-top:10px;" >
						<!-- <video id="examkabila_intro_video" onclick="videoplayPause()"  width="100%" controls style="cursor:pointer;">
						   <!-- <source src="<?=base_url()?>docs/videos/demo.mp4" type="video/mp4"> -->
						   <!-- <source src="https://www.youtube.com/watch?v=PaKtLxA1LD0" type="video/mp4"> 
						  </video>-->
						<iframe title="YouTube video player" class="youtube-player" type="text/html" 
						width="100%" height="300px"  src="https://www.youtube.com/embed/PaKtLxA1LD0"
					frameborder="0" allowFullScreen="true"></iframe>
					</div>
					<!-- 8L5PqL4ylIU
					https://www.youtube.com/watch?v=8L5PqL4ylIU
					https://www.youtube.com/embed/PaKtLxA1LD0 -->

					 <div id="advertisement" style="height:50%;width:100%;background-color:#fff;margin-top:10px;">
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

					 <div class="text-center" style="margin-top:10px;background-color:#7ADBF0">
					 	
					 	<h4 style="color:#fff;padding:8px;">  Important PDF  </h4>

					 </div>
					  <?php if($this->session->userdata('is_logged_in')) { ?>
					  <div  style="margin-top:5px;" id="ContainerImportantPDF">
                      <?php foreach($pd as $index => $row): ?>
                      	<div class="download_section" style="padding:3px 0px;cursor:pointer">
                      	<a href="<?=base_url()?>bankpo/importantpdf" >
                      	
						<div class="" style="color:#000;margin-top:3px">
							<?= $row['pdf_name']; ?>
						</div>
					    </a>
					    </div>
                      <?php endforeach; ?> 
						 
							
					 </div>
					 <?php } else {?>
					 					<div  style="margin-top:5px;" id="ContainerImportantPDF">
							                      <?php foreach($pd as $index => $row): ?>
							                      	<!-- <a href="<?=base_url()?>bankpo/importantpdf" style='color:#fff;'> -->
							                      	<div class="download_section not_logged_in" data-controller="Bankpo/importantpdf" style="padding:3px 0px;cursor:pointer" >
													<div class="" style="color:#000;margin-top:3px">
														<?= $row['pdf_name']; ?>
													</div>
												    </div>
							                      <?php endforeach; ?> 
						 
							
					 					</div>

					 			<?php } ?>
					
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