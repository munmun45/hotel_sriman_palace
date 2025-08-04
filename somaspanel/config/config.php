<?php
// Database connection details
$servername = "localhost"; // Your database host
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "hotel_sriman_palace"; // Your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Uncomment this line if you want to confirm the connection for testing purposes
    // echo "Connected successfully";
}


// Set the timezone to Indian Standard Time (IST)
date_default_timezone_set('Asia/Kolkata');

// Get the current date and time in IST
$currentDateTime = date('Y-m-d H:i:s');  // You can format it as per your requirement
