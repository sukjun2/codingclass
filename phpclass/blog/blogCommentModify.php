<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $commentID = $_POST['commentID'];
    $pass = $_POST['pass'];
    $commentMsg = $_POST['commentMsg'];

    $sql = "UPDATE myComment SET commentMsg='$commentMsg' WHERE commentID=$commentID";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $sql));
?>