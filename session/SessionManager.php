<?php

require_once "Users.php";
require_once "db/Database.php";

class SessionManager{

    public static function startSession(){
        session_start();
    }
    public static function setUser($user){
        $_SESSION['user'] = $user;
    }
    public static function getUser(){
        return $_SESSION['user'] ?? null;
    }
    public static function destroySession(){
        session_destroy();
    }
}


?>