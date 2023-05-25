<?php
session_start();
include "db_conn.php";
$user_id = $_SESSION["userId"];
$userRole = $_SESSION["userrole"];

if (isset($_POST["submit"])) {
   $client = $_POST['client'];
   $fault_description = $_POST['fault_description'];
   $action_taken = $_POST['action_taken'];
   $location = $_POST['location'];
   $achiever = $_POST['achiever'];
   $remarks = $_POST['remarks'];
   $incident_type = $_POST['incident_type'];
   $status = $_POST['status'];
   if (isset($_FILES['pp']['name'])) {
      echo 'error';
      $img_name = $_FILES['pp']['name'];
      $tmp_name = $_FILES['pp']['tmp_name'];
      $error = $_FILES['pp']['error'];
      
      if($error === 0){
         echo 'error';
         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
         $img_ex_to_lc = strtolower($img_ex);

         $allowed_exs = array('jpg', 'jpeg', 'png');
         if(in_array($img_ex_to_lc, $allowed_exs)){
            $new_img_name = uniqid($uname, true).'.'.$img_ex_to_lc;
            $img_upload_path = 'upload/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            // Insert into Database
            // $sql = "INSERT INTO users(fname, username, password, pp) 
            //   VALUES(?,?,?,?)";
            // $stmt = $conn->prepare($sql);
            // $stmt->execute([$fname, $uname, $pass, $new_img_name]);

            $sql = "INSERT INTO `crud`( `client`, `fault_description`, `action_taken`, `location`,`achiever`, `remarks`,`incident_type`, `status`, `userId`, image) VALUES ( '$client',  '$fault_description', '$action_taken', '$location','$achiever', '$remarks','$incident_type', '$status', '$user_id', '$new_img_name')";

            $result = mysqli_query($conn, $sql);
            
            if ($result) {
               header("Location:logs.php?msg=New record created successfully");
            } else {
               echo "Failed: ". mysqli_error($conn);
            }

            header("Location:add-new.php?success=Your account has been created successfully");
             exit;
         }else {
            $em = "You can't upload files of this type";
            header("Location: ../index.php?error=$em&$data");
            exit;
         }
      }else {
         $em = "unknown error occurred!";
         header("Location: ../index.php?error=$em&$data");
         exit;
      }
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

   <title>Vovida Incident/Log Form</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
   Vovida Incident/Log Form
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Report</h3>
         <p class="text-muted">Complete the form below to add a new report</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px; height:300px" enctype="multipart/form-data">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Fault Description:</label>
                  <input type="text" class="form-control" name="fault_description" placeholder="Albert">
               </div>

               <div class="col">
                  <label class="form-label">Action Taken:</label>
                  <input type="text" class="form-control" name="action_taken" placeholder="Einstein">
               </div>
            </div>

            <div class="col row mb-2">
                  <label class="form-label">Location:</label>
                  <input type="text" class="form-control" name="location" placeholder="Einstein">
               </div>
               <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Action Owner:</label><!-- achiever -->
                  <input type="text" class="form-control" name="achiever" placeholder="Albert">
               </div>
               <div class="col row mb-2">
                  <label class="form-label">Client:</label>
                  <input type="text" class="form-control" name="client" placeholder="Albert">
               </div>
               </div>
            </div>

            <div class="col  mx-auto">
                  <label class="form-label">Remarks:</label>
                  <input type="text" class="form-control" name="remarks" placeholder="Einstein">
               </div>
            </div>

            <div class="mb-3 w-50 mx-auto">
               <label class="form-label">Attachment</label>
               <input type="file" 
                     class="form-control"
                     name="pp">
		      </div>

            <div class="form-group mb-3 mt-3 d-flex w-100 justify-content-center">
               <label>Incident type:</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="incident_type" id="Hardware" value="Hardware">
               <label for="Hardware" class="form-input-label mx-1">Hardware</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="incident_type" id="Software" value="Software">
               <label for="Software" class="form-input-label mx-1">Software</label>
               <input type="radio" class="form-check-input mr-3" name="incident_type" id="Network" value="Network">
               <label for="Network" class="form-input-label mx-1">Network</label>
               <input type="radio" class="form-check-input mr-3" name="incident_type" id="Others" value="Others">
               <label for="Other" class="form-input-label mx-1">Others</label>
            </div>

            <div class="form-group mb-3 mt-3 d-flex w-100 justify-content-center">
               <label>Status:</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="status" id="open" value="open">
               <label for="open" class="form-input-label mx-1">Open</label>
               &nbsp;
               <input type="radio" class="form-check-input mr-3" name="status" id="closed" value="closed">
               <label for="closed" class="form-input-label mx-1">Closed</label>
              <!-- <input type="radio" class="form-check-input mr-3" name="status" id="transferred" value="transferred">
               <label for="transferred" class="form-input-label mx-1">Transferred</label>-->
            </div>

            <div class="d-flex w-100 justify-content-center">
               <button type="submit" class="btn btn-success" name="submit" >Add User</button>
               <a href="logs.php" class="btn btn-danger mx-1">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>