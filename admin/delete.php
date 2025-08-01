
<script>
    if (sessionStorage.getItem("login") != "login") {
        window.location.href = 'index.php';
        exit;
    }
</script>

<?php
require("../mysqli_con/mysqli_con.php");


$_id = $_GET['id'];
$_name = $_GET['t_vlaue'];

$sql = "DELETE FROM `$_name` WHERE `$_name`.`id` = $_id  ";
mysqli_query($conn, $sql);


echo "<script>window.location.href='" . $_name . ".php';</script>";
exit;
?>