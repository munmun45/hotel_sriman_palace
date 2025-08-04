<<<<<<< HEAD
<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$room_id = '';
$room_name = '';
$room_description = '';
$max_capacity = '';
$max_extra_adults = '';
$extra_adult_price = '';
$total_room = '';
$video_url = '';
$room_price = '';
$image_1 = '';
$image_2 = '';
$image_3 = '';
$image_4 = '';
$image_5 = '';
$facilities = []; // For storing the facilities

$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch room details
    $sql = "SELECT * FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If room found, assign values to variables
    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();

        // Assign values to form variables
        $room_name = $room['name'];
        $room_description = $room['description'];
        $max_capacity = $room['max_capacity'];
        $max_extra_adults = $room['max_extra_adults'];
        $extra_adult_price = $room['extra_adult_price'];
        $total_room = $room['total_room'];
        $video_url = $room['video_url'];
        $room_price = $room['price'];


        $food_plan_cp_price = $room['food_plan_cp'];
        $food_plan_map_price = $room['food_plan_map'];
        $food_plan_ap_price = $room['food_plan_ap'];


        $image_1 = $room['image_1'];
        $image_2 = $room['image_2'];
        $image_3 = $room['image_3'];
        $image_4 = $room['image_4'];
        $image_5 = $room['image_5'];
        $facilities = explode(',', $room['facilities']); // Assuming facilities are stored as comma-separated values in the DB

        // Change message and button text for editing
        $message = "Update";
        $button = "Update";
    } else {
        // Handle the case where no room is found
        echo "Room not found.";
        exit;
    }
}

// Fetch facilities from the database
$facility_sql = "SELECT * FROM facilities"; // Assuming you have a 'facilities' table
$facility_result = $conn->query($facility_sql);
$facility_options = [];
if ($facility_result->num_rows > 0) {
    while ($facility = $facility_result->fetch_assoc()) {
        $facility_options[] = $facility;
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
            <h1>Rooms</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Rooms</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Room List</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                                    <i class="bi bi-plus-circle"></i> Add Room
                                </button>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Max Capacity</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM rooms";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($room = $result->fetch_assoc()) {
                                            // Prepare image path
                                            $image_path = "./uploads/" . $room['image_1']; // Assuming image_1 is stored in the database
                                            // Check if the image exists
                                            $image_exists = file_exists($image_path) ? $image_path : './uploads/default.jpg'; // Default image if not found

                                            $description = strlen($room['description']) > 100 ? substr($room['description'], 0, 50) . '...' : $room['description'];

                                            // Display row
                                            echo "<tr>";
                                            echo "<td>" . $room['name'] . "</td>";
                                            echo "<td>" . $description . "</td>";
                                            echo "<td><img src='" . $image_exists . "' alt='" . $room['name'] . "' style='width: 50px; height: 50px; object-fit: cover;'></td>";
                                            echo "<td>" . $room['price'] . "</td>";
                                            echo "<td>" . $room['max_capacity'] . "</td>";
                                            echo "<td class='text-center'>
                                                <a href='?id=" . $room['id'] . "' class='btn btn-sm btn-warning me-1'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>
                                                <a href='./process/delete.php?id=" . $room['id'] . "&table_name=rooms' class='btn btn-sm btn-danger delete-btn' >
                                                    <i class='bi bi-trash-fill'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No rooms found</td></tr>";
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

        <!-- Modal for Adding/Editing Room -->
        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"> <!-- Increased modal size -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/room.php" method="post" id="addRoomForm" enctype="multipart/form-data">
                            <!-- Hidden input for room ID (for update) -->
                            <input type="hidden" name="id" value="<?= $room_id ?>">

                            <div class="row">
                                <!-- Room Name and Description in Two Columns -->
                                <div class="col-md-6 mb-3">
                                    <label for="roomName" class="form-label">Room Name</label>
                                    <input type="text" name="name" class="form-control" id="roomName" placeholder="Enter room name" value="<?= $room_name ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="roomPrice" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" id="roomPrice" placeholder="Enter room price" value="<?= $room_price ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Room Description and Images in Two Columns -->
                                <div class="col-md-12 mb-3">
                                    <label for="roomDescription" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="roomDescription" placeholder="Enter room description" required><?= $room_description ?></textarea>
                                </div>
                            </div>

                            <!-- Food Plans Section -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h5 class="form-label"> <b>Food Plans</b> </h5>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="food_plan_cp" class="form-label">Price for CP</label>
                                            <input type="number" name="food_plan_cp" id="food_plan_cp" class="form-control" value="<?= $food_plan_cp_price ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="food_plan_map" class="form-label">Price for MAP</label>
                                            <input type="number" name="food_plan_map" id="food_plan_map" class="form-control" value="<?= $food_plan_map_price ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="food_plan_ap" class="form-label">Price for AP</label>
                                            <input type="number" name="food_plan_ap" id="food_plan_ap" class="form-control" value="<?= $food_plan_ap_price ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Max Capacity, Total Rooms, Video URL, and Extra Adult Fields -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="maxCapacity" class="form-label">Max Capacity</label>
                                    <input type="number" name="max_capacity" class="form-control" id="maxCapacity" placeholder="Enter Max Capacity" value="<?= $max_capacity ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="totalRoom" class="form-label">Total Number of Rooms</label>
                                    <input type="number" name="total_room" class="form-control" id="totalRoom" placeholder="Enter total number of rooms" value="<?= $total_room ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="maxExtraAdults" class="form-label">Max Extra Adults</label>
                                    <input type="number" name="max_extra_adults" class="form-control" id="maxExtraAdults" value="<?= $max_extra_adults ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="extraAdultPrice" class="form-label">Extra Adult Price</label>
                                    <input type="number" name="extra_adult_price" class="form-control" id="extraAdultPrice" value="<?= $extra_adult_price ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="videoUrl" class="form-label">Video URL</label>
                                    <input type="text" name="video_url" class="form-control" id="videoUrl" placeholder="Enter video URL" value="<?= $video_url ?>">
                                </div>
                            </div>



                            <!-- Select Facilities with Checkboxes -->
                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h5 class="form-label"> <b>Select Facilities</b> </h5>

                                    <div class="row" style="    margin-left: 10px;">
                                        <?php foreach ($facility_options as $facility): ?>
                                            <div class="form-check col-md-3">
                                                <input type="checkbox" name="facilities[]" value="<?= $facility['id'] ?>" class="form-check-input" id="facility_<?= $facility['id'] ?>" <?= in_array($facility['id'], $facilities) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="facility_<?= $facility['id'] ?>">
                                                    <?= $facility['name'] ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>





                            <!-- Images Inputs -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="image_1" class="form-label">Image 1</label>
                                    <input type="file" name="image_1" class="form-control" id="image_1" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_2" class="form-label">Image 2</label>
                                    <input type="file" name="image_2" class="form-control" id="image_2" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_3" class="form-label">Image 3</label>
                                    <input type="file" name="image_3" class="form-control" id="image_3" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_4" class="form-label">Image 4</label>
                                    <input type="file" name="image_4" class="form-control" id="image_4" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image_5" class="form-label">Image 5</label>
                                    <input type="file" name="image_5" class="form-control" id="image_5" accept="image/*">
                                </div>
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
                                window.location.href = './room'; // Redirect back to the services list
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
            var myModal = new bootstrap.Modal(document.getElementById('addRoomModal'));
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
                <h2 style="font-weight: bold; font-size: 22px; margin-left: 17px;">Room</h2>


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

                $sql = "SELECT * FROM `blog` ";
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

                                    <img  class="Image_con_img" src="../images/rooms/' . $_value["image"] . '" alt="" >

                                </div>

                            </div>

                            <div class="Delet_room_con" onclick="window.open(`delete.php?id=' . $_value["id"] . '&t_vlaue=room`,`_self`)" >
                                <img  class="icon_img" src="images/icon/trash.png" alt="">
                            </div>
                            <div class="update_room_con" onclick="popup(`' . $_value["id"] . '`,`' . $_value["name"] . '`,`' . $_value["para"] . '`,`' . $_value["price"] . '`,`' . $_value["facility"] . '`);" >
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

                                <input class="input_text" type="text" name="name" id="room_name" placeholder="Room Name">

                            </div>
                            <div class="form_sub_con">
                                <input class="input_text" type="number" name="prise" id="room_prise" placeholder="Room prise ">

                            </div>

                        </div>
                        <div class="form_con " style="flex-grow: 0;">

                            <input accept=".jpg, .jpeg" style="margin: 5px; font-size :15px; padding: 11px; cursor: pointer;" class="input_text" type="file" name="image" id="room_img">


                            <h2 style="margin: 5px; margin-top:20px ; color: white; font-weight: bold;">Facility</h2>

                            <div class="redo_con">





                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Ac_Non" id="room_Ac_Non"> <label for="room_Ac_Non">Ac & Non</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Pick_&_Drop" id="room_Pick_&_Drop"> <label for="room_Pick_&_Drop">Pick & Drop</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="tv" id="room_tv"> <label for="room_tv">Smart TV</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="wifi" id="room_wifi"> <label for="room_wifi">Wifi</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="bathroom" id="room_bathroom"> <label for="room_bathroom">bathroom</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Water" id="room_Water"> <label for="room_Water">Watter</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="2_size_bed" id="room_2_size_bed"> <label for="room_2_size_bed">2 size bed</label>
                                </div>

                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Privet_balcony" id="room_Privet_balcony"> <label for="room_Privet_balcony">Privet balcony</label>
                                </div>




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







        <!-- <div class="Form_popup" id="popup">



            <div class="uplode_room_Form">

                <form id="room_form" action="" method="post" enctype="multipart/form-data">

                    <input style="display:none;" class="input_text" type="text" name="id" id="room_id">
                    <div class="form">

                        <div class="form_con f">

                            <div class="form_sub_con">

                                <input class="input_text" type="text" name="name" id="room_name" placeholder="Room Name">

                            </div>
                            <div class="form_sub_con">
                                <input class="input_text" type="number" name="prise" id="room_prise" placeholder="Room prise ">

                            </div>

                        </div>
                        <div class="form_con " style="flex-grow: 0;">

                            <input style="margin: 5px; font-size :15px; padding: 11px; cursor: pointer;" class="input_text" type="file" name="image" id="room_img">


                            <h2 style="margin: 5px; margin-top:20px ; color: white; font-weight: bold;">Facility</h2>

                            <div class="redo_con">

                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Ac_Non" id="room_Ac_Non"  > <label for="room_Ac_Non">Ac & Non</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Bathroom" id="room_Bathroom"> <label for="room_Bathroom">Bathroom</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Water" id="room_Water"> <label for="room_Water">Water</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="LED_TV" id="room_LED_TV"> <label for="room_LED_TV">LED TV</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Balcony" id="room_Balcony"> <label for="room_Balcony">Balcony</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="2_Size_Bed" id="room_2_Size_Bed"> <label for="room_2_Size_Bed">D Size Bed</label>
                                </div>
                                <div class="redo_sub_con">
                                    <input type="checkbox" name="facility[]" value="Air_c" id="room_Air_c"> <label for="room_Air_c">Air_c</label>
                                </div>
                                


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

        </div> -->


























        <script>
            //...............




            function popup(id, name, para, prise, facility) {

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
                    room_form.setAttribute("action", "update_room.php");
                    Form_title.innerText = " Update Room ";


                    _facility = facility.split("|");


                    for (let i = 0; i < _facility.length; i++) {


                        if (_facility[i] == "Ac_Non") {

                            document.getElementById("room_Ac_Non").setAttribute("checked", "checked");

                        } else if (_facility[i] == "Pick_&_Drop") {

                            document.getElementById("room_Pick_&_Drop").setAttribute("checked", "checked");

                        } else if (_facility[i] == "tv") {

                            document.getElementById("room_tv").setAttribute("checked", "checked");

                        } else if (_facility[i] == "wifi") {

                            document.getElementById("room_wifi").setAttribute("checked", "trcheckedue");


                        } else if (_facility[i] == "bathroom") {

                            document.getElementById("room_bathroom").setAttribute("checked", "checked");

                        } else if (_facility[i] == "Water") {

                            document.getElementById("room_Water").setAttribute("checked", "checked");


                        } else if (_facility[i] == "2_size_bed") {

                            document.getElementById("room_2_size_bed").setAttribute("checked", "checked");


                        } else if (_facility[i] == "Privet_balcony") {

                            document.getElementById("room_Privet_balcony").setAttribute("checked", "checked");

                        }
                    }






                } else {
                    _name.setAttribute("value", "");
                    _para.value = "";
                    _prise.setAttribute("value", "");
                    _id.setAttribute("value", "");

                    room_form.setAttribute("action", "insert_room.php");
                    Room_save_btn.setAttribute("value", "Submit");

                    Form_title.innerText = "Add New Room ";


                }

                document.getElementById("popup").style.display = "flex";
            }








            function close_puppup() {

                document.getElementById("room_Ac_Non").removeAttribute("checked");
                document.getElementById("room_Pick_&_Drop").removeAttribute("checked");
                document.getElementById("room_tv").removeAttribute("checked");
                document.getElementById("room_wifi").removeAttribute("checked");
                document.getElementById("room_bathroom").removeAttribute("checked");
                document.getElementById("room_Water").removeAttribute("checked");
                document.getElementById("room_2_size_bed").removeAttribute("checked");
                document.getElementById("room_Privet_balcony").removeAttribute("checked");



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
                            alert(" Width = 1280px  , height = 720px  ");
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