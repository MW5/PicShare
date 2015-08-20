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
    //footer
    public $footerBtns = array("Kontakt"=>"contact", "Regulamin"=>"terms", "Zasady"=>"rules", "Polityka prywatności"=>"privacy");
    //modals
    public $modalCloseBtn = "Zamknij";
    //login modal
    public $logInModalHeading = "Zaloguj";
    public $logInModalUsrDataLabel = "Adres E-mail lub nazwa konta";
    public $logInModalPassLabel = "Hasło";
    public $logInModalRemindPassBtn = "Wprowadź E-mail jeśli zapomniałeś hasła";
    public $logInModalLogInBtn = "Zaloguj";
    
    //register modal
    public $registerModalHeading = "Zarejestruj konto";
    public $registerModalEmailLabel = "Adres E-mail";
    public $registerModalNameLabel = "Nazwa konta (do 15 znaków)";
    public $registerModalPassLabel = "Hasło (6-20 znaków, conajmniej jedna litera i cyfra)";
    public $registerModalBtn = "Zarejestruj";
    
    //user modal
    public $userModalHeading = "Panel użytkownika";
    public $userName = "Użytkownik: ";
    public $addedPics = "Dodanych obrazków: ";
    public $addedVidLinks = "Dodanych wideo: ";
    public $points = "Ilość punktów: ";
    public $userModalPassChangeLabel = "Nowe hasło";
    public $userModalPassChangeConfirmLabel = "Potwierdź hasło";
    public $userModalPassChangeBtn = "Zmień hasło";
    public $userModalDeleteBtn = "Kliknij trzykrotnie aby usunąć konto";
    
    //contact modal
    public $contactModalHeading = "Kontakt";
    public $contactModalNameLabel = "Imię i nazwisko lub nazwa firmy";
    public $contactModalEmailLabel = "Adres E-mail";
    public $contactModalCaptchaLabel = "Kod";
    public $contactModalTopicLabel = "Temat (do 50 znaków)";
    public $contactModalMessageLabel = "Wiadomość";
    public $contactModalBtn = "Wyślij";

    //terms of usage
    public $termsModalHeading = "Regulamin";
    public $termsModalContent = ""; // tutaj dodac najlepiej z innego pliku?

    //rules
    public $rulesModalHeading = "Zasady";
    public $rulesModalContent = ""; //jak wyzej?

    //privacy politics
    public $privacyModalHeading = "Polityka prywatności";
    public $privacyModalContent = ""; // tez?
    
    public function prepareAdverts() {
        //dont create adverts
    }
    
}