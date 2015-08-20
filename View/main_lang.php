<?php

require "../Controller/config.php";

class Lang extends Config {
    public $title = "0-100";
    //body
    public $websiteName = "ZERO DO SETKI";
    //nav
    public $navLeftBtns = array ("Najlepsze 10"=>"topTen", "Wszystkie"=>"all"); 
    public $navRightBtns = array ("Zalogowany jako"=>"usrName", "Utwórz konto"=>"createAccBtn", "Dodaj"=>"addBtn",
        "Zaloguj"=>"logInBtn", "Wyloguj"=>"logOutBtn"); //action must always be the same!
    //content
    public $content = "";
    //tags
    public $tags = array ("europa", "ameryka", "azja", "muscle", "klasyk", "tuning", "drifting", "przyspieszenie", "dźwięk", "f1");
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
    
    //upload modal
    public $uploadModalHeading = "Dodaj plik lub link do wideo";
    public $uploadModalTextLabel = "Opis (do 40 znaków)";
    public $uploadModalFileLabel = "Wybierz plik (dopuszczalne formaty: jpg, jpeg, gif, png)";
    public $uploadModalLinkLabel = "Wklej link do filmiku z You Tube";
    public $uploadModalTagLabel = "Wybierz najbradziej pasujący tag";
    public $uploadModalUploadBtn = "Dodaj";
    
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
    
    //register modal
    public $registerModalHeading = "Zarejestruj konto";
    public $registerModalEmailLabel = "Adres E-mail";
    public $registerModalNameLabel = "Nazwa konta (do 15 znaków)";
    public $registerModalPassLabel = "Hasło (6-20 znaków, conajmniej jedna litera i cyfra)";
    public $registerModalBtn = "Zarejestruj";
    
    //contact modal
    public $contactModalHeading = "Kontakt";
    public $contactModalNameLabel = "Imię i nazwisko lub nazwa firmy (do 50 znaków)";
    public $contactModalEmailLabel = "Adres E-mail";
    public $contactModalCaptchaLabel = "Kod";
    public $contactModalTopicLabel = "Temat (do 50 znaków)";
    public $contactModalMessageLabel = "Wiadomość (do 500 znaków)";
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
    
    //mail
    public $mailConfirmReg = "Potwierdź rejestrację"; //gdzie?
    public $mailContent = "";
    public $websiteMail = "Nazwa portalu";
    public $mailPassRecovery = "Kliknij aby zresetować hasło";
    
    //display
    public $uploadedBy = " przez  ";
    public $dateOfUpload = " Dodane ";
    public $grade = "Punkty: ";
    
    //reg confirmation
    public $regConfirmationSucc = "Konto aktywowane";
    public $regConfirmationFail = "Wystąpił problem";
    
    //pass recovery
    public $passRecoverySucc = "Skopiuj swoje tymczasowe hasło i zmień je po zalogowaniu w panelu użytkownika: ";
    public $passRecoveryFail = "Wystąpił problem";
}