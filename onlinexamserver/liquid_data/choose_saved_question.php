<?php
session_start();
if(!isset($_SESSION['data_login_id']))
    header("location:../index.php");
?>
<?php 
include("database_connection.php");
session_start();

if(isset($_REQUEST['errormsg']))
{
	echo "<script>alert('".$_REQUEST['errormsg']."');</script>";
}

 ?>
<html>
    <head> 
    	<meta charset="utf-8" />       
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script type="text/javascript" src="jquery.simpleImageCheck-0.4.js" ></script>
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.4/themes/trontastic/jquery-ui.css" />
        <script type="text/javascript">
			$(document).ready(function() {
                $(".AppaccordionContainer").accordion({ 
					active: false,
					header: ".AppAccHeader",
                    autoheight: false,
                    alwaysOpen: true,
                    fillspace: false,
                    collapsible: true,
					//animate:{duration:1000,easing:"easeOutBounce"},
					event:"click",
					heightStyle:"content",
					icons:{"header":"ui-icon-pin-w","activeHeader":"ui-icon-pin-s"}
					
                    //heightStyle: content   //auto, fill, content
                });
				
				$(".CataccordianContainer").accordion({ 
					active: false,
					header: ".CatAccHeader",
                    autoheight: false,
                    alwaysOpen: true,
                    fillspace: false,
                    collapsible: true,
					//animate:{duration:1000,easing:"easeOutBounce"},
					event:"click",
					heightStyle:"content",
					icons:{"header":"ui-icon-pin-w","activeHeader":"ui-icon-pin-s"}
					
                    //heightStyle: content   //auto, fill, content
                });
				
				$('.chkbox').simpleImageCheck({
						image: 'images/uncheck_small.png',
						imageChecked: 'images/checked_small.png'
						
					});
				
				
            });
		</script>
        <style>
			p
			{
			}
			.classQuestion
			{
				color:#90F;
				width:100%;
			}
			.classOptions
			{
				color:#0FF;
			}
			.classAnswer
			{
				color:#0F0;
			}
			
		</style>
    </head>
    <body>
    	<form action="choose_saved_Submit.php" method="post" >
        <!-- begin html for accordion -->
            <div class="AppaccordionContainer">
               	<?php
					$AppSelectQuery = "select * from app_table where id <> ".$_SESSION['Application_Id'];
					//$AppResult = mysql_query($AppSelectQuery);
					$AppResult = $db->query($AppSelectQuery);
					while($AppRow = mysqli_fetch_array($AppResult))
					{
						//	if($AppRow['id'] != $_SESSION['Application_Id'])
						{
							echo "<div class='AppAccHeader' >".$AppRow['Name']."</div>";
								echo "<div class='CataccordianContainer'>";
								
////////////**************************		    *************///////////////////////////
								//$CategorySelectQuery = "select * from questioncategory where QuesCatId in (select CatId from CatAppMapping where AppId=".$_SESSION['Application_Id']." and AppId=".$AppRow['id']."  )";		
								$CategorySelectQuery = "select * from questioncategory where QuesCatId in ( select CatId from catappmapping where AppId = ".$AppRow['id']." )";
								//echo "<br>catselect Query :  ".$CategorySelectQuery;
								//$CatSelectResult = mysql_query($CategorySelectQuery);
								$CatSelectResult = $db->query($CategorySelectQuery);
								while( $CatSelectRow = mysqli_fetch_array($CatSelectResult) )
								{
									echo "<div class='CatAccHeader'>".$CatSelectRow['QuesCat']."</div>";
									echo "<div>";
										
										// select * from qrecord where quesCatId = 5 and QuesId in ( select QuesId from qusappmapping where AppId=1 );
										//$QuesSelectQuery = "select * from qrecord where QuesCatId=".$CatSelectRow['QuesCatId']." and QuesId in ( select QuesId from qusappmapping where AppId = ".$AppRow['id']." )" ;
										//$QuesSelectQuery = "select * from qrecord where QuesCatId in ( select CatId from catappmapping where AppId = ".$AppRow['id']." ) and QuesCatId = ".$CatSelectRow['QuesCatId'];			
										$QuesSelectQuery = "select * from (  select * from qrecord as t2 where t2.QuesId in ( select t1.QuesId from qusappmapping as t1 where t1.AppId = ".$AppRow['id']." ) ) as t3 where t3.QuesCatId = ".$CatSelectRow['QuesCatId'];			
										//echo "<br>Ques Select Query : ".$QuesSelectQuery;
										//$QuesSelectResult = mysql_query($QuesSelectQuery);
										$QuesSelectResult = $db->query($QuesSelectQuery);
										$i=1;
										while( $QuesSelectRow = mysqli_fetch_array($QuesSelectResult) )
										{
											echo "<div class='classQuestion'>";
												echo "<input type='checkbox' id='qus".$QuesSelectRow['QuesId']."' name='Qus".$QuesSelectRow['QuesId']."' value='".$QuesSelectRow['QuesId']."'  class='chkbox'/>";
												echo "<label for='qus".$QuesSelectRow['QuesId']."' >";
												//echo "<input type='checkbox' class='chkbox' />";
												echo $i++."&nbsp;&nbsp;:&nbsp;".$QuesSelectRow['Question'];
												echo "</label>";
											echo "</div>";
											if($QuesSelectRow['image'] != "NULL")
												echo "<img src='".$QuesSelectRow['image']."' />";
											$OptionSelectQuery = "select * from options where QuesId=".$QuesSelectRow['QuesId'];
											//$OptionsSelectResult = mysql_query($OptionSelectQuery);
											$OptionsSelectResult = $db->query($OptionSelectQuery);
											$j=1;
											echo "<p class='classOptions'>";
											while( $OptionsSelectRow = mysqli_fetch_array($OptionsSelectResult) )
											{
												if($OptionsSelectRow['image'] != "NULL")
													echo $j++."&nbsp;:&nbsp;".$OptionsSelectRow['OptionText']."&nbsp;&nbsp;"."<img src='".$OptionsSelectRow['image']."' />"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";		
												else
													echo $j++."&nbsp;:&nbsp;".$OptionsSelectRow['OptionText']."&nbsp;&nbsp;";
											}
											echo "</p>";
											echo "<p class='classAnswer'>Solution : ".$QuesSelectRow['CorrectOption']."</p>";
										}
										
									echo "</div>";
								}
								echo "</div>";
						}
					}
				?>
            </div>
            <input type="submit" name="submitbtn" value="save Questions"/>
       </form>
	</body>
</html>