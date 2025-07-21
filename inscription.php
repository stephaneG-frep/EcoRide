<?php
//inclure les fichiers nécessaire
//require_once "session/SessionManager.php";
require_once "Users.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";
require_once "fonction/check.php";
//require_once "fonction/token.php";


//recupérer les données du formulaire
//if(isset($_POST['inscription'])){
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new Users();
    /*
    //faire toutes les vérifications dez sécuritée   
    //conndition d'appel a la fonction(check) nettoyage securitaire      
    $firstname = htmlspecialchars(check($_POST['firstname']));
    $lastname = htmlspecialchars(check($_POST['lastname']));
    $email = htmlspecialchars(check($_POST['email']));
    $password = htmlspecialchars(check($_POST['password']));
    $password_confirm = htmlspecialchars(check($_POST['password_confirm']));
    $tel = htmlspecialchars(check($_POST['tel']));
    $photo_profil = htmlspecialchars(check($_POST['photo_profil']));
    */
    if(empty($_POST['nom']) || !ctype_alpha($_POST['nom'])){
        $message = "Saisir un identifient valide";
    }elseif(empty($_POST['prenom']) || !ctype_alpha($_POST['prenom'])){
        $message = "Saisir un identifient valide";
    }elseif(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $message = "Saisir une adresse mail valide";
    }elseif(empty($_POST['password'])){
        $message = " Saisir un mot de passe valide";
    
    }else{
        //valeurs du formulaire a mettre dans la méthode register
        //faire toutes les vérifications dez sécuritée   
        //conndition d'appel a la fonction(check) nettoyage securitaire      
        $nom = htmlspecialchars(check($_POST['nom']));
        $prenom = htmlspecialchars(check($_POST['prenom']));
        $email = htmlspecialchars(check($_POST['email']));
        $password = htmlspecialchars(check($_POST['password']));
          
        /*
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $tel = $_POST['tel'];
        */
        //condition si photo de profil ou non
        if(empty($_FILES['photo_profil']['name'])){
            $photo_profil = "avatar_default.jpg";
        }else{
            if(preg_match("#gif|jpeg|png|jpg#",$_FILES['photo_profil']['type'])){
                //inclure le fichier token
                require_once "fonction/token.php";
                //donner un nom aléatoire
                $photo_profil = $token."_".$_FILES['photo_profil']['name'];
                //chemin de la photo stocker
                $path = "img/photo_profil/";
                move_uploaded_file($_FILES['photo_profil']['tmp_name'],$path.$photo_profil);

            }else{
                $message = "Choisir le bon format(gif,png,jpg,jpeg)";
            }
        //}
        //insertion des données
        //instancier un users
        
        //$user = new Users();
        
        //vérifier les doublon d'adressemail avec la methode getUserByEmail de la class users
        $existingUser = $user->getUserByEmail($email);
        //si resultat positif message erreur
        if($existingUser){ 
            $message = "L'adresse Email existe déjas";
            //sinon réussite de l'inscription
        }else{
    
            //appel a la méthode register class users
            $result = $user->register($nom,$prenom,$email
                                        ,$password,$photo_profil);
                                    
            if($result){
                
                header('Location:index.php');
                //exit();
            }else{
                $message = "Erreur lors de l'inscription";
            }
        }

    }

    }

}


?>
<div class="inscrip">

    <h2 class="h2">Inscription</h2>

    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        Votre Nom : 
        <input type="text" name="nom" id="nom" placeholder="votre nom">
        <br>
        Votre Prénom : 
        <input type="text" name="prenom" id="prenom" placeholder="votre prénom">
        <br>
        Votre E-mail : 
        <input type="email" name="email" id="email" placeholder="email: exemple@exemple.com">
        <br>
        Votre mot de passe :
        <input type="password" name="password" id="password" placeholder="mot de passe">
        <br>
        
        Photo de profil :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="photo_profil" id="photo_profil">
        <br>      
        Inscription : 
        <input type="submit" name="inscription"
                value="Créer un compte" >
        <br>

    </form>
</div>
<div class="connect">
     <a href="connexion.php">Déja un compte?Connectez-vous</a>       
</div>


<?php require_once "include/footer.php"; ?>