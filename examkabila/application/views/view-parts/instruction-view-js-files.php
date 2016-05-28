<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>docs/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
$( window ).load(function() {
  var H = $( window ).innerHeight();
 		var W =$( window ).innerWidth();
 		var height = H - $('#Exam_Name_Header').height() - $('#language_container').height() - $('#checkbox').height()-$('#next_page_navigation_container').height();
 		$('#language_change_container').height(height-38);
 		$('#loading_div').css("display","none");
});

$('.nicescroll').niceScroll({horizrailenabled:false});
$(window).resize(function(e){
    var H = $( window ).innerHeight();
 		var W =$( window ).innerWidth();
 		var height = H - $('#Exam_Name_Header').height() - $('#language_container').height() - $('#checkbox').height()-$('#next_page_navigation_container').height();
 		$('#language_change_container').height(height-38);
 	
 		console.log(H,W);

});
var language="";
$(document).ready(function(e) {
	 	$(window).load(function(e) {
			//$('#language_change_container').empty();
			
        	//$('#language_change_container').load('<?=base_url()?>client_requests/examtest/instruction_hindi');

				language="hi";
				ajax_call(language);
			
    	});
	
	
        $('#language').change(function()
		{
			
			var lang = $('#language option:selected').text();
			
	 		if(lang == "hindi")
	 		{
				language="hi";
				$('#instruction_english_container').css("display","none");
				$('#instruction_hindi_container').css("display","block");
				
				ajax_call(language);
	 		}
	 		else
	 		{
				language = "en";
				$('#instruction_hindi_container').css("display","none");
				$('#instruction_english_container').css("display","block");

				ajax_call(language);
	 		}
		});
		
		
	function ajax_call(lang)
	{
	
	$.ajax({
			  	type :'POST',
				url :'<?=base_url()?>client_requests/Bankpo/set_language',
				data: {"language":lang},
				dataType: 'json',
				async:true,
				
				success:function(response)
				{
					console.log(response);
					
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
	});
	}

		 $('#next_button').click(function(){
			 if($('#confirm').is(":checked"))
			 {
		        return true;
			 }
			 else
			 {
			 	
				 return false;
				 
			 }
			 
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