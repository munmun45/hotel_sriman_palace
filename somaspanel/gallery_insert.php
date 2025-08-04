<script>
    if (sessionStorage.getItem("login") != "login") {
        window.location.href = 'index.php';
        exit;
    }
</script>

<?php
require("../mysqli_con/mysqli_con.php");


if (isset($_POST)) {

    $doc = $_FILES['doc']['name'];
    move_uploaded_file($_FILES["doc"]["tmp_name"], "../images/gallery/" . basename($doc));

    $sql = "INSERT INTO `gallery` (`id`, `images`, `date`) VALUES (NULL, '$doc', current_timestamp());";

    $conn->query($sql);

    echo "<script>window.location.href='gallery.php';</script>";
    exit;

} else {
    echo "feld !";
}
?>