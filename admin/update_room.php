<script>
    if (sessionStorage.getItem("login") != "login") {
        window.location.href = 'index.php';
        exit;
    }
</script>


<?php
require("../mysqli_con/mysqli_con.php");


if (isset($_POST['Submit'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['para'];
    $prise =  $_POST['prise'];

    if ($_POST['facility'] != "") {
        $Facility = implode("|", $_POST['facility']);
    } else {
        $Facility = "null";
    }

    $images = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/rooms/" . basename($images));

    if ($images == "") {

        $sql = "UPDATE `room` SET `name` = '$name', `para` = '$description' , `facility` = '$Facility' , `price` = '$prise' WHERE `room`.`id` = $id;";
    } else {
        $sql = "UPDATE `room` SET `name` = '$name', `para` = '$description', `image` = '$images' , `facility` = '$Facility' , `price` = '$prise' WHERE `room`.`id` = $id;";
    }



    // $sql = "UPDATE `room` SET `name` = '$name', `para` = '$description', `price` = '$prise', `image` = 'room4.jpg', `facility` = '1,2,3,4,53' WHERE `room`.`id` = 3;";

    $conn->query($sql);

    echo "<script>window.location.href='room.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>