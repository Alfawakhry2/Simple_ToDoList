<?php 
namespace ToDo\Classes; 
class Session {

    //start the session
    public function __construct()
    {
        session_start();   
    }


    // set the session value 
    public function set($key , $value){
        $_SESSION[$key] = $value ;
    }

    //get the session value
    public function getValue($key){
        return (isset($_SESSION[$key]))? $_SESSION[$key] : "User Not found !" ;
    }

    //isset session ?
    public function checkSession($key){
        return isset($_SESSION[$key]);
    }
    //empty the session 
    public function emptySession($key){
        unset($_SESSION[$key]);

        //empty the whole data 
        // session_unset();
    }

    //destroy the session
public function destroy(){
    session_destroy();
}
}