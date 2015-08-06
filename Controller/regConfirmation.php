<?php
require "dbConnect.php";
require "../View/main_lang.php";

$translation = new Lang;

$dbName = "picshare";
$getKey = htmlspecialchars($_GET['activated']);
$query = "select * from users where activated='$getKey'";

$confirmReg = new dbConnect;
$response = $confirmReg->connection($dbName, $query);
$numOfMatches = $response->num_rows;

echo "<head>
        <title>$translation->title</title>
        <meta charset='UTF-8'>
        <link rel='stylesheet' type='text/css' href='$translation->styleAddress'/>
        </head>
        <body><a class='outsidePage' href='../Public/index.php'>";

if ($numOfMatches==1) {
    $register = "update users set activated='1' where activated='$getKey'";
    $response = $confirmReg->connection($dbName, $register);
        echo $translation->regConfirmationSucc;
    } else {
        echo $translation->regConfirmationFail;
}

echo "</a></body>";