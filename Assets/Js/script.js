
function request(type, url, dataToSend) {
    $.ajax({
        type: type,
        url: url,
        data: dataToSend,
      })
        .done(function( data ) {
            //logIn
            if (url.search("logIn")>0) {
                if (data != "noUser") {
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
            if (url.search("checkSession")>0) {
                if (data != "noUser") {
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
            if (url.search("logOut")>0) {
                $("#usrName").hide();
                $("#logOutBtn").hide();
                $("#createAccBtn").fadeIn();
                $("#logInBtn").fadeIn();
                $("#addBtn").hide();
                alert.createAlert(alert.logOutSuccess, alert.succ);
                
            }
        });
}

var alert = {
    //text
    logInSuccess: "Zalogowano pomyślnie",
    logInFail: "Błędne dane logowania",
    logOutSuccess: "Wylogowano poprawnie",
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
    //write email and password validation function!!!
    $("#modalLogInBtn").click(function(){
        toSend =  {usrData: $("#modalUsrData").val(), pass: $("#modalPass").val()};
        request("post","Controller/logIn.php", toSend);
    });

//log out
    $("#logOutBtn").click(function(){
        request("post","Controller/logOut.php");
    });
});

//fileUpload
    //write link validation function!!!
    



