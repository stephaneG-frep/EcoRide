<?php

//création de la classe pour la connexion a la base
class Database {
    //création d'attribut static et private pour limiter l'utilisation
    private static $instance;
    private $connexion;

    //constructeur private pour limiter l'acces en dehors de la classe
    //avec paramettre de connexion
    private function __construct($host,$username,$password,$database){
        //rty catch pour gérer les erreurs
        try{
            //classe PDO instancier l'objet avec les paramettres du constructeur
            $this->connexion = new PDO("mysql:host = $host; dbname=$database",$username,$password);
            //methode setAttribute pour la gestion des erreurs
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Erreur de connexion a la base de donnée: ".$e->getMessage());
        }
    }

    //création d'une methode de classe et public pour instancier la classe database
    public static function getInstance(){
        //si il n'y a pas instance
        if(!self::$instance){
            //requérire le fichier de config.php
            require_once "config.php";
            //acceeder a l'attribut $instance avec self::
            //création d'une instance de connexion
            self::$instance = new Database(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
        }
        return self::$instance;
    }

    //méthode plublic de connexion
    public function getConnexion(){
        //retourne l'objet connexion
        return $this->connexion;
    }
    







}


?>