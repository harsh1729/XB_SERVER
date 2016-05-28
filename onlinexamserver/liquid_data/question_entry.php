<?php
include("database_connection.php");

session_start();

$AppId = $_SESSION['Application_Id'];
if(!isset($_SESSION['data_login_id']))
{
	header("location:../index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />


<script>
 
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



<!--////*******************  MULTILINGUAL CODE FILES INCLUDE  **************////////////////  -->

	<link href="../css/jquery.ime.css" rel="stylesheet" />
    <link href="question_entry_style_sheet.css" rel="stylesheet"/>
	<script src="../src/jquery.min.js" ></script>
	<script src="../libs/rangy/rangy-core.js"></script>
	<script src="../src/jquery.ime.js"></script>
	<script src="../src/jquery.ime.selector.js"></script>  
	<script src="../src/jquery.ime.preferences.js"></script>
	<script src="../src/jquery.ime.inputmethods.js"></script>
	<script src="script.js"></script>
    <script src="OptionAddDelete.js"></script>
    <script src="form_validation.js"></script>
    <link href="radioStyle.css" rel="stylesheet" />
    

<!-- ************************************************************************************* -->

<script>
/*
	var ht = $(window).height();
	var wt = $(window).width();
	$(window).load(function(e) {
        document.getElementById("two").style.width = wt+"px";
    });
	*/
</script>

</head>
<body>
      <?php
      
        if(isset( $_GET['QuesState'] ))
        {
            echo "<script>alert('".$_GET['QuesState']."');</script>";
        }
      ?>
        <div id="top_bar">
	        <a href="logout.php" id="logout">LOGOUT</a>
            <div id="add_category_container">
            	<input name="category_input" type="button" value="Add Category" class="css_btn_class_add_cat" id="add_cat" onClick="show1()">
          		<input type="button" value="Add Language" class="css_btn_class_add_cat" id="add_lan" onClick="show2()">
          		<input type="button" value=" Choose Saved Questions " class="css_btn_class_add_cat" id="add_saved_question" onClick="window.location='choose_saved_question.php'">
                <input type="button" value=" Check Downloads " class="css_btn_class_add_cat" id="CheckDownload" onClick="window.location='Downloads.php'">
            </div>
        </div>
        <div id="Addcatemain">
        	<img src="images/Close.png" id="close_btn" onClick="close_dialog()">
            <div id="AddCatagory">
                <form action="add_new_category.php" method="post" onSubmit="return addCategoryFormValidation()">
<!--					<form action="test.php" method="post" >  -->
                	<span id="CatOptionSpan"></span>
                    <select name="category" size="3" id="edit_category_list">
                    	<option value="-1" style="text-align:center;color:#C3F;" selected>select to Add new Category</option>
                        <?php
                        $qry = "select * from questioncategory where QuesCatId not in (select CatId from catappmapping where AppId=".$AppId.")";
                        //$cat_result = mysql_query($qry) or die(mysql_error());
                        $cat_result = $db->query($qry) or die(mysql_error($db));
                        while($row=mysqli_fetch_array($cat_result))
                        {
                            $Cat = $row['QuesCat'];
                            $cat_id = $row['QuesCatId'];
							$send_id = "cat".$cat_id;
                            echo "<option value='".$cat_id."' id='cid".$cat_id."' >".$Cat."</option>";
                        }
                        ?>
                    </select>
                    
                     
                    <input name="categoryText" type="text" id="AddText" class="AppCategoryTextField" placeholder="Enter New Category"><br>
                    <input name="AppCategoryId" type="number" id="AppCategoryId" class="AppCategoryTextField" min="1" max="12" value="1"/>
                    <input type="submit" value="Add" id="AddcateBtn" class="Addbutton">
                </form>
            </div>
            <div id="AddLanguage">
           	   <form action="add_new_language.php" method="post">
                        
					<select id="language" name="language" class="pop_up_text_field"></select>
					
					<select id="imeSelector" name="imeSelector" class="pop_up_text_field"></select>
               <!-- 
                    <select name="Language_select_option" size="3" id="edit_language_list">
                    	<option value="-1" style="text-align:center;color:#C3F;">select a language to edit</option>  -->
                        <?php
						/*
                        $qry = "select * from Language";
                        //$lan_result = mysql_query($qry) or die(mysql_error());
                        $lan_result = $db->query($qry) or die(mysql_error($db));
                        while($row=mysql_fetch_array($lan_result))
                        {
                            $lan = $row['Lang'];
                            $lang_id = $row['LangId'];
                            echo "<option value='".$lang_id."'>".$lan."</option>";
                        
                        }*/
                        ?>
                        <!--
                        </select>-->
                    <br>
                    <input name="language_textfield" type="text" id="testLangInput" class="pop_up_text_field" placeholder="Test Your Language Here">
                    <input type="submit" value="Add" id="AddcateBtn" class="Addbutton">
                </form>
            </div>
        </div>
        
        <div id="main_container">
        <form action="question_submit.php" method="post" enctype="multipart/form-data" onSubmit="return formValidate()" name="question_entry_form">
<!--			<form action="test.php" method="post" name="question_entry_form" enctype="multipart/form-data" onSubmit="return formValidate()">  -->
			<div id="Application_Name_Container">
				<?php
					$appNameQuery = "select * from app_table where id=".$AppId;
					//$appNameResult = mysql_query($appNameQuery);
					$appNameResult = $db->query($appNameQuery);
					while($appNameRow = mysqli_fetch_array($appNameResult))
					{
						echo "Application Name&nbsp;:&nbsp;&nbsp;<u>".$appNameRow['Name']."</u>";
					}
                ?>
             </div>
             <div id="counterErrorSpan">
             <?php 
			 	if(isset($_REQUEST['CounterError']))
				{
					echo $_REQUEST['CounterError'];
					echo "<script>document.getElementById('counterErrorSpan').className='validate'</script>";
				}
			 ?>
             </div>
             <div id="catagari">
           			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Choose Category:&nbsp;&nbsp;&nbsp;&nbsp;
                
                <select name="category" id="category">
					<?php
                    $SelectedCat = -1;
					//select * from questioncategory where QuesCatId in (select CatId from catappmapping where AppId=3)
                    $qry = "select * from questioncategory where QuesCatId in (select CatId from catappmapping where AppId=".$AppId.")";
                    //$cat_result = mysql_query($qry) or die(mysql_error());
                    $cat_result = $db->query($qry) or die(mysql_error($db));
					$i=0;
                    while($row=mysqli_fetch_array($cat_result))
                    {
                        $Cat = $row['QuesCat'];
                        $cat_id = $row['QuesCatId'];
						if($i==0)
						{
							$SelectedCat = $cat_id;
							$i++;
						}
                        echo "<option value='".$cat_id."'>".$Cat."</option>";
                    }
                    ?>
                </select>
                
           			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Choose Subcategory:&nbsp;&nbsp;&nbsp;&nbsp;
                
                <select name="Subcategory" id="Subcategory">
					<?php
                    
                    $qry = "select * from subcategory where QuesCatId=".$SelectedCat;
                    //$cat_result = mysql_query($qry) or die(mysql_error());
                    $cat_result = $db->query($qry) or die(mysql_error($db));
                    while($row=mysqli_fetch_array($cat_result))
                    {
						$subcat_id = $row['id'];
                        $SubCat = $row['CatName'];
                        echo "<option value='".$subcat_id."'>".$SubCat."</option>";
                    }
                    ?>
                </select>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Choose Language:&nbsp;&nbsp;&nbsp;&nbsp;
                
                <select name="Language_select_option" id="language_select_option">
					<?php
                    $qry = "SELECT a.id,a.Lang,b.code,a.input_method FROM language a,language_table b WHERE Lang=lang_name";
                    //$lan_result = mysql_query($qry) or die(mysql_error());
                    $lan_result = $db->query($qry) or die(mysql_error($db));
                    while($row=mysqli_fetch_array($lan_result))
                    {
                        $lan = $row['Lang'];
                        $lang_id = $row['LangId'];
                        $lang_Code = $row['code'];
						if($lan == "Hindi")
	                        echo "<option value='".$lang_Code."' selected>".$lan."</option>";
						else
	                        echo "<option value='".$lang_Code."'>".$lan."</option>";
							
                    }
                    ?>
                </select>
             </div>
             <div id="qus_paper_container">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank Name&nbsp;( Exam Name ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="BankName" placeholder="Bank Name or Exam Name"/>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paper Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="paperYear" placeholder="Exam Year"/>
<!--                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Application Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="Appid" placeholder="Choose Application">		
				<?php /*
                    $qry = "SELECT * from app_table";
                    $lan_result = mysql_query($qry) or die(mysql_error());
                    while($row=mysql_fetch_array($lan_result))
                    {
						$id = $row['id'];
						$AppName = $row['Name'];
                        echo "<option value='".$id."'>".$AppName."</option>";							
                    }*/
                    ?>
                </select>		-->
             </div>
             <div id="ques_text">Enter the Q. 
                <a href="http://www.codecogs.com/latex/eqneditor.php" target="new" style="float:right;margin-right:40px;">Make Maths Equation</a></div>
    	    	 <div id="two">
            		  <input type="hidden" name="number_of_options" id="hdn_field" value="4">
<!--		          <textarea rows="7" cols="30" name="txtarea" id="question_text"></textarea><br>-->
		          
                      <textarea name="ced" id="ced" placeholder="Type your Question Here, and choose the languae of question from upper language select option !"></textarea>
                      <div id="result"></div>
                      <div style="clear:left;"></div>
                      <input type="file" accept="image/*" id="files" name="qusImage">
<!--                      <div id="qus_span" class="validate">Question Text cant't be left empty !</div>  -->
					  <div id="qus_span"></div>
	         	</div>
	        <div id="third">      
				<div id="answer_span"></div>
				<div id="opt1div">                
                	<div style="height:100%;width:60%;background-color:#990;float:left;">
                      Option 1:<input type="text" class="opt" name="opt1" placeholder="Option 1" id="opt1">
		              <input type="radio" name="option" class="css-checkbox" value="1" id="optionRadio1">
                      <label for="optionRadio1" class="css-label radGroup1">Answer</label>
                      <br>
                      <input type="file" accept="image/*" class="fileinput" id="opt1file" name="opt1img">
                      <br>
                    <div id="opt1_span"></div>
                    </div>
                    <div id="opt1img" style="width:30%;height:100%;background-color:#FFC;float:left;overflow:auto;"></div>
                </div>
                <div id="opt2div">
                	<div style="height:100%;width:60%;background-color:#990;float:left;">
                      Option 2:<input type="text" class="opt" name="opt2" placeholder="Option 2" id="opt2">
		              <input type="radio" name="option" class="css-checkbox" value="2" id="optionRadio2">
                      <label for="optionRadio2" class="css-label radGroup1">Answer</label><br>
                      <input type="file" accept="image/*" class="fileinput" id="opt2file" name="opt2img">
                      <br>
                    <div id="opt2_span"></div>
                    </div>
                    <div id="opt2img" style="width:30%;height:100%;background-color:#FFC;float:left;overflow:auto;">
                    </div>
                </div>
                <div style="clear:left;"></div>
                <div id="opt3div">
                	<div style="height:100%;width:60%;background-color:#990;float:left;">
                      Option 3:<input type="text" class="opt" name="opt3" placeholder="Option 3" id="opt3">
               		  <input type="radio" name="option" class="css-checkbox" value="3" id="optionRadio3">
                      <label for="optionRadio3" class="css-label radGroup1">Answer</label><br>            
                      <input type="file" accept="image/*" class="fileinput" id="opt3file" name="opt3img">
                      <br>
                    <div id="opt3_span"></div>
                    </div>
                    <div id="opt3img" style="width:30%;height:100%;background-color:#FFC;float:left;overflow:auto;">
                    </div>
				</div>
                <div id="opt4div">
                	<div style="height:100%;width:60%;background-color:#990;float:left;">
                      Option 4:<input type="text" class="opt" name="opt4" placeholder="Option 4" id="opt4">
               		  <input type="radio" name="option" class="css-checkbox" value="4" id="optionRadio4">
                      <label for="optionRadio4" class="css-label radGroup1">Answer</label><br>
                      <input type="file" accept="image/*" class="fileinput" id="opt4file" name="opt4img">
                      <br>
                    <div id="opt4_span"></div>
                    </div>
                    <div id="opt4img" style="width:30%;height:100%;background-color:#FFC;float:left;overflow:auto;">
                    </div>
				</div>
                <div id="opt4clr" style="clear:left;"></div>
                <div id="solution_container">
                	<div style="height:100%;width:60%;background-color:#990;float:left;">
                        <textarea id="solution_area" placeholder="Write the complete solution of the question here if any !" name="solutionArea"></textarea><br>
                        <input type="file" accept="image/*" style="margin-left:20px;" id="solution_file" name="solution_img">
                    </div>    
                    <div id="solution_img_div"></div>
                </div>
                <div id="four">
                
        	     <input type="submit" value="save Question" id="submit" class="addDeleteOpt" >
<!--                    <input type="button" id="button2" value="Delete Option" disabled onClick="deleted()" class="addDeleteOpt">
                    <input type="button"  id="button1" value="Add Option" onClick="Addopt('third','five')" class="addDeleteOpt">  -->
                    <input type="button" id="button2" value="Delete Option" disabled onClick="deleteOpt()" class="addDeleteOpt">
                    <input type="button"  id="button1" value="Add Option" onClick="Addopt()" class="addDeleteOpt">
                    <div style="clear:left;"></div>
	         	</div>
	         </div>      
<!--	         <div id="four">
                 <input type="button" id="button2" value="delete" disabled onClick="deleted()">
                 <input type="button"  id="button1" value="AddOpt" onClick="Addopt('third','five')">                
	         </div>-->
         </form>
        </div>  

    </body>
</html>

<!--

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link href="../css/jquery.ime.css" rel="stylesheet" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
	<script src="../libs/rangy/rangy-core.js"></script>
	<script src="../src/jquery.ime.js"></script>
	<script src="../src/jquery.ime.selector.js"></script>
	<script src="../src/jquery.ime.preferences.js"></script>
	<script src="../src/jquery.ime.inputmethods.js"></script>
	<script src="script.js"></script>  
    <script>
		function check_value(val)
		{
			alert("selected language is : "+val);
		}		
	</script>
</head>

<body>
<form action="test.php" method="post">
					<select id="language" onChange="check_value(this.value)" name="language">
					</select>
					<select id="imeSelector" onChange="check_value(this.value)"></select>

		<textarea id="ced" name="ced"></textarea>
            <input type="submit">
</form>
</body>
</html>  -->