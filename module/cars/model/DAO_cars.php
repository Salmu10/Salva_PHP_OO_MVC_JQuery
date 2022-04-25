<?php
	$path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "model/connect.php");
    
    class DAO_cars{
        
        function list_all_cars(){
			$sql = "SELECT * FROM cars ORDER BY id ASC";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);

            return $res;
		}

        function select_car($id){
			$sql = "SELECT * FROM cars WHERE id='$id'";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
            connect::close($conexion);

            return $res;
		}

        function insert_car($datos){
			$extras="";
			$license_number = $datos['license_number'];
        	$brand = $datos['brand'];
        	$model = $datos['model'];
        	$car_plate = $datos['car_plate'];
        	$km = $datos['km'];
        	$type = $datos['type'];
			$comments=$datos['comments'];
			$discharge_date=$datos['discharge_date'];
        	$color=$datos['color'];
        	foreach ($datos['extras'] as $indice) {
        	    $extras = $extras."$indice:";
        	}     	

        	$sql = " INSERT INTO cars (license_number, brand, model, car_plate, km, type, comments, discharge_date, color, extras)"
        		. " VALUES ('$license_number', '$brand', '$model', '$car_plate', '$km', '$type', '$comments', '$discharge_date', '$color', '$extras')";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

			return $res;
		}

		function update_car($datos, $id) {
			$extras="";
			// $license_number = $datos['license_number'];
        	$brand = $datos['brand'];
        	$model = $datos['model'];
        	// $car_plate = $datos['car_plate'];
        	$km = $datos['km'];
        	$type = $datos['type'];
			$comments=$datos['comments'];
			$discharge_date=$datos['discharge_date'];
        	$color=$datos['color'];
        	foreach ($datos['extras'] as $indice) {
        	    $extras = $extras."$indice:";
        	}     	


        	$sql = "UPDATE cars SET brand='$brand', model='$model', km='$km', type='$type', comments='$comments', discharge_date='$discharge_date',"
			. "color='$color', extras='$extras' WHERE id='$id'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

			return $res;
		}

		function delete_cars($id){
			$sql = "DELETE FROM cars WHERE id='$id'";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
		}

        function delete_all_cars(){
			$sql = "DELETE FROM cars";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            return $res;
		}

		function dummies_cars(){

			$sql = "DELETE FROM cars;";

			$sql.= "INSERT INTO cars (license_number, brand, model, car_plate, km, type, comments, discharge_date, color, extras, car_image, price, doors)" 
			." VALUES ('1W2D50JIL04J3L5K1', 'BMW', 'I4', '4567DAB', '0', 'ET', 'Coche nuevo y automático', '15/01/2022', 'Red', 'Navegador', view/images/img_cars/mercedes_glc_coupe.jpg, '50000€', 4);";
			
			$sql.= "INSERT INTO cars (license_number, brand, model, car_plate, km, type, comments, discharge_date, color, extras, car_image, price, doors)" 
			." VALUES ('2OUD50JIL04J3L5G6', 'CP', 'Formentor', '7645JDH', '10000', 'GS', 'Coche nuevo y automático', '26/07/2019', 'Mate Blue', 'Navegador', view/images/img_cars/mercedes_glc_coupe.jpg, '32000€', 5);";

			$sql.= "INSERT INTO cars (license_number, brand, model, car_plate, km, type, comments, discharge_date, color, extras, car_image, price, doors)" 
			." VALUES ('8P9D50JIL04J3L1H7', 'FRD', 'Mustang', '6547LGM', '2000', 'ET', 'Coche nuevo y automático', '30/03/2019', 'Blue', 'Navegador', view/images/img_cars/mercedes_glc_coupe.jpg, '39000€', 5);";

			$sql.= "INSERT INTO cars (license_number, brand, model, car_plate, km, type, comments, discharge_date, color, extras, car_image, price, doors)" 
			." VALUES ('44GD50JIL04J3LH58', 'MCD', 'GLC Coupé', '9745DFM', '0', 'OT', 'Coche nuevo y automático', '26/07/2019', 'Mate grey', 'Navegador',  view/images/img_cars/mercedes_glc_coupe.jpg,'60000€', 5);";

			$sql.= "INSERT INTO cars (license_number, brand, model, car_plate, km, type, comments, discharge_date, color, car_image, extras, price, doors)" 
			." VALUES ('3J4750JIL04J3LKP4', 'AUD', 'A6', '2641FKL', '50000', 'HB', 'Coche nuevo y automático', '20/06/2017', 'White', 'Navegador', view/images/img_cars/mercedes_glc_coupe.jpg, '28000€', 4)";
			
			$conexion = connect::con();
            $res = mysqli_multi_query($conexion, $sql);
            connect::close($conexion);

            return $res;
		}
    }
?>