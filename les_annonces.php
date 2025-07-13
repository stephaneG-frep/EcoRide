<?php
error_reporting(-1);
ini_set("display_errors", 1);
//session_start();
//inclure les fichiers nécessaire

require_once "Users.php";
require_once "Annonce.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";

// Instanciation du gestionnaire  des utilisateurs
$allUsers = new Users();
// Récupération des utilisateurs 
$users = $allUsers->getAllUsers();

$allAnnonce = new Annonce();
$annonces = $allAnnonce->getAllAnnonces();


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

        foreach ($annonces as $annonce){
            $departement = $annonce['departement'];
            $vehicule = $annonce['vehicule'];
            $place = $annonce['place'];
            $tarif = $annonce['tarif'];
            $description = $annonce['description'];
        
           
            
            echo'
         <section class="item-3">
            <div class="item-1a">
                <img class="photo_profil" src="img/photo_profil/'.$image.'" alt="photo de profil">   
            </div>
            <h4>annonce postée par : '.$nom.' '.$prenom.' '.$email.'</h4>
            <h4>Annonces : </h4>
            <p>departement : '.$departement.'</p>
            <p>vehicule : '.$vehicule.'</p>
            <p>nombres de places : '.$place.'</p>
            <p>tarif de participation : '.$tarif.'</p>
            <p>une description du voyage : '.$description.'</p> 
            <br>
            <div class="">
                <button class="buttonProfil"><a href="profil.php">Voir le profil</a></button>
            </div>  

    
        </section>
      ';
    }
}
    
    }else{

    }?>

<p><a href="deconnexion.php">Déconnexion</a></p>
    <br><br>
    <p><a href="new_annonce.php">Poster une annonce</a></p>



<?php require_once "include/footer.php"; ?>

?>