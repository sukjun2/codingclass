<?php
    include "../connect/connect.php";
    include "../connect/session.php";
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
        <section id="blogSearch" class="container">
            <h2>개발과 관련된 블로그 입니다.</h2>
            <div class="blog__search">
                <form action="blogSearch.php" method="get">
                    <fieldset>
                        <legend>블로그 서치</legend>
                        <label for="searchKeyword"></label>
                        <input type="text" id="searchKeyword" name="searchKeyword" placeholder="검색어를 입력해주세요!">
                        <button class="btn">검색하기</button>
                    </fieldset>
                </form>
            </div>
        </section>
        <!-- // blogSearch -->

        <section id="card" class="container">
            <h2>topic</h2>
            <a href="blogWrite.php" style="float:right; margin-top:20px;">글쓰기</a>
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
                    $sql = "SELECT * FROM myBlog WHERE blogDelete = 0 ORDER BY blogID DESC LIMIT {$viewLimit}, {$viewNum};";
                    $result = $connect -> query($sql);

                    foreach($result as $blog) { ?>
                        <div class="card">
                            <figure>
                                <img src="../asset/img/blog/<?=$blog['blogImgSrc']?>" alt="카드1번">
                                <a href="blogView.php?blogID=<?=$blog['blogID']?>" class="go" title="컨텐츠 바로가기"></a>
                            </figure>
                            <div>
                                <a href="blogView.php?blogID=<?=$blog['blogID']?>">
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

            <div class="board__pages">
                <ul>
                    <?php
                        $sql = "SELECT count(blogID) FROM myBlog";
                        $result = $connect -> query($sql);

                        $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
                        $boardCount = $boardCount['count(blogID)'];

                        // 총 페이지 개수
                        $boardCount = ceil($boardCount / $viewNum);

                        // 현재 페이지를 기준으로 보여주고 싶은 개수
                        $pageCurrent = 5;
                        $startPage = $page - $pageCurrent;
                        $endPage = $page + $pageCurrent;

                        // 처음 페이지 초기화
                        if($startPage < 1) {
                            $startPage = 1;
                        }

                        // 마지막 페이지 초기화
                        if($endPage > $boardCount) {
                            $endPage = $boardCount;
                        }

                        // 이전, 처음
                        if($page !== 1) {
                            $prevPage = $page - 1;
                            echo "<li><a href='./blog.php?page=1'>처음으로</a></li>";
                            echo "<li><a href='./blog.php?page={$prevPage}'>이전</a></li>";
                        }
                        
                        // 페이지 넘버 표시
                        for($i = $startPage; $i <= $endPage; $i++) {
                            $active = "";
                            if($i === $page) $active = "active";
                            echo "<li class = '{$active}'><a href='./blog.php?page={$i}'>$i</a></li>";
                        }

                        if($page != $endPage) {
                            $nextPage = $page + 1;
                            echo "<li><a href='./blog.php?page={$nextPage}'>다음</a></li>";
                            echo "<li><a href='./blog.php?page={$boardCount}'>마지막</a></li>";
                        }
                    ?>
                </ul>
            </div> 
        </section>
        <!-- // card -->
    </main>
    <!-- // main -->

    <?php include "../include/footer.php";?>
    <!-- //footer -->

    <script src="../asset/js/custom.js"></script>
</body>
</html>