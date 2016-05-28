<script type="text/javascript">
	
$('#menu_container').css("display","block");

$('#loading_div').css("display","none");


$('#contactus_form').submit(function(e)
{
			
			
	var action = $('#contactus_form').attr("action");
	var form_data= $('#contactus_form').serializeArray();
	$.ajax({
				
				type :'POST',
				url :action,
				data: form_data,
				dataType:'json',
				async:false,
				success:function(response)
				{
					
					if(response == 'success')
					{
						$('#username_contact').val('');
						$('#usermessage').val('');
						alert("Message Successfully Delivered");
					}	
						
					
					
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					console.log(jqXHR,textStatus,errorThrown)			
					alert("an error acured");     
				}
				
		});
		
		e.preventDefault();
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