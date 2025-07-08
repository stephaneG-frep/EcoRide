<?php

require_once "db/config.php";
session_start();
session_destroy();
header('location: connexion.php');
exit();

?>