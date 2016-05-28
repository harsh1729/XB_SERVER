<?php

include("database_connection.php");

session_start();
if(isset($_SESSION['data_login_id']))
  unset($_SESSION['data_login_id']);
  
header("location:../index.php");


?>