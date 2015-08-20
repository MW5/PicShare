<?php
require "dbConnect.php";

session_start();

if (isset($_SESSION['loggedUsrId'])) {
    $dbName = "picshare";
    $pathData = htmlspecialchars($_POST['upload']);
    $currentContent = htmlspecialchars($_POST['type']);
    $text = htmlspecialchars($_POST['text']);
    $tag = htmlspecialchars($_POST['tag']);
    $usrName = $_SESSION['loggedUsr'];
    $usrId = $_SESSION['loggedUsrId'];

    if ($currentContent == "pic") {
        $pathData = substr($pathData, strrpos($pathData, "\\")+1);
    } elseif ($currentContent == "vid") {
        if (strpos($pathData, "https://www.youtube.com/") === 0 ) {
            $pathData = substr($pathData, strpos($pathData, "=")+1);
        }
        if (strpos($pathData, "https://youtu.be/") === 0) {
            $pathData = substr($pathData, strpos($pathData, ".be/")+4);
        } 
    }

    if (($currentContent == "pic" || $currentContent == "vid") && strlen($pathData)>0 && strlen($text) >0) {
        $query = "insert into links value (null, $usrId, '$usrName','$pathData', '$currentContent', '$text', '$tag', 0, null, false)";
        $uploadRequest = new dbConnect;
        $response = $uploadRequest->connection($dbName, $query);
    }
    echo $response;
}


