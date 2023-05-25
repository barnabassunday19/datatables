<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $client = $_POST['client'];
  $fault_description = $_POST['fault_description'];
  $action_taken = $_POST['action_taken'];
  $location = $_POST['location'];
  $achiever = $_POST['achiever'];
  $remarks = $_POST['remarks'];
  $incident_type = $_POST['incident_type'];
  $status = $_POST['status'];

  $sql = "UPDATE `crud` SET `client`='$client', `fault_description`='$fault_description',`action_taken`='$action_taken',`location`='$location', `achiever`='$achiever',`remarks`='$remarks', `incident_type`='$incident_type', `status`='$status' WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: logs.php?msg=Data updated successfully");
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

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `crud` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Fault Description:</label>
            <input type="text" class="form-control" name="fault_description" value="<?php echo $row['fault_description'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Action Taken:</label>
            <input type="text" class="form-control" name="action_taken" value="<?php echo $row['action_taken'] ?>">
          </div>
        </div>

        <div class="col">
            <label class="form-label">Location:</label>
            <input type="text" class="form-control" name="location" value="<?php echo $row['location'] ?>">
          </div>
        </div>
        <div class="row mb-3">
        <div class="col">
            <label class="form-label">Action Owner:</label><!-- achiever -->
            <input type="text" class="form-control" name="achiever" value="<?php echo $row['achiever'] ?>">
          </div>
          <div class="col">
            <label class="form-label">Client:</label>
            <input type="text" class="form-control" name="client" value="<?php echo $row['client'] ?>">
          </div>
        </div>
        <div class="col">
            <label class="form-label">Remarks:</label>
            <input type="text" class="form-control" name="remarks" value="<?php echo $row['remarks'] ?>">
          </div>
        </div>

        <div class="form-group mb-3 mt-3 d-flex w-100 justify-content-center">
          <label>IncidentType:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="incident_type" id="Hardware" value="Hardware" <?php echo ($row["incident_type"] == 'Hardware') ? "checked" : ""; ?>>
          <label for="Hardware" class="form-input-label">Hardware</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="incident_type" id="Software" value="Software" <?php echo ($row["incident_type"] == 'Software') ? "checked" : ""; ?>>
          <label for="Software" class="form-input-label">Software</label>
          <input type="radio" class="form-check-input" name="incident_type" id="Network" value="Network" <?php echo ($row["incident_type"] == 'Network') ? "checked" : ""; ?>>
          <label for="Network" class="form-input-label">Network</label>
          <input type="radio" class="form-check-input" name="incident_type" id="Others" value="Others" <?php echo ($row["incident_type"] == 'Others') ? "checked" : ""; ?>>
          <label for="Others" class="form-input-label">Others</label>
        </div>

        <div class="form-group mb-3 mt-3 d-flex w-100 justify-content-center">
          <label>Status:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="status" id="open" value="open" <?php echo ($row["status"] == 'open') ? "checked" : ""; ?>>
          <label for="open" class="form-input-label">Open</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="status" id="closed" value="closed" <?php echo ($row["status"] == 'closed') ? "checked" : ""; ?>>
          <label for="closed" class="form-input-label">Closed</label>
         <!-- <input type="radio" class="form-check-input" name="status" id="transferred" value="transferred" <?php echo ($row["status"] == 'transferred') ? "checked" : ""; ?>>
          <label for="transferred" class="form-input-label">Transferred</label>-->
        </div>

        <div class="d-flex w-100 justify-content-center">
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="logs.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>