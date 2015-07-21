<?php

class Model {
    //head
    public $title;
    public $styleAddress;
    public $jsAddress;
    public $bootstrapAddress;
    public $jqueryAddress;
    public $iconAddress;
    //body
        //nav
        public $websiteName;
        public $navLeftBtns;
        public $navRightBtns;
        //jumbotron
        public $content;
        
    //set
    public function __set($name, $value) {
            $this->$name = $value;
        }
    //display functions
    public function display() {
        $this->prepareHead();
        $this->prepareBodyBeforeBtns();
        $this->prepareBtns();
        $this->prepareBodyAfterBtns();
    }
    
    public function prepareHead() {
        echo "<html><head>
                <title>$this->title</title>
                <link rel='stylesheet' type='text/css' href='$this->styleAddress'/>
                <link rel='stylesheet' type='text/css' href='$this->bootstrapAddress'/>
                <script src='$this->bootstrapScriptAddress'></script>
                <script src='$this->jsAddress'></script>
                <script src='$this->jqueryAddress'></script>
                <link rel='shortcut icon' href='$this->iconAddress'/>
              </head>";
    }
    public function prepareBodyBeforeBtns() {
            //nav
        echo "<body>
                <nav class='navbar navbar-inverse'>
                <div class='container-fluid'>
                  <div class='navbar-header'>
                    <a class='navbar-brand' href='#'>$this->websiteName</a>
                  </div>
                  <div>";  
    }
    public function prepareBtns() {
        //left btns
        echo "<ul class='nav navbar-nav'>";
        foreach ($this->navLeftBtns as $name=>$url) {
            echo "<li><a href='$url'>$name</a></li>";
        }
        //right btns
        echo "</ul><ul class='nav navbar-nav navbar-right'>";
        foreach ($this->navRightBtns as $name=>$url) {
            echo "<li><a href='$url'>$name</a></li>";
        }
        echo "</ul>";
    }
    public function prepareBodyAfterBtns() {
        echo "</div>
                </div>
              </nav>".
              //jumbotron
              "<div class='container'>
                <div class='jumbotron'>
                  $this->content
                </div>
              </div>
              </body></html>";
    }
}