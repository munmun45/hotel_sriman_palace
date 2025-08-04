<script>
    if (sessionStorage.getItem("login") != "login") {
        window.location.href = 'index.php';
        exit;
    }
</script>


<?php
require("../mysqli_con/mysqli_con.php");


if (isset($_POST['Submit'])) {

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



    $sql = "INSERT INTO `room` (`id`, `name`, `para`, `price`, `image`, `facility`) VALUES (NULL, '$name', '$description', '$prise', '$images', '$Facility');";

    $conn->query($sql);

     echo "<script>window.location.href='room.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>