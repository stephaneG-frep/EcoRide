<?php
error_reporting(-1);
ini_set("display_errors", 1);

//require_once "session/SessionManager.php";
require_once "Users.php";
require_once "Annonce.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";

// Démarrer la session et vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    //$id_annonce = $_SESSION['id_annonce'];
    $new_user = new Users();
    $user = $new_user->getUserById($id);

    $new_annonce = new Annonce();
    $annonces = $new_annonce->getAnnonceByIdUser($id);

    //$id = $id['id'];
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 

    //$annonces = $id_annonce['id_annonce'];
/*
}else{   
    header('Location: connexion.php');
    exit();
}
*/
?>

<h1>Bienvenue, <?php echo $user['prenom']." ".  $user['nom']; ?>!</h1>    
<p>Email: <?php echo $user['email']; ?></p>

    
<?php
echo '
<br><br>
<div class="">        
     <section class="item-1">
        <div class="item-1a">
            <img class="photo_profil" src="img/photo_profil/'.$image.'" alt="photo de profil">   
        </div>
        <h4>Nom : '.$nom.'</h4>
        <h4>Prénom : '.$prenom.'</h4>
        <h4>Email : '.$email.'</h4> 
        <br>
    </section>
     
    <div class="item-3">
        <h4 class="item-3a">Vos annonces</h4> 

    </div>';   
?>
    <div class="annonces-list">
               
                    <?php foreach ($annonces as $annonce): ?>
                        <div class="annonce-card">
                            <div class="annonce-header">
                                <img src="<<?php echo $user['photo_profil'] ?? 'default_profile.jpg' ?>" alt="Photo de profil" class="user-photo">
                                <div class="user-info">
                                    <h3><?php echo $user['prenom']." ".  $user['nom']; ?></h3>
                                    <h3><?php echo $user['email']; ?></h3>
                                    
                                </div>
                            </div>
                            
                            <div class="annonce-details">
                                <span class="departement"><?= htmlspecialchars($annonce['departement']) ?></span>
                                <h2><?= htmlspecialchars($annonce['vehicule']) ?></h2>
                                <p class="tarif"><?= htmlspecialchars($annonce['tarif']) ?> €</p>
                                <p><strong>Places disponibles:</strong> <?= htmlspecialchars($annonce['place']) ?></p>
                                <p class="description"><?php echo $annonce['description']; ?></p>
                            </div>

                    <!-- Dans votre liste d'annonces -->
                            <button class="btn btn-danger btn-sm delete_annonce" 
                                    data-id="<?= $annonce['id_annonce'] ?>">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>

                            <script>
                            document.querySelectorAll('.delete_annonce').forEach(button => {
                                button.addEventListener('click', function() {
                                    const annonceId = this.getAttribute('data-id');
                                    
                                    if (confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')) {
                                        fetch('delete_annonce.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                            },
                                            body: 'id_annonce=' + annonceId
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                this.closest('tr').remove();
                                                alert(data.message);
                                            } else {
                                                alert('Erreur: ' + data.message);
                                            }
                                        });
                                    }
                                });
                            });
                            </script>

                            

                        </div>
                    <?php endforeach; ?>
                

                    <p><a href="deconnexion.php">Déconnexion</a></p>
                    <br><br>
                    <p><a href="new_annonce.php">Poster une annonce</a></p>
    </div>
</div>
    <?php
}else{
    header('Location: connexion.php');
    exit();
}?>

 

<?php require_once "include/footer.php"; ?>