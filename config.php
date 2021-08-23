<?php
  require_once 'vendor/autoload.php';

  //for google client request
  $google_client = new Google_Client();
  //set google google client id 
  $google_client->setClientId('324679777439-4cost6e64kfge3vqr4rv63pgmhp3gnck.apps.googleusercontent.com');
  //set google secret id 
  $google_client->setClientSecret('1_fBMwuyoWEW-UlC5eVTgCci');
  //set auth redirect url
  $google_client->setRedirectUri('http://localhost/google_authentication/index.php');

  //hum na us ka kn kn sa data lenah h 
  $google_client->addScope('email');

  $google_client->addScope('profile');


?>