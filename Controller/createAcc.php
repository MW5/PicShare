<?php
session_start();

require "dbConnect.php";

$dbName = "picshare";

$email = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$pass = htmlspecialchars($_POST['pass']);

$valid = 0;

$createAccRequest = new dbConnect;

//email validation
$emailRe = "/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i";
if (preg_match($emailRe, $email)) {
    $checkEmailExist = "select * from users where usrmail='$email'";
    $response = $createAccRequest->connection($dbName, $checkEmailExist);
    $exists = $response->num_rows;
    if ($exists===0) {
        $valid++;
    } else {
        echo "emailExists";
    } 
}

//name validation
if (strlen($name) > 0) {
    $checkNameExist = "select * from users where usrname='$name'";
    $response = $createAccRequest->connection($dbName, $checkNameExist);
    $exists = $response->num_rows;
    if ($exists===0) {
        $valid++;
    } else {
        echo "nameExists";
    } 
}

//pass validation
$passRe1 = "/^[a-z0-9]+$/i";
$passRe2 = "/\D/";
$passRe3 = "/\d/";
if (strlen($pass)>=6 &&preg_match($passRe1, $pass) && preg_match($passRe2, $pass) && preg_match($passRe3, $pass)) {
    $valid++;
}

if ($valid == 3) {
    $registerQuery = "insert into users value (null, '$email', '$name', '$pass')";
    $response = $createAccRequest->connection($dbName, $registerQuery);
    echo $response;
}



