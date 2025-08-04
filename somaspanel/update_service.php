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

    $images = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/service/" . basename($images));

    $logo = $_FILES['logo']['name'];
    move_uploaded_file($_FILES["logo"]["tmp_name"], "../images/icon/" . basename($logo));




    if ($images != "") {
        $sql = "UPDATE `service` SET `name` = '$name', `para` = '$description', `images` = '$images', `price` = '$prise' WHERE `service`.`id` = $id;";
    } else if ($logo != "") {

        $sql = "UPDATE `service` SET `name` = '$name', `para` = '$description',  `logo` = '$logo', `price` = '$prise' WHERE `service`.`id` = $id;";
    } else if ($images != "" || $logo != "") {

        $sql = "UPDATE `service` SET `name` = '$name', `para` = '$description', `images` = '$images', `logo` = '$logo', `price` = '$prise' WHERE `service`.`id` = $id;";
    } else {

        $sql = "UPDATE `service` SET `name` = '$name', `para` = '$description',  `price` = '$prise' WHERE `service`.`id` = $id;";
    }

    $conn->query($sql);

    echo "<script>window.location.href='service.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>