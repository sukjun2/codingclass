<?php
    $blogCommentSql = "SELECT * FROM myComment WHERE commentDelete= 0 ORDER BY commentID DESC LIMIT 4;";
    $blogCommentResult = $connect -> query($blogCommentSql);
    foreach($blogCommentResult as $blogComment){ ?>
        <li><a href="blogView.php?blogID=<?=$blogComment['blogID']?>"><em><?=$blogComment['commentMsg']?></em></a></li>
<?php
    }
?>