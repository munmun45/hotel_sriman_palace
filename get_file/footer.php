<footer>

    <img src="images/logo/logo_2.png" alt="" class="footer_logo">


    <div class="card_sub_con_f">



        <div class="footer_con">

            <h2 class="white footer_title">About</h2>

            <br>

            <p class="white f_12">hotel sriman palace is one of the most spectacular beach resort in Gopalpur – On – Sea in Ganjam District of Odisha – Eastern India. This legendary resort was previously known as The Blue Haven Resort and was originally built in 1919 </p>

            <br>
            <br>

            <h2 class="white footer_title">Reservation</h2>

            <br>

            <?php
            $sql = "SELECT * FROM `contact` ";
            $result = mysqli_query($conn, $sql);
            $_value = mysqli_fetch_assoc($result);

            echo '

                    <p class="white f_12"> Beach road, Gopalpur, Odisha 761002 <br> <br> +91 ' . $_value["number"] . '  <br><br> ' . $_value["email"] . ' </p>
                ';
            ?>

            



        </div>

        <div class="f_line"></div>


        <div class="footer_con">

            <h2 class="white footer_title">Quick link</h2>

            <br>

            <p class="f_para">


                <a class="footer_link f_12 " href="index.php"> Home </a>
                <a class="footer_link f_12 " href="About.php"> The Story </a>
                <a class="footer_link f_12 " href="book_room.php"> The Room </a>
                <a class="footer_link f_12 " href="book_DINING.php"> Dining </a>
                <a class="footer_link f_12 " href="book_Event.php"> Event </a>
                <a class="footer_link f_12 " href="service.php"> Services </a>
                <a class="footer_link f_12 " href="#"> Package </a>
                <a class="footer_link f_12 " href="ACTIVITIES.php"> Activities </a>
                <a class="footer_link f_12 " href="Gallery.php"> Gallery </a>



            </p>

            <br>
            <br>

            <h2 class="white footer_title">Follow Us</h2>

            <br>

            <p>
                <img class="sosial_footer" src="images/icon/facebook.png" alt="">
                <img class="sosial_footer" src="images/icon/whatsapp.png" alt="">
                <img class="sosial_footer" src="images/icon/instagram.png" alt="">

            </p>

            <br>
            <br>


            <h2 class="white footer_title"> Our Policy </h2>

            <br>

            <p class="f_para">


                <a class="footer_link f_12 " href="payment-policy.php"> Payment Policy </a>
                <a class="footer_link f_12 " href="cancellation-policy.php"> Cancellation Policy </a>
                <a class="footer_link f_12 " href="refund-policy.php"> Refund Policy </a>
                <a class="footer_link f_12 " href="privacy-policy.php" > Privacy Policy </a>
                <a class="footer_link f_12 " href="hotel-terms.php"> Terms & Conditions </a>
                <a class="footer_link f_12 " href="#">  </a>




            </p>



        </div>






    </div>


    <div class="footer_bootom">

        <p class="white">© Copyright www.hotelsrimanpalace.com </p>

    </div>

</footer>