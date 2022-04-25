<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "module/search/model/DAO_search.php");

    switch($_GET['op']){

        case 'car_type':
            // echo json_encode("error");
            // exit;

            try{
                $dao = new DAO_search();
                $rdo = $dao -> select_car_type();
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

        case 'car_brand':

            try{
                $dao = new DAO_search();
                if(empty($_POST['car_type'])){
                    $rdo = $dao->select_car_brand();
                }else{
                    $rdo = $dao->select_car_type_brand($_POST['car_type']);
                }
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

        case 'autocomplete':

            try{
                $dao = new DAO_search();
                if (!empty($_POST['car_type']) && empty($_POST['car_brand'])){
                    $rdo = $dao->select_auto_car_type($_POST['complete'], $_POST['car_type']);
                }else if(!empty($_POST['car_type']) && !empty($_POST['car_brand'])){
                    $rdo = $dao->select_auto_car_type_brand($_POST['complete'], $_POST['car_type'], $_POST['car_brand']);
                }else if(empty($_POST['car_type']) && !empty($_POST['car_brand'])){
                    $rdo = $dao->select_auto_car_brand($_POST['car_brand'], $_POST['complete']);
                }else {
                    $rdo = $dao->select_auto($_POST['complete']);
                }
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
        
        default:
            $callback = 'index.php?module=errors&op=404';
            die('<script>window.location.href="'.$callback .'";</script>');
            break;
    }

?>