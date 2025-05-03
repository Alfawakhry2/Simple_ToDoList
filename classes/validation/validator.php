<?php 
namespace ToDo\Classes\Validation;

interface Validator{
    public function check($key , $value);
}