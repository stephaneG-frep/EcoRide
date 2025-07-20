<?php

require_once "db/Database.php";

class Avis{

    //gérer les connexion en base 
    private $db;
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }

    public function newAvis($commentaire,$etoile,$id,$id_avis){
        //requete sql
        $query = "INSERT INTO avis(commentaire,etoile,id,id_avis)
                  VALUES(:commentaire,:etoile,:id, :id_avis)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':commentaire',$commentaire);
        $req->bindParam(':etoile',$etoile);
        $req->bindParam(':id', $id);
        $req->bindParam(':id_avis',$id_avis);
        $req->execute();
        return $req->rowCount() > 0;

    }

    //récuperer les tous les commentaires
    public function getAllCommentaires(){
    // Requête pour récupérer toutes les annonces avec les infos des utilisateurs
    $query = "SELECT a.id_avis, a.commentaire, a.etoile,
            a.id as user_id, u.nom,u.prenom,u.email,u.photo_profil FROM avis a
            JOIN users u ON a.id = u.id ORDER BY a.id_avis DESC";
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

    function getTotalAvis(){
        $query = "SELECT COUNT(*) as total FROM avis";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }


}




?>