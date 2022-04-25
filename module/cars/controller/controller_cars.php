<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Ejercicios/MVC_Salva/';
    include($path . "module/cars/model/DAO_cars.php");
    if (isset($_SESSION["tiempo"])) {  
	    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
	}

switch($_GET['op']){
    case 'list';

        try{
            $dao_cars = new DAO_cars();
            $result = $dao_cars->list_all_cars();
        }catch (Exception $e){
            $callback = 'index.php?module=errors&op=503';
            die('<script>window.location.href="'.$callback .'";</script>');
        }
        
        if(!$result){
            $callback = 'index.php?module=errors&op=503&desc=List error';
            die('<script>window.location.href="'.$callback .'";</script>');
        }else{
            include("module/cars/view/list_cars.php");
        }
        break;

    case 'read';

        try{
            $dao_cars = new DAO_cars();
            $result = $dao_cars -> select_car($_GET['id']);
            $id = get_object_vars($result);
        }catch (Exception $e){
            $callback = 'index.php?module=errors&op=503';
            die('<script>window.location.href="'.$callback .'";</script>');
        }
        if(!$result){
            $callback = 'index.php?module=errors&op=503&desc=Read error';
            die('<script>window.location.href="'.$callback .'";</script>');
        }else{
            include("module/cars/view/read_cars.php");
        }
        break;

    case 'read_modal':

            // echo $_GET["id"]; 
            // exit;

            try{
                $dao_cars = new DAO_cars();
            	$rdo = $dao_cars -> select_car($_GET['id']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
    			echo json_encode("error");
                exit;
    		}else{
    		    $car = get_object_vars($rdo);
                echo json_encode($car);
                exit;
    		}
            break;

    case 'create';

        // $data = 'hola crtl user create';
        // die('<script>console.log('.json_encode( $data ) .');</script>');

        include("module/cars/model/validate.php");
        
        $check = true;
        
        if ($_POST){

            $check = validate();
            
            if ($check){
                $_SESSION['id']=$_POST;
                try{
                    $dao_cars = new DAO_cars();
                    $result = $dao_cars -> insert_car($_POST);
                }catch (Exception $e){
                    $callback = 'index.php?module=errors&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
                
                if($result){
                    echo '<script language="javascript">alert("Registrado en la base de datos correctamente")</script>';
                    $callback = 'index.php?module=cars&op=list';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }else{
                    $callback = 'index.php?module=errors&op=503&desc=Create error';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
            }
        }
        include("module/cars/view/create_cars.php");
        break;

    case 'update';
        
        $check = true;
        
        if ($_POST){
                
            if ($check){
                $_SESSION['id']=$_POST;
                try{
                    $dao_cars = new DAO_cars();
    		        $rdo = $dao_cars -> update_car($_POST, $_GET['id']);
                }catch (Exception $e){
                    $callback = 'index.php?module=errors&op=503';
        			die('<script>window.location.href="'.$callback .'";</script>');
                }
                    
		        if($rdo){
            		echo '<script language="javascript">alert("Actualizado en la base de datos correctamente")</script>';
            		$callback = 'index.php?module=cars&op=list';
        			die('<script>window.location.href="'.$callback .'";</script>');
            	}else{
            		$callback = 'index.php';
    			    die('<script>window.location.href="'. $callback .'";</script>');
            	}
            }
        }
            
        try{
            $dao_cars = new DAO_cars();
            $result = $dao_cars -> select_car($_GET['id']);
            $id = get_object_vars($result);
        }catch (Exception $e){
            $callback = 'index.php?module=errors&op=503';
			die('<script>window.location.href="'.$callback .'";</script>');
        }
            
        if(!$result){
    		$callback = 'index.php?module=errors&op=503&desc=Update error';
    		die('<script>window.location.href="'.$callback .'";</script>');
    	}else{
        	include("module/cars/view/update_cars.php");
    	}
        break;

    case 'delete';

        try{
            $dao_cars = new DAO_cars();
            $res = $dao_cars -> select_car($_GET['id']);
            $car = get_object_vars($res);
        }catch (Exception $e){
            $callback = 'index.php?module=errors&op=503';
            die('<script>window.location.href="'.$callback .'";</script>');
        }
        if(!$res){
            $callback = 'index.php?module=errors&op=503&desc=Delete error';
            die('<script>window.location.href="'.$callback .'";</script>');
        }else{
            if (isset($_POST['delete'])){
                try{
                    $dao_cars = new DAO_Cars();
                    $result = $dao_cars -> delete_cars($_GET['id']);
                }catch (Exception $e){
                    $callback = 'index.php?module=errors&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }

                if($result){
                    echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
                    $callback = 'index.php?module=cars&op=list';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }else{
                    $callback = 'index.php?module=errors&op=503&desc=Delete error';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
            }
            include("module/cars/view/delete_cars.php");
        }
        break;

    case 'delete_all';

        if ($_POST){
            try{
                $dao_cars = new DAO_Cars();
                $result = $dao_cars -> delete_all_cars();
            }catch (Exception $e){
                $callback = 'index.php?module=errors&op=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if($result){
                echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
                $callback = 'index.php?module=cars&op=list';
                die('<script>window.location.href="'.$callback .'";</script>');
            }else{
                $callback = 'index.php?module=errors&op=503&desc=Delete all error';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
        }
        
        include("Module/cars/view/delete_all_cars.php");
        break;

    case 'dummies';

        if (isset($_POST['dummies'])){
            try{
                $dao_cars = new DAO_Cars();
                $result = $dao_cars -> dummies_cars();
            }catch (Exception $e){
                $callback = 'index.php?module=errors&op=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }

            if($result){
                echo '<script language="javascript">alert("Lista de coches creada correctamente")</script>';
                $callback = 'index.php?module=cars&op=list';
                die('<script>window.location.href="'.$callback .'";</script>');
            }else{
                $callback = 'index.php?module=errors&op=503&desc=Dummies error';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
        }
        
        include("Module/cars/view/dummies_cars.php");
        break;

    default;
        $callback = 'index.php?module=errors&op=404';
        die('<script>window.location.href="'.$callback .'";</script>');
        break;
    }

?>