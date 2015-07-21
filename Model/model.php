<?php

class Model {
    //head
    public $title;
    public $styleAddress;
    public $jsAddress;
    public $bootstrapAddress;
    public $jqueryAddress;
    public $iconAddress;
    public $logIn = "logIn";
    public $logOut = "logOut";
    //body
        //nav
        public $websiteName;
        public $navLeftBtns;
        public $navRightBtns;
        //jumbotron
        public $content;
        //modal
        public $modalHeading;
        public $modalEmailLabel;
        public $modalPassLabel;
        public $modalLogInBtn;
        public $modalCloseBtn;
        
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
        $this->prepareModals();
    }
    
    public function prepareHead() {
        echo "<html><head>
                <meta charset='UTF-8'>
                <title>$this->title</title>
                <script src='$this->jqueryAddress'></script>
                <script src='$this->jsAddress'></script>
                <link rel='stylesheet' type='text/css' href='$this->styleAddress'/>
                <link rel='stylesheet' type='text/css' href='$this->bootstrapAddress'/>
                <script src='$this->bootstrapScriptAddress'></script>
                <link rel='shortcut icon' href='$this->iconAddress'/>
              </head>";
    }
    public function prepareBodyBeforeBtns() {
            //nav
        echo "<body>
                <nav class='navbar navbar-inverse'>
                <div class='container-fluid'>
                  <div class='navbar-header'>
                    <a class='navbar-brand'>$this->websiteName</a>
                  </div>
                  <div>";  
    }
    public function prepareBtns() {
        //left btns
        echo "<ul class='nav navbar-nav'>";
        foreach ($this->navLeftBtns as $name=>$url) {
            echo "<li><a href='$url'>$name</a></li>";
        }
        //right stuff
        echo "</ul><ul class='nav navbar-nav navbar-right'>";
        foreach ($this->navRightBtns as $name=>$action) {
            if ($action == "logIn") {
                echo "<li><a id='$action' data-toggle='modal' data-target='#logInModal'>$name</a></li>";
            } else {
                echo "<li><a id='$action'>$name</a></li>";
            }
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
    public function prepareModals() {
        echo"<div id='logInModal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>$this->modalHeading</h4>
                    </div>
                    <div class='modal-body'>
                        <form role='form'>
                          <div class='form-group'>
                            <label for='email'>$this->modalEmailLabel:</label>
                            <input type='email' class='form-control' id='modalId' placeholder='Enter email'>
                          </div>
                          <div class='form-group'>
                            <label for='pwd'>$this->modalPassLabel</label>
                            <input type='password' class='form-control' id='modalPass' placeholder='Enter password'>
                          </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-default' data-dismiss='modal'>$this->modalLogInBtn</button>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
                    </div>
                  </div>
                </div>
              </div>";
    }
}