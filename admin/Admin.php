<?php

require_once "../db/Database.php";
require_once "database_admin.php";


class Admin {
     //gérer les connexion en base 
    private $db;
   
     //constructeur pour inicier la connexion
     public function __construct(){
         //appel a la méethode getInstance
         try {
            $this->db = new PDO(
                "mysql:host=localhost;dbname=ecoride", 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
        
 
     }

     public function getDBConnection($username){
     $stmt = $this->db->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
     $stmt->bindParam(':username',$username);
     $stmt->execute([$username]);
     return $stmt->fetch();
    }

    private function checkAdmin() {
        session_start();
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: admin-login.php');
            exit();
        }
    }


    // Récupère toutes les annonces avec pagination
    public function getAllAnnonces($page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        
        $query = "SELECT a.*, u.nom, u.prenom 
                 FROM annonces a
                 JOIN users u ON a.id = u.id
                 LIMIT :offset, :perPage";
        $dbConnexion = $this->db;
        $req = $dbConnexion->prepare($query);
        $req->bindValue(':offset', $offset, PDO::PARAM_INT);
        $req->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $req->execute();
        
        return $req->fetchAll();
    }

    // Compte le nombre total d'annonces
    public function countAnnonces() {
        $query = "SELECT COUNT(*) FROM annonce";
        $dbConnexion = $this->db;
        $req = $dbConnexion->prepare($query);
        $req->execute();
        return $req->fetchColumn();
    }

    // Compteur d'utilisateurs
    public function countUsers() {
        $query = "SELECT COUNT(*) FROM users";
        $dbConnexion = $this->db;
        $req = $dbConnexion->prepare($query);
        $req->execute();
        return $req->fetchColumn();
    }

    // Récupère tous les utilisateurs
    public function getAllUsers(){
        // Définition de la requête SQL pour récupérer les utilisateurs
            $query = "SELECT * FROM users ORDER BY id DESC";   
        // Obtention de la connexion à la base de données
            $dbConnexion = $this->db;    
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
        $req = $this->db->prepare($query);
        $req->bindParam(':id_annonce', $id_annonce);
        $req->execute();
        return $req->rowCount() >0;
    }

    public function deleteUser($id){
        //requete sql
        $query = "DELETE FROM users WHERE id = :id";
        //connexion 
        $dbConnexion = $this->db;
        //preparation
        $req = $dbConnexion->prepare($query);
        //lier les parametters
        $req->bindParam(':id',$id);
        //executer
        $req->execute();
        //retourner le nombres de lignes
        return $req->rowCount() > 0;
    }
/*
    public function dashboard() {
        $page = $_GET['page'] ?? 1;
        $annonces = $this->db->getAllAnnonces($page);
        $totalAnnonces = $this->db->countAnnonces();
        $users = $this->db->getAllUsers();
        
        require_once 'layout_admin.php';
    }
*/
}