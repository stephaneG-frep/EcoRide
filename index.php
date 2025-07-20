<?php
error_reporting(-1);
ini_set("display_errors", 1);
//session_start();
//inclure les fichiers nécessaire

require_once "Users.php";

require_once "Annonce.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";

$annonceModel = new Annonce();
$searchTerm = '';
$annonces = [];


?>
   
    <h1>Bienvenue sur EcoRide <br> le site du covoiturage écolo</h1>

<?php 



     // Traitement de la recherche
if (isset($_GET['departement'])) {
    $searchTerm = trim($_GET['departement']);
    if (!empty($searchTerm)) {
        $annonces = $annonceModel->getAnnonceByDepartement($searchTerm);
    }
}
if(isset($_SESSION['id'])){
?>


 <div class="content">
 <h1>Rechercher des annonces Ecoride</h1>
    <form method="GET" class="search-form">
        <input type="text" name="departement" placeholder="Entrez un de département (ex:Aisne,Val D\'oise,...)" 
        // Traitement de la recherche
        if (isset($_GET["departement"])) {
            $searchTerm = trim($_GET["departement"]);
            if (!empty($searchTerm)) {
                $annonces = $annonceModel->searchByDepartement($searchTerm);
            }
        }
      value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <?php if (!empty($searchTerm)): ?>
                <div class="search-info">
                    <?php if (!empty($annonces)): ?>
                        <p>Résultats pour le département : "<?= htmlspecialchars($searchTerm) ?>"</p>
                    <?php else: ?>
                        <p>Aucun résultat trouvé pour le département : "<?= htmlspecialchars($searchTerm) ?>"</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($annonces)): ?>
                <div class="annonces-list">
                    <?php foreach ($annonces as $annonce): ?>
                        <div class="annonce-card">
                            <div class="annonce-header">
                                <img src="<?= htmlspecialchars($annonce['photo_profil'] ?? 'default_profile.jpg') ?>" alt="Photo de profil" class="user-photo">
                                <div class="user-info">
                                    <h3><?= htmlspecialchars($annonce['prenom'] . ' ' . $annonce['nom']) ?></h3>
                                    <h3><?=htmlspecialchars($annonce['email'])?></h3>
                                </div>
                            </div>
                            
                            <div class="annonce-details">
                                <span class="departement"><?= htmlspecialchars($annonce['departement']) ?></span>
                                <p>"Je part de ".<?=$annonce['depart']?>." et je me rend a ".<?=$annonce['arrive']?></p>
                                <h2><?= htmlspecialchars($annonce['vehicule']) ?></h2>
                                <p class="tarif"><?= htmlspecialchars($annonce['tarif']) ?> €</p>
                                <p><strong>Places disponibles:</strong> <?= htmlspecialchars($annonce['place']) ?></p>
                                <p class="description"><?= $annonce['description'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif (empty($searchTerm)): ?>
                <div class="no-results">
                    <p>Entrez un numéro de département pour afficher les annonces correspondantes</p>
                </div>
            <?php endif; ?>
</div>
<?php
}else{

}?>

<?php require_once "include/footer.php"; ?>