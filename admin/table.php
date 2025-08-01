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
                <h2 style="font-weight: bold; font-size: 22px; margin-left: 17px;">Table</h2>
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













        <!-- Table -->
        <div id="Table" class="content-wrapper">

            <br>
            <div class="upload_flot" id="yourBtn" onclick="table_popup( )">
                <img src="images/icon/uplading.png" alt="">
            </div>


            <div class="Description_slider_con">


                <?php

                $sql = "SELECT * FROM `table` ";
                $result = mysqli_query($conn, $sql);
                while ($_value = mysqli_fetch_assoc($result)) {

                    echo '




                            <div class="room_con" >
                                <div class="room_sub_con" >

                                    <div class="Top_room" >
                                        <h2>' . $_value["name"] . '</h2>
                                    </div>
                                    <div class="bottom_room" >
                                        <p class="r_p" >' . $_value["para"] . '</p>
                                    </div>

                                </div>
                                <div class="border" ></div>
                                <div class="room_sub_con_2" >
                                    <div class="Top_room" >
                                        <h2>Book Form ' . $_value["price"] . '</h2>
                                    </div>
                                    <div class="bottom_room" >
                                        <p>' . $_value["facility"] . '</p>
                                    </div>
                                    <div class="bottom_room" style="flex-grow: 2;" >
                                        <img  class="Image_con_img" src="../images/table/' . $_value["images"] . '" alt="">
                                    </div>

                                </div>

                                <div class="Delet_room_con" onclick="window.open(`delete.php?id=' . $_value["id"] . '&t_vlaue=table`,`_self`)" >
                                    <img  class="icon_img" src="images/icon/trash.png" alt="">
                                </div>
                                <div class="update_room_con" onclick="table_popup(`' . $_value["id"] . '`,`' . $_value["name"] . '`,`' . $_value["para"] . '`,`' . $_value["price"] . '`);" >
                                    <img  class="icon_img" src="images/icon/pencil.png" alt="">
                                </div>

                            </div>







                        ';
                }

                ?>





            </div>



        </div>





























        <!-- pop up form for room & table -->

        <div class="Form_popup" id="popup">



            <div class="uplode_room_Form">

                <form id="room_form" action="" method="post" enctype="multipart/form-data">

                    <input style="display:none;" class="input_text" type="text" name="id" id="room_id">
                    <div class="form">

                        <div class="form_con f">

                            <div class="form_sub_con">

                                <input class="input_text" type="text" name="name" id="room_name" placeholder="Table Name">

                            </div>
                            <div class="form_sub_con">
                                <input class="input_text" type="number" name="prise" id="room_prise" placeholder="Table Price">

                            </div>

                        </div>
                        <div class="form_con " style="flex-grow: 0;">

                            <input accept=".jpg, .jpeg" style="margin: 5px; font-size :15px; margin: 5px; font-size :15px; padding: 11px; cursor: pointer;" class="input_text" type="file" name="image" id="room_img">



                        </div>
                        <div class="form_con">


                            <textarea class="flli_message" name="para" id="room_para" placeholder="Enter description"></textarea>


                        </div>

                        <div class="btn_com">

                            <input class="f_btn" type="submit" value="Submit" name="Submit" id="Room_save_btn">
                            <input class="f_btn" type="reset" value="Clear">

                        </div>

                    </div>


                </form>

            </div>






            <div class="close_btn" onclick="close_puppup()">

                <h2 id="Form_title">Warning</h2>

                <img src="images/icon/delete.png" alt="">

            </div>

        </div>


























        <script>
            function table_popup(id, name, para, prise) {

                let Form_title = document.getElementById("Form_title");
                let Room_save_btn = document.getElementById("Room_save_btn");
                let room_form = document.getElementById("room_form");
                let _id = document.getElementById("room_id");
                let _name = document.getElementById("room_name");
                let _para = document.getElementById("room_para");
                let _prise = document.getElementById("room_prise");


                if (id) {
                    _name.setAttribute("value", name);
                    _para.value = para;
                    _prise.setAttribute("value", prise);
                    _id.setAttribute("value", id);

                    Room_save_btn.setAttribute("value", "Update");
                    room_form.setAttribute("action", "update_table.php");
                    Form_title.innerText = " Update Table ";








                } else {
                    _name.setAttribute("value", "");
                    _para.value = "";
                    _prise.setAttribute("value", "");
                    _id.setAttribute("value", "");

                    room_form.setAttribute("action", "table_insert.php");
                    Room_save_btn.setAttribute("value", "Submit");

                    Form_title.innerText = "Add New Table ";

                }

                document.getElementById("popup").style.display = "flex";
            }



            function close_puppup() {


                document.getElementById("popup").style.display = "none";
                document.getElementById("e_popup").style.display = "none";
            }
        </script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function() {

                var _URL = window.URL || window.webkitURL;

                $('#room_img').change(function() {
                    var file = $(this)[0].files[0];

                    img = new Image();
                    var imgwidth = 0;
                    var imgheight = 0;
                    var maxwidth = 1280;
                    var maxheight = 720;

                    img.src = _URL.createObjectURL(file);

                    img.onload = function() {
                        imgwidth = this.width;
                        imgheight = this.height;

                        if (imgwidth == maxwidth && imgheight == maxheight) {

                            // $("#room_img").val(null);

                        } else {
                            alert(" Width = 1280  , height = 720  ");
                            $("#room_img").val(null);

                        }
                    };

                });
            });
        </script>










    </div>


</body>


<!-- Mirrored from technext.github.io/admincast/index.html by HTTrack Website Copier/3.x [XR&CO' 2014], Wed, 29 Sep 2021 13:52:28 GMT -->

</html>