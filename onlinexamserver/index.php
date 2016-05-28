<?php
session_start();
if(isset($_SESSION['data_login_id']))
	header("location:liquid_data/question_entry.php");
?>


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
				width:35%;
				margin-top:-40%;
				margin-left:30%;
				position:absolute;
				background-color:#CCC;
				z-index:10000;
				-webkit-box-shadow: 1px 26px 61px 0px rgba(224,211,143,0.83);
				
			}
			#small_login_box
			{
				height:96%;
				width:96%;
				margin-top:2%;
				margin-left:2%;
				background-color:#FFF;
				position:absolute;
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
			.txtfield
			{
				height:35px;
				width:60%;
				margin-left:20%;
				border-radius:4px;	
			}
			#AppContainer
			{
				margin-left:20%;
				margin-top:20px;
				width:60%;
			}
			#AppSelect
			{
				min-width:50%;
				max-width:100%;
			}
			#control_container
			{
				height:63%;
				width:100%;
				background-color:#6FF;
				background-image: -webkit-gradient(
													linear,
													left bottom,
													left top,
													color-stop(0, #C5F5FA),
													color-stop(0.8, #FFFFFF)
												);
				position:absolute;
			}
			p
			{
				margin-left:20%;
				margin-top:2%;
			}
			.css_btn_class {
				font-size:16px;
				font-family:Arial;
				font-weight:normal;
				-moz-border-radius:8px;
				-webkit-border-radius:8px;
				border-radius:8px;
				border:2px solid #83c41a;
				padding:20px 36px;
				text-decoration:none;
				background:-moz-linear-gradient( center top, #b8e356 23%, #a5cc52 82% );
				background:-ms-linear-gradient( top, #b8e356 23%, #a5cc52 82% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b8e356', endColorstr='#a5cc52');
				background:-webkit-gradient( linear, left top, left bottom, color-stop(23%, #b8e356), color-stop(82%, #a5cc52) );
				background-color:#b8e356;
				color:#ffffff;
				display:inline-block;
				text-shadow:0px 2px 5px #86ae47;
				-webkit-box-shadow:inset 0px 0px 0px -24px #d9fbbe;
				-moz-box-shadow:inset 0px 0px 0px -24px #d9fbbe;
				box-shadow:inset 0px 0px 0px -24px #d9fbbe;
			}
			.css_btn_class:hover 
			{
				background:-moz-linear-gradient( center top, #a5cc52 23%, #b8e356 82% );
				background:-ms-linear-gradient( top, #a5cc52 23%, #b8e356 82% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#a5cc52', endColorstr='#b8e356');
				background:-webkit-gradient( linear, left top, left bottom, color-stop(23%, #a5cc52), color-stop(82%, #b8e356) );
				background-color:#a5cc52;
			}
			.css_btn_class:active 
			{
				position:relative;
				top:1px;
			}
			#login
			{
				margin-top:8%;
				margin-left:35%;
			}
			#logo_image
			{
				margin-top:10%;
				margin-left:4%;
			}
			.div_text_shadow 
			{
				color: rgb(255, 255, 255);
				font-size: 30px;
				text-shadow: 0px 0px 7px rgba(217, 245, 100, 0.8);
			    color: #0080ff;
				margin-left:50%;
				margin-top:-8%;
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
                     <img src="liquid_data/images/cmpn_logo.png" id="logo_image">
                     <div id="entry_box" class="div_text_shadow ">ENTRY BOX</div>
                    </div>
                    <div id="control_container">
						<form action="liquid_data/login_authentication.php" method="post">                           
                            <p>User Name:</p>
                            <input type="text" id="email_address" class="txtfield" name="username">
                            <p>Password:</p>
                            <input type="password" id="password" class="txtfield" name="password">
                            <br>
                            <div id="AppContainer">
                                <label for="Appid" id="AppLabel">Choose Application: </label>
                                <select id="AppSelect" name="Appid" placeholder="Choose Application">		
                                    <?php
                                        include("liquid_data/database_connection.php");
                                        $qry = "SELECT * from app_table";
                                        //$lan_result = mysql_query($qry) or die(mysql_error());
                                        $lan_result = $db->query($qry) or die(mysqli_error($db));
                                        //while($row=mysql_fetch_array($lan_result))
                                        while($row=mysqli_fetch_array($lan_result))
                                        {
                                            $id = $row['id'];
                                            $AppName = $row['Name'];
                                            echo "<option value='".$id."'>".$AppName."</option>";							
                                        }
                                        ?>
                                </select>
                            </div>
                            
                            <input type="submit" class="css_btn_class"  id="login" value="LOGIN">
                            
						</form>                        
                    </div>
            </div>
        </div>
</body>
</html>