<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
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
                    <h2 class="Home_title center_text">Privacy Policy</h2>

                    <br>
                    <br>

                    <p class="our_story_description">
                        
                        Hotel Sriman Palace welcomes you to its website and looks forward to a meaningful interaction with you. hotelsrimanpalace.com respects your right to privacy. Any personal information that you share with us, like your name, date of birth, address, marital status, telephone number, credit card particulars and the like, shall be entitled to privacy and kept confidential. <br><br>
                        hotelsrimanpalace.com assures you that your personal information shall not be used/disclosed by it, save for the purpose of doing the intended business with you, or if required to be disclosed under the due process of law. <br><br>
                        www.hotelsrimanpalace.com reserves its rights to collect, analyze and disseminate aggregate site usage patterns of all its visitors with a view to enhancing services to its visitors. This includes sharing the information with its holding company as a general business practice. <br><br>
                        In the course of its business www.hotelsrimanpalace.com may hold on-line contests and surveys as permitted by law and it reserves its right to use and disseminate the information so collected to enhance its services to the visitors. This shall also include sharing the information with its holding company as a general business practice <br><br>
                        If you have any questions or concerns regarding your privacy issues, please do not hesitate to contact Hotel Sriman Palace at Info@hotelsrimanpalace.com <br><br>
                        While www.hotelsrimanpalace.com assures you that it will do its best to ensure the privacy and security of your personal information, it shall not be responsible in any manner whatsoever for any violation or misuse of your personal information by unauthorized person’s consequent to misuse of the internet environment. <br><br>
                        www.hotelsrimanpalace.com reserves its rights to revise this privacy policy from time to time at its discretion with a view to making the policy more user-friendly. <br><br>
                        In the design of our website, we have taken care to draw your attention to this privacy policy so that you are aware of the terms under which you may decide to share your personal information with us. Accordingly, should you choose to share your personal information with us, www.hotelsrimanpalace.com will assume that you have no objections to the terms of this privacy policy. <br><br>
                        When you make a reservation on www.hotelsrimanpalace.com, you will be asked to enter personal information in order to secure your reservation. This information is submitted to our booking partner and our Web Hosting provider. www.hotelsrimanpalace.com and these service providers WILL NOT sell or distribute any personal information about you or any other individual traveler. <br><br> The name, address and phone number you provide may be used for marketing or quality assurance purposes for the benefit of www.hotelsrimanpalace.com While you will receive an e-mail confirmation whenever you make a reservation on-line, you will not receive any unsolicited e-mail as a result of making a reservation on our site. On www. hotelsrimanpalace.com, we strive to ensure that the most secure encryption technology is used, to allow you to book your travel reservations without the worry of someone misusing any information provided by you. <br><br>
                        To make your reservation planning more convenient, we use what is known as a "cookie", which allows the system to temporarily remember your travel dates and preferences during each visit to the site. Cookies also allow us to track the more frequently visited pages of www.mayfairhotels.com, which helps us to improve the site for your benefit. Cookies are not programs that will corrupt your computer or damage your files. The cookies used do not reveal your personal identity, nor can they capture personal or private data. Our cookies automatically expire as soon as you leave our site. <br><br>
                        If you do not want to accept cookies while on our site, please change your Internet browser settings. However, if you decide to not accept cookies while visiting www.mayfairhotels.com, you may not be able to complete certain transactions. <br><br>
                        The www.mayfairhotels.com site does contain external links that will take you away from www.mayfairhotels.com to our travel partners. We are not responsible for the privacy practices or the content of these sites. <br><br>
                        DISCLAIMER: ELECTRONIC TRANSMISSIONS, INCLUDING THE INTERNET, ARE PUBLIC MEDIA, AND ANY USE OF SUCH MEDIA IS PUBLIC AND NOT PRIVATE. INFORMATION RELATED TO OR ARISING FROM SUCH USE IS PUBLIC, OR THE PROPERTY OF THOSE COLLECTING INFORMATION, AND NOT PERSONAL OR PRIVATE INFORMATION.


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