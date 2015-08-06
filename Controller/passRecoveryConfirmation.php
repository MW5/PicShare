<!DOCTYPE html>
<?php
require "dbConnect.php";
require "../View/main_lang.php";

$translation = new Lang;

$dbName = "picshare";
$getKey = htmlspecialchars($_GET['recovery']);
$tempPass = substr($getKey, 0, 6);
$tempPassSha = sha1($tempPass);
$query = "select recovery from users where recovery='$getKey'";
$queryResetPass = "update users set usrpass='$tempPassSha' where recovery='$getKey'";
$queryNoRecovery = "update users set recovery=NULL where recovery='$getKey'";

$resetPass = new dbConnect;

$response = $resetPass->connection($dbName, $query);
$numOfMatches = $response->num_rows;

echo "<head>
        <title>$translation->title</title>
        <meta charset='UTF-8'>
        <link rel='stylesheet' type='text/css' href='$translation->styleAddress'/>
        </head>
        <body><a class='outsidePage' href='../Public/index.php'>";
    
if ($numOfMatches == 1) {
    $responseResetPass = $resetPass->connection($dbName, $queryResetPass);
    $responseNoRecovery = $resetPass->connection($dbName, $queryNoRecovery);
    if ($responseResetPass == 1 && $responseNoRecovery == 1) {
            echo $translation->passRecoverySucc."</a></br><span id='tempPass'>".$tempPass;
    } else {
        echo $translation->passRecoveryFail."</a>";
    }
} else {
    echo $translation->passRecoveryFail;
}

echo "</span></div></body>";
