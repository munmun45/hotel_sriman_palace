<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancellation Policy</title>
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

                    <h2 class="header_front_heading">Our Policy</h2>

                </div>


            </div>

        </div>
    </header>







    <section>

        <div class="Card_con">

            <div class="card_sub_con">

                <div class="card_title_container_2">
                    <!--<h4 class="home_heading center_text">about</h4>-->
                    <h2 class="Home_title center_text">Cancellation Policy</h2>

                    <br>
                    <br>

                    <p class="our_story_description">
                        Individual Booking <br> <br>
                        • If the reservation of rooms is cancelled before 15 days of the date of arrival, there will be no retention charges. <br>
                        • Within 7 to 15 days of the date of arrival, 50% of the 1st night stay will be charged as retention. <br>
                        • Within 3 to 7 days of the date of arrival, 75% of the 1st night stay will be charged as retention <br>
                        • Within 24 to 48 hours of the time of arrival, 100% of the 1st night stay will be charged as retention. <br>
                        • If cancelled on the day of arrival, entire amount for stay will be charged as retention. <br>
                        • A banking administration fee no more than 5% on the refund value will be charged against all processed refunds. <br> <br> <br>
                        Group Booking / RESIDENTIAL WEDDING <br> <br>
                        • If the reservation is cancelled/amended before 30 days of the date of arrival, there will be no retention. <br>
                        • Within 15 – 30 days of the date of arrival, 50% of the 1st night stay will be charged as retention. <br>
                        • Within 07 – 15 days of the date of arrival, 75% of the 1st night stay will be charged as retention. <br>
                        • Less than 7 days of the date of arrival, entire amount for stay will be charged as retention. <br>

                    </p>


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