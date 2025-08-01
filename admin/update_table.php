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
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/table/" . basename($images));

    if ($images == "") {

        $sql = "UPDATE `table` SET `name` = '$name', `para` = '$description' , `facility` = '' , `price` = '$prise' WHERE `table`.`id` = $id;";
    } else {
        $sql = "UPDATE `table` SET `name` = '$name', `para` = '$description', `images` = '$images' , `facility` = '' , `price` = '$prise' WHERE `table`.`id` = $id;";
    }



    // $sql = "UPDATE `room` SET `name` = '$name', `para` = '$description', `price` = '$prise', `image` = 'room4.jpg', `facility` = '1,2,3,4,53' WHERE `room`.`id` = 3;";

    $conn->query($sql);

    echo "<script>window.location.href='table.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>