<?php
$showalert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'connection.php';
    $username = $_POST["username"];

    $password = $_POST["password"];
   
    $psw = md5($password);
    $phonenumber= $_POST["phonenumber"];


    // check whether username exist
    $existsql = "SELECT * FROM `itlabexercise` WHERE Name = '$username'";
  
    $result = mysqli_query($conn,$existsql);
    
   
    $numexistrows = mysqli_num_rows($result);
   
    if($numexistrows == 1){
        $showerror = "username already exist";
    }   
    else{
        
            $sql = "INSERT INTO `itlabexercise` (`Name`, `password`, `phonenumber`, `reg_date`) VALUES ('$username', '$psw', '$phonenumber', current_timestamp())";
            $result = mysqli_query($conn,$sql);
      
            

            if($result){
                
                $showalert = true; 
                  
            }
          
        
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user registration</title>
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
    <!-- include nav.php will access navbar  -->
    <?php
    require 'nav.php';
    ?>

<?php
    if($showalert){
       echo '<div class="success" style=" width: 300px; text-align: center;    background-color: rgb(158, 219, 45);margin : 20px auto;">
        <strong>Success! </strong> Your account is Created Successfully.
        </div>';}
    if($showerror){
       echo '<div class="success" style=" width: 300px; text-align: center;    background-color: rgb(158, 219, 45);margin : 20px auto;">
        <strong>Error!</strong>'.$showerror.'</div>';}
?>

    <!-- Sign up form creation  -->
    <div class="container">
        <div class="center">
            <div class="heading">
                <h3>signup to our website</h3>
            </div>

            <form action="/remember_me/regis.php" method="post">
                <div class="user">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="pass">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="phone">
                    <label for="phonenumber" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                </div>
                <button type="submit" class="btn">Signup</button>
            </form>
        </div>
    </div>


</body>

</html>