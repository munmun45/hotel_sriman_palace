<?php


require("../config/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $icon = htmlspecialchars($_POST['icon']);
    $name = htmlspecialchars($_POST['name']);
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Update facility
        $sql = "UPDATE facilities SET icon='$icon', name='$name' WHERE id=$id";
    } else {
        // Insert new facility
        $sql = "INSERT INTO facilities (icon, name) VALUES ('$icon', '$name')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Success'); window.location.href = '../facility';</script>";
        exit();
    } else {
        echo "<script>alert('Error'); window.location.href = '../facility';</script>";
    }
    exit();
}
