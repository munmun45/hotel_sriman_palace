<?php
require("../config/config.php");

// Function to validate and convert date
function validateAndConvertDate($date, $format = 'Y-m-d')
{
    $datetime = DateTime::createFromFormat($format, $date);
    if (!$datetime) {
        throw new Exception("Invalid date format: $date. Expected format is $format.");
    }
    return $datetime->format($format);
}

// Function to fetch room name by ID
function getRoomName($roomId, $conn)
{
    $roomSql = "SELECT name FROM rooms WHERE id = ?";
    $roomStmt = $conn->prepare($roomSql);
    $roomStmt->bind_param("i", $roomId);
    $roomStmt->execute();
    $roomResult = $roomStmt->get_result();

    if ($roomResult->num_rows > 0) {
        $roomData = $roomResult->fetch_assoc();
        return $roomData['name'];
    }
    return 'Unknown Room';
}

try {
    $datefilter = isset($_GET['datefilter']) ? $_GET['datefilter'] : '';
    $checkInDate = '';
    $checkOutDate = '';

    if ($datefilter) {
        $dates = explode(' - ', $datefilter);
        $checkInDate = isset($dates[0]) ? date('Y-m-d', strtotime($dates[0])) : '';
        $checkOutDate = isset($dates[1]) ? date('Y-m-d', strtotime($dates[1])) : '';
    }


    $bookingId = isset($_GET['booking_id']) ? $_GET['booking_id'] : null;
    $phone = isset($_GET['phone']) ? $_GET['phone'] : null;
    $status = isset($_GET['status']) ? $_GET['status'] : null;

    if (!$checkInDate || !$checkOutDate) {
        throw new Exception("Check-in and check-out dates are required.");
    }

    // Build query with filters
    $sql = "SELECT * FROM bookings WHERE 1";
    $params = [];
    $types = '';

    // Add date filters
    if ($checkInDate && $checkOutDate) {

        if ($checkInDate == $checkOutDate) {
            $sql .= " AND (check_in_date = ? or check_out_date = ?)";
            $params[] = $checkOutDate;
            $params[] = $checkInDate;
            $types .= "ss";
        } else {
            $sql .= " AND (check_in_date <= ? AND check_out_date >= ?)";
            $params[] = $checkOutDate;
            $params[] = $checkInDate;
            $types .= "ss";
        }
    }



    // Add booking ID filter
    if ($bookingId) {
        $sql .= " AND booking_id LIKE ?";
        $params[] = "%$bookingId%";
        $types .= "s";
    }

    // Add phone filter
    if ($phone) {
        $sql .= " AND guest_number LIKE ?";
        $params[] = "%$phone%";
        $types .= "s";
    }

    // Add status filter
    if ($status) {
        $sql .= " AND status = ?";
        $params[] = $status;
        $types .= "s";
    }

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("SQL Error: " . $conn->error);
    }

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("No records found for the selected date range.");
    }

    // Prepare CSV output
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="Booking_Report.csv"');

    $output = fopen('php://output', 'w');
    $headers = [
        "ID",
        "Guest Name",
        "Guest Number",
        "Guest Email",
        "Total Adults",
        "Extra Adults",
        "Total Rooms",
        "Room Plan",
        "Room No",
        "Room Type",
        "Check-in Date",
        "Check-out Date",
        "Booking Platform",
        "Booking ID",
        "Room Price Par Night",
        "Food Price Par Hed",
        "Extra Adult Price",
        "Status",
        "Note",
        "Total Amount",
        "Booking Date",
        "GST Provided"
    ];
    fputcsv($output, $headers);

    // Fetch and write rows
    while ($row = $result->fetch_assoc()) {
        $roomName = getRoomName($row['room_type'], $conn);

        $csvRow = [
            $row['id'],
            $row['guest_name'],
            $row['guest_number'],
            $row['email'],
            $row['total_guests'],
            $row['extra_gust'],
            $row['total_rooms'],
            $row['room_plan'],
            $row['room_no'],
            $roomName,
            $row['check_in_date'],
            $row['check_out_date'],
            $row['booking_platform'],
            $row['booking_id'],
            $row['room_price'],
            $row['pan_price'],
            $row['extra_adult_price'],
            $row['status'],
            $row['note'],
            $row['amount'],
            $row['date'],
            isset($row['gst_provided']) && $row['gst_provided'] == 1 ? 'Yes' : 'No'
        ];
        fputcsv($output, $csvRow);
    }

    fclose($output);
    $conn->close();
    exit;
} catch (Exception $e) {
    http_response_code(400); // Send proper HTTP response code
    echo "Error: " . htmlspecialchars($e->getMessage());
    error_log($e->getMessage()); // Log error for debugging
}
