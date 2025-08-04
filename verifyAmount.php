<?php 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
require("./config/config.php");

// Fetch the booking data from POST (updated field names)
$receivedAmount = isset($_POST['total']) ? (float)$_POST['total'] : 0;
$roomId = isset($_POST['rooms_id']) ? (int)$_POST['rooms_id'] : 0;
$checkInDate = isset($_POST['check_in']) ? $_POST['check_in'] : '';
$checkOutDate = isset($_POST['check_out']) ? $_POST['check_out'] : '';
$totalAdults = isset($_POST['adults']) ? (int)$_POST['adults'] : 0;
$planType = isset($_POST['plan']) ? $_POST['plan'] : 'EP';
$extraAdults = isset($_POST['extra']) ? (int)$_POST['extra'] : 0;

// Make sure the required fields are provided
if ($roomId <= 0 || empty($checkInDate) || empty($checkOutDate) || $totalAdults <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Required fields are missing.'.$receivedAmount ]);
    exit();
}

// Fetch the room details from the database using mysqli
$query = "SELECT * FROM rooms WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $roomId); // 'i' means integer
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();
} else {
    echo json_encode(['status' => 'error', 'message' => 'SQL Execution failed.']);
    exit();
}

if (!$room) {
    echo json_encode(['status' => 'error', 'message' => 'Room not found.']);
    exit();
}

// Calculate the number of nights
$checkIn = strtotime($checkInDate);
$checkOut = strtotime($checkOutDate);
if ($checkIn === false || $checkOut === false) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid dates.']);
    exit();
}
$nights = ($checkOut - $checkIn) / (60 * 60 * 24);

// Ensure the nights count is positive
if ($nights <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid dates. Please check the check-in and check-out dates.']);
    exit();
}

// Fetch food plan prices based on the selected plan
$planCosts = [
    'EP' => 0,
    'CP' => $room['food_plan_cp'],
    'MAP' => $room['food_plan_map'],
    'AP' => $room['food_plan_ap'],
];

// Calculate the room cost
$roomPrice = $room['price'];  // Room price per night
$roomCost = $roomPrice * $nights;  // Total cost for the rooms

// Calculate the extra adult cost (if applicable)
$maxCapacity = $room['max_capacity'];
$extraAdultPrice = $room['extra_adult_price'];
$extraAdultCost = 0;
if ($totalAdults > $maxCapacity) {
    $extraAdults = $totalAdults - $maxCapacity;
    $extraAdultCost = $extraAdults * $extraAdultPrice * $nights;  // Extra adults cost
}

// Calculate the food plan cost
$foodPlanCost = $totalAdults * $planCosts[$planType] * $nights;  // Total food plan cost

// Calculate GST
$gstRoomAndExtras = 0.12 * $roomCost;
$gstPlan = 0.05 * $foodPlanCost;
$gstExtraAdults =  $extraAdultCost;

// Calculate the total amount before GST
$totalAmountBeforeGST = $roomCost + $extraAdultCost + $foodPlanCost;
$totalGST = $gstRoomAndExtras + $gstPlan + $gstExtraAdults;
$totalAmountWithGST = $totalAmountBeforeGST + $totalGST;  // Total amount after GST

// Store the expected amount for comparison
$expectedAmount = $totalAmountWithGST;

// Compare received amount with expected amount
// if (round($receivedAmount, 2) == round($expectedAmount, 2)) {
// } else {
//     echo json_encode(['status' => 'invalid', 'message' => 'Booking Failed'.$receivedAmount.' \ '.$expectedAmount]);
// }
echo json_encode(['status' => 'valid', 'message' => 'Proceed to Payment']);

// Close the database connection
$stmt->close();
$conn->close();
