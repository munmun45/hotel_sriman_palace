<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$menu_id = '';
$image = '';
$dish_name = '';
$category_id = '';
$description = '';

// Default message and button text
$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch menu item details
    $sql = "SELECT * FROM menu WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If menu found, assign values to variables
    if ($result->num_rows > 0) {
        $menu = $result->fetch_assoc();

        // Assign values to form variables
        $image = $menu['image'];
        $dish_name = $menu['dish_name'];
        $category_id = $menu['category_id'];
        $description = $menu['description'];

        // Change message and button text for editing
        $message = "Update";
        $button = "Update";
    } else {
        // Handle the case where no menu item is found
        echo "Menu item not found.";
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
            <h1>Menu</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Menu</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Menu List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                                    <i class="bi bi-plus-circle"></i> Add Menu Item
                                </button>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered table-hover align-middle ">
                                <thead class="table ">
                                    <tr>
                                        <th>Dish Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT m.*, c.name FROM menu m JOIN food_categories c ON m.category_id = c.id";
                                    $result = $conn->query($sql);

                                    if (!$result) {
                                        // Check if the query failed
                                        echo "Error executing query: " . $conn->error; // Output the error message for debugging
                                        exit;
                                    }

                                    if ($result->num_rows > 0) {
                                        while ($menu = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $menu['dish_name'] . "</td>";
                                            echo "<td>" . $menu['price'] . "</td>";
                                            echo "<td>" . $menu['name'] . "</td>"; // Display category name, not category_id
                                            echo "<td class='text-center'>
                                                <a href='?id=" . $menu['id'] . "' class='btn btn-sm btn-warning me-1'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>
                                                <a href='./process/delete.php?id=" . $menu['id'] . "&table_name=menu' class='btn btn-sm btn-danger delete-btn' >
                                                    <i class='bi bi-trash-fill'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>No menu items found</td></tr>";
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

        <!-- Modal for Add/Edit Menu -->
        <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMenuModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Menu Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/menu.php" method="post" id="addMenuForm" enctype="multipart/form-data">
                            <!-- Hidden input for menu ID (for update) -->
                            <input type="hidden" name="id" value="<?= $menu_id ?>">

                            <div class="mb-3">
                                <label for="dishName" class="form-label">Dish Name</label>
                                <input type="text" name="dish_name" class="form-control" id="dishName" placeholder="Enter dish name" value="<?= $dish_name ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" class="form-control" id="category" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    // Fetch categories from the database
                                    $categorySql = "SELECT * FROM food_categories";
                                    $categoryResult = $conn->query($categorySql);
                                    while ($category = $categoryResult->fetch_assoc()) {
                                        $selected = ($category['id'] == $category_id) ? 'selected' : '';
                                        echo "<option value='" . $category['id'] . "' $selected>" . $category['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="price" placeholder="Enter price" value="<?= $price ?>" step="0.01" required>
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
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();

                var link = $(this).attr('href');
                var confirmDelete = confirm("Are you sure you want to delete this menu item?");

                if (confirmDelete) {
                    $.ajax({
                        type: 'GET',
                        url: link,
                        success: function(response) {
                            if (response === 'success') {
                                alert("Menu item deleted successfully!");
                                window.location.href = './menu'; // Redirect to the menu page
                            } else {
                                alert("Error deleting menu item.");
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
            var myModal = new bootstrap.Modal(document.getElementById('addMenuModal'));
            myModal.show();
        }
    </script>

</body>

</html>