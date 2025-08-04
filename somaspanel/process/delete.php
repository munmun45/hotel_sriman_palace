<?php

require("../config/config.php");


if (isset($_GET['id']) && isset($_GET['table_name'])) {
    $id = $_GET['id'];
    $table_name = $_GET['table_name'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM $table_name WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success'; // If deletion is successful, return 'success'
    } else {
        echo 'error'; // If there was an error, return 'error'
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error'; // If no id or invalid parameters, return 'error'
}
