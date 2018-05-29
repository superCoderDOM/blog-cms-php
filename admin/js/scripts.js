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

});

