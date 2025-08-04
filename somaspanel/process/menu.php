<?php
require("../config/config.php");

// Handle form submission for adding or updating a menu item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $dish_name = $_POST['dish_name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];

    // Insert or update menu item in the database
    if ($id) {
        // Update existing menu item
        $sql = "UPDATE menu SET dish_name = ?, category_id = ?, price = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sidi", $dish_name, $category_id, $price, $id);
    } else {
        // Insert new menu item
        $sql = "INSERT INTO menu (dish_name, category_id, price) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sid", $dish_name, $category_id, $price);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Success'); window.location.href = '../menu';</script>";
        exit();
    } else {
        echo "<script>alert('Error'); window.location.href = '../menu';</script>";
        exit();
    }
}
