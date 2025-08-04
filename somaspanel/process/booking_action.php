<?php
// Include your database connection file
require("../config/config.php");
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['booking_id']) {
    $action = $_GET['action'];
    $bookingId = intval($_GET['id']); // Sanitize the input to prevent SQL injection
    $booking_id = $_GET['booking_id']; // Sanitize the input to prevent SQL injection

    $response = array('status' => 'error', 'message' => '');

    // Check for valid action and proceed accordingly
    switch ($action) {
        case 'canceled':
            if (isset($_GET['note'])) {
                $note = floatval($_GET['note']); // Ensure note is treated as a number
                $sql = "UPDATE bookings SET status = 'canceled' WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $bookingId);
                if ($stmt->execute()) {
                    sendEmail($bookingId, 'canceled', $booking_id);
                    $response['status'] = 'success';
                    $response['message'] = "Booking canceled for ID $booking_id";
                } else {
                    $response['message'] = "Unable to cancel booking for ID $booking_id";
                }
            }
            break;

        case 'confirm':
            if (isset($_GET['note'])) {
                $note = floatval($_GET['note']); // Ensure note is treated as a number
                $sql = "UPDATE bookings SET status = 'confirmed', payment_amount = payment_amount + ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("di", $note, $bookingId);
                if ($stmt->execute()) {
                    sendEmail($bookingId, 'confirmed', $booking_id);
                    $response['status'] = 'success';
                    $response['message'] = "Booking confirmed for ID $booking_id";
                } else {
                    $response['message'] = "Unable to confirm booking for ID $booking_id";
                }
            }
            break;

        case 'check-in':
            if (isset($_GET['note'])) {
                $note = $_GET['note'];
                $today = date('Y-m-d');
                $sql = "UPDATE bookings SET status = 'check-in', check_in_status = 'check-in', check_in_date = ?, room_no = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $today, $note, $bookingId);
                if ($stmt->execute()) {
                    sendEmail($bookingId, 'check-in', $booking_id);
                    $response['status'] = 'success';
                    $response['message'] = "Checked in successfully for ID $booking_id";
                } else {
                    $response['message'] = "Unable to check-in for ID $booking_id";
                }
            }
            break;

        case 'check-out':
            if (isset($_GET['note'])) {
                $today = date('Y-m-d');
                $note = floatval($_GET['note']);
                $sql = "UPDATE bookings SET status = 'check-out', check_out_status = 'check-out', check_out_date = ?, payment_amount = payment_amount + ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdi", $today, $note, $bookingId);
                if ($stmt->execute()) {
                    sendEmail($bookingId, 'check-out', $booking_id);
                    $response['status'] = 'success';
                    $response['message'] = "Checked out successfully for ID $booking_id with note saved";
                } else {
                    $response['message'] = "Unable to check-out for ID $booking_id";
                }
            } else {
                $response['message'] = "Note not provided for check-out action";
            }
            break;

        case 'note':
            if (isset($_POST['note'])) {
                $note = $_POST['note'];
                $sql = "UPDATE bookings SET note = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $note, $bookingId);
                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = "Note updated for ID $booking_id";
                } else {
                    $response['message'] = "Unable to update note for ID $booking_id";
                }
            } else {
                $response['message'] = "Note not provided";
            }
            break;

        default:
            $response['message'] = "Invalid action";
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request');
    echo json_encode($response);
    exit();
}

// Function to send email
function sendEmail($bookingId, $status, $booking_id)
{
    global $conn, $mail;
    $sql = "SELECT email, guest_name FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $stmt->bind_result($email, $guest_name);
    $stmt->fetch();

    if ($email) {
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'no_reply@hotelbluesagar.in';
            $mail->Password = ':L8#m&6qu7^G';

            $mail->setFrom('no_reply@hotelbluesagar.in', 'hotel sriman palace');
            $mail->addAddress($email);  // Send to guest email
            $mail->addCC('hotel.bluesagarpuri@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = "Booking Status Update for ID $booking_id";
            $mail->Body    = "
            
            
            <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; color: #333;'>
                        <div style='width: 600px; margin: 40px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
                            <div style='text-align: center; color: #ff6a13; font-size: 36px; margin-bottom: 30px;'>hotel sriman palace</div>
                            
                            <h2>Dear $guest_name,</h2>
                            <p>Your booking status has been updated to <strong>$status</strong> for Booking ID: <strong>$booking_id</strong>.</p>
                            
                            <div style='text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0; color: #ffffff; background-color: #ff6a13; padding: 15px; border-radius: 5px;'>
                                Booking ID: {$booking_id}
                            </div>
                            <div style='font-size: 14px; color: #888; text-align: center; margin-top: 30px;'>
                                <p>If you have any questions, feel free to contact us:</p>
                                <p>Phone: +91 7978634893 | Email: <a href='mailto:hotel.bluesagarpuri@gmail.com' style='color: #ff6a13;'>hotel.bluesagarpuri@gmail.com</a></p>
                                <p>Address: Bidhaba Ashram Chaka, Bengali Market, Swargadwar, Puri, Odisha</p>
                            </div>
                        </div>
                    </body>
            
                
            ";

            $mail->send();
        } catch (Exception $e) {
            error_log("Error sending email: " . $mail->ErrorInfo);
        }
    } else {
        error_log("No email found for Booking ID: $booking_id");
    }
}
