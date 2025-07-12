<?php
/**
 * Configuration de la connexion à la base de données
 * Utilisation de PDO pour une meilleure sécurité
 */
class Database {
    private $host = 'localhost';
    private $db_name = 'ecoride';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Méthode pour établir la connexion
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, 
                $this->password
            );
            // Configurer PDO pour qu'il lance des exceptions en cas d'erreur
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Forcer l'encodage UTF-8
            $this->conn->exec('SET NAMES utf8');
        } catch(PDOException $e) {
            // En production, ne pas afficher le message d'erreur directement
            error_log('Erreur de connexion: ' . $e->getMessage());
            throw new Exception('Erreur de connexion à la base de données');
        }

        return $this->conn;
    }
}
?>
