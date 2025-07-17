<?php
require_once "./db/Database.php";
require_once "database_admin.php";
require_once "Admin.php";


//$db = getInstance();
$admin = new Admin($db);

// Routing simple
/*
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $admin->deleteAnnonce($id_annonce);
} else {
    $admin->dashboard();
}
*/
// Vérification basique de sécurité (à adapter)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin-login.php');
    exit();
}

// Connexion DB et récupération des données

$admin = new Admin($db);

$annonces = $admin->getAllAnnonces();
$users = $admin->getAllUsers();
$countAnnonces = $admin->countAnnonces();
$countUsers = $admin->countUsers();

// Affichage
require_once "layouts_admin.php";