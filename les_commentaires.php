<?php
error_reporting(-1);
ini_set("display_errors", 1);
//session_start();
//inclure les fichiers nécessaire

require_once "Users.php";
require_once "Avis.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";


//instancier la methode getAllCommentaires
$commentaire = new Avis();
$commentaires = $commentaire->getAllCommentaires();
// Instanciation du gestionnaire  des utilisateurs


?>
<div class="content">

        <div class="annonces-list">
            <?php foreach ($commentaires as $commentaire): ?>
                <div class="annonce-card">
                    <div class="annonce-header">
                        <img src="img/photo_profil/?=$commentaire['photo_profil'] ?>" alt="Photo de profil" class="user-photo">
                        <div class="user-info">
                            <h3><?= htmlspecialchars($commentaire['prenom'] . ' ' . $commentaire['nom']) ?></h3>
                            <h3><?=$commentaire['email']?></h3>
                        </div>
                    </div>
                    
                    <div class="annonce-details">
                        <span class="departement"><?= htmlspecialchars($commentaire['etoile']) ?> Etoiles</span>
                        
                        <p class="description"><?= $commentaire['commentaire'];?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>

<?php require_once "include/footer.php"; ?>

