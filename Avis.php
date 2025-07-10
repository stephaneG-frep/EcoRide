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

    public function newAvis($avis,$etoile){
        //requete sql
        $query = "INSERT INTO annonce(avis,etoile)
                  VALUE(:avis,:etoile)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':avis',$avis);
        $req->bindParam(':etoile',$etoile);
        $req->execute();
        
    }

}




?>