<?php
error_reporting(-1);
ini_set("display_errors", 1);
//session_start();
//inclure les fichiers nécessaire

require_once "Users.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";

// Instanciation du gestionnaire de productions
$allUsers = new Users();

// Récupération des productions de l'artiste
$users = $allUsers->getAllUsers();

?>

        <?php if(isset($message)) echo "<p>".$message."</p>";?>
   
        <h1>Bienvenue sur EcoRide <br> le site du covoiturage écolo</h1>

    <?php 
    if(isset($_SESSION['id'])){
       
    echo '
        <section class="item-1">';
        foreach ($users as $user) {   
            // Instanciation du gestionnaire d'utilisateurs pour obtenir son nom prenom et autre   
            $nom = $user['nom'];
            $prenom = $user['prenom'];
            $email = $user['email'];
            $image = $user['photo_profil']; 
           
            
            echo'
            <div class="item-1a">
                <img class="photo_profil" src="/img/'.$image.'" alt="photo de profil">   
            </div>
            <h4>Nom : '.$nom.'</h4>
            <h4>Prénom :'.$prenom.'</h4>
            <h4>Email : '.$email.'</h4>   
    ';
    }

    echo '
        </section>
        <br><br>
        ';
    }else{

    }?>
        <h2 class="h2">Ils donne leurs avis</h2>   
        <article class="item-2">                     
                <h4>Nom : </h4>
                <h4>Prénom : </h4>
                <p>Avis : lorem 20 lorem morem ipsum tralalal hitout uhgu bjb dfgh xcv  </p>
        </article>
 

<?php require_once "include/footer.php"; ?>