<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dining</title>
    <link rel="icon" type="image/x-icon" href="fab.png">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Satisfy&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_midia.css">




    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



    <script>
        if (localStorage.getItem("alert_Email_2") == "1") {
            alert("Email send sucesfully now chake your email ");
            localStorage.removeItem("alert_Email_2");
        } else if (localStorage.getItem("alert_Email_2") == "2") {
            alert("Sorry !, something went wrong please try again later");
            localStorage.removeItem("alert_Email_2");
        }

        $(function() {
            $("#datepicker").datepicker();
        });
    </script>

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


                    <h2 class="header_front_heading">Book Dining</h2>

                </div>


            </div>

        </div>
    </header>

    <section>

        <div class="Card_con">

            <div id="Book_table" class="card_sub_con">


                <!--<div class="card_title_container_2">-->
                <!--    <h4 class="home_heading center_text">book</h4>-->
                <!--    <h2 class="Home_title center_text">Book A Table</h2>-->
                <!--</div>-->


                <div class="event_book_form_con">


                    <div class="event_book_form_sub_con">

                        <form action="email/e-mail.php" method="post">



                            <div class="check_con">
                                <h2 class="Check_heading">Date</h2>
                                <!--<hr>-->
                                <div class="Check_sub_con">
                                    <input class="date_pickup" type="text" name="date" id="datepicker" placeholder="Date" required>
                                </div>
                            </div>



                            <div class="check_con">
                                <h2 class="Check_heading">person</h2>
                                <!--<hr>-->
                                <div class="Check_sub_con">
                                    <select class="date_pickup" name="person" id="" required>
                                        <!-- <option value="">0</option> -->
                                        <option value="1">1</option>
                                        <option value="2" selected>2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="check_con" style="width: 100%;">
                                <h2 class="Check_heading">Select a Dining Table</h2>
                                <!--<hr>-->
                                <div class="Check_sub_con">
                                    <select class="date_pickup" name="table_name" id="" required>
                                        <option value="" disabled selected> </option>
                                        <?php

                                        $sql = "SELECT * FROM `table` ";
                                        $result = mysqli_query($conn, $sql);

                                        while ($_value = mysqli_fetch_assoc($result)) {

                                            echo '
    
                                                        <option value="' . $_value["name"] . '">' . $_value["name"] . '  </option>
                                                    
                                                    ';
                                        }

                                        ?>
                                        <option value="" disabled> </option>

                                    </select>
                                </div>
                            </div>


                            <input style="  width: -webkit-fill-available;
  width: -moz-available;
  width: fill-available;" class="form_text " placeholder="Name" type="text" name="name" id="" required>
                            <input class="form_text form_text_room" placeholder="E-mail" type="email" name="email" id="" required>
                            <input class="form_text form_text_room" placeholder="Number" type="number" name="number" id="" required>


                            <input class="form_submit" type="submit" name="book_table" value="Book Now">


                        </form>

                    </div>


                </div>


                <div class="card_title_container">
                    <div class="card_title_container_3">
                        <!-- <h4 class="home_heading ">ACCOMMODATION</h4> -->
                        <h2 class="Home_title ">Discover Our Dining & Dining</h2>

                        <p class="Home_heading_description">
                            Explore amazing experience, make new memories, soak up in the sun & find a piece of paradise. Escape the hustle of the city & enjoy the shimmering sunshine, located at the seaside with access to private beach
                        </p>
                    </div>

                </div>



                <div class="Room_con">

                    <?php

                    $sql = "SELECT * FROM `table` ";
                    $result = mysqli_query($conn, $sql);

                    while ($_value = mysqli_fetch_assoc($result)) {
                        echo '

                            <div class="room_card">
                                <img class="room_img" src="images/table/' . $_value["images"] . '" alt="">
                                <div class="room_description_con">

                                    <h2 class="room_name">' . $_value["name"] . '</h2>
                                    <p class="room_description">' . substr($_value["para"], 0, 100) . '</p>

                                    <button onclick="window.open(`#Book_table`,`_self`)" class="room_book_btn"> book from <img class="price_icon" src="images/icon/rupee.png" alt="">
                                    ' . $_value["price"] . ' </button>

                                    <hr>

                                    <div class="room_bottom_con">
                                        <div class="roon_bottom_sub_con">
                                            <img class="room_bottom_icon" src="images/icon/air-conditioner (1).png" alt="">
                                            <img class="room_bottom_icon" src="images/icon/tv-monitor.png" alt="">
                                            <img class="room_bottom_icon" src="images/icon/bathtub.png" alt="">
                                            <img class="room_bottom_icon" src="images/icon/water-tap.png" alt="">
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