<?php
echo "<html>";
echo "<head>";
        echo "<meta charset='utf-8' />";
    echo "</head>";
    echo "<body>";
$finalArray = array();

$ar = array();
$ar["news_id"] = 2;
$ar["heading"] = "My News";
$ar["content"] = "आप देख सकते हैं कुछ ताजा तस्विरें उ.प्र. में आई बाड की ";
$ar["cat_id"] = 5;
$ar["date"] = "22/07/2014 AM 12:25:45";

$img_ar = array();

$img_data = array();

$img_data["img_id"] = 10;
$img_data["image"] = "http://www.google.com/img1.jpg";
$img_data["description"] = "My img1 description";

array_push($img_ar,$img_data);


$ar["linked_images"] = $img_ar;

array_push($finalArray,$ar);




//echo json_encode($finalArray,JSON_UNESCAPED_SLASHES,JSON_UNESCAPED_UNICODE);
echo json_encode($finalArray,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);



    echo "</body>";
echo "</html>";

?>