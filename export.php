<?php
include "db_conn.php";


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
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5 position-relative" style="background-color: #00ff5573;">
   Create New User
   </nav>
  <div class="container w-60">
   <form action="" method="GET">
  <div class="d-flex justify-content-between ">
   <div>
    <input  type="text" name="search"  value="<?php if(isset ($_GET['search'])) {echo $_GET['search'];}?>" class="form mb-3"  placeholder="Search field......">
    <button type="" class="btn btn-dark ">Search</button>
    <button class="btn btn-dark ">Export</button>
    <a href="logs.php" class="btn btn-dark ">Back</a>
   </div>
         </div>
        </form>
      
        
    <table class="table table-hover text-center ">
      <thead class="table-dark ">
        <tr>
          <th scope="col">Date/Time</th>
          <th scope="col">Client</th>
          <th scope="col">Fault Description</th>
          <th scope="col">Action Taken</th>
          <th scope="col">Location</th>
          <th scope="col">Owner</th> <!-- achiever -->
          <th scope="col">IncidentType</th>
        </tr>
      </thead>
      <tbody> </div>
      <?php
    $conn = mysqli_connect("localhost","root","", "php-crud");

    if(isset($_GET['search']))
    {
      $filtervalues = $_GET['search'];
      $query = "SELECT * FROM crud WHERE CONCAT(date_created, client, fault_description, action_taken, location, achiever, incident_type) LIKE '%$filtervalues%' ";
      $query_run = mysqli_query($conn, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
           foreach($query_run as $items)
           {
            ?>
             <tr>
        
          <td><?= $items['date_created']; ?></td>
          <td><?= $items['client']; ?></td>
          <td><?= $items['fault_description']; ?></td>
          <td><?= $items['action_taken']; ?></td>
          <td><?= $items['location']; ?></td>
          <td><?= $items['achiever']; ?></td>
          <td><?= $items['incident_type']; ?></td>
          
         </tr>
            <?php
           }
      }
      else
      {
        ?>
         <tr>
          <td colspan="7">No Record found</td>
         </tr>
        <?php
      }
    }
  
    ?>
      </tbody>
      <div>
        
        <script>
          function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv(html, filename) {
	var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

document.querySelector("button").addEventListener("click", function () {
    var html = document.querySelector("table").outerHTML;
	export_table_to_csv(html, "table.csv");
});

        </script>
      </div>
  </table>
</div>     
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
 
</body>

</html>