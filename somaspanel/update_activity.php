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


    $images = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/activity/" . basename($images));

    if ($images == "") {

        $sql = "UPDATE `activity` SET `name` = '$name', `para` = '$description'  WHERE `activity`.`id` = $id;";
    } else {

        $sql = "UPDATE `activity` SET `name` = '$name', `para` = '$description', `images` = '$images' WHERE `activity`.`id` = $id;";
    }

    // UPDATE `activity` SET `para` = ' dffvsxdvxdvjfhv' WHERE `activity`.`id` = 6;


    $conn->query($sql);

    echo "<script>window.location.href='activity.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>