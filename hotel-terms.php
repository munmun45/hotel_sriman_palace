<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Terms</title>
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
                    <h2 class="Home_title center_text">Hotel Terms</h2>

                    <br>
                    <br>

                    <p class="our_story_description">
                        Hotel Terms & Conditions: <br> <br>
                        • The hotel check-in time and check-out time will be as per hotel policy <br>
                        • For arrivals at the hotel before C/In hours, the reservation needs to be made and held from the previous night. <br>
                        • For Early check-in or late check-out, a request may be made to the hotel and is subject to availability. <br>
                        • Mandatory for any Non-Resident Indians/Foreigners to produce their passport and valid visa at the time of arrival. <br>
                        • Mandatory for any Indian to carry a valid identity proof to produce at the time of arrival. <br>
                        • 02 Bottles of packaged drinking water per day. <br>
                        • Children below 6 years of age sharing with parents would be complimentary on room only basis. <br>
                        • Only food and beverage items provided by the Using Hotel are to be consumed on the hotel premises. <br>
                        • No food and/or beverages will be permitted from outside. <br>
                        • The client is liable for any damage caused to Using property or equipment by the client or the client’s guest visiting them. <br>
                        • No prohibited articles, flammable articles, or commercial goods are allowed to be stored inside the room. <br>
                        • Professional photography & videography such as Pre Wedding Shoot, Model Photography, Music Album, Film shooting etc. are not allowed in any of our Resort. <br>
                        • No unlawful behavior is permitted. <br>
                        • Cooking or any ignition is not allowed in the room. <br>
                        • Management rights: The management reserves for itself the absolute right of admission to any person in the hotel premises and to request any guest to vacate his or her room at any moment without any previous notice and without assigning any reason whatsoever. The guest shall be bound to vacate when requested to do so. In default, the management will be entitled to remove the luggage and belongings of the visitor from the room occupied by him or her - with a three-member committee in attendance - and lock the room or rent the room to another guest. This will only happen if the person(s) occupying the room(s) are disturbing the peace or/and safety of the hotel / personal or other hotel guests. <br>
                        • Guests may not move furnishings or interfere with the electrical network or any other installations in the hotel rooms or on the premises of the hotel without the consent of the hotel management. If any malfunction is discovered during your stay, please report this to the reception and we will repair this as soon as possible. <br>
                        • The bar and restaurant & Lobby area are available for receiving visitors. The rooms cannot be used by more persons than originally booked, if more persons are admitted they will be charged accordingly. <br>
                        • If the guest becomes ill or injured, the hotel can help with the provision of medical assistance or, as the case may be, to arrange for the guest to be taken to hospital, all at the guest's expense. <br>
                        • The use of WIFI is Complimentary where we have WIFI but in specified locations. <br>
                        • The use of the internet computer in the available area is free of charge for guest who stays in the hotel only, all others will be charged per hour with a minimum of one hour. <br> <br>
                        Note: Rack Rate, Special Rate & Taxes can change without any prior notice.


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