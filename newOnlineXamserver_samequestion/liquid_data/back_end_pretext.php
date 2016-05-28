<?php
include("database_connection.php");
session_start();
$language = "hi";
$language_english = "en";
  $querystring ="select * from pretext_record where lang_id='".$language."' order by id desc limit 26";
  $query = mysqli_query($db,$querystring);
  $total_pretext = array();
$all_pretext_hindi = array();
while($row = mysqli_fetch_array($query))
{
    $array = array();
    $id = $row['id'];
    $text = mb_substr($row['pretext'],0,40,'UTF-8');
    if($row['pretext'] !== "")
    {
        $array['id']= $id;
        $array['text']= $text." ...";
        $array['full_text']=$row['pretext'];
        array_push($all_pretext_hindi,$array);
    }
    else
    {
        $array['id']= $id;
        $array['text']= $row['image'];
        $array['full_text']=$row['image'];
        array_push($all_pretext_hindi,$array);   
    }
    
}
$querystring ="select * from pretext_record where lang_id='".$language_english."' order by id desc limit 6";
$query = mysqli_query($db,$querystring);

$all_pretext_english = array();
while($row = mysqli_fetch_array($query))
{
    $array = array();
    $id = $row['id'];
    $text = mb_substr($row['pretext'],0,40,'UTF-8');
    if($row['pretext'] !== "")
    {
        $array['id']= $id;
        $array['text']= $text." ...";
        $array['full_text']=$row['pretext'];
        array_push($all_pretext_english,$array);
    }
    else
    {
        $array['id']= $id;
        $array['text']= $row['image'];
        $array['full_text']=$row['image'];
        array_push($all_pretext_english,$array);
    }
    
}

array_push($total_pretext,$all_pretext_hindi);
array_push($total_pretext,$all_pretext_english);


echo json_encode($total_pretext);

?>