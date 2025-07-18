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


//instancier la methode getAllAnnonces
$annonce = new Annonce();
$annonces = $annonce->getAllAnnonces();
// Instanciation du gestionnaire  des utilisateurs

?>
<?php
 /*   
        echo '
    <div class=container">
        <div class="annonces-list">';          
        foreach($annonces as $annonce){            
        echo'
        <div class="annonce-card">        
            <div class="annonce-header">
                <img class="photo_profil" src="img/photo_profil/'.$annonce['photo_profil'].'" alt="photo de profil">   
                <div class="user-info">
                    <h2>annonce postée par :'.$annonce['nom'].' '.$annonce['prenom'].' --- '.$annonce['email'].'</h2>
                </div>
            </div>
            <div class="annonce-detail">
                <h4>Annonces : </h4>
                <span class="departement">departement : '.$annonce['departement'].'</span>
                <h2>vehicule : '.$annonce['vehicule'].'</h2>
                <p><strong>nombres de places : '.$annonce['place'].'</strong></p>
                <p class="tarif">tarif de participation : '.$annonce['tarif'].'</p>
                <p class="description">une description du voyage : '.$annonce['description'].'</p> 
                <br>
            </div>
            <div class="">
                <button class="buttonProfil"><a href="profil.php">Profil</a></button>
            </div>
        </div>  
        ';
        echo '
        </div>
    </div>
      ';
    

    }?>

<p><a href="deconnexion.php">Déconnexion</a></p>
    <br><br>
<p><a href="new_annonce.php">Poster une annonce</a></p>
<?php require_once "include/footer.php"; ?>
*/
?>

<div class="content">

                <div class="annonces-list">
                    <?php foreach ($annonces as $annonce): ?>
                        <div class="annonce-card">
                            <div class="annonce-header">
                                <img src="<?= htmlspecialchars($annonce['photo_profil'] ?? 'default_profile.jpg') ?>" alt="Photo de profil" class="user-photo">
                                <div class="user-info">
                                    <h3><?= htmlspecialchars($annonce['prenom'] . ' ' . $annonce['nom']) ?></h3>
                                    <h3><?=$annonce['email']?></h3>
                                </div>
                            </div>
                            
                            <div class="annonce-details">
                                <span class="departement"><?= htmlspecialchars($annonce['departement']) ?></span>
                                <h2><?= htmlspecialchars($annonce['vehicule']) ?></h2>
                                <p class="tarif"><?= htmlspecialchars($annonce['tarif']) ?> €</p>
                                <p><strong>Places disponibles:</strong> <?= htmlspecialchars($annonce['place']) ?></p>
                                <p class="description"><?= $annonce['description'];?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
</div>

<?php require_once "include/footer.php"; ?>

