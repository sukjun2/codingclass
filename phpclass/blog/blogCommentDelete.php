<?php
    include "../connect/connect.php";
    $commentID = $_POST['commentID'];
    $pass = $_POST['pass'];
    $regTime = time();

    $sql = "DELETE FROM myComment WHERE commentID=$commentID";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $commentID));
?>