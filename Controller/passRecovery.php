<?php
session_start();

require "dbConnect.php";
require "../View/main_lang.php";

$dbName = "picshare";

$email = htmlspecialchars($_POST['email']);

$valid = 0;

$passRecoveryRequest = new dbConnect;

//email validation
$emailRe = "/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i";
if (preg_match($emailRe, $email) && strlen($email)<=50) {
    $checkEmailExist = "select * from users where usrmail='$email'";
    $response = $passRecoveryRequest->connection($dbName, $checkEmailExist);
    $exists = $response->num_rows;
    if ($exists===1) {
        $valid++;
    } else {
        echo "noEmail";
    } 
}

if ($valid == 1) {
    //CHANGE ACTIVATION LINK ADDRESS IF NEEDED!!!
    $hash = md5( rand(0,1000) ); // this is going to be sent in email
    echo $passRecoveryLink = htmlspecialchars($_SERVER['SERVER_NAME']."/projects/PicShare/Controller/passRecoveryConfirmation.php?recovery=$hash");
    $passRecoveryQuery = "update users set recovery='$hash' where usrmail='$email'";
    $response = $passRecoveryRequest->connection($dbName, $passRecoveryQuery);
    if ($response==1) {
        //UNCOMMENT AND TEST WHEN ON A SERVER!!!
//        $translation = new Lang;
//        $to      = "$email";
//        $subject = "$translation->mailPassRecovery";
//        $message = "$passRecoveryLink";
//        $headers = "From: '$translation->mailFrom\r\n'" . phpversion();
//        mail($to, $subject, $message, $headers);
//        echo $response;
    } else {
        echo "err";
    }
}




