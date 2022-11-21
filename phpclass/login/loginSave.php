<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    
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
        <section id="banner">
            <h2>로그인 페이지 입니다.</h2>
            <div class="banner__inner2 container">
                <div class="img">
                    <img src="../asset/img/banner-02.svg" alt="배너이미지">
                </div>
                <div class="desc">
                    <?php
                        include "../connect/connect.php";
                        include "../connect/session.php";

                        $youEmail = $_POST['youEmail'];
                        $youPass = $_POST['youPass'];

                        function msg($alert) {
                            echo "<p class='alert'>$alert</p>";
                        }

                        // 유효성 검사
                        if(!filter_var($youEmail, FILTER_VALIDATE_EMAIL)) {
                            msg("이메일이 잘못 되었습니다. <br> 올바른 이메일을 적어주세요!!");
                            exit;
                        }

                        if($youPass === null || $youPass ==='') {
                            msg("비밀번호를 입력해 주세요!");
                            exit;
                        }

                        // 데이터 조회
                        $sql = "SELECT memberID, youEmail, youName, youPass FROM myMember where youEmail = '$youEmail' and youPass = '$youPass'";
                        $result = $connect -> query($sql);

                        if($result) {
                            $count = $result -> num_rows;

                            if($count === 0) {
                                msg("이메일 또는 비밀번호가 틀렸습니다.");
                            }
                            else {
                                $info = $result -> fetch_array(MYSQLI_ASSOC);
                                // echo "<pre>";
                                // var_dump($info);
                                // echo "</pre>";

                                $_SESSION['memberID'] = $info['memberID'];
                                $_SESSION['youEmail'] = $info['youEmail'];
                                $_SESSION['youName'] = $info['youName'];

                                Header("Location: ../main/main.php");
                            }
                        }
                        else {
                            msg("에러발생 - 관리자에게 문의하세요!");
                            exit;
                        }
                    ?>
                </div>
            </div>
        </section>
        <!-- // banner -->
    </main>
    <!-- // main -->

    <?php include "../include/footer.php";?>
    <!-- //footer -->

    <script src="../asset/js/custom.js"></script>
</body>
</html>