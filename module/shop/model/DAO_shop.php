<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "model/connect.php");

    class DAO_shop{

        function select_all_cars($orderby, $total_prod, $items_page) {

            $sql = "SELECT c.*, b.*, t.*, ct.* FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand AND c.type = t.cod_type AND c.category = ct.cod_category ORDER BY $orderby visits DESC LIMIT $total_prod, $items_page";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_details($id) {

            $sql = "SELECT c.*, b.*, t.*, ct.* FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand AND c.type = t.cod_type AND c.category = ct.cod_category WHERE c.id = '$id'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql) -> fetch_object();
            connect::close($conexion);
            return $res;
        }

        function select_details_images($id) {

            $sql = "SELECT image_name FROM car_images WHERE id_car = '$id'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $array = array();

            if (mysqli_num_rows($res) > 0) {
                foreach ($res as $row) {
                    array_push($array, $row);
                }
            }
            return $array;
        }

        function select_filters(){

            $array_filters = array('type_name', 'category_name', 'color', 'extras', 'doors');  // 'brand_name', 
            $array_return = array();

            foreach ($array_filters as $row) {

                $sql = 'SELECT DISTINCT ' . $row . ' FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand AND c.type = t.cod_type AND c.category = ct.cod_category';
                $conexion = connect::con();
                $res = mysqli_query($conexion, $sql);
                connect::close($conexion);

                if (mysqli_num_rows($res) > 0) {
                    while ($row_inner[] = mysqli_fetch_assoc($res)) {
                        $array_return[$row] = $row_inner;
                    }
                    unset($row_inner);
                }
            }
            return $array_return;
        }

        function sql_filter($filters){
            $continue = "";
            $cont = 0;
            $cont1 = 0;
            $cont2 = 0;
            $select = ' WHERE ';
            foreach ($filters as $key => $row) {
                foreach ( $row as $key => $row_inner) {
                    if ($cont == 0) {
                        foreach ($row_inner as $value) {
                            if ($cont1 == 0) {
                                $continue = $key . ' IN ("'. $value . '"';
                            }else {
                                $continue = $continue  . ', "' . $value . '"';
                            }
                            $cont1++;
                        }
                        $continue = $continue . ')';
                    }else {
                        foreach ($row_inner as $value)  {
                            if ($cont2 == 0) {
                                $continue = ' AND ' . $key . ' IN ("' . $value . '"';
                            }else {
                                $continue = $continue . ', "' . $value . '"';
                            }
                            $cont2++;
                        }
                        $continue = $continue . ')';
                    }
                }
                $cont++;
                $cont2 = 0;
                $select = $select . $continue;
            }
            return $select;
        }
    
        function filters($sql_filter, $orderby, $total_prod, $items_page){

            $sql = "SELECT c.*, b.*, t.*, ct.* FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand AND c.category = ct.cod_category AND c.type = t.cod_type $sql_filter ORDER BY $orderby visits DESC LIMIT $total_prod, $items_page";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function maps_details($id) {

            $sql = "SELECT id, city, lat, lng FROM cars WHERE id = '$id'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql) -> fetch_object();
            connect::close($conexion);
            return $res;
        }

        function update_view($id){
            $sql = "UPDATE cars c SET visits = visits + 1 WHERE id = '$id'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_count() {

            $sql = "SELECT COUNT(*) AS num_cars FROM cars";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }
    
        function select_count_filters($filters) {

            $sql = "SELECT COUNT(*) AS num_cars FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand AND c.category = ct.cod_category AND c.type = t.cod_type $filters";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_cars($category, $type, $id, $loaded, $items) {

            $sql = "SELECT c.*, b.*, t.*, ct.* FROM cars c INNER JOIN brand b INNER JOIN type t INNER JOIN category ct ON c.brand = b.cod_brand AND c.type = t.cod_type AND c.category = ct.cod_category WHERE c.category = '$category' AND c.id <> $id OR c.type = '$type' AND c.id <> $id LIMIT $loaded, $items";

			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        function select_load_likes($username){

            $sql = "SELECT id_car FROM likes WHERE username='$username'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }
    
        function select_likes($id, $username){

            $sql = "SELECT username, id_car FROM likes WHERE username='$username' AND id_car='$id'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            
            return $res;
        }
    
        function insert_likes($id, $username){

            $sql = "INSERT INTO likes (username, id_car) VALUES ('$username','$id')";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }
    
        function delete_likes($id, $username){

            $sql = "DELETE FROM likes WHERE username='$username' AND id_car='$id'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }
    }
?>