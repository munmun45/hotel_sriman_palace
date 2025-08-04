<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

<head>
    <?php require("./config/meta.php") ?>



    <style>
        .disabled {
            opacity: 0.5;
            /* Makes the whole card appear faded */
            pointer-events: none;
            /* Prevents interaction (clicking, etc.) */
            background-color: #f0f0f0;
            /* Light gray background */
        }

        .disabled_2 {
            opacity: 0.5;
            /* Makes the whole card appear faded */
            pointer-events: none;
            /* Prevents interaction (clicking, etc.) */
            background-color: #ff5c5c;
            /* Light gray background */
        }

        .disabled .mil-card-cover img {
            filter: grayscale(100%);
            /* Turns images to grayscale */
        }

        .disabled .mil-price,
        .disabled .mil-button {
            color: #888;
            /* Changes the text and button color to gray */
        }

        .disabled .mil-slider-btn,
        .disabled .mil-icon {
            color: #ccc;
            /* Makes the slider buttons and icons gray */
        }

        @media screen and (max-width: 768px) {

            .col-md-6,
            .col-xl-4 {
                width: 100%;
                /* Make each room card take full width */
                margin-bottom: 20px;
                /* Add space between the cards */
            }
        }
    </style>


</head>

<body>
    <!-- wrapper -->
    <div class="mil-wrapper">



        <?php require("./config/header.php") ?>
        <?php require("./config/config.php") ?>













        <div class="mil-banner-sm" id="booking_search">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 70%; top: 0; right: -35%; transform: rotate(190deg)" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 70%; bottom: -12%; left: -30%; transform: rotate(40deg)" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 110%; top: -5%; left: -30%; opacity: .3" alt="shape">
            <div class="container">
                <div class="mil-banner-img-4">
                    <img src="img/shapes/1.png" alt="object" class="mil-figure mil-1">
                    <img src="img/shapes/2.png" alt="object" class="mil-figure mil-2">
                    <img src="img/shapes/3.png" alt="object" class="mil-figure mil-3">
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-6">

                        <div class="mil-banner-content-frame">
                            <div class="mil-banner-content mil-text-center">
                                <h1 class="mil-mb-40">Choose the room <br>of your dreams</h1>
                                <div class="mil-suptitle mil-breadcrumbs">
                                    <ul>
                                        <li><a href="./index">Home</a></li>
                                        <li><a href="#0">Rooms</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- banner end -->

        <!-- search panel -->
        <div class="mil-content-pad mil-search-window">
            <div class="container">
                <div class="mil-search-panel mil-panel-2">
                    <form action="" method="get">
                        <div class="mil-form-grid">
                            <div class="mil-col-5 mil-field-frame">
                                <label>Check-in</label>
                                <input type="text" class="datepicker-here" data-position="bottom left" placeholder="Select date" autocomplete="off" name="check_in" value="<?= htmlspecialchars($_GET['check_in'] ?? '') ?>" required readonly>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div class="mil-col-5 mil-field-frame">
                                <label>Check-out</label>
                                <input type="text" class="datepicker-here" data-position="bottom left" placeholder="Select date" autocomplete="off" name="check_out" value="<?= htmlspecialchars($_GET['check_out'] ?? '') ?>" required readonly>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div class="mil-col-2 mil-field-frame">
                                <label>Adults</label>
                                <input type="text" placeholder="Enter quantity" name="adult" value="<?= htmlspecialchars($_GET['adult'] ?? '1') ?>" required>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                        </div>
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <span>Search</span>
                        </button>
                    </form>
                </div>
                <br>
                <p>Checkin Time 9.00 AM - Checkout Time 07.00 AM </p>
            </div>
        </div>

        <!-- search panel end -->

        <!-- rooms -->
        <div class="mil-rooms mil-p-100-100">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 85%; bottom: -20%; right: -25%; transform: rotate(-30deg) scaleX(-1);" alt="shape">

            <div class="container" style="z-index: 2;">



                <div class="row mil-mb-40">



                    <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);


                    $startDate = !empty($_GET['check_in'])
                        ? date('Y-m-d', strtotime($_GET['check_in']))
                        : '';

                    $endDate = !empty($_GET['check_out'])
                        ? date('Y-m-d', strtotime($_GET['check_out']))
                        : '';

                    $total_adult = !empty($_GET['adult'])
                        ? $_GET['adult']
                        : 0;


                    // Query to get all room types
                    $sqlRooms = "SELECT * FROM rooms";
                    $resultRooms = $conn->query($sqlRooms);


                    ?>

                    <?php if ($startDate != '' and $endDate != '') { ?>

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
                            scrollToTop(event)

                            function scrollToTop(event) {
                                event.preventDefault(); // Prevent default anchor behavior


                                window.scrollTo({
                                    top: 300,
                                    behavior: 'smooth'
                                });
                            }
                        </script>

                    <?php } ?>





                    <div class="row">

                        <?php
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
                                    $bookedRooms = $bookingData['booked_rooms'] ?: 0; // Default to 0 if no bookings
                                }


                                // Calculate available rooms

                                $average_capacity = $max_capacity_one_room + $max_extra_adults_one_room;

                                $total_min_room_book =  ceil($total_adult / $average_capacity);

                                $total_availableRooms = $totalRooms - $bookedRooms;

                                $availableRooms = $total_availableRooms - $total_min_room_book;





                                $description = strlen($room['description']) > 100 ? substr($room['description'], 0, 50) . '...' : $room['description'];

                                if ($startDate == '' and $endDate == '') {

                                    $availableRooms  = 100;
                                }



                        ?>




                                <div class="col-md-6 col-xl-4 <?= $availableRooms < 0 ? 'disabled' : '' ?>">
                                    <a href="<?= $availableRooms < 0 ? '#0' : './room_details?check_in=' . urlencode($startDate) . '&check_out=' . urlencode($endDate) . '&min_room=' . urlencode($total_min_room_book) . '&available=' . urlencode($total_availableRooms) . '&adult=' . urlencode($total_adult) . '&id=' . urlencode($room['id']); ?>" class="mil-card-link" style="text-decoration: none;"> <!-- Make the entire card clickable -->
                                        <div class="mil-card mil-mb-40-adapt mil-fade-up">
                                            <div class="swiper-container mil-card-slider">
                                                <div class="swiper-wrapper">
                                                    <?php
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        $image = $room["image_$i"];
                                                        if ($image) {
                                                            echo "<div class='swiper-slide'>
                                                                <div class='mil-card-cover'>
                                                                    <img src='./somaspanel/uploads/$image' alt='cover' data-swiper-parallax='-100' data-swiper-parallax-scale='1.1'>
                                                                </div>
                                                            </div>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="mil-card-nav">
                                                    <div class="mil-slider-btn mil-card-prev">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            <polyline points="12 5 19 12 12 19"></polyline>
                                                        </svg>
                                                    </div>
                                                    <div class="mil-slider-btn mil-card-next">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            <polyline points="12 5 19 12 12 19"></polyline>
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div class="mil-card-nav">
                                                    <div class="mil-slider-btn mil-card-prev">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            <polyline points="12 5 19 12 12 19"></polyline>
                                                        </svg>
                                                    </div>
                                                    <div class="mil-slider-btn mil-card-next">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            <polyline points="12 5 19 12 12 19"></polyline>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="mil-card-pagination"></div>
                                            </div>


                                            <ul class="mil-parameters">
                                                <li>
                                                    <div class="mil-icon">
                                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path d="M12.7432 5.75582C12.6516 7.02721 11.7084 8.00663 10.6799 8.00663C9.65144 8.00663 8.70673 7.02752 8.6167 5.75582C8.52291 4.43315 9.44106 3.505 10.6799 3.505C11.9188 3.505 12.837 4.45722 12.7432 5.75582Z" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M10.6793 10.0067C8.64232 10.0067 6.68345 11.0185 6.19272 12.9889C6.12771 13.2496 6.29118 13.5075 6.55905 13.5075H14.7999C15.0678 13.5075 15.2303 13.2496 15.1662 12.9889C14.6755 10.9869 12.7166 10.0067 10.6793 10.0067Z" stroke="black" stroke-width="1.00189" stroke-miterlimit="10" />
                                                                <path d="M6.42937 6.31713C6.3562 7.33276 5.59385 8.13264 4.77209 8.13264C3.95033 8.13264 3.18672 7.33308 3.1148 6.31713C3.04007 5.26053 3.7821 4.50537 4.77209 4.50537C5.76208 4.50537 6.50411 5.27992 6.42937 6.31713Z" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M6.61604 10.0688C6.05177 9.81023 5.4303 9.71082 4.77162 9.71082C3.14604 9.71082 1.57985 10.5189 1.18752 12.0929C1.13594 12.3011 1.26661 12.5071 1.48043 12.5071H4.99045" stroke="black" stroke-width="1.00189" stroke-miterlimit="10" stroke-linecap="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                    <rect width="16.0035" height="16.0035" fill="white" transform="translate(0.176514 0.504028)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div>Max Gust: <?= $room['max_capacity']; ?> × <?= $room['max_extra_adults']; ?></div>
                                                </li>
                                                <li>
                                                    <div class="mil-icon">
                                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.9578 14.6084H12.7089C13.1733 14.6084 13.6187 14.4239 13.9471 14.0955C14.2755 13.7671 14.46 13.3217 14.46 12.8573V11.1062" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M14.46 6.10644V4.35534C14.46 3.89092 14.2755 3.44553 13.9471 3.11713C13.6187 2.78874 13.1733 2.60425 12.7089 2.60425H10.9578" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M5.95898 14.6084H4.20788C3.74346 14.6084 3.29806 14.4239 2.96967 14.0955C2.64128 13.7671 2.45679 13.3217 2.45679 12.8573V11.1062" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M2.45679 6.10644V4.35534C2.45679 3.89092 2.64128 3.44553 2.96967 3.11713C3.29806 2.78874 3.74346 2.60425 4.20788 2.60425H5.95898" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <div>Available Rooms: <?= $total_availableRooms; ?></div>
                                                </li>

                                            </ul>

                                            <div class="mil-descr">
                                                <h3 class="mil-mb-20"><?= $room['name']; ?></h3>
                                                <p class="mil-mb-40" style="color: black;"><?= $description; ?></p>
                                                <div class="mil-divider"></div>
                                                <div class="mil-card-bottom">
                                                    <div class="mil-price"><span class="mil-symbol">₹</span><span class="mil-number"><?= $room['price']; ?></span>/per night</div>


                                                    <?php if ($startDate == '' and $endDate == '') { ?>

                                                        <a href="#top"
                                                            class="mil-button mil-icon-button mil-accent-1 "
                                                            onclick="scrollToTop(event)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                                            </svg>
                                                        </a>

                                                        <script>
                                                            function scrollToTop(event) {
                                                                event.preventDefault(); // Prevent default anchor behavior

                                                                // Show an alert message
                                                                alert('Please check availability before booking.');

                                                                // Scroll to the top smoothly
                                                                window.scrollTo({
                                                                    top: 120,
                                                                    behavior: 'smooth'
                                                                });
                                                            }
                                                        </script>



                                                    <?php } else { ?>


                                                        <a href="booking_room.php?check_in=<?= $startDate ?>&check_out=<?= $endDate ?>&min_room=<?= $total_min_room_book ?>&available=<?= $total_availableRooms ?>&adult=<?= $total_adult ?>&id=<?= $room['id']; ?>" class="mil-button mil-icon-button mil-accent-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                                            </svg>
                                                        </a>

                                                    <?php }  ?>







                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>









                        <?php





                            }
                        } else {
                            echo '<p style="text-align: center; font-size: 1.2rem; color: #333;">No rooms found.</p>';
                        }
                        ?>



















                    </div>
                </div>
                <!-- rooms end -->












            </div>
        </div>
    </div>
    <?php require("./config/footer.php") ?>

    <?php require("./config/script.php") ?>
</body>


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

</html>