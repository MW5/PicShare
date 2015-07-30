<?php
require "dbConnect.php";

session_start();

if (isset($_SESSION['loggedUsrId'])) {
    $dbName = "picshare";
    $pathData = htmlspecialchars($_POST['upload']);
    $type = htmlspecialchars($_POST['type']);
    $text = htmlspecialchars($_POST['text']);
    $usrName = $_SESSION['loggedUsr'];
    $usrId = $_SESSION['loggedUsrId'];

    if ($type == "pic") {
        $pathData = substr($pathData, strrpos($pathData, "\\")+1);
    } elseif ($type == "vid") {
        if (strpos($pathData, "https://www.youtube.com/") === 0 ) {
            $pathData = substr($pathData, strpos($pathData, "=")+1);
        }
        if (strpos($pathData, "https://youtu.be/") === 0) {
            $pathData = substr($pathData, strpos($pathData, ".be/")+4);
        } 
    }

    $query = "insert into links value (null, $usrId, '$usrName','$pathData', '$type', '$text', 0, null)";

    $uploadRequest = new dbConnect;
    $response = $uploadRequest->connection($dbName, $query);

    echo $response;
}


