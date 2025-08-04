<?php

// Include database connection
require("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Initialize the SQL query string
    $sql = "";

    // Check if the ID is provided (for update) or not (for insert)
    if ($id > 0) {
        // Update food category
        $sql = "UPDATE food_categories SET name='$name'";

        // Check if an image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            // Allowed image formats
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            // Check if the file has a valid extension
            if (in_array($file_extension, $allowed_extensions)) {
                // Generate a random, unique name for the image
                $image = uniqid() . '.' . $file_extension;
                // Move the uploaded file to the uploads directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image)) {
                    // Add the image name to the SQL query
                    $sql .= ", image='$image'";
                } else {
                    echo "<script>alert('Image upload failed'); window.location.href = '../food_category';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Invalid image format. Allowed formats are JPG, JPEG, PNG, GIF, and WEBP.'); window.location.href = '../food_category';</script>";
                exit();
            }
        }


        // Finalize the update query
        $sql .= " WHERE id=$id";
    } else {
        // Insert new food category
        $sql = "INSERT INTO food_categories (name";

        // Check if an image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            // Check if the file is a valid jpg, jpeg, or png image
            if (in_array($file_extension, ['jpg', 'jpeg', 'png'])) {
                // Generate a random, unique name for the image
                $image = uniqid() . '.' . $file_extension;
                // Move the uploaded file to the uploads directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image)) {
                    // Add image to the SQL query
                    $sql .= ", image";
                } else {
                    echo "<script>alert('Image upload failed'); window.location.href = '../food_category';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Only JPG, JPEG, and PNG images are allowed.'); window.location.href = '../food_category';</script>";
                exit();
            }
        }

        // Insert food category with or without image
        $sql .= ") VALUES ('$name'" . ($image ? ", '$image'" : "") . ")";
    }

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Success'); window.location.href = '../food_category';</script>";
        exit();
    } else {
        echo "<script>alert('Error'); window.location.href = '../food_category';</script>";
    }
    exit();
}
