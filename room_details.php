<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

<head>
    <?php require("./config/meta.php") ?>
</head>

<body>
    <!-- wrapper -->
    <div class="mil-wrapper">



        <?php require("./config/header.php") ?>
        <?php require("./config/config.php") ?>



        <?php

        // Check if ID is set in URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $room_id = $_GET['id'];
            $startDate = $_GET['check_in'];
            $endDate = $_GET['check_out'];
            $total_adult = $_GET['adult'];
            $min_room = $_GET['min_room'];
            $total_availableRooms = $_GET['available'];



            // Query to fetch room details by ID
            $query = "SELECT * FROM rooms WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $room_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $room = $result->fetch_assoc();

            // Check if room exists
            if (!$room) {
                // Redirect or show error if no room found
                echo "Room not found.";
                exit();
            }
        } else {
            // Redirect or show error if ID is not provided
            echo "Invalid room ID.";
            exit();
        }
        ?>




        <div class="mil-p-100-60">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 70%; top: 0; right: -12%; transform: rotate(180deg)" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 80%; bottom: -12%; right: -22%; transform: rotate(0deg) scaleX(-1);" alt="shape">
            <div class="container">
                <div class="mil-banner-head">
                    <div class="row align-items-center">
                        <div class="col-xl-6">
                            <h1 class="mil-h2-lg mil-mb-40"><?= $room["name"] ?></h1>
                        </div>
                        <div class="col-xl-6">
                            <div class="mil-desctop-right mil-fade-up mil-mb-40">
                                <div class="mil-suptitle mil-breadcrumbs mil-light">
                                    <ul>
                                        <li><a href="./index">Home</a></li>
                                        <li><a href="./rooms">Rooms</a></li>
                                        <li><a href="#0"><?= $room["name"] ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="mil-slider-frame mil-mb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="swiper-container mil-room-slider">
                            <div class="swiper-wrapper">

                                <?php
                                // Assume images are stored in the 'image_1', 'image_2', etc. columns
                                for ($i = 1; $i <= 5; $i++) {
                                    $image = $room["image_$i"];
                                    if ($image) {


                                        echo '
                                                
                                        <div class="swiper-slide">
                                            <div class="mil-image-frame">
                                                <img src="./somaspanel/uploads/' . $image . '" alt="room" data-swiper-parallax="0" data-swiper-parallax-scale="1.2">
                                            </div>
                                        </div>

                                        ';
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <div class="mil-room-nav">
                            <div class="mil-slider-btn mil-room-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                            <div class="mil-slider-btn mil-room-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </div>
                        <div class="mil-room-pagination"></div>
                    </div>
                </div>
            </div>
        </div>






        <!-- room slider end -->

        <!-- room info -->
        <div class="mil-info">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 85%; bottom: -25%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
            <div class="container">
                <div class="row justify-content-between reverse">
                    <div class="col-xl-12">

                        <ul class="mil-parameters mil-mb-20" style="display: flex ; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">

                            <div class="mil-price"><span class="mil-symbol">₹</span><span class="mil-number"><?= $room["price"] ?></span>/per night</div>


                            <?php if ($startDate == '' and $endDate == '') { ?>

                                <a href="#"
                                    class="mil-button mil-accent-1 "
                                    onclick="scrollToTop(event)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                    </svg> BOOK NOW
                                </a>

                                <script>
                                    function scrollToTop(event) {
                                        event.preventDefault(); // Prevent default anchor behavior

                                        alert('Please check availability before booking.');
                                        window.location.href = './rooms';

                                    }
                                </script>



                            <?php } else { ?>


                                <a href="booking_room.php?check_in=<?= $startDate ?>&check_out=<?= $endDate ?>&min_room=<?= $min_room ?>&available=<?= $total_availableRooms ?>&adult=<?= $total_adult ?>&id=<?= $room['id']; ?>" class="mil-button  mil-accent-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                    </svg>BOOK NOW
                                </a>

                            <?php }  ?>



                        </ul>


                        <br>
                        <br>



                        <!-- features -->
                        <div class="row mil-mb-60-adapt">
                            <div class="col-12">
                                <h3 class="mil-fade-up mil-mb-40">Key features</h3>
                            </div>





                            <?php
                            // Replace the IDs below with the actual IDs you want to filter by
                            $facility_ids = $room["facilities"];

                            // Secure the IDs by ensuring only numbers and commas are present
                            $facility_ids = preg_replace('/[^0-9,]/', '', $facility_ids);

                            // Query to fetch facilities with the specified IDs
                            $sql = "SELECT * FROM facilities WHERE id IN ($facility_ids)";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $index = 0; // Initialize a counter for class selection
                                while ($facilities = $result->fetch_assoc()) {
                                    // Get the name and icon for the facility
                                    $name = htmlspecialchars($facilities['name'], ENT_QUOTES, 'UTF-8'); // Escape the title to avoid XSS
                                    $icon = htmlspecialchars($facilities['icon'], ENT_QUOTES, 'UTF-8'); // Escape the icon to avoid XSS
                            ?>
                                    <div class="col-xl-4">

                                        <div class="mil-iconbox mil-iconbox-sm mil-mb-40-adapt mil-fade-up">
                                            <div class="mil-bg-icon"></div>
                                            <div class="mil-icon mil-icon-fix">
                                                <i class="<?= $icon ?>"></i>
                                            </div>
                                            <h5><?= $name ?></h5>
                                        </div>

                                    </div>
                            <?php
                                    $index++; // Increment the counter
                                }
                            } else {
                                echo "<p class='mil-fade-up'>No facilities available at the moment.</p>";
                            }
                            ?>









                        </div>
                        <!-- features -->

                        <!-- description -->
                        <div class="row">
                            <div class="col-xl-11">
                                <div class="mil-dercription mil-mb-100">
                                    <h3 class="mil-fade-up mil-mb-40">Description of the room</h3>
                                    <p class="mil-fade-up mil-fade-up mil-mb-20"><?= $room["description"] ?></p>

                                </div>
                            </div>
                        </div>
                        <!-- description end -->




                        <!-- map -->
                        <div>
                            <h3 class="mil-fade-up mil-mb-40">Video Of The Rooms</h3>

                            <div class="mil-map-frame mil-fade-up mil-mb-100">

                                <iframe width="100%" height="315" src="<?= $room["video_url"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                            </div>
                        </div>
                        <!-- map end -->

                    </div>

                </div>
            </div>
        </div>














        <?php require("./config/footer.php") ?>

        <?php require("./config/script.php") ?>
</body>


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

</html>