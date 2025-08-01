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
                <h2 style="font-weight: bold; font-size: 22px; margin-left: 17px;">Slider</h2>

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





        <!-- slider -->
        <div id="slider" class="content-wrapper">
            <br>



            <form class="upload_flot" action="slider_insert.php" method="POST" enctype="multipart/form-data" name="slider_img">

                <div id="yourBtn" onclick="getFile()">
                    <img src="images/icon/uplading.png" alt="">
                </div>
                <div style='height: 0px;width: 0px; overflow:hidden;'> <input accept=".jpg, .jpeg" id="upfile" name="doc" type="file" value="upload" onchange="sub(this)" /> </div>

            </form>

            <div class="Description_slider_con">

                <?php

                $sql = "SELECT * FROM `slider` ORDER BY id DESC ";
                $result = mysqli_query($conn, $sql);
                while ($_value = mysqli_fetch_assoc($result)) {

                    echo '

                            <div class="Image_con" >
                                <img class="Image_con_img" src="../images/slider/' . $_value["image"] . '" alt="">
                                <div class="Delet_img_con" onclick="window.open(`delete.php?id=' . $_value["id"] . '&t_vlaue=slider`,`_self`)" >
                                    <img src="images/icon/trash.png" alt="">
                                </div>
                            </div>
                        ';
                }

                ?>


            </div>


        </div>



























        <script>
            function getFile() {
                document.getElementById("upfile").click();
            }

            function sub(obj) {
                var file = obj.value;
                var fileName = file.split("\\");
                document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
                document.slider_img.submit();
                event.preventDefault();

            }

            //..........
        </script>










    </div>


</body>


<!-- Mirrored from technext.github.io/admincast/index.html by HTTrack Website Copier/3.x [XR&CO' 2014], Wed, 29 Sep 2021 13:52:28 GMT -->

</html>