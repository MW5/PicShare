<?php
session_start();

if (isset($_SESSION['loggedUsrId'])) {
    
}
require "dbConnect.php";

$dbName = "picshare";

$usrId = $_SESSION['loggedUsrId'];
$newPass = sha1(htmlspecialchars($_POST['newPass']));

$query = "update users set usrpass='$newPass' where usrid='$usrId'";

$changePassRequest = new dbConnect;
$response = $changePassRequest->connection($dbName, $query);

if ($response==1) {
    echo $response;
} else {
    echo "err";
}
