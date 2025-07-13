<?php
error_reporting(-1);
ini_set("display_errors", 1);

//require_once "session/SessionManager.php";
require_once "Users.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";

// Démarrer la session et vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $new_user = new Users();
    $user = $new_user->getUserById($id);


    //$id = $id['id'];
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 
    //$annonce = $user['annonce'];

}else{
    
    header('Location: connexion.php');
    exit();
}
?>

<h1>Bienvenue, <?php echo $user['prenom']." ".  $user['nom']; ?>!</h1>    
<p>Email: <?php echo $user['email']; ?></p>

    
<?php
echo '
<br><br>
<div class="">';   
        
        echo'
     <section class="item-1">
        <div class="item-1a">
            <img class="photo_profil" src="img/photo_profil/'.$image.'" alt="photo de profil">   
        </div>
        <h4>Nom : '.$nom.'</h4>
        <h4>Prénom : '.$prenom.'</h4>
        <h4>Email : '.$email.'</h4> 
        <br>

    </section>
     <article class="item-2">                     
                <h4>Nom : '.$nom.'</h4>
                <h4>Prénom : '.$prenom.'</h4>
                <p>Avis : lorem 20 lorem morem ipsum tralalal hitout uhgu bjb dfgh xcv  </p>
    </article>

  ';
?>
<div class="item-3">
    <h4 class="item-3a">Vos annonces</h4>   

</div>   
    <p><a href="deconnexion.php">Déconnexion</a></p>
    <br><br>
    <p><a href="new_annonce.php">Poster une annonce</a></p>









<?php require_once "include/footer.php"; ?>