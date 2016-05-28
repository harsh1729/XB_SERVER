<div class="row">
	<?php if($data[0]['pay_type']== 0) { ?>
		<div class="col-sm-8">
			<div style="position:relative;">
			<div style="height:450px">
			 <iframe title="YouTube video player" class="youtube-player" type="text/html" 
						               width="100%" height="100%"  src="https://www.youtube.com/embed/<?=$data[0]['youtube_key']?>"
					                   frameborder="5" allowFullScreen="true">
					                  </iframe>
					                  </div>
					  
				<!-- <video id="myVideo_demo" poster="http://standupcomedy.me/videop/560x315 now fits.jpg" width="100%" height="100%" controls="controls"> 
		    		<source src="<?=base_url()?>admin_docs/upload_video/<?=$data[0]['video_link']?>" type="video/mp4"> 
				</video>
				<div id="video_play_pause" style="background-color:rgba(0,0,0,.5);position:absolute;width:100%;height:100%;top:0px;cursor:pointer;" class="text-center ">
					<span id="video_play" class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%)"></span>
					<span id="video_pause" class="glyphicon glyphicon-pause" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%);display:none;"></span>
				</div> -->
			</div>
			<div style="font-size:26px;padding:10px;">
				<?=$data[0]['video_name']?>
			</div>
			<div class="row" style="margin-top:50px;margin-bottom:30px;">
							<div class="col-sm-12">
								<div style="margin-top:px;">
									 	<span style="font-weight:bold;">All Comments( </span><span class="total_comment"><?=$data[0]['total_comment'] ?></span><span> )</span>
								</div>
								<form class="video_comment_submit" data-videoid="<?= $data[0]['video_item_id']; ?>" action="<?=base_url()?>client_requests/Bankpo/submit_video_comment" method="post">
									
									<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:35px;color:#00f;"></span>
									<div class="dialogbox" style="margin-left:40px;">
										<div class="body" style="">
												<span class="tip tip-left"></span>
												<div class="message" style="padding:5px 10px;" data-username="<?=$this->session->userdata('name')?>" data-userid="<?=$this->session->userdata('userid')?>" contenteditable="true">
														       
												</div>
												
										</div>
									</div>
									<button type="submit" class="btn btn-sm btn-info"  style="float:right;margin-top:-55px;display:none;margin-right:80px;">post</button>
								</form>	  
							</div>

				</div>
				<div class="row" style="margin-bottom:30px;">
					<div class="col-sm-12">
						<?php  foreach($data[0]['comment'] as $index1 => $row1): ?>	
							<div style="height:40px;margin-left:20px;margin-bottom:10px;">
								<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:40px;">
								</span>
								<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['username']?></div><br>
								<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['text']?></div>

							</div>
						<?php endforeach; ?>
						<?php if($data[0]['total_comment'] > 2) { ?>	
							<a href="" class="see_more" data-videoid="<?= $data[0]['video_item_id']; ?>" data-url="<?=base_url()?>client_requests/Bankpo/see_more_video_comment" style="margin-top:35px;display:block;"><span style="margin-left:20px;">see more...</span></a>
							<input type="hidden" value="2">
						<?php } ?>
					</div>
				</div>
				<hr style="margin-bottom:50px;">
		</div>
	<?php } else { ?>
		<?php if($data[0]['video_item_id'] == $data[0]['item_id']) { ?>
			<div class="col-sm-8">
				<div style="position:relative;">
          <div style="height:450px">
					<iframe title="YouTube video player" class="youtube-player" type="text/html" 
						               width="100%" height="100%" src="https://www.youtube.com/embed/<?=$data[0]['youtube_key']?>"
					                   frameborder="0" allowFullScreen="true">
					                  </iframe>
					                  </div>
					<!-- <video id="myVideo_demo" poster="http://standupcomedy.me/videop/560x315 now fits.jpg" width="100%" height="100%" controls="controls"> 
			    		<source src="<?=base_url()?>admin_docs/upload_video/<?=$data[0]['video_link']?>" type="video/mp4"> 
					</video>
					<div id="video_play_pause" style="background-color:rgba(0,0,0,.5);position:absolute;width:100%;height:100%;top:0px;cursor:pointer;" class="text-center ">
						<span id="video_play" class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%)"></span>
						<span id="video_pause" class="glyphicon glyphicon-pause" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%);display:none;"></span>
					</div> -->
				</div>
				<div style="font-size:26px;padding:10px;">
					<?=$data[0]['video_name']?>
				</div>
				<div class="row" style="margin-top:50px;margin-bottom:30px;">
							<div class="col-sm-12">
								<div style="margin-top:px;">
									 	<span style="font-weight:bold;">All Comments( </span><span class="total_comment"><?=$data[0]['total_comment'] ?></span><span> )</span>
								</div>
								<form class="video_comment_submit" data-videoid="<?= $data[0]['video_item_id']; ?>" action="<?=base_url()?>client_requests/Bankpo/submit_video_comment" method="post">
									
									<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:35px;color:#00f;"></span>
									<div class="dialogbox" style="margin-left:40px;">
										<div class="body" style="">
												<span class="tip tip-left"></span>
												<div class="message" style="padding:5px 10px;" data-username="<?=$this->session->userdata('name')?>" data-userid="<?=$this->session->userdata('userid')?>" contenteditable="true">
														       
												</div>
												
										</div>
									</div>
									<button type="submit" class="btn btn-sm btn-info"  style="float:right;margin-top:-55px;display:none;margin-right:80px;">post</button>
								</form>	  
							</div>

				</div>
				<div class="row" style="margin-bottom:30px;">
					<div class="col-sm-12">
						<?php  foreach($data[0]['comment'] as $index1 => $row1): ?>	
							<div style="height:40px;margin-left:20px;margin-bottom:10px;">
								<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:40px;">
								</span>
								<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['username']?></div><br>
								<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['text']?></div>

							</div>
						<?php endforeach; ?>
						<?php if($data[0]['total_comment'] > 2) { ?>	
							<a href="" class="see_more" data-videoid="<?= $data[0]['video_item_id']; ?>" data-url="<?=base_url()?>client_requests/Bankpo/see_more_video_comment" style="margin-top:35px;display:block;"><span style="margin-left:20px;">see more...</span></a>
							<input type="hidden" value="2">
						<?php } ?>
					</div>
				</div>
				<hr style="margin-bottom:50px;">
			</div>
		<?php } else { ?>
			<div class="col-sm-8">
				<div style="position:relative;">
				<div style="height:450px">
					<iframe title="YouTube video player" class="youtube-player" type="text/html" 
						               width="100%" height="100%" src="https://www.youtube.com/embed/<?=$data[0]['youtube_key']?>"
					                   frameborder="0" allowFullScreen="true" >
					                  </iframe>
					                  </div>
					<!-- <video id="myVideo_demo" poster="http://standupcomedy.me/videop/560x315 now fits.jpg" width="100%" height="100%" controls="controls"> 
			    		<source src="<?=base_url()?>admin_docs/upload_video/<?=$data[0]['video_link']?>" type="video/mp4"> 
					</video>
					<div id="add_cart"  data-name="<?= $data[0]['video_name']; ?>" data-settype="6" data-price="<?= $data[0]['pay_amount'] ?>" data-itemid="<?= $data[0]['video_item_id']; ?>" style="background-color:rgba(0,0,0,.5);position:absolute;width:100%;height:100%;top:0px;cursor:pointer;" class="text-center add_cart">
						<span id="video_play" class="glyphicon" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%);word-spacing:-10px;">Add to cart</span>
						<span id="video_pause" class="glyphicon glyphicon-pause" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%);display:none;"></span>
					</div> -->
				</div>
				<div style="font-size:26px;padding:10px;">
					<?=$data[0]['video_name']?>
				</div>
				<div class="row" style="margin-top:50px;margin-bottom:30px;">
							<div class="col-sm-12">
								<div style="margin-top:px;">
									 	<span style="font-weight:bold;">All Comments( </span><span class="total_comment"><?=$data[0]['total_comment'] ?></span><span> )</span>
								</div>
								<form class="video_comment_submit" data-videoid="<?= $data[0]['video_item_id']; ?>" action="<?=base_url()?>client_requests/Bankpo/submit_video_comment" method="post">
									
									<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:35px;color:#00f;"></span>
									<div class="dialogbox" style="margin-left:40px;">
										<div class="body" style="">
												<span class="tip tip-left"></span>
												<div class="message" style="padding:5px 10px;" data-username="<?=$this->session->userdata('name')?>" data-userid="<?=$this->session->userdata('userid')?>" contenteditable="true">
														       
												</div>
												
										</div>
									</div>
									<button type="submit" class="btn btn-sm btn-info"  style="float:right;margin-top:-55px;display:none;margin-right:80px;">post</button>
								</form>	  
							</div>

				</div>
				<div class="row" style="margin-bottom:30px;">
					<div class="col-sm-12">
						<?php  foreach($data[0]['comment'] as $index1 => $row1): ?>	
							<div style="height:40px;margin-left:20px;margin-bottom:10px;">
								<span class="glyphicon glyphicon-user" style="float:left;border:1px solid #ddd;font-size:40px;">
								</span>
								<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['username']?></div><br>
								<div style="margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;"><?=$row1['text']?></div>

							</div>
						<?php endforeach; ?>
						<?php if($data[0]['total_comment'] > 2) { ?>	
							<a href="" class="see_more" data-videoid="<?= $data[0]['video_item_id']; ?>" data-url="<?=base_url()?>client_requests/Bankpo/see_more_video_comment" style="margin-top:35px;display:block;"><span style="margin-left:20px;">see more...</span></a>
							<input type="hidden" value="2">
						<?php } ?>
					</div>
				</div>
				<hr style="margin-bottom:50px;">
			</div>
		<?php } ?>	
	<?php } ?>
	
	<div class="col-sm-4" style="">
		<?php  foreach($data[1] as $index2 => $row2): ?>
			<a class="leftvideo" href="<?=base_url()?>Bankpo/video/?id=<?=$row2['video_item_id']?>&amp;catid=<?=$row2['catid']?>" >
				<div class="row "  style="margin-bottom:15px;margin-top:15px;cursor:pointer;">
					<div class="col-xs-4" style="padding:0px;">
						<div class="text-center">
					<!-- <iframe title="YouTube video player" class="youtube-player" type="text/html" 
						               width="100%" height="100%" src="https://www.youtube.com/embed/<?=$row2['youtube_key']?>"
					                   frameborder="0" allowFullScreen="true" >
					                  </iframe> -->
							 <center><img src="<?=base_url()?>admin_docs/upload_video/<?=$row2['image']?>" style="height:100px;width:100%;padding:2px;border:1px solid #aaa;" > </center>
					    </div>
					</div>
					<div class="col-xs-8" style="padding-left:10px;">
						<div style="font-weight:bold;font-size:16px;">
							<?php echo $row2['video_name']; ?>
						</div>
						<div style="color:#999;">
							<span >
								By
							</span>
							<span style="font-size:12px;">
								ExamKabila
							</span>
						</div>
					</div>
				</div>
			</a>	
			<div style="background-color:#aaa;width:100%;height:1px;margin-left:-15px;"></div>	
		<?php endforeach; ?>	
	</div>
	
</div>