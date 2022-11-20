<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $blogID = $_GET['blogID'];

    $blogSql = "SELECT * FROM myBlog WHERE blogID=$blogID";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);
    $blogIDData = $_GET['blogID'];

    $commentSql = "SELECT * FROM myComment WHERE blogID='$blogID' ORDER BY commentID DESC";
    $commentResult = $connect -> query($commentSql);
    $commentInfo = $commentResult -> fetch_array(MYSQLI_ASSOC);
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
        <section id="blog" class="container">
            <div class="blog__inner">
                <div class="blog__title" style="background-image:url('../asset/img/blog/<?=$blogInfo['blogImgSrc']?>');">
                    <span class="blog__title__cate"><?=$blogInfo['blogCategory']?></span>
                    <!-- // category -->
                    
                    <h2 class="blog__title__h1">
                        <?=$blogInfo['blogTitle']?>
                    </h2>
                    <!-- // title -->
                    
                    <div class="blog__title__info">
                        <div>
                            <span class="author"><?=$blogInfo['blogAuthor']?></span>
                            <span class="date"><?=date('Y-m-d',$blogInfo['blogRegTime'])?></span>
                        </div>
                        <div>
                            <a href="./blogModify.php?blogID=<?=$blogIDData?>" class="modify">수정</a>
                            <a href="./blogDelete.php?blogID=<?=$blogIDData?>" class="delete">삭제</a>
                        </div>
                    </div>
                    <!-- // info -->
                </div>
                <!-- //blog__title -->
                
                <div class="blog__contents">
                    <div class="blog__contents__ad">
                    </div>
                    <!-- // ad -->

                    <div class="blog__contents__cont" style="line-height:2">
                    <?=$blogInfo['blogContents']?>
                    </div>
                    <!-- // cont -->

                    <div class="blog__contents__comment">
                        <h3>댓글 쓰기</h3>
                        <?php
                            foreach($commentResult as $comment) { ?>
                            <div class="comment" id="comment<?=$comment['commentID']?>">
                                <div class="comment__view">
                                    <div class="comment__view__img">
                                        <img src="../asset/img/icon_256.png" alt="img">
                                    </div>
                                    <div class="comment__view__date">
                                        <span class="name"><?=$comment['commentName']?></span>
                                        <span class="date"><?=date('Y-m-d',$comment['regTime'])?></span>
                                    </div>
                                    <div class="comment__view__msg">
                                        <?=$comment['commentMsg']?>
                                    </div>
                                </div>
                                <div class="comment__del">
                                    <a href="#" class="comment__del__del">댓글 삭제</a>
                                    <a href="#" class="comment__del__mod">댓글 수정</a>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="comment__delete" style="display:none;">
                            <label for="commentDeletePass">비밀번호</label>
                            <input type="text" id="commentDeletePass">
                            <button id="commentDeleteCancel">취소</button>
                            <button id="commentDeleteButton">삭제</button>
                        </div>
                        <div class="comment__modify" style="display:none;">
                            <label for="commentModifyMsg">수정 내용</label>
                            <input type="text" id="commentModifyMsg">
                            <label for="commentModifyPass">비밀번호</label>
                            <input type="text" id="commentModifyPass">
                            <button id="commentModifyCancel">취소</button>
                            <button id="commentModifyButton">수정</button>
                        </div>
                        <div class="comment__write">
                            <div class="comment__write__info">
                                <label for="commentName">이름</label>
                                <input type="text" id="commentName" name="commentName" placeholder="이름">
                                <label for="commentPass">비밀번호</label>
                                <input type="text" id="commentPass" name="commentPass" placeholder="비밀번호">
                                <button type="submit" id="commentBtn">댓글쓰기</button>
                            </div>
                            <div class="comment__write__msg">
                                <label for="commentWrite">댓글을 써주세요</label>
                                <input type="text" id="commentWrite" name="commentWrite" placeholder="댓글을 써주세요">
                            </div>
                        </div>
                    </div>
                    <!-- // comment -->
                </div>
                <!-- // blog__contents -->

                <div class="blog__aside">
                    <div class="blog__aside__intro">
                        <div class="img">
                            <img src="../asset/img/banner.jpg" alt="기본이미지">
                        </div>
                        <p class="intro">
                            어떤 일이라도 노력하고 즐기면 그 결과는 빛을 바란다고 생각합니다.
                        </p>
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
                            <?php
                                include "../include/blogComment.php";
                            ?>
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

    <?php include "../include/footer.php";?>
    <!-- //footer -->

    <?php include "../login/login.php" ?>
    <!-- // login popup -->

    <script src="../asset/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        const deleteBtn = document.querySelector('.delete');

        deleteBtn.addEventListener('click', (e) => {
            if(!confirm("정말로 삭제하시겠습니까?")) {
                e.preventDefault();
                return;
            }
        });

        const commentName = $("#commentName");
        const commentPass = $("#commentPass");
        const commentWrite  = $("#commentWrite");
        let commentID = '';

        // 댓글삭제 버튼
        $(".comment__del__del").click(function(e) {
            e.preventDefault();
            $(".comment__delete").slideDown();

            commentID = $(this).parent().parent().attr('id');
        });

        // 삭제 -> 취소
        $("#commentDeleteCancel").click(function() {
            $(".comment__delete").hide();
        });

        // 삭제 -> 삭제
        $("#commentDeleteButton").click(function() {
            if($("#commentDeletePass").val === "") {
                alert("댓글 작성 시 비밀번호를 적어 주세요!");
                $("#commentDeletePass").focus();
            }
            else {
                $.ajax({
                    url : "blogCommentDelete.php",
                    method : "POST",
                    dataType : 'json',
                    data : {
                        "pass" : $("#commentDeletePass").val(),
                        "commentID" : commentID.replace("comment", ""),
                    },
                    success : function(data) {
                        console.log(data);
                        location.reload();
                    },
                    error : function(request, status, error) {
                        console.log("request",request);
                        console.log("status",status);
                        console.log("error",error);
                    }
                });
            }
        });

        // 댓글수정 버튼
        $(".comment__del__mod").click(function(e) {
            e.preventDefault();
            $(".comment__modify").fadeIn(1000);

            commentID = $(this).parent().parent().attr('id');
        });

        // 수정 -> 취소
        $("#commentModifyCancel").click(function() {
            $(".comment__modify").hide();
        });
        
        // 수정 -> 수정
        $("#commentModifyButton").click(function() {
            if($("#commentModifyMsg").val === "") {
                alert("댓글 작성 시 댓글을 적어주세요!");
                $("#commentModifyMsg").focus();
            }
            else if($("#commentModifyPass").val === "" || $("#commentModifyMsg")) {
                alert("댓글 작성 시 비밀번호를 적어 주세요!");
                $("#commentModifyPass").focus();
            }
            else {
                $.ajax({
                    url : "blogCommentModify.php",
                    method : "POST",
                    dataType : 'json',
                    data : {
                        "pass" : $("#commentModifyPass").val(),
                        "commentID" : commentID.replace("comment", ""),
                        "commentMsg" : $("#commentModifyMsg").val()
                    },
                    success : function(data) {
                        console.log(data);
                        location.reload();
                    },
                    error : function(request, status, error) {
                        console.log("request",request);
                        console.log("status",status);
                        console.log("error",error);
                    }
                });
            }
        });

        $("#commentBtn").click(function() {
            if($("#commentWrite").val() === "") {
                alert("댓글을 써주세요");
                $("#commentWrite").focus();
            }
            else {
                $.ajax({
                    url : "blogCommentWrite.php",
                    method : "POST",
                    dataType : "json",
                    data : {
                        "name" : commentName.val(),
                        "pass" : commentPass.val(),
                        "msg"  : commentWrite.val(),
                        "blogID" : <?=$blogID?>,
                    },
                    success : function(data) {
                        console.log(data);
                        location.reload();
                    },
                    error : function(request, status, error) {
                        console.log("request",request);
                        console.log("status",status);
                        console.log("error",error);
                    }
                });
            }
        });
    </script>
</body>
</html>