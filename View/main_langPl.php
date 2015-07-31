<?php

require "../Controller/config.php";

class LangPl extends Config {
    public $title = "Obrazkownia";
    //body
    public $websiteName = "Obrazki dla Ciebie!";
    //nav
    public $navLeftBtns = array ("Wysoko ocenione"=>"highScore", "Wszystkie"=>"all"); 
    public $navRightBtns = array ("Zalogowany jako"=>"usrName", "Utwórz konto"=>"createAccBtn", "Dodaj"=>"addBtn",
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
    
    //upload modal
    public $uploadModalHeading = "Dodaj plik lub link do wideo";
    public $uploadModalTextLabel = "Opis";
    public $uploadModalFileLabel = "Wybierz plik (dopuszcalne formaty: jpg, jpeg, gif, png";
    public $uploadModalLinkLabel = "Wklej link do filmiku z You Tube";
    public $uploadModalUploadBtn = "Dodaj";
    
    //register modal
    public $registerModalHeading = "Zarejestruj konto";
    public $registerModalEmailLabel = "Adres E-mail";
    public $registerModalNameLabel = "Nazwa konta";
    public $registerModalPassLabel = "Hasło (minimum 6 znaków, conajmniej jedna litera i cyfra)";
    public $registerModalBtn = "Zarejestruj";
    
}