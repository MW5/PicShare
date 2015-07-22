<?php

require "Controller/config.php";

class LangPl extends Config {
    public $title = "Obrazkownia";
    //body
    public $websiteName = "Obrazki dla Ciebie!";
    //nav
    public $navLeftBtns = array ("Główna"=>"index.php", "Poczekalnia"=>"waitingRoom.php"); 
    public $navRightBtns = array ("Zalogowany jako"=>"usrName", "Utwórz konto"=>"createAcc", "Dodaj"=>"add",
        "Zaloguj"=>"logIn", "Wyloguj"=>"logOut"); //action must always be the same!
    //content
    public $content = "<p id='test'>costam</p>";
    //modal
    public $modalHeading = "Zaloguj";
    public $modalEmailLabel = "Adres E-mail";
    public $modalPassLabel = "Hasło";
    public $modalLogInBtn = "Zaloguj";
    public $modalCloseBtn = "Zamknij";
    
    
}