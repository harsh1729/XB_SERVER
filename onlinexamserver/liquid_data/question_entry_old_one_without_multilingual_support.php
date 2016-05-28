<?php

include("database_connection.php");

session_start();
if(!isset($_SESSION['data_login_id']))
{
	header("location:../index.php");
}


?>

<html lang="en">
<head>
<meta charset="utf-8" />

<!--////*******************  MULTILINGUAL CODE FILES INCLUDE  **************////////////////  -->

    <link href="../css/jquery.ime.css" rel="stylesheet" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script> 
    <script src="../src/jquery.ime.js"></script>
    <script src="../src/jquery.ime.selector.js"></script>
    <script src="../src/jquery.ime.preferences.js"></script>
    <script src="../src/jquery.ime.inputmethods.js"></script>
    
    <script src="../libs/rangy/rangy-core.js"></script>
    
    
	<script>
		$(document).ready(function() {
            $("#question_text").ime();
        });
	</script>

<!-- ************************************************************************************* -->

<script>
       var counter = 1;
var limit = 3;
var i=4;
var dele=1;
var j=1;

	
function Addopt(divName,divName1)
{
	if(dele==1)
	{	
		if(i==4)
		{
			document.getElementById("button2").disabled=false;	
		}
	    if (counter == limit)  
		{
      		document.getElementById("button1").disabled=true;
     	}
        var newdiv = document.createElement('div');
		var newdiv1= document.createElement('div');
		newdiv.id=i;
		newdiv1.id=j;
        newdiv.innerHTML ="Enter the opt" + (counter + 4) + ":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp <input type='text' name='opt"+(i+1)+"'>";
		newdiv1.innerHTML ="<input type='radio' name='option'  value='"+(i+1)+"'>";
		  
        document.getElementById(divName).appendChild(newdiv);
		document.getElementById(divName1).appendChild(newdiv1);
		document.getElementById("five").style.marginTop=-131-(j*25);
		document.getElementById(j).style.marginTop=9; 
        counter++;
		i++;
		document.getElementById("hdn_field").value = i;
		j++;
	}
	else
	{
		if(i==5)
		{
			document.getElementById("button2").disabled=true;	
		}
	    var child=document.getElementById(i-1);
		var parent=document.getElementById("third");
		parent.removeChild(child);
		var child1=document.getElementById(j-1);
		var parent1=document.getElementById("five");
		parent1.removeChild(child1);
		document.getElementById("five").style.marginTop=-131+(-25*j)+50;
		dele=1;
		counter--;
		i--;
		document.getElementById("hdn_field").value = i;
		j--
        if(counter!=limit+1)
		{
			document.getElementById("button1").disabled=false;
		}

	 }
	                        
}	
function deleted() 
{
	 dele=0;
	 setTimeout(Addopt(),100);
}
 
function show1()
{
	document.getElementById("Addcatemain").style.visibility = "visible";
	document.getElementById("AddCatagory").style.visibility = "visible";
	
}
function show2()
{
	document.getElementById("Addcatemain").style.visibility = "visible";
	document.getElementById("AddLanguage").style.visibility = "visible";
}
function close_dialog()
{
	document.getElementById("Addcatemain").style.visibility = "hidden";
	document.getElementById("AddCatagory").style.visibility = "hidden";
	document.getElementById("AddLanguage").style.visibility = "hidden";
}

</script>
<style>

.css_btn_class_add_cat
{
	font-size:16px;
	font-family:Arial;
	font-weight:normal;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:8px;
	border:1px solid #dcdcdc;
	padding:3px 16px;
	text-decoration:none;
	background:-moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );
	background:-ms-linear-gradient( top, #f9f9f9 5%, #e9e9e9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9');
	background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #f9f9f9), color-stop(100%, #e9e9e9) );
	background-color:#f9f9f9;
	color:#666666;
	display:inline-block;
	text-shadow:1px 1px 0px #ffffff;
 	-webkit-box-shadow:inset 1px 1px 0px 0px #ffffff;
 	-moz-box-shadow:inset 1px 1px 0px 0px #ffffff;
 	box-shadow:inset 1px 1px 0px 0px #ffffff;
}
.css_btn_class_add_cat:hover 
{
	background:-moz-linear-gradient( center top, #e9e9e9 5%, #f9f9f9 100% );
	background:-ms-linear-gradient( top, #e9e9e9 5%, #f9f9f9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9');
	background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #e9e9e9), color-stop(100%, #f9f9f9) );
	background-color:#e9e9e9;
}
.css_btn_class_add_cat:active 
{
	position:relative;
	top:1px;
}

.Addbutton {
  font-family: arial;
  font-weight: bold;
  color: #E0E0E0 !important;
  font-size: 14px;
  text-shadow: 1px 1px 0px #7CACDE;
  box-shadow: 1px 1px 1px #C2F9F0;
  padding: 10px 25px;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
  border-radius: 10px;
  border: 2px solid #1BA300;
  background: #21EE1A;
  background: linear-gradient(top,  #18EE3B,  #B8CFBC);
  background: -ms-linear-gradient(top,  #18EE3B,  #B8CFBC);
  background: -webkit-gradient(linear, left top, left bottom, from(#18EE3B), to(#B8CFBC));
  background: -moz-linear-gradient(top,  #18EE3B,  #B8CFBC);
}
.Addbutton:hover {
  color: #FFFFFF !important;
  background: #468CCF;
  background: linear-gradient(top,  #B8CFBC,  #18EE3B);
  background: -ms-linear-gradient(top,  #B8CFBC,  #18EE3B);
  background: -webkit-gradient(linear, left top, left bottom, from(#B8CFBC), to(#18EE3B));
  background: -moz-linear-gradient(top,  #B8CFBC,  #18EE3B);
}


  #two
  {
       margin-top:5px;
	   margin-left:200px;
	   float:left;  
  }
  #one
  {
  
    margin-top:5px;
	margin-left:200px;
  }
  #third
  {
	   
     margin-top:5px;
     margin-left:500px;
	
  }
  .opt
  {
  margin-left:33px;
  }
  #button1
  {
  margin-top:5px;
  margin-left:36px;
  }
   #button2
  {
  margin-top:5px;
  margin-left:122px;
  }
  #four
  {
	  
    margin-left:500px;
  }
  #five
  {
	  position:absolute;
	margin-top:-131px;
	margin-left:830px;
  }
  .optcheck
  {
	  margin-top:13.5px;
  }
  #submit
  {
	  margin-left:810px;
	  margin-top:-25px;
  }
  #answer
  {
	  margin-left:800px;
  }
  #main_container
  {
	  margin-top:18%;
	  position:absolute; 	
	  
  }
  #catagari
  {
	  margin-left:200px;
  }
  *
  {
	  padding:0;
	  margin:0;
  }
  #top_bar
  {
	  background-color:#000;
	  height:4%;
	  width:100%;
	  position:fixed;
  }
  #logout
  {
	  color:#FFF;
	  text-decoration:none;
	  font-weight:bold;
	  margin-top:3px;
	  float:right;
	  margin-right:10px;
  }
	#AddcateBtn
	{
		margin-left:40%;
		margin-top:10px;		
	}
	#Addcatemain
	{
		height:100%;
		width:100%;
		visibility:hidden;
		background:rgba(0, 0, 0, 0.8);
		position:fixed;
		z-index:1000;
	}
	  #AddCatagory
	  {			  
		visibility:hidden;
		position:fixed;
		margin-left:35%;
		height:300px;
		width:400px;
		background-color:rgba(153,153,153,.7);
		border:2px solid;
		box-shadow:1px 1px 50px 1px #999;
		border-color:#fff;
		margin-left:35%;
		margin-top:15%;
	  }
	#AddLanguage
	{
		visibility:hidden;
		position:fixed;
		margin-left:35%;
		height:300px;
		width:400px;
		background-color:rgba(153,153,153,.7);
		border:2px solid;
		box-shadow:1px 1px 50px 1px #999;
		border-color:#fff;
		margin-left:35%;
		margin-top:15%;
		  
	}
	#close_btn
	{
		float:right;
	}
	.pop_up_text_field
	{
		border:thin solid #FF6;
		height:24px;
		width:80%;
		margin-left:10%;
		margin-top:10%;
		border:4px double #DEBB07;
	}
	#edit_category_list
	{
		min-width:230px;
		width:80%;
		border:4px double #DEBB07;
		margin-left:10%;
		margin-top:10%;	}
	#edit_language_list
	{
		min-width:230px;
		width:80%;
		border:4px double #DEBB07;
		margin-left:10%;
		margin-top:10%;
	}
</style>
</head>
<body>
        <div id="top_bar">
	        <a href="logout.php" id="logout">LOGOUT</a>
            <div id="add_category_container">
            	<input name="category_input" type="button" value="Add Category" class="css_btn_class_add_cat" id="add_cat" onClick		="show1()">
          		<input type="button" value="Add Language" class="css_btn_class_add_cat" id="add_lan" onClick="show2()">
            </div>
        </div>
        <div id="Addcatemain">
        	<img src="images/Close.png" id="close_btn" onClick="close_dialog()">
            <div id="AddCatagory">
                <form action="add_new_category.php" method="post">
                
                    <select name="category" size="3" id="edit_category_list">
                    	<option value="-1" style="text-align:center;color:#C3F;">select a category to edit</option>
                        <?php
                        $qry = "select * from questioncategory";
                        //$cat_result = mysql_query($qry) or die(mysql_error());
                        $cat_result = $db->query($qry) or die(mysql_error($db));
                        while($row=mysqli_fetch_array($cat_result))
                        {
                            $Cat = $row['QuesCat'];
                            $cat_id = $row['QuesCatId'];
							$send_id = "cat".$cat_id;
                            echo "<option value='".$cat_id."' id='cid".$cat_id."' onClick='edit_add_content(".$send_id.")'>".$Cat."</option>";
                        }
                        ?>
                    </select>
                    
                    
                    <input name="category" type="text" id="AddText" class="pop_up_text_field" placeholder="Enter New Category"><br>
                    <input type="submit" value="Add" id="AddcateBtn" class="Addbutton">
                </form>
            </div>
            <div id="AddLanguage">
           	   <form action="add_new_language.php" method="post">
                
                
                    <select name="Language" size="3" id="edit_language_list">
                    	<option value="-1" style="text-align:center;color:#C3F;">select a language to edit</option>
                        <?php
                        $qry = "select * from Language";
                        //$lan_result = mysql_query($qry) or die(mysql_error());
                        $lan_result = $db->query($qry) or die(mysql_error($db));
                        while($row=mysqli_fetch_array($lan_result))
                        {
                            $lan = $row['Lang'];
                            $lang_id = $row['LangId'];
                            echo "<option value='".$lang_id."'>".$lan."</option>";
                        
                        }
                        ?>
                        </select>
                    <br>
                    <input name="language" type="text" id="AddText" class="pop_up_text_field" placeholder="Enter New Language">
                    <input type="submit" value="Add" id="AddcateBtn" class="Addbutton">
                </form>
            </div>
        </div>
        
        <div id="main_container">
        <form action="question_submit.php" method="get">
             <div id="catagari">
           			Choose Catagory:&nbsp;&nbsp;&nbsp;&nbsp;
                
                <select name="category">
					<?php
                    $qry = "select * from questioncategory";
                    //$cat_result = mysql_query($qry) or die(mysql_error());
                    $cat_result = $db->query($qry) or die(mysql_error($db));
                    while($row=mysqli_fetch_array($cat_result))
                    {
                        $Cat = $row['QuesCat'];
                        $cat_id = $row['QuesCatId'];
                        echo "<option value='".$cat_id."'>".$Cat."</option>";
                    }
                    ?>
                </select>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Choose Language:&nbsp;&nbsp;&nbsp;&nbsp;
                
                <select name="Language">
                <?php
				$qry = "select * from Language";
				//$lan_result = mysql_query($qry) or die(mysql_error());
				$lan_result = $db->query($qry) or die(mysql_error($db));
				while($row=mysqli_fetch_array($lan_result))
				{
					$lan = $row['Lang'];
					$lang_id = $row['LangId'];
             		echo "<option value='".$lang_id."'>".$lan."</option>";
				
				}
				?>
                </select>
             </div>
	        <div id="one">
    		     Enter the Question:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ANSWER
	        </div>
    	    <div id="two">
            		<input type="hidden" name="number_of_options" id="hdn_field" value="4">
		          <textarea rows="7" cols="30" name="txtarea" id="question_text"></textarea><br>
                  <input type="file" accept="image/x-png">
	        </div>
	        <div id="third">      
                  Enter the opt1:<input type="text" class="opt" name="opt1"><br>
                  <input type="file" accept="image/x-png" class="opt">
                  	<br>
                  Enter the opt2:<input type="text" class="opt" name="opt2"><br>
                  <input type="file" accept="image/x-png"><br>
                  Enter the opt3:<input type="text" class="opt" name="opt3"><br>
                  <input type="file" accept="image/x-png"><br>
                  Enter the opt4:<input type="text" class="opt" id="text" name="opt4"><br>
                  <input type="file" accept="image/x-png"><br>          
	         </div>      
	         <div id="four">
                 <input type="button" id="button2" value="delete" disabled onClick="deleted()">
                 <input type="button"  id="button1" value="AddOpt" onClick="Addopt('third','five')">                
	         </div>
    	     <div id="five">    
               <input type="radio" name="option" class="optcheck" value="1"><br>
               <input type="radio" name="option" class="optcheck" value="2"><br>
               <input type="radio" name="option" class="optcheck" value="3"><br>
               <input type="radio" name="option" class="optcheck" value="4"><br>          
	         </div>
    	     <div id="submit">
        	     <input type="submit" value="submit">
	         </div>    
         </form>
        </div>
    </body>
</html>