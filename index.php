<?php
session_start();
//inclure les fichiers nécessaire

require_once "Users.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";


//require_once "db/config.php";




?>

        <?php if(isset($message)) echo "<p>".$message."</p>";?>
   
        <h1>Bienvenue sur EcoRide <br> le site du covoiturage écolo</h1>

        <section class="item-1">
            <div class="item-1a">
                <img class="photo_profil" src="/img/?=$users['photo_profil']?>" alt="photo de profil">   
            </div>
            <h4>Nom : <?=$users['nom']?> </h4>
            <h4>Prénom :<?=$users['prenom']?> </h4>
            <h4>Email : </h4>
        </section>
        <h2 class="h2">Ils donne leurs avis</h2>   
        <article class="item-2">                     
                <h4>Nom : </h4>
                <h4>Prénom : </h4>
                <p>Avis : lorem 20 lorem morem ipsum tralalal hitout uhgu bjb dfgh xcv  </p>
        </article>
 

<?php require_once "include/footer.php"; ?>