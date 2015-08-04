<?php
require 'dbConnect.php';
require '../View/main_lang.php';

session_start();

if (isset($_SESSION['loggedUsrId'])) {
    
    $translation = new Lang;  
    /*
    public $userName = "Nazwa użytkownika: ";
    public $addedPics = "Dodanych obrazków: ";
    public $addedVidLinks = "Dodanych wideo: ";
    public $points = "Ilość punktów";
     */
    
    $dbName = "picshare";
    $usrId = $_SESSION['loggedUsrId'];
        
    $fillUsrDataRequest = new dbConnect;
    
    //get name, points and mail
    $queryPoints = "select points from users where usrid='$usrId'";
    $usrPointsResponse = $fillUsrDataRequest->connection($dbName, $queryPoints);
    $displayPoints = $usrPointsResponse->fetch_assoc();
    echo "<ul>"
        ."<li class='usrDataLi'>".$translation->userName.$_SESSION['loggedUsr']."</li>"
        ."<li class='usrDataLi'>".$translation->points.$displayPoints['points']."</li>";
    
    //get num of links
    $queryLinksNum = "select path from links, users where usrid='$usrId' and uploaderid=usrid and type='vid'";
    $usrLinksNumResponse = $fillUsrDataRequest->connection($dbName, $queryLinksNum);
    $numOfLinks = $usrLinksNumResponse->num_rows; 
    echo "<li class='usrDataLi'>".$translation->addedVidLinks.$numOfLinks."</li>";
    
    //get num of pics
    $queryPicsNum = "select path from links, users where usrid='$usrId' and uploaderid=usrid and type='pic'";
    $usrPicsNumResponse = $fillUsrDataRequest->connection($dbName, $queryPicsNum);
    $numOfPics = $usrPicsNumResponse->num_rows; 
    echo "<li class='usrDataLi'>".$translation->addedPics.$numOfPics."</li></ul>";
    
}
