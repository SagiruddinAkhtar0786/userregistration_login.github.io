<?php
$showerror = false;
     $success = false;
     if($_SERVER["REQUEST_METHOD"] == "POST"){
         include 'connection.php';
         $username = $_POST["username"];
         $curpassword = $_POST["currentpassword"];
         $newpassword = $_POST["newpassword"];
          $psw = md5($curpassword);
      
 
            $sql = "SELECT * from `itlabexercise` WHERE `NAME`='$username' AND  `PASSWORD`='$psw' ";
             $result = mysqli_query($conn,$sql);
             $num = mysqli_num_rows($result);
 
             if($num == 1){
                $login= $newpassword; 
                $hasspass = md5($newpassword);
                $update = "UPDATE `itlabexercise` SET `password` = '$hasspass' WHERE `itlabexercise`.`Name` = '$username'";
                $retval = mysqli_query($conn,$update);
 
                if(!$retval ) {
                //    die('Could not update data: ' . mysqli_error());
                echo "something is wrong";
                }
                else{
                    $success = "password reset successfully";
                }
                //  $login= true; 
                //  session_start();
                //  $_SESSION["loggedin"] = true;
                //  $_SESSION["username"] = $username;
 
                 // redirect
 
                //  header("location:welcome.php");
 
             }
             else{
                 $showerror = "Current Password do not match";
             }
 
             mysqli_close($conn);
            }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="partials/regis.css">
    <style>
        body{
            background : url("back.jpeg");
            background-size:cover;
            background-image: center center;
        }
        .center{
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    border-radius: 5px;
}
    </style>
</head>
<body>
<?php
        require "nav.php";
    ?>

<?php
    if($showerror){
        echo '<div class="success" style=" width: 300px; text-align: center;    background-color: rgb(158, 219, 45);margin : 20px auto;">
         <strong>Error! </strong>'.$showerror .' <strong> Please Use correct current password </strong>'  .'</div>';}
    if($success){
       echo '<div class="success" style=" width: 300px; text-align: center;    background-color: rgb(158, 219, 45);margin : 20px auto;">
        <strong>Success!</strong>'.$success .'</div>';}
?>
<div class="container">
        <div class="center">
            <div class="heading">
                <h3>Reset your password</h3>
            </div>

            <form action="/remember_me/resetpassword.php" method="post">
                <div class="user">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="pass">
                    <label for="currentpassword" class="form-label">Current Password</label>
                    <input type="currentpassword" class="form-control" id="currpassword" name="currentpassword">
                </div>
                <div class="pass">
                    <label for="newpassword" class="form-label">New Password</label>
                    <input type="newpassword" class="form-control" id="newpassword" name="newpassword">
                </div>
                <button type="submit" class="btn">login</button>
            </form>
        </div>
    </div>

</body>
</html>