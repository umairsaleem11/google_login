<?php
require 'config.php';
//reset oauth user token 
unset($_SESSION['access_token']);
//session destory 
  session_destroy();
 //redicect home page 
 header('location:http://localhost/google_authentication/index.php');
 exit(); 
?>