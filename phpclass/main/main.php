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

    <?php include "../include/head.php"?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->
    
    <?php include "../include/header.php"?>
    <!-- //header -->

    <main id="main">
        <section id="banner">
            <h2 class="blind">블로그 소개입니다.</h2>
            <div class="banner__inner container">
                <div class="img">
                    <img src="../assets/img/banner_bg01.jpg" alt="main">
                </div>
                <div class="desc">
                    어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.
                    신입의 <em>열정</em>과 <em>도전정신</em>을 깊숙히 새기며 배움에 있어 <em>겸손함</em>을
                    유지하며 세부적인 곳까지 파고드는 <em>개발자</em>가 되겠습니다.
                </div>
            </div>
        </section>
        <!-- //banner -->

        <article class="card__wrap container">
            <h3 class="mblogtitle">블로그 최신 글</h3>
            <div class="card__inner column4">
                <?php
                $sql = "SELECT * FROM myBlog WHERE blogDelete = 0 ORDER BY BlogID DESC LIMIT 8";
                $result = $connect -> query($sql);


                foreach($result as $blog){
                ?>
                <div class="card">
                    <figure class="card__header">
                        <img src="../assets/blog/<?=$blog['blogImgSrc']?>" alt="vscode에 scss설치하기">
                        <a href="../blog/blogView.php?blogID=<?=$blog['blogID']?>" class="go" title="컨텐츠 바로가기"></a>
                    </figure>
                    <div class="card__contents">
                        <div class="title">
                            <h3><a href="../blog/blogView.php?blogID=<?=$blog['blogID']?>" title="컨텐츠 바로가기"><?=$blog['blogTitle']?></a></h3>
                            <p>
                                <?=$blog['blogContents']?>
                            </p>
                        </div>
                        <div class="info">
                            <em class="author"><?=$blog['blogAuthor']?></em> 
                            <span class="time"><?=date('Y-m-d', $blog['blogRegTime'])?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="card__more">
                    <a href="../blog/blog.php">더보기</a>
                </div>
            </div>
        </article>

        <section class="container section">
            <div class="board__table column4">
                <h2>게시판 최신 글</h2>
                <table>
                    <colgroup>
                        <col style="width: 5%">
                        <col>
                        <col style="width: 10%">
                        <col style="width: 10%">
                        <col style="width: 7%">
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
                        // 두개의 테이블 join
                        $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON (b.memberID = m.memberID) ORDER BY boardID DESC LIMIT 5";
                        $result = $connect -> query($sql);
                        if($result){
                            $count = $result -> num_rows;
                            if($count > 0){
                                for($i=1; $i <= $count; $i++){
                                    $info = $result -> fetch_array(MYSQLI_ASSOC);
                                    echo "<tr>";
                                    echo "<td>".$info['boardID']."</td>";
                                    echo "<td><a href='../board/boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</td>";
                                    echo "<td>".$info['youName']."</td>";
                                    echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                                    echo "<td>".$info['boardView']."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="card__more">
                <a href="../board/board.php">더보기</a>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"?>
    <!-- //footer -->
    
</body>
</html>