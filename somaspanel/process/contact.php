<?php

require("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and sanitize it
    $contact_number_1 = htmlspecialchars($_POST['contact_number_1']);
    $contact_number_2 = htmlspecialchars($_POST['contact_number_2']);
    $email_1 = htmlspecialchars($_POST['email_1']);
    $email_2 = htmlspecialchars($_POST['email_2']);
    $address = htmlspecialchars($_POST['address']);
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Update existing contact
        $sql = "UPDATE contacts 
                SET contact_number_1='$contact_number_1', 
                    contact_number_2='$contact_number_2', 
                    email_1='$email_1', 
                    email_2='$email_2', 
                    address='$address' 
                WHERE id=$id";
    } else {

        echo "<script>alert('Error'); window.location.href = '../contact';</script>";
        exit();
    }

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Success'); window.location.href = '../contact';</script>";
        exit();
    } else {
        echo "<script>alert('Error'); window.location.href = '../contact';</script>";
    }
    exit();
}
