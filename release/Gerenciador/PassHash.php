<?php
 
// não faz sentido existir essa classe
// não esta sendo utilizada


class PassHash {
 
    public static function check_password($pwd_bd, $password) {
       
        $new_hash = base64_encode($password);
        return ($pwd_bd == $new_hash);
    }
 
}
 
?>