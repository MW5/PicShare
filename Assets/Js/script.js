function request(url) {
    $.ajax({
        url: url,
        beforeSend: function( xhr ) {
          xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
        }
      })
        .done(function( data ) {
            console.log(data);
        });
}
$(document).ready(function() {
    $("#test").click(function(){
        request("Controller/login.php");
    })
    
    
})


