//'constants' for ui coloring according to validation
WRONGCOLOR = "orangered";
GOODCOLOR = "lime";
ACTIVECOLOR = "red";
NOTACTIVECOLOR = "#9d9d9d";

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
//checks whether to display all or one
function displayMode () {
    shortAddr = (window.location.href);
    if (shortAddr.indexOf("Public") > 0) {
        return "all";
    } else {
        return "one";
    }
}

//display all
function display(type, mode) {
    if (mode == "all") {
        toSend = {dispType: type};
    } else {
        picName = shortAddr.slice(shortAddr.indexOf("PicPages")+9, -4);
        toSend = {dispType: type, name: picName};
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
    //realtime login validation function
    rtLogInValidation: function(keyTarget, subj1, subj2, minLength1, minLength2, toBlock) {
        $(keyTarget).keyup(function() {
            if (subj1.val().length >= minLength1 && subj2.val().length >= minLength2){
                $(toBlock).prop('disabled', false);
            } else {
                $(toBlock).prop('disabled', true);
            }
        });
    },
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
    uplLinkValidation: function(toCheck) {
        if (toCheck.val().search("https://www.youtube.com/")===0 || toCheck.val().search("https://youtu.be/")===0) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    //validates register mail address
    regMailValidation: function(toCheck) {
        re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (re.test(toCheck.val())) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    //validates fields where only alphanumerics are allowed
    nameText: function(toCheck) {
        re = /^[a-z0-9]+$/i;
        if (re.test(toCheck.val())) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    pass: function(toCheck) {
        re = /^[a-z0-9]+$/i; //only alphanumerics
        re2 = /\D/; //check for at least one letter
        re3 =  /\d/; //check for at least one number
        if (toCheck.val().length >=6 && re.test(toCheck.val()) && re2.test(toCheck.val()) && re3.test(toCheck.val())) {
            toCheck.css('background-color', GOODCOLOR);
            return true;
        } else {
            toCheck.css('background-color', WRONGCOLOR);
            return false;
        }
    },
    //rt validation for similiar text related input
    rtTextValidation: function(toValidate, internalValidation, valVar ,btnToUnlock) {
        toValidate.keyup(function() {
            if (toValidate.val().length>0) {
                window[valVar] = false;
                btnToUnlock();
                if (internalValidation(toValidate)) {
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
        if (data == "success") {
            request("post","../Controller/upload.php", baseData);
        }  else if (data == "error") {
            alert.createAlert(alert.sthWentWrong, alert.dang);
        } else if (data == "exist") {
            alert.createAlert(alert.fileExist, alert.dang);
        } else if (data == "big") {
            alert.createAlert(alert.tooBig, alert.dang);
        }
        }
    });
}

function request(type, url, dataToSend) {
    $.ajax({
        type: type,
        url: url,
        data: dataToSend
      })
        .done(function( data ) {
            //logIn
            if (url.search("logIn")>=0) {
                if (data !== "noUser") {
                    $("#usrName").html(data).fadeIn();
                    logged(true);
                    alert.createAlert(alert.logInSuccess, alert.succ);
                    display(displayMode());
                } else {
                    alert.createAlert(alert.logInFail, alert.warn);
                }
            }
            //checkSession
            if (url.search("checkSession")>=0) {
                if (data !== "noUser") {
                    $("#usrName").html(data).fadeIn();
                    logged(true);
                } else {
                    logged(false);
                }
                display(displayMode());
            }
            //logOut
            if (url.search("logOut")>=0) {
                display(displayMode());
                logged(false);
                alert.createAlert(alert.logOutSuccess, alert.succ);
            }
            //upload
            if (url.search("upload")>=0) {
                if (data == 1) {
                    alert.createAlert(alert.uploadSuccess, alert.succ);
                    display(displayMode());
                } else {
                    alert.createAlert(alert.sthWentWrong, alert.dang);
                }
            }
            //display
            if (url.search("displayPl")>=0) {
                $(".jumbotron").html(data);
            }
            //points
            if (url.search("points")>=0) {
                if (data == "11") {
                    $(".plus").fadeOut();
                    $(".minus").fadeOut();
                    alert.createAlert(alert.uploadSuccess, alert.succ);
                    display(displayMode());
                } else {
                    alert.createAlert(alert.sthWentWrong, alert.dang);
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
    fileExist: "Plik o takiej nazwie istnieje już w naszej bazie. Zmień nazwę!",
    tooBig: "Plik ma zbyt duży rozmiar!",
    pointSuccess: "Oddano głos",
    //types
    succ: "Success",
    info: "Info",
    warn: "Warning",
    dang: "Danger",
    
    createAlert: function(text, type) {
        $("#alert"+type).html(text).fadeIn();
        setTimeout(function() {
            $("#alert"+type).fadeOut();
        },2000);
    }
};

$(document).ready(function() {
//stupid bootstrap (or my lack of knowledge) makes me hide stuff like this because when I use display none in css the layout gets rekt
    $("#usrName").hide();
    $("#logInBtn").hide();
    $("#logOutBtn").hide();
    $("#createAccBtn").hide();
    $("#addBtn").hide();

//again bypassing some bootstrap problem
    $(".topBtns").css("color", NOTACTIVECOLOR);
    $("#all").css("color", ACTIVECOLOR);

//check session
request("post","../Controller/checkSession.php");
display(displayMode());

//display good
$("#highScore").click(function() {
    $("#all").css("color", NOTACTIVECOLOR);
    $("#highScore").css("color", ACTIVECOLOR);
    display("highScore");
});

//display all after click
$("#all").click(function() {
    $("#all").css("color", ACTIVECOLOR);
    $("#highScore").css("color", NOTACTIVECOLOR);
    display("all");
});

//log in
    validate.rtLogInValidation($("#modalUsrData"), $("#modalUsrData"), $("#modalPass"), 1, 6, $("#modalLogInBtn"));
    validate.rtLogInValidation($("#modalPass"), $("#modalUsrData"), $("#modalPass"), 1, 6, $("#modalLogInBtn"));
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
            if (validate.uplLinkValidation($("#modalLink"))) {
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
    validate.rtTextValidation($("#modalUploadText"), validate.nameText, "validText", unlockUplBtn);

    //uploadBtn
    $("#modalUploadBtn").click(function() {
        if ($("#modalUpload").val() !=="") {
            toSend = {upload: $("#modalUpload").val(), type:"pic", text:$("#modalUploadText").val()};
            requestFileUpl($("#modalUpload"), toSend);
        }
        if ($("#modalLink").val().length > 0) {
            if ($("#modalLink").val().search("https://www.youtube.com/")>=0) {
                queryLink = $("#modalLink").val().substr($("#modalLink").val().indexOf('=')+1);
            } else {
                queryLink = $("#modalLink").val().substr($("#modalLink").val().indexOf('.be')+4);
            }
            toSend = {upload: queryLink, type:"vid", text: $("#modalUploadText").val()};
            request("post","../Controller/upload.php", toSend);
        }  
    });
    
    //add and remove points
    $(".jumbotron").on("click", ".plus", function() {
        toSend = {grade: "plus", target:$(this).attr('id')};
        request("post","../Controller/points.php", toSend);
    })
    $(".jumbotron").on("click", ".minus", function() {
        toSend = {grade: "minus", target:$(this).attr('id')};
        request("post","../Controller/points.php", toSend);
    });
    
    //registration
    validate.rtTextValidation($("#modalRegisterEmail"), validate.regMailValidation, "validEmail", unlockRegBtn);
    
    //name
    validate.rtTextValidation($("#modalRegisterName"), validate.nameText, "validName", unlockRegBtn);
    
    //password
    validate.rtTextValidation($("#modalRegisterPwd"), validate.pass, "validPass", unlockRegBtn);
    //WRITE PASSWORD VALIDATION 
//    $("#modalRegisterName").keyup(function() {
//        if ($("#modalRegisterName").val().length>0) {
//            if (validate.nameText($("#modalRegisterName"))) {
//                validName = true;
//                unlockRegBtn();
//            } else {
//                validName = false;
//                unlockRegBtn();
//            }
//        } else {
//            $("#modalRegisterName").css('background-color', 'transparent');
//            validName = false;
//            unlockRegBtn();
//        }
//    });
    
    
});