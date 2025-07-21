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
$users = $allUsers->getAllUsers();

?>

        <?php if(isset($message)) echo "<p>".$message."</p>";?>
   
        <h1>Bienvenue sur EcoRide <br> le site du covoiturage écolo</h1>

    <?php 
    if(isset($_SESSION['id'])){
       
    echo '

    <div class="">';

       
        foreach ($users as $user) {   
            // Instanciation du gestionnaire d'utilisateurs pour obtenir son nom prenom et autre   
            $nom = $user['nom'];
            $prenom = $user['prenom'];
            $email = $user['email'];
            $image = $user['photo_profil']; 
           
            
            echo'
         <section class="item-1">
            <div class="item-1a">
                <img class="photo_profil" src="img/photo_profil/'.$image.'" alt="photo de profil">   
            </div>
            <h6>Nom : '.$nom.'</h6>
            <h6>Prénom : '.$prenom.'</h6>
            <h6>Email : '.$email.'</h6> 
            <br>
            <div class="">
                <button class="buttonProfil"><a href="profil.php">Profil</a></button>
            </div>  

    
        </section>
      ';
    }
   
    }else{

    }?>

<?php require_once "include/footer.php"; ?>