<?php
//pour vérifier les erreurs 
error_reporting(-1);
ini_set("display_errors", 1);
//inclure les fichiers nécéssaire
require_once "Users.php";
require_once "Annonce.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";

// Démarrer la session et vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    //$id_annonce = $_SESSION['id_annonce'];
    //instancier un user
    $new_user = new Users();
    //appel a la méthode getUserById de la classe Users
    $user = $new_user->getUserById($id);
    //onstancier une nouvelle annonce
    $new_annonce = new Annonce();
    //méthode getAnnon....de la classe Annonce
    $annonces = $new_annonce->getAnnonceByIdUser($id);

   
    //$id = $id['id'];
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 
    $role = $user['role'];

?>

<h1>Bienvenue, <?php echo $user['prenom']." ".  $user['nom']; ?>!</h1>    
<p>Email: <?php echo $user['email']; ?></p>
<p>Role : <?php echo $user['role']; ?></p>

    
<?php
//ecrire du html en passant par l'ouverture de php et echo (html dans le php)
echo '

<br><br>
<div class="">        
     <section class="item-1">
        <div class="item-1a">
            <img class="photo_profil" src="img/photo_profil/'.$image.'" alt="photo de profil">   
        </div>
        <h4>Nom : '.$nom.'</h4>
        <h4>Prénom : '.$prenom.'</h4>
        <h4>Email : '.$email.'</h4> 
        <br>
    </section>
     
    <div class="item-3">
        <h4 class="item-3a">Vos annonces</h4> 

    </div>';   
?>
<!-- 
 ecrir du html en passant par l'ouveture de php que pour le php (html en dehors du php)
-->
    <div class="annonces-list">
               
                    <?php foreach ($annonces as $annonce): ?>
                        <div class="annonce-card">
                            <div class="annonce-header">
                                <img src="<<?php echo $user['photo_profil'] ?? 'default_profile.jpg' ?>" alt="Photo de profil" class="user-photo">
                                <div class="user-info">
                                    <h3><?php echo $user['prenom']." ".  $user['nom']; ?></h3>
                                    <h3><?php echo $user['email']; ?></h3>
                                    
                                </div>
                            </div>
                            
                            <div class="annonce-details">
                                <span class="departement"><?= htmlspecialchars($annonce['departement']) ?></span>
                                <h2><?= htmlspecialchars($annonce['vehicule']) ?></h2>
                                <p class="tarif"><?= htmlspecialchars($annonce['tarif']) ?> €</p>
                                <p><strong>Places disponibles:</strong> <?= htmlspecialchars($annonce['place']) ?></p>
                                <p class="description"><?php echo $annonce['description']; ?></p>
                            </div>
                           
                        </div>
                    <?php endforeach; ?>
                <?php
                if($user['role'] === "admin"){
                ?>
                    <p><a href="admin/index.php">Dashboard</a></p>
                <?php
                }
                ?>
                    <p><a href="deconnexion.php">Déconnexion</a></p>

                    <p><a href="new_annonce.php">Poster une annonce</a></p>
                    
                    <p><a href="new_avis.php">Poster un commentaire</a></p>
    </div>
</div>
    <?php
}else{
    header('Location: connexion.php');
    exit();
}?>

 

<?php require_once "include/footer.php"; ?>