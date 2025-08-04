<!DOCTYPE html>
<html lang="zxx">



<head>

    <?php require ('./config/meta.php') ?>


    <style>
        @media screen and (max-width:992px) {

            .video_index {
                height: 300px;
                margin-top: 70px;
            }

            .mil-search-panel {
                margin-top: 180px;
            }
        }
    </style>

</head>

<body>


    <!-- wrapper -->
    <main class="mil-wrapper">


        <?php require ('./config/header.php') ?>
        <?php require ('./config/config.php') ?>



        <section class="mil-banner">

<video autoplay loop muted playsinline class="mil-shape video_index" style="width: 110%; top: 0%; left: 0%; object-fit: cover;">
    <source src="./video/main2.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>


<div class="container">

    <div class="row align-items-center">
        <div class="col-xl-10">

            <div class="mil-banner-content-frame">
                <div class="mil-banner-content">


                    <div class="mil-search-panel mil-mb-20">

                        <form action="./rooms" method="get">
                            <div class="mil-form-grid">
                                <div class="mil-col-5 mil-field-frame">
                                    <label>Check-in</label>
                                    <input type="text" class="datepicker-here" data-position="bottom left" placeholder="Select date" autocomplete="off" name="check_in" readonly required>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="mil-col-5 mil-field-frame">
                                    <label>Check-out</label>
                                    <input type="text" class="datepicker-here" data-position="bottom left" placeholder="Select date" autocomplete="off" name="check_out" readonly required>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="mil-col-2 mil-field-frame">
                                    <label>Adults</label>
                                    <input type="text" placeholder="Enter quantity" value="1" name="adult">
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
                    <p><span class="mil-accent-2">*</span>Effortless booking for a seamless stay in comfort and style.</p>
                </div>
            </div>

        </div>
    </div>

</div>
</section>






        <!-- services -->
        <div class="mil-content-pad mil-p-100-100" >
        <div class="container">
                <div class="mil-text-center">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Rooms</div>
                    <h2 class="mil-mb-100 mil-fade-up">Our best rooms<br> Where luxury meets comfort.</h2>
                </div>
                <div class="row mil-mb-40">

                    <?php
                    // Fetch the last 4 rooms from the database
                    $sql = 'SELECT * FROM rooms ORDER BY id DESC LIMIT 3';
                    $result = mysqli_query($conn, $sql);

                    // Loop through the rooms and display them
                    while ($room = mysqli_fetch_assoc($result)) {
                        $description = strlen($room['description']) > 100 ? substr($room['description'], 0, 50) . '...' : $room['description'];
                        ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="mil-card mil-mb-40-adapt mil-fade-up">
                                <div class="swiper-container mil-card-slider">
                                    <div class="swiper-wrapper">
                                        <?php
                                        // Assume images are stored in the 'image_1', 'image_2', etc. columns
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
                                        <div>Max Gust: <?= $room['max_capacity']; ?></div>
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
                                        <div>Size: 95ft²</div>
                                    </li>

                                </ul>

                                <div class="mil-descr">
                                    <h3 class="mil-mb-20"><?= $room['name']; ?></h3>
                                    <p class="mil-mb-40" style="color: black;"><?= $description; ?></p>
                                    <div class="mil-divider"></div>
                                    <div class="mil-card-bottom">
                                        <div class="mil-price"><span class="mil-symbol">₹</span><span class="mil-number"><?= $room['price']; ?></span>/per night</div>


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








                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>


        <!-- services end -->
        
        <div class="mil-rooms mil-p-0-100">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 85%; top: -20%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
            <div class="container">
                <div class="mil-text-center">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Services</div>
                    <h2 class="mil-mb-100 mil-fade-up">Hospitality that makes <br> Every stay exceptional.</h2>
                </div>
                <div class="row mil-mb-40">
                    <?php
                    // Fetch the last four services from the database
                    $sql = 'SELECT * FROM services ORDER BY id DESC LIMIT 4';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $classes = [
                            'mil-service-card mil-mb-40-adapt mil-fade-up mil-active',
                            'mil-service-card mil-offset mil-mb-40-adapt mil-fade-up mil-active'
                        ];

                        $index = 0;  // Initialize a counter for class selection
                        while ($service = $result->fetch_assoc()) {
                            // Get the image and title for the service
                            $image = $service['image_1'] ? './somaspanel/uploads/' . $service['image_1'] : 'path/to/default-image.jpg';
                            $title = htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8');  // Escape the title to avoid XSS
                            $id = $service['id'];  // Service ID for linking
                            $class = $classes[$index % count($classes)];  // Cycle through the classes
                            ?>
                            <div class="col-md-6 col-xl-3">
                                <a href="service_details?id=<?= $id ?>" class="<?= $class ?>">
                                    <div class="mil-img-frame">
                                        <img src="<?= $image ?>" alt="<?= $title ?>">
                                    </div>
                                    <div class="mil-description"><?= $title ?></div>
                                </a>
                            </div>
                    <?php
                            $index++;  // Increment the counter
                        }
                    } else {
                        echo "<p class='mil-fade-up'>No services available at the moment.</p>";
                    }
                    ?>
                </div>
                
            </div>
        </div>



        <!-- features -->
        <div class="mil-features">
            <!-- Background shape -->
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 85%; top: -20%; left: -30%; transform: rotate(35deg)" alt="shape">

            <div class="container">
                <!-- Section Heading -->
                <div class="mil-text-center">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Features</div>
                    <h2 class="mil-mb-100 mil-fade-up">Features that make <br> your hotel stay unforgettable</h2>
                </div>

                <!-- Feature Items Row -->
                <div class="row">
                    <?php
                    // Fetch the last four facilities from the database
                    $sql = 'SELECT * FROM facilities ORDER BY id DESC';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($facilities = $result->fetch_assoc()) {
                            // Get the image and title for the service
                            $name = htmlspecialchars($facilities['name'], ENT_QUOTES, 'UTF-8');  // Escape the title to avoid XSS
                            $icon = htmlspecialchars($facilities['icon'], ENT_QUOTES, 'UTF-8');  // Escape the title to avoid XSS
                            $image = !empty($facilities['image']) ? htmlspecialchars($facilities['image'], ENT_QUOTES, 'UTF-8') : 'https://picsum.photos/300?random=' . rand(1, 100);
                            ?>
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="mil-iconbox mil-mb-40-adapt mil-fade-up" style="position: relative; background: url('<?= $image ?>') no-repeat center; background-size: cover;">
                                    <!-- Overlay for opacity -->
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5);"></div>
                                    <div class="mil-bg-icon"></div>
                                    <div class="mil-icon" style="z-index: 1;  position: relative;">
                                        <!-- Optional Icon -->
                                        <i class="<?= $icon ?>"></i>
                                    </div>
                                    <h3 class="mil-mb-20" style="position: relative; z-index: 1; color: #fff; text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.7);"><?= $name ?></h3>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p class='mil-fade-up'>No services available at the moment.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>



        <!-- features end -->

        <!-- rooms -->






        <!-- rooms end -->

        <!-- call to action -->
        <div class="mil-content-pad mil-p-100-100 mil-fade-up">
            <div class="container">
                <div class="mil-text-center">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Call to action</div>
                    <h2 class="mil-h2-lg mil-mb-40 mil-fade-up">Do you have any questions?<br>We are available 24/7</h2>
                    <span class="mil-buttons-frame mil-center mil-fade-up">
                        <a href="./contact" class="mil-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <span>Get in touch</span>
                        </a>
                        <a href="./rooms" class="mil-link mil-open-book-popup">
                            <span>Visit Rooms</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <!-- call to action end -->

        <!-- about 1 -->
        <div class="mil-about mil-p-100-0">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 180%; bottom: -100%; left: -20%; opacity: .2" alt="shape">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-5 mil-mb-100">

                        <div class="mil-text-frame">
                            <div class="mil-suptitle mil-mb-20 mil-fade-up">Restaurant</div>
                            <!-- <h2 class="mil-mb-60 mil-fade-up">Hungry Man</h2> -->
                            <ul class="mil-about-list">
                                <li class="mil-fade-up">
                                    <div class="mil-item-head">
                                        <span>01.</span>
                                        <h4>Classic Comfort</h4>
                                    </div>
                                    <p>Step into a cozy atmosphere where timeless comfort food meets elegant dining. Perfect for those looking for a warm and inviting experience.</p>
                                </li>
                                <li class="mil-fade-up">
                                    <div class="mil-item-head">
                                        <span>02.</span>
                                        <h4>Gourmet Retreat</h4>
                                    </div>
                                    <p>Experience a fine dining journey with carefully crafted dishes made from the freshest ingredients. Ideal for those seeking a sophisticated indoor dining experience.</p>
                                </li>
                                <li class="mil-fade-up">
                                    <div class="mil-item-head">
                                        <span>03.</span>
                                        <h4>Urban Escape</h4>
                                    </div>
                                    <p>Immerse yourself in an upscale indoor environment, where creative cuisine meets modern design, offering a truly memorable culinary experience.</p>
                                </li>
                            </ul>
                        </div>


                    </div>
                    <div class="col-xl-5 mil-mb-100">

                        <div class="mil-illustration-1">
                            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" alt="shape">
                            <div class="mil-circle mil-1 mil-fade-up">
                                <img src="img/services/1.jpg" alt="img">
                            </div>
                            <div class="mil-circle mil-2 mil-fade-up">
                                <img src="img/services/2.png" alt="img">
                            </div>
                            <div class="mil-circle mil-3 mil-fade-up">
                                <img src="img/services/5.jpg" alt="img">
                            </div>
                            <div class="mil-circle mil-4 mil-fade-up">
                                <img src="img/services/4.jpg" alt="img">
                            </div>
                            <img src="img/shapes/1.png" alt="object" class="mil-figure mil-1 mil-fade-up">
                            <img src="img/shapes/2.png" alt="object" class="mil-figure mil-2 mil-fade-up">
                            <img src="img/shapes/3.png" alt="object" class="mil-figure mil-3 mil-fade-up">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- about 1 end -->



        <!-- reviews -->
        <!-- <div class="mil-content-pad mil-p-100-100" style="background-image: url(img/shapes/5.png); background-size: 100%">
            <div class="container">

                <script src="https://static.elfsight.com/platform/platform.js" async></script>
                <div class="elfsight-app-68761ac8-d3f6-4a57-9cbb-4d2cd64a999f" data-elfsight-app-lazy></div>

            </div>
        </div> -->
        <!-- reviews end -->

        <!-- blog -->
        <div class="mil-rooms mil-p-100-100">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 85%; top: -20%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
            <div class="container">
                <div class="mil-text-center">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Our Blog</div>
                    <h2 class="mil-mb-100 mil-fade-up">Explore the Latest <br> Insights & Updates from Our Blog</h2>
                </div>
                <div class="row mil-mb-40">


                    <?php
                    // Fetch the last 4 blod from the database
                    $sql = 'SELECT * FROM blogs ORDER BY id DESC LIMIT 6';
                    $result = mysqli_query($conn, $sql);

                    // Loop through the blod and display them
                    while ($blog = mysqli_fetch_assoc($result)) {
                        $description = strlen($blog['description']) > 100 ? substr($blog['description'], 0, 100) . '' : $blog['description'];
                        ?>


                        <div class="col-xl-4">

                            <a href="#0" class="mil-card mil-mb-40-adapt mil-fade-up">
                                <div class="swiper-container mil-card-slider">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="mil-card-cover">
                                                <img src="./somaspanel/uploads/<?= $blog['image'] ?>" alt="cover" data-swiper-parallax="-100" data-swiper-parallax-scale="1.1">
                                            </div>
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
                                                <path d="M13.1881 2.62402H3.18597C2.35736 2.62402 1.68564 3.29574 1.68564 4.12435V13.1263C1.68564 13.9549 2.35736 14.6266 3.18597 14.6266H13.1881C14.0168 14.6266 14.6885 13.9549 14.6885 13.1263V4.12435C14.6885 3.29574 14.0168 2.62402 13.1881 2.62402Z" stroke="#272746" stroke-width="1.00189" stroke-linejoin="round" />
                                                <path d="M4.18536 1.62305V2.63226" stroke="#272746" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.188 1.62305V2.63226" stroke="#272746" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14.6885 5.12402H1.68564" stroke="#272746" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div><?= $blog['created_at'] ?></div>
                                    </li>
                                </ul>
                                <div class="mil-descr">
                                    <h5 class="mil-mb-20"><?= $blog['title'] ?></h5>
                                    <p class="mil-mb-20"><?= $description ?></p>

                                </div>
                            </a>

                        </div>


                    <?php
                    }
                    ?>






                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-7">
                        <p class="mil-fade-up">Stay up-to-date with the latest insights <br> stories, and trends featured in our newest blog publications..</p>
                    </div>
                    <div class="col-lg-5">
                        <div class="mil-desctop-right mil-fade-up">
                            <a href="./blog" class="mil-button">
                                <span>View all</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <?php require ('./config/footer.php') ?>



    </main>


    <?php require ('./config/script.php') ?>

</body>


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/home-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:12 GMT -->

</html>