		<?=$header;?>
              <div id="loading_bar" style="height:700px;width:100%; background-color:rgba(102,102,102,.5); z-index:1100; position:fixed; display:;">
					<img src="admin_docs/images/ajax-loader-blue.gif" style="margin-top:18%; margin-left:45%;">
              </div>
			<div class="container-fluid" style="padding-bottom:10px; background-color:#fff;">
                  <div style="background-color:#CCC;padding-top:10px;padding-bottom:10px;">
			<div class="row" style="">
				<div class="col-sm-1 col-xs-12">
					
                </div>
                <div class="col-md-8 hidden-xs">
                	<span><button type="button" class="imeboldbtn btn btn-sm btn-info" title="Bold"><b>B</b></button></span>
			<span><button type="button" class="imeitalicbtn btn btn-sm btn-info" title="Italic"><i>I</i></button></span>
			<span><button type="button" class="imeunderlinebtn btn btn-sm btn-info" title="Underline"><u>U</u></button></span>
			<span><button type="button" class="imefontsizebtn btn btn-sm btn-info" title="Text size"><span class="glyphicon glyphicon-signal"></span></button></span>
			<span><button type="button" class="imelinkbtn btn btn-sm btn-info" title="Add Link">li</button></span>
                </div>
              
            </div>
		</div>
	</div>
</div>
</div>
<div class="container-fluid" style="min-height:89vh;">
	<form id="video_submit_form" action="<?=base_url()?>admin_request/video/submit_video" method="post">
		<div class="row">
			<div class="col-sm-3">
				<select class="form-control" required id="video_pay_type" name="video_pay_type">
					<option value="">--select pay type--</option>
					<option value="0">Free</option>
					<option value="1">pay</option>
				</select>	
			</div>
			<div class="col-sm-3">
				<select class="form-control"  id="video_amount" name="video_amount" style="display:none;">
					<option value="">--select pay amount--</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
				</select>
			</div>

			
		</div>
		<div class="row" style="margin-top:20px;">
			<div class="col-sm-9">
				Name:-<div class="form-control lang_class" contenteditable="true" id="video_name" name="video_name" style="margin-bottom:30px;overflow:auto;">
					
				</div>
				Discription:-<div class="form-control lang_class" contenteditable="true" id="video_discription" name="video_discription" style="height:100px;overflow:auto">
					
				</div>
			</div>
			<div class="col-sm-3">
				<div id="videodropzone" class="dropzone text-center "  action="<?=base_url()?>admin_request/video/upload_video" style="height:210px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;"></div>
		             <input type="hidden" id="video_link" name="video_link">
			</div>
		</div>
		<div class="row" style="margin-top:100px;">
			<div class="col-sm-5">
				
			</div>
			<div class="col-sm-2">
				<input type="submit" class="btn btn-lg btn-success" value="submit">
			</div>
			<div class="col-sm-5">
				
			</div>
		</div>
	</form>	
</div>