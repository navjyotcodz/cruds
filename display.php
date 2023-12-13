
    <?php
    session_start();
    if (!isset($_SESSION['user_name'])) {
      header('location: login.php');
      exit();
    }
    echo "Welcome " . $_SESSION['user_name'];
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
    
    .welcome {
      font-size:20px;
      text-align:center;
     
    } 
  </style>
</head>
<body>
  
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display crud</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8"
    src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

</head>

<body>
  <div class="container-fluid">
    <div class="col-lg-12">
      <br><br>
      <h3 class="text-dark text-center"> Display Employee Data </h3>

      <table class="table table-striped table-hover table-bordered">
        <tr class="text-center bg-light" style="height:20px">

          <th>Sno</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Password</th>
          <th>Email</th>
          <th>DOB</th>
          <th>Gender</th>
          <th>City</th>
          <th>Country </th>
          <th>Image</th>
          <th>Address</th>
          <th>Role</th>
          <th >status</th>
          <!-- <th >Delete</th> -->
          <th >Update</th>
        </tr> 
  <?php

      include 'conn.php';
      $i=0;
      $userprofile= $_SESSION['user_name'];
      if($userprofile==true){
        
      }else{
        header('location:login.php');
      }

      $q = "SELECT  c.*, ct.country_name
      FROM crudtables c
      LEFT JOIN apps_countries ct ON c.country = ct.id
      WHERE c.email='$userprofile'";
      $q = "SELECT  * from crudtables WHERE email='$userprofile'";
      $query = mysqli_query($conn,$q);
      
      while($res =mysqli_fetch_array($query)){
      $i+=1;
        
    
  ?>
        <tr class="text-center">
          <td>
            <?php echo $res['id']; ?>
          </td>
          <td>
            <?php echo $res['firstname'];  ?>
          </td>
          <td>
            <?php echo $res['lastname'];  ?>
          </td>
          <td>
            <?php echo str_repeat("•", strlen($res['password'])); ?>
          </td>
          <td>
            <?php echo $res['email'];  ?>
          </td>
          <td>
            <?php echo $res['dob'];  ?>
          </td>
          <td>
            <?php echo $res['gender'];  ?>
          </td>
          <td>
            <?php if ($res['city'] == "" ){
              echo "N/A";
              }else {echo $res['city'];}?>
          </td>
          
          <td>
          <?php if ($res['country'] == "" ){
              echo "N/A";
              }else {echo $res['country_name'];}?>
              
          </td>
          <td style="width:20px" >
          <img src="images/<?php echo $res['image'];?>"style="height:50px;width:50px"/>
        </td>
          
          <td>
            <?php echo $res['address'];  ?>
          </td>
          <td><?php
          if($res['role_as']=="0")
          {
            echo "user";
          }elseif($res['role_as']=="1"){
            echo "admin";
          }else{
            echo "invalid user";
          }?>
          </td>
         
          <!-- <button class="btn-success ">  -->
          
      <td> 
        <?php if($res['status']==1){
          echo '<p><a href="status.php?id='.$res['id'].'&status=0" class="btn btn-success">Enable</a></p>';

        }else{
          echo '<p><a href="status.php?id='.$res['id'].'&status=1" class="btn btn-danger">Disable</a></p>';

          }?>
      </td>
     

      
    <td> 
    <?php if ($_SESSION["user_name"]== $res['email']){?> 
      <a <?php if ($_SESSION["user_name"]== $res['email']){?> style ="color:black" <?php }?> 
      href ="update.php?id=<?php echo $res['id']?>&action=update" class='btn btn-warning ';>update  
      
      </a>
       <?php }?>
      </td>

        </tr>


        <?php 
      }
      ?>


      </table>
      
    <a href="changepassword.php"><input type ="cpassword" name="cpassword" value="changepasword" style="background:blue; color:white;width:130px;height:35px;margin-top:20px;text-align:center; font-size:15px;border:0;border-radius:5px; cursor:pointer;"></a>
 
    <a href="login.php"><input type ="submit" name="" value="logout" style="background:green; color:white;width:100px;height:35px;margin-top:20px; font-size:18px;border:0;border-radius:5px; cursor:pointer;"></a>
    
    </div>
  
  </div>



  

  <!-- <script>
  function confirmDelete(id) {
    if (confirm("Are you sure you want to delete?")) {
      window.location.href = "delete.php?id=" + id;
    }
  }
</script> -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
    crossorigin="anonymous"></script>
</body>

</html>