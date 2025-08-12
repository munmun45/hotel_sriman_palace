<?php
require("../config/config.php");

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get booking ID and new GST status
    $bookingId = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;
    $gstStatus = isset($_POST['gst_status']) ? intval($_POST['gst_status']) : 0;
    
    // Validate input
    if ($bookingId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid booking ID']);
        exit;
    }
    
    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE bookings SET gst_provided = ? WHERE id = ?");
    $stmt->bind_param("ii", $gstStatus, $bookingId);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'GST status updated successfully',
            'new_status' => $gstStatus
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to update GST status: ' . $conn->error
        ]);
    }
    
    $stmt->close();
} else {
    // Not a POST request
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>
