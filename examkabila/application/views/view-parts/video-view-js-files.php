<script src="https://raw.github.com/carhartl/jquery-cookie/master/jquery.cookie.js"></script>
<script src="<?=base_url()?>docs/js/bootstrap-paginator.min.js"></script>
<script type="text/javascript">
		 
$('#menu_container').css("display","block");
$('#loading_div').css("display","none");
//$('#vikas1').options.flash.swf = "http://standupcomedy.me/video-js/video-js.swf"

// $('#myVideo_demo').videocontrols( 
//         { 
//            // markers: [40, 84, 158, 194, 236, 272, 317, 344, 397, 447, 490, 580], 
//             preview: 
//             { 
//                 sprites: [], 
//                 step: 10, 
//                 width: 170,
//                 height:70,
//                 wide:7000
              
//             },
//             theme: 
//             { 
//                 progressbar: 'blue', 
//                 range: 'pink', 
//                 volume: 'pink' 
//             } 
//         }); 



/* var i =0;
var video = document.getElementById("myVideo_demo");
video.addEventListener("loadedmetadata", initScreenshot);
video.addEventListener("playing", startScreenshot);
video.addEventListener("pause", stopScreenshot);
video.addEventListener("ended", stopScreenshot);

var canvas = document.getElementById("canvas");
var canvas1 = document.getElementById("canvas1");
var ctx = canvas.getContext("2d");
var ctx1 = canvas1.getContext("2d");
var ssContainer = document.getElementById("screenShots");
var videoHeight, videoWidth;
var drawTimer = null;

function initScreenshot() {
  videoHeight = video.videoHeight; 
  videoWidth = video.videoWidth;
  canvas.width = videoWidth;
  canvas.height = videoHeight;
}

function startScreenshot() {
  if (drawTimer == null) {
    drawTimer = setInterval(grabScreenshot, 1000);
  }
}

function stopScreenshot() {
  if (drawTimer) {
    clearInterval(drawTimer);
    drawTimer = null;
  }
}

function grabScreenshot() {
	
	var x = i*200;
ctx.drawImage(video, 0, 0, videoWidth, videoHeight);
  var img = new Image();
  
	  img.src = canvas.toDataURL("image/png");
	  img.width = 200;
	 // ssContainer.appendChild(img);
	 var ctx1 = canvas1.getContext("2d");
	ctx1.drawImage(img, 0, 0,videoWidth,videoHeight);

	if(i%10 == 0)
	{
		var img1 = new Image();
		img1.src = canvas1.toDataURL("image/png");
		img1.width = 200;
		ssContainer.appendChild(img1);

	}
  
  i = i+1;
  

}*/
/*$(document).ready(function() {
    var last=$.cookie('activeAccordionGroup');
    if (last!=null) {
        //remove default collapse settings
        $("#accordion .collapse").removeClass('in');
        //show the last visible group
        $("#"+last).collapse("show");
    }
});

//when a group is shown, save it as the active accordion group
$("#accordion").bind('shown', function() {
    var active=$("#accordion .in").attr('id');
    $.cookie('activeAccordionGroup', active)

});*/
var mainCate = 0;
var lang_type=[];

/*$(document).ready(function () {
   
    $('.main').click(function () {
    	var ur = $(this).attr('href');
    	console.log(ur);
        var $clicked = $(this);
        // Hide any active divs (only)
        $(".list-group a.active").removeClass("active").next("div").collapse("hide");
        // Find the target anchor based on the name attribute in the clicked item
        var $targeta = $('.list-group a[name="' + $clicked.attr("name") + '"]').addClass("active");
        // Load the panel based on the clicked item
        $('#contenuti').load($(this).attr("name") + '.php');
        // then open the clicked div
        $targeta.next('div').collapse('show');

    });
});*/
var page =1;
//LANNAMESPACE = {};
/*$(document).ready(function(){
$('#myPager').pagination(100,{callback:function(page,component){
    console.log(page);
}});
});*/


$('.collapse').on('show.bs.collapse', function (e) {
    // Get clicked element that initiated the collapse...
    //var clicked = $(document).find("[href='#" + $(e.target).attr('id') + "']");
       mainCate = this.id;
     console.log(mainCate);
});
    
/* var options = {
            currentPage: 3,
            totalPages: 10,
            itemContainerClass: function (type, page, current) {
                return (page === current) ? "active" : "pointer-cursor";
            }
        }

        $('#bp-get-started-initialization').bootstrapPaginator(options);*/


 var parrentid = '<?php echo $parrentid; ?>';
 console.log(parrentid);
 if(parrentid!=0)
   $("#"+parrentid).collapse('show');
 

$('.checkbox').change(function(e){
	
	var price_type=[];
	
	$(this).attr('checked','checked');
	
	
	if($('#price1').is(':checked'))
	{
			
		price_type[0] =	$('#price1').val();
			
	}
	else
	{
		price_type[0] = '';
	}
	if($('#price2').is(':checked'))
	{
			
		price_type[1] =	$('#price2').val();
			
	}
	else
	{
		price_type[1] = '';
	}
	

	
	
	
	
	
		if($('#lang1').is(':checked'))
		{
			
			lang_type[0] =	$('#lang1').val();
			
		}
		else
		{
			lang_type[0] = '';
		}
		
		if($('#lang2').is(':checked'))
		{
			
			lang_type[1] =	$('#lang2').val();
			
		}
		else
		{
			lang_type[1] = '';
		}
        id = 0;
        var items = document.getElementsByClassName("list-group-item active");
        if(items.length!=0){
           var id = items[0].id;
           console.log(id);  
        }
         
		/*function fun() { 
         var queueData = document.getElementById("ancor").value; 
         document.getElementById('ancor').href = queueData+"&lang_type="+JSON.stringify(lang_type);
         console.log("queueData");
     }*/
    //some more code
     
   
	//window.location =global_namespace.baseurl+"Bankpo/video?price_type="+JSON.stringify(price_type)+"&lang_type="+JSON.stringify(lang_type); 

//change for free video only remove price_type
 if(id!=0)
	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+id+"&isparrent=0&page=1"; 
 else{
 	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=1&page=1"; 
 }
  
});

$(document).on('click','#maincate',function(e){ 

	mainCate =  $(this)[0].className;
	//console.log(name);
	if($('#lang1').is(':checked'))
		{
			
			lang_type[0] =	$('#lang1').val();
			
		}
		else
		{
			lang_type[0] = '';
		}
		
		if($('#lang2').is(':checked'))
		{
			
			lang_type[1] =	$('#lang2').val();
			
		}
		else
		{
			lang_type[1] = '';
		}
        
        
           
        
      window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=1&page=1"; 
    
});


/*$(document).on('click','#myPager',function(e){ 

	var items = document.getElementsByClassName("active");
	/*if(items.length!=0){*
           page = items[0].id;
           console.log(page);  
        //}

        id = 0;
        var items = document.getElementsByClassName("list-group-item active");
        if(items.length!=0){
           var id = items[0].id;
           console.log(id);  
        }

	if($('#lang1').is(':checked'))
		{
			
			lang_type[0] =	$('#lang1').val();
			
		}
		else
		{
			lang_type[0] = '';
		}
		
		if($('#lang2').is(':checked'))
		{
			
			lang_type[1] =	$('#lang2').val();
			
		}
		else
		{
			lang_type[1] = '';
		}
        
        
           
     if(lang_type[0]!='' || lang_type[0]!='' ){
    	//window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=0&page="+page; 
     if(id!=0)
	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+id+"&isparrent=0&page="+page; 
  else if(mainCate!=0){
 	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=1&page="+page; 
  } else{
 	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=0&page="+page; 
  }
     } else{
     	 
     	if(id!=0)
	    window.location =global_namespace.baseurl+"Bankpo/video?catid="+id+"&isparrent=0&page="+page; 
  else if(mainCate!=0){
 	window.location =global_namespace.baseurl+"Bankpo/video?catid="+mainCate+"&isparrent=1&page="+page; 
  } else{
 	window.location =global_namespace.baseurl+"Bankpo/video?catid="+mainCate+"&isparrent=0&page="+page; 
  }
     }  
    
    
});*/
//LANNAMESPACE.loadValues();
function newwin(idselected) {
console.log("SUSHIL"+idselected); 
        id = 0;
        var items = document.getElementsByClassName("list-group-item active");
        if(items.length!=0){
           var id = items[0].id;
           console.log(id);  
        }             
 if($('#lang1').is(':checked'))
		{
			
			lang_type[0] =	$('#lang1').val();
			
		}
		else
		{
			lang_type[0] = '';
		}
		
		if($('#lang2').is(':checked'))
		{
			
			lang_type[1] =	$('#lang2').val();
			
		}
		else
		{
			lang_type[1] = '';
		}
        
        
           
     if(lang_type[0]!='' || lang_type[0]!='' ){
    	//window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=0&page="+page; 
     if(id!=0)
	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+id+"&isparrent=0&page="+idselected; 
  else if(mainCate!=0){
 	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=1&page="+idselected; 
  } else{
 	window.location =global_namespace.baseurl+"Bankpo/video?lang_type="+JSON.stringify(lang_type)+"&catid="+mainCate+"&isparrent=0&page="+idselected; 
  }
     } else{
     	 
     	if(id!=0)
	    window.location =global_namespace.baseurl+"Bankpo/video?catid="+id+"&isparrent=0&page="+idselected; 
  else if(mainCate!=0){
 	window.location =global_namespace.baseurl+"Bankpo/video?catid="+mainCate+"&isparrent=1&page="+idselected; 
  } else{
 	window.location =global_namespace.baseurl+"Bankpo/video?catid="+mainCate+"&isparrent=0&page="+idselected; 
  }
    
}
}
</script>