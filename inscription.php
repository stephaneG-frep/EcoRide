<?php

//inclure les fichiers nécessaire
require_once "include/head.php";
require_once "include/header.php";
require_once "fonctions.php";
require_once "db/Database.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = new Users();
//conndition d'appel a la fonction(check) nettoyage securitaire 
    if(isset($_POST['inscription']) && !empty($_POST['inscription'])){
        $username = htmlspecialchars(check($_POST['username']));
        $email = htmlspecialchars(check($_POST['email']));
        $password = check($_POST['password']);
        $tel = htmlspecialchars(check($_POST['tel']));
        $departement = check($_POST['departement']);
        $vehicule = htmlspecialchars(check($_POST['vehicule']));
        $place = htmlspecialchars(check($_POST['place']));
        $tarif = htmlspecialchars(check($_POST['tarif']));
        $description = htmlspecialchars(check($_POST['description']));
        $photo_profil = check($_POST['photo_profil']);

    }



}



?>
<div class="inscrip">



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
        
        Votre téléphone :
        <input type="text" name="tel" placeholder="numero de telephone">
        <br>
        Votre département : 
        <input type="text" name="departement" placeholder="votre département">
        <br>
        Quelle est votre véhicule : 
        <input type="text" name="vehicule" placeholder="votre vehicule">
        <br>
        Nombre de places : 
        <input type="int" name="place" placeholder="nombre de place">
        <br>
        Tarif participation :
        <input type="float" name="tarif" placeholder="paricipation">
        <br>
        Petite déscription :
        <br>
        <textarea name="description" placeholder="petite description">Ecrire</textarea>       
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