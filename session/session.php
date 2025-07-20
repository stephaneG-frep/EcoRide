<?php

session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => 'localhost',
    //'secure' => true,
    'httponly' => true
]);

session_start();

function adminOnly()
{
    if (!isset($_SESSION['id'])) {
         header("location: ../login.php");
    } else if ($_SESSION['id']['role'] != 'admin') {
        header("location: ../index.php");
    }
    
}