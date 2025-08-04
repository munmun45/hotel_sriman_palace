<<<<<<< HEAD
<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$blog_id = '';
$blog_image = '';
$blog_title = '';
$blog_description = '';
$today_date = date('Y-m-d'); // Get today's date

$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch blog details
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If blog found, assign values to variables
    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();

        // Assign values to form variables
        $blog_image = $blog['image'];
        $blog_title = $blog['title'];
        $blog_description = $blog['description'];
        $today_date = $blog['date']; // Set the saved date for the blog

        // Change message and button text for editing
        $message = "Update";
        $button = "Update";
    } else {
        // Handle the case where no blog is found
        echo "Blog not found.";
        exit;
    }
}
?>

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
            <h1>Blogs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Blog List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                                    <i class="bi bi-plus-circle"></i> Add Blog
                                </button>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $sql = "SELECT * FROM blogs";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {

                                        while ($blog = $result->fetch_assoc()) {

                                            $description = strlen($blog['description']) > 100 ? substr($blog['description'], 0, 50) . '...' : $blog['description'];

                                            echo "<tr>";
                                            echo "<td><img src='./uploads/" . $blog['image'] . "' alt='Blog Image' width='50' height='50'></td>";
                                            echo "<td>" . $blog['title'] . "</td>";
                                            echo "<td>" . $description . "</td>";
                                            echo "<td class='text-center'>
                                                <a href='?id=" . $blog['id'] . "' class='btn btn-sm btn-warning me-1'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>
                                                <a href='./process/delete.php?id=" . $blog['id'] . "&table_name=blogs' class='btn btn-sm btn-danger delete-btn' >
                                                    <i class='bi bi-trash-fill'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>No blogs found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBlogModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/blog" method="post" id="addBlogForm" enctype="multipart/form-data">
                            <!-- Hidden input for blog ID (for update) -->
                            <input type="hidden" name="id" value="<?= $blog_id ?>">

                            <div class="mb-3">
                                <label for="blogImage" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="blogImage" accept="image/*" >
                                
                            </div>
                            <div class="mb-3">
                                <label for="blogTitle" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="blogTitle" placeholder="Enter blog title" value="<?= $blog_title ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="blogDescription" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="blogDescription" rows="4" placeholder="Enter blog description" required><?= $blog_description ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="blogDate" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="blogDate" value="<?= $today_date ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100"><?= isset($_GET['id']) ? 'Update' : 'Submit' ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <?= require("./config/footer.php") ?>


    <script>
        $(document).ready(function() {
            // Attach a click event to the delete button
            $('.delete-btn').on('click', function(e) {
                // Prevent the default anchor action (i.e., redirect)
                e.preventDefault();

                // Get the link (URL) for deletion
                var link = $(this).attr('href');

                // Show a confirmation dialog
                var confirmDelete = confirm("Are you sure you want to delete this record?");

                // If the user confirms, proceed with deletion
                if (confirmDelete) {
                    // Use AJAX to send the delete request
                    $.ajax({
                        type: 'GET',
                        url: link, // The link includes the necessary parameters like ID, table_name, etc.
                        success: function(response) {
                            // If deletion is successful, redirect to the specified link (e.g., branch_manager)
                            if (response === 'success') {
                                alert("Record deleted successfully!");
                                window.location.href = './blog'; // Redirect to the blog page
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
    </script>


    <script>
        // Check if there is an 'id' in the URL, and show the modal if true
        const urlParams = new URLSearchParams(window.location.search);
        const facilityId = urlParams.get('id');
        if (facilityId) {
            // Open the modal automatically if the ID exists in the URL
            var myModal = new bootstrap.Modal(document.getElementById('addBlogModal'));
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
                <h2 style="font-weight: bold; font-size: 22px; margin-left: 17px;">Blog</h2>
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







        <!-- Event -->
        <div id="Event" class="content-wrapper">


            <br>
            <div class="upload_flot" id="yourBtn" onclick="event_popup( )">
                <img src="images/icon/uplading.png" alt="">
            </div>


            <div class="event_con">



                <?php

                $sql = "SELECT * FROM `blog` ";
                $result = mysqli_query($conn, $sql);
                while ($_value = mysqli_fetch_assoc($result)) {

                    echo '
                            <div class="event_main_con">

                                <div class="E_img_con" >
                                    <img src="../images/blog/' . $_value["images"] . '" alt="">
                                </div>
            
                                <div class="Content_e_con" >
            
                                    <h2> ' . $_value["name"] . '</h2>
            
                                    <p class="r_p" >' . $_value["para"] . '</p>
            
                                </div>
            
            
            
                                <div class="Delet_room_con"  onclick="window.open(`delete.php?id=' . $_value["id"] . '&t_vlaue=blog`,`_self`)" >
                                    <img  class="icon_img" src="images/icon/trash.png" alt="">
                                </div>
                                <div class="update_room_con" onclick="event_popup(`' . $_value["id"] . '`,`' . $_value["name"] . '`,`' . $_value["para"] . '`,`' . $_value["date"] . '`);" >
                                    <img  class="icon_img" src="images/icon/pencil.png" alt="">
                                </div>
            
            
                            </div>
                        ';
                }

                ?>






            </div>


        </div>




































        <!-- add event -->
        <div class="Form_popup" id="popup">



            <div class="uplode_room_Form">

                <form id="event_form" action="" method="post" enctype="multipart/form-data">

                    <input style="display:none;" class="input_text" type="text" name="id" id="event_id">
                    <div class="form">

                        <div class="form_con f">

                            <div class="form_sub_con">

                                <input class="input_text" type="text" name="name" id="event_name" placeholder="Blog Title">

                            </div>
                            <div class="form_sub_con">
                                <input class="input_text" type="date" name="date" id="event_date">

                            </div>

                        </div>

                        <div class="form_con " style="flex-grow: 0;">

                            <input accept=".jpg, .jpeg" style="margin: 5px; font-size :15px; padding: 11px; cursor: pointer;" class="input_text" type="file" name="image" id="event_img">

                        </div>

                        <div class="form_con">


                            <textarea class="flli_message" name="para" id="event_para" placeholder="Enter description"></textarea>


                        </div>

                        <div class="btn_com">

                            <input class="f_btn" type="submit" value="Submit" name="Submit" id="event_save_btn">
                            <input class="f_btn" type="reset" value="Clear">

                        </div>

                    </div>


                </form>

            </div>






            <div class="close_btn" onclick="close_puppup()">

                <h2 id="Event_title">Warning</h2>

                <img src="images/icon/delete.png" alt="">

            </div>

        </div>













        <script>
            // event form btn

            function event_popup(id, name, para, date) {

                let Form_title = document.getElementById("Event_title");
                let Room_save_btn = document.getElementById("event_save_btn");
                let room_form = document.getElementById("event_form");

                let _id = document.getElementById("event_id");
                let _name = document.getElementById("event_name");
                let _para = document.getElementById("event_para");
                let _date = document.getElementById("event_date");

                if (id) {
                    _name.setAttribute("value", name);
                    _para.value = para;
                    _date.setAttribute("value", date);
                    _id.setAttribute("value", id);

                    Room_save_btn.setAttribute("value", "Update");
                    room_form.setAttribute("action", "update_blog.php");
                    Form_title.innerText = " Update Blog ";

                } else {
                    _name.setAttribute("value", "");
                    _para.value = "";
                    _date.setAttribute("value", "");
                    _id.setAttribute("value", "");

                    room_form.setAttribute("action", "blog_insert.php");
                    Room_save_btn.setAttribute("value", "Submit");

                    Form_title.innerText = " Add New Blog ";


                }

                document.getElementById("popup").style.display = "flex";

            }





            function close_puppup() {
                document.getElementById("popup").style.display = "none";
            }
        </script>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function() {

                var _URL = window.URL || window.webkitURL;

                $('#event_img').change(function() {
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

                            // $("#event_img").val(null);

                        } else {
                            alert(" Width = 1280  , height = 720  ");
                            $("#event_img").val(null);

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