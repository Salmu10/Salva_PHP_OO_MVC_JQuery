<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "module/home/model/DAO_home.php");
    if (isset($_SESSION["tiempo"])) {  
	    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
	}

switch ($_GET['op']) {

    case 'home':
        include("module/home/view/home.html");
    break;

    case 'carrusel';

        // echo json_encode("Hola carrusel");

        try{
            $dao_home = new DAO_home();
            $rdo = $dao_home -> select_brand();
        }catch (Exception $e){
            echo json_encode("error");
            exit;
        }

        if(!$rdo){
            echo json_encode("error");
            exit;
        }else{
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }

        break;

    case 'category';

        try{
            $dao_home = new DAO_home();
            $rdo = $dao_home -> select_category();
        }catch (Exception $e){
            echo json_encode("error");
            exit;
        }

        if(!$rdo){
            echo json_encode("error");
            exit;
        }else{
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }

        break;

    case 'type';

        try{
            $dao_home = new DAO_home();
            $rdo = $dao_home -> select_type();
        }catch (Exception $e){
            echo json_encode("error");
            exit;
        }

        if(!$rdo){
            echo json_encode("error");
            exit;
        }else{
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }

        break;
    
    case 'register':
        $data = 'hola register';
        die('<script>console.log('.json_encode( $data ) .');</script>');
        break;

    default;
        $callback = 'index.php?module=errors&op=404';
        die('<script>window.location.href="'.$callback .'";</script>');
        break;
}