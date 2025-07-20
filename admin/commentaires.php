<?php
//incluer les fichier nécéssaire
require_once "../session/session.php";
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../Avis.php";



if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier un user
$new_commentaire = new Avis();
//rammener tous les users 10 par pages
$commentaires = $new_commentaire->getAllCommentaires($connexion, 10, $page);

//compter
$totalAnnonces = $new_commentaire->getTotalAvis();

$totalPages = ceil($totalAnnonces / 10);


?>

<h1 class="py-5">Listes des commentaires </h1>

<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Commentaire</th>
            <th scope="col">Etoile</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach($commentaires as $commentaire) {?>
        <tr>
            <th scope="row"><?=$commentaire['id_avis']?></th>
            <td><?=$commentaire['email']?></td>
            <td><?=$commentaire['commentaire']?></td>
            <td><?=$commentaire['etoile']?></td>
            
            
            <td>
                
                <a href="delete_commentaire.php?id=<?= $commentaire['id_avis'] ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</a>
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