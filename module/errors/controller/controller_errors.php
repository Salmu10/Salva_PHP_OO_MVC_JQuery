<?php
include_once("module/errors/model/DAO_errors.php");
if (isset($_SESSION["tiempo"])) {  
    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
}

switch($_GET['op']){

    case 'errors_log';

        try{
            $dao_errors = new DAO_errors();
            $result = $dao_errors->errors_log();
        }catch (Exception $e){
            $callback = 'index.php?module=errors&op=503';
            die('<script>window.location.href="'.$callback .'";</script>');
        }
        
        if(!$result){
            $callback = 'index.php?module=errors&op=503&desc=Errors log error';
            die('<script>window.location.href="'.$callback .'";</script>');
        }else{
            include("module/errors/view/errors_log.php");
        }
        break;

    case '503';

        $dao_errors = new DAO_errors();
        $result = $dao_errors -> insert_log($_GET['desc']);

        include("module/errors/view/503.php");

        break;

    case '404';

        include("module/errors/view/404.php");

        break;

    case 'delete_errors_log';

        if ($_POST){
            try{
                $dao_errors = new DAO_errors();
                $result = $dao_errors -> delete_errors_log();
            }catch (Exception $e){
                $callback = 'index.php?module=errors&op=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if($result){
                echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
                $callback = 'index.php?module=errors&op=errors_log';
                die('<script>window.location.href="'.$callback .'";</script>');
            }else{
                $callback = 'index.php?module=errors&op=503&desc=Delete errors log error';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
        }
        
        include("Module/errors/view/delete_errors_log.php");
        break;

    default;

        include("module/errors/view/404.php");
        
        break;
    }

?>