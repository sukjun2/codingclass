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
    <title>boardModify</title>
    <?php
        include "../include/link.php";
    ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- // skip -->
    
    <?php include "../include/header.php";?>
    <!-- // header -->

    <main id="main">
        <section id="board" class="container">
            <h2>게시판 보기 영역 입니다.</h2>
            <div class="board__inner">
                <div class="board__title">
                    <h3>게시판 수정하기</h3>
                    <p>웹 디자이너, 웹 퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다.</p>
                </div>
                <div class="board__modify">
                    <form action="boardModifySave.php" name="boardModify" method="post">
                        <fieldset>
                            <legend>게시판 수정 영역입니다.</legend>
                            <?php
                                $boardID = $_GET['boardID'];
                                $sql = "SELECT boardID, boardTitle, boardContents FROM myBoard WHERE boardID = $boardID";
                                $result = $connect -> query($sql);

                                if($result) {
                                    $info = $result -> fetch_array(MYSQLI_ASSOC);
                                    echo "<div style='display:none;'><label for='boardID'>번호</label><input type='text' name='boardID' id='boardID' value='".$info['boardID']."'></div>";
                                    echo "<div><label for='boardTitle'>제목</label><input type='text' name='boardTitle' id='boardTitle' value='".$info['boardTitle']."'></div>";
                                    echo "<div><label for='boardContents'>내용</label><textarea name='boardContents' id='boardContents' rows='20'>".$info['boardContents']."</textarea></div>";
                                    echo "<div><label for='youPass'>비밀번호</label><input type='password' name='youPass' id='youPass' placeholder='비밀번호를 입력하세요' autocomplete='off' required></div>";
                                }
                            ?>
                            <button type="submit" value="수정하기" class="btn">수정하기</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
        <!-- // board -->
    </main>
    <!-- // main -->

    <?php include "../include/footer.php";?>
    <!-- //footer -->
    
    <script src="../asset/js/custom.js"></script>
</body>
</html>