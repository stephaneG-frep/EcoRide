<?php

//inclure les fichiers nécéssaire
require_once "include/head.php";
require_once "include/header.php";
require_once "db/config.php";
require_once "Users.php";

//si li y a une session
if(isset($_SESSION['id_user'])){
    //instancier l'utilisateur avec son id 
    //avec la méthode getUserById() class Users
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    //récupération des données de l'utilisateur dans le formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //faire toutes les vérifications de sécu
        if(empty($_POST['firstname']) || !ctype_alpha($_POST['firstname'])){
            $message = "Saisir un identifient valide";
        }elseif(empty($_POST['lastname']) || !ctype_alpha($_POST['lastname'])){
            $message = "Saisir un identifient valide";
        }elseif(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $message = "Saisir une adresse mail valide";
        }elseif(empty($_POST['tel']) || !ctype_digit($_POST['tel'])){
            $message = "Saisir un numéro de téléphone valide";
        
        }else{
            //valeurs du formulaire a mettre dans la méthode register
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
    
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
                    $path = "img/photo_profil/";
                    move_uploaded_file($_FILES['photo_profil']['tmp_name'],$path.$photo_profil);
    
                }else{
                    $message = "Choisir le bon format(png,jpg,jpeg)";
                }
            }
            //insertion des données
            //instancier un users
            $user = new Users();
            //vérifier les doublon d'adressemail avec la methode getUserByEmail de la class users
            $existingUser = $user->getUserByEmailId($id_user,$email);
            //si resultat positif message erreur
            if($existingUser){ 
                $message = "L'adresse Email existe déjas";
                //sinon réussite de l'inscription
            }else{
                //appel a la méthode register class users
                $result = $user->updateProfil($id_user,$firstname,$lastname,$email,
                                             $tel,$photo_profil);
                                        
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

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        Votre Nom : 
        <input type="text" name="firstname" value="<?php $user['firstname'] ?> placeholder="votre nom">
        <br>
        Votre Prénom : 
        <input type="text" name="lastname" value="<?php $user['lastname'] ?> placeholder="votre prénom">
        <br>
        Votre E-mail : 
        <input type="email" name="email" value="<?php $user['email'] ?> placeholder="email: exemple@exemple.com">
        <br>
        Votre téléphone :
        <input type="int" name="tel" value="<?php $user['tel'] ?> placeholder="numero de telephone">
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

<?php }else{
    header("location:connexion.php");
} ?>


<?php require_once "include/footer.php";  ?>