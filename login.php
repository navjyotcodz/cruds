<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location: login.php');
    exit();
  }

    // if (!isset($_SESSION['user_name'])) {
    //   header('location: login.php');
    //   exit();
    // }
    // echo "";


// // Check if the user is already logged in
// if (isset($_SESSION["username"])) {
//     header("Location:login.php");
//     exit();
// }
?>





<!DOCTYPE html>
<html>
<head>
  <style>
     body {
      height: 100%;
      margin: 0;
      
      align-items: center;
      justify-content: center;
      
    }
    
    .loginfailed{
      font-size:20px;
      text-align:center;
      color:white;
      margin-top:20px;
      margin-left:8%;
        }
  </style>
</head>
<body>
  <div class="loginfailed">

</body>
</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <title>loginpage</title>
</head>

<body>
    <div class="center">
        <div class="container">
            <h1>Login</h1>
            <form action="#" method="POST" autocomplete="off">
                <div class="form">
                    <input type="text" name="username" placeholder="Enter the username" class="textfield"><br>
                    <input type="password" name="password" placeholder="Enter the password" class="textfield"><br>
                    <!-- <input type="cpassword" name="cpassword" placeholder="change password" class="textfield"><br> -->
                    <input type="submit" name="login" value="login" class="btn">

                    <div class="signup">New Member ?<a href="insert.php" class="link">signup</a></div><br>
                               </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php
 
include("conn.php");
if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
     $q ="SELECT * from crudtables where email='$username'  AND  password ='$password'";
    $data=mysqli_query($conn,$q);
    $total=mysqli_num_rows($data);
    // echo $total;

    if($total ==1){
        $_SESSION['user_name'] = $username;  
        header('location:display.php');
    }else{
        echo "login failed";

    }
    

}
?>