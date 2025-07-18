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
        
        $role = 'admin';
       
    }

    public function loginAdmin(){
        //requetev de selection
        $query = "SELECT a.id_admin, a.role, a.id as user_id, u.email, u.password
                  FROM admin a JOIN users u ON a.id_admin = u.id ";
        //connexion a la bdd 
        $dbConnexion = $this->db->getConnexion();
        //préparer la requete
        $req = $dbConnexion->prepare($query);
        //executer la requete
        $req->execute();
        //recuperer le resultat dans un tableau assoc
        $user = $req->fetch(PDO::FETCH_ASSOC);
        //vérifier le password 
        if($user && password_verify('u.password',$user['password'])){
            return $user['id'];
        }
        return false;
        
    }


    

}









?>