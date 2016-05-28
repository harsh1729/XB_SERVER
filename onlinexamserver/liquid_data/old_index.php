<html>
	<head>
    	<style>
			*
			{
				padding:0px;
				margin:0px;
			}
			#upper_half
			{
				height:50%;
				background-color:#666;
				background: -webkit-linear-gradient(#111,#666);
			}
			#lower_half
			{
				height:50%;
				background-color:#FC3;
				background:-webkit-linear-gradient(#FFC,#FFF);
			}
			#login_box
			{
				height:70%;
				width:40%;
				margin-top:-80%;
				margin-left:30%;
				position:fixed;
				background-color:#CCDCE3;
				-webkit-box-shadow: 1px 26px 61px 0px rgba(224,211,143,0.83);
			}
			#small_login_box
			{
				height:96%;
				width:96%;
				margin-top:2%;
				margin-left:2%;
				background-color:#CCF;
				position:absolute;
				background-image: -webkit-gradient(
													linear,
													left bottom,
													left top,
													color-stop(0, #C5F5FA),
													color-stop(0.8, #FFFFFF)
												);
			}
			#logo_box
			{
				height:30%;
				width:96%;
				margin-left:2%;
				margin-top:3%;
				margin-bottom:3%;
				background-color:#90F;	
				background: -webkit-linear-gradient(#000,#666);
				border-radius:10px;
			}
			#control_container
			{
				height:60%;
				width:60%;
				background-color:#F00;
			}
		</style>
    </head>
    <body>
    	<div id="upper_half">
        </div>
        <div id="lower_half">
        </div>
        <div id="login_box">
        	<div id="small_login_box">
            	<div id="logo_box">
                </div>
                	<div id="control_container">
                    </div>
            </div>
        </div>
    </body>
</html>