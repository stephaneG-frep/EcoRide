<?php


//inclure le fichier de connexion 
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

    public function newAnnonce($departement,$vehicule,$place,$tarif,$description){
        //requete sql
        $query = "INSERT INTO annonce(departement,vehicule,place,tarif,description)
                  VALUE(:departement,:vehicule,:place,:tarif,:description)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':departement',$departement);
        $req->bindParam(':vehicule',$vehicule);
        $req->bindParam(':place',$place);
        $req->bindParam(':tarif',$tarif);
        $req->bindParam(':description',$description);
        $req->execute();
        
    }
}







?>