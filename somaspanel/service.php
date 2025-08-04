<?php
require("./config/config.php");

$service_id = '';
$service_title = '';
$service_description = '';
$service_image_1 = '';
$service_image_2 = '';
$faq_1 = '';
$faq_2 = '';
$faq_3 = '';
$faq_4 = '';
$faq_5 = '';

$message = "Add";
$button = "Submit";

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Fetch the service details from the database
    $sql = "SELECT * FROM services WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
        $service_title = $service['title'];
        $service_description = $service['description'];
        $service_image_1 = $service['image_1'];
        $service_image_2 = $service['image_2'];
        $faq_1 = $service['faq_1'];
        $faq_2 = $service['faq_2'];
        $faq_3 = $service['faq_3'];
        $faq_4 = $service['faq_4'];
        $faq_5 = $service['faq_5'];

        $message = "Update";
        $button = "Update";
    } else {
        echo "Service not found.";
        exit;
    }
}
?>

<!-- Main HTML structure -->
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
            <h1>Services</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Service</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Service List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                    <i class="bi bi-plus-circle"></i> Add Service
                                </button>
                            </div>

                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM services";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($service = $result->fetch_assoc()) {
                                            // Get the image filename, or set a default if no image exists
                                            $image_1 = $service['image_1'] ? './uploads/' . $service['image_1'] : 'path/to/default-image.jpg';
                                            $image_2 = $service['image_1'] ? './uploads/' . $service['image_2'] : 'path/to/default-image.jpg';
                                            // Truncate the description to one line (if necessary)
                                            $description = strlen($service['description']) > 100 ? substr($service['description'], 0, 50) . '...' : $service['description'];

                                            echo "<tr>";
                                            echo "<td><img src='$image_1' alt='Service Image' style='width: 50px; height: 50px; object-fit: cover;'> <img src='$image_2' alt='Service Image' style='width: 50px; height: 50px; object-fit: cover;'> </td>"; // Display image
                                            echo "<td>" . $service['title'] . "</td>"; // Display title
                                            echo "<td>" . $description . "</td>"; // Display truncated description
                                            echo "<td class='text-center'>
                    <a href='?id=" . $service['id'] . "' class='btn btn-sm btn-warning me-1'>
                        <i class='bi bi-pencil-fill'></i>
                    </a>
                    <a href='./process/delete.php?id=" . $service['id'] . "&table_name=services' class='btn btn-sm btn-danger delete-btn' >
                        <i class='bi bi-trash-fill'></i>
                    </a>
                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>No services found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal for adding or updating service -->
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Make the modal larger with 'modal-lg' -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/services" method="post" id="addServiceForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $service_id ?>">

                            <div class="row"> <!-- Start of row for the grid system -->

                                <!-- First column for Title and Description -->
                                <div class="col-md-6 mb-3">
                                    <label for="serviceTitle" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="serviceTitle" value="<?= $service_title ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="serviceDescription" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="serviceDescription" required><?= $service_description ?></textarea>
                                </div>

                                <!-- Second column for Image 1, Image 2, and FAQ Fields -->
                                <div class="col-md-6 mb-3">
                                    <label for="serviceImage1" class="form-label">Image 1</label>
                                    <input type="file" name="image_1" class="form-control" id="serviceImage1">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="serviceImage2" class="form-label">Image 2</label>
                                    <input type="file" name="image_2" class="form-control" id="serviceImage2">
                                </div>

                                <!-- FAQ 1 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_1" class="form-label">FAQ 1</label>
                                    <textarea name="faq_1" class="form-control" required><?= $faq_1 ?></textarea>
                                </div>

                                <!-- FAQ 2 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_2" class="form-label">FAQ 2</label>
                                    <textarea name="faq_2" class="form-control" required><?= $faq_2 ?></textarea>
                                </div>

                                <!-- FAQ 3 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_3" class="form-label">FAQ 3</label>
                                    <textarea name="faq_3" class="form-control" required><?= $faq_3 ?></textarea>
                                </div>

                                <!-- FAQ 4 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_4" class="form-label">FAQ 4</label>
                                    <textarea name="faq_4" class="form-control" required><?= $faq_4 ?></textarea>
                                </div>

                                <!-- FAQ 5 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_5" class="form-label">FAQ 5</label>
                                    <textarea name="faq_5" class="form-control" required><?= $faq_5 ?></textarea>
                                </div>

                            </div> <!-- End of row for the grid system -->

                            <button type="submit" class="btn btn-success w-100"><?= isset($_GET['id']) ? 'Update' : 'Submit' ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <?= require("./config/footer.php") ?>


    <script>
        // Delete confirmation using AJAX
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                var link = $(this).attr('href');
                var confirmDelete = confirm("Are you sure you want to delete this record?");
                if (confirmDelete) {
                    $.ajax({
                        type: 'GET',
                        url: link,
                        success: function(response) {
                            if (response === 'success') {
                                alert("Record deleted successfully!");
                                window.location.href = './service'; // Redirect back to the services list
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

        // Automatically show the modal if editing a service
        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = urlParams.get('id');
        if (serviceId) {
            var myModal = new bootstrap.Modal(document.getElementById('addServiceModal'));
            myModal.show();
        }
    </script>

</body>

</html>