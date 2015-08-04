<?php

require "../Controller/config.php";

class PicLang extends Config {
    public $title = "Obrazkownia";
    //body
    public $websiteName = "Wróć do strony głównej";
    //nav
    public $navLeftBtns = array (); 
    public $navRightBtns = array ("Zalogowany jako"=>"usrName", "Utwórz konto"=>"createAccBtn",
        "Zaloguj"=>"logInBtn", "Wyloguj"=>"logOutBtn"); //action must always be the same!
    //content
    public $content = "";
    //tags
    public $tags = array ();
    //modals
    public $modalCloseBtn = "Zamknij";
    //login modal
    public $logInModalHeading = "Zaloguj";
    public $logInModalUsrDataLabel = "Adres E-mail lub nazwa konta";
    public $logInModalPassLabel = "Hasło";
    public $logInModalLogInBtn = "Zaloguj";
    //user modal
    public $userModalHeading = "Panel użytkownika";
    public $deleteUsrModalUserBtn = "Usuń konto";
    public $userName = "Użytkownik: ";
    public $addedPics = "Dodanych obrazków: ";
    public $addedVidLinks = "Dodanych wideo: ";
    public $points = "Ilość punktów: ";
    
    public function prepareAdverts() {
        //dont create adverts
    }
    
}