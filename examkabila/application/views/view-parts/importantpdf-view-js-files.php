<script type="text/javascript">
	$('#facebook_container').css("display","block");
$('#bank_notice_container_click').css("display","block");
$('#menu_container').css("display","block");
$('#language_container').css("display","block");

$('#loading_div').css("display","none");

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




$('.importantpdf').click(function(e){

	var id = $(this).data('pdfid');
    $.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/updatedownload',
				data: {'pdfid':id},
				dataType: 'json',
				async:true,
				
				success:function(response)
				{
					
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
	});
});
</script>