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

    <?php
        $blogID = $_GET['blogID'];
        $sql = "SELECT blogID, blogTitle, blogContents, blogCategory FROM myBlog WHERE blogID = $blogID";
        $result = $connect -> query($sql);
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        $blogTitle = $info['blogTitle'];
        $blogContents = $info['blogContents'];
        $category = $info['blogCategory'];
    ?>

    <main id="main">
        <section id="blogWrite">
            <h2>블로그 글수정 입니다.</h2>
            <div class="write__inner container">
                <form action="blogModifySave.php" method="post" enctype="multipart/form-data" name="blogModify">
                    <fieldset>
                        <legend>블로그 게시글 작성 영역</legend>
                        <div>
                            <label for="blogCategory">카테고리</label>
                            <select name="blogCategory" id="blogCategory">
                                <option value="JAVASCRIPT">JAVASCRIPT</option>
                                <option value="JQUERY">JQUERY</option>
                                <option value="HTML">HTML</option>
                                <option value="CSS">CSS</option>
                            </select>
                        </div>
                        <!-- 01 -->

                        <div>
                            <label for="blogTitle">제목</label>
                            <input type="text" name="blogTitle" id="blogTitle" placeholder="제목을 넣어주세요" required value="<?=$blogTitle?>">
                        </div>
                        <!-- 02 -->

                        <div>
                            <label for="blogContents">내용</label>
                            <textarea name="blogContents" id="blogContents" placeholder="내용을 넣어주세요" required><?=$blogContents?></textarea>
                        </div>
                        <!-- 03 -->

                        <div>
                            <label for="blogFile">파일</label>
                            <input type="file" name="blogFile" id="blogFile" accept=".jpg, .jpeg, .png, .gif" placeholder=".jpg, .jpeg .png .gif 파일만 넣어주세요">
                        </div>
                        <!-- 04 -->
                        <button type="submit" value="저장하기">저장하기</button>
                    </fieldset>
                </form>
            </div>
        </section>
        <!-- // blogWrite -->
    </main>
    <!-- // main -->

    <?php include "../include/footer.php";?>
    <!-- //footer -->

    <?php include "../login/login.php";?>
    <!-- // login popup -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../asset/js/custom.js"></script>
    <script>
        $("#blogCategory").val("<?=$category?>").prop("selected", true);
    </script>
</body>

</html>