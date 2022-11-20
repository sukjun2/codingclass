<?php
    include "../connect/connect.php";

    $BlogID = $_POST['blogID'];
    $commentName = $_POST["name"];
    $commentPass = $_POST["pass"];
    $commentMsg = $_POST["msg"];
    $regTime = time();

    $sql = "INSERT INTO mycomment (MemberID, BlogID, commentName, commentMsg, commentPass, commentDelete, regTime) VALUES ('1','$BlogID','$commentName','$commentMsg','$commentPass','0','$regTime')";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $BlogID));

?>