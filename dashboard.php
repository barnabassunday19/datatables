
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

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Vovida Incident/Log Form</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,500" rel="stylesheet"/>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5 position-relative" style="background-color: #00ff5573;">
    Vovida Incident/Log Form<a href="logout.php">logout</a>
    
  </nav>
</div>
<div class="row">
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
  <button class="mb-3"> <a href="add-new.php" class="btn">Add New Report</a></button> 
    <?php if($userRole === 'Admin'): ?>
      <div>
      <?php if($userRole === 'Admin'): ?>
      <button><a href="users.php" class="btn">View users</a></button>
      <button><a href="new_user.php" class="btn">Create new user</a></button>
      <button><a href="export.php"  type="button" class="btn btn-succes">Export</a></button>
      <?php endif; ?>
      </div>
    <?php endif; ?>
    </div>
  <table class="table responsive" id="sort">
	<thead>
    <tr>
    <th class="filterhead"> Image</th>
    <th class="filterhead"> ID</th>
      <th class="filterhead"> Date/Time</th>
      <th class="filterhead"> Client</th>
      <th class="filterhead"> Fault Description</th>
       <th class="filterhead"> Action Taken</th>
      <th class="filterhead"> Location</th>
      <th class="filterhead"> Action Owner</th>
      <th class="filterhead"> Remarks</th>
      <th class="filterhead"> IncidentType</th>
      <th class="filterhead"> Status</th>
      <th class="filterhead"> Action</th>
    </tr>
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
              <a href="edit.php?id=<?php echo $row["id"] ?>" <span class="bi bi-pencil-square mb-3" style="font-size: 2rem; color:green"></span></a>
              <?php endif ?>

              <?php if($total_minutes < 1440): ?>
              <a href="delete.php?id=<?php echo $row["id"] ?>"<span class="bi bi-trash2 red-color" style="font-size: 2rem; color:red" ></span></a>
              <?php endif ?>
              <a href="upload.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-upload"></i></a> 
            </td>
          </tr>
        <?php
        }
        ?>
		
        
	</tbody>
</table>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.0/moment.min.js'></script>
<script  src="dashboard.js"></script>

</body>
</html>