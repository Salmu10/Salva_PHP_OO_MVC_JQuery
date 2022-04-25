<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "model/connect.php");

    class DAO_home{
        function select_brand() {
            $sql = "SELECT * FROM brand LIMIT 6";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);

            return $res;
        }

        function select_category() {
            $sql = "SELECT * FROM category LIMIT 3";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);

            return $res;
        }

        function select_type() {
            $sql = "SELECT * FROM type LIMIT 4";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);

            return $res;
        }
    }