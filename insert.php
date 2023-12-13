<?php
include 'conn.php';
$successMessage = '';


if(isset($_POST['done'])){
    $firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
    $lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $DOB=mysqli_real_escape_string($conn,$_POST['DOB']);
    $gender=mysqli_real_escape_string($conn,$_POST['gender']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $image = "";
    // $firstname = $_POST['firstname'];
    // $lastname = $_POST['lastname'];
    // $password = $_POST['password'];
    // $email = $_POST['email'];
    // $DOB=$_POST['DOB'];
    // $gender=$_POST['gender'];
    // $address = $_POST['address']; 
    // $image = "";
    if (empty($firstname) && empty($lastname) && empty($email) && empty($DOB) && empty($address)) {
     echo 'please fill the fields';}
    
    else if (isset($_FILES["dobphoto"]["name"]) && !empty($_FILES["dobphoto"]["name"])) {
      $lfilename = basename($_FILES['dobphoto']['name']);
      
      $imageFileType = strtolower(pathinfo($lfilename, PATHINFO_EXTENSION));
      
      if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
          echo 'Only JPG files are allowed.';
      } else {
          $lext = strtolower(substr($lfilename, strrpos($lfilename, '.') + 1));
          $lnewfile = md5(microtime()) . "." . $lext;
          
          if (move_uploaded_file($_FILES['dobphoto']['tmp_name'], "images/" . $lnewfile)) {
              $image = $lnewfile;
 
        $check_email=" SELECT * FROM crudtables WHERE email='$email'";
        $data =mysqli_query($conn,$check_email);
        $res=mysqli_fetch_array($data);
        if($res >0){
          
          $successMessage = '<h5>Email already exists</h5>';
        }
        else{
       
        $q = "INSERT INTO crudtables (`firstname`, `lastname`, `password`, `email`, `DOB`, `gender`, `address`, `image`) VALUES ('$firstname', '$lastname', '$password', '$email', '$DOB', '$gender', '$address', '$image')";
                    
        $query = mysqli_query($conn, $q);
        if ($query) {
            $successMessage = 'Registration successful. Now you can login.';
        }
          }
      }
    }
      
  } else {
    echo 'Please upload a file.';
}
      
  //   $q = " INSERT INTO crudtables (`firstname`, `lastname`,`password`,`email`,`DOB`,`gender`,`address`,`image`) VALUES ( '$firstname', '$lastname','$password','$email','$DOB','$gender','$address','$image' )";

  //   $query = mysqli_query($conn,$q);
  //   if ($query) {
  //     $successMessage = 'Registration successful ,Now you can Login';
  // }

 };
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>insert crud operation</title>
  <link rel="stylesheet" href="insert-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 

    
</head>

<body>

  <header>
    <nav>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <h6><a class="nav-link" href="login.php">Login</a></h6>
            </li>

          </ul>

        </div>
      </nav>
    </nav>
  </header>
  <?php if ($successMessage): ?>
    <div class="alert alert-primary text-center" style="height:39px" role="alert">
        <?php echo $successMessage; ?>
    </div>
    <?php endif; ?>
  

  <div class="col-lg-7 m-auto mt-2 ">
    
    <form method="POST"  enctype="multipart/form-data">
      <div class="card">
        <div class="card-header bg-transparent">
          <h4 class=" text-dark text-center " style="height:10px" >Registration Form</h4>

        </div>

        <div class="form bg-dark">
         
          <label for="exampleInputfirstname" class="form-label">Firstname</label><br>
          <input type="text"  class="form-control" style="height:30px" id="exampleInputfirstname" name="firstname" required >
          <label for="exampleInputlastname" class="form-label">Lastname</label>
          <input type="text"  class="form-control" style="height:30px" id="exampleInputlastname" name="lastname" required>
          <!-- <label for="exampleInputpassword" class="form-label">Password</label><br> -->
          <label for="exampleInputpassword" class="form-label">Password</label><br>
          <input type="password" class="form-control" style="height:30px" name="password" pattern="(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9\s]).{4,}" title="Password must contain at least 1 digit, 1 letter, and 1 special symbol, and be at least 4 characters long" required>

          <!-- <input type="passsword"  class="form-control" style="height:30px" name="password" > -->
          <label for="exampleInputemail" class="form-label">Email</label><br>
          <input type="email"  class="form-control"  style="height:30px"name="email" required >
          <label for="exampleInputDOB" class="form-label">DOB</label><br>
          <input type="date" class="form-control" style="height: 30px" name="DOB" max="<?php echo date('Y-m-d'); ?>"  required>
          <label for="exampleFormControlgender" class="form-label">Gender</label>
          <select class="form-select" id="exampleFormControlSelect1" name="gender" required>
             <option value="male">Male</option>
             <option value="female">Female</option>
          </select>
          <label for="exampleInputaddress" class="form-label">address</label><br>
          <textarea class="form-control" name="address" style="height:50px" required ></textarea>
          <label for="exampleInputimage" class="form-label">IMAGE</label><br>
          <input type="file"  class="form-control" style="height:45px" name="dobphoto"  required>
          <button type="submit"  class="btn btn-primary" name="done">Register</button>

        </div>

    </form>

  </div>

  

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
    crossorigin="anonymous"></script>
</body>

</html>