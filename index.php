<?php
    require 'config.php';
    $login_button = '';
    //jb user login ho ga to aik code generate ho ga
    if(isset($_GET["code"])){
    $token=$google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    //ager token khali ho ga to error ho ga otherwise wo excute ho ga 
    if(!isset($token['error']))
    {
        //set or access the client token 
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        //create object for google services
        $google_service = new Google_Service_Oauth2($google_client);
        //get user profile data
        $data=$google_service->userinfo->get();

        //show you can user profile data
        if(!empty($data['given_name']))
        {
            $_SESSION['user_first_name']= $data['given_name'];
        }
        if(!empty($data['family_name']))
        {
            $_SESSION['user_last_name']= $data['family_name'];
        }
        if(!empty($data['email']))
        {
            $_SESSION['user_email_address']= $data['email'];
        }
        if(!empty($data['gender']))
        {
            $_SESSION['user_gender']= $data['gender'];
        }
        if(!empty($data['picture']))
        {
            $_SESSION['user_image']= $data['picture'];
        }
    }
    }

    if(!isset($_SESSION['access_token'])) {
    
$login_button='<a href='.$google_client->createAuthUrl().'></a>';    
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Sign in Form with Social Login Buttons</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 340px;
    margin: 30px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.login-form .hint-text {
    color: #777;
    padding-bottom: 15px;
    text-align: center;
  	font-size: 13px; 
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.login-btn {        
    font-size: 15px;
    font-weight: bold;
}
.or-seperator {
    margin: 20px 0 10px;
    text-align: center;
    border-top: 1px solid #ccc;
}
.or-seperator i {
    padding: 0 10px;
    background: #f7f7f7;
    position: relative;
    top: -11px;
    z-index: 1;
}
.social-btn .btn {
    margin: 10px 0;
    font-size: 15px;
    text-align: left; 
    line-height: 24px;       
}
.social-btn .btn i {
    float: left;
    margin: 4px 15px  0 5px;
    min-width: 15px;
}
.input-group-addon .fa{
    font-size: 18px;
}
</style>
</head>
<body>
<div class="login-form">
    <form  method="post">
        <h2 class="text-center">Sign in</h2>		
        <div class="text-center social-btn">
            <a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
            <a href="#" class="btn btn-info btn-block"><i class="fa fa-twitter"></i> Sign in with <b>Twitter</b></a>
			<a href="<?php echo $google_client->createAuthUrl() ?>" class="btn btn-danger btn-block"><i class="fa fa-google"></i> Sign in with <b>Google</b></a>
        </div>
		<div class="or-seperator"><i>or</i></div>
        <div class="form-group">
        	<div class="input-group">                
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-user"></span>
                    </span>                    
                </div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
        </div>       
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block login-btn">Sign in</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right text-success">Forgot Password?</a>
        </div>  
        <div class="hint-text">Don't have an account? <a href="#" class="text-success">Register Now!</a></div>
    </form>
    </div>
   <?php } else { ?> 
   <div class="container">
   <div class="panel panel-default">
   <?php 
       if($login_button == ""){
           echo'<div class="panel-heading">Welcome User</div><div class="panel-body">';
           echo'<image src="'.$_SESSION['user_image'].'" class="img-responsive img-circle image-thumbnail">';
           echo'<h3><b>Name:</b>'.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
           echo'<h3><b>Email:</b>'.$_SESSION['user_email_address'].'</h3>';
           echo'<h3><a href="logout.php">Logout</h3>';
       }
       else{
           echo '<div align="center">'.$login_button.'</div>';
       }
     } ?>
   </div>
   </div>
</body>
</html>