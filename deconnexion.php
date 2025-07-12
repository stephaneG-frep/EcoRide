<?php
require_once "Users.php";

session_start();
session_destroy();
header('location: connexion.php');
exit();

?>