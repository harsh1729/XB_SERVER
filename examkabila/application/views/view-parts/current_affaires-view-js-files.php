<script type="text/javascript">
	$('#menu_container').css("display","block");
$('#loading_div').css("display","none");

/*window.fbAsyncInit = function() {
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
      }());*/
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

      
</script>