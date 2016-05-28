<script src="<?=base_url()?>docs/js/bootstrap-paginator.min.js"></script>

<script type="text/javascript">
//var center_container = $('.center_container');
//	var center_content = $('.center_content');
$('#facebook_container').css("display","block");
$('#bank_notice_container_click').css("display","block");
$('#menu_container').css("display","block");
$('#language_container').css("display","block");

var off_set =1
$('#loading_div').css("display","none");

$('#bank_test_container').children().last().css('margin-bottom',0+'px');
function videoplayPause() 
{ 
	var myVideo = document.getElementById("examkabila_intro_video");	
	
    if (myVideo.paused) 
        myVideo.play(); 
    else 
        myVideo.pause(); 
} 


/////////////////////////////////fb start like




(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=448875151951154";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));








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


	$.ajax({
			  	type :'POST',
				url : global_namespace.baseurl+'client_requests/Bankpo/get_gk',
				data: {'off_set':off_set},
				dataType:'json',
				async:true,
				
				success:function(response)
				{
					if(response.length > 0)
					{
						$('#current_gk_container').empty();
						for(i=0;i<response.length;i++)
						{
							var data = "<div style='margin-bottom:10px;font-size:17px;'>"+
								"<div style='float:left;font-weight:bold;margin-right:10px;'><div style='height:10px;width:10px;border-radius:5px;background-color:#333;margin-top:5px;'></div></div><div style='font-weight:550;'>"+response[i].ques_text+"</div>"+
							"</div>";

							$(data).appendTo('#current_gk_container');
						}
					}
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:",errorThrown,jqXHR,textStatus);
				}


	});

});
	
	
// facebook center function start  .../ ////// //// / // /


function getStartedInitialization(page){
        var options = {
            currentPage: 1,
            totalPages: page,
            size:"normal",
            numberOfPages:4,
             onPageChanged: function(e,oldPage,newPage){
                $('#page-changed-alert-content').text("Current page changed, old: "+oldPage+", new: "+newPage);
                $.ajax({
					  	type :'POST',
						url : global_namespace.baseurl+'client_requests/Bankpo/get_gk',
						data: {'off_set':newPage},
						dataType:'json',
						async:true,
						
						success:function(response)
						{
							if(response.length > 0)
							{
								$('#current_gk_container').empty();
								var dates = "2015-02-24";
								for(i=0;i<response.length;i++)
								{
									var g = (response[i].date).search(dates);
									
									if( g >= 0)
									{
										var data = "<div style='margin-bottom:10px;font-size:17px;'>"+
										"<div style='float:left;font-weight:bold;margin-right:10px;'><div style='height:10px;width:10px;border-radius:5px;background-color:#333;margin-top:5px;'></div></div><div style='font-weight:550;'>"+response[i].GkContent+"</div>"+
									"</div>";

									$(data).appendTo('#current_gk_container');
									 dates = response[i].date;
									}
									else
									{
										var data = "<div style='font-size:20px;font-weight:bold;color:#333;margin-bottom:5px;font-style: italic;'> Updated on "+response[i].date+" </div><div style='margin-bottom:10px;font-size:17px;'>"+
										"<div style='float:left;font-weight:bold;margin-right:10px;'><div style='height:10px;width:10px;border-radius:5px;background-color:#333;margin-top:5px;'></div></div><div style='font-weight:550;'>"+response[i].GkContent+"</div>"+
									"</div>";

									$(data).appendTo('#current_gk_container');
									dates = response[i].date;
									}
									
								}
							}
						},
						error:function(jqXHR,textStatus,errorThrown)
						{
							console.log("Error:",errorThrown,jqXHR,textStatus);
						}


					});
                	
            }
        }


        

        $('#bp-get-started-initialization').bootstrapPaginator(options);
    }

  

    $(function(){




    			$.ajax({
					  	type :'POST',
						url : global_namespace.baseurl+'client_requests/Bankpo/get_gk_page',
						data: "",
						dataType:'json',
						async:true,
						
						success:function(response)
						{
							if(response == "")
							{
								getStartedInitialization(10);
							}
							else
							{
								var num = parseInt(response);
								getStartedInitialization(num);
							}
						},
						error:function(jqXHR,textStatus,errorThrown)
						{
							console.log("Error:",errorThrown,jqXHR,textStatus);
						}


					});


        
       

        $('#navbar').scrollspy({offset:100})

        $("a[href^='#']").click(function(e){
            e.preventDefault();


            var href = $(this).attr("href"),
                id = href.substr(href.indexOf('#')),
                item = $(id);

            if(!item || item.length < 1)
            {
                return;
            }

            var  position = item.position(),
                 top = position.top;

            console.log(window.location.pathname)

            History.replaceState({state:3},"State 3",window.location.pathname+id)

            $('body').animate({scrollTop:top-50}, 1000)
        })

    })

    $(document).ready(function() {
        $('pre').each(function(i, e) {
            hljs.highlightBlock(e)
        });

    });

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67214090-1', 'auto');
  ga('send', 'pageview');

</script>