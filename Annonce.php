<?php
use PDO;
use Database;

//inclure le fichier de connexion 
require_once "db/Database.php";

//class annonce en liaison avec class users
class Annonce extends Users{

    //gérer les connexion en base 
    private $db;
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }
}







?>