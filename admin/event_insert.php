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
    $date =  $_POST['date'];

    $images = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/event/" . basename($images));



    $sql = "INSERT INTO `event` (`id`, `name`, `para`, `images`, `date`) VALUES (NULL, '$name', '$description', '$images', '$date');";

    $conn->query($sql);

     echo "<script>window.location.href='event.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>