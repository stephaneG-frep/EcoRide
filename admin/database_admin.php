<?php
function getDBConnection() {
    try {
        $db = new PDO(
            "mysql:host=localhost;dbname=ecoride", 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

