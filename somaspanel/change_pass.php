<?php
require("../mysqli_con/mysqli_con.php");
session_start();


if (isset($_POST['Submit'])) {


    $sql = "SELECT * FROM `account` ";
    $result = mysqli_query($conn, $sql);
    $_value = mysqli_fetch_assoc($result);


    $op = $_POST['O_P'];
    $np = $_POST['N_P'];

    if ($op == $_value['password']) {

        $sql = "UPDATE `account` SET `password` = '$np' WHERE `account`.`password` = '$op';";

        $conn->query($sql);



        echo "<script>window.location.href='index.php';</script>";
        exit;

        $_SESSION["login"] = "_";
    } else {

        echo "<script>window.location.href='dashboard.php';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
