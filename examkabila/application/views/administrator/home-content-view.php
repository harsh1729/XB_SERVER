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
	<form id="blog_submit_form" action="<?=base_url()?>admin_request/blog/submit_status">
	<div class="row">
				<div class="col-sm-3">
					<select class="form-control" style="margin-bottom:10px;" id="status_category" name="status_category">
					<option value="">select category</option>
					<option value="1">current affairs reading</option>
					<option value="2">current affair questions</option>
					<option value="3">exam alert</option>
					<option value="4">Blog</option>
						
					</select>
				</div>
				
			

				<div class="col-sm-3">
					
             			<select id="status_language" class="form-control">
             				<option value="">Choose Language</option>
              				<option value="hi" selected="true">Hindi</option>
               				<option value="en">English</option>
               			</select>
             		
           		</div>   
           		<div class="col-md-6">
           			<div class="row">
							<div class="col-md-3 col-sm-4" >
					<div style="position:absolute;margin-top:3px;">Left</div> <input class="" type="radio" value="left" checked="checked" name="image_align" style="height:20px;width:20px;margin-left:55px;">	
				</div>
				<div class="col-md-3 col-sm-4" >
					<div style="position:absolute;margin-top:3px;">Right</div> <input class="" type="radio"  value="right" name="image_align" style="height:20px;width:20px;margin-left:55px;">	
				</div>
				
			</div>
           		</div>
						
				
				
	</div>
	<div class="row">
		<div class="col-sm-9">
			
			<div class="row">
				<div class="col-md-12">
					Enter Name:- <div class="lang_class form-control" contenteditable="true" id="status_name" style="height:40px;overflow:auto;">
						
					</div>
				</div>
				
			</div>
			<div class="row" style="margin-top:20px;">
				<div class="col-sm-12 " >
					Enter text:-<div class="lang_class form-control" contenteditable="true" id="status_text" style="height:140px;overflow:auto;">
						
					</div>
				</div>
				
			</div>

		</div>
		<div class="col-sm-3">
			
			<div class="row">
				<div class="col-sm-12">
					<div id="blogdropzone" class="dropzone text-center "  action="<?=base_url()?>admin_request/blog/upload_image" style="height:210px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;"></div>
		         	<input type="hidden" id="status_link_image" name="status_link_image">	
				</div>
			
			</div>
				
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
</div>