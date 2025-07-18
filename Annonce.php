<?php


//inclure le fichier de connexion 

use Pcntl\QosClass;

require_once "db/Database.php";

//class annonce en liaison avec class users
class Annonce{

    //gérer les connexion en base 
    private $db;
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }

    public function newAnnonce($departement,$vehicule,$place,$tarif,$description,$id,$id_annonce){
        //requete sql
        $query = "INSERT INTO annonce(departement,vehicule,place,tarif,description,id,id_annonce)
                  VALUES(:departement,:vehicule,:place,:tarif,:description,:id,:id_annonce)";
        //connection
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':departement',$departement);
        $req->bindParam(':vehicule',$vehicule);
        $req->bindParam(':place',$place);
        $req->bindParam(':tarif',$tarif);
        $req->bindParam(':description',$description);
        $req->bindParam(':id',$id);
        $req->bindParam('id_annonce',$id_annonce);
        $req->execute();
        return $req->rowCount() > 0;
        
    }

    //récupérer les annonce par l'id de l'utilisateur
    public function getAnnonceByIdUser($id){
        // Définition de la requête SQL pour récupérer les annonces d'un utilisateur spécifique
            $query = "SELECT * FROM annonce WHERE id = :id";  
        // Obtention de la connexion à la base de données
            $dbConnexion = $this->db->getConnexion();    
        // Préparation de la requête SQL
            $req = $dbConnexion->prepare($query);
        // Liaison du paramètre :id dans la requête SQL avec la valeur fournie en argument
            $req->bindParam(':id', $id);    
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
        
        
        //récupérer les annonces par son id
        public function getAnnonceById($id_annonce){
            // Définition de la requête SQL pour récupérer une annonce par son identifiant
            $query = "SELECT * FROM annonce WHERE id_annonce = :id_annonce";   
            // Obtention de la connexion à la base de données
            $dbConnexion = $this->db->getConnexion();   
            // Préparation de la requête SQL
            $req = $dbConnexion->prepare($query);   
            // Liaison du paramètre :id_annonce dans la requête SQL avec la valeur fournie en argument
            $req->bindParam(':id_annonce', $id_annonce);   
            // Exécution de la requête SQL
            $req->execute();   
            // Récupération du résultat sous forme de tableau associatif
            $result = $req->fetch(PDO::FETCH_ASSOC);   
            // Retour du tableau associatif contenant les informations de la production
            return $result;
        }

        //supprimer l'annonce
        public function deleteAnnonce($id_annonce){
            $query = "DELETE FROM annonce WHERE id_annonce =:id_annonce";
            $dbConnexion = $this->db->getConnexion();
            $req = $dbConnexion->prepare($query);
            $req->bindParam(':id_annonce', $id_annonce);
            $req->execute();
    
            return $req->rowCount() >0;
        }
    
    
        //récuperer les toutes annonces 
        public function getAllAnnonces(){
            /*
        // Définition de la requête SQL pour récupérer les annonces d'un utilisateur spécifique
            $query = "SELECT a.id_annonce,a.departement,a.vehicule,a.place,a.tarif,a.description
                     a.id as user_id,u.nom,u.prenom,u.email,u.password,u.photo_profil FROM annonce a
                     JOIN users u ON a.id = u.id ";   

            */
            // Requête pour récupérer toutes les annonces avec les infos des utilisateurs
            $query = "SELECT a.id_annonce, a.departement, a.vehicule, a.place, a.tarif, a.description,
                     a.id as user_id, u.nom,u.prenom,u.email,u.photo_profil FROM annonce a
                     JOIN users u ON a.id = u.id ORDER BY a.id_annonce DESC";


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

        public function getAnnonceByDepartement($departement){
           
            $query = "SELECT a.id_annonce, a.departement, a.vehicule, a.place, a.tarif, a.description,
                        u.nom, u.prenom, u.email, u.photo_profil FROM annonce a
                       JOIN users u ON a.id = u.id WHERE a.departement LIKE :departement
                       ORDER BY a.id_annonce DESC";
            
            $dbConnexion = $this->db->getConnexion();
            $req = $dbConnexion->prepare($query);
            $req->bindValue(':departement', '%'.$departement.'%', PDO::PARAM_STR);
            $req->execute();
            $resultats = array();
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            }

            return $resultats;
            
        }
         

    
    
}







?>