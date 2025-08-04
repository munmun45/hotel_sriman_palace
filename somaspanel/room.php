<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$room_id = '';
$room_name = '';
$room_description = '';
$max_capacity = '';
$max_extra_adults = '';
$extra_adult_price = '';
$total_room = '';
$video_url = '';
$room_price = '';
$image_1 = '';
$image_2 = '';
$image_3 = '';
$image_4 = '';
$image_5 = '';
$facilities = []; // For storing the facilities

$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch room details
    $sql = "SELECT * FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If room found, assign values to variables
    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();

        // Assign values to form variables
        $room_name = $room['name'];
        $room_description = $room['description'];
        $max_capacity = $room['max_capacity'];
        $max_extra_adults = $room['max_extra_adults'];
        $extra_adult_price = $room['extra_adult_price'];
        $total_room = $room['total_room'];
        $video_url = $room['video_url'];
        $room_price = $room['price'];


        $food_plan_cp_price = $room['food_plan_cp'];
        $food_plan_map_price = $room['food_plan_map'];
        $food_plan_ap_price = $room['food_plan_ap'];


        $image_1 = $room['image_1'];
        $image_2 = $room['image_2'];
        $image_3 = $room['image_3'];
        $image_4 = $room['image_4'];
        $image_5 = $room['image_5'];
        $facilities = explode(',', $room['facilities']); // Assuming facilities are stored as comma-separated values in the DB

        // Change message and button text for editing
        $message = "Update";
        $button = "Update";
    } else {
        // Handle the case where no room is found
        echo "Room not found.";
        exit;
    }
}

// Fetch facilities from the database
$facility_sql = "SELECT * FROM facilities"; // Assuming you have a 'facilities' table
$facility_result = $conn->query($facility_sql);
$facility_options = [];
if ($facility_result->num_rows > 0) {
    while ($facility = $facility_result->fetch_assoc()) {
        $facility_options[] = $facility;
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
            <h1>Rooms</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Rooms</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Room List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                                    <i class="bi bi-plus-circle"></i> Add Room
                                </button>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Max Capacity</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM rooms";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($room = $result->fetch_assoc()) {
                                            // Prepare image path
                                            $image_path = "./uploads/" . $room['image_1']; // Assuming image_1 is stored in the database
                                            // Check if the image exists
                                            $image_exists = file_exists($image_path) ? $image_path : './uploads/default.jpg'; // Default image if not found

                                            $description = strlen($room['description']) > 100 ? substr($room['description'], 0, 50) . '...' : $room['description'];

                                            // Display row
                                            echo "<tr>";
                                            echo "<td>" . $room['name'] . "</td>";
                                            echo "<td>" . $description . "</td>";
                                            echo "<td><img src='" . $image_exists . "' alt='" . $room['name'] . "' style='width: 50px; height: 50px; object-fit: cover;'></td>";
                                            echo "<td>" . $room['price'] . "</td>";
                                            echo "<td>" . $room['max_capacity'] . "</td>";
                                            echo "<td class='text-center'>
                                                <a href='?id=" . $room['id'] . "' class='btn btn-sm btn-warning me-1'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>
                                                <a href='./process/delete.php?id=" . $room['id'] . "&table_name=rooms' class='btn btn-sm btn-danger delete-btn' >
                                                    <i class='bi bi-trash-fill'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No rooms found</td></tr>";
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

        <!-- Modal for Adding/Editing Room -->
        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"> <!-- Increased modal size -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/room.php" method="post" id="addRoomForm" enctype="multipart/form-data">
                            <!-- Hidden input for room ID (for update) -->
                            <input type="hidden" name="id" value="<?= $room_id ?>">

                            <div class="row">
                                <!-- Room Name and Description in Two Columns -->
                                <div class="col-md-6 mb-3">
                                    <label for="roomName" class="form-label">Room Name</label>
                                    <input type="text" name="name" class="form-control" id="roomName" placeholder="Enter room name" value="<?= $room_name ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="roomPrice" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" id="roomPrice" placeholder="Enter room price" value="<?= $room_price ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Room Description and Images in Two Columns -->
                                <div class="col-md-12 mb-3">
                                    <label for="roomDescription" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="roomDescription" placeholder="Enter room description" required><?= $room_description ?></textarea>
                                </div>
                            </div>

                            <!-- Food Plans Section -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h5 class="form-label"> <b>Food Plans</b> </h5>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="food_plan_cp" class="form-label">Price for CP</label>
                                            <input type="number" name="food_plan_cp" id="food_plan_cp" class="form-control" value="<?= $food_plan_cp_price ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="food_plan_map" class="form-label">Price for MAP</label>
                                            <input type="number" name="food_plan_map" id="food_plan_map" class="form-control" value="<?= $food_plan_map_price ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="food_plan_ap" class="form-label">Price for AP</label>
                                            <input type="number" name="food_plan_ap" id="food_plan_ap" class="form-control" value="<?= $food_plan_ap_price ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Max Capacity, Total Rooms, Video URL, and Extra Adult Fields -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="maxCapacity" class="form-label">Max Capacity</label>
                                    <input type="number" name="max_capacity" class="form-control" id="maxCapacity" placeholder="Enter Max Capacity" value="<?= $max_capacity ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="totalRoom" class="form-label">Total Number of Rooms</label>
                                    <input type="number" name="total_room" class="form-control" id="totalRoom" placeholder="Enter total number of rooms" value="<?= $total_room ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="maxExtraAdults" class="form-label">Max Extra Adults</label>
                                    <input type="number" name="max_extra_adults" class="form-control" id="maxExtraAdults" value="<?= $max_extra_adults ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="extraAdultPrice" class="form-label">Extra Adult Price</label>
                                    <input type="number" name="extra_adult_price" class="form-control" id="extraAdultPrice" value="<?= $extra_adult_price ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="videoUrl" class="form-label">Video URL</label>
                                    <input type="text" name="video_url" class="form-control" id="videoUrl" placeholder="Enter video URL" value="<?= $video_url ?>">
                                </div>
                            </div>



                            <!-- Select Facilities with Checkboxes -->
                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h5 class="form-label"> <b>Select Facilities</b> </h5>

                                    <div class="row" style="    margin-left: 10px;">
                                        <?php foreach ($facility_options as $facility): ?>
                                            <div class="form-check col-md-3">
                                                <input type="checkbox" name="facilities[]" value="<?= $facility['id'] ?>" class="form-check-input" id="facility_<?= $facility['id'] ?>" <?= in_array($facility['id'], $facilities) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="facility_<?= $facility['id'] ?>">
                                                    <?= $facility['name'] ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>





                            <!-- Images Inputs -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="image_1" class="form-label">Image 1</label>
                                    <input type="file" name="image_1" class="form-control" id="image_1" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_2" class="form-label">Image 2</label>
                                    <input type="file" name="image_2" class="form-control" id="image_2" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_3" class="form-label">Image 3</label>
                                    <input type="file" name="image_3" class="form-control" id="image_3" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_4" class="form-label">Image 4</label>
                                    <input type="file" name="image_4" class="form-control" id="image_4" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_5" class="form-label">Image 5</label>
                                    <input type="file" name="image_5" class="form-control" id="image_5" accept="image/*">
                                </div>
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
                                window.location.href = './room'; // Redirect back to the services list
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
            var myModal = new bootstrap.Modal(document.getElementById('addRoomModal'));
            myModal.show();
        }
    </script>

</body>

</html>