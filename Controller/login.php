<?php
require "dbConnect.php";

//$host = "localhost";
//$user = "mw5";
//$pass = "dupa";
$dbName = "users";

$logData = htmlspecialchars($_POST['usrData']);
$logPass = htmlspecialchars($_POST['pass']);

$query = "select * from users where (usrname='$logData' and usrpass='$logPass') or (usremail='$logData' and usrpass='$logPass')";
$logIn = new dbConnect;
$response = $logIn->connection($dbName, $query);
$numOfMatches = $response->num_rows;
$dataFromDb = $response->fetch_assoc();
if ($numOfMatches==1) {
    session_start();
    $_SESSION ['loggedUsr'] = $dataFromDb['usrname'];
    echo $dataFromDb['usrname'];
} else {
    echo "noUser";
}


