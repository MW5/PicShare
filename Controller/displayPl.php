<?php
require "dbConnect.php";

session_start();

$uploadedBy = " przez  ";
$dateOfUpload = " Dodane ";
$points = " Punkty ";

$dbName = "picshare";

if (htmlspecialchars($_POST['dispType'])=="all") {
    $query = "select * from links order by linkid desc";
} else if (htmlspecialchars($_POST['dispType'])=="highScore") {
    $query = "select * from links where points>10";
} else {
    $picName = htmlspecialchars($_POST['name']);
    $query = "select * from links where (path regexp '^$picName".".[a-z]')";
}

$displayRequest = new dbConnect;

//checks for user grades
if (isset($_SESSION['loggedUsrId'])){
    $usrId = htmlspecialchars($_SESSION['loggedUsrId']);
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
            if (htmlspecialchars($_POST['dispType'])=="one") {
                 echo "<a href='..\\Public\\index.php'><img class='pic displayed' src='..\\UploadedPics\\".$toDisplay['path']."'></a>";
            } else {
            echo "<a href='..\\UploadedPicPages\\$picPage[0].php'><img width='80%' height='auto' class='pic displayed' src='..\\UploadedPics\\".$toDisplay['path']."'></a>";
            }
        } else {
            echo "<iframe width='678px' height='381px' class='vid displayed' src='https://www.youtube.com/embed/".$toDisplay['path']."' frameborder='0' allowfullscreen></iframe>";
        }
        //grade buttons ONLY FOR LOGGED IN AND THOS THAT HAVEN GRADED IT YET!
        
        $plus = "";
        $minus = "";
        
        if  (isset($_SESSION['loggedUsrId'])) {
            $plus = "<a id='p".$toDisplay['path']."' class='plus'><img src='../Assets/Img/plusBtn.png'></a>";
            $minus = "<a id='m".$toDisplay['path']."' class='minus'><img src='../Assets/Img/minusBtn.png'></a>";
            for ($j=0; $j<$numOfGrades; $j++) {
                if ($displayed[$i] == $grades[$j]) {
                    $plus = "";
                    $minus = "";
                    break;
                }
            }

        }
        echo "<p class='underText'>".$dateOfUpload.$toDisplay['uploaddate'].
                $uploadedBy.$toDisplay['uploadername']."</br>".
                $plus.
                $points.$toDisplay['points']." ".
                $minus."</p></div>";
            
    }



