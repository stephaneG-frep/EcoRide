<?php
error_reporting(-1);
ini_set("display_errors", 1);
//session_start();

require_once "Annonce.php";
require_once "Users.php";
require_once 'db/config.php';
require_once "include/head.php";
require_once "include/header.php";

// Vérifier l'id
if (isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}else{
    header('Location: connexion.php');
    exit();
}

if(isset($_GET['id_annonce'])){
    // Récupère l'ID de l'annonce à partir des paramètres de l'URL
    $id_annonce = $_GET['id_annonce'];
    //instancier le gestionnaire d'annonce
    $annonce = new Annonce();
    //récuppérer l'annonce par l'id
    $result = $annonce->getAnnonceById($id_annonce);

    //données pour utilisation ultérieure ultérieure 
	$email = $result['email'];
    $id = $result['id'];//id = id de users

    if($_SESSION['id'] == $id){
        $id = $_SESSION['id'];

        echo '
			<script>
				var confirmation = confirm("Êtes vous sûr de vouloir supprimer votre annonce  ?'.$email.'");

				if(confirmation){
					window.location.href = "delete_comfirm.php?id_annonce='.$id_annonce.'&id='.$id.'";
				}else{
					window.location.href = "profil.php";
				}

			</script>

		';

	}else{
		
		// Si l'utilisateur n'est pas le propriétaire, affiche une alerte et redirige vers la page de l'utilisateur
		echo '
			<script>
			alert("Cette annonce ne vous appartient pas, vous ne pouvez pas la supprimer!");
			window.location.href = "profil.php";
			</script>
		';
	}

}


 
require_once "include/footer.php";
?>