	

	var global_namespace = {};
	global_namespace.url = window.location.origin;
	global_namespace.rootdirectory = ""
	global_namespace.baseurl = window.location.origin+"/"+global_namespace.rootdirectory;
	global_namespace.domainname = window.location.origin;
	global_namespace.ajax_loader_img_1 = global_namespace.baseurl+"admin_docs/images/ajax-loader.gif";

	var center_container = $('.center_container');
	var center_content = $('.center_content');

	vertical_align_center(center_container,center_content);

	function vertical_align_center(containter,element)
	{
		var h = containter.height();
		var element_h = element.height();
		var margin = (h - element_h)/2;
				 element.css("top",margin);
	}
var menu_flag = false;
var controller='Bankpo';
/////////////////////////////// nice scroll work








$('.nicescroll').niceScroll({horizrailenabled:false});

$('body').niceScroll({horizrailenabled:false});


/////////////// nice scroll bar ////////////////////////

$('#cart_content').niceScroll();
$('.nicescroll').niceScroll();

//////////////////// +++++ ++++ ++ ++ ++ ++ ++ + end nice scroll bar ////////////

$(window).load(function()
{
	//add_content_cart();
});

/////////status not login then click work start

$(document).on('click','.not_logged_in',function(e)
{
   var a =$(this).data('controller');
console.log(a);
    if($(this).data('controller'))
     {
         controller = $(this).data('controller');
	$("#login_form_container").slideDown("medium");
     }
    else
   {
	controller = 'Bankpo';
$("#login_form_container").slideDown("medium");
    }
});





/////////// exam alert work


$.ajax({
			type :'POST',
			url : global_namespace.baseurl+'client_requests/Bankpo/examalert',
			data: '',
			dataType:'json',
			async:true,
			success:function(response)
			{
				if(response.length > 0)
				{
					for(i=0;i<response.length;i++)
					{
						var data = "<div>"+
										"<div class='text-center' style='font-weight:bold;'>"+
											response[i].name+
										"</div>"+
										"<div class='text-center'>"+
											"Opening Date:"+response[i].openingdate+
										"</div>"+
										"<div class='text-center'>"+
											"Last Date:"+response[i].lastdate+
										"</div>"+
										"<div style='float:right;'> "+
											"<a href='"+response[i].link+"' target='_blank'>See Details..</a>"+
										"</div>"+
									"</div><br><br>";
							$("#bank_notice_container_content").append(data);
					}
				}
				else
				{
					var data = "<div>"+
									"There is no lattest exam alert"+	
									"</div><br><br>";
							$("#bank_notice_container_content").append(data);

				}
			},
			error:function(jqXHR,textStatus,errorThrown)
			{
				console.log("Error:",errorThrown,jqXHR,textStatus);
			}	
			
		});

///////  cart word .............. /////// /// / / / / / / / / / / / / /
var cart_count =1;
var items =0;


function add_content_cart()
{
	$.ajax({
										  	type :'POST',
											url : global_namespace.baseurl+'client_requests/Cart/get_cart',
											data: '',
											dataType:'json',
											async:true,
											
											success:function(response1)
											{
												if(response1.length>0)
												{
													$('#cart_cancel').prop('disabled',false);
													$('#cart_buy_button').prop('disabled',false);
													$('#cart').css("display","block");

												}
												else
												{
													$('#cart_cancel').prop('disabled',true);
													$('#cart_buy_button').prop('disabled',true);
													$('#cart').css("display","none");
												}
												$('#cart_content').empty();
												
												for(i=1;i<=response1.length;i++)
												{
													 var cart_data = 	"<div style='padding:10px;color:#fff;width:100%;font-size:16px;' id='content_container_"+i+"'>"+
  																			"<span style='font-weight:bold'>"+i+".</span>"+
  																			"<span style='margin-left:10px;'>"+response1[i-1].name+"</span>"+
  																			"<span style='margin-left:15px;'>20/-</span>"+
  																			"<span style='margin-left:25px;'><button data-id="+response1[i-1].id+"  type='button' data-contaienerid='content_container_"+i+"' class='btn btn-danger delete_cart_content'>delete</button></span>"+
  																		"</div>";
  																		$( "#cart_content" ).append( $( cart_data ));
  																items++;		

												}
																		$('#cart_total_items').empty();
  																		$('#cart_total_money').empty();		
  																		$('#cart_total_items').append('Items = '+items);
  																		$('#cart_total_money').append('RS = '+(items*20));
$('#loading_div').css("display","none");
  																		items =0;
											},
											error:function(jqXHR,textStatus,errorThrown)
											{
												console.log("Error:",errorThrown,jqXHR,textStatus);
											}
								});
}

function delete_content_cart()
{
$('#loading_div').css("display","block");
$.ajax({
										  	type :'POST',
											url : global_namespace.baseurl+'client_requests/cart/empty_cart',
											data: '',
											dataType:'json',
											async:true,
											
											success:function(response1)
											{
												
                                                                                               add_content_cart();
												console.log("success");
                                                                                               $('#loading_div').css("display","none");
											},
											error:function(jqXHR,textStatus,errorThrown)
											{
												console.log("Error:",errorThrown,jqXHR,textStatus);
											}
					});
}


function delete_single_content_cart(id)
{
$('#loading_div').css("display","block");
	$.ajax({
										  	type :'POST',
											url : global_namespace.baseurl+'client_requests/cart/delete_single_cart',
											data: {'id':id},
											dataType:'json',
											async:true,
											
											success:function(response1)
											{
                                                                                               add_content_cart();
												console.log("success");
                                                                                              $('#loading_div').css("display","none");
											},
											error:function(jqXHR,textStatus,errorThrown)
											{
												console.log("Error:",errorThrown,jqXHR,textStatus);
											}
					});	

}

$(document).on("click",".add_cart",function(e){
	$('#loading_div').css("display","block");
	var name = $(this).data('name');
	var item_id = $(this).data('itemid');
	var price  = $(this).data('price');
	var set_type = $(this).data('settype');
	var	id = $(this).prop('id');	
	
	


	$.ajax({
			  	type :'POST',
				url : global_namespace.baseurl+'client_requests/cart/set_cart',
				data: {'name':name,'item_id':item_id,'price':price,'set_type':set_type},
				dataType:'json',
				async:true,
				
				success:function(response)
				{
					if (response == 'success')
					{
						add_content_cart();
                                              

					}
					else
					{
                                                 $('#loading_div').css("display","none");
						alert("already add in cart");
                                                 add_content_cart();
                                                 
					}
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:",errorThrown,jqXHR,textStatus);
				}


	});


});

$(document).on("click","#cart_cancel",function(e)
{
		var result = confirm("Want to remove all item?");
		if (result) {
    		delete_content_cart();
    		
    		
		}
		
		
		//$('#cart').css("display","none");
});

$(document).on("click",".delete_cart_content",function(){
	       var id = $(this).data('id');
			delete_single_content_cart(id);
    		
});

////////////////////   buy click //////////////


$(document).on("click","#cart_buy_button",function(e){
	var result = confirm("Are you buy these item ?");
		if (result) {
    		
    		
    		
		}
		else
		{
			return false;
		}
});

///////  cart work end  .  ///////////////////////////                ............. /////// /// / / / / / / / / / / / / /




// facebook center function start ../// ///// / /


var center_container1 =  window.innerHeight;
	var center_content1 = $('#facebook_container');
	
	
	vertical_align_center1(center_container1,center_content1);

	function vertical_align_center1(containter,element)
	{
		var h = containter;
		element_h = element.height();
		var margin = (h - element_h)/2;
				 element.css("top",(margin-80));
	}

// facebook center function end ../// ///// / /





//  notice center function start .. ////////
var center_container2 = window.innerHeight;
	var center_content2 = $('#bank_notice_container_click');

	vertical_align_center2(center_container2,center_content2);

	function vertical_align_center2(containter,element)
	{
		var h = containter;
		var element_h = element.height();
		var margin = (h - element_h)/2;
				element.css("top",(margin+15));
	}

/////////////////// exam test work start

$(document).on("click",".take_test_button",function(e)
	{
		var set_no = $(this).data('itemid');
		var section = $(this).data('section');
		var slug = $(this).data('slug');
		var instructions = 'instructions';
		var H = $( window ).height();
 		var W = $( window ).width()+120;

 		if(section == 'pre')
 		{
			window.open(global_namespace.baseurl+'Bankpo/onlineexam/'+slug+'/'+section+'/'+instructions+'','mywindow','"menubar=0,resizable=0,width='+W+',height='+H+'"');
		}
		else
		{
			window.open(global_namespace.baseurl+'Bankpo/onlineexam/'+slug+'/'+section+'/'+instructions+'','mywindow','"menubar=0,resizable=0,width='+W+',height='+H+'"');
		}
	});

/////////////////// exam test work start end





var facebook_container_flag = false;
	



$( "#facebook_container" ).click(function(){
	
  
});


$( "#bank_notice_container_click" ).click(function(){
	$('#bank_notice_container_click').animate({ "left": "200px" }, "slow" );
	$( "#bank_notice_container" ).animate({ "left": "0px" }, "slow" );	
});
$( "#notice_container_cancel" ).click(function(){
	
	$( "#bank_notice_container" ).animate({ "left": "-250px" }, "slow",function(){
		
	});	
$('#bank_notice_container_click').animate({ "left": "-50px" }, "slow" );		
});








$('#web_language').on('change', function() {
  var a = $(this).val();
   

 $.ajax({
			  	type :'POST',
				url :global_namespace.baseurl+'client_requests/Bankpo/web_language',
				data: {"lang":a},
				dataType: 'json',
				async:true,
				
				success:function(response)
				{
					console.log(response);
					$(location).attr('href',$(location).attr('href'));
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown,textStatus,jqXHR);
				}
	});


});


///// home animation start 


 $( ".home" ).mouseover(function() {
 	 //$(this).find('#custom_acount').css("display","block");
 	 //$(this).first().css("display","block");
 	 if(!menu_flag)
 	 {
 	 	$(this).children().first().slideDown("medium");
 	 	
 	 }
 	 menu_flag = true;
});

 $( ".home" ).mouseleave(function() {
 	  if(menu_flag)
 	  {
  		$(this).children().first().slideUp("fast",function()
  			{
  						menu_flag = false;
  			});
  			
  		
  		
  	}
});


///////////////////// current affaires animation
var currnt_affaires_flag = false;

 $( ".current_affaires" ).mouseover(function() {
 	 //$(this).find('#custom_acount').css("display","block");
 	 //$(this).first().css("display","block");
 	 if(!currnt_affaires_flag)
 	 {
 	 	$(this).children().first().slideDown("medium");
 	 	
 	 }
 	 currnt_affaires_flag = true;
});

 $( ".current_affaires" ).mouseleave(function() {
 	  if(currnt_affaires_flag)
 	  {
  		$(this).children().first().slideUp("fast",function()
  			{
  						currnt_affaires_flag = false;
  			});
  			
  		
  		
  	}
});


////////////////// blog

var blog_flag = false;

$( ".blog" ).mouseover(function() {
 	 //$(this).find('#custom_acount').css("display","block");
 	 //$(this).first().css("display","block");
 	 if(!blog_flag)
 	 {
 	 	$(this).children().first().slideDown("medium");
 	 	
 	 }
 	 blog_flag = true;
});

 $( ".blog" ).mouseleave(function() {
 	  if(blog_flag)
 	  {
  		$(this).children().first().slideUp("fast",function()
  			{
  						blog_flag = false;
  			});
  			
  		
  		
  	}
});


/////////////////// 
//////////////////////


var download_flag = false;

$( ".download" ).mouseover(function() {
 	 //$(this).find('#custom_acount').css("display","block");
 	 //$(this).first().css("display","block");
 	 if(!download_flag)
 	 {
 	 	$(this).children().first().slideDown("medium");
 	 	
 	 }
 	 download_flag = true;
});

 $( ".download" ).mouseleave(function() {
 	  if(download_flag)
 	  {
  		$(this).children().first().slideUp("fast",function()
  			{
  						download_flag = false;
  			});
  			
  		
  		
  	}
});

/////////////////////////////////////////
//////////////////////////////////////

var video_flag = false;

$( ".video" ).mouseover(function() {
 	 //$(this).find('#custom_acount').css("display","block");
 	 //$(this).first().css("display","block");
 	 if(!video_flag)
 	 {
 	 	$(this).children().first().slideDown("medium");
 	 	
 	 }
 	 video_flag = true;
});

 $( ".video" ).mouseleave(function() {
 	  if(video_flag)
 	  {
  		$(this).children().first().slideUp("fast",function()
  			{
  						video_flag = false;
  			});
  			
  		
  		
  	}
});

/////////////////////////////////////////////
/////////////////////////////////////////////


var myaccount_flag = false;

$( ".my_account" ).mouseover(function() {
 	 //$(this).find('#custom_acount').css("display","block");
 	 //$(this).first().css("display","block");
 	 if(!myaccount_flag)
 	 {
 	 	$(this).children().first().slideDown("medium");
 	 	
 	 }
 	 myaccount_flag = true;
});

 $( ".my_account" ).mouseleave(function() {
 	  if(myaccount_flag)
 	  {
  		$(this).children().first().slideUp("fast",function()
  			{
  						myaccount_flag = false;
  			});
  			
  		
  		
  	}
});






	
// login form and sign in form show and hide	
    $('.signup').click(function(e)
    {
    	$("#login_form_container").slideUp("fast");
    	$("#Resiter_form_container").slideDown("medium");
    });
	$('#login_form_cancel_button').click(function(){
		
		//$('#login_form_container').css("display","none");
		$("#login_form_container").slideUp("medium");
	});
	$('#login_button1').click(function(){
		//$('#login_form_container').css("display","block");
		$("#login_form_container").slideDown("medium");
	});
	$('#Resiter_form_cancel_button').click(function(){
		//$('#Resiter_form_container').css("display","none");
		$('#Resiter_form_container').slideUp("medium");
	});
	$('#signup_button').click(function(){
		//$('#Resiter_form_container').css("display","block");
		$("#Resiter_form_container").slideDown("medium");
	});

///   login form submit

	$('#Longinform').submit(function(e){
					var action = $('#Longinform').attr("action");
					var form_data={
						username: $('#username').val(),
						password: $('#password').val(),
					};
					
				$.ajax({
			  	type :'POST',
				url :action,
				data: form_data,
				dataType:'json',
				async:true,
				success:function(response)
				{
					if(response['is_logged_in'])
					{
						$('#username').val('');
						$('#password').val('');
						$('#error_massage').html('');
						window.location = global_namespace.baseurl+controller;
						$('#login_form_container').css("display","none");
						
					}
					else
					{
						$('#login_error_message').html('wrong username or password ');

					}

				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					
					console.log(jqXHR, textStatus ,errorThrown);								
					alert("an error acured");     
				}
			});
				
				 e.preventDefault();
				});


	///  resiter form submit ..................////////### ####



	$(document).ready(function(e) {
    
		$('#Resiterform').submit(function(e)
		{
			$('#register_button').prop('disabled',true);
			var sucess;
			
			var action = $('#Resiterform').attr("action");
					var form_data= $('#Resiterform').serializeArray();
					
				$.ajax({
			  	type :'POST',
				url :action,
				data: form_data,
				dataType:'json',
				async:true,
				success:function(response)
				{
					
					
					if(response['is_logged_in'])
					{
						
						$('#Resiter_Name').val('');
						$('#Resiter_Phone_No').val('');
						$('#Resiter_email').val('');
						$('#Resiter_password').val('');
						$('#Resiter_username').val('');
						$('#error_massage_registered').html('');
						$('#Resiter_form_container').css("display","none");	
						
						window.location = global_namespace.baseurl+"Bankpo";
						$('#register_button').prop('disabled',false);

					}
					else
					{

						$('#error_massage_registered').html('username already exist ! ');
						$('#register_button').prop('disabled',false);

					}
					//sucess=response;
					
					
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					console.log(jqXHR,textStatus,errorThrown)			
					alert("an error acured");     
				}
				
		});
		
				e.preventDefault();
	});


	
});
//added by boney
 $(window).bind("resize", function(){
    // Get the div's width
    var divWidth = $("#adjustsize").width();
    console.log(divWidth);
    // Update div's width
    $("#adjustsize").css("width", divWidth + 'px');
});