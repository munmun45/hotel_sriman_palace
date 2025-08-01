<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover the story behind hotelsrimanpalace - a luxury resort offering exceptional hospitality and premium accommodations. Learn about our heritage and commitment to excellence.">
    <meta name="keywords" content="hotelsrimanpalace about us, luxury resort story, hotel history, about hotelsrimanpalace, premium hospitality">
    <meta name="author" content="hotelsrimanpalace">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.hotelsrimanpalace.com/About.php">
    <meta property="og:title" content="About hotelsrimanpalace | Our Story & Heritage">
    <meta property="og:description" content="Discover the story behind hotelsrimanpalace - a luxury resort offering exceptional hospitality and premium accommodations.">
    <meta property="og:image" content="https://www.hotelsrimanpalace.com/images/about/og-about.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.hotelsrimanpalace.com/About.php">
    <meta property="twitter:title" content="About hotelsrimanpalace | Our Story & Heritage">
    <meta property="twitter:description" content="Discover the story behind hotelsrimanpalace - a luxury resort offering exceptional hospitality and premium accommodations.">
    <meta property="twitter:image" content="https://www.hotelsrimanpalace.com/images/about/og-about.jpg">

    <title>About hotelsrimanpalace | Our Story & Heritage</title>
    <link rel="icon" type="image/x-icon" href="fab.png">
    <link rel="canonical" href="https://www.hotelsrimanpalace.com/About.php" />
    
    <!-- Schema.org markup for About Page -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "AboutPage",
      "name": "About hotelsrimanpalace",
      "description": "Discover the story behind hotelsrimanpalace - a luxury resort offering exceptional hospitality and premium accommodations.",
      "publisher": {
        "@type": "Organization",
        "name": "hotelsrimanpalace",
        "logo": {
          "@type": "ImageObject",
          "url": "https://www.hotelsrimanpalace.com/images/logo/logo.png"
        }
      }
    }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Satisfy&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_midia.css">

</head>

<body onload="document.getElementsByClassName ('Loding_con')[0].style.display='none' ">

    <?php
    require("mysqli_con/mysqli_con.php");
    ?>


    <div class="Loding_con">
        <div class="Loding_sub_con">

            <img src="images/logo/logo.png" alt="">

        </div>
        <img class="nav_logo" src="images/loging.gif" alt="">
    </div>

    <header class="header_2">

        <nav class="nav_2">


            <?php
            require("get_file/nav_bar_2.php");
            require("get_file/nav_menu.php");
            ?>



        </nav>


        <div class="header_con">


            <div class="header_background_img">

                <?php

                $sql = "SELECT * FROM `slider` ORDER BY id DESC LIMIT 4";
                $result = mysqli_query($conn, $sql);
                $z_i = mysqli_num_rows($result);
                while ($_value = mysqli_fetch_assoc($result)) {
                    echo '
                            <img class="slider_img" src="images/slider/' . $_value["image"] . '" style="z-index: ' . $z_i . ';" alt="">
                        ';
                    $z_i--;
                }

                ?>

            </div>

            <div class="header_black_con">




                <div class="header_front_content">

                    <h2 class="header_front_heading">OUR STORY</h2>

                </div>


            </div>

        </div>
    </header>

    <section>

        <div class="Card_con">

            <div class="card_sub_con">

                <div class="card_title_container_2">
                    <!--<h4 class="home_heading center_text">about</h4>-->
                    <h2 class="Home_title center_text">Welcome to hotelsrimanpalace resort</h2>
                    <?php

                    $sql = "SELECT * FROM `our_story` ";
                    $result = mysqli_query($conn, $sql);
                    $_value = mysqli_fetch_assoc($result);
                    echo '
                            <p class="our_story_description">
                                ' . substr($_value["message"], 0, 560) . '
                            </p>
                        ';

                    ?>

                </div>






                <div class="Home_about_con">
                    <div class="about_content mid_about"></div>
                    <div class="about_content left_about">
                        <?php
                        $sql = "SELECT * FROM `our_story` ";
                        $result = mysqli_query($conn, $sql);
                        $_value = mysqli_fetch_assoc($result);
                        echo '
                                
                                <img class="about_content_img" src="images/about/' . $_value["Image_1"] . '" alt="">
                            ';
                        ?>
                    </div>
                    <div class="about_content right_about">

                        <!--<h2 class="Home_title">-->
                        <!--    Welcome to hotelsrimanpalace resort-->
                        <!--</h2>-->

                        <?php

                        $sql = "SELECT * FROM `our_story` ";
                        $result = mysqli_query($conn, $sql);
                        $_value = mysqli_fetch_assoc($result);
                        echo '
                                <p class="Home_description">
                                    ' . substr($_value["message"], 560, 635) . '
                                </p>
                            ';


                        ?>

                    </div>
                </div>










                <div class="Home_about_con">
                    <div class="about_content mid_about"></div>

                    <div class="about_content left_about p" style="padding: 40px; box-shadow: -18px 18px 0px 0px #ffffff36;  z-index: 2;">

                        <!--<h2 class="Home_title">-->
                        <!--    Welcome to hotelsrimanpalace resort-->
                        <!--</h2>-->
                        <?php

                        $sql = "SELECT * FROM `our_story` ";
                        $result = mysqli_query($conn, $sql);
                        $_value = mysqli_fetch_assoc($result);
                        echo '
                                <p class="Home_description">
                                    ' . substr($_value["message"], 1201) . '
                                </p>
                            ';


                        ?>


                    </div>

                    <div class="about_content right_about " style="padding: 0px;  z-index: 1;">
                        <?php
                        $sql = "SELECT * FROM `our_story` ";
                        $result = mysqli_query($conn, $sql);
                        $_value = mysqli_fetch_assoc($result);
                        echo '
                                
                                <img class="about_content_img" src="images/about/' . $_value["Image_2"] . '" alt="">
                            ';
                        ?>
                    </div>
                </div>



            </div>



        </div>


        <div class="card_sub_con">

            <div class="gallery_con">
                <?php
                $sql = "SELECT * FROM `gallery` ORDER BY id DESC LIMIT 7";
                $result = mysqli_query($conn, $sql);
                while ($_value = mysqli_fetch_assoc($result)) {
                    echo '
                            <img onclick="show(src)" class="gallery_content" src="images/gallery/' . $_value["images"] . '" alt="">
                        ';
                }
                ?>
            </div>




            <div class="Gallery_pop" id="Gallery_pop">
                <div class="Gallery_pop_sub_con">

                    <img onclick="close_pop()" class="nav_icon close_pop" src="images/icon/delete.png" alt="">

                    <img id="Pop_img" src="" alt="">

                </div>

            </div>




        </div>


    </section>


    <?php
    require("get_file/footer.php");
    ?>




    <script src="js/other.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/pop.js"></script>


</body>

</html>