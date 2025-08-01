<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Policy</title>
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
                    <h2 class="Home_title center_text">Refund Policy</h2>

                    <br>
                    <br>

                    <p class="our_story_description">
                        Refunds are possible on all bookings based on the hotel’s cancellation policy. <br> <br>
                        Non-refundable bookings are extremely special rates issued on the basis of guaranteed bookings after fulfilling all criteria requirements. Such bookings received through any channel will not be refunded. <br> <br>
                        For eligible cases, while all efforts will be made to initiate the refund at the earliest, any refund will take a period of two to four weeks to be affected. This time period is due to factors which may include but not be limited to your credit card company’s billing cycle tallying, confirmation of amounts received against the particular booking and receipt of all bank requirements to where the refund is to be directed amongst others including management approval. <br> <br>
                        If a “Refund Hold” has been requested, this will be treated as a credit note against your next booking within the next 3 months of travel. Rates for your booking however are subject to change depending on the season / availability and the differential amount is payable / adjustable. <br> <br>
                        If a simple “Refund” has been requested, the process will start immediately but shall take two to four weeks to reflect in your bank account. In cases where there may be mass cancellations for reasons such as natural calamities, acts of terror, strikes / bandhs where the banking service may be affected, refunds will be processed when regular operations restart. <br> <br>
                        Refunds will not be entertained due to flight or train cancellations. <br> <br>
                        All bookings during peak season periods including December 20th until 3rd January across all our properties are non-amendable and non-refundable. Kindly refer to our website – www.hotelsrimanpalace.com where a specific peak period is mentioned per hotel. <br> <br>
                        A banking administration fee no more than 5% on the refund value will be charged against all processed refunds. <br> <br>
                        For GST refunds, the same is as per the applicable law. <br> <br>


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