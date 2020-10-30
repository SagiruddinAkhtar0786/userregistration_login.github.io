<?php
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header("location:login.php");
        exit;
    }


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Welcome page</title>
    <link rel="stylesheet" href="partials/welcome.css">

<body>

    <?php
        require 'nav.php';
    ?>

   

    <div class="container">
        <div class="alert">
            <h4 class="alert-heading" > Welcome <?php echo $_SESSION['username'] ?></h4>
            <p>its appreciation time that you login to the web successfully..Yor are logged in as <?php echo $_SESSION['username'] ?>
            </p>
            <hr>
            <p>Go back to login form by <a href="/remember_me/login.php"> using this link.</a></p>
        </div>
    </div>
    </head>
</body>

</html>