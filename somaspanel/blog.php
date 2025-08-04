<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$blog_id = '';
$blog_image = '';
$blog_title = '';
$blog_description = '';
$today_date = date('Y-m-d'); // Get today's date

$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch blog details
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If blog found, assign values to variables
    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();

        // Assign values to form variables
        $blog_image = $blog['image'];
        $blog_title = $blog['title'];
        $blog_description = $blog['description'];
        $today_date = $blog['date']; // Set the saved date for the blog

        // Change message and button text for editing
        $message = "Update";
        $button = "Update";
    } else {
        // Handle the case where no blog is found
        echo "Blog not found.";
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
            <h1>Blogs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Blog List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                                    <i class="bi bi-plus-circle"></i> Add Blog
                                </button>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $sql = "SELECT * FROM blogs";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {

                                        while ($blog = $result->fetch_assoc()) {

                                            $description = strlen($blog['description']) > 100 ? substr($blog['description'], 0, 50) . '...' : $blog['description'];

                                            echo "<tr>";
                                            echo "<td><img src='./uploads/" . $blog['image'] . "' alt='Blog Image' width='50' height='50'></td>";
                                            echo "<td>" . $blog['title'] . "</td>";
                                            echo "<td>" . $description . "</td>";
                                            echo "<td class='text-center'>
                                                <a href='?id=" . $blog['id'] . "' class='btn btn-sm btn-warning me-1'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>
                                                <a href='./process/delete.php?id=" . $blog['id'] . "&table_name=blogs' class='btn btn-sm btn-danger delete-btn' >
                                                    <i class='bi bi-trash-fill'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>No blogs found</td></tr>";
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

        <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBlogModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/blog" method="post" id="addBlogForm" enctype="multipart/form-data">
                            <!-- Hidden input for blog ID (for update) -->
                            <input type="hidden" name="id" value="<?= $blog_id ?>">

                            <div class="mb-3">
                                <label for="blogImage" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="blogImage" accept="image/*" >
                                
                            </div>
                            <div class="mb-3">
                                <label for="blogTitle" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="blogTitle" placeholder="Enter blog title" value="<?= $blog_title ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="blogDescription" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="blogDescription" rows="4" placeholder="Enter blog description" required><?= $blog_description ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="blogDate" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="blogDate" value="<?= $today_date ?>" required>
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
                                window.location.href = './blog'; // Redirect to the blog page
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
            var myModal = new bootstrap.Modal(document.getElementById('addBlogModal'));
            myModal.show();
        }
    </script>

</body>

</html>