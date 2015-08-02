<?php
require "dbConnect.php";

session_start();

if (isset($_SESSION['loggedUsrId'])) {
    $dbName = "picshare";
    $grade = htmlspecialchars($_POST['grade']);
    $target = substr(htmlspecialchars($_POST['target']), 1);

    $usrName = $_SESSION['loggedUsr'];
    $usrId = $_SESSION['loggedUsrId'];

    if ($grade == "plus") {
        $query = "update links set points=points+1 where path='$target'";
    } else {
        $query = "update links set points=points-1 where path='$target'";
    }
    $usrGradeQuery = "insert into grades value ($usrId, '$target')";
    
    $gradeRequest = new dbConnect;
    $usrGradeQueryResponse = $gradeRequest->connection($dbName, $usrGradeQuery);
    if ($usrGradeQueryResponse==1) {
        $response = $gradeRequest->connection($dbName, $query);
        echo $response;
    }
    
    echo $usrGradeQueryResponse;

}