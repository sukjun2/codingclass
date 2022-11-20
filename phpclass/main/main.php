<?php
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>
    
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
            <h2>블로그 소개입니다.</h2>
            <div class="banner__inner container">
                <div class="img">
                    <img src="../asset/img/banner.jpg" alt="배너이미지">
                </div>
                <div class="desc">
                    어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.
                    신입의 <em>열정</em>과 <em>도전정신</em>을 깊숙히 새기며 <em>배움</em>에 있어 겸손함을
                    유지하며 세부적인 곳까지 파고드는 <em>개발자</em>가 되겠습니다.
                </div>
            </div>
        </section>
        <!-- // banner -->

        <section id="card" class="container">
            <h2>블로그 최신글!</h2>
            <a href="http://tjrwnsrkdtj.dothome.co.kr/phpclass/blog/blog.php" class="main__blog__more">더 보기</a>
            <div class="card__inner">
                <?php
                    if(isset($_GET['page'])) {
                        $page = (int)$_GET['page'];
                    }
                    else {
                        $page = 1;
                    }
                    $viewNum = 8;
                    $viewLimit = ($viewNum * $page) - $viewNum;
                    $sql = "SELECT * FROM myBlog WHERE blogDelete = 0 ORDER BY blogID DESC LIMIT 0, 8;";
                    $result = $connect -> query($sql);

                    foreach($result as $blog) { ?>
                        <div class="card">
                            <figure>
                                <img src="../asset/img/blog/<?=$blog['blogImgSrc']?>" alt="카드1번">
                                <a href="http://tjrwnsrkdtj.dothome.co.kr/phpclass/blog/blogView.php?blogID=<?=$blog['blogID']?>" class="go" title="컨텐츠 바로가기"></a>
                            </figure>
                            <div>
                                <a href="http://tjrwnsrkdtj.dothome.co.kr/phpclass/blog/blogView.php?blogID=<?=$blog['blogID']?>">
                                    <h3><?=$blog['blogTitle']?></h3>
                                    <p><?=$blog['blogContents']?></p>
                                </a>
                            </div>
                            <span class="cate"><?=$blog['blogCategory']?></span>
                        </div>
                    <?php
                    }
                    ?>
                <!-- // card01 -->
            </div>
        </section>
        <!-- // card -->
        
        <section id="board" class="container">
            <h3 class="main__board__title">게시판 최신글!</h3>
            <a href="http://tjrwnsrkdtj.dothome.co.kr/phpclass/board/board.php" class="main__board__more">더 보기</a>
            <div class="board__inner">
                <div class="board__table">
                    <table>
                        <colgroup>
                            <col style="width: 5%;">
                            <col>
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                            <col style="width: 7%;">
                        </colgroup>
                        
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>제목</th>
                                <th>등록자</th>
                                <th>등록일</th>
                                <th>조회수</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                if(isset($_GET['page'])) {
                                    $page = (int)$_GET['page'];
                                }
                                else {
                                    $page = 1;
                                }
                                $viewNum = 10;
                                $viewLimit = ($viewNum * $page) - $viewNum;
                                
                                $sql = "SELECT count(boardID) FROM myBoard";
                                $result = $connect -> query($sql);

                                $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
                                $boardCount = $boardCount['count(boardID)'];

                                $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON (b.memberID = m.memberID) ORDER BY boardID DESC LIMIT 0, {$viewNum}";
                                $result = $connect -> query($sql);
                                
                                if($result) {
                                    $count = $result -> num_rows;
                                    if($count > 0) {
                                        for($i = 1; $i <= $count; $i++) {
                                            $info = $result -> fetch_array(MYSQLI_ASSOC);
                                            echo "<tr>";
                                            echo "<td>".$info['boardID']."</td>";
                                            echo "<td><a href='http://tjrwnsrkdtj.dothome.co.kr/phpclass/board/boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</a></td>";
                                            echo "<td>".$info['youName']."</td>";
                                            echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                                            echo "<td>".$info['boardView']."</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else {
                                        echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <!-- // board -->
    </main>
    <!-- // main -->

    <?php include "../include/footer.php";?>
    <!-- //footer -->
    
    <?php include "../login/login.php" ?>
    <!-- // login popup -->

    <script src="../asset/js/custom.js"></script>
</body>
</html>