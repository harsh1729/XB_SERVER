<?php $Months = array("January","February","March","April","May","June","July","August","September","October","November","December"); 
$array1 = array("2008","2009","2010","2011","2012","2013","2014") ?>
<div class="row" style="margin-top:35px;overflow:hidden;">
	
	<div class="col-md-1" style="padding-left:0px;">
		
	</div>
	<div class="col-md-10" id="bankpo_home">
	   
		<div class="row">
			<div class="col-md-9 nicescroll"  id="bankinggk_pdf_container" style="height:520px; overflow-x:hidden;overflow-y:auto;">
				<?php foreach($data as $index => $row): ?>
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
					<?php if($row['pdf_pay_type'] == 0 ){ ?>
						<div class='row' style='display:hidden;margin-bottom:10px;'>
							<div class='col-sm-12'>
									<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
										<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
										</div>
										<div style='color:#0080c0;font-size:24px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Current Affairs <?=$month?> <?=$year?> PDF </div>
										<div style='color:#000;font-size:18px;margin-left:130px;margin-top:5px; line-height:1em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </div>
										<div style="margin-left:130px;margin-top:13px;font-size:16px;"></div>
										<a href="<?=base_url() ?>download/downloadgk.php?date=<?=$row['pdf_date'];?>&language=<?=$this->session->userdata('web_language');?>&month=<?=$month?>"><button type="button" class="btn btn-lg btn-info download_btn" data-itemdate="<?=$row['pdf_date']?>" data-itemid="<?= $row['pdf_item_id']?>" data-pdfid="<?=$row['pdf_id']?>" style="bottom:10px;right:25px;position:absolute;">Download</button></a>

							<div id="download_alert" style="bottom:10px;right:200px;position:absolute;display:none;">please wait ! your download will start in few seconds </div>			
									</div>
							</div>
						</div>
					<?php } else if($row['pdf_item_id'] == $row['item_id'] ){ ?>
						<div class='row' style='display:hidden;margin-bottom:10px;'>
							<div class='col-sm-12'>
									<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
										<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
										</div>
										<div style='color:#0080c0;font-size:24px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Current Affairs <?=$month?> <?=$year?> PDF </div>
										<div style='color:#000;font-size:18px;margin-left:130px;margin-top:5px; line-height:1em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </div>
										<div style="margin-left:130px;margin-top:13px;font-size:16px;"></div>
										<a href="<?=base_url() ?>download/downloadgk.php?date=<?=$row['pdf_date'];?>&language=<?=$this->session->userdata('web_language');?>"><button type="button" class="btn btn-lg btn-info download_btn" data-itemdate="<?=$row['pdf_date']?>" data-itemid="<?= $row['pdf_item_id']?>" data-pdfid="<?=$row['pdf_id']?>" style="bottom:10px;right:25px;position:absolute;">Download</button></a>

										
									</div>
							</div>
						</div>
					<?php } else { ?>
						<div class='row' style='display:hidden;margin-bottom:10px;'>
							<div class='col-sm-12'>
									<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
										<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
										</div>
										<div style='color:#0080c0;font-size:24px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Current Affairs <?=$month?> <?=$year?> PDF </div>
										<div style='color:#000;font-size:18px;margin-left:130px;margin-top:5px; line-height:1em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </div>
										<div style="margin-left:130px;margin-top:13px;font-size:16px;"><?=$row['pdf_amount'] ?>/-</div>
										<button type="button" class="btn btn-lg btn-info add_cart" data-itemdate="<?=$row['pdf_date']?>" data-itemid="<?= $row['pdf_item_id']?>" data-price="<?=$row['pdf_amount'] ?>" data-name="GK <?= $row['pdf_date']?> PDF" data-settype="<?= $row['pdf_type']?>" style="bottom:10px;right:25px;position:absolute;">Buy</button>

										
									</div>
							</div>
						</div>

					<?php } ?>	
				<?php endforeach; ?>
				
			</div>
			
			<div class="col-md-3" style="height:520px;border-left:1px solid #000;">
				<!-- <div class ="nicescroll"style="height:520px;overflow-y:auto;overflow-x:hidden;"> -->
					<div id="advertisement" style="height:50%;width:100%;">
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
					
				<!-- </div> -->
				
			</div>
		</div>
		<!--<div class="row" style="background-color:#000;">
			
			<div class="col-md-2" style="background-color:#000;margin-left:-15px;color:#fff;font-weight:bold;">
				<div style="height:30px;" class="center_container text-center">
					<a href="<?=base_url()?>client_requests/examtest/seenexams" style="color:#fff;text-decoration:none;"><p class="center_content" style="position:relative;cursor:pointer;">examsrecord</p></a>
				</div>
			</div>
		</div> -->
		<div class="row" style="margin-top:40px;">
			<div class="col-md-12 text-center" id="test_container">
			<!--	<button id="take_test_button" class="btn btn-lg btn-success btn-info" style="color:#fff;">take exam </button>-->
			</div>
		</div>
	</div>
	<div class="col-md-1" >
               
	
	</div>
	
</div>