<?php
session_start();
require_once 'db/config.php';
require_once "Users.php";
require_once "Annonce.php";

// Vérifier l'id
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}
if(isset($_GET['id_annonce'])){

    // Récupère l'ID de l'annonce à partir des paramètres de l'URL
    $id_annonce = $_GET['id_annonce'];
    //instancier le gestionnaire d'annonce
    $newAnnonce = new Annonce();
    //récuppérer l'annonce par l'id
    $result = $newAnnonce->getAnnonceById($id_annonce);

    try {
        //supprimer l'annonce
        $annonce = new Annonce();
        $annonce_delete = $annonce->deleteAnnonce($id_annonce);
        
        $_SESSION['flash_success'] = 'Annonce supprimée avec succès';
    } catch (PDOException $e) {
        // Annuler en cas d'erreur
        $db->rollBack();
        $_SESSION['flash_error'] = 'Erreur lors de la suppression : ' . $e->getMessage();
    }
    
    header('Location: connexion.php');
    exit();
}

header('Location: connexion.php');
exit();