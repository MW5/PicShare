<?php

require "../Controller/config.php";

class PicLangPl extends Config {
    public $title = "Obrazkownia";
    //body
    public $websiteName = "Wróć do strony głównej";
    //nav
    public $navLeftBtns = array (); 
    public $navRightBtns = array ("Zalogowany jako"=>"usrName", "Utwórz konto"=>"createAccBtn",
        "Zaloguj"=>"logInBtn", "Wyloguj"=>"logOutBtn"); //action must always be the same!
    //content
    public $content = "";
    //modals
    public $modalCloseBtn = "Zamknij";
    //login modal
    public $logInModalHeading = "Zaloguj";
    public $logInModalUsrDataLabel = "Adres E-mail lub nazwa konta";
    public $logInModalPassLabel = "Hasło";
    public $logInModalLogInBtn = "Zaloguj";
    
}