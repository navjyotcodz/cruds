<?php
session_start();

include 'conn.php';
//check if user is logged in

//get value from session

$id = $_GET['id'];
$q = "SELECT firstname,lastname,email,dob,gender,city,country,address FROM crudtables WHERE id='$id'";
$query = mysqli_query($conn, $q);
//$total = mysqli_num_rows($query);
$res = mysqli_fetch_assoc($query);



if (isset($_POST['done'])) {
    $id = $_GET['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    // $password = $_POST['password'];
    $email = $_POST['email'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $country_id = "";
    $address = $_POST['address'];
    $role_as = $_POST['role_as'];

    $countryQuery = "SELECT * FROM apps_countries WHERE country_name = '$country'";
    $countryResult = mysqli_query($conn, $countryQuery);

  

    if (isset($_FILES["dobphoto"]["name"]) && !empty($_FILES["dobphoto"]["name"])) {
        $lfilename = basename($_FILES['dobphoto']['name']);
      
        $imageFileType = strtolower(pathinfo($lfilename, PATHINFO_EXTENSION));
      
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            echo 'Only JPG, PNG, and JPEG files are allowed.';
        } else {
            $lext = strtolower(substr($lfilename, strrpos($lfilename, '.') + 1));
            $lnewfile = md5(microtime()) . "." . $lext;
            
            if (move_uploaded_file($_FILES['dobphoto']['tmp_name'], "images/" . $lnewfile)) {
                $image = $lnewfile;
            }
        }
    }

    if (isset($_FILES["dobphoto"]["name"]) && !empty($_FILES["dobphoto"]["name"])) {
        $q = "UPDATE crudtables SET firstname='$firstname', lastname='$lastname', email='$email', DOB='$DOB', image='$image', gender='$gender', city='$city', country='$country', address='$address', role_as='$role_as' WHERE id='$id'";
    } else {
        $q = "UPDATE crudtables SET firstname='$firstname', lastname='$lastname', email='$email', DOB='$DOB', gender='$gender', city='$city', country='$country', address='$address', role_as='$role_as' WHERE id='$id'";
    }

    $query = mysqli_query($conn, $q);

    header('location:display.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>update operation</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="col-lg-9 m-auto">
        <?php 
        if($res)
        {        
        ?>
        <form method="post" enctype="multipart/form-data">

            <br><br>
            <div class="card">

                <div class="card-header bg-light">
                    <h3 class="text-dark text-center" style="height:10px"> Update Data </h3>
                    <div>
                        <label for="exampleInputfirstname" class="form-label">firstname</label><br>
                        <input type="text" style="height:30px" value="<?php echo $res['firstname']; ?>"
                            class="form-control" name="firstname" id="exampleInputfirstname">
                        <label for="exampleInputlastname" class="form-label">lastname</label>
                        <input type="text" style="height:30px" value="<?php echo $res['lastname']; ?>"
                            class="form-control" id="exampleInputlastname" name="lastname">
                        <label for="exampleInputemail" class="form-label">email</label><br>
                        <input type="email" value="<?php echo $res['email']; ?>" class="form-control" name="email">

                        <label for="exampleInputDOB" class="form-label">DOB</label><br>
                        <input type="date" class="form-control" style="height: 30px" name="DOB"
                            value="<?php echo $res['dob'];?>"  required>
                        <label for="exampleFormControlgender" class="form-label">Gender</label>
                        <select class="form-control" id="exampleFormControlgender" name="gender">
                            <option class="form-control" value="male"
                                <?php if ($res['gender'] == 'male') echo 'selected'; ?>>male</option>
                            <option class="form-control" value="female"
                                <?php if ($res['gender'] == 'female') echo 'selected'; ?>>female</option>
                        </select>
                        <label for="exampleFormControlcity" class="form-label">city</label><br>
                        <input type="text" style="height:30px" value="<?php echo $res['city']; ?>"
                            class="form-control" name="city" id="exampleInputcity">

                        <label class="form-label" for="form3Example3cg">Country</label>
                        <select name="country" class="form-control form-control-lg" id="country">
                            <option value="">--Select--</option>
                            <?php
                            $countryQuery = mysqli_query($conn, "SELECT id, country_name FROM apps_countries");
                            while ($countryRow = mysqli_fetch_array($countryQuery)) {
                                if($countryRow['id'] == $res['country'])
                                {
                                ?>
                                 <option value="<?php echo $countryRow['id'];?>" selected><?php echo $countryRow['country_name'];?></option>
                                 <?php                                 
                                }
                                else{
                                ?>
                                    <option value="<?php echo $countryRow['id'];?>"><?php echo $countryRow['country_name'];?></option>
                                <?php
                                }                              
                            }
                            ?>
                        </select>

                        <label for="exampleFormControlrole" class="form-label">Role</label>
                        <select class="form-control" id="exampleFormControlrole" name="role_as" required>                          
                        <option class="form-control" value=""
                                <?php if ($res['role_as'] == 'admin') echo 'selected'; ?>>admin</option>
                            <option class="form-control" value=""
                                <?php if ($res['role_as'] == 'user') echo 'selected'; ?>>user</option>
                     </select>
                        <label for="exampleInputuseraddress" class="form-label">address</label><br>
                        <textarea style="height:30px" class="form-control" value="<?php echo $res['address']; ?>"
                            name="address"></textarea>
                        <label for="exampleInputimage" class="form-label">image</label><br>
                        <input type="file" style="height:42px" class="form-control" name="dobphoto">
                        <?php if (!empty($res['image'])): ?>
                            <img src="images/<?php echo $res['image']; ?>" width="75px" height="75px"
                                alt="Current Image">
                        <?php endif; ?>
                        <button type="submit" style="height:35px; margin:20px; margin-left:270px "
                            class="btn btn-primary" name="done">update</button>
                    </div>
                </div>
        </form>
        <?php } 
        else
        {
            echo "No record found!";
        }
        ?>
    </div>


</body>

</html>
