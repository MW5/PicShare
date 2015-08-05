<?php
require "dbConnect.php";
require "../View/main_lang.php";
session_start();

$translation = new Lang;

$dbName = "picshare";

$type = htmlspecialchars($_POST['dispType']);

$displayRequest = new dbConnect;

if ($type=="topTen") {
    $query = "select * from links where points>10 order by points desc limit 10";
} else if ($type=="one") {
    $picName = htmlspecialchars($_POST['name']);
    $query = "select * from links where (path regexp '^$picName".".[a-z]')";
} else {
    $typeQuery = $type*10-10;
    $query = "select * from links order by uploaddate desc limit 10 offset $typeQuery";
    //separate select to check for number of uploaded stuff in order to create pages btns
    $getNum = "select linkid from links";
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
        echo "<div class='displayedWrapper'><p class='description'>".$toDisplay['text']."</p>";
        if ($toDisplay['type']=="pic") {
            $picPage = explode(".", $toDisplay['path']);
            $picPage[0];
            //check what link url to set according to mode of displaying (one or all)
            if ($type=="one") {
                 echo "<a href='..\\Public\\index.php'><img class='pic displayed' src='..\\UploadedPics\\".$toDisplay['path']."'></a>";
            } else {
            echo "<a href='..\\UploadedPicPages\\$picPage[0].php'><img width='80%' height='auto' class='pic displayed' src='..\\UploadedPics\\".$toDisplay['path']."'></a>";
            }
        } else {
            echo "<iframe width='80%' height='415' class='vid displayed' src='https://www.youtube.com/embed/".$toDisplay['path']."' frameborder='0' allowfullscreen></iframe>";
        }
        
        $plus = "";
        $minus = "";
        
        if  (isset($_SESSION['loggedUsrId'])) {
            $plus = "<a id='p".$toDisplay['path']."' class='plus'>+</a>";
            $minus = "<a id='m".$toDisplay['path']."' class='minus'>-</a>";
            for ($j=0; $j<$numOfGrades; $j++) {
                if ($displayed[$i] == $grades[$j]) {
                    $plus = "";
                    $minus = "";
                    break;
                }
            }

        }
        echo "<p class='underText'><span class='uplInfo'>".$translation->dateOfUpload.$toDisplay['uploaddate'].
                $plus.
                $minus.
                $translation->uploadedBy.$toDisplay['uploadername']."</span></br>".
                "<span class='points'>".$translation->grade.$toDisplay['points']."</span>".
                "</p></div>";
    }
    
    if (isset($numOfLinks)) {
        echo "<ul class='pagesWrapper'>";
        for ($i=1; $i<=$numOfLinks/10+1; $i++) {

            if ($i==$type){
                echo "<li class='pages'><a id='$i' class='currentPage singlePage'>$i</a></li>";
            } else {
                echo "<li class='pages'><a id='$i' class='singlePage'>$i</a></li>";
            }
        }
        echo "</ul>";
    }



