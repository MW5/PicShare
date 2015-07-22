

function request(type, url, dataToSend) {
    $.ajax({
        type: type,
        url: url,
        data: dataToSend,
      })
        .done(function( data ) {
            if (url.search("logIn") || url.search("checkSession")) {
                $("#usrName").html(data);
            }
        });
}
$(document).ready(function() {
//check session
    request("post","Controller/checkSession.php");

//log in
    $("#modalLogIn").click(function(){
        toSend =  {email: $("#modalEmail").val(), pass: $("#modalPass").val()};
        request("post","Controller/logIn.php", toSend);
    });

//log out
    $("#logOut").click(function(){
        request("post","Controller/logOut.php");
    });
});
    



