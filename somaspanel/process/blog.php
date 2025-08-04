<?php
require("../config/config.php");

// Handle form submission for adding or updating a blog
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the blog data from the form
    $id = $_POST['id'] ?? ''; // Blog ID, empty for new blog
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    // Initialize variable for the image
    $image = null;

    // Helper function to handle image upload
    function upload_image($file_input_name)
    {
        $image = null;
        if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
            $file_extension = strtolower(pathinfo($_FILES[$file_input_name]['name'], PATHINFO_EXTENSION));

            // Allowed image formats
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'];

            // Check if the file has a valid extension
            if (in_array($file_extension, $allowed_extensions)) {
                // Generate a random, unique name for the image
                $image = uniqid() . '.' . $file_extension;
                // Move the uploaded file to the uploads directory
                if (move_uploaded_file($_FILES[$file_input_name]['tmp_name'], '../uploads/' . $image)) {
                    // File successfully uploaded
                } else {
                    echo "<script>alert('Error uploading the file. Please try again.'); window.location.href = '../blog';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Invalid image format. Allowed formats are JPG, JPEG, PNG, GIF, WEBP, BMP, and TIFF.'); window.location.href = '../blog';</script>";
                exit();
            }
        }

        return $image;
    }

    // Handle file upload for the blog image
    $image = upload_image('image');

    // Insert or update the blog in the database
    if ($id) {
        // Update existing blog
        $sql = "UPDATE blogs SET title = ?, description = ?, date = ?";

        // Add image column only if a new image is provided
        if ($image) {
            $sql .= ", image = ?";
        }

        $sql .= " WHERE id = ?";

        $stmt = $conn->prepare($sql);

        // Bind parameters for the update, including the image column if applicable
        if ($image) {
            $stmt->bind_param("ssss", $title, $description, $date, $image, $id);
        } else {
            $stmt->bind_param("ssss", $title, $description, $date, $id);
        }
    } else {
        // Insert new blog
        $sql = "INSERT INTO blogs (title, description, image, date) 
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $description, $image, $date);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Success'); window.location.href = '../blog';</script>";
        exit();
    } else {
        echo "<script>alert('Error'); window.location.href = '../blog';</script>";
        exit();
    }
}
