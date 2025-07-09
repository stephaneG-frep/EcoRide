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

    }

}

?>


<div class="inscrip">

    <h2 class="h2">Changer le profil</h2>

    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        Votre Nom : 
        <input type="text" name="firstname" placeholder="votre nom">
        <br>
        Votre Prénom : 
        <input type="text" name="lastname" placeholder="votre prénom">
        <br>
        Votre E-mail : 
        <input type="email" name="email" placeholder="email: exemple@exemple.com">
        <br>
        Votre téléphone :
        <input type="int" name="tel" placeholder="numero de telephone">
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




<?php require_once "include/footer.php";  ?>