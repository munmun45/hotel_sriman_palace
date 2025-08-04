
<script>
    if (sessionStorage.getItem("login") != "login") {
        window.location.href = 'index.php';
        exit;
    }
</script>


<?php

require("../mysqli_con/mysqli_con.php");


$id = $_POST['id'];
$num = $_POST['number'];
$email = $_POST['email'];



if (isset($_POST['Submit'])) {

    $id = $_POST['id'];
    $num = $_POST['number'];
    $email = $_POST['email'];

    if ($num == "") {
        $sql = "UPDATE `contact` SET `email` = '$email ' WHERE `contact`.`id` = $id;";
    } else {
        $sql = "UPDATE `contact` SET `number` = '$num ' WHERE `contact`.`id` = $id;";
    }








    $conn->query($sql);

    echo "<script>window.location.href='dashboard.php';</script>";
    exit;

} else {
    echo "feld !";
}





?>