<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $blogID = $_GET['blogID'];
    $blogID = $connect -> real_escape_string($blogID);

    $sql = "DELETE FROM myBlog WHERE blogID={$blogID}";
    $connect -> query($sql);
?>

<script>
    location.href ="http://tjrwnsrkdtj.dothome.co.kr/phpclass/blog/blog.php";
</script>