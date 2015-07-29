<?php
require "dbConnect.php";

$uploadedBy = "Dodane przez ";
$dateOfUpload = " Dnia ";
$points = " Punkty ";

$dbName = "picshare";

if (htmlspecialchars($_POST['dispType'])=="all") {
    $query = "select * from links";
} else {
    $query = "select * from links where points>10";
}

$displayRequest = new dbConnect;
$response = $displayRequest->connection($dbName, $query);

$numOfMatches = $response->num_rows;

for ($i=0; $i<$numOfMatches; $i++) {
        $toDisplay = $response->fetch_assoc();
        echo "<div class='displayedWrapper'><p class='description'>".$toDisplay['text']."</p>";
        if ($toDisplay['type']=="pic") {
            $picPage = explode(".", $toDisplay['path']);
            $picPage[0];
            echo "<a href='..\\UploadedPicPages\\$picPage[0].php'><img class='pic displayed' src='..\\UploadedPics\\".$toDisplay['path']."'></a>";
            //add user and points bar
        } else {
            echo "<iframe class='vid displayed' src='https://www.youtube.com/embed/".$toDisplay['path']."' frameborder='0' allowfullscreen></iframe>";
            //the same
        }
        echo "<p class='underText'>".$uploadedBy.$toDisplay['uploadername']."</br>".
                $dateOfUpload.$toDisplay['uploaddate']."</br>".
                $points.$toDisplay['points']."</p></div>";
    }



