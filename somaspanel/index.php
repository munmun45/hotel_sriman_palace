<!DOCTYPE html>
<html lang="en">

<head>

  <?= require("./config/meta.php") ?>

</head>

<body>

  <?= require("./config/header.php") ?>
  <?= require("./config/menu.php") ?>







  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->









    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">



            <?php
            // Get today's date
            $today = date('Y-m-d');

            // Query to count total check-ins and pending check-ins, excluding canceled status
            $checkInQuery = "
SELECT 
    COUNT(*) AS total_check_in, 
    SUM(CASE WHEN check_in_status = 'pending' THEN 1 ELSE 0 END) AS pending_check_in 
FROM bookings 
WHERE check_in_date = ? 
  AND status != 'canceled'"; // Exclude canceled bookings

            $checkInStmt = $conn->prepare($checkInQuery);
            $checkInStmt->bind_param("s", $today);
            $checkInStmt->execute();
            $checkInResult = $checkInStmt->get_result();
            $checkInData = $checkInResult->fetch_assoc();

            $totalCheckIn = $checkInData['total_check_in'] ?? 0; // Default to 0 if null
            $pendingCheckIn = $checkInData['pending_check_in'] ?? 0; // Default to 0 if null
            $completedCheckIn = $totalCheckIn - $pendingCheckIn; // Completed check-ins

            // Query to count total check-outs and pending check-outs, excluding canceled status
            $checkOutQuery = "
SELECT 
    COUNT(*) AS total_check_out, 
    SUM(CASE WHEN check_out_status = 'pending' THEN 1 ELSE 0 END) AS pending_check_out 
FROM bookings 
WHERE check_out_date = ? 
  AND status != 'canceled'"; // Exclude canceled bookings

            $checkOutStmt = $conn->prepare($checkOutQuery);
            $checkOutStmt->bind_param("s", $today);
            $checkOutStmt->execute();
            $checkOutResult = $checkOutStmt->get_result();
            $checkOutData = $checkOutResult->fetch_assoc();

            $totalCheckOut = $checkOutData['total_check_out'] ?? 0; // Default to 0 if null
            $pendingCheckOut = $checkOutData['pending_check_out'] ?? 0; // Default to 0 if null
            $completedCheckOut = $totalCheckOut - $pendingCheckOut; // Completed check-outs

            // Query to count today's bookings, excluding canceled status
            $bookingQuery = "
SELECT 
    COUNT(*) AS total_bookings
FROM bookings 
WHERE date = ?"; // Exclude canceled bookings

            $bookingStmt = $conn->prepare($bookingQuery);
            $bookingStmt->bind_param("s", $today);
            $bookingStmt->execute();
            $bookingResult = $bookingStmt->get_result();
            $bookingData = $bookingResult->fetch_assoc();

            $totalBookings = $bookingData['total_bookings'] ?? 0; // Default to 0 if null
            ?>


            <!-- Check In Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card shadow-sm" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #049C34, #9DEA70); color: #ffffff; height: 190px;">
                <div class="card-body">
                  <h5 class="card-title text-white">Today's Check In</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                      <i class="bi bi-calendar-check" style="color: #28a745; font-size: 24px;"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="mb-0"><?php echo $totalCheckIn; ?></h6>
                      <span class="text-white small pt-1 fw-bold"><?php echo $pendingCheckIn; ?></span>
                      <span class="text-light small pt-2 ps-1">pending</span>
                      <br />
                      <span class="text-white small pt-1 fw-bold"><?php echo $completedCheckIn; ?></span>
                      <span class="text-light small pt-2 ps-1">completed</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Check Out Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card shadow-sm" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #ff4d00, #ff7f50); color: #ffffff; height: 190px;">
                <div class="card-body">
                  <h5 class="card-title text-white">Today's Check Out</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                      <i class="bi bi-calendar-x" style="color: #ff4d00; font-size: 24px;"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="mb-0"><?php echo $totalCheckOut; ?></h6>
                      <span class="text-white small pt-1 fw-bold"><?php echo $pendingCheckOut; ?></span>
                      <span class="text-light small pt-2 ps-1">pending</span>
                      <br />
                      <span class="text-white small pt-1 fw-bold"><?php echo $completedCheckOut; ?></span>
                      <span class="text-light small pt-2 ps-1">completed</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Today's Bookings Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card shadow-sm" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #007BFF, #00A9FF); color: #ffffff; height: 190px;">
                <div class="card-body">
                  <h5 class="card-title text-white">Today's Bookings</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                      <i class="bi bi-bookmark" style="color: #007BFF; font-size: 24px;"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="mb-0"><?php echo $totalBookings; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>











            <?php
            // Get today's date and the start date for the last 7 days
            $today = date('Y-m-d');
            $startDate = date('Y-m-d', strtotime('-7 days'));

            // SQL queries to fetch data for the last 7 days
            $sqlCheckIn = "SELECT COUNT(*) AS check_in_count, DATE(check_in_date) AS date 
            FROM bookings 
            WHERE check_in_date BETWEEN ? AND ? 
            AND check_in_status != 'pending'
            GROUP BY DATE(check_in_date)";

            $sqlCheckOut = "SELECT COUNT(*) AS check_out_count, DATE(check_out_date) AS date 
             FROM bookings 
             WHERE check_out_date BETWEEN ? AND ? 
             AND check_out_status != 'pending'
             GROUP BY DATE(check_out_date)";

            $sqlBookings = "SELECT COUNT(*) AS booking_count, DATE(date) AS date 
                FROM bookings 
                WHERE date BETWEEN ? AND ? 
                GROUP BY DATE(date)";

            // Prepare and execute the queries for each dataset
            $stmt = $conn->prepare($sqlCheckIn);
            $stmt->bind_param("ss", $startDate, $today);
            $stmt->execute();
            $resultCheckIn = $stmt->get_result();

            $stmt = $conn->prepare($sqlCheckOut);
            $stmt->bind_param("ss", $startDate, $today);
            $stmt->execute();
            $resultCheckOut = $stmt->get_result();

            $stmt = $conn->prepare($sqlBookings);
            $stmt->bind_param("ss", $startDate, $today);
            $stmt->execute();
            $resultBookings = $stmt->get_result();

            // Prepare the data
            $checkInData = [];
            $checkOutData = [];
            $bookingData = [];
            $categories = [];

            // Array to store all dates from the last 7 days
            $allDates = [];
            for ($i = 0; $i < 7; $i++) {
              $allDates[] = date('Y-m-d', strtotime("-$i days"));
            }

            // Populate data from queries
            $checkInDates = [];
            $checkOutDates = [];
            $bookingDates = [];

            // Initialize data for each of the 7 days to 0
            foreach ($allDates as $date) {
              $checkInData[$date] = 0;
              $checkOutData[$date] = 0;
              $bookingData[$date] = 0;
            }

            // Fetch the check-in data
            while ($row = $resultCheckIn->fetch_assoc()) {
              $checkInData[$row['date']] = (int) $row['check_in_count'];
            }

            // Fetch the check-out data
            while ($row = $resultCheckOut->fetch_assoc()) {
              $checkOutData[$row['date']] = (int) $row['check_out_count'];
            }

            // Fetch the booking data
            while ($row = $resultBookings->fetch_assoc()) {
              $bookingData[$row['date']] = (int) $row['booking_count'];
            }

            // Set categories to be the last 7 days in reverse order (today is the last date)
            $categories = array_reverse($allDates);

            // Reverse the data arrays to match the categories
            $checkInData = array_reverse($checkInData);
            $checkOutData = array_reverse($checkOutData);
            $bookingData = array_reverse($bookingData);

            // Encode data for JavaScript
            echo "<script>
                const checkInData = " . json_encode(array_values($checkInData)) . ";
                const checkOutData = " . json_encode(array_values($checkOutData)) . ";
                const bookingData = " . json_encode(array_values($bookingData)) . ";
                const categories = " . json_encode($categories) . ";
            </script>";
            ?>





            <!-- HTML for the Card and Chart -->
            <!-- HTML for the Card and Chart -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Last 7 Days</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      // Initialize the chart
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                            name: 'Check-ins',
                            data: checkInData
                          },
                          {
                            name: 'Check-outs',
                            data: checkOutData
                          },
                          {
                            name: 'Bookings',
                            data: bookingData
                          }
                        ],
                        chart: {
                          height: 350,
                          type: 'line',
                          toolbar: {
                            show: false
                          }
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#2eca6a', '#ff771d', '#4154f1'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          categories: categories, // Dates for the last 7 days
                          title: {
                            text: 'Date'
                          }
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yyyy'
                          }
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->
                </div>
              </div>
            </div><!-- End Reports -->




          </div>
        </div><!-- End Left side columns -->






        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card" style="background: linear-gradient(to right, #FF4500, #FF7F50);  border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);">

            <div class="card-body" style="background-color: #ffffff3b; border-radius: 10px; padding: 20px;">

              <?php
              error_reporting(E_ALL);
              ini_set('display_errors', 1);

              if (isset($_POST['daterange']) && !empty($_POST['daterange'])) {
                $dateRange = $_POST['daterange'];
              } else {
                $dateRange = date('d-m-Y') . ' - ' . date('d-m-Y');
              }

              // Split the string into two dates
              $dates = explode(' - ', $dateRange);

              // Assign the start and end dates
              $startDate = isset($dates[0]) ? date('Y-m-d', strtotime($dates[0])) : null;
              $endDate = isset($dates[1]) ? date('Y-m-d', strtotime($dates[1])) : null;

              // Query to get all room types
              $sqlRooms = "SELECT * FROM rooms";
              $resultRooms = $conn->query($sqlRooms);
              ?>

              <h5 class="card-title mb-4">
                Available Rooms for:
                <span style="color: #FF6F61; margin-left: 5px; background-color: #fff; padding: 2px 5px; border-radius: 5px;">
                  <?= date('d-m-Y', strtotime($startDate)) ?>
                </span>
                /
                <span style="color: #4a90e2; margin-left: 0px; background-color: #fff; padding: 2px 5px; border-radius: 5px;">
                  <?= date('d-m-Y', strtotime($endDate)) ?>
                </span>
              </h5>

              <script>
                const Date_reg = '<?= $dateRange ?>';
                const chick_date_in = '<?= $startDate ?>';
                const chick_date_out = '<?= $endDate ?>';

                document.getElementById('daterange').value = `${Date_reg}`;
                document.getElementById('checkInDate').value = `${chick_date_in}`;
                document.getElementById('checkOutDate').value = `${chick_date_out}`;
                document.getElementById('checkInDate_download').value = `${chick_date_in}`;
                document.getElementById('checkOutDate_download').value = `${chick_date_out}`;
              </script>

              <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">

                <?php
                if ($resultRooms && $resultRooms->num_rows > 0) {
                  while ($room = $resultRooms->fetch_assoc()) {

                    $bookedRooms = 0;


                    $roomId = $room['id'];
                    $roomName = $room['name'];
                    $totalRooms = $room['total_room'];


                    // Query to calculate total booked rooms for this room type within the date range
                    $sqlBookings = "
                        SELECT SUM(total_rooms) AS booked_rooms
                        FROM bookings
                        WHERE room_type = $roomId
                          AND check_in_date <= '$endDate'
                          AND check_out_date >= '$startDate'
                          AND (status != 'check-in' AND status != 'canceled') ;

                                            ";

                    $resultBookings = $conn->query($sqlBookings);
                    $bookedRooms = 0;

                    if ($resultBookings && $resultBookings->num_rows > 0) {
                      $bookingData = $resultBookings->fetch_assoc();
                      $bookedRooms = $bookingData['booked_rooms'] ?: 0; // Default to 0 if no bookings
                    }

                    // Calculate available rooms
                    $availableRooms = $totalRooms - $bookedRooms;

                    // Display the div with room details
                    echo '
                        <div data-bs-toggle="modal" data-bs-target="#add_new_booking" class="room-card" style="width: 100%; cursor: pointer; border-radius: 10px; background-color: #fff; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); padding: 20px; transition: transform 0.3s ease, box-shadow 0.3s ease; margin-bottom: 20px; color: #333; display: flex; flex-direction: column; justify-content: space-between;">
                            <div style="font-size: 1.5rem; font-weight: bold; color: #333; display: flex; align-items: center;">
                                <i class="bi bi-house-door" style="font-size: 1.6rem; margin-right: 10px; color: #FF4500;"></i>' . htmlspecialchars($roomName) . '
                            </div>
                            <hr style="border-color: #FF4500; opacity: 0.4;">
                            <div style="display: flex; justify-content: space-between; font-size: 1rem; margin: 5px 0; text-align: center; color: #333;">
                                Total Rooms: <span class="badge bg-light text-dark" style="font-weight: normal;">' . $totalRooms . '</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 1rem; margin: 5px 0; text-align: center; color: #333;">
                                Booked Rooms: <span class="badge bg-dark text-white" style="font-weight: normal;">' . $bookedRooms . '</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 1rem; margin: 5px 0; text-align: center; color: #333;">
                                Available Rooms: <span class="badge bg-success text-white" style="font-weight: normal;">' . $availableRooms . '</span>
                            </div>
                        </div>
                    ';
                  }
                } else {
                  echo '<p style="text-align: center; font-size: 1.2rem; color: #333;">No rooms found.</p>';
                }
                ?>

              </div>

            </div>
          </div><!-- End Recent Activity -->

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->







  <?= require("./config/footer.php") ?>




</body>

</html>