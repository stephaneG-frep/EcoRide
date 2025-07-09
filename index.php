<?php

//inclure les fichiers nécessaire
require_once "include/head.php";
require_once "include/header.php";
require_once "db/config.php";
require_once "Users.php";

?>

    
   
        <h1>Bienvenue sur EcoRide le site du covoiturage écolo</h1>

        <section class="item-1">
            <div class="item-1a">
                <img src="<?php echo $id_user['photo_profil']; ?>" alt="photo de profil">
            </div>
            <h4>Nom : <?php echo $user['firstname']; ?> </h4>
            <h4>Prénom : </h4>
            <h4>Email : </h4>
            <h4>Telephone : </h4>
        </section>
 

<?php require_once "include/footer.php"; ?>