<?php
    include("Model/connect.php");
    
    class DAO_errors{

        function errors_log(){
			$sql = "SELECT * FROM errors ORDER BY date ASC";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);

            return $res;
		}
        
        function insert_log($desc){
			$sql = "INSERT INTO errors (type, date) VALUES ('$desc', CURRENT_DATE)";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);

            return $res;
		}

        function delete_errors_log(){
			$sql = "DELETE FROM errors";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            return $res;
		}
    }
?>