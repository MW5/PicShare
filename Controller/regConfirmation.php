<?php
require "dbConnect.php";
require "../View/main_langPl.php";

$dbName = "picshare";
$getKey = htmlspecialchars($_GET['activated']);
$query = "select * from users where activated='$getKey'";

$confirmReg = new dbConnect;
$response = $confirmReg->connection($dbName, $query);
$numOfMatches = $response->num_rows;

if ($numOfMatches==1) {
    $register = "update users set activated='1' where activated='$getKey'";
    $response = $confirmReg->connection($dbName, $register);
        echo "<h1>activation success text</h1>";
    } else {
        echo "<h1>activation failure text</h1>";
}
