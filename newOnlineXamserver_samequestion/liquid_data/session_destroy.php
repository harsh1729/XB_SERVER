<?php

include("database_connection.php");

session_start();
if(isset($_SESSION['newonlineserver_login_id']))
  unset($_SESSION['newonlineserver_login_id']);
  
header("location:index.php");


?>