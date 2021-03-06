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
    
    //footer
    public $footerBtns;
    
    //modals
        //universal
        public $modalCloseBtn;
        //login modal
        public $logInModalHeading;
        public $logInModalUsrDataLabel;
        public $logInModalPassLabel;
        public $logInModalRemindPassBtn;
        public $logInModalLogInBtn;

        //upload modal
        public $uploadModalHeading;
        public $uploadModalTextLabel;
        public $uploadModalFileLabel;
        public $uploadModalLinkLabel;
        public $uploadModalTagLabel;
        public $uploadModalUploadBtn;
        
        //user modal
        public $userModalHeading;
        public $userModalPassChangeLabel;
        public $userModalPassChangeConfirmLabel;
        public $userModalPassChangeBtn;
        public $userModalDeleteBtn;

        //register modal
        public $registerModalHeading;
        public $registerModalEmailLabel;
        public $registerModalNameLabel;
        public $registerModalPassLabel;
        public $registerModalBtn;
        
        //contact modal
        public $contactModalHeading;
        public $contactModalNameLabel;
        public $contactModalEmailLabel;
        public $contactModalCaptchaLabel;
        public $contactModalTopicLabel;
        public $contactModalMessageLabel;
        public $contactModalBtn;
        
        //terms of usage
        public $termsModalHeading;
        public $termsModalContent;
        
        //rules
        public $rulesModalHeading;
        public $rulesModalContent;
        
        //privacy politics
        public $privacyModalHeading;
        public $privacyModalContent;
        
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
        $this->prepareModalContact();
        $this->prepareModalsOnlyText("terms", $this->termsModalHeading, $this->termsModalContent);
        $this->prepareModalsOnlyText("rules", $this->rulesModalHeading, $this->rulesModalContent);
        $this->prepareModalsOnlyText("privacy", $this->privacyModalHeading, $this->privacyModalContent);
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
            <div id='fb-root'></div>
            <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = '//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.4';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
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
            echo "<li class='tags'><a id='$tag' class='singleTag'>#$tag</a></li>";
        }
        echo "</ul>";
              //jumbotron
        echo "<div class='container'>
                <div class='jumbotron'>
                  $this->content
                </div>
              </div>";
        echo "<ul id='footerWrapper'>";
        foreach($this->footerBtns as $name=>$action) {
            if ($action == "contact") {
                echo "<li class='tags'><a id='$action' class='singleTag' data-toggle='modal' data-target='#contactModal'>$name</a></li>";
            } elseif ($action == 'terms') {
                echo "<li class='tags'><a id='$action' class='singleTag' data-toggle='modal' data-target='#termsModal'>$name</a></li>";
            } elseif ($action == 'rules') {
                echo "<li class='tags'><a id='$action' class='singleTag' data-toggle='modal' data-target='#rulesModal'>$name</a></li>";
            } elseif ($action == 'privacy') {
                echo "<li class='tags'><a id='$action' class='singleTag' data-toggle='modal' data-target='#privacyModal'>$name</a></li>";
            }
        }
        echo "</ul></body></html>";         
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
                        <button type='submit' id='modalRemindPassBtn' class='btn btn-default' disabled='true'>$this->logInModalRemindPassBtn</button>
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
                          <div class='form-group'>
                            <label for='description'>$this->uploadModalTagLabel:</label>
                            <select class='form-control' id='modalUploadTag'>"; 
                            foreach($this->tags as $tag) {
                                echo "<option value='$tag'>$tag</option>";
                            }
                            echo "</select>
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
                    <div class='modal-body usrModalPassChangeWrapper'>
                        <div class='form-group'>
                            <label for='pwd' id='a'>$this->userModalPassChangeLabel:</label>
                            <input type='password' class='form-control' id='modalUsrPassChange'>
                            <label for='pwd'>$this->userModalPassChangeConfirmLabel:</label>
                            <input type='password' class='form-control' id='modalUsrPassChangeConfirm'>
                        </div>
                    </div>
                    <div class='modal-footer'>
                       <button type='submit' id='modalPassChangeBtn' class='btn btn-default'>$this->userModalPassChangeBtn</button>
                       <button type='submit' id='modalDeleteBtn' class='btn btn-default'>$this->userModalDeleteBtn</button>
                      <button type='button' id='modalCloseUserBtn' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
                    </div>
                  </div>
                </div>
              </div>";
    }
    public function prepareModalContact() {
        echo"<div id='contactModal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>$this->contactModalHeading</h4>
                    </div>
                    <div class='modal-body'>
                        <form role='form'>
                          <div class='form-group'>
                            <label for='email'>$this->contactModalEmailLabel:</label>
                            <input type='email' class='form-control' id='modalContactEmail'>
                          </div>
                          <div class='form-group'>
                            <label for='text'>$this->contactModalNameLabel:</label>
                            <input type='text' class='form-control' id='modalContactName'>
                          </div>
                          <div class='form-group'>
                            <label for='pwd'>$this->contactModalCaptchaLabel:</label>
                            PUT CAPTCHA HERE
                          </div>
                          <div class='form-group'>
                            <label for='text'>$this->contactModalTopicLabel:</label>
                            <input type='text' class='form-control' id='modalContactTopic'></textarea>
                          </div>
                          <div class='form-group'>
                            <label for='text'>$this->contactModalMessageLabel:</label>
                            <textarea class='form-control' id='modalContactMsg'></textarea>
                          </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' id='modalContactBtn' class='btn btn-default' disabled='true'>$this->contactModalBtn</button>
                      <button type='button' id='modalCloseContactBtn' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
                    </div>
                  </div>
                </div>
              </div>";
    }
    public function prepareModalsOnlyText($id, $heading, $content) {
        echo"<div id='".$id."Modal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>$heading</h4>
                    </div>
                    <div class='modal-body'>
                    $content
                    </div>
                    <div class='modal-footer'>
                      <button type='button' id='modalClose".ucfirst($id)."Btn' class='btn btn-default' data-dismiss='modal'>$this->modalCloseBtn</button>
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