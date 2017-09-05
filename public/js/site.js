
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$('#new_avatar').change(function(){
   readURL(this);
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#current-avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}