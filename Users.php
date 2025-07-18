<?php
//inclure le fichier de connexion 
//require_once "session/SessionManager.php";
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
    public function register($nom,$prenom,$email,$password,$photo_profil){
            //securiser le password avec password_hash
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Requête préparée pour éviter les injections SQL
            $query = "INSERT INTO users(nom,prenom,email,password,photo_profil) 
                      VALUES(:nom,:prenom,:email,:password,:photo_profil)";
            //connexion a la base
            $dbConnexion = $this->db->getConnexion();
            //requette prépaeée
            $req = $dbConnexion->prepare($query);
            //lier les paramettres entre eux(paramettre nommé avec les valeurs récupérées)
            $req->bindParam(':nom', $nom);
            $req->bindParam(':prenom',$prenom);
            $req->bindParam(':email', $email);
            $req->bindParam(':password', $hashedPassword);
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
        $query = "SELECT id, password FROM users WHERE email = :email";
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
            return $user['id'];
        }
        return false;
        
    }

    //méthode de récupération de l'id de l'utilisateur
    public function getUserById($id){
        //requete sql 
        $query = "SELECT * FROM users WHERE id = :id";
        //connexion a la base
        $dbConnexion = $this->db->getConnexion();
        //preparer la requete
        $req = $dbConnexion->prepare($query);
        //lier les paramettres
        $req->bindParam(':id', $id);
        //executer la requete
        $req->execute();
        //recuperer et retourner dans tableau associatif
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //méthode de mise a jour du profil
    public function updateProfil($id,$nom,$prenom,$email,$photo_profil){
    //requete sql 
    $query = "UPDATE users SET nom=:nom,prenom=:prenom,email=:email,
                                photo_profil=:photo_profil WHERE id=:id";
    //connexiona la BDD
    $dbConnexion = $this->db->getConnexion();
    //requete préparée
    $req = $dbConnexion->prepare($query);
    //lier les paramettres
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom',$prenom);
    $req->bindParam(':email', $email);
    $req->bindParam(':photo_profil',$photo_profil);
    $req->bindParam(':id',$id);
    //executer la requette
    $req->execute();
     //retourne et vérifie le nombre de ligne inséréees
     return $req->rowCount() > 0;
                                       
    }

    //méthode de récupération des emails poue changer le profil
    public function getUserByEmailId($id,$email){
        //requete 
        $query = "SELECT * FROM users WHERE email = :email AND id != :id";
        //connexion 
        $dbConnexion = $this->db->getConnexion();
        //preparer la requete
        $req = $dbConnexion->prepare($query);
        //lier les parametter
        $req->bindParam('email',$email);
        $req->bindParam('id',$id);
        //executer la requete
        $req->execute();
        //retourner un tableau associatif
        return $req->fetch(PDO::FETCH_ASSOC);
        
    }

    public function getAllUsers(){
        // Définition de la requête SQL pour récupérer les utilisateurs
            $query = "SELECT * FROM users ORDER BY id DESC";   
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

        public function deleteUser($id){
            //requete sql
            $query = "DELETE FROM users WHERE id = :id";
            //connexion 
            $dbConnexion = $this->db->getConnexion();
            //preparation
            $req = $dbConnexion->prepare($query);
            //lier les parametters
            $req->bindParam(':id',$id);
            //executer
            $req->execute();
            //retourner le nombres de lignes
            return $req->rowCount() > 0;
        }

        function getTotalUsers(){
            $query = "SELECT COUNT(*) as total FROM users";
            $dbConnexion = $this->db->getConnexion();
            $req = $dbConnexion->prepare($query);
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);

            return $result['total'];
        }
        

}



?>