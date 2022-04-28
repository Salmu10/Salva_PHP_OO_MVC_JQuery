<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include ($path . "module/login/model/DAO_login.php");
    include ($path . "module/login/model/validate_register.php");
    include ($path . "view/inc/JWT.php");
    include($path . "model/middleware_auth.php");
    @session_start();

    switch($_GET['op']){

        case 'login_view';
            include("module/login/view/login.html");
            break;

        case 'login':

            try{
                $dao = new DAO_login();
                $rdo = $dao -> select_user($_POST['username']);
                $jwt = parse_ini_file('jwt.ini');
                $header = $jwt['header'];
                $secret = $jwt['secret'];
                $payload = '{"iat":"'.time().'","exp":"'.time() + (60*60).'","name":"'.$rdo["username"].'"}';

                $JWT = new JWT;
                $token = $JWT -> encode($header, $payload, $secret);
            } catch (Exception $e){
                echo json_encode("error");
                exit;
            }

            if(!$rdo){
                echo json_encode("error2");
                exit;
            } else {
                if (password_verify($_POST['password'],$rdo['password'])) {
                    echo json_encode($token);
                    // echo json_encode($rdo['username']);
                    // $_SESSION['user_type'] = $rdo['user_type'];
                    $_SESSION['username'] = $rdo['username'];
					$_SESSION['tiempo'] = time();
                    session_regenerate_id();
                    exit;
                }else {
                    echo json_encode("error");
                    exit;
                }
            }
            break;
        
        case 'register':

            $check = validate_email($_POST['email_reg']);

            if ($check){ 
                try{
                    $dao = new DAO_login();
                    $rdo = $dao -> insert_user($_POST['username_reg'], $_POST['pass_reg'], $_POST['email_reg']);
                }catch (Exception $e){
                    echo json_encode("error");
                    exit;
                }
                if(!$rdo){
                    echo json_encode("error");
                    exit;
                }else{
                    echo json_encode("ok");
                    session_regenerate_id();
                    exit;
                }
            }else{ 
                echo json_encode("error");
                exit;
            }
            break;
            
        case 'logout':
            $_SESSION['tiempo'] = "";
            $_SESSION['username'] = "";
            // session_destroy();

            echo json_encode('Done');
            break;

        case 'data_user':
            
            $decode = decode::decode_username();
            $dao = new DAO_login();
            $rdo = $dao -> select_data($decode);
            
            echo json_encode($rdo);
            exit;

            break;
        
        case 'actividad':
            if (!isset($_SESSION["tiempo"])) {  
                    echo "inactivo";
            } else {  
                if((time() - $_SESSION["tiempo"]) >= 1800) {  
                        echo "inactivo"; 
                        exit();
                }else{
                    echo (time() - $_SESSION["tiempo"]);
                    exit();
                }
            }
            break;
    
        case 'controluser':

            $decode = decode::decode_username();
            $dao = new DAO_login();
            $user = $dao -> select_username($decode);

			if (!isset ($_SESSION['username']) != $user){
				if(isset ($_SESSION['username']) != $user) {
					echo 'not_match';
					exit();
				}
				echo 'match';
				exit();
			}

            break;
        
        case 'refresh_token':

            $decode = decode::decode_username();
            $dao = new DAO_login();
            $user = $dao -> select_username($decode);

            $payload = '{"iat":"'.time().'","exp":"'.time() + (60*60).'","name":"'.$user.'"}';

            $new_token = $JWT -> encode($header, $payload, $secret);

            echo json_encode($new_token);
            break;

        case 'token_expires':

            $jwt = parse_ini_file("jwt.ini");
            $secret = $jwt['secret'];
            $header = $jwt['header'];
            $token = $_POST['token'];

            $JWT = new JWT;
            $json = $JWT -> decode($token, $secret);
            $json = json_decode($json, TRUE);

            if(time() >= $json['exp']) {  
                    echo "inactivo"; 
                    exit();
            }else{
                echo "activo";
                exit();
            }

            break;

        case 'refresh_cookie':
            session_regenerate_id();
            break;

        default;
            include("view/inc/error404.php");
            break;
    }

?>