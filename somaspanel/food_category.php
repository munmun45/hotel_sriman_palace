<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$food_category_id = '';
$food_category_name = '';

$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $food_category_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch food category details
    $sql = "SELECT * FROM food_categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $food_category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If food category found, assign values to variables
    if ($result->num_rows > 0) {
        $food_category = $result->fetch_assoc();

        // Assign values to form variables
        $food_category_name = $food_category['name'];

        // Change message and button text for editing
        $message = "Update";
        $button = "Update";
    } else {
        // Handle the case where no food category is found
        echo "Food Category not found.";
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
            <h1>Food Categories</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Food Category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Food Category List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFoodCategoryModal">
                                    <i class="bi bi-plus-circle"></i> Add Food Category
                                </button>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT * FROM food_categories";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($food_category = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td><img src='./uploads/" . $food_category['image'] . "' alt='" . $food_category['name'] . "' style='width: 50px; height: 50px; object-fit: cover;'></td>";
                                            echo "<td>" . $food_category['name'] . "</td>";
                                            echo "<td class='text-center'>
                                                <a href='?id=" . $food_category['id'] . "' class='btn btn-sm btn-warning me-1'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>
                                                <a href='./process/delete.php?id=" . $food_category['id'] . "&table_name=food_categories' class='btn btn-sm btn-danger delete-btn' >
                                                    <i class='bi bi-trash-fill'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='2' class='text-center'>No food categories found</td></tr>";
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

        <div class="modal fade" id="addFoodCategoryModal" tabindex="-1" aria-labelledby="addFoodCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFoodCategoryModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Food Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/food_category" method="post" id="addFoodCategoryForm" enctype="multipart/form-data" >
                            <!-- Hidden input for food category ID (for update) -->
                            <input type="hidden" name="id" value="<?= $food_category_id ?>">

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="image" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="foodCategoryName" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="foodCategoryName" placeholder="Enter food category name" value="<?= $food_category_name ?>" required>
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
                                window.location.href = './food_category'; // Redirect to the food category page or any other page you prefer
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
        const foodCategoryId = urlParams.get('id');
        if (foodCategoryId) {
            // Open the modal automatically if the ID exists in the URL
            var myModal = new bootstrap.Modal(document.getElementById('addFoodCategoryModal'));
            myModal.show();
        }
    </script>

</body>

</html>