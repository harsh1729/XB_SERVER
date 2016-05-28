<div class="row">
	<div class="col-sm-2">
		<div style="padding-bottom:7px;border:1px" >
			<div class="row">
				<div class="col-sm-12">
						<!-- <div style="width:15px;height:5px;background-color:#000;float:left;">
							
						</div> -->
						<div style="margin-top:7px;font-weight:bold;font-size:18px">Language</div>
				</div>
			</div>
			<div class="row" style="margin-top:15px;">
				<div class="col-sm-12">
					<input class="checkbox" <?php echo $foo = ($lang_type[0] !== '') ? "checked='false'" : ""; ?> id="lang1" type="checkbox" name="hindi" value="hi" style="margin-top:2px;height:18px;width:18px;float:left;"><div style="margin-top:3px;margin-left:30px;font-weight:bold;">Hindi</div>
					<input class="checkbox" <?php echo $foo = ($lang_type[1] !== '') ? "checked='false'" : ""; ?> id="lang2" type="checkbox" name="english" value="en" style="margin-top:2px;height:18px;width:18px;float:left;"><div style="margin-top:3px;margin-left:30px;font-weight:bold;">English</div>
				</div>
			</div>
		</div>
		<!-- <div style="border:1px solid red;padding-top:5px;" >
			<div class="row">
				<div class="col-sm-12 text-center">
						<div style="width:15px;height:5px;background-color:#000;float:left;">
							
						</div>
						<div style="margin-top:-7px;">Category</div>
				</div>
			</div> -->
			<!-- <div class="row" style="margin-top:15px;">
				<div class="col-sm-12">
					<input class="checkbox" <?php echo $foo = ($price_type[0] !== '') ? "checked='false'" : ""; ?> id="price1" type="checkbox" name="free" value="0" style="height:18px;width:18px;float:left;"><div style="margin-top:3px;margin-left:25px;font-weight:bold;">Free (17)</div>
					<input class="checkbox" <?php echo $foo = ($price_type[1] !== '') ? "checked='false'" : ""; ?> id="price2" type="checkbox" name="paid" value="1" style="height:18px;width:18px;float:left;"><div style="margin-top:3px;margin-left:25px;font-weight:bold;">Paid (210)</div>
				</div>
			</div> -->

			<div class="row" style="margin-top:15px;">
			<div class="col-sm-12">
			<!-- <input type="button" onClick="loadValues" id="btn"> -->

			<div class="panel-group" id="accordion"  >
       <?php 	foreach ($category as $index => $row) : ?>
              <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"  >
                <div class = "<?= $row['id'] ?>" id = "maincate"  >
                  <a  data-toggle="collapse"  class = "main" data-parent="#accordion"  href="#<?= $row['id'] ?>" style="color:#FFF"><span class="">
                    </span><?= $row['name'] ?></a>
                </div>
                </h4>
                <!-- lang_type="+JSON.stringify(lang_type) -->
              </div>
              <div id="<?= $row['id'] ?>" class="panel-collapse collapse">
                <div class="list-group" id="lan_type" >
                <?php 	foreach ($row['subcate'] as $index => $row) : ?>
                  <?php if($catid!=$row['id']){ ?>
                    <a href="<?=base_url()?>Bankpo/video?catid=<?= $row['id'] ?>" id = "<?= $row['id'] ?>" class="list-group-item"><?= $row['name'] ?></a>
              <?php } else { ?>
                     <a href="<?=base_url()?>Bankpo/video?catid=<?= $row['id'] ?>"  id = "<?= $row['id'] ?>"  class="list-group-item active" style="background-color:#f2f2f2;border-color:#f2f2f2;color:#000" ><?= $row['name'] ?></a>
              <?php } ?>
                 <?php endforeach; ?>
                </div>
              </div>
            </div>
<?php endforeach; ?> 
</div>

			<!-- <ul data-role="listview">
			<li><a href="#">All Videos</a></li>
			 </ul>
			
   <!--   <div data-role="collapsible">
    <h4>B</h4>
    <ul data-role="listview">
       <li><a href="#">Billy</a></li>
       <li><a href="#">Bob</a></li>
    </ul>
    </div> -->

    <!-- <div data-role="collapsible">
    <h4>C</h4>
    <ul data-role="listview">
      <li><a href="#">Calvin</a></li>
      <li><a href="#">Cameron</a></li>
      <li><a href="#">Chloe</a></li>
      <li><a href="#">Christina</a></li>
    </ul>
    </div> -->
  </div> 

  
			</div>
			</div>
		<!-- //</div>	
	</div> -->
	<div class="col-sm-10">
		
		<!--<video id="myVideo_demo" poster="http://standupcomedy.me/videop/560x315 now fits.jpg" width="100%" height="100%" controls="controls"> 
    		<source src="<?=base_url()?>admin_docs/upload_video/<?=$data[0]['video_link']?>" type="video/mp4"> 
		</video>--> 
		<!-- 
		<div style="border:1px solid #0f0;padding:10px;position:static;">
	<?php for($i=0;$i<40;$i++) { ?>	
		<?php if($i%4 == 3){ ?>
			<div style="position:relative;float:left;margin-bottom:24.5px;cursor:pointer;width:250px;rgba(f,f,f,0)" data->
				<video poster="http://standupcomedy.me/videop/560x315 now fits.jpg" height='150' width='250'>
					
					
				</video>
				<div style="width:80%; style="" ;text-align:justify;">
					<a style=""><?= $data[0]['video_name'] ?></a>
				</div>
				<div>
					<span>
						By
					</span>
					<span>
						<a style="text-decoration:none;font-weight:bold;">Xerces Blue</a>
					</span>
				</div>
				 <div class="video_play_pause" style="height:150px;width:250px;background-color:rgba(0, 0, 0, 0.5);position:absolute;top:0px;padding:60px 110px;">
				 	<span class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;"></span>
				 	<span class="glyphicon glyphicon-pause" style="font-size:28px;display:none;color:#fff;"></span>
				 </div>
			</div>
		<?php } else {  ?>
			<div style="position:relative; float:left;margin-right:24.5px;margin-bottom:24.5px;cursor:pointer;width:250px;">
				<video poster="http://standupcomedy.me/videop/560x315 now fits.jpg" height='150' width='250'>
					
					
				</video>
				<div style="width:80%;text-align:justify;">
					<a style=""><?= $data[0]['video_name'] ?>sadf asdfasf asdf asdfasd fasd fasd fasd fasd fasdfasf</a>
				</div>
				<div>
					<span>
						By
					</span>
					<span>
						<a style="text-decoration:none;font-weight:bold;">Xerces Blue</a>
					</span>
				</div>
				 <div class="video_play_pause" style="height:150px;width:250px;background-color:rgba(0, 0, 0, 0.5);position:absolute;top:0px;padding:60px 110px;">
				 	<span class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;"></span>
				 	<span class="glyphicon glyphicon-pause" style="font-size:28px;display:none;color:#fff;"></span>
				 </div>
			 </div>
		<?php } ?>
	<?php } ?>
</div> -->
<?php if(sizeof($data)>0){
$page = 1;
$page=$data[0]['page'];
$allpage= (int)$data[0]['rows']; ?>

<div class="well well-sm" id="videoContainer">
	<?php 	foreach ($data as $index => $row) : ?>
		
			<?php if($index%4 == 0){ ?>
				<div class="row" style="padding-left:7px;padding-right:7px;">
			<?php } ?>	
			<?php if($row['pay_type'] == 0){ ?>
				<!-- <a href="<?=base_url()?>Bankpo/video/<?=$row['video_item_id']?>"></a> -->
				<a href="<?=base_url()?>Bankpo/video/?id=<?=$row['video_item_id']?>&amp;catid=<?=$row['catid']?>" style="text-decoration:none;">
					<div class="col-md-3" style="padding-left:7px;padding-right:7px;">
					
						<div class="panel panel-default" style="border-radius:0px;" >
							<div class="panel-body" style="padding:5px;">
								<div style="position:relative;cursor:pointer;" >
									<!-- <div style="background-color:rgba(0,0,0,.5);position:absolute;width:100%;height:100%;" class="text-center">
										<span class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%)"></span>
									</div> -->
									 <img src="<?=base_url()?>admin_docs/upload_video/<?=$row['image']?>" class="img-responsive center-block center-crop">
									  <!-- <iframe title="YouTube video player" class="youtube-player" type="text/html" 
						               width="100%"  src="https://www.youtube.com/embed/<?=$row['youtube_key']?>"
					                   frameborder="0" allowFullScreen="true">
					                  </iframe> -->
								</div>
								<a href="<?=base_url()?>Bankpo/video/?id=<?=$row['video_item_id']?>&amp;catid=<?=$row['catid']?>" >
									<div style="width:80%;text-align:justify;cursor:pointer;">
										<?= $row['video_name'] ?>
									</div>
								</a>	
								<div>
									<span>
										By
									</span>
									<span>
										<a style="text-decoration:none;font-weight:bold;">ExamKabila</a>
									</span>
								</div>
								<!-- <span class="label label-success">
									FREE
								</span> -->
								
							</div>
						</div>
					</div>
				</a>	
			<?php } else { ?>
					<?php if($row['video_item_id'] == $row['item_id']) { ?>
						<a href="<?=base_url()?>Bankpo/video/<?=$row['video_item_id']?>" style="text-decoration:none;">
							<div class="col-md-3" style="padding-left:7px;padding-right:7px;">
								<div class="panel panel-default" style="border-radius:0px;" >
									<div class="panel-body" style="padding:5px;">
										<div style="position:relative;cursor:pointer;" >
											<div style="background-color:rgba(0,0,0,.5);position:absolute;width:100%;height:100%;" class="text-center">
												<span class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%)"></span>
											</div>
											<img src="<?=base_url()?>admin_docs/upload_video/<?=$row['image']?>" class="img-responsive center-block center-crop">
											<!-- <div class="video_play_pause" style="background-color:rgba(0, 0, 0, 0.5);position:absolute;top:0px;padding:60px 110px;">
											 	<span class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;"></span>
											 	<span class="glyphicon glyphicon-pause" style="font-size:28px;display:none;color:#fff;"></span>
										 	</div> -->
										</div>
										
										<a href="<?=base_url()?>Bankpo/video/<?=$row['video_item_id']?>" >
											<div style="width:80%;text-align:justify;cursor:pointer;">
												<?= $row['video_name'] ?>
											</div>
										</a>
										<div>
											<span>
												By
											</span>
											<span>
												<a style="text-decoration:none;font-weight:bold;">ExamKabila</a>
											</span>
										</div>
										<span class="label label-info">
											Purchased
										</span>
										
									</div>
								</div>
							</div>
						</a>	
					<?php } else { ?>
						<a href="<?=base_url()?>Bankpo/video/<?=$row['video_item_id']?>" style="text-decoration:none;">

							<div class="col-md-3" style="padding-left:7px;padding-right:7px;">
								<div class="panel panel-default" style="border-radius:0px;" >
									<div class="panel-body" style="padding:5px;">
										<div style="position:relative;cursor:pointer;" >
											<div style="background-color:rgba(0,0,0,.5);position:absolute;width:100%;height:100%;" class="text-center">
												<span class="glyphicon glyphicon-play" style="font-size:28px;color:#fff;top:50%;transform:translateY(-50%)"></span>
											</div>
											<img src="<?=base_url()?>admin_docs/upload_video/<?=$row['image']?>" class="img-responsive center-block">
											
										</div>
										
										<a href="<?=base_url()?>Bankpo/video/<?=$row['video_item_id']?>" >
											<div style="width:80%;text-align:justify;cursor:pointer;">
												<?= $row['video_name'] ?>
											</div>
										</a>
										<div>
											<span>
												By
											</span>
											<span>
												<a style="text-decoration:none;font-weight:bold;">Xerces Blue</a>
											</span>
										</div>
										<span class="label label-primary">
											<i class="fa fa-rupee"></i> <?php echo $row['pay_amount'] ?>
										</span>
										
									</div>
								</div>
							</div>
						</a>	
					<?php } ?>
			<?php } ?>		
			<?php if($index%4 == 3 || $index == (sizeof($data)-1) ) { ?>
				</div>
			<?php } ?>	

			
<?php endforeach; ?>

                
</div>
 <div class="row">
								<div class="col-sm-12 nicescroll">
									<nav>
									  <ul id ="myPager"class="pagination pagination-sm">
									    <!--  <?=base_url('Bankpo/video/'.$i);?>"><?=$i ?><li class="enabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>  -->
									    <?php if ($page==0) {
									    	$page = 1;
									    } ?>
									   <?php for($i=1;$i<=$allpage;$i++){ ?>
									   <?php if($page==$i){ ?>
									   
									    <li class="active" onclick="newwin(<?=$i ?>)" id = "<?=$i ?>" > <a style="background-color:#7ADBF0;border-color:#7ADBF0" ><?=$i ?> <span class="sr-only">(current)</span></a></li>
									    
									    <?php } else { ?>
									    
									    <li class="" onclick="newwin(<?=$i ?>)" id = "<?=$i ?>" ><a ><?=$i ?><span class="sr-only">(current)</span></a></li>
									    
									    <?php } ?>

									    
									      <?php } ?>
									        
									    
									    
									  </ul>
									</nav>
								
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-12">
								<div class="fb-comments" data-href="http://www.examkabila.com/bankpo/video" data-width="850" data-numposts="5"></div>
								</div>
							</div>	

							<!-- <div class="row">
					<div class="col-xs-12 text-center"  >
						
							<button type="button" id="next_button" class="btn btn-info btn-sm get_gk" data-id="next" style="margin-right:15px;width:50px;" disabled>next</button>
							<button type="button" id="pre_button" class="btn btn-info btn-sm get_gk" data-id="previous" style=" margin-left:15px;width:50px;" > pre </button>
							<div class="bp-docs-example"><div id="bp-get-started-initialization" style="cursor:pointer;"></div></div>	
							</div>
						
				</div> -->
	 <?php } else { ?>
				<div class="panel panel-default" style="border-radius:0px;width:100%;height:100%;text-align:center;" >No video found </div>					  
	  <?php } ?>
	<!--	<div id="screenShots">
			
		</div>
		<canvas id="canvas" 
	        width="750px" height="540px"
	        style="display:block;">
		</canvas>
		<canvas id="canvas1" 
	        width="750px" height="540px"
	        style="display:block;">
		</canvas> -->
	</div>

	
</div>