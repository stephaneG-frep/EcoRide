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

/*
//vérifier la session
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    
}else{
    header("location: connexion.php");
    exit();
}
*/
//instancier la methode getAllAnnonces
$annonce = new Annonce();
$annonces = $annonce->getAllAnnonces();
// Instanciation du gestionnaire  des utilisateurs

      
        echo '

        <div class="annonce">';          

        foreach($annonces as $annonce){
             
            echo'
         <section class="item-3">
            <div class="item-1a">
                <img class="photo_profil" src="img/photo_profil/'.$annonce['photo_profil'].'" alt="photo de profil">   
            </div>
            <h2>annonce postée par :'.$annonce['nom'].' '.$annonce['prenom'].' --- '.$annonce['email'].'</h2>
            <h4>Annonces : </h4>
            <p>departement : '.$annonce['departement'].'</p>
            <p>vehicule : '.$annonce['vehicule'].'</p>
            <p>nombres de places : '.$annonce['place'].'</p>
            <p>tarif de participation : '.$annonce['tarif'].'</p>
            <p>une description du voyage : '.$annonce['description'].'</p> 
            <br>
            <div class="">
                <button class="buttonProfil"><a href="profil.php">Profil</a></button>
            </div>  
        ';
    echo '
        </section>
    </div>
      ';
    

    }?>

<p><a href="deconnexion.php">Déconnexion</a></p>
    <br><br>
    <p><a href="new_annonce.php">Poster une annonce</a></p>



<?php require_once "include/footer.php"; ?>

