<?php

require_once "db/Database.php";


class Admin{

    //gérer les connexion en base 
    private $db;
    public $role = "";
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }

    public function getUserAdmin(){
        
        $query = "SELECT * FROM users WHERE id = ?";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute([$_SESSION['id']]);
        //$req_user = $req->fetch();
        $role = $req->fetch();
        switch($role['role']){
            case 0:
                $role = 'utilisateur';
        break;
            case 1:
                $role = 'admin';
        break;
            case 2:
                $role = 'moderateur';
        break;
        }
    }

    

}









?>