<script type="text/javascript" src="<?=base_url()?>docs/js/jquery.videocontrols.js"></script>
<script type="text/javascript">
	$('#menu_container').css("display","block");
	$('#loading_div').css("display","none");

	/*$('#myVideo_demo').videocontrols( 
        { 
           theme: 
            { 
                progressbar: 'blue', 
                range: 'pink', 
                volume: 'pink' 
            } 
        }); 
	$('#video_play_pause').click(function(e){
		$('#video_play').css('display','none');
		$('#video_pause').css('display','block');
		$('#video_pause').animate({
         fontSize: 100,
         opacity:0
		}, 500 , function() {
    		$('#video_play_pause').css('display','none');
    		$('#video_pause').css({ 'font-size': 20 });
    		var vid = document.getElementById("myVideo_demo"); 
    		vid.play();
  		});
		
      $('#myVideo_demo').on('pause',function(e){
      		$('#video_play_pause').css('display','block');
      		$('#video_play').css('display','block');
      		$('#video_pause').css('display','none');
      		$('#video_pause').css('opacity', '1');

      }); 
		
	});	*/

	$('.message').focus(function() {
		$(this).parent().parent().next( "button" ).prop('disabled', true);
		$(this).parent().parent().next( "button" ).fadeIn(1000);
	});
	$('.message').focusout(function() {
		
		$(this).parent().parent().next( "button" ).fadeOut(500);
	});
	$('.message').keyup(function(e) {

		var x = $(this).text();
		x = x.replace(/^\s+|\s+$/g, '');
  		if(x != "")
  		{
  			$(this).parent().parent().next( "button" ).prop('disabled', false);
  		}
  		else
  		{
  			$(this).parent().parent().next( "button" ).prop('disabled', true);
  		}

	});





	$(document).on('submit','.video_comment_submit',function(e){

		var target = $(this).parent().parent().next().children().first().children().first();
		var target1 =$(this).parent().parent().next().children().first();
        $('#loading_bar').css("display","block");
        var message = $(this).find('.message');
        var video_comment = $(this).find('.message').text(); 
        var video_id = $(this).data('videoid');
        var total_comment = $(this).prev().find('.total_comment');
        console.log(video_id);
        console.log(video_comment);
        var username = $(this).find('.message').data('username');
        var userid = $(this).find('.message').data('userid');
       

        var data = " <div style='height:40px;margin-left:20px;margin-bottom:10px;'>"+
							"<span class='glyphicon glyphicon-user' style='float:left;border:1px solid #ddd;font-size:40px;'>"+
							"</span>"+
							"<div style='margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;'>"+username+"</div><br>"+
							"<div style='margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;'>"+video_comment+"</div>"+

					"</div>";
		if(target.length > 0)
		{
			$(data).insertBefore(target);
        }
        else
        {
        	$(data).appendTo(target1);
        }
        
       var formURL = $(this).attr("action");
                                        $.ajax(
                                            {
                                                url : formURL,
                                                type: "POST",
                                                data : {'video_comment':video_comment,'video_id':video_id},
                                                dataType:"json",
                                                async:true,
                                                success:function(data) 
                                                {
                                               		$('#loading_bar').css("display","none");
                                                      
                                                        message.html("");
                                                        total_comment.text(data);
                                                       
                                                        
                                                
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) 
                                                {
                                                    $('#loading_bar').css("display","none");
                                                     
                                                    console.log(textStatus,errorThrown,jqXHR)   ;
                                                }
                                            });
                                            e.preventDefault(); 
        
		});


$(document).on('click','.see_more',function(e){

	var offset = parseInt($(this).next().val());
	var hidden = $(this).next();
	var video_id = $(this).data('videoid');
	var formurl =  $(this).data('url');
	var comment_target = $(this);


	 $.ajax(
            {
              	url : formurl,
                type: "POST",
                data : {'offset':offset,'video_id':video_id},
                dataType:"json",
                async:true,
                success:function(data) 
                {
	                $('#loading_bar').css("display","none");
	                 
	               for(z=0;z<data.length;z++)
	               {
	               		var a = " <div style='height:40px;margin-left:20px;margin-bottom:10px;'>"+
							"<span class='glyphicon glyphicon-user' style='float:left;border:1px solid #ddd;font-size:40px;'>"+
							"</span>"+
							"<div style='margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;'>"+data[z].username+"</div><br>"+
							"<div style='margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;'>"+data[z].text+"</div>"+

							"</div>";
							$(a).insertBefore(comment_target);
	               }
	               if(data.length <10)
	               {
	               	 comment_target.css('display','none');
	               }
	               hidden.val(offset+10);
                    
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    $('#loading_bar').css("display","none");
                   
                    console.log(textStatus,errorThrown,jqXHR)   ;
                }
            });
            e.preventDefault(); 


});


</script>