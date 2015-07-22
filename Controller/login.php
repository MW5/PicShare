<?php
require "dbConnect.php";

$dbName = "picshare";
$logData = htmlspecialchars($_POST['usrData']);
$logPass = htmlspecialchars($_POST['pass']);
$query = "select * from users where (usrname='$logData' and usrpass='$logPass') or (usrmail='$logData' and usrpass='$logPass')";

$logInRequest = new dbConnect;
$response = $logInRequest->connection($dbName, $query);
$numOfMatches = $response->num_rows;
$dataFromDb = $response->fetch_assoc();
if ($numOfMatches==1) {
    session_start();
    $_SESSION ['loggedUsr'] = $dataFromDb['usrname'];
    $_SESSION ['loggedUsrId'] = $dataFromDb['usrid'];
    echo $dataFromDb['usrname'];
} else {
    echo "noUser";
}


