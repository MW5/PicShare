<?php
require "dbConnect.php";

session_start();

if (isset($_SESSION['loggedUsrId'])) {
    $dbName = "picshare";
    $uploadData = htmlspecialchars($_POST['upload']);
    $type = htmlspecialchars($_POST['type']);
    $text = htmlspecialchars($_POST['text']);
    $usrName = $_SESSION['loggedUsr'];
    $usrId = $_SESSION['loggedUsrId'];

    if ($type == "pic") {
        $uploadData = substr($uploadData, strrpos($uploadData, "\\")+1);
    } elseif ($type == "vid") {
        if (strpos($uploadData, "https://www.youtube.com/") === 0 ) {
            $uploadData = substr($uploadData, strpos($uploadData, "=")+1);
        }
        if (strpos($uploadData, "https://youtu.be/") === 0) {
            $uploadData = substr($uploadData, strpos($uploadData, ".be/")+4);
        } 
    }

    $query = "insert into links value (null, $usrId, '$usrName','$uploadData', '$type', '$text', 0, null)";

    $uploadRequest = new dbConnect;
    $response = $uploadRequest->connection($dbName, $query);

    echo $response;
}


