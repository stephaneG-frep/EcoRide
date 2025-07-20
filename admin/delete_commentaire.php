<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire

require_once "../session/session.php";
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../Avis.php";

//$new_user = new Users();
//$user = $new_user->getUserById($id);


$commentaire = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $new_commentaire = new Avis();
    $commentaire =  $new_commentaire->getAvisById( (int)$_GET["id"]);
}
if ($commentaire) {
    if ($commentaire = $new_commentaire->deleteAvis( $_GET["id"])) {
        $messages[] = "Le commentaire à bien été supprimée";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le commentaire n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression de commentaire</h1>
    <?php foreach ($messages as $message) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
    <?php } ?>
</div>

<?php
require_once('template/footer.php');

?>