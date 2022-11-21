<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $commentPass = $_POST['pass'];
    $commentMsg = $_POST["commentMsg"];
    $commentID = $_POST["commentID"];

    $sql = "UPDATE myComment SET commentMsg = '{$commentMsg}' WHERE CommentID = {$commentID} AND commentPass = {$commentPass}";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $sql));
?>