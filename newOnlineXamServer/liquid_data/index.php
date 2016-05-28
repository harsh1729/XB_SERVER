<?php
session_start();
if(isset($_SESSION['newonlineserver_login_id']))
    header("location:questionentry.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<style>
.background-check
{
    background-color:#ecf0f1;
    text-align:center;
	border-radius:10px;
    border:1px solid #1abc9c;
}
html, body{height:100%; margin:0;padding:0}
 
.container-fluid{
  height:100%;
  display:table;
  width: 100%;
  padding: 0;
}
.textalign
{
	text-align:center;
}
.textfield
{


	margin-bottom:8%;
	
}
.loginbottom
{
	margin-top:13%;
margin-bottom:6%;	
 background: #1abc9c;
}
.loginbottom:hover
{
margin-top:13%;
margin-bottom:6%;	
	
 background:  #1bc6a4;
}
 
.row-fluid {height: 100%; display:table-cell; vertical-align: middle;}
.centering {
 /* float:none;
  margin:0 auto;*/
}
.loginheader
{
	background-color:#1abc9c;
	padding-top:3%;
	padding-bottom:3%;
	color:#FFF;
	border-top-left-radius:10px;
	border-top-right-radius:10px;
	
}

</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $(window).load(function(e) {
    
	$.ajax({
			  	type :'POST',
				url :'back_end_AppId.php',
				data: "",
				dataType: 'json',
				success:function(response)
				{
					
					$.each(response, function(index, value) 
					{

     					$('#AppId').append($('<option>').text(value.name).prop('value',value.id));
					});
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
	});

});
</script>
</head>

<body>
<div class="container-fluid">
	<div class="row-fluid fullheight" style=" background-image:url(images/mainBackground.jpg)">
		<div class="col-md-4 col-sm-4 col-xs-2"></div>
		<div class="col-md-4 col-sm-4 col-xs-8">
        	
            	
                <div class="row">
                       <div class="col-md-1">
                       </div>
                       <div class="col-md-10 textalign">
                       			<div class="row">
                                		<div class="col-md-1 col-sm-1 col-xs-1"></div>
                                		<div class="col-md-10 col-sm-10 col-xs-10 background-check " style="margin-top:-70px;">
                                        		<div class="row">
                                 						<div class="col-lg-12 loginheader lead">LogIn</div>
                                				</div>
                                                <div class="row">
                                                		<div class="col-lg-12 text-left ">
                                                        <!--<span class="text-danger">error message</span>-->
                                                        </div>
                                                </div>
                                		        <form role="form" id="form" action="login_authentication.php">
                                                <input type="text" class="form-control textfield" name="username" required="required" placeholder="username"/>
            									<input type="password" class="form-control " required="required" name="password" placeholder="password"/>
				                        		<div class="row" style="margin-top:15px;">
                                                    <div class="col-md-5">
                                                			Select App :- 
                                                     </div>
                                                     <div class="col-md-7">
                                                     	<select class="form-control" id="AppId" required="required" name="Appid">
                                                						<option value=""></option>
                                                						</select>
                                                      </div>
                                                 </div>
                                                <button type="submit" class="btn btn-success btn-lg loginbottom" ><span class="glyphicon glyphicon-log-in"></span> LogIn</button>
                                        		</form>
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"></div>
                       	
                                </div>
                                
                        </div>
                       <div class="col-md-1">
                       </div>
                </div>
            
		</div>
		<div class="col-md-4 col-sm-4 col-xs-2"></div>
	</div>
</div>
</body>
</html>