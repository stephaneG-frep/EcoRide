<?php

use PDO;
use Database;

//inclure le fichier de connexion 
require_once "db/Database.php";
// class pour gérer les utilisateurs
class Users{

    //gérer les connexion en base 
    private $db;
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }


    // methode pour enregister en base
    public function register($firstname,$lastname,$email,$password,$tel,$photo_profil){
            //securiser le password avec password_hash
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Requête préparée pour éviter les injections SQL
            $query = "INSERT INTO users(firstname,lastname,email,password,tel,photo_profil) 
                      VALUES (:firstname,:lastname,:email,:password,:tel,:photo_profil)";
            //connexion a la base
            $dbConnexion = $this->db->getConnexion();
            //requette prépaeée
            $req = $dbConnexion->prepare($query);
            //lier les paramettres entre eux(paramettre nommé avec les valeurs récupérées)
            $req->bindParam(':firstname', $firstname);
            $req->bindParam(':lastname',$lastname);
            $req->bindParam(':email', $email);
            $req->bindParam(':password', $hashedPassword);
            $req->bindParam(':tel', $tel);
            $req->bindParam(':photo_profil',$photo_profil);
            //executer la requette
            $req->execute();
            //retourne et vérifie le nombre de ligne inséréees
            return $req->rowCount() > 0;
                   
    }

    //methode de vérification d'existance d'email 
    public function getUserByEmail($email) {
        $query = 'SELECT id FROM users WHERE email = :email';
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':email', $email);
        $req->execute();
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //méthode de connexion 
    public function login($email,$password){
        //requetev de selection
        $query = "SELECT id_user, password FRON users WHERE email = :email";
        //connexion a la bdd 
        $dbConnexion = $this->db->getConnexion();
        //préparer la requete
        $req = $dbConnexion->prepare($query);
        //lier les paramettres
        $req->bindParam(':email',$email);
        //executer la requete
        $req->execute();
        //recuperer le resultat dans un tableau assoc
        $user = $req->fetch(PDO::FETCH_ASSOC);
        //vérifier le password 
        if($user && password_verify($password,$user['password'])){
            return $user['id_user'];
        }
        return false;
    }

    //méthode de récupération de l'id de l'utilisateur
    public function getUserById($id_user){
        //requete sql 
        $query = "SELECT * FROM users WHERE id_user = :id_user";
        //connexion a la base
        $dbConnexion = $this->db->getConnexion();
        //preparer la requete
        $req = $dbConnexion->prepare($query);
        //lier les paramettres
        $req->bindParam(':id_user',$id_user);
        //executer la requete
        $req->execute();
        //recuperer et retourner dans tableau associatif
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //méthode de mise a jour du profil
    public function update_profil($id_user,$firstname,$lastname,$email,$tel,$photo_profil){
    //requete sql 
    $query = "UPDATE users SET firstname=:firstname,lastname=:lastname,email=:email,tel=:tel,
                                photo_profil=:photo_profil WHERE id_user=:id_user";
    //connexiona la BDD
    $dbConnexion = $this->db->getConnexion();
    //requete préparée
    $req = $dbConnexion->prepare($query);
    //lier les paramettres
    $req->bindParam(':firstname', $firstname);
    $req->bindParam(':lastname',$lastname);
    $req->bindParam(':email', $email);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':photo_profil',$photo_profil);
    //executer la requette
    $req->execute();
     //retourne et vérifie le nombre de ligne inséréees
     return $req->rowCount() > 0;
                                       
    }

}



?>