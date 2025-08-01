<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admin Panels</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/themify-icons.css" rel="stylesheet" />
    <link href="css/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <link href="css/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css?v=5">


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

</head>

<body class="fixed-navbar">

    <script>
        if (sessionStorage.getItem("login") != "login") {
            window.location.href = 'index.php';
            exit;
        }
    </script>

    <?php
    require("../mysqli_con/mysqli_con.php");
    ?>

    <div class="page-wrapper">

        <header class="header">

            <div class="page-brand">

                <a class="link" href="#"><span class="brand" style="font-weight:bold">Admin Panel</span></a>

            </div>

            <div class="flexbox flex-1">
                <h2 style="font-weight: bold; font-size: 22px; margin-left: 17px;">Dashboard</h2>

                <div class="profile_con" onclick="document.getElementById('hover_logOut').style.height = '100px' ;  document.getElementById('hover_logOut').style.overflow = 'visible'  ">
                    <img src="images/icon/power.png" width="45px" />
                </div>
            </div>

            <div id="hover_logOut" class="hover_logOut">


                <div class="logut_btn_con">


                    <div class="log_out_btn" onclick="window.open('index.php','_self')">

                        <img height="20px" src="images/icon/logout.png" alt="">

                        <h2 style="font-weight: bold; font-size: 15px; margin-left: 17px;  margin-bottom: 0px; ">Logout</h2>

                    </div>
                    <div class="log_out_btn" onclick="document.getElementById('hover_logOut').style.height = '300px';">

                        <img height="20px" src="images/icon/padlock.png" alt="">
                        <h2 style="font-weight: bold; font-size: 15px; margin-left: 17px;  margin-bottom: 0px; ">Cheng Pasword</h2>

                    </div>

                    <form action="change_pass.php" method="post">

                        <div class="log_out_btn" onclick="document.getElementById('hover_logOut').style.height = '300px';">

                            <input type="password" name="O_P" id="" placeholder="Old Password">

                        </div>
                        <div class="log_out_btn" onclick="document.getElementById('hover_logOut').style.height = '300px';">

                            <input type="password" name="N_P" id="" placeholder="New Password">

                        </div>
                        <div class="log_out_btn" onclick="document.getElementById('hover_logOut').style.height = '300px';">

                            <input type="submit" name="Submit" value="Change Password">

                        </div>

                    </form>




                </div>


                <img onclick="document.getElementById('hover_logOut').style.height = '0px'; document.getElementById('hover_logOut').style.overflow = 'hidden' " src="images/icon/delete2.png" width="45px" style="position: absolute; top: 6px; right: 10px; cursor: pointer;" />


            </div>

        </header>

        <?php
        require("../get_file/admin_nav.php");
        ?>




        <div id="Dashboard" class="content-wrapper">

            <?php

            $sql = "SELECT * FROM `contact` ";
            $result = mysqli_query($conn, $sql);
            while ($_value = mysqli_fetch_assoc($result)) {

                echo '
                    
                    <div class="Contact_con_A">

                        <div class="offers_con_2">
        
                            <p class="o_P"> ' . $_value["number"] . '</p>
        
                            <div class="edit_btn" style="width:50px " onclick="event_popup( `' . $_value["id"] . '` , `number` )">
                                <img style="height:20px;" src="images/icon/pencil.png" alt="">
                            </div>
        
                        </div>
                        <div class="offers_con_2">
        
                            <p class="o_P"> ' . $_value["email"] . ' </p>
        
                            <div class="edit_btn" style="width:50px " onclick="event_popup( `' . $_value["id"] . '` , `email` )" >
                                <img style="height:20px;" src="images/icon/pencil.png" alt="">
                            </div>
        
                        </div>
        
                    </div>
                    
                    ';
            }


            ?>













        </div>











































        <div class="Form_popup" id="popup">



            <div class="uplode_room_Form">

                <form id="event_form" action="edit_contact.php" method="post" enctype="multipart/form-data">

                    <input style="display:none;" class="input_text" type="text" name="id" id="event_id">
                    <div class="form">


                        <div class="form_con">


                            <textarea class="flli_message" id="event_para" placeholder="Enter  "></textarea>


                        </div>

                        <div class="btn_com">

                            <input class="f_btn" type="submit" value="Submit" name="Submit" id="event_save_btn">
                            <input class="f_btn" type="reset" value="Clear">

                        </div>

                    </div>


                </form>

            </div>



            <div class="close_btn" onclick="close_puppup()">

                <h2 id="Event_title">Add Offers</h2>

                <img src="images/icon/delete.png" alt="">

            </div>

        </div>








    </div>










    <script>
        // event form btn

        let _id = document.getElementById("event_id");
        let _event_para = document.getElementById("event_para");

        function event_popup(id, name) {

            document.getElementById("popup").style.display = "flex";
            _id.setAttribute("value", id);
            _event_para.setAttribute("name", name);
        }


        function close_puppup() {
            document.getElementById("popup").style.display = "none";
        }
    </script>


</body>


<!-- Mirrored from technext.github.io/admincast/index.html by HTTrack Website Copier/3.x [XR&CO' 2014], Wed, 29 Sep 2021 13:52:28 GMT -->

</html>