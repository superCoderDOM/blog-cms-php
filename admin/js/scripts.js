$(document).ready(function(){

    // CKEditor 5 Initialization
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    // Select All Checkboxes
    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });

    // Loader Animation
    // let div_box = "<div id='load-screen'><div id='loading'></div></div>";
    // $("body").prepend(div_box);

    // $("#load-screen").delay(700).fadeOut(600, function(){
    //     $(this).remove();
    // });
});

// Live Online User Update
function loadUsersOnline() {

    $.get("functions.php?onlineUsers=result", function(data) {
        $(".users-online").text(data);
    });
};

setInterval(function(){

    loadUsersOnline();

}, 500);