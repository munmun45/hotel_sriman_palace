<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <link rel="icon" type="image/x-icon" href="fab.png">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Satisfy&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_midia.css">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <script>

        if(localStorage.getItem("alert_Email_3") == "1")
        {
            alert("Email send sucesfully now chake your email ");
            localStorage.removeItem("alert_Email_3");
            
        }else if(localStorage.getItem("alert_Email_3") == "2")
        {
            alert("Sorry !, something went wrong please try again later");
            localStorage.removeItem("alert_Email_3");
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

                    <h2 class="header_front_heading">Book Event</h2>

                </div>


            </div>

        </div>
    </header>

    <section>

        <div class="Card_con">

            <div class="card_sub_con">




                <!--<div class="card_title_container_2">-->
                <!--    <h4 class="home_heading center_text">book</h4>-->
                <!--    <h2 class="Home_title center_text">Book An Event</h2>-->
                <!--</div>-->




                <div class="event_book_form_con">

                    <div class="event_book_form_sub_con">

                        <form action="email/e-mail.php" method="post">

                            <input class="form_text" placeholder="First Name" type="text" name="first_name" id="" required>
                            <input class="form_text" placeholder="Last Name" type="text" name="last_name" id="" required>
                            <input class="form_text" placeholder="Emali ID" type="email" name="email" id="" required>
                            <input class="form_text" placeholder="Contact Number" type="number" name="number" id="" required>

                            <input class="form_text" type="text" name="date" placeholder="date" id="datepicker" required>

                            <select class="form_text" name="event" id="" required>
                                <option value="" disabled selected > Select An Event  </option>
                                
                                <?php

                                    $sql = "SELECT * FROM `event` ";
                                    $result = mysqli_query($conn, $sql);

                                    while ($_value = mysqli_fetch_assoc($result)) {

                                        echo '

                                            <option value="' . $_value["name"] . '">' . $_value["name"] . '  </option>
                                            
                                        ';
                                    }

                                ?>
                                
                            </select>

                            <textarea class="form_text" style="height: 100px;" name="event_message" id="" placeholder="Enter Your Message" required></textarea>

                            <input class="form_submit" name="book_event" type="submit" value="Book Now" >

                        </form>

                    </div>



                </div>



                <div class="card_title_container">
                    <div class="card_title_container_3">
                        <!-- <h4 class="home_heading ">ACCOMMODATION</h4> -->
                        <h2 class="Home_title ">Discover Our Event</h2>

                        <p class="Home_heading_description">
                            An exclusive escape from the daily grind be it destination Wedding,Birthday party, conference, business, office party, get together, ring ceremony and more
                        </p>
                    </div>

                </div>



                <div class="Articles_con">

                    <?php

                    $sql = "SELECT * FROM `event` ORDER BY id DESC LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while ($_value = mysqli_fetch_assoc($result)) {
                        echo '
                                <div class="Articles_sub_con">
                                    <div class="Articles_sub_con_2">
                                        <img class="Articles_images" src="images/event/' . $_value["images"] . '" alt="">
            
                                        
            
                                        <div class="Article_description_con">
            
                                            <div class="Article_description_con_2">
            
                                                <h2 class="Facilitie_title">' . $_value["name"] . '</h2>
            
                                                <p class="Facilitie_decription">' . substr($_value["para"], 0, 200) . '</p>
                                                <hr>
                                                <!-- <button class="Facilitie_reedMore">FULL INFO</button> -->
            
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