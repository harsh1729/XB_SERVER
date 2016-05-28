<?php

include("../database_connection.php");

// http://xercesblue.in/onlinexamserver/liquid_data/AppRegisteredUsers/registerUser.php?name=jaspal&mobile=7891384482&email=jaspal.s@xercesblue.in&city=sri%20ganganagar

$name = $_REQUEST['name'];
$mobile = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$city = $_REQUEST['city'];

$checkUserQuery = "select * from AppRegisteredUsers where mobile = '".$mobile."' and email = '".$email."' ";
//$checkUserResult = mysql_query( $checkUserQuery );
$checkUserResult = $db->query( $checkUserQuery );
$rowCount = mysqli_num_rows( $checkUserResult );
if($rowCount > 0)
{
    // user already exists
}
else
{
    $insertQuery = "insert into AppRegisteredUsers (name,email,mobile,city) values ('".$name."','".$email."','".$mobile."','".$city."') ";
    echo $insertQuery;
    //mysql_query( $insertQuery );
    $db->query($insertQuery );
}

?>