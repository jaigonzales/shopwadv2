
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

function inviteFriendsOnFacebook() {
    document.getElementById("facebookInvite").addEventListener("click", function(event){
        event.preventDefault();
    });
    FB.ui({
        method: 'share',
        display: 'popup',
        href: 'http://www.shopwad.com',
    }, function(response){});
}