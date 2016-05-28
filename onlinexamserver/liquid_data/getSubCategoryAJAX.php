<?php
//session_start();
//if(isset($_SESSION['data_login_id']))
//    header("location:../index.php");

	/*$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
   echo json_encode($arr);

   $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

   var_dump(json_decode($json));
   var_dump(json_decode($json, true));*/
///////*****************************************************************************************//////////////////
   
  	$CatId = $_REQUEST['catId'];
	include("database_connection.php");
	
   $selectQuery = "select * from subcategory where QuesCatId=".$CatId;
   $dataArray =array();
   //$res = mysql_query($selectQuery);
   $res = $db->query($selectQuery);
   while($row = mysqli_fetch_array($res))
   {
	   //$dataArray = array($row['CatName'],$row['id']);
	   
	   //array_push($dataArray,array($row['CatName'],$row['id']));
	   
	   array_push($dataArray,array("id" => $row['id'] , "name" => $row['CatName']));
   }
   $jsonVar = json_encode($dataArray);
   echo $jsonVar;
 /*********************************************  USING FOR EACH TO ACCESS THE 2 DIM ARRAY ********************************************/
/*   foreach($dataArray as $dataKey => $dataValue)
   {
	   foreach($dataValue as $key => $value)
	   {
		   echo $value."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	   }
	   echo "<br>";
   }
   */
   
   //var_dump($dataArray);





/****************************************************
The {} in JSON represents an object. Each of the object's properties is represented by key:value and comma separated. The property values are accessible by the key using the period operator like so json.forum. The [] in JSON represents an array. The array values can be any object and the values are comma separated. To iterate over an array, use a standard for loop with an index. To iterate over object's properties without referencing them directly by key you could use for in loop:

var json = {"forum":[{"id":"1","created":"2010-03-19 ","updated":"2010-03-19 ","user_id":"1","vanity":"gamers","displayname":"gamers","private":"0","description":"All things gaming","count_followers":"62","count_members":"0","count_messages":"5","count_badges":"0","top_badges":"","category_id":"5","logo":"gamers.jpeg","theme_id":"1"}]};

var forum = json.forum;

for (var i = 0; i < forum.length; i++) {
    var object = forum[i];
    for (property in object) {
        var value = object[property];
        alert(property + "=" + value); // This alerts "id=1", "created=2010-03-19", etc..
    }
}
If you want to do this the jQueryish way, grab $.each():

$.each(json.forum, function(i, object) {
    $.each(object, function(property, value) {
        alert(property + "=" + value);
    });
});
I've used the same variable names as the "plain JavaScript" way so that you'll understand better what jQuery does "under the hoods" with it. Hope this helps.

***********************************************************/   
?>