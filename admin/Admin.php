<?php

require_once "./db/Database.php";

class Admin {
     //gérer les connexion en base 
    private $db;
    private $model;
     //constructeur pour inicier la connexion
     public function __construct(){
         //appel a la méethode getInstance
         $this->db = Database::getInstance();
         $this->model = new Admin();
         $this->checkAdmin();

    }

    function getAdminDBConnection() {
        try {
            $db = new PDO(
                'mysql:host=localhost;dbname=ecoride;charset=utf8', 
                'admin_user',  // Utiliser un utilisateur dédié admin
                'StrongAdminPassword123',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            return $db;
        } catch (PDOException $e) {
            error_log('Admin DB Error: ' . $e->getMessage());
            die('Erreur de connexion administrateur');
        }
    }
    
    
    private function checkAdmin() {
        session_start();
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: admin-login.php');
            exit();
        }
    }

    public function dashboard() {
        $page = $_GET['page'] ?? 1;
        $annonces = $this->model->getAllAnnonces($page);
        $totalAnnonces = $this->model->countAnnonces();
        $users = $this->model->getAllUsers();
        
        require_once __DIR__.'/../views/layouts/admin.php';
    }

    // Récupère toutes les annonces avec pagination
    public function getAllAnnonces($page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        
        $query = "SELECT a.*, u.nom, u.prenom 
                 FROM annonces a
                 JOIN users u ON a.id = u.id
                 LIMIT :offset, :perPage";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindValue(':offset', $offset, PDO::PARAM_INT);
        $req->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $req->execute();
        
        return $req->fetchAll();
    }

    // Compte le nombre total d'annonces
    public function countAnnonces() {
        $query = "SELECT COUNT(*) FROM annonce";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        return $req->fetchColumn();
    }

    // Compteur d'utilisateurs
    public function countUsers() {
        $query = "SELECT COUNT(*) FROM users";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        return $req->fetchColumn();
    }

    // Récupère tous les utilisateurs
    public function getAllUsers(){
        // Définition de la requête SQL pour récupérer les utilisateurs
            $query = "SELECT * FROM users ORDER BY id DESC";   
        // Obtention de la connexion à la base de données
            $dbConnexion = $this->db->getConnexion();    
        // Préparation de la requête SQL
            $req = $dbConnexion->prepare($query);    
        // Exécution de la requête SQL
            $req->execute();    
        // Initialisation d'un tableau pour stocker les résultats de la requête
            $resultats = array();   
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            }    
        // Retour du tableau contenant tous les résultats
            return $resultats;
        }

    // Supprime une annonce
    //supprimer l'annonce
    public function deleteAnnonce($id_annonce){
        $query = "DELETE FROM annonce WHERE id_annonce =:id_annonce";
        $req = $this->db->getConnexion()->prepare($query);
        $req->bindParam(':id_annonce', $id_annonce);
        $req->execute();
        return $req->rowCount() >0;
    }

    public function deleteUser($id){
        //requete sql
        $query = "DELETE FROM users WHERE id = :id";
        //connexion 
        $dbConnexion = $this->db->getConnexion();
        //preparation
        $req = $dbConnexion->prepare($query);
        //lier les parametters
        $req->bindParam(':id',$id);
        //executer
        $req->execute();
        //retourner le nombres de lignes
        return $req->rowCount() > 0;
    }
}