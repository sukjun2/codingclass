<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $memberID = $_SESSION['memberID'];
    $blogAuthor = $_SESSION['youName'];
    $blogCategory = $_POST['blogCategory'];
    $blogTitle = $_POST['blogTitle'];
    $blogContents = nl2br($_POST['blogContents']);
    $blogView = 1;
    $blogLike = 0;
    $regTime = time();
    $blogImgFile = $_FILES['blogFile'];
    $blogImgSize = $_FILES['blogFile']['size'];
    $blogImgType = $_FILES['blogFile']['type'];
    $blogImgName = $_FILES['blogFile']['name'];
    $blogImgTmp = $_FILES['blogFile']['tmp_name'];
    
    // echo "<pre>";
    // var_dump($blogImgFile);
    // echo "</pre>";

    //이미지 파일명 확인
    if($blogImgType){
        $fileTypeExtension = explode("/", $blogImgType);
        $fileType = $fileTypeExtension[0];      //image
        $fileExtension = $fileTypeExtension[1]; //png
        //이미지 타입 확인
        if($fileType == "image"){
            if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif"){
                $blogImgDir = "../asset/img/blog/";
                $blogImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";
                $sql = "INSERT INTO myBlog(memberID, blogTitle, blogContents, blogCategory, blogAuthor, blogView, blogLike, blogImgSrc, blogImgSize, blogDelete, blogRegTime) VALUES($memberID, '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogView', '$blogLike', '$blogImgName', '$blogImgSize', '$blogLike', '$regTime')";
            } else {
                echo "<script>alert('지원하는 이미지 파일이 아닙니다.'); history.back(1)</script>";
            }
        }
    } else {
        $sql = "INSERT INTO myBlog(memberID, blogTitle, blogContents, blogCategorygory, blodAuthor, blogView, blogLike, blogImgSrc, blogImgSize, blogDelete, blogRegTime) VALUES($memberID, '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogView', '$blogLike', 'Img_default.jpg', '$blogImg', '$blogLike', '$regTime')";
        echo "이미지 파일이 첨부하지 않았습니다.";
    }
    //이미지 사이즈 확인
    if($blogImgSize > 1000000){
        echo "<script>alert('이미지 용량이 1메가를 초과했습니다.'); history.back(1)</script>";
        exit;
    }

    $result = $connect -> query($sql);
    $result = move_uploaded_file($blogImgTmp, $blogImgDir.$blogImgName);
    Header("Location: blog.php");
?>
</body>
</html>