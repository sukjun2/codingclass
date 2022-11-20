<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE mycomment (";
    $sql .= "commentID int(10) unsigned NOT NULL auto_increment,";
    $sql .= "memberID int(10) unsigned NOT NULL,";
    $sql .= "BlogID int(10) unsigned NOT NULL,";
    $sql .= "commentName varchar(30) NOT NULL,";
    $sql .= "commentMsg varchar(255) NOT NULL,";
    $sql .= "commentPass varchar(20) NOT NULL,";
    $sql .= "commentDelete int(10) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (commentID)";
    $sql .= ") charset=utf8;";

    $connect -> query($sql);   
        
    
?>