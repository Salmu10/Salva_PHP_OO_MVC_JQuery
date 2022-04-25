<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "model/connect.php");
    
    class DAO_search{

        function select_car_type(){
            
			$sql = "SELECT DISTINCT type_name FROM type";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_car_brand(){
            
            $sql = "SELECT DISTINCT brand_name FROM brand";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_car_type_brand($car_type){
            
            $sql = "SELECT DISTINCT b.brand_name FROM cars c INNER JOIN type t INNER JOIN brand b ON c.brand = b.cod_brand AND c.type = t.cod_type WHERE t.type_name='$car_type'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_auto_car_type($auto, $car_type){
            
            $sql = "SELECT DISTINCT c.city FROM cars c INNER JOIN type t ON c.type = t.cod_type WHERE t.type_name='$car_type' AND c.city LIKE '$auto%'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_auto_car_type_brand($auto, $car_type, $car_brand){
            
            $sql = "SELECT DISTINCT c.city FROM cars c INNER JOIN type t INNER JOIN brand b ON c.brand = b.cod_brand AND c.type = t.cod_type WHERE t.type_name='$car_type' AND b.brand_name='$car_brand' AND c.city LIKE '$auto%'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_auto_car_brand($auto, $car_brand){
            
            $sql = "SELECT DISTINCT c.city FROM cars c INNER JOIN brand b ON c.brand = b.cod_brand WHERE b.brand_name='$car_brand' AND c.city LIKE '$auto%'";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_auto($auto){
            
            $sql = "SELECT DISTINCT city FROM cars WHERE city LIKE '$auto%'";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }
        
    }

?>