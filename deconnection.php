<?php
require_once "session.php";

session_destroy();
unset($_SESSION);

header('location: connexion.php');