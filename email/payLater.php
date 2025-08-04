<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require '../config/config.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


?>


<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);



// If any parameter is missing, show an error and stop execution
if (!empty($missing_params)) {
    echo "Error: The following required parameters are missing: " . implode(", ", $missing_params);
    exit;
}

// Retrieve and sanitize values
$name = htmlspecialchars($_POST['name']);
$mobile = htmlspecialchars($_POST['mobile']);
$email = htmlspecialchars($_POST['email']);
$check_in = htmlspecialchars($_POST['check_in']);
$check_out = htmlspecialchars($_POST['check_out']);
$rooms_id = htmlspecialchars($_POST['rooms_id']);
$total_rooms = htmlspecialchars($_POST['rooms']);
$plan = htmlspecialchars($_POST['plan']);
$adult = htmlspecialchars($_POST['adults']);
$extraAdults = htmlspecialchars($_POST['extra']);
$total = htmlspecialchars($_POST['total']);

$planCosts = htmlspecialchars($_POST['planCost']);
$extraAdultPrice = htmlspecialchars($_POST['extraAdultPrice']);
$roomPrice = htmlspecialchars($_POST['roomPrice']);

// Convert and validate dates
$startDate = date('Y-m-d', strtotime($check_in));
$endDate = date('Y-m-d', strtotime($check_out));

if (!$startDate || !$endDate) {
    echo "Error: Invalid check-in or check-out date.";
    exit;
}

$total_adult = $adult - $extraAdults;

if ($extraAdults == '') {

    $extraAdults = 0;
}

// Fetch room details
$sqlRooms = "SELECT * FROM rooms WHERE id = $rooms_id";
$resultRooms = $conn->query($sqlRooms);

if ($resultRooms && $resultRooms->num_rows > 0) {
    while ($room = $resultRooms->fetch_assoc()) {
        $roomId = $room['id'];
        $roomName = $room['name'];
        $totalRooms = $room['total_room'];
        $max_capacity_one_room = $room['max_capacity'];
        $max_extra_adults_one_room = $room['max_extra_adults'];

        // Query to calculate total booked rooms for this room type within the date range
        $sqlBookings = "
            SELECT SUM(total_rooms) AS booked_rooms
            FROM bookings
            WHERE room_type = $roomId
              AND check_in_date <= '$endDate'
              AND check_out_date >= '$startDate'
              AND (status != 'check-in' AND status != 'canceled');
        ";

        $resultBookings = $conn->query($sqlBookings);

        $bookedRooms = 0;
        if ($resultBookings && $resultBookings->num_rows > 0) {
            $bookingData = $resultBookings->fetch_assoc();
            $bookedRooms = $bookingData['booked_rooms'] ?: 0;
        }

        // Calculate available rooms
        $average_capacity = $max_capacity_one_room + $max_extra_adults_one_room;
        $total_min_room_book = ceil($total_adult / $average_capacity);
        $total_availableRooms = $totalRooms - $bookedRooms;
        $availableRooms = $total_availableRooms - $total_min_room_book;

        if ($availableRooms >= $total_rooms) {
            echo "Available. Booking is being processed...<br>";

            // Generate custom booking ID
            $lastIdQuery = "SELECT MAX(id) AS last_id FROM bookings";
            $result = $conn->query($lastIdQuery);
            $lastId = $result->num_rows > 0 ? $result->fetch_assoc()['last_id'] + 1 : 1; // Increment by 1 or start at 1
            $bookingId = "AH" . str_pad($lastId, 5, "0", STR_PAD_LEFT); // Format like H4W00001

            // Compute all required values
            $extra_guest = $extraAdults; // Ensure non-negative extra guests
            $booking_platform = 'Website';
            $status = 'pending';
            $off_percentage = 0; // Default discount percentage
            $pan_price = $planCosts; // Default PAN price
            $extra_adult_price = $extraAdultPrice; // Default extra adult price

            // Insert booking into the database
            $sqlInsert = "
                INSERT INTO bookings (
                    guest_name, guest_number, email, total_guests, extra_gust, total_rooms, 
                    room_type, room_plan, check_in_date, check_out_date, 
                    booking_platform, booking_id, off_percentage, status, 
                    room_price, pan_price, extra_adult_price, amount
                ) VALUES (
                    '$name', '$mobile', '$email', $total_adult, $extra_guest, $total_rooms, 
                    $roomId, '$plan', '$startDate', '$endDate', 
                    '$booking_platform', '$bookingId', $off_percentage, '$status', 
                    $roomPrice, $pan_price, $extra_adult_price, $total
                )
            ";

            if ($conn->query($sqlInsert)) {
                echo "Booking successfully inserted with Booking ID: $bookingId<br>";



                $message = "
                    <!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Booking Confirmation</title>
                    </head>
                    <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; color: #333;'>
                        <div style='width: 600px; margin: 40px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
                            <div style='text-align: center; color: #ff6a13; font-size: 36px; margin-bottom: 30px;'>hotel sriman palace</div>
                            <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                                <tr style='background-color: #f4f4f4;'>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Name</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$name}</td>
                                </tr>
                                <tr>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Phone Number</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$mobile}</td>
                                </tr>
                                <tr style='background-color: #f4f4f4;'>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Email</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$email}</td>
                                </tr>
                                <tr>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Room Type</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$roomName}</td>
                                </tr>
                                <tr style='background-color: #f4f4f4;'>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Total Rooms Booked</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$total_rooms}</td>
                                </tr>
                                <tr>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Total Adults</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$total_adult}</td>
                                </tr>
                                <tr style='background-color: #f4f4f4;'>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Check-in Date</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$startDate}</td>
                                </tr>
                                <tr>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Check-out Date</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$endDate}</td>
                                </tr>
                                <tr style='background-color: #f4f4f4;'>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Plan</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$plan}</td>
                                </tr>
                                <tr>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Total Amount</th>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>₹{$total}</td>
                                </tr>
                                <!-- Status row with highlighted background -->
                                <tr style='background-color: #f4f4f4;'>
                                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Booking Status</th>
                                    <td style='padding: 10px; border: 1px solid #ddd; background-color: #4caf50; color: white; font-weight: bold; text-align: center;'>{$status}</td>
                                </tr>
                            </table>
                            <div style='text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0; color: #ffffff; background-color: #ff6a13; padding: 15px; border-radius: 5px;'>
                                Booking ID: {$bookingId}
                            </div>
                            <div style='font-size: 14px; color: #888; text-align: center; margin-top: 30px;'>
                                <p>If you have any questions, feel free to contact us:</p>
                                <p>Phone: +91 7978634893 | Email: <a href='mailto:hotel.bluesagarpuri@gmail.com' style='color: #ff6a13;'>hotel.bluesagarpuri@gmail.com</a></p>
                                <p>Address: Bidhaba Ashram Chaka, Bengali Market, Swargadwar, Puri, Odisha</p>
                            </div>
                        </div>
                    </body>
                    </html>
                ";

                try {

                    $mail->isSMTP();
                    $mail->Host = 'smtp.hostinger.com';
                    $mail->Port = 587;
                    $mail->SMTPDebug = 0;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'no_reply@anjaliholidays.in';
                    $mail->Password = 'e#0EkgkY';

                    $mail->setFrom('no_reply@anjaliholidays.in', 'hotel sriman palace');
                    $mail->addAddress($email);
                    $mail->addCC('hotel.bluesagarpuri@gmail.com');

                    $mail->isHTML(true);
                    $mail->Subject = "Room Booking";
                    $mail->Body    = $message;

                    $mail->send();

 
                    echo "
                        <script>
            
                            localStorage.setItem('alert_Email', '1');
                            window.location.href='/?message=Your room has been successfully booked! We look forward to hosting you. See you soon!';
                        
                        </script>
                    ";

                    exit;
                } catch (Exception $e) {

                    $sql = "UPDATE bookings SET status = 'canceled', note = 'Pay Layer: Technical Issue' WHERE booking_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $bookingId);
                    $stmt->execute();


                    echo "
                        <script>
            
                            localStorage.setItem('alert_Email', '2');
                            window.location.href='/?message=Oops! Something went wrong with your booking. Please try again or contact us for assistance.';
                        
                        </script>
                    ";

                    exit;
                }
            } else {
                echo "Error inserting booking: " . $conn->error;
            }
        } else {
            echo "
                        <script>
            
                            localStorage.setItem('alert_Email', '2');
                            window.location.href='/?message=Sorry, the room you requested is not available. Please choose another room or try a different date.';
                        
                        </script>
                    ";

            exit;
        }
    }
} else {
    echo "Error: Room not found.";
}

$conn->close();

?>





