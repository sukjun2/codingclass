<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<header id="header">
    <div class="header__inner container">
        <div class="left">
            <ul>
                <li><a href="../main/main.php" class="star"></a></li>
            </ul>
        </div>
        <h1><a href="../main/main.php">PHP BLOG</a></h1>
        <div class="right">
            <ul>
                <?php 
                    if(isset($_SESSION['memberID'])) {
                ?> 
                    <li><a href="../mypage/mypage.php" class="black"><?= $_SESSION['youName'] ?>님 환영합니다.</a></li>
                    <li><a href="../login/logout.php">로그아웃</a></li>
                <?php 
                    }  
                    else { 
                ?>
                    <li><a href="../login/login.php" class = "loginBtn">로그인</a></li>
                    <li><a href="../login/join.php">회원가입</a></li>
                <?php 
                    } 
                ?>
            </ul>
            
        </div>
        <nav class="nav">
            <ul>
                <li><a href="../login/join.php">회원가입</a></li>
                <!-- <li><a href="#" class = "loginBtn">로그인</a></li> -->
                <li><a href="../board/board.php">게시판</a></li>
                <li><a href="../blog/blog.php">블로그</a></li>
            </ul>
        </nav>
    </div>
</header>