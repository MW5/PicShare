<?php
require "dbConnect.php";
session_start();

if (isset($_SESSION['loggedUsr'])) {
    
    $dbName = "picshare";
    $usrId = $_SESSION['loggedUsrId'];
    $deleteAccQuery = "delete from users where usrid='$usrId'";
    
    $deleteAccRequest = new dbConnect;
    $response = $deleteAccRequest->connection($dbName, $deleteAccQuery);
    if ($response == 1) {
        echo "deleted";
    } else {
        echo "err";
    }
}
