<?php

require_once "db/Database.php";


class Admin {

    //gérer les connexion en base 
    private $db;
    
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }

    public function getAdminByIdUsers($id){
        
        $query = "SELECT * FROM admin WHERE id = :id";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id',$id);
        $req->execute();
    
        $resultats = array();    
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            }    
        // Retour du tableau contenant tous les résultats
            return $resultats;
       
    }

    //récupérer les annonces par son id
    public function getAdminById($id_admin){
        // Définition de la requête SQL pour récupérer une annonce par son identifiant
        $query = "SELECT * FROM admin WHERE id_admin = :id_admin";   
        // Obtention de la connexion à la base de données
        $dbConnexion = $this->db->getConnexion();   
        // Préparation de la requête SQL
        $req = $dbConnexion->prepare($query);   
        // Liaison du paramètre :id_annonce dans la requête SQL avec la valeur fournie en argument
        $req->bindParam(':id_admin', $id_admin);   
        // Exécution de la requête SQL
        $req->execute();   
        // Récupération du résultat sous forme de tableau associatif
        $result = $req->fetch(PDO::FETCH_ASSOC);   
        // Retour du tableau associatif contenant les informations de la production
        return $result;
    }

    public function getAllAdmin(){
        // Définition de la requête SQL pour récupérer les utilisateurs
            $query = "SELECT * FROM admin ORDER BY id_admin DESC";   
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


    public function loginAdmin(){
        //requetev de selection

        if($_SESSION['id']){
        $query = "SELECT a.id_admin, a.role, a.id as user_id, u.email, u.password,
                  FROM admin a JOIN users u ON a.id_admin = u.id ";
        //connexion a la bdd 
        $dbConnexion = $this->db->getConnexion();
        //préparer la requete
        $req = $dbConnexion->prepare($query);
        //executer la requete
        $req->execute($_SESSION['id']);
        //recuperer le resultat dans un tableau assoc
        $user = $req->fetch();
        switch($user['role']){
            case 0:
                $role = 'utilisateur';
        break;
            case 1:
                $role = 'admin';
        break;
        }
        
        }
        return false;
        
    }




    

}









?>