<?php

class Model {
    //head
    public $title;
    public $styleAddress;
    public $jsAddress;
    public $bootstrapAddress;
    public $bootstrapScriptAddress;
    public $jqueryAddress;
    public $iconAddress;
    public $logIn = "logIn";
    public $logOut = "logOut";
    
    //body
    //mail stuff
    public $mailSubject;
    public $mailContent;
    public $mailFrom;
    
    //loading spinner
    public $spinnerAddress;
    
    //ad places
    public $adL;
    public $adLLink;
    public $adR;
    public $adRLink;
    
    //nav
    public $websiteName;
    public $navLeftBtns;
    public $navRightBtns;
    
    //tags
    public $tags;
    
    //jumbotron
    public $content;
    
    //modals
        //universal
        public $modalCloseBtn;
        //login modal
        public $logInModalHeading;
        public $logInModalUsrDataLabel;
        public $logInModalPassLabel;
        public $logInModalLogInBtn;

        //upload modal
        public $uploadModalHeading;
        public $uploadModalTextLabel;
        public $uploadModalFileLabel;
        public $uploadModalLinkLabel;
        public $uploadModalUploadBtn;
        
        //user modal
        public $userModalHeading;
        public $deleteUsrModalUserBtn;

        //register modal
        public $registerModalHeading;
        public $registerModalEmailLabel;
        public $registerModalNameLabel;
        public $registerModalPassLabel;
        public $registerModalBtn;
        
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
        $this->prepareModalLogIn();
        $this->prepareModalUpload();
        $this->prepareModalUser();
        $this->prepareModalRegister();
        $this->prepareAlerts();
        $this->prepareSpinner();
        $this->prepareAdverts();
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
                <nav class='navbar navbar-inverse navbar-fixed-top'>
                <div class='container-fluid'>
                  <div class='navbar-header'>
                    <a class='navbar-brand' id='webName' href='../Public/index.php'>$this->websiteName</a>
                  </div>
                  <div>";  
    }
    public function prepareBtns() {
        //left btns
        echo "<ul class='nav navbar-nav'>";
        foreach ($this->navLeftBtns as $name=>$action) {
        echo "<li><a id='$action' class='topBtns'>$name</a></li>";
        }
        //right stuff
        echo "</ul><ul class='nav navbar-nav navbar-right topBtns'>";
        foreach ($this->navRightBtns as $name=>$action) {
            if ($action == "logInBtn") {
                echo "<li><a id='$action' class='topBtns' data-toggle='modal' data-target='#logInModal'>$name</a></li>";
            } elseif ($action == 'addBtn') {
                echo "<li><a id='$action' class='topBtns' data-toggle='modal' data-target='#uploadModal'>$name</a></li>";
            } elseif ($action == 'createAccBtn') {
                echo "<li><a id='$action' class='topBtns' data-toggle='modal' data-target='#registerModal'>$name</a></li>";
            } elseif ($action == 'usrName') {
                echo "<li><a id='$action' class='topBtns' data-toggle='modal' data-target='#userModal'>$name</a></li>";
            } else {
                echo "<li><a id='$action' class='topBtns'>$name</a></li>";
            }
        }
        echo "</ul>";
        echo "</ul><ul class='nav navbar-nav navbar-right topBtns'>";
        echo "</ul>";
    }
    public function prepareBodyAfterBtns() {
        echo "</div>
                </div>
              </nav>";
        //tags
        echo "<ul id='tagsWrapper'>";
        foreach($this->tags as $tag) {
            echo "<li class='tags'><a id='$tag' class='singleTag'>$tag</a></li>";
        }
        echo "</ul>";
              //jumbotron
        echo "<div class='container'>
                <div class='jumbotron'>
                  $this->content
                </div>
              </div>
              </body></html>";
    }
    public function prepareModalLogIn() {
        echo"<div id='logInModal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>$this->logInModalHeading</h4>
                    </div>
                    <div class='modal-body'>
                        <form role='form'>
                          <div class='form-group'>
                            <label for='text'>$this->logInModalUsrDataLabel:</label>
                            <input type='text' class='form-control' id='modalUsrData'>
                          </div>
                          <div class='form-group'>
                            <label for='pwd'>$this->logInModalPassLabel:</label>
                            <input type='password' class='form-control' id='modalPass'>
                          </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' id='modalLogInBtn' class='btn btn-default'>$this->logInModalLogInBtn</button>
                      <button type='button' id='modalCloseLogIn' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
                    </div>
                  </div>
                </div>
              </div>";
    }
    public function prepareModalUpload() {
        echo"<div id='uploadModal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>$this->uploadModalHeading</h4>
                    </div>
                    <div class='modal-body'>
                        <form role='form'>
                          <div class='form-group'>
                            <label for='file'>$this->uploadModalFileLabel:</label>
                            <input type='file' class='form-control' id='modalUpload'>
                          </div>
                          <div class='form-group'>
                            <label for='link'>$this->uploadModalLinkLabel:</label>
                            <input type='text' class='form-control' id='modalLink'>
                          </div>
                          <div class='form-group'>
                            <label for='description'>$this->uploadModalTextLabel:</label>
                            <input type='text' class='form-control' id='modalUploadText'>
                          </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' id='modalUploadBtn' class='btn btn-default' disabled='true'>$this->uploadModalUploadBtn</button>
                      <button type='button' id='modalCloseUploadBtn' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
                    </div>
                  </div>
                </div>
              </div>";
    }
    public function prepareModalRegister() {
        echo"<div id='registerModal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>$this->registerModalHeading</h4>
                    </div>
                    <div class='modal-body'>
                        <form role='form'>
                          <div class='form-group'>
                            <label for='email'>$this->registerModalEmailLabel:</label>
                            <input type='email' class='form-control' id='modalRegisterEmail'>
                          </div>
                          <div class='form-group'>
                            <label for='text'>$this->registerModalNameLabel:</label>
                            <input type='text' class='form-control' id='modalRegisterName'>
                          </div>
                          <div class='form-group'>
                            <label for='pwd'>$this->registerModalPassLabel:</label>
                            <input type='password' class='form-control' id='modalRegisterPass'>
                          </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' id='modalRegisterBtn' class='btn btn-default' disabled='true'>$this->registerModalBtn</button>
                      <button type='button' id='modalCloseRegisterBtn' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
                    </div>
                  </div>
                </div>
              </div>";
    }
    public function prepareModalUser() {
        echo"<div id='userModal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>$this->userModalHeading</h4>
                    </div>
                    <div class='modal-body' id='usrModalContainer'>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' id='modalUserDeleteBtn' class='btn btn-default'>$this->deleteUsrModalUserBtn</button>
                      <button type='button' id='modalCloseUserBtn' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
                    </div>
                  </div>
                </div>
              </div>";
    }
    public function prepareAlerts() {
        echo "<div id='alertSuccess' class='alert alert-success'>
              </div>
              <div id='alertInfo' class='alert alert-info'>
              </div>
              <div id='alertWarning' class='alert alert-warning'>
              </div>
              <div id='alertDanger' class='alert alert-danger'>
              </div>";
    }
    public function prepareSpinner() {
        echo "<img id='spinner' src='$this->spinnerAddress'>";
    }
    public function prepareAdverts() {
        echo "<a class='advert' href='$this->adLLink'><img id='adL' src='$this->adL'></a>
                <a class='advert' href='$this->adRLink'><img id='adR' src='$this->adR'></a>";
    }
}