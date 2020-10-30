<?php
function random_password( $length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
?>

<?php
      $login = false;
      $showerror = false;
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          include 'connection.php';
          $username = $_POST["username"];
          $phone = $_POST["phonenumber"];
         
       
  
             $sql = "SELECT * from `itlabexercise` WHERE `NAME`='$username' AND  `PHONENUMBER`='$phone' ";
              $result = mysqli_query($conn,$sql);
              $num = mysqli_num_rows($result);
  
              if($num == 1){
                $pass = random_password(8);
                  $login= $pass; 
                  $hasspass = md5($pass);
                  $update = "UPDATE `itlabexercise` SET `password` = '$hasspass' WHERE `itlabexercise`.`Name` = '$username'";
                  $retval = mysqli_query($conn,$update);
   
                  if(!$retval ) {
                     die('Could not update data: ' . mysqli_error());
                  }
                 
                  // redirect
  
                //   header("location:welcome.php");
  
              }
              else{
                  $showerror = "Invalid Username or Mobile Number";
              }
  
              mysqli_close($conn);
             }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
    if($login){
        echo '<div class="success" style=" width: 300px; text-align: center;    background-color: rgb(158, 219, 45);margin : 20px auto;">
         <strong>Your New Password! is : </strong>'.$login .' <strong> To reset your password follow this link   <a href="resetpassword.php">reset</a> </strong>'  .'</div>';}
    if($showerror){
       echo '<div class="success" style=" width: 300px; text-align: center;    background-color: rgb(158, 219, 45);margin : 20px auto;">
        <strong>Error!</strong>' .$showerror .'</div>';}
?>

    <!-- Sign up form creation  -->
    <div class="container">
        <div class="center">
            <div class="heading">
                <h3>Recover password</h3>
            </div>

            <form action="/remember_me/forget.php" method="post">
                <div class="user">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="phone">
                    <label for="phonenumber" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                </div>
                <button type="submit" class="btn">login</button>

                

            </form>
        </div>
    </div>

</body>
</html>