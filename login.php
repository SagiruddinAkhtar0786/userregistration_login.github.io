<?php
     $login = false;
     $showerror = false;
     if($_SERVER["REQUEST_METHOD"] == "POST"){
         include 'connection.php';
         $username = $_POST["username"];
         $password = $_POST["password"];
         $psw = md5($password);
      
 
            $sql = "SELECT * from `itlabexercise` WHERE `NAME`='$username' AND  `PASSWORD`='$psw' ";
             $result = mysqli_query($conn,$sql);
             $num = mysqli_num_rows($result);

 
             if($num == 1){
                 $login= true; 
                 session_start();
                 $_SESSION["loggedin"] = true;
                 $_SESSION["username"] = $username;
                
                 if(!empty($_POST["remember"])) 
                 {
                     // COOKIES for username
                      setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
                     //COOKIES for password
                     setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
                 }
                 else{
                         if(isset($_COOKIE["user_login"]))
                         {
                             setcookie ("user_login","");
                         }
                         if(isset($_COOKIE["userpassword"])) 
                         {
                             setcookie ("userpassword","");
                         }
                 }
               
               
               
                 // redirect
 
                 header("location:welcome.php");
 
             }
             else{
                 $showerror = " Invalid credential";
             }
 
             mysqli_close($conn);
            }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login system</title>
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
        <strong>Success!</strong> You are logged in.
        </div>';}
        if($showerror){
            echo '<div class="success" style=" width: 300px; text-align: center;    background-color: rgb(158, 219, 45);margin : 20px auto;">
             <strong>Error!</strong>'. $showerror .'</div>';}
?>

    <!-- Sign up form creation  -->
    <div class="container">
        <div class="center">
            <div class="heading">
                <h3>Login to our website</h3>
            </div>

            <form action="/remember_me/login.php" method="post">
                <div class="user">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"  value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" >
                </div>

                <div class="pass">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                </div>

                <div class="remem">
		            <input type="checkbox" name="remember" id="remember" style="width : 14px" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
		            <label for="remember-me" id="rem" style="width : 14px; font-size:16px;">Remember me</label>
	            </div>
                <button type="submit" class="btn" name="login" value="Login">login</button>

                <p style="text-align : center;" >Not yet member? <a style="color : cyan; font-size: 15px;" href="regis.php">Sign up</a></p>
                <div  style=" text-align:center; ">
                    <a  style="color : cyan; font-size: 15px;" href="forget.php">forget your Password</a>
                    <a  style="color : cyan; font-size: 15px;" href="resetpassword.php">reset your Password</a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>