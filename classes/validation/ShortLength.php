<?php 
namespace ToDo\Classes\Validation ;

require_once "Validator.php";
use ToDo\Classes\Validation\Validator;

class ShortLength implements Validator{
    public function check($key , $value){
        if(strlen($value) < 3){
            return "The $key must be at least 3 char";
        }else{
            return false ; 
        }
    }
}