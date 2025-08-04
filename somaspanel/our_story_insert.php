<script>
    if (sessionStorage.getItem("login") != "login") {
        window.location.href = 'index.php';
        exit;
    }
</script>


<?php
require("../mysqli_con/mysqli_con.php");


if (isset($_POST)) {

    $v = $_POST['v'];
    $_id = $_POST['id'];
    $doc = $_FILES['doc']['name'];
    move_uploaded_file($_FILES["doc"]["tmp_name"], "../images/about/" . basename($doc));

    $sql = "UPDATE `our_story` SET `$v` = '$doc' WHERE `our_story`.`id` = $_id;";


    $conn->query($sql);



    echo "<script>window.location.href='our_story.php';</script>";
    exit;
} else {
    echo "feld !";
}
?>