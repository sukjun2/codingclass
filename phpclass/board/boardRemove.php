<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $BoardID = $_GET['BoardID'];
    $BoardID = $connect -> real_escape_string($BoardID);


    $sql = "DELETE FROM myBoard WHERE BoardID = {$BoardID}";
    $connect -> query($sql);
?>

<script>
    location.href="board.php";
</script>