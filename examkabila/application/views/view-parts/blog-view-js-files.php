<script type="text/javascript">
	
	$('#facebook_container').css("display","block");
$('#bank_notice_container_click').css("display","block");
$('#menu_container').css("display","block");
$('#loading_div').css("display","none");

///////////////////////////////////fb end like



/////////////////////////////////// fb start share


 window.fbAsyncInit = function() {
		FB.init({
		  appId  : '448875151951154',
		  status : true, // check login status
		  cookie : true, // enable cookies to allow the server to access the session
		  xfbml  : true  // parse XFBML
		});
	  };
	
	  (function() {
		var e = document.createElement('script');
		e.src = 'http://connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	  }());
	  
	  
	$(document).on('click','.share_button' ,function(e){
	 var content = $(this).data('content');
	 var links = $(this).data('links');
	 var image = $(this).data('image');
	
	e.preventDefault();
	FB.ui(
	{
	method: 'feed',
	name: ''+content,
	link: ''+links,
	picture: ''+image,
	
	
	});
	});


////////////////////////////////////fb end share





$(document).on('click','.get_gk',function(e)
{
	var id = $(this).data('id');
	if(id == 'next')
	{
		off_set = off_set-1;
		if(off_set == 1)
		{
			
			$('#next_button').prop('disabled', true);
		}
	}
	else
	{
		off_set = off_set+1;
		if(off_set >1)
		{
			$('#next_button').prop('disabled', false);
		}

	}


	

});
$(document).ready(function(e){

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



	$(document).on('submit','.blog_comment_submit',function(e){

		var target = $(this).parent().parent().next().children().first().children().first();
		var target1 =$(this).parent().parent().next().children().first();
        $('#loading_bar').css("display","block");
        var message = $(this).find('.message');
        var blog_comment = $(this).find('.message').text(); 
        var blog_id = $(this).data('blogid');
        var total_comment = $(this).prev().find('.total_comment');
        console.log(blog_id);
        console.log(blog_comment);
        var username = $(this).find('.message').data('username');
       

        var data = " <div style='height:40px;margin-left:20px;margin-bottom:10px;'>"+
							"<span class='glyphicon glyphicon-user' style='float:left;border:1px solid #ddd;font-size:40px;'>"+
							"</span>"+
							"<div style='margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;'>"+username+"</div><br>"+
							"<div style='margin-left:10px;font-size:12px;display:inline-block;line-height:.2em;'>"+blog_comment+"</div>"+

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
                                                data : {'blog_comment':blog_comment,'blog_id':blog_id},
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
	var blog_id = $(this).data('blogid');
	var formurl =  $(this).data('url');
	var comment_target = $(this);


	 $.ajax(
            {
              	url : formurl,
                type: "POST",
                data : {'offset':offset,'blog_id':blog_id},
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

$(document).on('click','.left_panal_blog',function(e){
	var blog_id = $(this).data('id');
	var formURL = $(this).data('url');


	 									$.ajax(
                                            {
                                                url : formURL,
                                                type: "POST",
                                                data : {'blog_id':blog_id},
                                                dataType:"html",
                                                async:false,
                                                success:function(data) 
                                                {
                                               		
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) 
                                                {
                                                    $('#loading_bar').css("display","none");
                                                     
                                                    console.log(textStatus,errorThrown,jqXHR)   ;
                                                }
                                            });



});



});

</script>