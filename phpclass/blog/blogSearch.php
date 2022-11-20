<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $searchKeyword = $_GET['searchKeyword'];

    $blogSql = "SELECT * FROM myBlog WHERE blogDelete=0 and blogContents LIKE '%{$searchKeyword}%' ORDER BY BlogID DESC";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);
    $blogCount = $blogResult -> num_rows;

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>
    
    <?php
        include "../include/head.php";
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
        <section id="blog" class="container">
            <div class="blog__inner"> 
                <div class="blog__title">
                    <h2><?=$searchKeyword?> 키워드</h2>
                    <p><?=$searchKeyword?>와 관련된 글이 <?=$blogCount?>개 있습니다.</p>
                </div>
                <!-- // blog__title -->

                <div class="blog__contents">
                    <div class="card__inner horizontal">
                        <?php
                            if(isset($_GET['page'])) {
                                $page = (int)$_GET['page'];
                            }
                            else {
                                $page = 1;
                            }
                            $viewNum = 6;
                            $viewLimit = ($viewNum * $page) - $viewNum;
                            $sql = "SELECT * FROM myBlog WHERE blogDelete=0 and blogContents LIKE '%{$searchKeyword}%' ORDER BY BlogID DESC LIMIT {$viewLimit}, {$viewNum};";
                            $result = $connect -> query($sql);
                        ?>
                        <?php
                            foreach($result as $blog) { ?>
                                <div class="card">
                                    <figure>
                                        <img src="../assets/blog/<?=$blog['blogImgSrc']?>" alt="카드1번">
                                        <a href="blogView.php?blogID=<?=$blog['blogID']?>" class="go" title="컨텐츠 바로가기"></a>
                                    </figure>
                                    <div>
                                        <a href="blogView.php?blogID=<?=$blog['blogID']?>">
                                            <h3><?=$blog['blogTitle']?></h3>
                                            <!-- <p><?=$blog['blogContents']?></p> -->
                                        </a>
                                    </div>
                                    <span class="Vcategory"><?=$blog['blogCategory']?></span>
                                </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- // blog__contents__card -->
                    <div class="card__pages">
                            <ul>
                                <?php
                                    $sql = "SELECT count(BlogID) FROM myBlog WHERE blogDelete=0 and blogContents LIKE '%{$searchKeyword}%' ";
                                    $result = $connect -> query($sql);

                                    $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
                                    $boardCount = $boardCount['count(BlogID)'];

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
                                        echo "<li><a href='./blogSearch.php?page=1&searchKeyword={$searchKeyword}'><<</a></li>";
                                        echo "<li><a href='./blogSearch.php?page={$prevPage}&searchKeyword={$searchKeyword}'><</a></li>";
                                    }
                                    
                                    // 페이지 넘버 표시
                                    for($i = $startPage; $i <= $endPage; $i++) {
                                        $active = "";
                                        if($i === $page) $active = "active";
                                        echo "<li class = '{$active}'><a href='./blogSearch.php?page={$i}&searchKeyword={$searchKeyword}'>$i</a></li>";
                                    }

                                    if($page != $endPage) {
                                        $nextPage = $page + 1;
                                        echo "<li><a href='./blogSearch.php?page={$nextPage}&searchKeyword={$searchKeyword}'>></a></li>";
                                        echo "<li><a href='./blogSearch.php?page={$boardCount}&searchKeyword={$searchKeyword}'>>></a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                </div>
                <!-- // blog__contents -->

                <div class="blog__aside">
                    <div class="blog__aside__intro">
                        <div class="img">
                            <img src="../assets/img/banner_bg01.jpg" alt="배너 이미지">
                        </div>
                        <div class="desc">
                            어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.
                        </div>
                    </div>
                    <!-- // blog__aside__intro -->

                    <div class="blog__aside__cate">
                        <h3>카테고리</h3>
                        <?php include "../include/category.php" ?>
                    </div>
                    <!-- // blog__aside__cate -->

                    <div class="blog__aside__new">
                        <h3>최신글</h3>
                        <ul>
                            <?php
                                include "../include/blogNew.php";
                            ?>
                        </ul>
                    </div>
                    <!-- // blog__aside__new -->

                    <div class="blog__aside__pop">
                        <h3>인기글</h3>
                        <ul>
                            <?php
                                include "../include/blogNew.php";
                            ?>
                        </ul>
                    </div>
                    <!-- // blog__aside__pop -->

                    <div class="blog__aside__comment">
                        <h3>최신 댓글</h3>
                        <ul>
                            <li><a href="#">학습 능률을 향상시키는 역할을</a></li>
                            <li><a href="#">학습 능률을 향상시키는 역할을</a></li>
                            <li><a href="#">학습 능률을 향상시키는 역할을</a></li>
                            <li><a href="#">학습 능률을 향상시키는 역할을</a></li>
                        </ul>
                    </div>
                    <!-- // blog__aside__comment -->

                    <!-- <div class="blog__aside__ad">
                    </div> -->
                    <!-- // blog__aside__ad -->
                </div>
                <!-- // blog__aside -->

                <div class="blog__relation">

                </div>
                <!-- // blog__relation -->
            </div>
            <!-- // blog__inner -->
        </section>
        <!-- // blogView -->
    </main>
    <!-- // main -->

    <?php include "../include/footer.php"?>
    <!-- //footer -->

    <script src="../asset/js/custom.js"></script>
</body>
</html>