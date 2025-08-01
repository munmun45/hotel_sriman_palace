<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity</title>
    <link rel="icon" type="image/x-icon" href="fab.png">

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


                    <h2 class="header_front_heading">ACTIVITIES</h2>

                </div>


            </div>

        </div>
    </header>

    <section>

        <div class="Card_con">

            <div class="card_sub_con">

                <div class="card_title_container">
                    <div class="card_title_container_3">
                        <!-- <h4 class="home_heading ">ACCOMMODATION</h4> -->
                        <h2 class="Home_title ">Discover Our Activities</h2>

                        <p class="Home_heading_description">
                            Explore amazing experience, make new memories, soak up in the sun & find a piece of paradise. Escape the hustle of the city & enjoy the shimmering sunshine, located at the seaside with access to private beach
                        </p>
                    </div>

                </div>



                <div class="Room_con">


                    <?php

                    $sql = "SELECT * FROM `activity` ";
                    $result = mysqli_query($conn, $sql);

                    while ($_value = mysqli_fetch_assoc($result)) {
                        echo '

                            <div class="room_card">
                                <img class="room_img" src="images/activity/' . $_value["images"] . '" alt="">
                                <div class="room_description_con">

                                    <h2 class="room_name">' . $_value["name"] . '</h2>
                                    <p class="room_description">' . substr($_value["para"], 0, 100) . '</p>

                                    <hr>

                                    <div class="room_bottom_con">
                                        
                                        <div class="roon_bottom_sub_con">
                                            <button onclick="window.open(`https://www.google.com/search?gs_ssp=eJzj4tFP1zc0yjJMsaysSjFg9OJLzy9IzCkoLVJISk1MzgAAjikJ1A&q=' . $_value["name"] . '&rlz=1C1ONGR_enIN1013IN1013&oq=gopalpur&aqs=chrome.2.69i57j46i13i433l2j0i13j46i13i131i175i199i433j0i13j46i13i175i199j0i13j46i13i175i199.4449j0j15&sourceid=chrome&ie=UTF-8`,`_blank`)" class="room_bottom_btn">FULL INFO</button>
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