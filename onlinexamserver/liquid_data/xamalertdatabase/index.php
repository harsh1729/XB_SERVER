<?php
session_start();
if(!isset($_SESSION['data_login_id']))
    header("location:../../index.php");
?>
<html>
    <head>
    	<style>
			#postContainer
			{
			}
			.margin10class
			{
				margin-top:10px;
				background-color:#999;
			}
		</style>
         
		<script src="../../src/jquery.min.js" ></script>
        <script>
			var totalPosts = 1;
			function updatePosts()
			{
				for(var j=totalPosts;j>1;j--)
				{
					$("#Post"+j+"Div").remove();
					//alert("removed "+j);
				}
				//if(totalPosts > document.getElementById('TotalPost').value)
				{
					for(var i=1;i < document.getElementById('TotalPost').value;i++)
					{
						var row = "<div id='Post"+(i+1)+"Div' class='margin10class'><br/>"
					+"Rank Name "+(i+1)+": <input type='text' placeholder='Rank Name "+(i+1)+"' name='PostName"+(i+1)+"' />"
					+"Total Seats: <input type='number' min='1' max='100000' name='TotalSeats"+(i+1)+"' value='1'/>"
					+"Salary: <input type='number' min='3000' max='80000' name='Salary"+(i+1)+"' value='3000'/><br />"
            +"<!--		XamAlert_Dates			-->"
			+"<input type='hidden' value='1' name='PostName"+(i+1)+"XamDateTotal'  id='PostName"+(i+1)+"XamDateTotal'/>"
			+"<div id='PostName"+(i+1)+"XamDate1Div'>"
                +"Xam Date 1: <input type='text' name='PostName"+(i+1)+"XamDate1' id='PostName"+(i+1)+"XamDate1' /><br />"
			+"</div>"
                +"<input type='button' value=' Add Exam Date ' id=PostName"+(i+1)+"AddBtn />"
                +"<input type='button' value=' Delete Exam Date ' onclick='RemoveXamDate()' id=PostName"+(i+1)+"RemoveBtn />"
            +"<!--		XamAlert_Dates			-->"
				+"</div>";
						$("#Post"+i+"Div").after(row);
						document.getElementById("PostName"+(i+1)+"AddBtn").setAttribute("onClick","AddXamDate('PostName"+(i+1)+"AddBtn','PostName"+(i+1)+"XamDate',1)");
						document.getElementById("PostName"+(i+1)+"RemoveBtn").setAttribute("onClick","RemoveXamDate('PostName"+(i+1)+"RemoveBtn','PostName"+(i+1)+"XamDate',1)");
					//alert("Added "+i);
					}
				}
				totalPosts = document.getElementById('TotalPost').value;
			}
		</script>
		<script>
			function AddXamDate(btnId,lastElementId,count)
			{
				//AddXamDate('PostName1AddBtn','PostName1XamDate',1)
				
				var row = "<div id='"+lastElementId+(count+1)+"Div'>"
                	+"Xam Date "+(count+1)+": <input type='text' name='"+lastElementId+(count+1)+"' id='"+lastElementId+(count+1)+"' />"
               	+"</div>";
				$("#"+lastElementId+count+"Div").after(row);
				document.getElementById(btnId).setAttribute("onClick","AddXamDate('"+btnId+"','"+lastElementId+"',"+(count+1)+")");
				var RemoveBtnId = btnId.replace("Add","Remove");
				document.getElementById(RemoveBtnId).setAttribute("onClick","RemoveXamDate('"+RemoveBtnId+"','"+lastElementId+"',"+(count+1)+")");
				
				document.getElementById(lastElementId+"Total").value = count+1;	
//				$("#"+btnId).remove();
				
//				var btnRow = "<input type='button' value=' Add Exam Date ' onclick='AddXamDate('"+btnId+"','"+lastElementId+(count+1)+"',"+(count+1)+")'  id='"+btnId+"' />";	
//			$("#"+lastElementId+(count+1)+"Div").after(btnRow);
			}
			function RemoveXamDate(btnId,lastElementId,count)
			{
				if(count > 1)
				{
					$("#"+lastElementId+count+"Div").remove();
					document.getElementById(btnId).setAttribute("onClick","RemoveXamDate('"+btnId+"','"+lastElementId+"',"+(count-1)+")");
					var AddBtnId = btnId.replace("Remove","Add");
					document.getElementById(AddBtnId).setAttribute("onClick","AddXamDate('"+AddBtnId+"','"+lastElementId+"',"+(count-1)+")");
				document.getElementById(lastElementId+"Total").value = count-1;	
				}
			}
		</script>
    </head>
    <body>
    	<form action="submitXamAlert.php" method="post">
        <!--		XamAlert_Details			--->
        	ExamName: <input type="text" placeholder="Exam Name" name="XamName" /><br />
            Opening Date: <input type="date" name="OpeningDate"/><br />
            Offline Last Date: <input type="date" name="OfflineLastDate" placeholder="Offline last Date"/> <br />
            Online Last Date: <input type="date" name="OnlineLastDate" /><br />
            Total Post: <input type="number" min="1" max="20" name="TotalPost" id="TotalPost" value="1" onchange="updatePosts()"><br /><br>
            enter link:- <input type="text" name='alert_link' style='width:300px;'> 
       	<!--		XamAlert_Details			--->
        <br />
        <div id="postContainer">
            <!--		XamAlert_posts			-->
            <div id="Post1Div" class="margin10class">
            <br />
                Rank Name 1: <input type="text" placeholder="Rank Name 1" name="PostName1" />
                Total Seats: <input type="number" min="1" max="100000" name="TotalSeats1" value="1"/>
                Salary: <input type="number" min="3000" max="80000" name="Salary1" value="3000"/><br />
            <!--		XamAlert_Dates			-->
            	<input type="hidden" value="1" name="PostName1XamDateTotal"  id="PostName1XamDateTotal"/>
                <div id="PostName1XamDate1Div">
                	Xam Date 1: <input type="text" name="PostName1XamDate1" id="PostName1XamDate1" />
               	</div>
                <input type="button" value=" Add Exam Date " onclick="AddXamDate('PostName1AddBtn','PostName1XamDate',1)" id="PostName1AddBtn"/>
                <input type="button" value=" Delete Exam Date " onclick="RemoveXamDate('PostName1RemoveBtn','PostName1XamDate',1)" id="PostName1RemoveBtn"/><br><br>
               
            
            <!--		XamAlert_Dates			-->
            </div>
            <!--		XamAlert_posts			-->        
		</div>
            <input type="submit" />
        </form>
    </body>
</html>