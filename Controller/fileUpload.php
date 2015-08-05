<?php
session_start();

if (isset($_SESSION['loggedUsr'])) {
    $target_dir = "../UploadedPics/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "exist";
        $uploadOk = 0;
    }
     // Check file size
    if ($_FILES["file"]["size"] > 1000000) {
        echo "big";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }
    
    $noExt = basename($_FILES["file"]["name"], ".".$imageFileType);
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $picPage = fopen("../UploadedPicPages/$noExt.php", "w");
            $pageContent = '<!DOCTYPE html>
                            <?php
                            require "../View/picPage_lang.php"; 
                            class PicPage extends PicLang {
                                public $navLeftBtns = array();
                            }
                            $picPage = new PicPage;
                            $picPage->display();';
            fwrite($picPage, $pageContent);
            fclose($picPage);
            echo "success";
        } else {
            echo "error";
        }
    }
}
