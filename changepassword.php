<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "crudoperation";
$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['Submit'])) {
    $userprofile = $_SESSION['user_name'];
    $oldpass = $_POST['oldpassword'];
    $newpassword = $_POST['Newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    $sql = "SELECT password FROM crudtables WHERE email='$userprofile'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_fetch_array($result);

    if ($oldpass === $num['password']) {
        if ($newpassword === $confirmpassword) {
           
            $sql1 = "UPDATE crudtables SET password='$newpassword' WHERE email='$userprofile'";
            if (mysqli_query($conn, $sql1)) {
                $_SESSION['message'] = "Password Changed Successfully!";
            } else {
                $_SESSION['message'] = "Error updating password: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['message'] = "New password and confirm password do not match!";
        }
    } else {
        $_SESSION['message'] = "Incorrect old password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
    background: url('1.jpg') no-repeat rgba(0, 0,0, 0.5); 
    background-position: center;
    background-attachment: fixed;
    background-size: cover;
    background-blend-mode: multiply;
    
 }
.center{
    position: absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    width:400px;
    
}
.center .container{
    background-color: rgba(255,255,255,.1);
    border-radius: 1px;
    padding: 20px;
    margin-left:5px;
    background-position: center;

    position:relative;
    width: 500px;
    backdrop-filter: blur(.2rem);
   
      

}
.center h1{
    text-align: center;
    padding-bottom: 20px;
    color: aliceblue;
   
   
}
.form{
    padding-bottom: 15px;
    margin:0 20px;
    text-align: center;
}
.textfield{
    width: 100%;
    height:50px;
    font-size: 18px;
    border: 1px solid rgb(219, 219, 232);
    border-radius: 1px;
    box-sizing: border-box;
    padding-left: 10px;
    margin: 7px 0;
}
.btn{
    width:100%;
    height:50px;
    background-color: rgb(244, 194, 194);
    border-radius: 5px;
    font-size: 20px;
    margin:7px 0;
    border:0;
    cursor: pointer;
}
.btn:hover{
    background-color: rgb(101, 138, 138);
}
.form .signup{
    color:white;
}
.form .signup a{
    color:white;
}
.form .cpassword{
    color:white;
}
.form .cpassword a{
    color:white;
}
    </style>
 
</head>
<body>
<p style="color:white;">
<?php
if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>



</p>


<div class="center">
        <div class="container">
            <h1>change password</h1>
            <form action="changepassword.php" method="post" onSubmit="return valid();" autocomplete="off">
                <div class="form">
                    <input type="password" name="oldpassword" placeholder="Enter the existing password" class="textfield"><br>
                    <input type="password" name="Newpassword" placeholder="Enter the New password" class="textfield"><br>
                    <input type="password" name="confirmpassword" placeholder="Enter confirm password" class="textfield"><br>
                    <!-- <input type="cpassword" name="cpassword" placeholder="change password" class="textfield"><br> -->
                    <td><input type="submit" name="Submit" value="Change Passowrd" style="padding:9px" /></td>
                    <!-- <td><a href="login.php">Loginpage</a><input type="submit" /></td> -->

                    <button style="padding:9px"><td ><a href="display.php">Back</a></td></button>
                </div>
            </form>
        </div>
</div>
</body>
</html>