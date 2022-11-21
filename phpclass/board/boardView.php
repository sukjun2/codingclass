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
    <title>boardView</title>
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
                    <h3>게시판</h3>
                    <p>웹 디자이너, 웹 퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다.</p>
                </div>
                <div class="board__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 80%;">
                        </colgroup>
                        <tbody>
                            <!-- <tr>
                                <th>제목</th>
                                <td>게시판 제목입니다.</td>
                            </tr>
                            <tr>
                                <th>등록자</th>
                                <td>황상연</td>
                            </tr>
                            <tr>
                                <th>등록일</th>
                                <td>2022.09.22</td>
                            </tr>
                            <tr>
                                <th>조회수</th>
                                <td>999</td>
                            </tr>
                            <tr>
                                <th>내용</th>
                                <td class="height">
                                    1. 삶이 있는 한 희망은 있다  -키케로
                                    2. 산다는것 그것은 치열한 전투이다.  -로망로랑
                                    3. 하루에 3시간을 걸으면 7년 후에 지구를 한바퀴 돌 수 있다. -사무엘존슨
                                    4. 언제나 현재에 집중할수 있다면 행복할것이다. -파울로 코엘료
                                    5. 진정으로 웃으려면 고통을 참아야하며 , 나아가 고통을 즐길 줄 알아야 해 -찰리 채플린
                                    6. 직업에서 행복을 찾아라. 아니면 행복이 무엇인지 절대 모를 것이다 -엘버트 허버드
                                    7. 신은 용기있는자를 결코 버리지 않는다 -켄러
                                </td>
                            </tr> -->

                            <?php
                                $boardID = $_GET['boardID'];
                                
                                // 페이지 뷰 + 1
                                $viewSql = "UPDATE myBoard SET boardView = boardView + 1 WHERE boardID={$boardID}";
                                $connect -> query($viewSql);
                                
                                $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM myBoard b JOIN myMember m ON(m.memberID = b.memberID) WHERE b.boardID = {$boardID};";
                                $result = $connect -> query($sql);

                                
                                if($result) {
                                    $info = $result -> fetch_array(MYSQLI_ASSOC);
                                    echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
                                    echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
                                    echo "<tr><th>등록일</th><td>".date("Y-m-d", $info['regTime'])."</td></tr>";
                                    echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
                                    echo "<tr><th>내용</th><td class='height'>".$info['boardContents']."</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="board__btn">
                    <a href="./boardModify.php?boardID=<?=$boardID?>">수정하기</a>
                    <a href="./boardRemove.php?boardID=<?=$boardID?>" onclick="alert('정말로 삭제하시겠습니까?')">삭제하기</a>
                    <a href="./board.php">목록보기</a>
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