<?php
require("../config/config.php");

// Handle form submission for adding or updating a service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'];
    $description = $_POST['description'];
    $faq_1 = $_POST['faq_1'];
    $faq_2 = $_POST['faq_2'];
    $faq_3 = $_POST['faq_3'];
    $faq_4 = $_POST['faq_4'];
    $faq_5 = $_POST['faq_5'];

    // Initialize variables for images
    $image_1 = null;
    $image_2 = null;

    // Helper function to handle image upload
    function upload_image($file_input_name)
    {
        $image = null;
        if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
            $file_extension = strtolower(pathinfo($_FILES[$file_input_name]['name'], PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            // Check if the file is a valid image format
            if (in_array($file_extension, $allowed_extensions)) {
                // Generate a random, unique name for the image
                $image = uniqid() . '.' . $file_extension;
                // Move the uploaded file to the uploads directory
                move_uploaded_file($_FILES[$file_input_name]['tmp_name'], '../uploads/' . $image);
            } else {
                echo "<script>alert('Invalid image format. Allowed formats are: JPG, JPEG, PNG, GIF, WEBP.'); window.location.href = '../service';</script>";
                exit();
            }
        }
        return $image;
    }

    // Handle file uploads for image_1 and image_2
    $image_1 = upload_image('image_1');
    $image_2 = upload_image('image_2');

    // Insert or update service in the database
    if ($id) {
        // Update existing service
        $sql = "UPDATE services SET title = ?, description = ?, faq_1 = ?, faq_2 = ?, faq_3 = ?, faq_4 = ?, faq_5 = ?";

        // Add image columns only if new images are provided
        if ($image_1) {
            $sql .= ", image_1 = ?";
        }
        if ($image_2) {
            $sql .= ", image_2 = ?";
        }

        $sql .= " WHERE id = ?";

        $stmt = $conn->prepare($sql);

        // Bind parameters for the update, including image columns if applicable
        if ($image_1 && $image_2) {
            $stmt->bind_param("ssssssssss", $title, $description, $faq_1, $faq_2, $faq_3, $faq_4, $faq_5, $image_1, $image_2, $id);
        } elseif ($image_1) {
            $stmt->bind_param("sssssssss", $title, $description, $faq_1, $faq_2, $faq_3, $faq_4, $faq_5, $image_1, $id);
        } elseif ($image_2) {
            $stmt->bind_param("sssssssss", $title, $description, $faq_1, $faq_2, $faq_3, $faq_4, $faq_5, $image_2, $id);
        } else {
            $stmt->bind_param("ssssssss", $title, $description, $faq_1, $faq_2, $faq_3, $faq_4, $faq_5, $id);
        }
    } else {
        // Insert new service
        $sql = "INSERT INTO services (title, description, image_1, image_2, faq_1, faq_2, faq_3, faq_4, faq_5) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $title, $description, $image_1, $image_2, $faq_1, $faq_2, $faq_3, $faq_4, $faq_5);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Success'); window.location.href = '../service';</script>";
        exit();
    } else {
        echo "<script>alert('Error'); window.location.href = '../service';</script>";
        exit();
    }
}
?>
