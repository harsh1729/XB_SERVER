		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12" style="background-color:#444444;padding-top:20px;padding-bottom:20px;">
					<div class="row">
						<div class="col-xs-9 " style="color:#7ADBF0;font-size:18px;">
							<a href="<?=base_url()?>Aboutus" style="color:#7ADBF0;"><span>About Exam Kabila</span></a>
							<span style="font-size:20px;"> | </span>
							<a href="<?=base_url()?>Blog" style="color:#7ADBF0;"><span>Blog</span></a>
							<span style="font-size:20px;"> | </span>
							<?php if(!$this->session->userdata('is_logged_in')){ ?>
								<span class="not_logged_in" onMouseOver="this.css('text-decoration', 'underline');" style="color:#7ADBF0;cursor:pointer;">Contactus</span>
							<?php } else { ?>
								<a href="<?=base_url()?>Contactus" style="color:#7ADBF0;"><span>Contactus</span></a>
							<?php } ?>
							<span style="font-size:20px;"> | </span>
							<a href="<?=base_url()?>Privacy" style="color:#7ADBF0;"><span>Privacy Policy</span></a>
							<span style="font-size:20px;"> | </span>
							<a href="<?=base_url()?>Terms" style="color:#7ADBF0;"><span>Terms</span></a>
						</div>
						 <div class="col-xs-3" style="text-align:right">
					          <div class="share_button"   style="height:50px; width:50px;display:inline-block;cursor:pointer;" data-image="<?=base_url()?>docs/images/fb_image.png" data-content="examkabila.com" data-links="http://examkabila.com">
					           <!-- <div class="fb_share_container" style="height:50px; width:50px;display:inline-block;cursor:pointer;"> -->
						      <img src="<?=base_url('docs/images/fbnew.png')?>">
						
					         </div>
					         <div class="twiter_container" style="height:50px; width:50px;display:inline-block;margin-left:20px;cursor:pointer;">
						     <img src="<?=base_url('docs/images/twiter.png')?>">
			                 </div>
					
					         <div class="google_container" style="height:50px; width:50px;display:inline-block;margin-left:20px;cursor:pointer;">
						     <img src="<?=base_url('docs/images/gplus.png')?>">
					         </div>
				       </div>
					</div>

			          	
			        
					<div class="row">
						<div class="col-xs-12 " style="color:#fff;">
							<span>&copy; Copyright2015 -- All Rights Reserved</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>docs/js/jquery.nicescroll.min.js"></script>
		<script src="<?=base_url()?>docs/js/script.js"></script>
		<?=$js;?>
	</body>
</html>