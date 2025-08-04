<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$facility_id = '';
$facility_icon = '';
$facility_name = '';

$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
  $facility_id = $_GET['id'];

  // Prepare and execute the SQL query to fetch facility details
  $sql = "SELECT * FROM facilities WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $facility_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // If facility found, assign values to variables
  if ($result->num_rows > 0) {
    $facility = $result->fetch_assoc();

    // Assign values to form variables
    $facility_icon = $facility['icon'];
    $facility_name = $facility['name'];

    // Change message and button text for editing
    $message = "Update";
    $button = "Update";
  } else {
    // Handle the case where no facility is found
    echo "Facility not found.";
    exit;
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <?= require("./config/meta.php") ?>
</head>

<body>

  <?= require("./config/header.php") ?>
  <?= require("./config/menu.php") ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Facilities</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index">Home</a></li>
          <li class="breadcrumb-item active">Facility</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Facility List</h5>



                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFacilityModal">
                  <i class="bi bi-plus-circle"></i> Add Facility
                </button>
              </div>

              <!-- Table with stripped rows -->
              <table class="table table-bordered table-hover align-middle">
                <thead class="table">
                  <tr>
                    <th> <a href="https://icons.getbootstrap.com/" target="_blank">Icon (find icon to click me)</a></th>
                    <th>Icon Class Name</th>
                    <th>Title</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>




                  <?php

                  $sql = "SELECT * FROM facilities";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {

                    while ($facility = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td> <i class='" . $facility['icon'] . "'></i></td>";
                      echo "<td>" . $facility['icon'] . "</td>";
                      echo "<td>" . $facility['name'] . "</td>";
                      echo "<td class='text-center'>
                          <a href='?id=" . $facility['id'] . "' class='btn btn-sm btn-warning me-1'>
                              <i class='bi bi-pencil-fill'></i>
                          </a>
                          <a href='./process/delete.php?id=" . $facility['id'] . "&table_name=facilities' class='btn btn-sm btn-danger delete-btn'>
                              <i class='bi bi-trash-fill'></i>
                          </a>
                      </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='4' class='text-center'>No facilities found</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="addFacilityModal" tabindex="-1" aria-labelledby="addFacilityModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addFacilityModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Facility</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="./process/facility" method="post" id="addFacilityForm">
              <!-- Hidden input for facility ID (for update) -->
              <input type="hidden" name="id" value="<?= $facility_id ?>">

              <div class="mb-3">
                <label for="facilityIcon" class="form-label">Icon</label>
                <input type="text" name="icon" class="form-control" id="facilityIcon" placeholder="Enter icon class name" value="<?= $facility_icon ?>" required>
              </div>
              <div class="mb-3">
                <label for="facilityName" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="facilityName" placeholder="Enter facility name" value="<?= $facility_name ?>" required>
              </div>
              <button type="submit" class="btn btn-success w-100"><?= isset($_GET['id']) ? 'Update' : 'Submit' ?></button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </main><!-- End #main -->

  <?= require("./config/footer.php") ?>


  <script>
    $(document).ready(function() {
      // Attach a click event to the delete button
      $('.delete-btn').on('click', function(e) {
        // Prevent the default anchor action (i.e., redirect)
        e.preventDefault();

        // Get the link (URL) for deletion
        var link = $(this).attr('href');

        // Show a confirmation dialog
        var confirmDelete = confirm("Are you sure you want to delete this record?");

        // If the user confirms, proceed with deletion
        if (confirmDelete) {
          // Use AJAX to send the delete request
          $.ajax({
            type: 'GET',
            url: link, // The link includes the necessary parameters like ID, table_name, etc.
            success: function(response) {
              // If deletion is successful, redirect to the specified link (e.g., branch_manager)
              if (response === 'success') {
                alert("Record deleted successfully!");
                window.location.href = './facility'; // Redirect to the branch manager page or any other page you prefer
              } else {
                alert("Error deleting record.");
              }
            },
            error: function(xhr, status, error) {
              alert("Error: " + error);
            }
          });
        }
      });
    });
  </script>


  <script>
    // Check if there is an 'id' in the URL, and show the modal if true
    const urlParams = new URLSearchParams(window.location.search);
    const facilityId = urlParams.get('id');
    if (facilityId) {
      // Open the modal automatically if the ID exists in the URL
      var myModal = new bootstrap.Modal(document.getElementById('addFacilityModal'));
      myModal.show();
    }
  </script>

</body>

</html>