<!DOCTYPE html>
<html lang="en">

<head>
    <?= require("./config/meta.php") ?>

    <style>
        /* General table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }



        th {
            background-color: #f4f4f4;
            /* Light background for header */
            font-weight: bold;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            /* Light border for table cells */
        }

        /* Icon and text alignment */
        .icon-text {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Space between icon and text */
            margin-bottom: 5px;
            /* Spacing between rows in a cell */
        }

        .icon-text i {
            color: #6c757d;
            /* Neutral icon color */
            font-size: 15px;
            ;
            /* Slightly larger icons */
        }

        /* Action buttons */
        .btn {
            padding: 5px 10px;
            /* Compact buttons */
            font-size: 0.9rem;
            /* Smaller text */
        }

        .btn-warning {
            color: #fff;
            background-color: #ffc107;
            border: none;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border: none;
        }

        .btn-warning:hover,
        .btn-danger:hover {
            opacity: 0.85;
            /* Hover effect */
        }

        /* Status icons */
        .text-success {
            color: #28a745;
        }

        /* Table row hover effect */
        tr:hover {
            background-color: #f9f9f9;
        }
    </style>

</head>

<body>

    <?= require("./config/header.php") ?>
    <?= require("./config/menu.php") ?>
    <?= require("./config/config.php") ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Booking Manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Booking</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->











        <?php

        // Default records per page
        $recordsPerPage = 3;

        // Set the current page based on the GET parameter, default to 1 if not set
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Get the date range filter if set
        $datefilter = isset($_GET['datefilter']) ? $_GET['datefilter'] : '';

        // Split the string into two dates
        $checkinDateFilter = '';
        $checkoutDateFilter = '';

        if ($datefilter) {
            $dates = explode(' - ', $datefilter);
            $checkinDateFilter = isset($dates[0]) ? date('Y-m-d', strtotime($dates[0])) : '';
            $checkoutDateFilter = isset($dates[1]) ? date('Y-m-d', strtotime($dates[1])) : '';
        }

        // Get other filters
        $bookingIdFilter = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
        $phoneFilter = isset($_GET['phone']) ? $_GET['phone'] : '';
        $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

        // Start building the query with basic filtering conditions
        $query = "SELECT * FROM bookings WHERE 1";

        // Apply filters if provided
        if ($checkinDateFilter && $checkoutDateFilter) {

            if ($checkinDateFilter != $checkoutDateFilter) {

                $query .= " AND (check_in_date <= '$checkoutDateFilter' AND check_out_date >= '$checkinDateFilter')";
            } else {

                $query .= " AND (check_in_date = '$checkoutDateFilter' OR check_out_date = '$checkinDateFilter')";
            }
        }
        if ($bookingIdFilter) {
            $query .= " AND booking_id LIKE '%$bookingIdFilter%'";
        }
        if ($phoneFilter) {
            $query .= " AND guest_number LIKE '%$phoneFilter%'";
        }
        if ($statusFilter) {
            $query .= " AND status = '$statusFilter'";
        }

        // Fetch the total records for pagination calculation
        $totalQuery = "SELECT COUNT(*) FROM bookings WHERE 1";

        // Append the filters to the total count query
        if ($checkinDateFilter && $checkoutDateFilter) {
            $totalQuery .= " AND (check_in_date <= '$checkoutDateFilter' AND check_out_date >= '$checkinDateFilter')";
        }
        if ($bookingIdFilter) {
            $totalQuery .= " AND booking_id LIKE '%$bookingIdFilter%'";
        }
        if ($phoneFilter) {
            $totalQuery .= " AND guest_number LIKE '%$phoneFilter%'";
        }
        if ($statusFilter) {
            $totalQuery .= " AND status = '$statusFilter'";
        }

        $totalResult = mysqli_query($conn, $totalQuery);
        $totalRecords = mysqli_fetch_array($totalResult)[0];
        $totalPages = ceil($totalRecords / $recordsPerPage);

        // Ensure current page is within range
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        // Calculate the starting record of the current page
        $startRecord = ($currentPage - 1) * $recordsPerPage;

        // Modify query to get data for the current page with filters
        $query .= " ORDER BY id DESC LIMIT $startRecord, $recordsPerPage";
        $result = mysqli_query($conn, $query);

        ?>




        <style>
            .card {
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                /* Soft, refined shadow */
                border: 1px solid #f1f1f1;
                /* Subtle border for a clean look */
            }

            .card-body {
                padding: 2rem;
                /* Increase padding for a more spacious feel */
                background-color: #ffffff;
            }
        </style>





        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">




                            <div class="d-flex justify-content-between align-items-center mb-3">


                                <h5 class="card-title mb-0">Booking List</h5>

                                <div style="gap: 10px; display: flex;">



                                    <form method="GET" action="" class="d-flex align-items-center " style="justify-content: flex-end;">
                                        <div class="row g-2">
                                            <!-- Check-In Date -->
                                            <div class="col-md-3">
                                                <input type="text" name="datefilter" id="datefilter" class="form-control form-control-sm" value="<?php echo isset($_GET['datefilter']) ? $_GET['datefilter'] : ''; ?>" autocomplete="off" placeholder="Check-In & Out Date">
                                            </div>

                                            <!-- Booking ID -->
                                            <div class="col-md-2">
                                                <input type="text" name="booking_id" id="booking_id" class="form-control form-control-sm" value="<?php echo isset($_GET['booking_id']) ? $_GET['booking_id'] : ''; ?>" placeholder="Booking ID">
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="col-md-2">
                                                <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="<?php echo isset($_GET['phone']) ? $_GET['phone'] : ''; ?>" placeholder="Phone Number">
                                            </div>

                                            <!-- Status Dropdown -->
                                            <div class="col-md-3">
                                                <select name="status" id="status" class="form-select form-select-sm">
                                                    <option value="">All Statuses</option>
                                                    <option value="confirmed" <?php echo (isset($_GET['status']) && $_GET['status'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                                    <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="check-in" <?php echo (isset($_GET['status']) && $_GET['status'] == 'check-in') ? 'selected' : ''; ?>>Check-In</option>
                                                    <option value="check-out" <?php echo (isset($_GET['status']) && $_GET['status'] == 'check-out') ? 'selected' : ''; ?>>Check-Out</option>
                                                    <option value="canceled" <?php echo (isset($_GET['status']) && $_GET['status'] == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                                </select>
                                            </div>

                                            <!-- Filter Button -->
                                            <div class="col-md-2 text-end">
                                                <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                                            </div>
                                        </div>
                                    </form>

                                    <?php if (isset($_GET['datefilter']) || isset($_GET['booking_id']) || isset($_GET['phone']) || isset($_GET['status'])) { ?>



                                        <?php
                                        // Construct the query string with available filters
                                        $queryParams = [];
                                        if (isset($_GET['datefilter'])) {
                                            $queryParams['datefilter'] = $_GET['datefilter'];
                                        }
                                        if (isset($_GET['booking_id'])) {
                                            $queryParams['booking_id'] = $_GET['booking_id'];
                                        }
                                        if (isset($_GET['phone'])) {
                                            $queryParams['phone'] = $_GET['phone'];
                                        }
                                        if (isset($_GET['status'])) {
                                            $queryParams['status'] = $_GET['status'];
                                        }

                                        // Build the query string
                                        $queryString = http_build_query($queryParams);

                                        // Define the download URL
                                        $downloadUrl = "./process/download_excel.php" . ($queryString ? "?$queryString" : "");
                                        ?>

                                        <a href="<?php echo htmlspecialchars($downloadUrl); ?>"
                                            class="btn btn-success d-flex align-items-center justify-content-center"
                                            style="border-radius: 4px;"
                                            data-bs-toggle="tooltip"
                                            title="Download Excel Report">
                                            <i class="bi bi-file-earmark-arrow-down" style="font-size: 20px;"></i>
                                        </a>


                                    <?php } ?>


                                </div>
                            </div>








                            <table class="table table-bordered table-hover">
                                <thead class="table">
                                    <tr>
                                        <th>Booking Details</th>
                                        <th>Guest Details</th>
                                        <th>Stay Details</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    // Check if there are results
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through all bookings
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $bookingId = $row['id'];
                                            $bookingId_2 = $row['booking_id'];
                                            $platform = $row['booking_platform'];
                                            $guestName = $row['guest_name'];
                                            $phone = $row['guest_number'];
                                            $guests = $row['total_guests'];
                                            $extra_gust = $row['extra_gust'];
                                            $rooms = $row['total_rooms'];
                                            $checkInDate = $row['check_in_date'];
                                            $checkOutDate = $row['check_out_date'];
                                            $amount = $row['amount'];
                                            $payment_amount = $row['payment_amount'];
                                            $status = $row['status'];
                                            $room_no = $row['room_no'];
                                            $gst_provided = $row['gst_provided'];
                                            $days = (strtotime($checkOutDate) - strtotime($checkInDate)) / (60 * 60 * 24);
                                            $note = "NOTE : " . $row['note'];


                                            $room_plan = $row['room_plan'];
                                            $booking_date = $row['date'];



                                            $rest_amount = $amount - $payment_amount;

                                            // Determine if the payment is full
                                            $status_payment = ($payment_amount == $amount) ? "<i class='bi bi-check-circle-fill text-success'></i> Full Payment" : "";

                                            $roomId = $row['room_type'];  // room_type field stores the room ID
                                            $roomSql = "SELECT name FROM rooms WHERE id = ?";
                                            $roomStmt = $conn->prepare($roomSql);
                                            $roomStmt->bind_param("i", $roomId);
                                            $roomStmt->execute();
                                            $roomResult = $roomStmt->get_result();

                                            // Get the room name
                                            $roomType  = '';
                                            if ($roomResult->num_rows > 0) {
                                                $roomData = $roomResult->fetch_assoc();
                                                $roomType  = $roomData['name'];  // room name from rooms table
                                            }
                                    ?>


                                            <tr>
                                                <td>
                                                    <div class="icon-text">
                                                        <i class="bi bi-bookmark-fill"></i> <strong>ID:</strong> <?php echo $bookingId_2; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-calendar2-check-fill"></i> <strong>Booking Date:</strong> <?php echo $booking_date; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-box"></i> <strong>Platform:</strong> <?php echo $platform; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-house-door"></i> <strong>Room No:</strong> <?php echo $room_no; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="icon-text">
                                                        <i class="bi bi-person-fill"></i> <strong>Name:</strong> <?php echo $guestName; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-telephone-fill"></i> <strong>Phone:</strong> <?php echo $phone; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-people-fill"></i> <strong>Guests:</strong> <?php echo $guests; ?> × <?php echo $extra_gust; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-building"></i> <strong>Room Type:</strong> <?php echo $roomType; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-door-closed"></i> <strong>Rooms:</strong> <?php echo $rooms; ?> (<?php echo $room_plan; ?>)
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="icon-text">
                                                        <i class="bi bi-calendar2-check-fill"></i> <strong>Check-In:</strong> <?php echo $checkInDate; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-calendar2-x-fill"></i> <strong>Check-Out:</strong> <?php echo $checkOutDate; ?>
                                                    </div>
                                                    <div class="icon-text">
                                                        <i class="bi bi-clock"></i> <strong>Days:</strong> <?php echo $days; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="icon-text">
                                                        Total Amount: <strong><i class="bi bi-currency-rupee"></i><?php echo $amount; ?></strong>
                                                    </div>

                                                    <?php if ($payment_amount < $amount) { ?>
                                                        <div class="icon-text">
                                                            Paying Amount: <strong><i class="bi bi-currency-rupee"></i><?php echo $payment_amount; ?></strong>
                                                        </div>
                                                        <div class="icon-text">
                                                            Rest Amount: <strong><i class="bi bi-currency-rupee"></i><?php echo $rest_amount; ?></strong>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="icon-text">
                                                        <i class="bi bi-receipt"></i> <strong>GST:</strong> 
                                                        <div class="form-check form-switch ms-2">
                                                            <input class="form-check-input gst-toggle" type="checkbox" role="switch" 
                                                                data-booking-id="<?php echo $bookingId; ?>" 
                                                                <?php echo isset($row['gst_provided']) && $row['gst_provided'] == 1 ? 'checked' : ''; ?>
                                                                id="gstToggle<?php echo $bookingId; ?>">
                                                            <label class="form-check-label" for="gstToggle<?php echo $bookingId; ?>">
                                                                <span class="gst-status-<?php echo $bookingId; ?> <?php echo isset($row['gst_provided']) && $row['gst_provided'] == 1 ? 'text-success' : 'text-warning'; ?>">
                                                                    <?php echo isset($row['gst_provided']) && $row['gst_provided'] == 1 ? 'Yes' : 'No'; ?>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="icon-text">
                                                        <strong><?php echo $status_payment; ?></strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="icon-text">
                                                        <?php if ($status == 'confirmed'): ?>
                                                            <i class="bi bi-check-circle-fill text-success"></i> <strong>Confirmed</strong>
                                                        <?php elseif ($status == 'pending'): ?>
                                                            <i class="bi bi-clock-fill text-warning"></i> <strong>Pending</strong>
                                                        <?php elseif ($status == 'check-in'): ?>
                                                            <i class="bi bi-house-door-fill text-info"></i> <strong>Check-In</strong>
                                                        <?php elseif ($status == 'check-out'): ?>
                                                            <i class="bi bi-door-open-fill text-secondary"></i> <strong>Check-Out</strong>
                                                        <?php elseif ($status == 'canceled'): ?>
                                                            <i class="bi bi-x-circle-fill text-danger"></i> <strong>Canceled</strong>
                                                        <?php endif; ?>
                                                    </div>
                                                    <br>
                                                    <?php echo $note ?>
                                                </td>
                                                <td class="text-center">
                                                    <div style="display: flex; flex-direction: column; gap: 10px; align-items: center;">
                                                        <a href="#editModal<?php echo $bookingId; ?>"
                                                            class="btn btn-sm btn-warning me-1"
                                                            title="Edit"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal<?php echo $bookingId; ?>"
                                                            style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #FF4081; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
                                                            <i class="bi bi-pencil-fill" style="margin-right: 5px;"></i> Add Note
                                                        </a>
                                                        <!-- Other action buttons here... -->

                                                        <!-- Check-In Button for Confirmed Status -->
                                                        <?php if ($status == 'confirmed'): ?>
                                                            <a href="javascript:void(0);" class="btn btn-sm action-btn"
                                                                data-action="check-in"
                                                                data-id="<?php echo $bookingId; ?>"
                                                                data-booking_id="<?php echo $bookingId_2; ?>"
                                                                style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #4CAF50; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
                                                                <i class="bi bi-check-circle-fill" style="margin-right: 5px;"></i> Check-In
                                                            </a>

                                                            <a href="javascript:void(0);" class="btn btn-sm action-btn"
                                                                data-action="canceled"
                                                                data-id="<?php echo $bookingId; ?>"
                                                                data-booking_id="<?php echo $bookingId_2; ?>"
                                                                style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #f32121; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
                                                                <i class="bi bi-x-circle-fill" style="margin-right: 5px;"></i> Cancel
                                                            </a>


                                                        <?php elseif ($status == 'pending'): ?>
                                                            <a href="javascript:void(0);" class="btn btn-sm action-btn"
                                                                data-action="confirm"
                                                                data-id="<?php echo $bookingId; ?>"
                                                                data-booking_id="<?php echo $bookingId_2; ?>"
                                                                style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #FFC107; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
                                                                <i class="bi bi-hourglass-split" style="margin-right: 5px;"></i> Confirmed
                                                            </a>

                                                            <a href="javascript:void(0);" class="btn btn-sm action-btn"
                                                                data-action="canceled"
                                                                data-id="<?php echo $bookingId; ?>"
                                                                data-booking_id="<?php echo $bookingId_2; ?>"
                                                                style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #f32121; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
                                                                <i class="bi bi-x-circle-fill" style="margin-right: 5px;"></i> Cancel
                                                            </a>


                                                        <?php elseif ($status == 'check-in'): ?>
                                                            <a href="javascript:void(0);" class="btn btn-sm action-btn"
                                                                data-action="check-out"
                                                                data-id="<?php echo $bookingId; ?>"
                                                                data-booking_id="<?php echo $bookingId_2; ?>"
                                                                style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #2196F3; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
                                                                <i class="bi bi-door-open-fill" style="margin-right: 5px;"></i> Check-Out
                                                            </a>

                                                            <a href="./pdf/grc?id=<?= $bookingId ?>" target="_blank" style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #0d6efd; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);"> <i class="bi bi-printer" style="margin-right: 5px;"></i>
                                                                GRC </a>
                                                        <?php endif; ?>

                                                        <a href="./pdf/?id=<?= $bookingId ?>" target="_blank" style="text-decoration: none; padding: 5px 9px; font-weight: bold; border-radius: 5px; background-color: #068583; color: white; display: inline-flex; align-items: center; transition: background-color 0.3s ease; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);"> <i class="bi bi-printer" style="margin-right: 5px;"></i>
                                                            Invoice </a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editModal<?php echo $bookingId; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $bookingId; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel<?php echo $bookingId; ?>">Edit Booking - ID: <?php echo $bookingId_2; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form action="./process/add_booking" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?php echo $bookingId; ?>">
                                                                <div class="mb-3">
                                                                    <label for="note<?php echo $bookingId; ?>" class="form-label">Add Note</label>
                                                                    <textarea name="note" id="note<?php echo $bookingId; ?>" class="form-control" rows="10"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Add Note</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No bookings found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="pagination">
                                <?php
                                // Get the 'show_all' parameter if available, default is empty string
                                $show_all = isset($_GET['show_all']) ? $_GET['show_all'] : '';

                                // Show first page and previous page if needed
                                if ($currentPage > 1) {
                                    echo "<a href='?page=1' class='page-link'>1</a> ";
                                    echo "<a href='?page=" . ($currentPage - 1) . "' class='page-link'>Previous</a> ";
                                }

                                // Show pages around the current page
                                $pageRange = 2; // Number of pages to show before and after the current page
                                $startPage = max(1, $currentPage - $pageRange);
                                $endPage = min($totalPages, $currentPage + $pageRange);

                                for ($page = $startPage; $page <= $endPage; $page++) {
                                    // Check if the current page is the one in the loop
                                    if ($page == $currentPage) {
                                        echo "<a href='?page=$page' class='page-link active'>$page</a> ";
                                    } else {
                                        echo "<a href='?page=$page' class='page-link'>$page</a> ";
                                    }
                                }

                                // Show last page and next page if needed
                                if ($currentPage < $totalPages) {
                                    echo "<a href='?page=" . ($currentPage + 1) . "' class='page-link'>Next</a> ";
                                    echo "<a href='?page=$totalPages' class='page-link'>$totalPages</a>";
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>






    </main><!-- End #main -->
    
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); color: white; font-size: 24px; display: flex; align-items: center; justify-content: center; z-index: 9999;">
    <div class="spinner" style="border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 50px; height: 50px; animation: spin 2s linear infinite;"></div>
</div>

<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>


    <?= require("./config/footer.php") ?>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script>
    
    $('#loadingOverlay').hide();
$(document).ready(function() {
    // Attach click event listener to all buttons with the class `action-btn`
    $('.action-btn').click(function() {
        var action = $(this).data('action');
        var bookingId = $(this).data('id');
        var booking_id = $(this).data('booking_id');

        // Prepare data for AJAX request
        var data = {
            action: action,
            id: bookingId,
            booking_id: booking_id 
        };

        // Disable all buttons and show loading screen
        $(".action-btn").prop("disabled", true);  // Disable all buttons
        $('#loadingOverlay').show();  // Show loading screen

        // For the note action, if the button has a note, add that as well
        if (action === 'check-out' || action === 'confirm') {
            // Prompt for a note
            data['note'] = prompt("Please enter payment amount:");

            // Ensure the user entered a note
            if (!data['note']) {
                alert("Amount is required. Please enter a payment amount.");
                $(".action-btn").prop("disabled", false);  // Re-enable buttons
                $('#loadingOverlay').hide();  // Hide loading screen
                return; // Cancel if no note entered
            }

            var note = data['note'];
            // Confirm if the user is sure about the payment amount
            var isSure = confirm("Are you sure your payment amount is ₹" + note);
            if (!isSure) {
                alert("Please check your payment amount.");
                $(".action-btn").prop("disabled", false);  // Re-enable buttons
                $('#loadingOverlay').hide();  // Hide loading screen
                return; // Cancel if they are not sure
            }
        } else if ((action === 'canceled')) {
            if (!confirm("Are you sure you want to Cancel ?")) return;
            data['note'] = 0;
        } else {
            if (!confirm("Are you sure you want to check in?")) return;
            data['note'] = prompt("Please enter Room No:");

            // Ensure the user entered a note
            if (!data['note']) {
                alert("Room No is Required. Please enter a Room No.");
                $(".action-btn").prop("disabled", false);  // Re-enable buttons
                $('#loadingOverlay').hide();  // Hide loading screen
                return; // Cancel if no note entered
            }
        }

        // Send the AJAX request
        $.ajax({
            url: "./process/booking_action.php", // Replace with the correct script URL
            method: "GET",
            data: data,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert("Booking Status: " + res.message);  // Show success message

                    location.reload();

                } else {
                    alert("Error: " + res.message);  // Show error message
                }
            },
            error: function() {
                alert("Something went wrong!");
            },
            complete: function() {
                // After request is completed (whether success or failure)
                $(".action-btn").prop("disabled", false);  // Re-enable all buttons
                $('#loadingOverlay').hide();  // Hide loading screen
            }

            
        });
    });
});


</script>




    <script>
        $(document).ready(function() {
            // Attach a click event to the delete button
            $('#delete-btn').on('click', function(e) {
                // Prevent the default anchor action (i.e., redirect)
                e.preventDefault();

                // Get the link (URL) for deletion
                var link = $(this).attr('href');

                // Show a confirmation dialog
                var confirmDelete = confirm("Are you sure you want to delete this record?");

                // If the user confirms, proceed with deletion
                if (confirmDelete) {
                    // Use AJAX to send the delete request
                    $.ajax({
                        type: 'GET',
                        url: link, // The link includes the necessary parameters like ID, table_name, etc.
                        success: function(response) {
                            // If deletion is successful, redirect to the specified link (e.g., branch_manager)
                            if (response === 'success') {
                                alert("Record deleted successfully!");
                                window.location.href = './blog'; // Redirect to the blog page
                            } else {
                                alert("Error deleting record.");
                            }
                        },
                        error: function(xhr, status, error) {
                            alert("Error: " + error);
                        }
                    });
                }
            });
        });
        
        // Handle GST toggle switches
        $('.gst-toggle').change(function() {
            var bookingId = $(this).data('booking-id');
            var isChecked = $(this).prop('checked');
            var newStatus = isChecked ? 1 : 0;
            var statusText = isChecked ? 'Yes' : 'No';
            var statusClass = isChecked ? 'text-success' : 'text-warning';
            
            // Show confirmation dialog
            var confirmMessage = isChecked ? 
                'Are you sure you want to mark GST as Yes?' : 
                'Are you sure you want to mark GST as No?';
                
            var confirmToggle = confirm(confirmMessage);
            
            if (confirmToggle) {
                // Show loading overlay
                $('#loadingOverlay').show();
                
                // Send AJAX request to update GST status
                $.ajax({
                    type: 'POST',
                    url: './process/update_gst_status.php',
                    data: {
                        booking_id: bookingId,
                        gst_status: newStatus
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Update the status text and class
                            $('.gst-status-' + bookingId)
                                .text(statusText)
                                .removeClass('text-success text-warning')
                                .addClass(statusClass);
                        } else {
                            // If update failed, revert the toggle
                            alert('Failed to update GST status: ' + response.message);
                            $(this).prop('checked', !isChecked);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error updating GST status: ' + error);
                        $(this).prop('checked', !isChecked);
                    },
                    complete: function() {
                        // Hide loading overlay
                        $('#loadingOverlay').hide();
                    }
                });
            } else {
                // User canceled, revert the toggle
                $(this).prop('checked', !isChecked);
            }
        });
    </script>




</body>

</html>