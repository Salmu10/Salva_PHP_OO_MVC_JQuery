<?php
    function validate_email($email){
        $dao = new DAO_login();
        if($dao -> select_email($email)){
            $check=false;
        }else {
            $check=true;
        }
        return $check;
    }
?>