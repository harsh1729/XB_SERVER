<?php

$AppId = $_REQUEST['appId'];
//Ad Id : Inmobi 1 , ChartBoost 2 , StartApp 3
 $text = "www.murgiyaanda.com";
    //$link_text = "Soon we are launching a website for online exam. Tell us your suggestions through 'Settings -> Contact Us Screen'.";//";
    $link_text = "";//"Hurry Up Guys!! Visit examkabila.com to download New Gk Capsule-2 for IBPS Clerk Mains Exam(2-3 January 2016).";//";
    
    $promotional_text= $link_text."<a href='www.murgiyaanda.com'>".$text."</a>";

$jsonValueArray = array("ShowAdvt" => 1,"AdvtId" => 2,  "AdvtIntertialId" => 2,"promotional_text" => $link_text);


echo json_encode($jsonValueArray);

?>