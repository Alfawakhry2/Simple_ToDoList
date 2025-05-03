<?php
namespace ToDo\Classes\Validation ;

require_once "Required.php";
require_once "Str.php";
require_once "ShortLength.php";

class Validation{
    private $errors = [];
    //classes that will come from check functions in theses class and you dont know what the class will come 
    public function validate($key , $value ,$checks){
        foreach($checks as $check){
            $check = "ToDo\Classes\Validation\\".$check;
            $object = new $check ;
            $result = $object->check($key,$value) ;
            if($result!=false){
                $this->errors [] = $result ;
            }
        }
    }

    public function getErrors(){
        return $this->errors;
    }
}