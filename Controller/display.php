<?php
require "dbConnect.php";
require "../View/main_lang.php";
session_start();

$translation = new Lang;

$dbName = "picshare";

$currentContent = htmlspecialchars($_POST['currentContent']);
$currentPage = htmlspecialchars($_POST['currentPage']);

$displayRequest = new dbConnect;

if ($currentContent=="one") {
    $picName = htmlspecialchars($_POST['name']);
    $query = "select uploadername, path, type, text, tag, points, uploaddate from links where (path regexp '^$picName".".[a-z]')";
} else if ($currentContent=="topTen") {
    $query = "select uploadername, path, type, text, tag, points, uploaddate from links order by points desc limit 10";
} else {
    $typeQuery = $currentPage*10-10;
    if ($currentContent=="all") {
        $query = "select uploadername, path, type, text, tag, points, uploaddate from links order by uploaddate desc limit 10 offset $typeQuery";
        $getNum = "select linkid from links";  
    } else {
        $query = "select uploadername, path, type, text, tag, points, uploaddate from links where tag='$currentContent' order by uploaddate desc limit 10 offset $typeQuery";
        $getNum = "select linkid from links where tag='$currentContent'";
    }
    $getNumResp= $displayRequest->connection($dbName, $getNum);
    $numOfLinks = $getNumResp->num_rows;
}

//checks for user grades
if (isset($_SESSION['loggedUsrId'])){
    $usrId = $_SESSION['loggedUsrId'];
    $usrGradeQuery = "select path from grades where usrid='$usrId'";
    $checkUserGradesResponse = $displayRequest->connection($dbName, $usrGradeQuery);
    $numOfGrades = $checkUserGradesResponse->num_rows; 
    $grades = array();
    for ($i=0; $i<$numOfGrades; $i++) {
        $toArray = $checkUserGradesResponse->fetch_assoc();
        array_push($grades,$toArray['path']);
    }
}

$response = $displayRequest->connection($dbName, $query);
$numOfMatches = $response->num_rows;

$displayed = array();
for ($i=0; $i<$numOfMatches; $i++) {
        $toDisplay = $response->fetch_assoc();
        array_push($displayed,$toDisplay['path']);
        echo "<div class='displayedWrapper'><p class='description'>".$toDisplay['text'];
                if ($toDisplay['tag']==$currentContent) {
                    echo "<a id='tag".$toDisplay['tag']."' class='currentTag'>#".$toDisplay['tag']."</a>";
                } else if ($currentContent === "one") {
                    echo "<a id='tag".$toDisplay['tag']."' class='onePicTag'>#".$toDisplay['tag']."</a>";
                } else {
                    echo "<a id='tag".$toDisplay['tag']."' class='singleTag'>#".$toDisplay['tag']."</a>";
                }
        $pathNoExtension = explode(".", $toDisplay['path']);
        echo "<div class='fb-like' data-href='..\\UploadedPicPages\\$pathNoExtension[0].php' data-layout='button_count' data-action='like' data-show-faces='true' data-share='true' width='60px'></div></p>";
        if ($toDisplay['type']=="pic") {
            
            //check what link url to set according to mode of displaying (one or all)
            if ($currentContent=="one") {
                 echo "<a href='..\\Public\\index.php'><img class='pic displayed' src='..\\UploadedPics\\".$toDisplay['path']."' alt='$pathNoExtension[0]'></a>";
            } else {
            echo "<a href='..\\UploadedPicPages\\$pathNoExtension[0].php'><img width='80%' height='auto' class='pic displayed' src='..\\UploadedPics\\".$toDisplay['path']."' alt='$pathNoExtension[0]'></a>";
            }
        } else {
            echo "<iframe width='80%' height='415' class='vid displayed' src='https://www.youtube.com/embed/".$toDisplay['path']."' frameborder='0' allowfullscreen></iframe>";
        }
        
        $plus = "";
        $minus = "";
        
        if  (isset($_SESSION['loggedUsrId'])) {
            $plus = "<a id='p".$toDisplay['path']."' class='plus pm".$pathNoExtension[0]."'>+</a>";
            $minus = "<a id='m".$toDisplay['path']."' class='minus pm".$pathNoExtension[0]."'>-</a>";
            for ($j=0; $j<$numOfGrades; $j++) {
                if ($displayed[$i] == $grades[$j]) {
                    $plus = "<a id='p".$toDisplay['path']."' class='plusInactive pm".$pathNoExtension[0]."'>+</a>";
                    $minus = "<a id='m".$toDisplay['path']."' class='minusInactive pm".$pathNoExtension[0]."'>-</a>";
                    break;
                }
            }
        }
        echo "<p class='underText'><span class='uplInfo'>".$translation->dateOfUpload.$toDisplay['uploaddate'].
                $plus.
                $minus.
                $translation->uploadedBy.$toDisplay['uploadername']."</span></br>".
                "<span class='points'>".$translation->grade."<span id='pts".$pathNoExtension[0]."'>".$toDisplay['points']."</span></span>".
                "</p></div>";
    }
    
    if (isset($numOfLinks)) {
        if ($numOfLinks>10) {
            echo "<ul class='pagesWrapper'>";
            for ($i=1; $i<=$numOfLinks/10+1; $i++) {
                if ($i==$currentPage){
                    echo "<li class='pages'><a id='$i' class='currentPage singlePage'>$i</a></li>";
                } else {
                    echo "<li class='pages'><a id='$i' class='singlePage'>$i</a></li>";
                }
            }
            echo "</ul>";
        }
    }
    



