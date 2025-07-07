<?php


require_once "Database.php";
// class pour gérer les utilisateurs
class Users{

    //gérer les connexion en base 
    private $db;
    private $table = "users";

    public function __construct(){
        $database = new Database();
        $this->db = $database->connect();
    }

    //methode de vérification d'existance d'email 
    private function emailExists($email) {
        $query = 'SELECT id FROM ' . $this->table . ' WHERE email = :email LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }


    // methode pour enregister en base
    public function register($username,$email,$password,$tel,$departement,
                             $vehicule,$place,$tarif,$description,$photo_profil) {
        // Validation des entrées
        if(empty($username) || empty($email) || empty($password) || empty($tel) || empty($departement)
                    || empty($vehicule) || empty($place) || empty($tarif) || empty($descriptin)){
            return ['status' => 'error', 'message' => 'Tous les champs sont obligatoires'];
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['status' => 'error', 'message' => 'Email invalide'];
        }

        if(strlen($password) < 8) {
            return ['status' => 'error', 'message' => 'Le mot de passe doit faire au moins 8 caractères'];
        }
        if(ctype_digit($tel)){
            return ['status'=>'error','message'=>'vérifier le numéro de téléphone'];
        }

        // Vérifier si l'email existe déjà
        if ($this->emailExists($email)) {
            return ['status' => 'error', 'message' => 'Cet email est déjà utilisé'];
        }

        try {
            // Hachage sécurisé du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Requête préparée pour éviter les injections SQL
            $query = 'INSERT INTO ' . $this->table . ' 
                    (username,email,password,tel,departement,vehicule
                    ,place,tarif,description,photo_profil) 
                    VALUES (:username,:email,:password,:tel,:departement,:vehicule,
                    :place,:tarif,:description,:photo_profil)';
            
            $req = $this->db->prepare($query);
            $req->bindParam(':username', $username);
            $req->bindParam(':email', $email);
            $req->bindParam(':password', $hashedPassword);
            $req->bindParam(':tel', $tel);
            $req->bindParam(':departement', $departement);
            $req->bindParam(':vehicule', $vehicule);
            $req->bindParam(':place', $place);
            $req->bindParam(':tarif', $tarif);
            $req->bindParam(':description', $description);


            if ($req->execute()) {
                return ['status' => 'success', 'message' => 'Inscription réussie!'];
            } else {
                return ['status' => 'error', 'message' => 'Erreur lors de l\'inscription'];
            }
        } catch (PDOException $e) {
            error_log('Erreur inscription: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Erreur technique'];
        }
    }

}



?>