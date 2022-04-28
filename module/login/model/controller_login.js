function login(){

    if(validate_login() != 0){
        var data = $('#login_form').serialize();
        $.ajax({
            url: "module/login/controller/controller_login.php?op=login",
            dataType: "JSON",
            type: "POST",
            data: data,
        }).done(function(result) {	
            if(result == "error"){		
                $("#error_password").html('Wrong password');
            }else{
                localStorage.setItem("token", result);
                toastr.options.timeOut = 3000;
                toastr.success("Inicio de sesión realizado");
                if(localStorage.getItem('likes') == null) {
                    setTimeout('window.location.href = "index.php?module=home&op=home";', 1000);
                } else {
                    console.log(localStorage.getItem('product'));
                    setTimeout('window.location.href = "index.php?module=shop&op=view";', 1000);
                    // $('html, body').animate({scrollTop: $("#"+ localStorage.getItem('product') +".list_car_desc")});
                    // $('html, body').animate({scrollTop: $("#footer-wrapper")});
                }
            }	
        }).fail(function() {
            window.location.href = 'index.php?module=errors&op=503&desc=Login error';
        });     
    }
}

function key_login(){
	$("#login_form").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
        	// e.preventDefault();
            login();
        }
    });
}

function button_login(){
	$('#button_login').on('click', function(e) {
        // e.preventDefault();
        login();
    }); 
}

function validate_login(){
    var error = false;

	if(document.getElementById('username').value.length === 0){
		document.getElementById('error_username').innerHTML = "Tienes que escribir el usuario";
		error = true;
	}else{
        document.getElementById('error_username').innerHTML = "";
    }
	
	if(document.getElementById('pass').value.length === 0){
		document.getElementById('error_password').innerHTML = "Tienes que escribir la contraseña";
		error = true;
	}else{
        document.getElementById('error_password').innerHTML = "";
    }
	
    if(error == true){
        return 0;
    }
}

$(document).ready(function(){
    key_login();
    button_login(); 
});