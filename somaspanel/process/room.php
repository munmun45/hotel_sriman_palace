<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require("../config/config.php");

// Function to handle image upload and return the unique image name
function upload_image($file_input_name)
{
    $image = null;

    if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
        $file_extension = strtolower(pathinfo($_FILES[$file_input_name]['name'], PATHINFO_EXTENSION));

        // Allowed image formats
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Check if the uploaded file's extension is in the allowed list
        if (in_array($file_extension, $allowed_extensions)) {
            $image = uniqid() . '.' . $file_extension; // Generate a unique name for the image
            $upload_path = '../uploads/' . $image;

            // Check if uploads directory exists, create if not
            if (!is_dir('../uploads/')) {
                mkdir('../uploads/', 0755, true);
            }

            // Move the file to the uploads directory
            if (move_uploaded_file($_FILES[$file_input_name]['tmp_name'], $upload_path)) {
                return $image; // Return the unique image name
            } else {
                echo "<script>alert('Error uploading the file.'); window.location.href = '../service';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid image format. Allowed formats are JPG, JPEG, PNG, GIF, WEBP.'); window.location.href = '../service';</script>";
            exit();
        }
    }

    return $image; // Return null if no file is uploaded
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and sanitize form data
    $room_id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $room_name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $room_description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $room_price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $video_url = isset($_POST['video_url']) ? trim($_POST['video_url']) : '';
    $max_capacity = isset($_POST['max_capacity']) ? intval($_POST['max_capacity']) : 0;
    $total_room = isset($_POST['total_room']) ? intval($_POST['total_room']) : 0;
    $max_extra_adults = isset($_POST['max_extra_adults']) ? intval($_POST['max_extra_adults']) : 0;
    $extra_adult_price = isset($_POST['extra_adult_price']) ? floatval($_POST['extra_adult_price']) : 0;

    // New fields for food plans
    $food_plan_cp = isset($_POST['food_plan_cp']) && $_POST['food_plan_cp'] !== '' ? floatval($_POST['food_plan_cp']) : null;
    $food_plan_map = isset($_POST['food_plan_map']) && $_POST['food_plan_map'] !== '' ? floatval($_POST['food_plan_map']) : null;
    $food_plan_ap = isset($_POST['food_plan_ap']) && $_POST['food_plan_ap'] !== '' ? floatval($_POST['food_plan_ap']) : null;

    // Validate required fields
    if (empty($room_name)) {
        echo "<script>alert('Room name is required'); window.location.href = '../room';</script>";
        exit();
    }

    // Additional validation for URL if provided
    if (!empty($video_url) && !filter_var($video_url, FILTER_VALIDATE_URL)) {
        echo "<script>alert('Invalid video URL format'); window.location.href = '../room';</script>";
        exit();
    }

    // Collect facilities
    $facilities = isset($_POST['facilities']) ? $_POST['facilities'] : [];
    $facilities_str = is_array($facilities) ? implode(',', $facilities) : '';

    // Image upload handling for each image field
    $image_fields = ['image_1', 'image_2', 'image_3', 'image_4', 'image_5'];
    $image_names = [];

    // Loop through each image field and handle image upload
    foreach ($image_fields as $image_field) {
        $image_names[$image_field] = upload_image($image_field); // Handle upload for each image
    }

    try {
        // Initialize the SQL query
        if ($room_id) {
            // If we're updating, start with the base SQL query
            $sql = "UPDATE rooms SET name = ?, description = ?, price = ?, video_url = ?, facilities = ?, max_capacity = ?, total_room = ?, max_extra_adults = ?, extra_adult_price = ?, food_plan_cp = ?, food_plan_map = ?, food_plan_ap = ?";
            $params = [
                $room_name,
                $room_description,
                $room_price,
                $video_url,
                $facilities_str,
                $max_capacity,
                $total_room,
                $max_extra_adults,
                $extra_adult_price,
                $food_plan_cp,
                $food_plan_map,
                $food_plan_ap
            ];
            $types = "ssdssiiddsss";  // Updated types: s=string, d=double/float, i=integer

            // Add conditions for each image if a new image is uploaded
            if ($image_names['image_1']) {
                $sql .= ", image_1 = ?";
                $params[] = $image_names['image_1'];
                $types .= "s";
            }
            if ($image_names['image_2']) {
                $sql .= ", image_2 = ?";
                $params[] = $image_names['image_2'];
                $types .= "s";
            }
            if ($image_names['image_3']) {
                $sql .= ", image_3 = ?";
                $params[] = $image_names['image_3'];
                $types .= "s";
            }
            if ($image_names['image_4']) {
                $sql .= ", image_4 = ?";
                $params[] = $image_names['image_4'];
                $types .= "s";
            }
            if ($image_names['image_5']) {
                $sql .= ", image_5 = ?";
                $params[] = $image_names['image_5'];
                $types .= "s";
            }

            // Add WHERE clause for the update query
            $sql .= " WHERE id = ?";
            $params[] = $room_id;
            $types .= "i";

            // Prepare and bind the parameters
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param($types, ...$params);
        } else {
            // Insert new room query
            $sql = "INSERT INTO rooms (name, description, price, video_url, facilities, max_capacity, total_room, max_extra_adults, extra_adult_price, food_plan_cp, food_plan_map, food_plan_ap, image_1, image_2, image_3, image_4, image_5) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }

            // Bind the parameters with correct types
            $stmt->bind_param(
                "ssdssiidsssssssss", // Updated type string
                $room_name,
                $room_description,
                $room_price,
                $video_url,
                $facilities_str,
                $max_capacity,
                $total_room,
                $max_extra_adults,
                $extra_adult_price,
                $food_plan_cp,
                $food_plan_map,
                $food_plan_ap,
                $image_names['image_1'],
                $image_names['image_2'],
                $image_names['image_3'],
                $image_names['image_4'],
                $image_names['image_5']
            );
        }

        // Execute query and check if successful
        if ($stmt->execute()) {
            $stmt->close();
            echo "<script>alert('Success'); window.location.href = '../room';</script>";
            exit();
        } else {
            throw new Exception("Error executing query: " . $stmt->error);
        }
    } catch (Exception $e) {
        // Log the error (in production, log to file instead of displaying)
        error_log($e->getMessage());
        echo "<script>alert('Database error occurred. Please try again.'); window.location.href = '../room';</script>";
        exit();
    }
}
?>