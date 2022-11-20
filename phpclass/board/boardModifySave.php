<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>boardModifySave</title>
</head>
<body>
    <?php
        $boardID = $_POST['boardID'];
        $boardTitle = $_POST['boardTitle'];
        $boardContents = $_POST['boardContents'];
        $youPass = $_POST['youPass'];
        $memberID = $_SESSION['memberID'];
        $boardTitle = $connect -> real_escape_string($boardTitle);
        $boardContents = $connect -> real_escape_string($boardContents);

        $sql = "SELECT youPass, memberID FROM myMember WHERE memberID = {$memberID};";
        $result = $connect -> query($sql);

        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

        if($memberInfo['youPass'] === $youPass && $memberInfo['memberID'] === $memberID) {
            $sql = "UPDATE myBoard SET boardTitle = '$boardTitle', boardContents = '$boardContents' WHERE boardID={$boardID}";
            $connect -> query($sql);
        }
        else {
            echo "<script>alert('비밀번호가 틀렸습니다. 다시 한번 확인해 주세요')</script>";
        }
    ?>

    <script>
        location.href = "./board.php";
    </script>
</body>
</html>