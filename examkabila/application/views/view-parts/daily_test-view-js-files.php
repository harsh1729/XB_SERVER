<script type="text/javascript">
	$('#menu_container').css("display","block");
$('#loading_div').css("display","none");
var parrent_category = 1;
var container = 'reasoning_container';
$(window).load(function(e)
{
          console.log("before");
	get_category(parrent_category);
          console.log("after");
});

$(document).on('click','.tab_click',function(e){

	var temp_cat = $(this).data('cat');
	var temp_container = $(this).data('id');
	if(temp_cat == 6)
	{
		container = temp_container;
                $('#'+container).empty();
		var data1 = "<a href='"+global_namespace.baseurl+"bankpo/daily_test_exam/current_affaire'><button class='btn btn-lg btn-default' style='cursor:pointer; margin:30px;color:#337ab7;'>"+
                           						"Current Affairs"+
                           					"</button></a>";
                           				$(data1).appendTo( "#"+container);
	}
	else
	{
		container = temp_container;
		get_category(temp_cat);
	}

});

	function get_category(cat)
	{
		 $.ajax(
                    {
                        url : global_namespace.baseurl+'client_requests/Bankpo/get_all_category',
                        type: "POST",
                        data : {'cat':cat},
                        dataType:"json",
                        success:function(data) 
                        {
                           console.log(data);
                           $('#'+container).empty();
                           for(i=0;i<data.length;i++)
                           {
                           		var data1 = "<a href='"+global_namespace.baseurl+"bankpo/daily_test_exam/"+data[i].id+"'><button class='btn btn-lg btn-default' style='cursor:pointer; margin:30px;color:#337ab7;'>"+
                           						""+data[i].category+""+
                           					"</button></a>";
                           				$(data1).appendTo( "#"+container);	
                           }
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                            $('#loading_bar').css("display","none");
                            console.log(jqXHR,textStatus,errorThrown);
                            
                        }
                });
            
        
    }

var tabsFn = (function() {
  
  function init() {
    setHeight();
  }
  
  function setHeight() {
    var $tabPane = $('.tab-pane'),
        tabsHeight = $('.nav-tabs').height();
    
    $tabPane.css({
      height: tabsHeight
    });
  }
      
  $(init);
})();
</script>