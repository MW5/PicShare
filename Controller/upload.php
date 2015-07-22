<?php
require "dbConnect.php";

session_start();

$dbName = "picshare";
$uploadData = htmlspecialchars($_POST['upload']);
$type = htmlspecialchars($_POST['type']);
$text = htmlspecialchars($_POST['text']);
$usrName = $_SESSION['loggedUsr'];
$usrId = $_SESSION['loggedUsrId'];

if ($type == "pic") {
    //validate link
    //write to hdd function and format the path to upload
} elseif ($type == "vid") {
    //validate picture
    //regex the link for required format 
}

echo $usrId;
echo $type;
echo $uploadData;
echo $usrName;
$query = "insert into links value (null, $usrId, '$usrName', '$type', '$text', 0, null)";

$uploadRequest = new dbConnect;
$response = $uploadRequest->connection($dbName, $query);

echo $response;


