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
    <title>게시판</title>
    
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
        <h2>게시판 영역 입니다.</h2>
        <div class="board__inner">
            <div class="board__title">
                <h3>게시판</h3>
                <p>웹 디자이너, 웹 퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다.</p>
            </div>
            <div class="board__search">
                <div class="left">
                    <?php
                        $sql = "SELECT * FROM myBoard;";
                        $result = $connect -> query($sql);
                        $total = $result -> num_rows;
                    ?>
                    * 총 <em><?= $total?></em> 건의 게시물이 등록되어 있습니다.
                </div>
                <div class="right">
                    <form action="boardSearch.php" method="get" name="boardSearch">
                        <fieldset>
                            <legend>게시판 검색 영역</legend>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!" aria-label="search" required>
                            <select name="searchOption" id="searchOption">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select>
                            <button type="submit" class="searchBtn">검색</button>
                            <a href="boardWrite.php" class="btn">글쓰기</a>
                        </fieldset>
                    </form>
                </div>
            </div>
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
                            echo "총".ceil($boardCount/$viewNum)." page";

                            // 1 ~ 20 => 1번째 페이지 : DESC 0, 20
                            // 21 ~ 40 => 2번째 페이지 : DESC 20, 20
                            // join
                            $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON (b.memberID = m.memberID) ORDER BY boardID DESC LIMIT {$viewLimit}, {$viewNum}";
                            $result = $connect -> query($sql);
                            
                            if($result) {
                                $count = $result -> num_rows;
                                if($count > 0) {
                                    for($i = 1; $i <= $count; $i++) {
                                        $info = $result -> fetch_array(MYSQLI_ASSOC);
                                        echo "<tr>";
                                        echo "<td>".$info['boardID']."</td>";
                                        echo "<td><a href='boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</a></td>";
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
                        <!-- <tr>
                            <td>1</td>
                            <td><a href="boardView.html">게시판 제목입니다.</a></td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>1000</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>100000</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>1000000</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>1000000</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>234234</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>1231</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>게시판 제목입니다.</td>
                            <td>황상연</td>
                            <td>2022.09.22</td>
                            <td>1</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="board__pages">
                <ul>
                    <!-- <li><a href="#">처음으로</a></li>
                    <li><a href="#">이전</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">다음</a></li>
                    <li><a href="#">마지막</a></li> -->
                    <?php
                        $sql = "SELECT count(boardID) FROM myBoard";
                        $result = $connect -> query($sql);

                        $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
                        $boardCount = $boardCount['count(boardID)'];

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
                            echo "<li><a href='./board.php?page=1'>처음으로</a></li>";
                            echo "<li><a href='./board.php?page={$prevPage}'>이전</a></li>";
                        }
                        
                        // 페이지 넘버 표시
                        for($i = $startPage; $i <= $endPage; $i++) {
                            $active = "";
                            if($i === $page) $active = "active";
                            echo "<li class = '{$active}'><a href='./board.php?page={$i}'>$i</a></li>";
                        }

                        // 다음, 마지막
                        // if((int)$_GET['page'] !== (int)$boardCount) {
                        //     $nextPage = (int)$_GET['page'] + 1;
                        //     echo "<li><a href='./board.php?page={$nextPage}'>다음</a></li>";
                        //     echo "<li><a href='./board.php?page={$boardCount}'>마지막</a></li>";
                        // }
                        if($page != $endPage) {
                            $nextPage = $page + 1;
                            echo "<li><a href='./board.php?page={$nextPage}'>다음</a></li>";
                            echo "<li><a href='./board.php?page={$boardCount}'>마지막</a></li>";
                        }
                    ?>
                </ul>
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