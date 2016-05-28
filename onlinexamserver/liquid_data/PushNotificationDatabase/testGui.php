<?php
session_start();
if(!isset($_SESSION['data_login_id']))
    header("location:../../index.php");
?>
<?php

include("../database_connection.php");

?>

<html>
<head>

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        
        
        function AppIdChangedShow(){
        
        
            var selectAppId = $('#AppIdselect').find( 'option:selected' ).val();
            
        //alert("hi"+selectAppId);
            $.ajax({url:"getUserCount.php",
        async:true,
    	data:"AppId="+selectAppId,
		type:"POST",
		success: function(result)
				{
					if(!result)
					{
						alert("Failed to load data !");
					}
					else
					{
						//alert(result);
						$('#total_users').html("Total Users: "+result);
					}
				}			
			});
            
        }  ;
        
    </script>
    <style>
        #apikey
        {
            width:50%;
        }
        #message
        {
        }
    </style>
</head>
<body>
<?php 
if( isset( $_GET['msgsend'] ) )
{
    echo "<p style='color:green;border:2px solid red;'>".$_GET['msgsend']."</p>";
}
?>
    <form action="testGCM.php" method="post">
        <select name="AppId" id="AppIdselect" onChange="AppIdChangedShow()" >
            <?php
                $currentAppId = -1;
                $AppIdQuery = "select * from app_table";
                $AppIdResult = mysqli_query($db,$AppIdQuery);
                $cntrAppId = 0;
                while($AppRow = mysqli_fetch_array($AppIdResult) )
                {
                    if($cntrAppId == 0)
                    {
                        $currentAppId = $AppRow['id'];
                        $cntrAppId = 1;
                    }   
                    echo "<option value='".$AppRow['id']."' >".$AppRow['Name']."</option>";
                }
            ?>
        </select>
        Choose Screen : <select name="ScreenId">
            <option value="0">Home Screen (Default)</option>
            <option value="1">Download Screen</option>
            <option value="2">Current Gk Screen</option>
            <option value="3">Contact Us Screen</option>
            <option value="4">Register Screen</option>
        </select>
        <br>
        <br>
        <p id="total_users">Total Users: 
        <?php
            $total_users_Query = "select * from GcmRegisteredUser where AppId=".$currentAppId;
            //$result_users = mysql_query($total_users_Query);
            $result_users = $db->query($total_users_Query);
                echo mysqli_num_rows($result_users);
        ?></p>
        <br>
        <br>
        <br>
        <!--    AIzaSyBVWLvw5ikZaN5XSNf2BLZCCz-NZLtQlSo     onlineexam project server key    -->
        <input type="text" id="apikey" name="apiKey" value="AIzaSyBVWLvw5ikZaN5XSNf2BLZCCz-NZLtQlSo" readonly/>
        <br>
        <textarea name="message" id="message" rows="7" cols="70"></textarea>
        <br>
        <input type="submit" value="Send Message"/>
    </form>
</body>
</html>