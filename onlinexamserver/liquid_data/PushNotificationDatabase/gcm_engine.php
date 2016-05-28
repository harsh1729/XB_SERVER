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
 if( $_REQUEST['SelectUsers']  == "custom" )
 {
     $getregusersQuery = "select * from GcmRegisteredUser where AppId=".$AppId." and id > ".$_REQUEST['SelectFrom']." and id < ".$_REQUEST['SelectUpTo'];
 }
 else
 {
    $getregusersQuery = "select * from GcmRegisteredUser where AppId=".$AppId;
 }
 echo $getregusersQuery;
 
 //$getuserResult = mysql_query($getregusersQuery);
 $getuserResult = $db->query($getregusersQuery);
 
 while($getuserRow = mysqli_fetch_array($getuserResult) )
 {
     array_push($getmessageUsers,$getuserRow['regId']);
    
 }

$splittedGcmArray = array_chunk($getmessageUsers,1000);


foreach($splittedGcmArray as $ids)
{    
    $fields = array(
                    //'registration_ids'  => array($_POST['registrationIDs']),
                    //'registration_ids'  => $getmessageUsers,
                    'registration_ids'  => $ids,
                    'data'              => array( "message" => $message ,"ScreenId" => (string)$ScreenId),
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
}

//header("location: index.php?msgsend=Message send Succusfully to the selected devices");
 
?>