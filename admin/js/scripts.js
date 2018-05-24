$(document).ready(function(){

    // CKEditor 5 Initialization
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

});

