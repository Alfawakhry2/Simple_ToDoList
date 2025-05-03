<?php
require_once "classes/requests.php";
require_once "classes/session.php";
// require_once "classes/Validation/Required.php";
// require_once "classes/Validation/Str.php";
require_once "classes/Validation/Validation.php";

use ToDo\Classes\Session;
use ToDOList\Classes\Requests;
// use ToDo\Classes\Validation\Required;
// use ToDo\Classes\Validation\Str;
use ToDo\Classes\Validation\Validation;


$session = new Session;
$request = new Requests;
// $required = new Required ; 
// $str = new Str; 
$validation = new Validation;



