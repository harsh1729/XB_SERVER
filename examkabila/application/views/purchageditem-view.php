<?php $array = array("june 2015","july 2015","august 2015","september 2015","october 2015","november 2015","december 2015"); 
$array1 = array("2008","2009","2010","2011","2012","2013","2014"); $finalindax; ?>
<div class="row" style="margin-top:35px;overflow:hidden;">
    
	<div class="col-md-1" style="padding-left:0px;">
		
	</div>
	<div class="col-md-10" id="bankpo_home">
	   
		<div class="row">
			<div class="col-md-9 nicescroll"  id="bankinggk_pdf_container" style="height:520px; overflow-x:hidden;overflow-y:auto;">
				<?php foreach($data as $index1 => $row1): ?>
					<?php $finalindax = $index1; if($finalindax == 0) { ?>
					 	<?php foreach($row1 as $index => $row): ?>
							<?php $count = $index+1; $price=20; ?>
							<?php if($row['pdf_item_id'] == $row['item_id'] ){ ?>
								<div class='row' style='display:hidden;margin-bottom:10px;'>
									<div class='col-sm-12'>
											<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
												<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
												</div>
												<div style='color:#0080c0;font-size:24px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'><?=$row['pdf_name']?> <?=$row['pdf_date']?> PDF </div>
												<div style='color:#000;font-size:18px;margin-left:130px;margin-top:5px; line-height:1em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Formate </div>
												<div style="margin-left:130px;margin-top:13px;font-size:16px;"></div>
												<button type="button" class="btn btn-lg btn-info" data-itemid="<?= $row['pdf_item_id']?>" data-download="row['pdf_date']?>" style="bottom:10px;right:25px;position:absolute;">Download</button>

												
											</div>
									</div>
								</div>
							<?php }  ?>
									
						<?php endforeach; ?>	
					<?php } else if($finalindax == 1) { ?>
						<?php foreach($row1 as $index => $row): ?>
							<?php $count = $index+1; $price=20; ?>
							<?php if($row['pdf_item_id'] == $row['item_id'] ){ ?>
								<div class='row' style='display:hidden;margin-bottom:10px;'>
									<div class='col-sm-12'>
											<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
												<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
												</div>
												<div style='color:#0080c0;font-size:24px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'><?=$row['pdf_name']?> <?=$row['pdf_date']?> PDF </div>
												<div style='color:#000;font-size:18px;margin-left:130px;margin-top:5px; line-height:1em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Formate </div>
												<div style="margin-left:130px;margin-top:13px;font-size:16px;"></div>
												<button type="button" class="btn btn-lg btn-info" data-itemid="<?= $row['pdf_item_id']?>" data-download="row['pdf_date']?>" style="bottom:10px;right:25px;position:absolute;">Download</button>

												
											</div>
									</div>
								</div>
							<?php }  ?>
									
						<?php endforeach; ?>
					<?php } else if($finalindax == 2) { ?>
						<?php foreach($row1 as $index => $row): ?>
							<?php $count = $index+1; $price=20; ?>
							<?php if($row['set_info_id'] == $row['item_id'] ){ ?>
								<div class='row' style='display:hidden;margin-bottom:10px;'>
									<div class='col-sm-12'>
											<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
												<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
												</div>
												<div style='color:#0080c0;font-size:24px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'><?= $row['name']?></div>
												<div style='color:#000;font-size:18px;margin-left:130px;margin-top:5px; line-height:1em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Formate </div>
												<div style="margin-left:130px;margin-top:13px;font-size:16px;"></div>
												<button type="button" class="btn btn-lg btn-info" data-itemid="<?= $row['set_info_id']?>" data-download="row['pdf_date']?>" style="bottom:10px;right:25px;position:absolute;">Download</button>

												
											</div>
									</div>
								</div>
							<?php }  ?>
									
						<?php endforeach; ?>
					<?php }  ?>		
				<?php endforeach; ?>
				
			</div>
			
			<div class="col-md-3" style="height:520px;border-left:1px solid #000;">
				<div style="height:520px;overflow-y:auto;overflow-x:hidden;">
					<div id="advertisement" style="height:50%;width:100%;background-color:#7519D1">
						
					</div>
					
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
		<div class="row" style="margin-top:40px;">
			<div class="col-md-12 text-center" id="test_container">
			<!--	<button id="take_test_button" class="btn btn-lg btn-success btn-info" style="color:#fff;">take exam </button>-->
			</div>
		</div>
	</div>
	<div class="col-md-1" >
                
    
	
	</div>
	
</div>