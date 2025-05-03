<?php 
namespace ToDo\Classes\Validation ;

require_once "Validator.php";
use ToDo\Classes\Validation\Validator;

class Str implements Validator{
    public function check($key , $value){
        if(is_numeric($value)){
            return "The $key must be String ";
        }else{
            return false ; 
        }
    }
}