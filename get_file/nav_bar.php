<div class="nav_bar">
    <div class="nav_con left_nav">

        <img class="nav_icon" style="z-index: 1;" onclick="click_sideMenu()" src="images/icon/menu-icon.png" alt="">

        <?php
        $sql = "SELECT * FROM `contact` ";
        $result = mysqli_query($conn, $sql);
        $_value = mysqli_fetch_assoc($result);

        echo '
                    <img style="margin-left: 30px;"  class="nav_icon" id="call_icon_pc" onclick="window.open(`tel:' . $_value["number"] . '`,`_self`)" src="images/icon/call.png" alt="">
                ';
        ?>


    </div>
    <div class="nav_con mid_nav">
        <img onclick="window.open('/','_self')" class="nav_logo" src="images/logo/logo.png" alt="">
    </div>
    <div class="nav_con right_nav">
        <?php
        $sql = "SELECT * FROM `contact` ";
        $result = mysqli_query($conn, $sql);
        $_value = mysqli_fetch_assoc($result);

        echo '
                    <img class="nav_icon" id="call_icon_mob" onclick="window.open(`tel:' . $_value["number"] . '`,`_self`)" src="images/icon/call.png" alt="">
                ';
        ?>


        <div class="nav_Book_con">
            <button onclick="window.open('book_room.php','_self')" class="nav_book_btn">BOOK ROOM</button>
            <div class="nav_book_btn_space">|</div>
            <button onclick="window.open('book_DINING.php','_self')" class="nav_book_btn">BOOK
                DINING</button>
            <div class="nav_book_btn_space">|</div>
            <button onclick="window.open('book_Event.php','_self')" class="nav_book_btn">BOOK
                EVENT</button>
            <!-- <button onclick="window.open('booking.php','_self')" class="nav_book_btn">BOOKING</button> -->
        </div>
    </div>
</div>
</div>