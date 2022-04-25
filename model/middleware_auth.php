<?php

class decode{
    public static function decode_username(){
		
        $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/module/login/controller/jwt.ini');
		$secret = $jwt['secret'];
		$header = $jwt['header'];
		$token = $_POST['token'];

		$JWT = new JWT;
		$json = $JWT -> decode($token, $secret);
		$json = json_decode($json, TRUE);

        $decode_user = $json['name'];

        return $decode_user;
    }
}