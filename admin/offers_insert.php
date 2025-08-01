<script>
    if (sessionStorage.getItem("login") != "login") {
        window.location.href = 'index.php';
        exit;
    }
</script>


<?php
require("../mysqli_con/mysqli_con.php");


if (isset($_POST['Submit'])) {


    $description = $_POST['para'];

    $sql = "INSERT INTO `offers` (`id`, `message`, `date`) VALUES (NULL, ' $description', current_timestamp());";

    $conn->query($sql);

     echo "<script>window.location.href='offers.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>