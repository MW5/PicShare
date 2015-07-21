<?php
require "dbConnect.php";

$host = "localhost";
$user = "test";
$pass = "testPass";
$dbName = "users";
$query = "select * from users where usrname='$user' and usrpass='$pass'";
$logIn = new dbConnect;
$response = $logIn->connection($host, $user, $pass, $dbName, $query);
echo $numOfMatches = $response->num_rows;
$test = $response->fetch_assoc();
echo $test['usrname'];
