<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Registration Card</title>

    <style>
        /* styles.css */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .registration-card {
            width: 210mm;
            height: 297mm;
            margin: 20px auto;
            padding: 15mm;
            border: 2px solid #ff0000;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ff0000;
            padding-bottom: 10px;
        }

        .hotel-info h1 {
            font-size: 20px;
            color: #ff0000;
            margin: 0;
        }

        .hotel-info p {
            margin: 3px 0;
            font-size: 12px;
            color: #333;
        }

        .hotel-info a {
            text-decoration: none;
            color: #ff0000;
        }

        .card-number {
            font-size: 14px;
            color: #333;
        }

        h2 {
            text-align: center;
            font-size: 18px;
            margin: 10px 0;
            color: #333;
            text-decoration: underline;
        }

        form {
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row .form-group {
            flex: 1;
            margin-right: 15px;
        }

        label {
            display: block;
            font-size: 12px;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 12px;
            color: #333;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            width: auto;
            margin-right: 5px;
        }

        .signatures {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #333;
        }
    </style>

</head>


<?php

require("../config/config.php");

// Check if ID is set in URL
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = $_GET['id'];

    // Fetch booking details
    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookings = $result->fetch_assoc();

    // Check if booking exists
    if (!$bookings) {
        echo "Booking not found.";
        exit();
    }

    // Extract room details
    if (isset($bookings["room_type"])) {
        $room_id = $bookings["room_type"];
    } else {
        echo "Room type not found.";
        exit();
    }

    $query = "SELECT * FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();

    // Check if room exists
    if (!$room) {
        echo "Room not found.";
        exit();
    }

    // Fetch room plan from booking
    $room_plan = isset($bookings["room_plan"]) ? $bookings["room_plan"] : '';

    // Calculate totals
    $roomName = isset($room["name"]) ? $room["name"] : 'Unknown';

    $roomPrice = isset($room["price"]) ? $room["price"] : 0;
    $extraGuestPrice = isset($room["extra_adult_price"]) ? $room["extra_adult_price"] : 0;

    // Fetch food plan costs from room
    $food_plan_cp = isset($room["food_plan_cp"]) ? $room["food_plan_cp"] : 0;
    $food_plan_map = isset($room["food_plan_map"]) ? $room["food_plan_map"] : 0;
    $food_plan_ap = isset($room["food_plan_ap"]) ? $room["food_plan_ap"] : 0;

    // Extract check-in and check-out dates
    $check_in_date = isset($bookings["check_in_date"]) ? $bookings["check_in_date"] : '';
    $check_out_date = isset($bookings["check_out_date"]) ? $bookings["check_out_date"] : '';

    // Calculate the number of nights
    $check_in = new DateTime($check_in_date);
    $check_out = new DateTime($check_out_date);
    $interval = $check_in->diff($check_out);
    $nights = $interval->days;

    // Ensure at least 1 night is calculated
    if ($nights <= 0) {
        $nights = 1;
    }

    $totalRooms = isset($bookings["total_rooms"]) ? $bookings["total_rooms"] : 1;
    $totalGusts = isset($bookings["total_guests"]) ? $bookings["total_guests"] : 0;
    $extraGuests = isset($bookings["extra_gust"]) ? $bookings["extra_gust"] : 0;

    $total_gust = $extraGuests + $totalGusts;

    // Room subtotal (base price)
    $roomSubtotal = $roomPrice * $totalRooms * $nights;
    // Extra guest subtotal
    $extraGuestsSubtotal = $extraGuestPrice * $extraGuests * $nights;

    // Adjust pricing based on room plan (Food Plan Calculation)
    $foodPlanCost = 0;
    $food_price = 0;

    if ($room_plan == "CP") {
        // CP plan: Cost per person
        $food_price = $food_plan_cp;
        $foodPlanCost = $food_plan_cp * $total_gust * $nights;
    } elseif ($room_plan == "MAP") {
        // MAP plan: Modified American Plan
        $food_price = $food_plan_map;
        $foodPlanCost = $food_plan_map * $total_gust * $nights; // Assuming it's the same cost for the entire stay
    } elseif ($room_plan == "AP") {
        // AP plan: American Plan
        $food_price = $food_plan_ap;
        $foodPlanCost = $food_plan_ap * $total_gust * $nights; // Assuming it's the same cost for the entire stay
    } elseif ($room_plan == "EP") {
        // EP plan: No meals included
        $food_price = 0;
        $foodPlanCost = 0;
    }

    // Discount applied (offered price)
    $off_price = isset($bookings["amount"]) ? $bookings["amount"] : 0;

    $totalBeforeOff = $roomSubtotal + $extraGuestsSubtotal + $foodPlanCost;

    $discountPercentage = (($totalBeforeOff - $off_price) / $totalBeforeOff) * 100;

    $discountPercentageFormatted = number_format($discountPercentage, 2);

    $totalAfterDiscount = $off_price;

    // Calculate taxes
    $cgst = $totalAfterDiscount * 0.10; // 10% CGST
    $sgst = $totalAfterDiscount * 0.10; // 10% SGST

    // Total price after tax
    $totalWithTax = $totalAfterDiscount + $cgst + $sgst;
} else {
    echo "Invalid booking ID.";
    exit();
}
?>


<body>
    <div class="registration-card">
        <header>
            <div class="hotel-info">
                <h1>hotel sriman palace</h1>
                <p>Krishna Sea Sight, Baliapanda, Puri-752001</p>
                <p>Odisha, Mob.: 7205199109</p>
                <p><a href="http://www.hotelanjaliholidays-com-849613.hostingersite.com" target="_blank">www.hotelanjaliholidays-com-849613.hostingersite.com</a></p>
            </div>
            <div class="card-number">
                <p>GRC No.: <span><?= $bookings['id'] ?></span></p>
            </div>
        </header>
        <h2>GUEST REGISTRATION CARD</h2>
        <form>
            <div class="form-group">
                <label>Guest Name / Company Name:</label>
                <input type="text" name="guest-name" value="<?php echo isset($bookings['guest_name']) ? htmlspecialchars($bookings['guest_name']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" value="<?php echo isset($bookings['address']) ? htmlspecialchars($bookings['address']) : ''; ?>">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>City:</label>
                    <input type="text" name="city" value="<?php echo isset($bookings['city']) ? htmlspecialchars($bookings['city']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Country:</label>
                    <input type="text" name="country" value="<?php echo isset($bookings['country']) ? htmlspecialchars($bookings['country']) : ''; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Contact:</label>
                    <input type="text" name="contact" value="<?php echo isset($bookings['guest_number']) ? htmlspecialchars($bookings['guest_number']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo isset($bookings['email']) ? htmlspecialchars($bookings['email']) : ''; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Date of Birth:</label>
                    <input type="text" name="dob" value="<?php echo isset($bookings['dob']) ? htmlspecialchars($bookings['dob']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Check-in:</label>
                    <input type="text" name="check-in" value="<?php echo isset($check_in_date) ? date('d-m-Y', strtotime($check_in_date)) : ''; ?>">
                    <label>Check-out:</label>
                    <input type="text" name="check-out" value="<?php echo isset($check_out_date) ? date('d-m-Y', strtotime($check_out_date)) : ''; ?>">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Room No.:</label>
                    <input type="text" name="room-no" value="<?php echo isset($bookings['room_no']) ? htmlspecialchars($bookings['room_no']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label>No. of Pax:</label>
                    <input type="text" name="pax" value="<?php echo isset($total_gust) ? htmlspecialchars($total_gust) : ''; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Room Tariff:</label>
                    <input type="text" name="tariff" value="<?php echo isset($roomName) ? htmlspecialchars($roomName) : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Adult:</label>
                    <input type="text" name="adult" value="<?php echo isset($bookings['total_guests']) ? htmlspecialchars($bookings['total_guests']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Extra Adult:</label>
                    <input type="text" name="child" value="<?php echo isset($bookings['extra_gust']) ? htmlspecialchars($bookings['extra_gust']) : ''; ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Plan:</label>
                <label><input type="checkbox" name="plan" value="ap" <?php echo (isset($room_plan) && $room_plan == "AP") ? "checked" : ""; ?>> AP Plan</label>
                <label><input type="checkbox" name="plan" value="cp" <?php echo (isset($room_plan) && $room_plan == "CP") ? "checked" : ""; ?>> CP Plan</label>
                <label><input type="checkbox" name="plan" value="map" <?php echo (isset($room_plan) && $room_plan == "MAP") ? "checked" : ""; ?>> MAP Plan</label>
                <label><input type="checkbox" name="plan" value="ep" <?php echo (isset($room_plan) && $room_plan == "EP" || $room_plan == "") ? "checked" : ""; ?>> EP Plan</label>
            </div>
            <div class="signatures">
                <p>Guest Sign: ___________________</p>
                <p>FO Sign: ___________________</p>
            </div>
        </form>


    </div>
</body>

</html>