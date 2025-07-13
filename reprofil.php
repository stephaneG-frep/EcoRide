<?php
error_reporting(-1);
ini_set("display_errors", 1);

//inclure les fichiers nécéssaire

require_once "Users.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";
require_once "fonction/check.php";
require_once "fonction/token.php";
//require_once "db/config.php";

//si li y a une session
if(isset($_SESSION['id'])){
    //instancier l'utilisateur avec son id 
    //avec la méthode getUserById() class Users
    $id = $_SESSION['id'];
    $new_user = new Users();
    $user = $new_user->getUserById($id);

    

    //récupération des données de l'utilisateur dans le formulaire
    if(isset($_POST['update_profil'])){
        //faire toutes les vérifications de sécu
        if(empty($_POST['nom']) || !ctype_alpha($_POST['nom'])){
            $message = "Saisir un identifient valide";
        }elseif(empty($_POST['prenom']) || !ctype_alpha($_POST['prenom'])){
            $message = "Saisir un identifient valide";
        }elseif(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $message = "Saisir une adresse mail valide";
    
        
        }else{
            //valeurs du formulaire a mettre dans la méthode register
            $nom = htmlspecialchars(check($_POST['nom']));
            $prenom = htmlspecialchars(check($_POST['prenom']));
            $email = htmlspecialchars(check($_POST['email']));
              
            //condition si photo de profil ou non
            if(empty($_FILES['photo_profil']['name'])){
                $photo_profil = "avatar_default.jpg";
            }else{
                if(preg_match("#jpeg|png|jpg#",$_FILES['photo_profil']['type'])){
                    //inclure le fichier token
                    require_once "fonction/token.php";
                    //donner un nom aléatoire
                    $photo_profil = $token." ".$_FILES['photo_profil']['name'];
                    //chemin de la photo stocker
                    $path = "img/";
                    move_uploaded_file($_FILES['photo_profil']['tmp_name'],$path.$photo_profil);
    
                }else{
                    $message = "Choisir le bon format(png,jpg,jpeg)";
                }
            }
            //insertion des données
            //instancier un users
            $user = new Users();
            //vérifier les doublon d'adressemail avec la methode getUserByEmail de la class users
            $existingUser = $user->getUserByEmailId($id,$email);
            //si resultat positif message erreur
            if($existingUser){ 
                $message = "L'adresse Email existe déjas";
                //sinon réussite de l'inscription
            }else{
                //appel a la méthode register class users
                $result = $user->updateProfil($id,$nom,$prenom,$email,$photo_profil);
                                        
                if($result){
                    header("location:index.php");
                    //exit();
            }else{
                $message = "Erreur lors de l'inscription";
            }
          }
    
        }
    }


?>


<div class="inscrip">

    <h2 class="h2">Changer le profil</h2>

    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        Votre Nom : 
        <input type="text" name="nom" value="<?= $user['nom'] ?>" placeholder="votre nom">
        <br>
        Votre Prénom : 
        <input type="text" name="prenom" value="<?= $user['prenom'] ?>" placeholder="votre prénom">
        <br>
        Votre E-mail : 
        <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="email: exemple@exemple.com">
        <br>
        
        Photo de profil : 
        <input type="hidden" name="MAXE_FILE_SIZE" value="1000000">
        <input type="file" name="photo_profil" id="image">
        <br>
        Inscription : <input type="submit" name="update_profil"
                       value="Mettre à jour" class="btn btn-primary" >
        <br>

    </form>
</div>

<?php 
}else{
    header("location:connexion.php");
} 
?>


<?php require_once "include/footer.php";  ?>