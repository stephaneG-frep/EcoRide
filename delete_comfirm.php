<?php
session_start();
//require_once "session/SessionManager.php";
require_once "Users.php";
require_once "Annonce.php";
require_once "db/config.php";


if(isset($_GET['id_annonce'], $_GET['id'], $_SESSION['id'])){

	if($_SESSION['id'] == $_GET['id']){

		$id_annonce = $_GET['id_annonce'];

		$annonce = new Annonce();

		$success = $annonce->deleteAnnonce($id_annonce);

		if($success){
			header('Location:profil.php');
	    	exit();
		}else{
			echo '
				<script>
					alert("Votre annonce n\'a pas été supprimée! ");
					window.location.href = "profil.php";

				</script>
			';
		}


	}else{
		header('Location:profil.php');
	    exit();
	}


}else{
	header('Location:profil.php');
	exit();
}


?>