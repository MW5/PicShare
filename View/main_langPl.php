<?php

require "Controller/config.php";

class LangPl extends Config {
    public $title = "Obrazkownia";
    //body
    public $websiteName = "Obrazki dla Ciebie!";
    public $navLeftBtns = array ("Główna"=>"index.php", "Poczekalnia"=>"waitingRoom.php");
    public $navRightBtns = array ("Zaloguj"=>"#", "Wyloguj"=>"#");
    public $content = "<p id='test'>dupa</p>";
}