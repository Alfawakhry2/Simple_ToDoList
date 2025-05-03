<?php

namespace ToDo\Classes\Validation;

require_once "Validator.php";

use ToDo\Classes\Validation\Validator;


class Required implements Validator
{
    public function check($key, $value)
    {
        if (empty($value)) {
            return "The $key is Required ";
        } else {
            return false;
        }
    }
}
