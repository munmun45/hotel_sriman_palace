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
  $room_id = $bookings["room_type"];
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
  $room_plan = $bookings["room_plan"];

  // Calculate totals
  $roomName = $room["name"];

  $roomPrice = $room["price"];
  $extraGuestPrice = $room["extra_adult_price"];

  // Fetch food plan costs from room
  $food_plan_cp = $room["food_plan_cp"];
  $food_plan_map = $room["food_plan_map"];
  $food_plan_ap = $room["food_plan_ap"];

  // Extract check-in and check-out dates
  $check_in_date = $bookings["check_in_date"];
  $check_out_date = $bookings["check_out_date"];

  // Calculate the number of nights
  $check_in = new DateTime($check_in_date);
  $check_out = new DateTime($check_out_date);
  $interval = $check_in->diff($check_out);
  $nights = $interval->days;

  // Ensure at least 1 night is calculated
  if ($nights <= 0) {
    $nights = 1;
  }

  $totalRooms = $bookings["total_rooms"];
  $totalGusts = $bookings["total_guests"];
  $extraGuests = $bookings["extra_gust"];

  $total_gust = $extraGuests + $totalGusts;



  // Base total before tax


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



  $roomSubtotal = $roomPrice * $totalRooms * $nights;

  $roomSubtotal_cgst = $roomSubtotal * 0.06; // 6% CGST
  $roomSubtotal_sgst = $roomSubtotal * 0.06; // 6% SGST

  $roomTotalWithTax = $roomSubtotal + $roomSubtotal_cgst + $roomSubtotal_sgst;



  $extraGuestsSubtotal = $extraGuestPrice * $extraGuests * $nights;





  $foodPlanCost_cgst = $foodPlanCost * 0.025; // 2.5% CGST
  $foodPlanCost_sgst = $foodPlanCost * 0.025; // 2.5% SGST

  $foodPlanCostWithTax = $foodPlanCost + $foodPlanCost_cgst + $foodPlanCost_sgst;



  $netTotal = $roomTotalWithTax + $extraGuestsSubtotal + $foodPlanCostWithTax;



  $totalWithTax = $netTotal;
} else {
  echo "Invalid booking ID.";
  exit();
}
?>










<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $bookings["booking_id"] ?></title>
  <link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>

<body>
  <div style="max-width: 1000px; margin: auto;">
    <div class="py-4">
      <div class="px-14 py-6">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-full align-top">
                <div style="display: flex;">
                  <img src="../../img/logo.png" class="h-12" />
                  <img src="../../img/logo_2.png" class="h-12" />
                </div>
              </td>

              <td class="align-top">
                <div class="text-sm">
                  <table class="border-collapse border-spacing-0">
                    <tbody>
                      <tr>
                        <td class="border-r pr-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Date</p>
                            <p class="whitespace-nowrap font-bold text-main text-right"><?= date('d-m-Y', strtotime($bookings["check_out_date"]))  ?></p>
                          </div>
                        </td>
                        <td class="pl-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Invoice #</p>
                            <p class="whitespace-nowrap font-bold text-main text-right"><?= $bookings["booking_id"] ?></p>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-slate-100 px-14 py-6 text-sm">
        <table class="w-full border-collapse border-spacing-0">
          <tbody style="font-family: Arial, sans-serif; color: #333;">
            <tr>
              <td style="width: 50%; vertical-align: top; padding: 10px; border-right: 1px solid #ddd;">
                <div style="font-size: 14px; line-height: 1.6;">
                  <p style="font-weight: bold; font-size: 16px; margin-bottom: 10px; color: #2a2a2a;">hotel sriman palace:</p>
                  <p style="margin: 0; color: #555;">Number: <span style="color: #000;">23456789</span></p>
                  <p style="margin: 0; color: #555;">VAT: <span style="color: #000;">23456789</span></p>
                  <p style="margin: 0; color: #555;">Address: <span style="color: #000;">6622 Abshire Mills</span></p>
                  <p style="margin: 0; color: #555;">City: <span style="color: #000;">Port Orlofurt, 05820</span></p>
                  <p style="margin: 0; color: #555;">Country: <span style="color: #000;">United States</span></p>
                </div>
              </td>
              <td style="width: 50%; vertical-align: top; padding: 10px; text-align: right;">
                <div style="font-size: 14px; line-height: 1.6;">
                  <p style="font-weight: bold; font-size: 16px; margin-bottom: 10px; color: #2a2a2a;">GUEST DETAILS:</p>
                  <p style="margin: 0; color: #555;">Name: <span style="color: #000;"><?= $bookings["guest_name"] ?></span></p>
                  <p style="margin: 0; color: #555;">Check-In: <span style="color: #000;"><?= $bookings["check_in_date"] ?></span></p>
                  <p style="margin: 0; color: #555;">Check-Out: <span style="color: #000;"><?= $bookings["check_out_date"] ?></span></p>
                  <p style="margin: 0; color: #555;">Booking ID: <span style="color: #000;"><?= $bookings["booking_id"] ?></span></p>
                  <p style="margin: 0; color: #555;">Total Room: <span style="color: #000;"><?= $bookings["total_rooms"] ?> - <?= $bookings["room_plan"] ?></span></p>
                  <p style="margin: 0; color: #555;">Total Adult: <span style="color: #000;"><?= $bookings["total_guests"] ?>×<?= $bookings["extra_gust"] ?></span></p>
                  <p style="margin: 0; color: #555;">Room No: <span style="color: #000;"><?= $bookings["room_no"] ?></span></p>
                </div>
              </td>
            </tr>
          </tbody>

        </table>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <table class="w-full border-collapse border-spacing-0">
          <thead>
            <tr>
              <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">#</td>
              <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Room Service Details</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Subtotal (₹)</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">CGST (6%)</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">SGST (6%)</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Total (₹)</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border-b py-3 pl-3">1.</td>
              <td class="border-b py-3 pl-2">

                <p style="margin-bottom: 10px;"><?= $roomName ?></p>
                <p><?= $totalRooms ?> Rooms × ₹<?= $roomPrice ?> × <?= $nights ?> Night</p>

              </td>
              <td class="border-b py-3 pl-2 text-right">₹<?= $roomSubtotal ?>.00</td>
              <td class="border-b py-3 pl-2 text-right">₹<?= $roomSubtotal_cgst ?>.00</td>
              <td class="border-b py-3 pl-2 text-right">₹<?= $roomSubtotal_sgst ?>.00</td>
              <td class="border-b py-3 pl-2 pr-3 text-right">₹<?= $roomTotalWithTax ?>.00</td>
            </tr>

            <tr>
              <td class="border-b py-3 pl-3">2.</td>
              <td class="border-b py-3 pl-2">

                <p style="margin-bottom: 10px;">Extra Adult</p>
                <p><?= $extraGuests ?> Extra × ₹<?= $extraGuestPrice ?> × <?= $nights ?> Night</p>

              </td>
              <td class="border-b py-3 pl-2 text-right">₹<?= $extraGuestsSubtotal ?>.00</td>
              <td class="border-b py-3 pl-2 text-right"></td>
              <td class="border-b py-3 pl-2 text-right"></td>
              <td class="border-b py-3 pl-2 pr-3 text-right">₹<?= $extraGuestsSubtotal ?>.00 </td>
            </tr>





          </tbody>



          <thead>
            <tr>
              <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main"></td>
              <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main" style="padding-top: 30px;">Food Service Details</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main" style="padding-top: 30px;">Subtotal (₹)</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main" style="padding-top: 30px;">CGST (2.5%)</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main" style="padding-top: 30px;">SGST (2.5%)</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main" style="padding-top: 30px;"></td>
            </tr>
          </thead>

          <tbody>


            <tr>
              <td class="border-b py-3 pl-3">3.</td>
              <td class="border-b py-3 pl-2">

                <p style="margin-bottom: 10px;">Food Plan (<?= $room_plan ?>)</p>
                <p>Total <?= $total_gust ?> Adults × ₹<?= $food_price ?> × <?= $nights ?> Night</p>

              </td>
              <td class="border-b py-3 pl-2 text-right">₹<?= $foodPlanCost ?></td>
              <td class="border-b py-3 pl-2 text-right">₹<?= $foodPlanCost_cgst ?>.00</td>
              <td class="border-b py-3 pl-2 text-right">₹<?= $foodPlanCost_sgst ?>.00</td>
              <td class="border-b py-3 pl-2 pr-3 text-right">₹<?= $foodPlanCostWithTax ?>.00 </td>
            </tr>

            <tr>
              <td colspan="7">
                <table class="w-full border-collapse border-spacing-0">
                  <tbody>
                    <tr>
                      <td class="w-full"></td>
                      <td>
                        <table class="w-full border-collapse border-spacing-0">
                          <tbody>

                            <tr>
                              <td class="border-b p-3">
                                <div class="whitespace-nowrap text-slate-400">Net total:</div>
                              </td>
                              <td class="border-b p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-main">₹<?= $netTotal ?>.00</div>
                              </td>
                            </tr>




                            <tr>
                              <td class="bg-main p-3">
                                <div class="whitespace-nowrap font-bold text-white">Total:</div>
                              </td>
                              <td class="bg-main p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-white">₹<?= $totalWithTax ?></div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="px-14 text-sm text-neutral-700">
        <p class="text-main font-bold">PAYMENT DETAILS</p>
        <p>Banks of Banks</p>
        <p>Bank/Sort Code: 1234567</p>
        <p>Account Number: 123456678</p>
        <p>Payment Reference: BRA-00335</p>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <p class="text-main font-bold">Notes</p>
        <p class="italic">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries
          for previewing layouts and visual mockups.</p>
        </dvi>

        <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
          Supplier Company
          <span class="text-slate-300 px-2">|</span>
          info@company.com
          <span class="text-slate-300 px-2">|</span>
          +1-202-555-0106
        </footer>
      </div>
    </div>
</body>

</html>