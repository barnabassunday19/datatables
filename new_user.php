<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   
  
   $username = $_POST['username'];
   $d_password = $_POST['d_password'];
   $userrole = $_POST['role'];


   $sql = "INSERT INTO `user`(`username`, `d_Password`, `role`) VALUES ( '$username', '$d_password', '$userrole')";

   $result = mysqli_query($conn, $sql);
   
   if ($result) {
      header("Location: logs.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Create New User</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
   Create New User
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new User</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control"  id="logName" name="username" placeholder="Username" required>
               </div>

               <div class="col">
                  <label class="form-label">Password</label>
                  <input type="text" class="form-control" name="d_password" id="logPassword" placeholder="Password">
               </div>
            </div>

            <div class="form-group mb-3 mt-3 d-flex w-100 justify-content-center">
               <label>Role:</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="role" id="User" value="User">
               <label for="User" class="form-input-label mx-1">User</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="role" id="Admin" value="Admin">
               <label for="Admin" class="form-input-label mx-1">Admin</label>
            </div>

           <!-- <div class="col">
                  <label class="form-label">Remarks:</label>
                  <input type="text" class="form-control" name="remarks" placeholder="Einstein">
               </div>
            </div>-->
<!--
            <div class="form-group mb-3 mt-3 d-flex w-100 justify-content-center">
               <label>Incident type:</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="incident_type" id="User" value="User">
               <label for="User" class="form-input-label mx-1">User</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="incident_type" id="Admin" value="Admin">
               <label for="Admin" class="form-input-label mx-1">Admin</label>
            </div>
-->
            <div class=" mb-3 mt-3 d-flex w-100 justify-content-center">
               <button type="submit" class="btn btn-success" name="submit" >Save</button>
               <a href="logs.php" class="btn btn-danger mx-1">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>