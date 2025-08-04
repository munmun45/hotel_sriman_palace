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
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/table/" . basename($images));



    $sql = "INSERT INTO `table` (`id`, `name`, `para`, `price`, `images`, `facility`) VALUES (NULL, '$name', '$description', '$prise', '$images', '');";

    $conn->query($sql);


    echo "<script>window.location.href='table.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>