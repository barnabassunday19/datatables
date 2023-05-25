<?php
session_start();
include "db_conn.php";
$userId = $_SESSION["userId"];
$userRole = $_SESSION["userrole"];

if(!isset($userId)){
 return header('Location:login.php');
 
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"  rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Vovida Incident/Log Form</title>
</head>

<body>
  <div>
     <nav class="navbar navbar-light justify-content-center fs-3 mb-5 position-relative" style="background-color: #00ff5573;">
    Vovida Incident/Log Form
    <div><a href="logout.php" class="position-absolute top-0 end-0">logout</a></div>
  </nav>
  
  
  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <div class="d-flex justify-content-between">
    <a href="add-new.php" class="btn btn-dark mb-3">Add New Report</a>
    <?php if($userRole === 'Admin'): ?>
      <div>
      <?php if($userRole === 'Admin'): ?>
      <a href="users.php" class="btn btn-dark mb-3">View users</a>
      <a href="new_user.php" class="btn btn-dark mb-3">Create new user</a>
      <a href="export.php" class="btn btn-dark mb-3">Export</a>
      <?php endif; ?>
      </div>
    <?php endif; ?>
    </div>
    
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
        <th scope="col">Image</th>
          <th scope="col">ID</th>
          <th scope="col">Date/Time</th>
          <th scope="col">Client</th>
          <th width="10%"scope="col">Fault Description</th>
          <th scope="col">Action Taken</th>
          <th scope="col">Location</th>
          <th scope="col">Action Owner</th><!--Achiever-->
          <th width="10%"scope="col">Remarks</th>
          <th scope="col">IncidentType</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        
        <?php
        $sql = '';
        if($userRole === 'User'){
          $sql = "SELECT * FROM `crud` where userId= '$userId'";
        }else{
          $sql = "SELECT * FROM `crud`";
        }
        $result = mysqli_query($conn, $sql);
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $i++;

          $currentTime = new DateTime();
          $start_datetime = new DateTime($row['date_created']);
          $diff = $currentTime->diff($start_datetime);

          $total_minutes = ($diff->days * 24 * 60); 
          $total_minutes += ($diff->h * 60); 
          $total_minutes += $diff->i;
        ?>
        
          <tr>
            <td><a href="./upload/<?php echo $row["image"];?>"> <img width="50" height="50" src="./upload/<?php echo $row["image"]; ?>" alt=""></a></td>
            <td><?php echo $i; ?></td>
            <td><?php echo $row["date_created"] ?></td>
            <td><?php echo $row["client"] ?></td>
            <td><?php echo $row["fault_description"] ?></td>
            <td><?php echo $row["action_taken"] ?></td>
            <td><?php echo $row["location"] ?></td>
            <td><?php echo $row["achiever"] ?></td>
            <td><?php echo $row["remarks"] ?></td>
            <td><?php echo $row["incident_type"] ?></td>
            <td><?php echo $row["status"] ?></td>
            <td>
              <?php if($total_minutes < 1440): ?>
              <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-4 mb-3"></i></a>
              <?php endif ?>

              <?php if($total_minutes < 1440): ?>
              <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5 me-4 mb-3"></i></a>
              <?php endif ?>
             <!-- <a href="upload.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-upload fs-5"></i></a>-->
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>