<?php

    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $dbname = "hotelsrimanpalace_deom";


    // $server_name = "localhost";
    // $user_name = "hotelsrimanpalace_new_user";
    // $password = "gwgV.~GCBXMU";
    // $dbname = "hotelsrimanpalace_new_db";

    $conn = new mysqli($server_name, $user_name, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }else{
        // echo "Connected successfully <br>";
    }

    // INSERT INTO `user` (`id`, `user_name`, `password`, `date`) VALUES (NULL, 'munmun', 'hello', current_timestamp());

?>