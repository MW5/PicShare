<?php

require "../Controller/config.php";

class Lang extends Config {
    public $title = "Obrazkownia";
    //body
    public $websiteName = "Wymyślić jakiś fajny tytuł";
    //nav
    public $navLeftBtns = array ("Najlepsze 10"=>"topTen", "Wszystkie"=>"all"); 
    public $navRightBtns = array ("Zalogowany jako"=>"usrName", "Utwórz konto"=>"createAccBtn", "Dodaj"=>"addBtn",
        "Zaloguj"=>"logInBtn", "Wyloguj"=>"logOutBtn"); //action must always be the same!
    //content
    public $content = "";
    //tags
    public $tags = array ("test1", "test2", "test3");
    //modals
    public $modalCloseBtn = "Zamknij";
    //login modal
    public $logInModalHeading = "Zaloguj";
    public $logInModalUsrDataLabel = "Adres E-mail lub nazwa konta";
    public $logInModalPassLabel = "Hasło";
    public $logInModalLogInBtn = "Zaloguj";
    
    //upload modal
    public $uploadModalHeading = "Dodaj plik lub link do wideo";
    public $uploadModalTextLabel = "Opis (do 40 znaków)";
    public $uploadModalFileLabel = "Wybierz plik (dopuszczalne formaty: jpg, jpeg, gif, png)";
    public $uploadModalLinkLabel = "Wklej link do filmiku z You Tube";
    public $uploadModalTagLabel = "Wybierz najbradziej pasujący tag";
    public $uploadModalUploadBtn = "Dodaj";
    
    //user modal
    public $userModalHeading = "Panel użytkownika";
    public $deleteUsrModalUserBtn = "Kliknij trzykrotnie aby usunąć konto";
    public $userName = "Użytkownik: ";
    public $addedPics = "Dodanych obrazków: ";
    public $addedVidLinks = "Dodanych wideo: ";
    public $points = "Ilość punktów: ";
    
    //register modal
    public $registerModalHeading = "Zarejestruj konto";
    public $registerModalEmailLabel = "Adres E-mail";
    public $registerModalNameLabel = "Nazwa konta (do 15 znaków)";
    public $registerModalPassLabel = "Hasło (6-20 znaków, conajmniej jedna litera i cyfra)";
    public $registerModalBtn = "Zarejestruj";
    
    //mail
    public $mailConfirmReg = "Potwierdź rejestrację"; //gdzie?
    public $mailContent = "";
    public $mailFrom = "Nazwa portalu";
    
    //display
    public $uploadedBy = " przez  ";
    public $dateOfUpload = " Dodane ";
    public $grade = "Punkty: ";
}