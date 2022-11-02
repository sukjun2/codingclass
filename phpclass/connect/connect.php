<?php
    $host = "localhost";
    $user = "tjrwnsrkdtj";
    $pw = "rla1wjd!";
    $db = "tjrwnsrkdtj";
    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf8");
    if(mysqli_connect_errno()){
        echo "database connect false";
    } else {
        // echo "database connect true";
    }
?>