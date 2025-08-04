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

    $images = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/service/" . basename($images));

    $logo = $_FILES['logo']['name'];
    move_uploaded_file($_FILES["logo"]["tmp_name"], "../images/icon/" . basename($logo));



    $sql = "INSERT INTO `service` (`id`, `name`, `para`, `images`, `logo`, `price`) VALUES (NULL, '$name', '$description', '$images', '$logo', '$prise');";

    $conn->query($sql);

    echo "<script>window.location.href='service.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>