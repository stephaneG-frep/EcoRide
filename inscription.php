<?php

//inclure les fichiers nécessaire
require_once "include/head.php";
require_once "include/header.php";
require_once "fonction/check.php";
require_once "db/config.php";
require_once "class/Users.php";

//recupérer les données du formulaire
if(isset($_POST['inscription'])){
    //faire toutes les vérifications dez sécuritée   
    //conndition d'appel a la fonction(check) nettoyage securitaire  
    /*
    $username = htmlspecialchars(check($_POST['username']));
    $email = htmlspecialchars(check($_POST['email']));
    $password = htmlspecialchars(check($_POST['password']));
    $tel = htmlspecialchars(check($_POST['tel']));
    $departement = check($_POST['departement']);
    $vehicule = htmlspecialchars(check($_POST['vehicule']));
    $place = htmlspecialchars(check($_POST['place']));
    $tarif = htmlspecialchars(check($_POST['tarif']));
    $description = htmlspecialchars(check($_POST['description']));
    */
    
    if(empty($_POST['username']) || !ctype_alnum($_POST['username'])){
        $message = "Saisir un identifient valide";
    }elseif(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $message = "Saisir une adresse mail valide";
    }elseif(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $message = " Saisir un mot de passe valide";
    }elseif(empty($_POST['tel']) || !ctype_digit($_POST['tel'])){
        $message = "Saisir un numéro de téléphone valide";
    }elseif(empty($_POST['departement']) || !ctype_alnum($_POST['departement'])){
        $message = "Saisir un département valide";
    }elseif(empty($_POST['vehicule']) || ctype_alpha($_POST['vehicule'])){
        $message = "Saisir un vehicule valide";
    }elseif(empty($_POST['place']) || !ctype_digit($_POST['place'])){
        $message = "Saisir un nombre valide";
    }elseif(empty($_POST['tarif']) || !ctype_digit($_POST['tarif'])){
        $message = "Saisir un tarif valide";
    }else{
        //valeurs du formulaire a mettre dans la méthode register
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $tel = $_POST['tel'];
        $departement = $_POST['departement'];
        $vehicule = $_POST['vehicule'];
        $place = $_POST['place'];
        $tarif = $_POST['tarif'];
        $description = $_POST['description'];

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
                move_uploaded_file($_FILES['photo_profil']['tmp_name'],$path,$photo_profil);

            }else{
                $message = "Choisir le bon format(png,jpg,jpeg)";
            }
        }

        //insertion des données
        //instancier un users
        $user = new Users();

        //vérifier les doublon d'adressemail avec la methode getUserByEmail de la class users
        $existingUser = $user->getUserByEmail($email);
        //si resultat positif message erreur
        if($existingUser){ 
            $message = "L'adresse existe déjas";
            //sinon réussite de l'inscription
        }else{
            //appel a la méthode register class users
            $result = $user->register($username,$email,$password,$tel,
            $departement,$vehicule,$place,$tarif,$description,$photo_profil);
                                    
            if($result){
                header("location: index.php");
                exit();
            }else{
                $message = "Erreur lors de l'inscription";
            }
        }

    }

}




?>
<div class="inscrip">

<?php if(isset($message)) echo $message; ?>

    <form method="POST" action="index.php" enctype="multipart/form-data">
        Nom d'utilisateur : 
        <input type="text" name="username" placeholder="nom d'utilisateur">
        <br>
        Votre E-mail : 
        <input type="email" name="email" placeholder="email: exemple@exemple.com">
        <br>
        Votre mot de passe :
        <input type="password" name="password" placeholder="mot de passe">
        <br>
        Confirmer otre mot de passe :
        <input type="password" name="password_confirm" placeholder="confirmer le mot de passe">
        <br>
        Votre téléphone :
        <input type="text" name="tel" placeholder="numero de telephone">
        <br>
        Votre département : 
        <input type="text" name="departement" placeholder="votre département">
        <br>
        Quelle est votre véhicule : 
        <input type="text" name="vehicule" placeholder="exemple:voiture moto ...">
        <br>
        Nombre de places : 
        <input type="int" name="place" placeholder="nombre de place">
        <br>
        Tarif participation :
        <input type="float" name="tarif" placeholder="paricipation">
        <br>
        Petite déscription :
        <br>
        <textarea name="description" cols="40px" rows="10px" placeholder="petite description"></textarea>       
        <br>
        <br>
        Photo de profil : 
        <input type="hidden" name="MAXE_FILE_SIZE" value="1000000">
        <input type="file" name="photo_profil" id="image">
        <br>
        Inscription : <input type="submit" name="inscription" >
        <br>

    </form>
</div>


<?php require_once "include/footer.php"; ?>