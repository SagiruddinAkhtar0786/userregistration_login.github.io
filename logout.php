<?php
    session_start();
    session_unset();
    session_destroy();

     // COOKIES for username
     setcookie ("user_login",$_POST["username"],time()-3600);
     //COOKIES for password
     setcookie ("userpassword",$_POST["password"],time()-3600);

    header("location:login.php");
    exit;
?>