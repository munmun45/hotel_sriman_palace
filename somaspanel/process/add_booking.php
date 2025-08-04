<?php
require("../config/config.php");

if (!isset($_POST['id'])) {
    // Process the form when it is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Sanitize and validate the inputs
        $guestName = $conn->real_escape_string($_POST['guestName']);
        $guestNumber = $conn->real_escape_string($_POST['guestNumber']);
        $guestEmail = $conn->real_escape_string($_POST['email']);
        $totalGuests = (int) $_POST['totalGuests'];
        $extra_gust = (int) $_POST['extra_gust'];
        $totalRooms = (int) $_POST['totalRooms'];
        $roomType = $conn->real_escape_string($_POST['roomType']);
        $roomPlan = $conn->real_escape_string($_POST['roomPlan']);
        $checkInDate = $conn->real_escape_string($_POST['checkInDate']);
        $checkOutDate = $conn->real_escape_string($_POST['checkOutDate']);
        $bookingPlatform = $conn->real_escape_string($_POST['bookingPlatform']);
        $off = (float) $_POST['off'];
        $status = $conn->real_escape_string($_POST['status']);

        // Fetch room details
        $query = "SELECT * FROM rooms WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $roomType);
        $stmt->execute();
        $result = $stmt->get_result();
        $room = $result->fetch_assoc();

        // Check if room exists
        if (!$room) {
            echo "Room not found.";
            exit();
        }

        $roomPrice = $room['price'];
        $extraGuestPrice = $room['extra_adult_price'];

        // Assign food plan cost
        if ($roomPlan == "EP") {
            $foodPlanCost = 0;
        } elseif ($roomPlan == "CP") {
            $foodPlanCost = $room['food_plan_cp'];
        } elseif ($roomPlan == "MAP") {
            $foodPlanCost = $room['food_plan_map'];
        } elseif ($roomPlan == "AP") {
            $foodPlanCost = $room['food_plan_ap'];
        } else {
            $foodPlanCost = 0;
        }

        // Calculate the number of nights
        $checkIn = new DateTime($checkInDate);
        $checkOut = new DateTime($checkOutDate);
        $interval = $checkIn->diff($checkOut);
        $nights = $interval->days;

        if ($nights <= 0) {
            $nights = 1; // Ensure at least 1 night
        }

        // Room subtotal
        $roomSubtotal = $roomPrice * $totalRooms * $nights;
        $roomSubtotal_cgst = $roomSubtotal * 0.06; // 6% CGST
        $roomSubtotal_sgst = $roomSubtotal * 0.06; // 6% SGST
        $roomTotalWithTax = $roomSubtotal + $roomSubtotal_cgst + $roomSubtotal_sgst;

        // Extra guest subtotal
        $extraGuestsSubtotal = $extraGuestPrice * $extra_gust * $nights;

        // Food plan cost calculation
        $foodPlanCostTotal = $foodPlanCost * ($totalGuests + $extra_gust) * $nights;
        $foodPlanCost_cgst = $foodPlanCostTotal * 0.025; // 2.5% CGST
        $foodPlanCost_sgst = $foodPlanCostTotal * 0.025; // 2.5% SGST
        $foodPlanCostWithTax = $foodPlanCostTotal + $foodPlanCost_cgst + $foodPlanCost_sgst;

        // Net total calculation
        $netTotal = $roomTotalWithTax + $extraGuestsSubtotal + $foodPlanCostWithTax;

        // Apply discount
        $finalAmount = $netTotal;

        // Validate required fields
        if (empty($guestName) || empty($guestNumber) || empty($totalGuests) || empty($totalRooms) || empty($roomType) || empty($checkInDate) || empty($checkOutDate) || empty($bookingPlatform) || empty($status) || empty($roomPlan)) {
            echo "All fields are required!";
            exit;
        }

        // Generate booking ID if not provided
        $bookingId = isset($_POST['bookingId']) && !empty($_POST['bookingId']) ? $conn->real_escape_string($_POST['bookingId']) : "";

        if (empty($bookingId)) {
            // Get the last inserted ID to generate the booking ID
            $lastIdQuery = "SELECT MAX(id) AS last_id FROM bookings";
            $result = $conn->query($lastIdQuery);
            $lastId = $result->fetch_assoc()['last_id'] + 1; // Increment by 1
            $bookingId = "AH" . str_pad($lastId, 5, "0", STR_PAD_LEFT); // Format like H4W0001
        }

        // Insert the new booking record
        $sqlInsert = "INSERT INTO bookings (guest_name, guest_number, email, total_guests, extra_gust, total_rooms, room_type, room_plan, check_in_date, check_out_date, booking_platform, booking_id, off_percentage, status, room_price, pan_price, extra_adult_price, amount)
                      VALUES ('$guestName', '$guestNumber', '$guestEmail', '$totalGuests', '$extra_gust', '$totalRooms', '$roomType', '$roomPlan', '$checkInDate', '$checkOutDate', '$bookingPlatform', '$bookingId', '$off', '$status', '$roomPrice', '$foodPlanCost', '$extraGuestPrice', '$finalAmount')";

        if ($conn->query($sqlInsert) === TRUE) {
            echo "<script>alert('New booking saved successfully.'); window.location.href = '../booking_manager';</script>";
            exit();
        } else {
            echo "<script>alert('Error: " . $sqlInsert . "<br>" . $conn->error . "'); window.location.href = '../booking_manager';</script>";
            exit();
        }

        // Close the database connection
        $conn->close();
    }
} else {
    // Update logic here (if necessary)

    $bookingId = $conn->real_escape_string($_POST['id']);
    $note = $conn->real_escape_string($_POST['note']);

    // Check if the booking ID exists in the database
    $sqlCheck = "SELECT * FROM bookings WHERE id = '$bookingId'";
    $result = $conn->query($sqlCheck);

    if ($result->num_rows > 0) {
        // Booking ID exists, so update the record
        $sqlUpdate = "UPDATE bookings 
                      SET note = '$note'
                      WHERE id = '$bookingId'";

        if ($conn->query($sqlUpdate) === TRUE) {

            echo "<script>alert('Booking updated successfully.'); window.location.href = '../booking_manager';</script>";
            exit();
        } else {

            echo "<script>alert('Error updating booking: " . $conn->error . "'); window.location.href = '../booking_manager';</script>";
            exit();
        }
    }
}
