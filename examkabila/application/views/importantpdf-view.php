<div class="row" style="margin-top:35px;overflow:hidden;">
    
	<div class="col-md-1" style="padding-left:0px;">
		
	</div>
	<div class="col-md-11" id="bankpo_home">
	   
		<div class="row">
			<div class="col-md-9 nicescroll" id="bankposet_pdf_container" style="height:520px; overflow-x:hidden;overflow-y:auto;">
				<table  border="1" style="width:100%;background-color:#fff;">
					<tr>
						<th class="text-center">
							File Name
						</th>
						<th class="text-center">
							Discription
						</th>
						<th class="text-center">
							Size
						</th>
						<th class="text-center">
							Downloads
						</th>
						<th class="text-center">
							
						</th>
					</tr>
					
				
				<?php foreach($data as $index => $row): ?>
					<?php $count = $index+1; $price=20;?>
					<?php if($row['pdf_pay_type'] == 0 ){ ?>

					<tr>
						<td class="text-center">
							<?= $row['pdf_name']?>
						</td>
						<td class="text-center">
							<?= $row['discription']?>
						</td>
						<td class="text-center">
							<?= $row['size']?>
						</td>
						<td class="text-center">
							<?= $row['download']?>
						</td>
						<td class="text-center">
							<a href="<?=base_url() ?>download/download.php?name=<?=$row['pdf_link'];?>"><button type="button" class="btn btn-sm btn-info importantpdf"  data-pdfid="<?=$row['pdf_id']?>">Download</button></a>
						</td>
					</tr>
					<?php } else if($row['item_id'] == $row['pdf_item_id'] ){ ?>
						<tr>
							<td class="text-center">
								<?= $row['pdf_name']?>
							</td>
							<td class="text-center">
								<?= $row['discription']?>
							</td>
							<td class="text-center">
								<?= $row['size']?>
							</td>
							<td class="text-center">
								<?= $row['download']?>
							</td>
							<td class="text-center">
								<a href="<?=base_url() ?>download/download.php?name=<?=$row['pdf_link'];?>"><button type="button" class="btn btn-sm btn-info importantpdf" data-pdfid="<?=$row['pdf_id']?>">Download</button></a>
							</td>
						</tr>
					<?php } else { ?>
						<div class='row' style='display:hidden;margin-bottom:10px;'>
							<div class='col-sm-12'>
									<div style='height:130px;padding-top:22px;cursor:pointer;border:1px solid #ccc;' id="practice_set_<?=$count?>"   class='test_gradiant center_container '>
										<div class="exam_icon" style='border-radius:5px;top:25px;height:80px;width:80px;background-color:#E21A10;position:absolute;left:40px;'>
										</div>
										<div style='color:#0080c0;font-size:24px;margin-left:130px;line-height:1em;letter-spacing:-2px;word-spacing:5px;'>Bank Po Practice Set PDF <?= $count?> </div>
										<div style='color:#000;font-size:18px;margin-left:130px;margin-top:5px; line-height:1em;font-family:Times New Roman, Times, serif;'>As per IBPS exam Format </div>
										<div style="margin-left:130px;margin-top:13px;font-size:16px;"><?= $row['pdf_amount'] ?>/-</div>
										<button type="button" class="btn btn-lg btn-info add_cart" style="bottom:10px;right:25px;position:absolute;" data-name="Po practice Set PDF" data-settype="<?= $row['set_type'] ?>" data-price="<?= $price?>"   data-itemid="<?=$row['pdf_item_id'] ?>">Buy</button>

										
									</div>
							</div>
						</div>

					<?php } ?>	
				<?php endforeach; ?>
				</table>
			</div>
			
			<div class="col-md-3" style="height:520px;border-left:1px solid #000;">
				<div style="height:520px;overflow-y:auto;overflow-x:hidden;">
					<div id="advertisement" style="height:100%;width:100%;background-color:#fff">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- add2 -->
						<ins class="adsbygoogle"
						     style="display:inline-block;width:320px;height:100px"
						     data-ad-client="ca-pub-7116540457133316"
						     data-ad-slot="9818409582"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>
					
				</div>
				
			</div>
		</div>
		<div class="row" >
			<div class="col-sm-12">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- add2 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-7116540457133316"
     data-ad-slot="9818409582"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
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
	<!-- <div class="col-md-1" >
              
	
	</div> -->
	
</div>