const inputs = document.querySelectorAll(".input-md");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});
// ----------------------- Menu
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
$(document).ready(function() {
    $("#show_hide_password_user a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password_user input').attr("type") == "text"){
            $('#show_hide_password_user input').attr('type', 'password');
            $('#show_hide_password_user i').addClass( "fa-eye-slash" );
            $('#show_hide_password_user i').removeClass( "fa-eye" );
        }else if($('#show_hide_password_user input').attr("type") == "password"){
            $('#show_hide_password_user input').attr('type', 'text');
            $('#show_hide_password_user i').removeClass( "fa-eye-slash" );
            $('#show_hide_password_user i').addClass( "fa-eye" );
        }
    });
});
$(document).ready(function() {
    $("#show_hide_password_pass a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password_pass input').attr("type") == "text"){
            $('#show_hide_password_pass input').attr('type', 'password');
            $('#show_hide_password_pass i').addClass( "fa-eye-slash" );
            $('#show_hide_password_pass i').removeClass( "fa-eye" );
        }else if($('#show_hide_password_pass input').attr("type") == "password"){
            $('#show_hide_password_pass input').attr('type', 'text');
            $('#show_hide_password_pass i').removeClass( "fa-eye-slash" );
            $('#show_hide_password_pass i').addClass( "fa-eye" );
        }
    });
});