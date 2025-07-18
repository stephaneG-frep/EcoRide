<?php
error_reporting(-1);
ini_set("display_errors", 1);

require_once "Users.php";
require_once "include/head.php";
require_once "Users.php";
require_once "Avis.php";
require_once "include/header.php";
require_once "fonction/check.php";

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


if(isset($_POST['attribuer'])){

    $avis = htmlspecialchars(check($_POST['commentaire']));
    $etoile = htmlspecialchars(check($_POST['etoile']));

    if(empty($_POST['commentaire'])){
        $message = "Ecrire un commentaire";
    }elseif(empty($_POST['etoile'])){
        $message = "Attribuer au moins une étoile";
    }else{
        $commentaire = $_POST['commentaire'];
        $etoile = $_POST['etoile'];

        $avis = new Avis();
        $result = $avis->newAvis($commentaire,$etoile,$id,$id_avis);

        if($result){
            header("location:index.php");
            exit();
        }else{
            $message = "Erreur lors de l'execution du commentaire";
        }
    }

}

?>
<h1>Bienvenue, <?php echo $user['prenom']." ". $user['nom']; ?>!</h1>    
<p>Email: <?php echo $user['email']; ?></p>

<div class="inscrip">
    <h2 class="h2">Deposer un avis un commentaire</h2>
    
    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

        <form method="POST" action="">
            Commentaire : <br>
            <textarea type="text" name="commentaire" cols="40px" rows="10px"
             placeholder="petit commentaire pas trop long"></textarea>    
            <br>
            Nombre d'etoiles : <br>
            <select name="etoile" id="pet-select">
                <option  value="">--Attribuer des étoiles--</option>
                <option name="etoile" value="01">01</option>
                <option name="etoile" value="02">02</option>
                <option name="etoile" value="03">03</option>
                <option name="etoile" value="04">04</option>
                <option name="etoile" value="05">05</option>
            </select>
            <br>
            Connexion :
            <input type="submit" name="attribuer" value="attribuer">
        </form>
</div>









<?php require_once "include/footer.php"; ?>