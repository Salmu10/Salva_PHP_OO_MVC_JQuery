<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "model/connect.php");
    
    class DAO_login {

        function insert_user($username_reg, $password_reg, $email_reg) {

            $hashed_pass = password_hash($password_reg, PASSWORD_DEFAULT, ['cost' => 12]);
            $hashavatar = md5(strtolower(trim($email_reg))); 
            $avatar = "https://robohash.org/$hashavatar";

            $sql ="INSERT INTO users (username, password, email, user_type, avatar)
            VALUES ('$username_reg', '$hashed_pass', '$email_reg', 'client', '$avatar')";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            return $res;
        }

        function select_user($username) {

			$sql = "SELECT username, email, password, user_type, avatar FROM users WHERE username='$username'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql) -> fetch_object();
            connect::close($conexion);
            $value = get_object_vars($res);

            return $value;
        }

		function select_email($email) {
            
			$sql = "SELECT email FROM users WHERE email='$email'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql) -> fetch_object();
            connect::close($conexion);

            return $res;
		}

        function select_username($username) {
            
			$sql = "SELECT * FROM users WHERE username='$username'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            if ($res -> num_rows == 0) {
                return "error";
            } else {
                return $username;
            }
		}

        function select_data($username) {

			$sql = "SELECT username, email, user_type, avatar FROM users WHERE username='$username'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql) -> fetch_object();
            connect::close($conexion);

            return $res;
        }

    }

?>