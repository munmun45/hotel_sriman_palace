<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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

                    <h2 class="header_front_heading">Contact US</h2>

                </div>

            </div>

        </div>
    </header>

    <section>

        <div class="card_sub_con">

            <div class="Contact_fullDetels">

                <div class="con_f_contact">
                    <img class="Facilitie_icon" src="images/icon/telephone.png" alt="">

                    <br>
                    <br>
                    <br>

                    <h3 class="white" >+91 7077683888</h3>

                </div>
                <div class="con_f_contact">
                    <img class="Facilitie_icon" src="images/icon/arroba.png" alt="">

                    <br>
                    <br>
                    <br>

                    <h3 class="white" >reservations@hotelsrimanpalace.com</h3>


                </div>
                <div class="con_f_contact">
                    <img class="Facilitie_icon" src="images/icon/pin.png" alt="">

                    <br>
                    <br>
                    <br>

                    <h3 class="white" >Beach road, Gopalpur, Odisha 761002</h3>


                </div>

            </div>

        </div>






        <div class="Card_con">

            <div id="Book_Room" class="card_sub_con">


                <!--<div class="card_title_container_2">-->
                <!-- <h4 class="home_heading center_text"></h4> -->
                <!--    <h2 class="Home_title center_text">Contact US</h2>-->

                <!--    <p></p>-->
                <!-- <hr> -->
                <!--</div>-->





                <div class="event_book_form_con">

                    <div class="event_book_form_sub_con">

                        <form action="#" method="post">

                            <div class="contact_con top_contact">

                                <input class="input_contact" type="text" name="name" id="" placeholder="Name">

                            </div>
                            <div class="contact_con">

                                <input class="input_contact" type="number" name="number" id="" placeholder="Number">

                            </div>
                            <div class="contact_con">

                                <input class="input_contact" type="email" name="email" id="" placeholder="Email">

                            </div>
                            <div class="contact_con msg_con ">

                                <textarea class="msg_contact" name="message" id="" placeholder="Message"></textarea>

                            </div>




                            <input class="form_submit" type="submit" value="Send Message">


                        </form>

                    </div>






                </div>












            </div>


        </div>








        <div class="Card_con" style="padding: 0px 0px;">

            <!-- <div class="card_sub_con">



            </div> -->


            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d120529.54679888702!2d84.84018414580856!3d19.25850637009194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x3a3d59badd67f227%3A0x137d3c0f1eba2d3!2shotelsrimanpalace%20Resorts%20%26%20Spa%2C%20Beach%20road%2C%20Gopalpur%2C%20Odisha%20761002!3m2!1d19.2585689!2d84.9101731!5e0!3m2!1sen!2sin!4v1658981446534!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>



        <!-- <div class="card_sub_con">

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
                <div class="Gallery_pop_sub_con" >

                    <img onclick="close_pop()"  class="nav_icon close_pop" src="images/icon/delete.png" alt="">

                    <img id="Pop_img" src="" alt="">

                </div>

            </div>


 -->

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