<?php
//incluer les fichier nécéssaire
require_once "../session/session.php";
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../Annonce.php";



if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier un user
$new_annonces = new Annonce();
//rammener tous les users 10 par pages
$annonces = $new_annonces->getAllAnnonces($connexion, 10, $page);

//compter
$totalAnnonces = $new_annonces->getTotalAnnonce();

$totalPages = ceil($totalAnnonces / 10);


?>

<h1 class="py-5">Listes des annonces</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Département</th>
            <th scope="col">Véhicule</th>
            <th scope="col">Place</th>
            <th scope="col">Tarif</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($annonces as $annonce) {?>
        <tr>
            <th scope="row"><?=$annonce['id_annonce']?></th>
            <td><?=$annonce['departement']?></td>
            <td><?=$annonce['vehicule']?></td>
            <td><?=$annonce['place']?></td>
            <td><?=$annonce['tarif']?></td>
            <td><?=$annonce['description']?></td>
            
            <td>
                
                <a href="delete_annonce.php?id=<?= $annonce['id_annonce'] ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</a>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>

<?php if ($totalPages > 1) {?>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) {?>
        <li class="page-item <?php if ($i === $page) { echo "active"; }?>"><a class="page-link"
                href="?page=<?=$i;?>"><?=$i;?></a></li>
        <?php }?>
    </ul>
</nav>
<?php }?>

<?php 
require_once "template/footer.php";
?>