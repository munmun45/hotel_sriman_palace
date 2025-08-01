<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>hotelsrimanpalace</title>
    <link rel="icon" type="image/x-icon" href="fab.png">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Satisfy&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_midia.css">

</head>

<body onload="document.getElementsByClassName ('Loding_con')[0].style.display='none' ">

    <!-- con database ........... -->
    <?php
    require("mysqli_con/mysqli_con.php");
    ?>

    <header class="header">

        <!-- call  nav bar & menu -->
        <nav class="nav">

            <?php
            require("get_file/nav_bar.php");
            require("get_file/nav_menu.php");
            ?>

        </nav>


        <div class="header_con">

            <!-- slider img  -->
            <div class="header_background_img">

                <?php

$sql = "SELECT * FROM `slider` ORDER BY RAND() LIMIT 4";

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

            <!-- slider data  -->
            <div class="header_black_con">

                <div class="header_front_content">

                    <marquee class="header_offers">

                        <?php

                        $sql = "SELECT * FROM `offers` ";
                        $result = mysqli_query($conn, $sql);

                        while ($_value = mysqli_fetch_assoc($result)) {
                            echo '&nbsp; 
                                    ' . $_value["message"] . '
                                    &nbsp; |
                                ';
                        }

                        ?>

                    </marquee>


                    <h2 class="header_front_heading">OUR STORY</h2>

                    <?php

                    $sql = "SELECT * FROM `our_story` ";
                    $result = mysqli_query($conn, $sql);
                    $_value = mysqli_fetch_assoc($result);
                    echo '
                            <p class="header_front_description">
                                ' . substr($_value["message"], 0, 560) . '
                            </p>
                        ';

                    ?>


                </div>


            </div>

        </div>

    </header>


    <!-- loding div if fast time open pages show this loding pagesa  -->
    <div class="Loding_con">
        <div class="Loding_sub_con" >

            <img src="images/logo/logo.png" alt="">

        </div>
        <img class="nav_logo" src="images/loging.gif" alt="">
    </div>



    <section>


        <div class="Card_con">

            <div class="card_sub_con">

                <!-- about -->

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
                        <h3 class="home_heading">ABOUT hotelsrimanpalace</h3>

                        <h2 class="Home_title">
                            Welcome to hotelsrimanpalace resort
                        </h2>

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

                        <button onclick="window.open('About.php','_self')" class="reed_More">DISCOVER MORE</button>

                    </div>
                </div>





                <!-- rooms  -->

                <div class="card_title_container_2">
                    <h4 class="home_heading center_text">ACCOMMODATION</h4>
                    <h2 class="Home_title center_text">Discover Our Room</h2>
                </div>

                <div class="Room_con">


                    <?php

                    $sql = "SELECT * FROM `room` ";
                    $result = mysqli_query($conn, $sql);

                    while ($_value = mysqli_fetch_assoc($result)) {
                        echo '

                            <div class="room_card">
                                <img class="room_img" src="images/rooms/' . $_value["image"] . '" alt="">
                                <div class="room_description_con">
        
                                    <h2 class="room_name">' . $_value["name"] . '</h2>
                                    <p class="room_description">' . substr($_value["para"], 0, 100) . '</p>
        
                                    <button onclick="window.open(`book_room.php#Book_Room`,`_self`)" class="room_book_btn"> book from <img class="price_icon" src="images/icon/rupee.png" alt="">
                                    ' . $_value["price"] . ' </button>
        
                                    <hr>
        
                                    <div class="room_bottom_con">
                                        <div class="roon_bottom_sub_con">
                                            <img class="room_bottom_icon" src="images/icon/wifi.png" alt="">
                                            <img class="room_bottom_icon" src="images/icon/tv.png" alt="">
                                            <img class="room_bottom_icon" src="images/icon/bathroom.png" alt="">
                                            <img class="room_bottom_icon" src="images/icon/Water.png" alt="">
                                        </div>
                                        <div class="roon_bottom_sub_con">
                                            <button onclick="window.open(`book_room.php#' . $_value["price"] . '`,`_self`)" class="room_bottom_btn">FULL INFO</button>
                                        </div>
        
                                    </div>
        
                                </div>
        
                            </div>


                            ';
                    }

                    ?>

                </div>



            </div>

        </div>


        <!-- services -->

        <div class="card_sub_con">
            <div class="Service_con">

                <div class="card_title_container_2" style="margin: 34px 0px;">
                    <h4 class="home_heading center_text">__</h4>
                    <h2 class="Home_title center_text white">Special Services</h2>
                </div>


                <div class="service_sub_con">
                    <div class="service_top_btn_con">

                        <?php
                        $sql = "SELECT * FROM `service` ";
                        $result = mysqli_query($conn, $sql);
                        $int = 1;
                        while ($_value = mysqli_fetch_assoc($result)) {

                            echo '

                                    <div class="service_slider_btn" onclick="currentSlide(' . $int . ')">
                                        <img class="service_slider_img" src="images/icon/' . $_value["logo"] . '" alt="">
                                    </div>
                                
                                ';

                            $int++;
                        }
                        ?>

                    </div>

                    <?php
                    $sql = "SELECT * FROM `service` ";
                    $result = mysqli_query($conn, $sql);
                    $int = 1;
                    while ($_value = mysqli_fetch_assoc($result)) {
                        echo '

                                <div class="service_sub_con_2 fade">

                                    <div class="service_left_con">
                                        <h2 class="service_no">0' . $int . '</h2>
                                        <h4 class="service_title">THE hotelsrimanpalace</h4>
                                        <h2 class="service_Heading">' . $_value["name"] . '</h2>
            
                                        <p class="service_description">' . substr($_value["para"], 0, 90) . '</p>

                                        <button style="margin-bottom: 0px;" onclick="call();" class="room_book_btn"> book from ' . $_value["price"] . ' </button>
            
                                        <button onclick="window.open(`service.php#' . $_value["price"] . '`,`_self`)" class="Facilitie_reedMore">FULL INFO</button>
            
                                    </div>
                                    <div class="service_right_con ">
                                        <img class="service_left_img" src="images/service/' . $_value["images"] . '" alt="">
                                    </div>
            
                                </div>
                            
                            ';
                        $int++;
                    }
                    ?>




                </div>

            </div>

        </div>







        <div class="Card_con">

            <div class="card_sub_con">


                <!-- Facility -->

                <div class="card_title_container_2">

                    <h4 class="home_heading center_text">OUR SERVICES</h4>
                    <h2 class="Home_title center_text ">Hotel Facilities</h2>

                </div>

                <div class="Facilitie_con">

                    <?php

                    $sql = "SELECT * FROM `facilities` LIMIT 6";
                    $result = mysqli_query($conn, $sql);
                    while ($_value = mysqli_fetch_assoc($result)) {
                        echo '

                                <div class="Facilitie_sub_con">
                                    <img class="Facilitie_icon" src="images/icon/' . $_value["images"] . '" alt="">
                                    <h2 class="Facilitie_title">' . $_value["name"] . '</h2>
                                    <p class="Facilitie_decription">' . substr($_value["para"], 0, 90) . '</p>
                                </div>

                            ';
                    }

                    ?>

                </div>

                <br>
                <br>
                <br>

                <div class="card_title_container_2">

                    <h4 class="home_heading center_text">BLOG</h4>
                    <h2 class="Home_title center_text ">News & Articles</h2>

                </div>

                <!-- blog -->
                <div class="Articles_con">

                    <?php

                    $sql = "SELECT * FROM `blog` ORDER BY id DESC LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while ($_value = mysqli_fetch_assoc($result)) {
                        echo '
                                <div class="Articles_sub_con">
                                    <div class="Articles_sub_con_2">
                                        <img class="Articles_images" src="images/blog/' . $_value["images"] . '" alt="">
            
                                        <div class="date_con">
                                            <h2 class="_date">' . $_value["date"] . '</h2>
                                        </div>
            
                                        <div class="Article_description_con">
            
                                            <div class="Article_description_con_2">
            
                                                <h2 class="Facilitie_title">' . $_value["name"] . '</h2>
            
                                                <p class="Facilitie_decription">' . substr($_value["para"], 0, 200) . '</p>
                                                <hr>
            
                                            </div>
            
                                        </div>
            
                                    </div>
            
                                </div>
                            ';
                    }

                    ?>

                </div>

            </div>

        </div>

        <div class="card_sub_con">

            <!-- gallery -->
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



            <!-- gallery popup -->
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






    <!-- link js -->
    <script src="js/index.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/pop.js"></script>
    <script src="js/main.js"></script>

</body>

</html>