//'constants' for ui coloring according to validation
WRONGCOLOR = "orangered";
GOODCOLOR = "lime";
ACTIVECOLOR = "red";
NOTACTIVECOLOR = "#cccccc";

currentlyDisplayedPage = "1";
currentlyDisplayedContent = "all";

//click count for acc deletion
clickCount = 0;

//upload validation
validUpl = false;
validLink = false;
validText = false;
//for rt upload input validation
function unlockUplBtn () {
    if ((validUpl || validLink) && validText) {
        $("#modalUploadBtn").prop('disabled', false);
    } else {
        $("#modalUploadBtn").prop('disabled', true);
    }
}

//register validation
validEmail = false;
validName = false;
validPass = false;
//for rt register input validation
function unlockRegBtn () {
    if (validEmail && validName && validPass) {
        $("#modalRegisterBtn").prop('disabled', false);
    } else {
        $("#modalRegisterBtn").prop('disabled', true);
    }
}

//checks whether to display more or one
function displayMode () {
    shortAddr = (window.location.href);
    if (shortAddr.indexOf("Public") > 0) {
        $(".jumbotron").removeClass('onePicMode');
        $(".container").removeClass('onePicMode');
    } else {
        $(".jumbotron").addClass('onePicMode');
        $(".container").addClass('onePicMode');
        currentlyDisplayedContent = "one";
    }
}

//display one or more
function display() {
    displayMode();
    if (currentlyDisplayedContent === "one")  {
        picName = shortAddr.slice(shortAddr.indexOf("PicPages")+9, -4);
        toSend = {currentContent: currentlyDisplayedContent, name: picName, currentPage: currentlyDisplayedPage};
    } else {
        toSend = {currentContent: currentlyDisplayedContent, currentPage: currentlyDisplayedPage};
    }
    request("post","../Controller/displayPl.php", toSend);
}

//btns show/hide for logged/logged out user
function logged (status) {
    if (status) {
        $("#logInBtn").hide();
        $("#logOutBtn").fadeIn();
        $("#createAccBtn").hide();
        $("#addBtn").fadeIn();
    } else {
        $("#logInBtn").fadeIn();
        $("#createAccBtn").fadeIn();
        $("#usrName").hide();
        $("#logOutBtn").hide();
        $("#addBtn").hide();
    }
}

//validation object
var validate = {
    //checks upload file extension 
    checkExtension: function(toCheck) {
        var ext = toCheck.val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        } else {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        }
    },
    //validates the youtube link
    uplLinkValidation: function(toCheck, maxLength) {
        if ((toCheck.val().search("https://www.youtube.com/")===0 || toCheck.val().search("https://youtu.be/")===0) && toCheck.val().length <= maxLength) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    //validates register mail address
    regMailValidation: function(toCheck, maxLength) {
        re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (re.test(toCheck.val()) && toCheck.val().length <= maxLength) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    //validates fields where only alphanumerics are allowed
    nameText: function(toCheck, maxLength) {
        re = /^[a-z0-9_ ]+$/i;
        if (re.test(toCheck.val()) && toCheck.val().length <= maxLength) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    pass: function(toCheck, maxLength) {
        re = /^[a-z0-9]+$/i; //only alphanumerics
        re2 = /\D/; //check for at least one letter
        re3 =  /\d/; //check for at least one number
        if (toCheck.val().length <=maxLength && toCheck.val().length >=6 && re.test(toCheck.val()) && re2.test(toCheck.val()) && re3.test(toCheck.val())) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    //rt validation for similiar text related input
    rtTextValidation: function(toValidate, internalValidation, maxLength, valVar ,btnToUnlock) {
        toValidate.keyup(function() {
            if (toValidate.val().length>0) {
                window[valVar] = false;
                btnToUnlock();
                if (internalValidation(toValidate, maxLength)) {
                    window[valVar] = true;
                    btnToUnlock();
                }
            }
            else  {
                toValidate.css('background-color', 'transparent');
                window[valVar] = false;
                btnToUnlock();
            }
        });
    }
    
};

function requestFileUpl(target, baseData) {
    var data = new FormData();
    $.each(target[0].files, function(i, file) {
    data.append('file', file);
    });
    $.ajax({
    url: '../Controller/fileUpload.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function(data){
        if (data === "success") {
            request("post","../Controller/upload.php", baseData);
        }  else if (data === "error") {
            alert.createAlert(alert.sthWentWrong, alert.dang);
        } else if (data === "exist") {
            alert.createAlert(alert.fileExist, alert.dang);
        } else if (data === "big") {
            alert.createAlert(alert.tooBig, alert.dang);
        }
        }
    });
}

function request(type, url, dataToSend) {
    if (url.search("points")<0) {
        $("#spinner").show();
    }
    $.ajax({
        type: type,
        url: url,
        data: dataToSend
      })
        .done(function( data ) {
            $("#spinner").hide();
            //logIn
            if (url.search("logIn")>=0) {
                if (data !== "noUser") {
                    display();
                    $("#logInModal").modal('toggle');
                    $("#usrName").html(data).fadeIn();
                    logged(true);
                    alert.createAlert(alert.logInSuccess, alert.succ);
                    request("post","../Controller/fillUsrData.php", toSend);
                } else {
                    alert.createAlert(alert.logInFail, alert.warn);
                }
            }
            //checkSession
            if (url.search("checkSession")>=0) {
                if (data !== "noUser") {
                    $("#usrName").html(data).fadeIn();
                    logged(true);
                    request("post","../Controller/fillUsrData.php", toSend);
                } else {
                    logged(false);
                }
            }
            //logOut
            if (url.search("logOut")>=0) {
                display();
                logged(false);
                alert.createAlert(alert.logOutSuccess, alert.succ);
            }
            //upload
            if (url.search("upload")>=0) {
                if (data == 1) {
                    $("#uploadModal").modal('toggle');
                    alert.createAlert(alert.uploadSuccess, alert.succ);
                    display();
                } else {
                    alert.createAlert(alert.sthWentWrong, alert.dang);
                }
            }
            //display
            if (url.search("displayPl")>=0) {
                $(".jumbotron").html(data);
                console.log(data);
            }
            //points
            if (url.search("points")>=0) {
                if (!data === "11") {
                    alert.createAlert(alert.sthWentWrong, alert.dang);
                }
            }
            //registerAcc
            if (url.search("createAcc")>=0){
                if (data == 1) {
                    alert.createAlert(alert.registerSuccess, alert.succ);
                    $("#registerModal").modal('toggle');
                }  else if (data === "emailExists") {
                    alert.createAlert(alert.emailExists, alert.warn);
                }  else if (data === "nameExists") {
                    alert.createAlert(alert.nameExists, alert.warn);
                } else if (data === "emailExistsnameExists") {
                    alert.createAlert(alert.userExists, alert.warn);
                } else {
                    alert.createAlert(alert.sthWentWrong, alert.warn);
                }
            }
            if (url.search("fillUsrData")>=0) {
                $("#usrModalContainer").html(data);
            }
            //delete acc
            if (url.search("deleteAcc")>=0) {
                if (data == "deleted") {
                    $("#userModal").modal('toggle');
                    request("post","../Controller/logOut.php");
                } else {
                    alert.createAlert(alert.sthWentWrong, alert.warn);
                }
            }
            
        })
        .fail(function() {
            alert.createAlert(alert.sthWentWrong, alert.dang);
        })
};

var alert = {
    //text
    logInSuccess: "Zalogowano pomyślnie",
    logInFail: "Błędne dane logowania",
    logOutSuccess: "Wylogowano poprawnie",
    uploadSuccess: "Dodano pomyślnie",
    sthWentWrong: "Wystąpił problem!",
    fileExist: "Plik o takiej nazwie istnieje już w naszej bazie.",
    tooBig: "Plik ma zbyt duży rozmiar!",
    pointSuccess: "Oddano głos",
    emailExists: "Na podany adres e-mail zarejestrowano już konto!",
    nameExists: "Użytkownik o podanej nazwie już istnieje",
    registerSuccess: "Zarejestrowano konto, aktywuj je linkiem otrzymanym na maila",
    userExists: "Użytkownik o podanym adresie e-mail oraz nazwie już istnieje",
    //types
    succ: "Success",
    info: "Info",
    warn: "Warning",
    dang: "Danger",
    
    createAlert: function(text, type) {
        $("#alert"+type).html(text).fadeIn();
        setTimeout(function() {
            $("#alert"+type).fadeOut();
        },4000);
    }
};

$(document).ready(function() {
//stupid bootstrap (or my lack of knowledge) makes me hide stuff like this because when I use display none in css the layout gets rekt
    $("#usrName").hide();
    $("#logInBtn").hide();
    $("#logOutBtn").hide();
    $("#createAccBtn").hide();
    $("#addBtn").hide();
    
//modal submit on enter
function submitOnEnt (modal, modalBtn) {
    modal.keyup(function(event){
        if(event.keyCode == 13 && !modalBtn.prop('disabled')){
            modalBtn.click();
        }
    });
}
submitOnEnt ($("#logInModal"), $("#modalLogInBtn"));
submitOnEnt ($("#uploadModal"), $("#modalUploadBtn"));
submitOnEnt ($("#registerModal"), $("#modalRegisterBtn"));

//check session
request("post","../Controller/checkSession.php");
display();

//display pages on click
$(".jumbotron").on("click", ".singlePage", function () {
    currentlyDisplayedPage = $(this).attr('id');
    $(".singlePage").css("color", NOTACTIVECOLOR);
    $(this).css("color", ACTIVECOLOR);
    display($(this).attr('id'));
});

//display according to tags
$("#tagsWrapper").on("click", ".singleTag", function () {
    currentlyDisplayedPage = "1";
    currentlyDisplayedContent = $(this).attr('id');
    display($(this).attr('id'));
    $(".singleTag").css("color", NOTACTIVECOLOR);
    $("#topTen").css("color", NOTACTIVECOLOR);
    $("#all").css("color", NOTACTIVECOLOR);
    $(this).css("color", ACTIVECOLOR);
});

//display good
$("#topTen").click(function() {
    currentlyDisplayedPage = "1";
    currentlyDisplayedContent = $(this).attr('id');
    $(".singleTag").css("color", NOTACTIVECOLOR);
    $("#all").css("color", NOTACTIVECOLOR);
    $("#topTen").css("color", ACTIVECOLOR);
    display("topTen");
});

//display all after click
$("#all").click(function() {
    currentlyDisplayedPage = "1";
    currentlyDisplayedContent = $(this).attr('id');
    $(".singleTag").css("color", NOTACTIVECOLOR);
    $("#all").css("color", ACTIVECOLOR);
    $("#topTen").css("color", NOTACTIVECOLOR);
    display();
});

//log in
    $("#modalLogInBtn").click(function(){
        toSend =  {usrData: $("#modalUsrData").val(), pass: $("#modalPass").val()};
        request("post","../Controller/logIn.php", toSend);
    });

//log out
    $("#logOutBtn").click(function(){
        request("post","../Controller/logOut.php");
    });

//fileUpload
    //file
    $("#modalUpload").change(function() {
        if ($("#modalUpload").val() !=="" && validate.checkExtension($("#modalUpload"))) {
            $("#modalLink").prop("disabled", true);
            validUpl = true;
            unlockUplBtn();
        }   else if ($("#modalUpload").val() =="") {
            $("#modalUpload").css('background-color', 'transparent');
            $("#modalLink").prop("disabled", false);
            validUpl = false;
            unlockUplBtn();
        }   else {
            $("#modalLink").prop("disabled", true);
            validUpl = false;
            unlockUplBtn();
        }
    });
    //link
    $("#modalLink").keyup(function() {
        if ($("#modalLink").val().length>0) {
            $("#modalUpload").prop("disabled", true);
            validLink = false;
            unlockUplBtn();
            if (validate.uplLinkValidation($("#modalLink"),70)) {
                validLink = true;
                unlockUplBtn();
            }
        }
        else  {
            $("#modalLink").css('background-color', 'transparent');
            $("#modalUpload").prop("disabled", false);
            validLink = false;
            unlockUplBtn();
        }
    });
    //text
    validate.rtTextValidation($("#modalUploadText"), validate.nameText, 40, "validText", unlockUplBtn);

    //uploadBtn
    $("#modalUploadBtn").click(function() {
        if ($("#modalUpload").val() !=="") {
            toSend = {upload: $("#modalUpload").val(), type:"pic", text:$("#modalUploadText").val(), tag:$("#modalUploadTag").val()};
            requestFileUpl($("#modalUpload"), toSend);
        }
        if ($("#modalLink").val().length > 0) {
            if ($("#modalLink").val().search("https://www.youtube.com/")>=0) {
                queryLink = $("#modalLink").val().substr($("#modalLink").val().indexOf('=')+1);
            } else {
                queryLink = $("#modalLink").val().substr($("#modalLink").val().indexOf('.be')+4);
            }
            toSend = {upload: queryLink, type:"vid", text: $("#modalUploadText").val(), tag:$("#modalUploadTag").val()};
            request("post","../Controller/upload.php", toSend);
        }  
    });
    
    //to handle grading
    function plusMinus (targetClass) {
        //add and remove points
        $(".jumbotron").on("click", targetClass, function() {
            toModify = $(this).attr('id').substr(1, ($(this).attr('id').indexOf("."))-1);
            $(".pm"+toModify).css("color", "#cccccc");
            if (targetClass === ".plus") {
                var valToIncrease = $("#pkt"+toModify).html();
                var increasedVal = parseInt(valToIncrease)+1;
                $("#pkt"+toModify).html(increasedVal);
                toSend = {grade: "plus", target:$(this).attr('id')};
                request("post","../Controller/points.php", toSend);
            } else {
                var valToDecrease = $("#pkt"+toModify).html();
                var decreasedVal = parseInt(valToDecrease)-1;
                $("#pkt"+toModify).html(decreasedVal);
                toSend = {grade: "minus", target:$(this).attr('id')};
                request("post","../Controller/points.php", toSend);
            }
        });
    }
    plusMinus(".plus");
    plusMinus(".minus");
    
    
    //registration
    validate.rtTextValidation($("#modalRegisterEmail"), validate.regMailValidation, 50, "validEmail", unlockRegBtn);
    
    //name
    validate.rtTextValidation($("#modalRegisterName"), validate.nameText, 15, "validName", unlockRegBtn);
    
    //password
    validate.rtTextValidation($("#modalRegisterPass"), validate.pass, 20, "validPass", unlockRegBtn);
    
    //registerBtn
    $("#modalRegisterBtn").click(function() {
        toSend = {email: $("#modalRegisterEmail").val(), name: $("#modalRegisterName").val(), pass: $("#modalRegisterPass").val()};
        request("post","../Controller/createAcc.php", toSend);
    });
    //deleteAccBtn
    $("#modalUserDeleteBtn").click(function() {
        clickCount++;
        if (clickCount === 3) {
            request("post","../Controller/deleteAcc.php", toSend);
            clickCount = 0;
        }
    });
    
});