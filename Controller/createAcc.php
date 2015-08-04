<?php
session_start();

require "dbConnect.php";
require "../View/main_lang.php";

$dbName = "picshare";

$email = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$pass = htmlspecialchars($_POST['pass']);

$valid = 0;

$createAccRequest = new dbConnect;

//email validation
$emailRe = "/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i";
if (preg_match($emailRe, $email) && strlen($email)<=50) {
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
if (strlen($name) > 0 && strlen($name) < 15) {
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
if (strlen($pass)>=6 && strlen($pass<=20) && preg_match($passRe1, $pass) && preg_match($passRe2, $pass) && preg_match($passRe3, $pass)) {
    $valid++;
}

if ($valid == 3) {
    //CHANGE ACTIVATION LINK ADDRESS IF NEEDED!!!
    $hash = md5( rand(0,1000) ); // this is going to be sent in email
    $activationLink = htmlspecialchars($_SERVER['SERVER_NAME']."/projects/PicShare/Controller/regConfirmation.php?activated=".$hash);
    $sha1Pass = sha1($pass);
    $registerQuery = "insert into users value (null, '$email', '$name', '$sha1Pass', '$hash', 0)";
    $response = $createAccRequest->connection($dbName, $registerQuery);
    if ($response==1) {
        //UNCOMMENT AND TEST WHEN ON A SERVER!!!
//        $translation = new Lang;
//        $to      = "$email";
//        $subject = "$translation->mailConfirmReg";
//        $message = "$activationLink";
//        $headers = "From: '$translation->mailFrom\r\n'" . phpversion();
//        mail($to, $subject, $message, $headers);
        echo $response;
    } else {
        echo "err";
    }
}




