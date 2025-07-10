<?php

require_once "include/head.php";
require_once "include/header.php";
require_once "fonction/check.php";
require_once "db/config.php";
require_once "Users.php";

if(isset($_POST['attribuer'])){

    $avis = htmlspecialchars(check($_POST['avis']));

    if(empty($_POST['avis'])){
        $message = "Ecrire un commentaire";
    }elseif(empty($_POST['etoile'])){
        $message = "Attribuer au moins une étoile";
    }else{
        $avis = $_POST['avis'];
        $etoile = $_POST['etoile'];

        $avis = new Avis();
        $result = $avis->newAvis($avis,$etoile);

        if($result){
            header("location:index.php");
            exit();
        }else{
            $message = "Erreur lors de l'execution du commentaire";
        }
    }

}

?>

<div class="inscrip">
    <h2 class="h2">Deposer un avis un commentaire</h2>
    
    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            Commentaire : <br>
            <textarea name="avis" cols="40px" rows="10px" placeholder="petit commentaire pas trop long"></textarea>    
            <br>
            Nombre d'etoiles : <br>
            <select name="etoile" id="pet-select">
                <option  value="">--Attribuer des étoiles--</option>
                <option name="etoile" value="Une">01: *</option>
                <option name="etoile" value="Deux">02: **</option>
                <option name="etoile" value="Trois">03: ***</option>
                <option name="etoile" value="Quatre">04: ****</option>
                <option name="etoile" value="Cinq">05: *****</option>
            </select>
            <br>
            Connexion :
            <input type="submit" name="attribuer" value="attribuer">
        </form>
</div>









<?php require_once "include/footer.php"; ?>