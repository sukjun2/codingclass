<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE myComment (";
    $sql .= "commentID int(10) unsigned NOT NULL auto_increment,";
    $sql .= "memberID int(10) unsigned NOT NULL,";
    $sql .= "blogID int(10) unsigned NOT NULL,";
    $sql .= "commentName varchar(30) NOT NULL,";
    $sql .= "commentMsg varchar(255) NOT NULL,";
    $sql .= "commentPass varchar(50) NOT NULL,";
    $sql .= "commentDelete int(10) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY(myCommentID)";
    $sql .= ")charset=utf8;";

    $connect -> query($sql);
?>