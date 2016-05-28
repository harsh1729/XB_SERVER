<div class="row">
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-8">
		<?php  foreach($data[1] as $index => $row): ?>
			<div class="row">
				<div col-sm-12>
					<div class="text-center" style="padding:10px;display:inline-block;height:90px;width:90px;border-radius:45px;background-color:#000;color:#fff;">
						<?=$row['day']?><br>
						<?=$row['month']?><br>
						<?=$row['year']?> 
					</div>
					<div style="display:inline-block;top:-20px;margin-left:10px;">
						<span style="font-size:24px;"><?=$row['name']?></span><br>
						<span style="color:#f00">By: </span><span>Rekha Verma</span>
					</div>
				</div>
				
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-12">
					<?php if($row['align'] == 'right') { ?>
						<img src="<?=base_url()?>admin_docs/upload_image/<?=$row['image']?>" class="" width="300px;" style="float:right; margin-left:15px;">
					<?php } else if($row['align'] == 'left') { ?>
						<img src="<?=base_url()?>admin_docs/upload_image/<?=$row['image']?>" class="" width="300px;" style="float:left; margin-right:15px;">
					<?php } else { ?>
						<img src="<?=base_url()?>admin_docs/upload_image/<?=$row['image']?>">
					<?php } ?>	
				<div style="text-align: justify;"><?=$row['blog_text']?></div>	
				</div>
			</div>
			<?php  foreach($row['sub_array'] as $index2 => $row2): ?>

				<div class="row" style="margin-top:20px;">
					<div class="col-sm-12">
						<?php if($row2['sub_image'] !== "" ) { ?>

							<?php if($row2['sub_align'] == 'right') { ?>
								<img src="<?=base_url()?>admin_docs/upload_image/<?=$row2['sub_image']?>" class="" width="300px;" style="float:right; margin-left:15px;">
							<?php } else if($row2['sub_align'] == 'left') { ?>
								<img src="<?=base_url()?>admin_docs/upload_image/<?=$row2['sub_image']?>" class="" width="300px;" style="float:left; margin-right:15px;">
							<?php } else { ?>
								<img src="<?=base_url()?>admin_docs/upload_image/<?=$row2['sub_image']?>">
							<?php } ?>
							<div style="text-align: justify;"><?=$row2['sub_text']?></div>	
						<?php } else { ?>
							<div style="text-align: justify;"><?=$row2['sub_text']?></div>	
						<?php } ?>	
					</div>
				</div>
			<?php endforeach; ?>	
			<div class="row" style="margin-top:50px;">
				<div class="col-sm-12">
					<!-- <div style="margin-top:px;">
						 	<span style="font-weight:bold;">All Comments( </span><span class="total_comment"><?=$row['total_comment']?></span><span> )</span>
					</div>
					<form class="blog_comment_submit" data-blogid="<?=$row['id']?>" action="<?=base_url()?>admin_request/blog/submit_comment" method="post">
						
						<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:35px;color:#00f;"></span>
						<div class="dialogbox" style="margin-left:40px;">
							<div class="body" style="">
									<span class="tip tip-left"></span>
									<div class="message" style="padding:5px 10px;" data-username="<?=$this->session->userdata('name')?>" data-id="" contenteditable="true">
											       
									</div>
									
							</div>
						</div>
						<button type="submit" class="btn btn-sm btn-info"  style="float:right;margin-top:-55px;display:none;margin-right:80px;">post</button>
					</form>	   -->
					<div class="fb-comments" data-href="http://www.examkabila.com/Blog" data-width="850" data-numposts="5"></div>
				</div>

			</div>
			<div class="row" style="margin-bottom:30px;">
				<div class="col-sm-12">
					<?php  foreach($row['comment'] as $index1 => $row1): ?>	
						<div style="height:40px;margin-left:20px;margin-bottom:10px;">
							<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:40px;">
							</span>
							<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['username']?></div><br>
							<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['text']?></div>

						</div>
					<?php endforeach; ?>
					<?php if($row['total_comment'] > 2) { ?>	
						<a href="" class="see_more" data-blogid="<?=$row['id']?>" data-url="<?=base_url()?>admin_request/blog/see_more" style="margin-top:35px;display:block;"><span style="margin-left:20px;">see more...</span></a>
						<input type="hidden" value="2">
					<?php } ?>
				</div>
			</div>
			<hr style="margin-bottom:50px;">
		<?php endforeach; ?>	
	</div>
	<div class="col-sm-3">
		<div class="row">
			<div class="col-sm-10" style="padding-top:120px;">
				<a href="https://play.google.com/store/apps/details?id=com.xercesblue.onlinebankexampo" target="blank">
					<div id="app_add" style="width:100%;height:55px;background-color:#999;margin-bottom:15px;">
								
					</div>
				</a>	

				<?php foreach ($data[0] as $index3 => $row3): ?>
						<?php $blogname = $row3['blog_name']; $blogname = strip_tags($blogname); $blogname = str_replace(" ","-",$blogname) ;?>
						<a href="<?=base_url()?>blog/<?=$row3['blog_id']?>/<?=$blogname?>" style="text-decoration:none;"><div class="left_panal_blog" style="padding-top:20px;padding-bottom:20px; cursor:pointer;" data-url="<?=base_url()?>Blog/index" data-id="<?=$row3['blog_id']?>">
							<span style="padding:0px 10px;float:left;"><?=$index3+1?>.</span><div style="margin-left:32px;"><?=$row3['blog_name']?></div>
						</div></a>
					
					<hr style="margin:0;">	
				<?php endforeach ?>	
			</div>
			<div class="col-sm-2">
				
			</div>
		</div>
			<div class="row" id="xx">
				<div class="col-sm-12" style="padding-top:120px;">
						<!-- added by boney -->
							 <div id="advertisement" style="height:60px;width:100%;background-color:#fff;margin-top:10px;">
										<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		
									<ins class="adsbygoogle"
									     style="display:block"
									     data-ad-client="ca-pub-7116540457133316"
									     data-ad-slot="5667411582"
									     data-ad-format="auto"></ins>
									<script>
									(adsbygoogle = window.adsbygoogle || []).push({});
									</script>
							</div> 
							<!-- end by boney -->
				</div>

			</div>
	</div>
	
		
</div>