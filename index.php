<?php

//inclure les fichiers nécessaire
require_once "include/head.php";
require_once "include/header.php";
require_once "db/config.php";
require_once "Users.php";

?>

    
   
        <h1>Bienvenue sur EcoRide <br> le site du covoiturage écolo</h1>

        <section class="item-1">
            <div class="item-1a">
                <img class="photo_profil" src="img/avatar_default.jpg" alt="photo de profil">   
            </div>
            <h4>Nom : <?php echo $user['firstname']; ?> </h4>
            <h4>Prénom : </h4>
            <h4>Email : </h4>
            <h4>Telephone : </h4>
        </section>
        <h2 class="h2">Ils donne leurs avis</h2>   
        <article class="item-2">                     
                <h4>Nom : </h4>
                <h4>Prénom : </h4>
                <p>Avis : lorem 20 lorem morem ipsum tralalal hitout uhgu bjb dfgh xcv  </p>
        </article>
 

<?php require_once "include/footer.php"; ?>