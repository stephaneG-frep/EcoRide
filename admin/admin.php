<?php
require_once "./db/Database.php";
require_once "Admin.php";


$db = getAdminDBConnection();
$controller = new Admin($db);

// Routing simple
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $controller->deleteAnnonce();
} else {
    $controller->dashboard();
}

// Vérification basique de sécurité (à adapter)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin-login.php');
    exit();
}

// Connexion DB et récupération des données

$model = new Admin();

$annonces = $model->getAllAnnonces();
$users = $model->getAllUsers();
$countAnnonces = $model->countAnnonces();
$countUsers = $model->countUsers();

// Affichage
require_once "layouts_admin.php";