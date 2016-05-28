<script type="text/javascript">
	$('#facebook_container').css("display","block");
$('#bank_notice_container_click').css("display","block");
$('#menu_container').css("display","block");
$('#loading_div').css("display","none");
$('#language_container').css("display","block");

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



$('.download_btn').click(function(e){


        var id = $(this).data('pdfid');	
                $.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/updatedownload',
				data: {'pdfid':id},
				dataType: 'json',
				async:true,
				
				success:function(response)
				{
					//alert(id);
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
	              });
 var b = $(this);
		$(this).prop("disabled",true);
		
		
		$( "<div style='position:absolute;right:190px;' id='download_alert"+id+"'>please wait ! your download will start in few seconds</div>" ).insertBefore(b);
		
			setTimeout(function(){ $( "#download_alert"+id ).remove();
			b.prop("disabled",false);
			 }, 14000);
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