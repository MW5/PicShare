<?php
require "dbConnect.php";

$host = "localhost";
$user = "mw5";
$pass = "dupa";
$dbName = "users";

$logEmail = $_POST['email'];
$logPass = $_POST['pass'];

$query = "select * from users where usrname='$logEmail' and usrpass='$logPass'";
$logIn = new dbConnect;
$response = $logIn->connection($host, $user, $pass, $dbName, $query);
$numOfMatches = $response->num_rows;
$dataFromDb = $response->fetch_assoc();
if ($numOfMatches==1) {
    session_start();
    $_SESSION ['loggedUsr'] = $dataFromDb['usrname'];
    echo $dataFromDb['usrname'];
}



