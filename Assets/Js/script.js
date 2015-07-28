//'constants' for ui coloring according to validation
WRONGCOLOR = "orangered";
GOODCOLOR = "lime";

//
validUpl = false;
validLink = false;
validText = false;
//
function unlockUplBtn () {
    if ((validUpl || validLink) && validText) {
        $("#modalUploadBtn").prop('disabled', false);
    } else {
        $("#modalUploadBtn").prop('disabled', true);
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
    }
    
};

function requestFileUpl(target) {
    var data = new FormData();
    jQuery.each(target[0].files, function(i, file) {
    data.append('file', file);
    });
    jQuery.ajax({
    url: 'Controller/fileUpload.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function(data){
        console.log(data);
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
                    $("#logInBtn").hide();
                    $("#logOutBtn").fadeIn();
                    $("#createAccBtn").hide();
                    $("#addBtn").fadeIn();
                    alert.createAlert(alert.logInSuccess, alert.succ);
                } else {
                    alert.createAlert(alert.logInFail, alert.warn);
                }
            }
            //checkSession
            if (url.search("checkSession")>=0) {
                if (data !== "noUser") {
                    $("#usrName").html(data).fadeIn();
                    $("#addBtn").hide();
                    $("#logOutBtn").fadeIn();
                    $("#addBtn").fadeIn();
                } else {
                    $("#logInBtn").fadeIn();
                    $("#createAccBtn").fadeIn();
                }
            }
            //logOut
            if (url.search("logOut")>=0) {
                $("#usrName").hide();
                $("#logOutBtn").hide();
                $("#createAccBtn").fadeIn();
                $("#logInBtn").fadeIn();
                $("#addBtn").hide();
                alert.createAlert(alert.logOutSuccess, alert.succ);
            }
            //upload
            if (url.search("upload")>=0) {
                alert.createAlert(alert.uploadSuccess, alert.succ);
                console.log(data);
            }
            
        })
        .fail(function() {
            alert.createAlert(alert.sthWentWrong, alert.dang);
        })
}

var alert = {
    //text
    logInSuccess: "Zalogowano pomyślnie",
    logInFail: "Błędne dane logowania",
    logOutSuccess: "Wylogowano poprawnie",
    uploadSuccess: "Dodano pomyślnie",
    sthWentWrong: "Wystąpił problem!",
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
}

$(document).ready(function() {
//stupid bootstrap (or my lack of knowledge) makes me hide stuff like this because when I use display none in css the layout gets rekt
    $("#usrName").hide();
    $("#logInBtn").hide();
    $("#logOutBtn").hide();
    $("#createAccBtn").hide();
    $("#addBtn").hide();

    //check session
    request("post","Controller/checkSession.php");

//log in
    validate.rtLogInValidation($("#modalUsrData"), $("#modalUsrData"), $("#modalPass"), 1, 6, $("#modalLogInBtn"));
    validate.rtLogInValidation($("#modalPass"), $("#modalUsrData"), $("#modalPass"), 1, 6, $("#modalLogInBtn"));
    $("#modalLogInBtn").click(function(){
        toSend =  {usrData: $("#modalUsrData").val(), pass: $("#modalPass").val()};
        request("post","Controller/logIn.php", toSend);
    });

//log out
    $("#logOutBtn").click(function(){
        request("post","Controller/logOut.php");
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
            $("#modalUploadBtn").prop("disabled", true);
            validLink = false;
            unlockUplBtn();
        }
    });
    //text
    $("#modalUploadText").keyup(function() {
        if ($("#modalUploadText").val().length>0) {
            validText = true;
            unlockUplBtn();
        } else {
            validText = false;
            unlockUplBtn();
        }
    });

    //uploadBtn
    $("#modalUploadBtn").click(function() {
        if ($("#modalUpload").val() !=="") {
            toSend = {upload: $("#modalUpload").val(), type:"pic", text:$("#modalUploadText").val()};
            console.log(toSend);
            requestFileUpl($("#modalUpload"));
        }
        if ($("#modalLink").val().length > 0) {
            if ($("#modalLink").val().search("https://www.youtube.com/")>=0) {
                queryLink = $("#modalLink").val().substr($("#modalLink").val().indexOf('=')+1);
            } else {
                queryLink = $("#modalLink").val().substr($("#modalLink").val().indexOf('.be')+4);
            }
            toSend = {upload: $("#modalLink").val(), type:"vid", text: queryLink};
        }
        request("post","Controller/upload.php", toSend);
    });
    
});