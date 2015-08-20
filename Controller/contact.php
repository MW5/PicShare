<?php
session_start();

require "dbConnect.php";
require "../View/main_lang.php";

$dbName = "picshare";

$email = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$topic = htmlspecialchars($_POST['topic']);
$msg = htmlspecialchars($_POST['msg']);

$valid = 0;

//email validation
$emailRe = "/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i";
if (preg_match($emailRe, $email) && strlen($email)<=50) {
    $valid++;
}

//name validation
if (strlen($name) > 0 && strlen($name) <= 50) {
    $valid++;
}

//topicvalidation
if (strlen($topic) > 0 && strlen($topic) <= 50) {
    $valid++;
}

//msg validation
if (strlen($msg) > 0 && strlen($msg) <= 500) {
    $valid++;
}

if ($valid == 4) {

        //UNCOMMENT AND TEST WHEN ON A SERVER!!!
//        $translation = new Lang;
//        $to      = "$translation->websiteMail";
//        $subject = "$topic";
//        $message = "$msg";
//        $headers = "From: '$email\r\n'" . phpversion();
//        mail($to, $subject, $message, $headers);
    echo "1";
} else {
    echo "err";
}




