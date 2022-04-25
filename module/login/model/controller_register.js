function register(){

    if(validate_register() != 0){
        var data = $('#register_form').serialize();
        // console.log(data);
        $.ajax({
            url: "module/login/controller/controller_login.php?op=register&" + data,
            type: "POST",
            dataType: "JSON",
            data: data,
        }).done(function(result) {   
            if(result == "error"){		
                $("#error_email_reg").html('El email ya esta registrado');
            }else{
                console.log("Hola");
                setTimeout('window.location.href = "index.php?module=login&op=login_view";', 1000);
            }	
        }).fail(function() {
            window.location.href = 'index.php?module=errors&op=503&desc=Register error';
        }); 
    }
}

function key_register(){
	$("#register_form").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13){
        	e.preventDefault();
            register();
        }
    });
}

function button_register(){
	$('#button_register').on('click', function(e) {
        e.preventDefault();
        register();
    }); 
}

function validate_register(){
    var mail_exp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var error = false;

	if(document.getElementById('username_reg').value.length === 0){
		document.getElementById('error_username_reg').innerHTML = "You have to write an username";
		error = true;
	}else{
        if(document.getElementById('username_reg').value.length > 15 || document.getElementById('username_reg').value.length < 5){
            console.log("hola");
            document.getElementById('error_username_reg').innerHTML = "The username must be between 5 and 15 characters";
            error = true;
        }else{
            document.getElementById('error_username_reg').innerHTML = "";
        }
    }

    if(document.getElementById('pass_reg').value.length === 0){
		document.getElementById('error_password_reg').innerHTML = "You have to write a password";
		error = true;
	}else{
        if(document.getElementById('pass_reg').value.length < 8){
            document.getElementById('error_password_reg').innerHTML = "The password must be longer than 8 characters";
            error = true;
        }else{
            document.getElementById('error_password_reg').innerHTML = "";
        }
    }

    if(document.getElementById('pass_reg_2').value != document.getElementById('pass_reg').value){
		document.getElementById('error_password_reg_2').innerHTML = "Passwords don't match";
		error = true;
	}else{
        document.getElementById('error_password_reg_2').innerHTML = "";
    }

    if(document.getElementById('email_reg').value.length === 0){
		document.getElementById('error_email_reg').innerHTML = "You have to write an email";
		error = true;
	}else{
        if(!mail_exp.test(document.getElementById('email_reg').value)){
            document.getElementById('error_email_reg').innerHTML = "The email format is invalid"; 
            error = true;
        }else{
            document.getElementById('error_email_reg').innerHTML = "";
        }
    }
	
    if(error == true){
        return 0;
    }
}

$(document).ready(function(){
    key_register();
    button_register();
});