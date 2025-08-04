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



        <!-- banner -->
        <div class="mil-banner-sm">
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
                                <h1 class="mil-mb-40">Exploring the Puri Through Our Blog</h1>
                                <div class="mil-suptitle mil-breadcrumbs">
                                    <ul>
                                        <li><a href="home-1.html">Home</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- banner end -->

        <!-- popular -->
        <div class="mil-content-pad mil-p-100-100">
            <div class="container">
                <div class="mil-text-center">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Blog</div>
                    <h2 class="mil-mb-100 mil-fade-up">Popular publications</h2>
                </div>
                <div class="row mil-mb-40">




                    <?php
                    // Fetch the last 4 blod from the database
                    $sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT 2";
                    $result = mysqli_query($conn, $sql);

                    // Loop through the blod and display them
                    while ($blog = mysqli_fetch_assoc($result)) {

                        $description = strlen($blog['description']) > 100 ? substr($blog['description'], 0, 100) . '' : $blog['description'];
                    ?>


                        <div class="col-md-6 col-xl-6">

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
                                    <h3 class="mil-mb-20"><?= $blog['title'] ?></h3>
                                    <div class="mil-divider"></div>
                                    <p class="mil-mb-20"><?= $description ?></p>

                                </div>
                            </a>

                        </div>




                    <?php
                    }
                    ?>




                    
                </div>
                
            </div>
        </div>
        <!-- popular end -->

        <!-- blog -->
        <div class="mil-rooms mil-p-100-100">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 85%; top: -20%; left: -30%; transform: rotate(35deg)" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 85%; bottom: -12%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
            <div class="container">
                <div class="mil-text-center">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Our Blog</div>
                    <h2 class="mil-mb-100 mil-fade-up">Latest blog publications</h2>
                </div>
                <div class="row mil-mb-40">



                    <?php
                    // Fetch the last 4 blod from the database
                    $sql = "SELECT * FROM blogs ORDER BY id DESC";
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

            </div>
        </div>
        <!-- blog end -->
















        <?php require("./config/footer.php") ?>

        <?php require("./config/script.php") ?>
</body>


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

</html>