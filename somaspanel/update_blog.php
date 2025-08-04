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
    $date =  $_POST['date'];

    $images = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/blog/" . basename($images));

    if ($images == "") {
        $sql = "UPDATE `blog` SET `name` = '$name', `para` = '$description', `date` = '$date' WHERE `blog`.`id` = $id;";
    } else {

        $sql = "UPDATE `blog` SET `name` = '$name', `para` = '$description', `images` = '$images', `date` = '$date' WHERE `blog`.`id` = $id;";
    }



    // $sql = "UPDATE `room` SET `name` = '$name', `para` = '$description', `price` = '$prise', `image` = 'room4.jpg', `facility` = '1,2,3,4,53' WHERE `room`.`id` = 3;";

    $conn->query($sql);


    echo "<script>window.location.href='blog.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>