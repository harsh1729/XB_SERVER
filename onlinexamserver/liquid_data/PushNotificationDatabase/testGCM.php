<?php
session_start();
if(!isset($_SESSION['data_login_id']))
    header("location:../../index.php");
?>
<?php

include("../database_connection.php");



// Message to be sent
$message = $_POST['message'];

$ScreenId = $_REQUEST['ScreenId'];
 
// Set POST variables
$url = 'https://android.googleapis.com/gcm/send';
 
 $AppId = $_POST['AppId'];

 
 $getmessageUsers = array();
 $getregusersQuery = "select * from GcmRegisteredUser where AppId=".$AppId;
 echo $getregusersQuery;
 
 //$getuserResult = mysql_query($getregusersQuery);
 $getuserResult = $db->query($getregusersQuery);
 /*
 while($getuserRow = mysql_fetch_array($getuserResult) )
 {
     array_push($getmessageUsers,$getuserRow['regId']);
    
 }
*/
array_push($getmessageUsers,"APA91bEoy5-kITvsffSrUz2DBf_gWdRF2mkvqB2Cj0rlSF-aNJUi5K8mjsgkBBHuKttil3FJut17XaGPranGn4PsUEfxzOlJ-dhidqfEFQeUlY1yhPgGJ5GhgS-tcfysQHPPf_0nLbCOVaZTr-hNuYrPJGt64R-CFw");
array_push($getmessageUsers,"APA91bHG5TIuX3LCfNJzVC-KaaiotDz6uJHk3J_6Co7O8MdE2dn5_HQbR9wX8EaFf2yhemy6HOGue9THl0a-cnhSk3nphhxd9rpSg0j4LHmsGvHtQ2lGw2HbPC_Un3r1_LMON4C5PyqbeDqkDp38ayvrd568dOQqFx4f1p_41dc6wD8TCp6vp78");
array_push($getmessageUsers,"APA91bH1_WyrA4AU5HBOgixRaMOrIjhiOokCkSBbbw8A2TytiY9XtL6iWhhFE4YYKV4ZRhe-6v6Hvj0mIohRyygqNXKds8TjAoruxkz6IChKeoxrsdkXdYqPgCWQPMVS5zha_I83aMtxCCP20wcA_--XerZ4yuzdryr0IdIs4kAxxkrANapIKP8");
$splittedGcmArray = array_chunk($getmessageUsers,1000);

//foreach($splittedGcmArray as $ids)
//{    
    $fields = array(
                    //'registration_ids'  => array($_POST['registrationIDs']),
                    'registration_ids'  => $getmessageUsers,
                    //'registration_ids'  => $ids,
                    'data'              => array( "message" => $message  ,"ScreenId" => (string)$ScreenId),
                    );
     
    $headers = array(
                        'Authorization: key=' . $_POST['apiKey'],
                        'Content-Type: application/json'
                    );
     
    // Open connection
    $ch = curl_init();
     
    // Set the url, number of POST vars, POST data
    curl_setopt( $ch, CURLOPT_URL, $url );
     
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
     
    // Execute post
    $result = curl_exec($ch);
     
    // Close connection
    curl_close($ch);
     
    echo $result."<br><br><br>";
    
    $resultDecode = json_decode( $result ,true );
   // echo "sendCount: ".$resultDecode['success'];
    //echo "canonical Count :".$resultDecode['canonical_ids'];
   // echo "failure Count :".$resultDecode['failure'];
//}

//header("location: index.php?msgsend=Message send Succusfully to the selected devices");
 
?>