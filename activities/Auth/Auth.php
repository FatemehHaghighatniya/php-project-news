<?php 
namespace Auth;
use BadFunctionCallException;
class Auth{
    

protected function redirect($url){
    header('Location: ' . trim(CURRENT_DOMAIN,'/ ') .'/'. trim($url,'/ '));
    exit;
}

protected function redirectBack(){
    header('Locatin: ' . $_SERVER['HTTM_REFERER']);
    exit;
}


private function hassh($password){

$hashPassword=password_hash($password,PASSWORD_DEFAULT)

}
}