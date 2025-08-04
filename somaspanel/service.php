<<<<<<< HEAD
<?php
require("./config/config.php");

$service_id = '';
$service_title = '';
$service_description = '';
$service_image_1 = '';
$service_image_2 = '';
$faq_1 = '';
$faq_2 = '';
$faq_3 = '';
$faq_4 = '';
$faq_5 = '';

$message = "Add";
$button = "Submit";

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Fetch the service details from the database
    $sql = "SELECT * FROM services WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
        $service_title = $service['title'];
        $service_description = $service['description'];
        $service_image_1 = $service['image_1'];
        $service_image_2 = $service['image_2'];
        $faq_1 = $service['faq_1'];
        $faq_2 = $service['faq_2'];
        $faq_3 = $service['faq_3'];
        $faq_4 = $service['faq_4'];
        $faq_5 = $service['faq_5'];

        $message = "Update";
        $button = "Update";
    } else {
        echo "Service not found.";
        exit;
    }
}
?>

<!-- Main HTML structure -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?= require("./config/meta.php") ?>
</head>

<body>
    <?= require("./config/header.php") ?>
    <?= require("./config/menu.php") ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Services</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Service</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Service List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                    <i class="bi bi-plus-circle"></i> Add Service
                                </button>
                            </div>

                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM services";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($service = $result->fetch_assoc()) {
                                            // Get the image filename, or set a default if no image exists
                                            $image_1 = $service['image_1'] ? './uploads/' . $service['image_1'] : 'path/to/default-image.jpg';
                                            $image_2 = $service['image_1'] ? './uploads/' . $service['image_2'] : 'path/to/default-image.jpg';
                                            // Truncate the description to one line (if necessary)
                                            $description = strlen($service['description']) > 100 ? substr($service['description'], 0, 50) . '...' : $service['description'];

                                            echo "<tr>";
                                            echo "<td><img src='$image_1' alt='Service Image' style='width: 50px; height: 50px; object-fit: cover;'> <img src='$image_2' alt='Service Image' style='width: 50px; height: 50px; object-fit: cover;'> </td>"; // Display image
                                            echo "<td>" . $service['title'] . "</td>"; // Display title
                                            echo "<td>" . $description . "</td>"; // Display truncated description
                                            echo "<td class='text-center'>
                    <a href='?id=" . $service['id'] . "' class='btn btn-sm btn-warning me-1'>
                        <i class='bi bi-pencil-fill'></i>
                    </a>
                    <a href='./process/delete.php?id=" . $service['id'] . "&table_name=services' class='btn btn-sm btn-danger delete-btn' >
                        <i class='bi bi-trash-fill'></i>
                    </a>
                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>No services found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal for adding or updating service -->
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Make the modal larger with 'modal-lg' -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/services" method="post" id="addServiceForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $service_id ?>">

                            <div class="row"> <!-- Start of row for the grid system -->

                                <!-- First column for Title and Description -->
                                <div class="col-md-6 mb-3">
                                    <label for="serviceTitle" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="serviceTitle" value="<?= $service_title ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="serviceDescription" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="serviceDescription" required><?= $service_description ?></textarea>
                                </div>

                                <!-- Second column for Image 1, Image 2, and FAQ Fields -->
                                <div class="col-md-6 mb-3">
                                    <label for="serviceImage1" class="form-label">Image 1</label>
                                    <input type="file" name="image_1" class="form-control" id="serviceImage1">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="serviceImage2" class="form-label">Image 2</label>
                                    <input type="file" name="image_2" class="form-control" id="serviceImage2">
                                </div>

                                <!-- FAQ 1 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_1" class="form-label">FAQ 1</label>
                                    <textarea name="faq_1" class="form-control" required><?= $faq_1 ?></textarea>
                                </div>

                                <!-- FAQ 2 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_2" class="form-label">FAQ 2</label>
                                    <textarea name="faq_2" class="form-control" required><?= $faq_2 ?></textarea>
                                </div>

                                <!-- FAQ 3 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_3" class="form-label">FAQ 3</label>
                                    <textarea name="faq_3" class="form-control" required><?= $faq_3 ?></textarea>
                                </div>

                                <!-- FAQ 4 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_4" class="form-label">FAQ 4</label>
                                    <textarea name="faq_4" class="form-control" required><?= $faq_4 ?></textarea>
                                </div>

                                <!-- FAQ 5 -->
                                <div class="col-md-6 mb-3">
                                    <label for="faq_5" class="form-label">FAQ 5</label>
                                    <textarea name="faq_5" class="form-control" required><?= $faq_5 ?></textarea>
                                </div>

                            </div> <!-- End of row for the grid system -->

                            <button type="submit" class="btn btn-success w-100"><?= isset($_GET['id']) ? 'Update' : 'Submit' ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <?= require("./config/footer.php") ?>


    <script>
        // Delete confirmation using AJAX
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                var link = $(this).attr('href');
                var confirmDelete = confirm("Are you sure you want to delete this record?");
                if (confirmDelete) {
                    $.ajax({
                        type: 'GET',
                        url: link,
                        success: function(response) {
                            if (response === 'success') {
                                alert("Record deleted successfully!");
                                window.location.href = './service'; // Redirect back to the services list
                            } else {
                                alert("Error deleting record.");
                            }
                        },
                        error: function(xhr, status, error) {
                            alert("Error: " + error);
                        }
                    });
                }
            });
        });

        // Automatically show the modal if editing a service
        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = urlParams.get('id');
        if (serviceId) {
            var myModal = new bootstrap.Modal(document.getElementById('addServiceModal'));
            myModal.show();
        }
    </script>

</body>

=======
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
                <h2 style="font-weight: bold; font-size: 22px; margin-left: 17px;">Service</h2>
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








        <!-- Room -->
        <div id="Room" class="content-wrapper">

            <br>

            <div class="upload_flot" id="yourBtn" onclick="popup( )">
                <img src="images/icon/uplading.png" alt="">
            </div>


            <div class="Description_slider_con">


                <?php

                $sql = "SELECT * FROM `service` ";
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
                                <div class="room_sub_con_2 " >
                                    <div class="Top_room" >
                                        <h2>Book Form ' . $_value["price"] . '</h2>
                                    </div>
                                   
                                    <div class="bottom_room" style="flex-grow: 2;" >
                                        <img  class="Image_con_img" src="../images/service/' . $_value["images"] . '" alt="">
                                    </div>

                                </div>

                                <div class="Delet_room_con" onclick="window.open(`delete.php?id=' . $_value["id"] . '&t_vlaue=service`,`_self`)" >
                                    <img  class="icon_img" src="images/icon/trash.png" alt="">
                                </div>
                                <div class="update_room_con" onclick="popup(`' . $_value["id"] . '`,`' . $_value["name"] . '`,`' . $_value["para"] . '`,`' . $_value["price"] . '`);" >
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

                                <input class="input_text" type="text" name="name" id="room_name" placeholder="Service Name">

                            </div>
                            <div class="form_sub_con">
                                <input class="input_text" type="number" name="prise" id="room_prise" placeholder="Service Price ">

                            </div>

                        </div>



                        <div class="form_con f">


                            <div class="form_sub_con">

                                <h2 style="margin: 5px; margin-top:5px ; color: white; font-weight: bold;">Image</h2>
                                <input accept=".jpg, .jpeg" style="margin: 0px; font-size :15px; padding: 11px; cursor: pointer;" class="input_text" type="file" name="image" id="room_img">

                            </div>
                            <div class="form_sub_con">

                                <h2 style="margin: 5px; margin-top:5px ; color: white; font-weight: bold;">Icon</h2>
                                <input accept=".png" style="margin: 0px; font-size :15px; padding: 11px; cursor: pointer;" class="input_text" type="file" name="logo" id="icon">

                            </div>

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
            //...............




            function popup(id, name, para, prise) {

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
                    room_form.setAttribute("action", "update_service.php");
                    Form_title.innerText = " Update Service ";

                } else {
                    _name.setAttribute("value", "");
                    _para.value = "";
                    _prise.setAttribute("value", "");
                    _id.setAttribute("value", "");

                    room_form.setAttribute("action", "service_insert.php");
                    Room_save_btn.setAttribute("value", "Submit");

                    Form_title.innerText = " Add New Service ";


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
                    var maxwidth = 800;
                    var maxheight = 800;

                    img.src = _URL.createObjectURL(file);

                    img.onload = function() {
                        imgwidth = this.width;
                        imgheight = this.height;

                        if (imgwidth == maxwidth && imgheight == maxheight) {

                            // $("#room_img").val(null);

                        } else {
                            alert(" Width = 800  , height = 800  ");
                            $("#room_img").val(null);

                        }
                    };

                });
            });
        </script>










    </div>


</body>


<!-- Mirrored from technext.github.io/admincast/index.html by HTTrack Website Copier/3.x [XR&CO' 2014], Wed, 29 Sep 2021 13:52:28 GMT -->

>>>>>>> 8d8fbf65c053b574be27260f7f79fdd638fb40f9
</html>