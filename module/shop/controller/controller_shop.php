<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "module/shop/model/DAO_shop.php");
    include ($path . "view/inc/JWT.php");
    include($path . "model/middleware_auth.php");
    if (isset($_SESSION["tiempo"])) {  
	    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
	}
    @session_start();

    switch($_GET['op']){

        case 'view';
            include("module/shop/view/shop.html");
            break;

        case 'list';
            try{
                $dao = new DAO_shop();
                $rdo = $dao -> select_all_cars($_GET['orderby'], $_POST['total_prod'], $_POST['items_page']);
                // $rdo = $dao -> select_all_products();
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
        
        case 'filters';

            try{
                $dao = new DAO_shop();
                $rdo = $dao -> select_filters();
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
                echo json_encode("error");
                exit;
            }else{
                echo json_encode($rdo);
            }
            break;

        case 'filters_search';

            try{
                $dao = new DAO_shop();
                $filters = json_decode($_GET['filters']);
                $query = $dao -> sql_filter($filters);
                $rdo = $dao -> filters($query, $_GET['orderby'], $_POST['total_prod'], $_POST['items_page']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
                echo json_encode($rdo);
                exit;
            }else{
                $dinfo = array();
                foreach ($rdo as $row) {
                    array_push($dinfo, $row);
                }
                echo json_encode($dinfo);
            }
            break; 
           
        case 'details';

            try{
                $dao = new DAO_shop();
                $rdo = $dao -> select_details($_GET['id']);
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

        case 'details_carousel';

            try{
                $dao = new DAO_shop();
                $car = $dao -> select_details($_GET['id']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            try{
                $dao_2 = new DAO_shop();
                $img = $dao_2 -> select_details_images($_GET['id']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            
            if(!$car || !$img){
                echo json_encode("error");
                exit;
            }else{
                $rdo = array();
                $rdo[0] = $car;
                $rdo[1][] = $img;
                echo json_encode($rdo);
            }
            break;

        case 'most_visit';

            try{
                $dao = new DAO_shop();
                $rdo = $dao -> update_view($_GET['id']);
            }catch (Exception $e){ 
                echo json_encode("error");
                exit;
            }
            break;
        
        case 'count';

            try{
                $dao = new DAO_shop();
                $rdo = $dao -> select_count();
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
        
        case 'count_filters';

            try{
                $dao = new DAO_shop();
                $filters = json_decode($_GET['filters']);
                $query = $dao -> sql_filter($filters);
                $rdo = $dao -> select_count_filters($query);
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
        
        case 'cars':

            try{
                $dao = new DAO_shop();
                $rdo = $dao -> select_cars($_GET['category'], $_GET['type'], $_GET['id'], $_POST['loaded'], $_POST['items']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
                echo json_encode($rdo);
                exit;
            }else{
                $dinfo = array();
                foreach ($rdo as $row) {
                    array_push($dinfo, $row);
                }
                echo json_encode($dinfo);
            }
            break;
        
        case 'load_likes'; 

            try{

                $decode = decode::decode_username();
                $dao = new DAO_shop();
                $rdo = $dao -> select_load_likes($decode);

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

        case 'control_likes';

            try{
                $decode = decode::decode_username();
                $dao = new DAO_shop();
                $rdo = $dao -> select_likes($_GET['id'], $decode);
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
                if(count($dinfo) === 0){
                    $dao = new DAO_shop();
                    $rdo = $dao -> insert_likes($_GET['id'], $decode);
                    echo json_encode("0");
                }else{
                    $dao = new DAO_shop();
                    $rdo = $dao -> delete_likes($_GET['id'], $decode);
                    echo json_encode("1");
                }
            }
            break;

        default;
            $callback = 'index.php?module=errors&op=404';
            die('<script>window.location.href="'.$callback .'";</script>');
            break;
    }