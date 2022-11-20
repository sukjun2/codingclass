<?php
    $blogNewSql = "SELECT * FROM myBlog WHERE blogDelete= 0 ORDER BY blogID DESC LIMIT 4;";
    $blogNewResult = $connect -> query($blogNewSql);

    foreach($blogNewResult as $blogNew){ ?>
        <li><a href="blogView.php?blogID=<?=$blogNew['blogID']?>"><span><img src="../asset/img/blog/<?=$blogNew['blogImgSrc']?>" alt="img"></span><em><?=$blogNew['blogTitle']?></em></a></li>
<?php
    }
?>